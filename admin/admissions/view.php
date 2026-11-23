<?php
require_once __DIR__ . '/../includes/auth.php';
admin_require_login();
require_once dirname(__DIR__, 2) . '/includes/admissions-helpers.php';
require_once dirname(__DIR__, 2) . '/config/mailer.php';

$pdo = db();
$id = (int)($_GET['id'] ?? 0);

$notice = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && admin_csrf_check($_POST['csrf'] ?? null)) {
    $newStatus = $_POST['status'] ?? '';
    $note      = trim($_POST['note'] ?? '');
    $validStatuses = ['recu','en_cours','entretien_planifie','accepte','liste_attente','refuse'];

    if (in_array($newStatus, $validStatuses, true)) {
        $upd = $pdo->prepare('UPDATE admission_applications SET status = :status WHERE id = :id');
        $upd->execute([':status' => $newStatus, ':id' => $id]);

        $hist = $pdo->prepare(
            'INSERT INTO admission_status_history (application_id, status, note, changed_by) VALUES (:id, :status, :note, :by)'
        );
        $hist->execute([':id' => $id, ':status' => $newStatus, ':note' => $note ?: null, ':by' => admin_current_user()['id']]);

        $appStmt = $pdo->prepare('SELECT * FROM admission_applications WHERE id = :id');
        $appStmt->execute([':id' => $id]);
        $app = $appStmt->fetch();

        if ($app) {
            mail_send(
                $app['parent_email'],
                'Mise a jour de votre candidature ' . $app['reference_code'],
                "<p>Bonjour {$app['parent_name']},</p>
                 <p>Le statut de la candidature de <strong>{$app['child_first_name']} {$app['child_last_name']}</strong> (reference {$app['reference_code']}) a ete mis a jour :</p>
                 <p style=\"font-size:1.1rem;\"><strong>" . admission_status_label($newStatus) . "</strong></p>" .
                 ($note ? "<p>{$note}</p>" : '') .
                "<p>L'equipe Admissions — Ecole Ruban Vert</p>",
                'admission_application', $id
            );
        }

        $notice = 'Statut mis a jour et famille notifiee.';
    }
}

$stmt = $pdo->prepare(
    "SELECT a.*, l.name AS level_name FROM admission_applications a
     LEFT JOIN admission_levels l ON l.id = a.level_id WHERE a.id = :id"
);
$stmt->execute([':id' => $id]);
$app = $stmt->fetch();

if (!$app) {
    header('Location: index.php');
    exit;
}

$docStmt = $pdo->prepare('SELECT * FROM admission_documents WHERE application_id = :id ORDER BY uploaded_at');
$docStmt->execute([':id' => $id]);
$documents = $docStmt->fetchAll();

$histStmt = $pdo->prepare(
    'SELECT h.*, u.name AS admin_name FROM admission_status_history h
     LEFT JOIN admin_users u ON u.id = h.changed_by
     WHERE h.application_id = :id ORDER BY h.changed_at DESC'
);
$histStmt->execute([':id' => $id]);
$history = $histStmt->fetchAll();

$apptStmt = $pdo->prepare(
    'SELECT ap.*, s.slot_date, s.start_time, s.end_time, s.type FROM appointments ap
     JOIN appointment_slots s ON s.id = ap.slot_id WHERE ap.application_id = :id ORDER BY s.slot_date DESC'
);
$apptStmt->execute([':id' => $id]);
$appointments = $apptStmt->fetchAll();

$pageTitle = 'Candidature ' . $app['reference_code'];
$__active  = 'admissions';
include __DIR__ . '/../includes/layout-header.php';
?>

<div class="admin-header-row">
  <div>
    <h1><?= htmlspecialchars($app['child_first_name'] . ' ' . $app['child_last_name']) ?></h1>
    <p>Reference <strong><?= htmlspecialchars($app['reference_code']) ?></strong> · <?= htmlspecialchars($app['level_name'] ?? '—') ?> · Recu le <?= date('d/m/Y H:i', strtotime($app['created_at'])) ?></p>
  </div>
  <a href="index.php" class="btn-admin outline"><i class="fas fa-arrow-left"></i> Retour a la liste</a>
</div>

<?php if ($notice): ?><div class="admin-alert success"><?= htmlspecialchars($notice) ?></div><?php endif; ?>

<div style="display:grid; grid-template-columns:2fr 1fr; gap:1.5rem;">
  <div>
    <div class="admin-panel">
      <h2>Informations enfant</h2>
      <p><strong>Nom :</strong> <?= htmlspecialchars($app['child_first_name'] . ' ' . $app['child_last_name']) ?></p>
      <p><strong>Date de naissance :</strong> <?= date('d/m/Y', strtotime($app['child_dob'])) ?></p>
      <p><strong>Ecole actuelle :</strong> <?= htmlspecialchars($app['current_school'] ?: '—') ?></p>
      <p><strong>Annee d'entree souhaitee :</strong> <?= htmlspecialchars($app['entry_school_year'] ?: '—') ?></p>
      <?php if ($app['message']): ?><p><strong>Message :</strong> <?= nl2br(htmlspecialchars($app['message'])) ?></p><?php endif; ?>
    </div>

    <div class="admin-panel">
      <h2>Parent / tuteur</h2>
      <p><strong>Nom :</strong> <?= htmlspecialchars($app['parent_name']) ?></p>
      <p><strong>Email :</strong> <a href="mailto:<?= htmlspecialchars($app['parent_email']) ?>"><?= htmlspecialchars($app['parent_email']) ?></a></p>
      <p><strong>Telephone :</strong> <?= htmlspecialchars($app['parent_phone']) ?></p>
      <p><strong>Adresse :</strong> <?= htmlspecialchars($app['parent_address'] ?: '—') ?></p>
    </div>

    <div class="admin-panel">
      <h2>Documents fournis</h2>
      <?php if (!$documents): ?>
        <p style="color:var(--a-gray);">Aucun document uploade.</p>
      <?php else: ?>
        <ul class="admin-doc-list">
          <?php foreach ($documents as $d): ?>
            <li>
              <span><i class="fas fa-file"></i> <?= admission_doc_type_label($d['doc_type']) ?> — <?= htmlspecialchars($d['original_name']) ?></span>
              <a href="/ecolerubanvert/<?= htmlspecialchars($d['stored_path']) ?>" target="_blank">Telecharger</a>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
    </div>

    <?php if ($appointments): ?>
    <div class="admin-panel">
      <h2>Rendez-vous</h2>
      <?php foreach ($appointments as $a): ?>
        <p><i class="fas fa-calendar-check"></i> <?= ucfirst($a['type']) ?> le <?= date('d/m/Y', strtotime($a['slot_date'])) ?> (<?= substr($a['start_time'],0,5) ?>–<?= substr($a['end_time'],0,5) ?>) — <span class="badge badge-<?= $a['status'] ?>"><?= $a['status'] ?></span></p>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>
  </div>

  <div>
    <div class="admin-panel">
      <h2>Changer le statut</h2>
      <form method="post">
        <input type="hidden" name="csrf" value="<?= admin_csrf_token() ?>">
        <div class="form-group">
          <label>Nouveau statut</label>
          <select name="status">
            <?php foreach (['recu','en_cours','entretien_planifie','accepte','liste_attente','refuse'] as $s): ?>
              <option value="<?= $s ?>" <?= $app['status'] === $s ? 'selected' : '' ?>><?= admission_status_label($s) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group">
          <label>Note (envoyee par email a la famille si renseignee)</label>
          <textarea name="note" rows="3" placeholder="Optionnel"></textarea>
        </div>
        <button type="submit" class="btn-admin" style="width:100%; justify-content:center;"><i class="fas fa-check"></i> Mettre a jour &amp; notifier</button>
      </form>
    </div>

    <div class="admin-panel">
      <h2>Historique</h2>
      <ul class="status-timeline">
        <?php foreach ($history as $h): ?>
          <li>
            <span class="badge badge-<?= $h['status'] ?>"><?= admission_status_label($h['status']) ?></span>
            <?php if ($h['note']): ?><div style="font-size:.82rem; margin-top:.3rem;"><?= htmlspecialchars($h['note']) ?></div><?php endif; ?>
            <div class="when"><?= date('d/m/Y H:i', strtotime($h['changed_at'])) ?><?= $h['admin_name'] ? ' · ' . htmlspecialchars($h['admin_name']) : '' ?></div>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</div>

<?php include __DIR__ . '/../includes/layout-footer.php'; ?>
