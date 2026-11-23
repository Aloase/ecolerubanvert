<?php
define('ROOT', dirname(__DIR__));
require_once ROOT . '/config/db.php';
require_once ROOT . '/includes/admissions-helpers.php';

$rootPath = '../';
$r        = $rootPath;

$application = null;
$documents   = [];
$history     = [];
$appointments = [];
$notFound = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ref   = trim($_POST['reference_code'] ?? '');
    $email = trim($_POST['parent_email'] ?? '');

    $stmt = db()->prepare(
        'SELECT a.*, l.name AS level_name FROM admission_applications a
         LEFT JOIN admission_levels l ON l.id = a.level_id
         WHERE a.reference_code = :ref AND a.parent_email = :email LIMIT 1'
    );
    $stmt->execute([':ref' => $ref, ':email' => $email]);
    $application = $stmt->fetch();

    if (!$application) {
        $notFound = true;
    } else {
        $docStmt = db()->prepare('SELECT * FROM admission_documents WHERE application_id = :id ORDER BY uploaded_at');
        $docStmt->execute([':id' => $application['id']]);
        $documents = $docStmt->fetchAll();

        $histStmt = db()->prepare('SELECT * FROM admission_status_history WHERE application_id = :id ORDER BY changed_at DESC');
        $histStmt->execute([':id' => $application['id']]);
        $history = $histStmt->fetchAll();

        $apptStmt = db()->prepare(
            'SELECT ap.*, s.slot_date, s.start_time, s.end_time, s.type FROM appointments ap
             JOIN appointment_slots s ON s.id = ap.slot_id
             WHERE ap.application_id = :id ORDER BY s.slot_date DESC'
        );
        $apptStmt->execute([':id' => $application['id']]);
        $appointments = $apptStmt->fetchAll();
    }
}

$pageTitle       = 'Suivi de dossier | Ecole Ruban Vert';
$pageDesc        = 'Suivez l\'avancement de votre candidature a l\'Ecole Ruban Vert.';
$pageBannerTitle = 'Suivi de mon dossier';
$pageBannerDesc  = 'Retrouvez le statut de votre candidature grace a votre numero de reference.';
$robotsMeta      = 'noindex, nofollow';
$breadcrumbs     = [
    ['label'=>'Admissions','url'=>'../admissions/index.php'],
    ['label'=>'Suivi de dossier','url'=>'../admissions/suivi-dossier.php'],
];

include ROOT . '/includes/header.php';
?>

<section class="content-section">
  <div class="container" style="max-width:760px;">

    <form method="post" style="background:#fff; border:1px solid #E3E7E5; border-radius:12px; padding:1.75rem; margin-bottom:2rem; display:flex; gap:1rem; flex-wrap:wrap; align-items:flex-end;">
      <div style="flex:1; min-width:200px;">
        <label style="display:block; font-weight:600; font-size:.85rem; margin-bottom:.35rem;">Numero de reference</label>
        <input type="text" name="reference_code" required placeholder="ERV-2026-XXXXX" value="<?= htmlspecialchars($_POST['reference_code'] ?? '') ?>" style="width:100%; padding:.65rem .85rem; border:1px solid #DDE3E0; border-radius:8px;">
      </div>
      <div style="flex:1; min-width:200px;">
        <label style="display:block; font-weight:600; font-size:.85rem; margin-bottom:.35rem;">Email utilise lors de l'inscription</label>
        <input type="email" name="parent_email" required value="<?= htmlspecialchars($_POST['parent_email'] ?? '') ?>" style="width:100%; padding:.65rem .85rem; border:1px solid #DDE3E0; border-radius:8px;">
      </div>
      <button type="submit" class="btn-primary"><i class="fas fa-magnifying-glass"></i> Rechercher</button>
    </form>

    <?php if ($notFound): ?>
      <div style="background:#FFEBEE; color:#C62828; padding:1rem 1.25rem; border-radius:10px;">
        Aucun dossier trouve avec ces informations. Verifiez votre numero de reference et l'adresse email utilises.
      </div>
    <?php endif; ?>

    <?php if ($application): ?>
      <?php
        $statusSteps = ['recu','en_cours','entretien_planifie','accepte'];
        $currentIdx  = array_search($application['status'], $statusSteps, true);
      ?>
      <div style="background:#fff; border:1px solid #E3E7E5; border-radius:12px; padding:1.75rem; margin-bottom:1.5rem;">
        <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:.75rem; margin-bottom:1rem;">
          <div>
            <h3 style="margin:0;"><?= htmlspecialchars($application['child_first_name'] . ' ' . $application['child_last_name']) ?></h3>
            <p style="margin:.2rem 0 0; color:var(--gray);">Reference : <strong><?= htmlspecialchars($application['reference_code']) ?></strong> · Niveau : <?= htmlspecialchars($application['level_name'] ?? '—') ?></p>
          </div>
          <span class="badge badge-<?= $application['status'] ?>" style="padding:.4rem .9rem; border-radius:20px; font-weight:600; font-size:.8rem;"><?= admission_status_label($application['status']) ?></span>
        </div>

        <?php if (in_array($application['status'], ['liste_attente','refuse'], true)): ?>
          <p style="color:var(--gray);">Statut actuel : <strong><?= admission_status_label($application['status']) ?></strong>. Pour toute question, contactez l'equipe Admissions.</p>
        <?php else: ?>
        <div style="display:flex; gap:.5rem; margin:1.25rem 0;">
          <?php foreach ($statusSteps as $i => $step): ?>
            <div style="flex:1; text-align:center;">
              <div style="height:6px; border-radius:3px; background:<?= $i <= $currentIdx ? 'var(--green-primary,#01463C)' : '#E3E7E5' ?>; margin-bottom:.4rem;"></div>
              <span style="font-size:.7rem; color:var(--gray); text-transform:capitalize;"><?= str_replace('_',' ',admission_status_label($step)) ?></span>
            </div>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <?php if (!$appointments): ?>
          <a href="rendez-vous.php?ref=<?= urlencode($application['reference_code']) ?>" class="btn-secondary" style="background:transparent; color:var(--green-primary); border:1px solid var(--green-primary); display:inline-flex; margin-top:.5rem;">
            <i class="fas fa-calendar-plus"></i> Prendre rendez-vous pour une visite / un entretien
          </a>
        <?php endif; ?>
      </div>

      <?php if ($appointments): ?>
      <div style="background:#fff; border:1px solid #E3E7E5; border-radius:12px; padding:1.75rem; margin-bottom:1.5rem;">
        <h4 style="margin-top:0;">Rendez-vous</h4>
        <?php foreach ($appointments as $a): ?>
          <p>
            <i class="fas fa-calendar-check"></i>
            <?= ucfirst($a['type']) ?> le <?= date('d/m/Y', strtotime($a['slot_date'])) ?>
            de <?= substr($a['start_time'],0,5) ?> a <?= substr($a['end_time'],0,5) ?>
            — <span class="badge badge-<?= $a['status'] ?>"><?= $a['status'] ?></span>
          </p>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>

      <?php if ($documents): ?>
      <div style="background:#fff; border:1px solid #E3E7E5; border-radius:12px; padding:1.75rem;">
        <h4 style="margin-top:0;">Documents fournis</h4>
        <ul style="list-style:none; padding:0; margin:0;">
          <?php foreach ($documents as $d): ?>
            <li style="padding:.5rem 0; border-bottom:1px solid #F0F0F0;"><i class="fas fa-file-circle-check" style="color:var(--green-primary,#01463C);"></i> <?= admission_doc_type_label($d['doc_type']) ?> — <?= htmlspecialchars($d['original_name']) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <?php endif; ?>
    <?php endif; ?>

  </div>
</section>

<?php include ROOT . '/includes/footer.php'; ?>
