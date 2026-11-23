<?php
define('ROOT', dirname(__DIR__));
require_once ROOT . '/config/db.php';
require_once ROOT . '/config/mailer.php';
require_once ROOT . '/includes/admissions-helpers.php';

$rootPath = '../';
$r        = $rootPath;

$errors  = [];
$success = null;
$prefRef = trim($_GET['ref'] ?? ($_POST['reference_code'] ?? ''));

// Creneaux ouverts, futurs, non complets
$slots = db()->query(
    "SELECT s.*, s.capacity - COALESCE((SELECT COUNT(*) FROM appointments a WHERE a.slot_id = s.id AND a.status='confirme'),0) AS remaining
     FROM appointment_slots s
     WHERE s.is_open = 1 AND s.slot_date >= CURDATE()
     HAVING remaining > 0
     ORDER BY s.slot_date, s.start_time"
)->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $slotId   = (int)($_POST['slot_id'] ?? 0);
    $fullName = trim($_POST['full_name'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $phone    = trim($_POST['phone'] ?? '');
    $refCode  = trim($_POST['reference_code'] ?? '');

    if (!$slotId)                                       $errors[] = 'Veuillez choisir un creneau.';
    if ($fullName === '')                                $errors[] = 'Le nom complet est requis.';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))      $errors[] = 'Adresse email invalide.';
    if ($phone === '')                                   $errors[] = 'Le telephone est requis.';

    $applicationId = null;
    if ($refCode !== '') {
        $stmt = db()->prepare('SELECT id FROM admission_applications WHERE reference_code = :ref LIMIT 1');
        $stmt->execute([':ref' => $refCode]);
        $app = $stmt->fetch();
        if ($app) $applicationId = $app['id'];
    }

    if (!$errors) {
        try {
            $pdo = db();
            $pdo->beginTransaction();

            // Verrouille et verifie la disponibilite au moment de la reservation
            $check = $pdo->prepare(
                'SELECT s.capacity, (SELECT COUNT(*) FROM appointments a WHERE a.slot_id = s.id AND a.status="confirme") AS taken
                 FROM appointment_slots s WHERE s.id = :id AND s.is_open = 1 FOR UPDATE'
            );
            $check->execute([':id' => $slotId]);
            $slotRow = $check->fetch();

            if (!$slotRow || $slotRow['taken'] >= $slotRow['capacity']) {
                $pdo->rollBack();
                $errors[] = 'Ce creneau vient d\'etre complet. Merci d\'en choisir un autre.';
            } else {
                $ins = $pdo->prepare(
                    'INSERT INTO appointments (slot_id, application_id, full_name, email, phone, status)
                     VALUES (:slot, :app, :name, :email, :phone, "confirme")'
                );
                $ins->execute([':slot' => $slotId, ':app' => $applicationId, ':name' => $fullName, ':email' => $email, ':phone' => $phone]);
                $newAppointmentId = (int)$pdo->lastInsertId();
                $pdo->commit();

                $slotInfo = $pdo->prepare('SELECT * FROM appointment_slots WHERE id = :id');
                $slotInfo->execute([':id' => $slotId]);
                $slot = $slotInfo->fetch();

                mail_send(
                    $email,
                    'Confirmation de votre rendez-vous — Ecole Ruban Vert',
                    "<p>Bonjour {$fullName},</p>
                     <p>Votre rendez-vous (" . htmlspecialchars($slot['type']) . ") est confirme le <strong>" . date('d/m/Y', strtotime($slot['slot_date'])) . "</strong>
                     de <strong>" . substr($slot['start_time'],0,5) . "</strong> a <strong>" . substr($slot['end_time'],0,5) . "</strong>.</p>
                     <p>A tres bientot, l'equipe Admissions ERV.</p>",
                    'appointment', $newAppointmentId ?: null
                );
                mail_send(
                    MAIL_ADMIN_ADDRESS,
                    'Nouveau rendez-vous reserve',
                    "<p>{$fullName} ({$email}, {$phone}) a reserve un creneau le " . date('d/m/Y', strtotime($slot['slot_date'])) . ".</p>"
                );

                $success = $slot;
            }
        } catch (Throwable $e) {
            if ($pdo->inTransaction()) $pdo->rollBack();
            $errors[] = 'Une erreur est survenue. Veuillez reessayer.';
        }
    }
}

$pageTitle       = 'Prendre rendez-vous | Ecole Ruban Vert';
$pageDesc        = 'Reservez une visite de l\'ecole ou un entretien d\'admission en ligne.';
$pageBannerTitle = 'Prendre rendez-vous';
$pageBannerDesc  = 'Choisissez un creneau pour une visite de l\'ecole ou un entretien d\'admission.';
$breadcrumbs     = [
    ['label'=>'Admissions','url'=>'../admissions/index.php'],
    ['label'=>'Rendez-vous','url'=>'../admissions/rendez-vous.php'],
];

include ROOT . '/includes/header.php';
?>

<section class="content-section">
  <div class="container" style="max-width:760px;">

    <?php if ($success): ?>
      <div style="background:#E8F5E9; padding:1.5rem; border-radius:12px;">
        <h3 style="color:#2E7D32; margin-top:0;"><i class="fas fa-circle-check"></i> Rendez-vous confirme !</h3>
        <p><?= ucfirst($success['type']) ?> le <strong><?= date('d/m/Y', strtotime($success['slot_date'])) ?></strong> de <strong><?= substr($success['start_time'],0,5) ?></strong> a <strong><?= substr($success['end_time'],0,5) ?></strong>.</p>
        <p>Un email de confirmation vous a ete envoye.</p>
      </div>
    <?php else: ?>

      <?php if ($errors): ?>
        <div style="background:#FFEBEE; color:#C62828; padding:1rem 1.25rem; border-radius:10px; margin-bottom:1.5rem;">
          <ul style="margin:0; padding-left:1.25rem;"><?php foreach ($errors as $e): ?><li><?= htmlspecialchars($e) ?></li><?php endforeach; ?></ul>
        </div>
      <?php endif; ?>

      <?php if (!$slots): ?>
        <div style="background:#FFF8E1; color:#E65100; padding:1.25rem; border-radius:10px;">
          Aucun creneau disponible pour le moment. Merci de reessayer plus tard ou de contacter l'ecole directement.
        </div>
      <?php else: ?>
      <form method="post" style="background:#fff; border:1px solid #E3E7E5; border-radius:12px; padding:1.75rem;">
        <div class="form-group" style="margin-bottom:1.25rem;">
          <label style="display:block; font-weight:600; font-size:.85rem; margin-bottom:.5rem;">Choisissez un creneau *</label>
          <div style="display:grid; grid-template-columns:repeat(auto-fill,minmax(220px,1fr)); gap:.75rem;">
            <?php foreach ($slots as $s): ?>
              <label style="border:1px solid #DDE3E0; border-radius:10px; padding:.85rem 1rem; cursor:pointer; display:block;">
                <input type="radio" name="slot_id" value="<?= $s['id'] ?>" required style="margin-right:.5rem;">
                <strong><?= date('d/m/Y', strtotime($s['slot_date'])) ?></strong><br>
                <span style="font-size:.85rem; color:var(--gray);"><?= ucfirst($s['type']) ?> · <?= substr($s['start_time'],0,5) ?>–<?= substr($s['end_time'],0,5) ?> · <?= $s['remaining'] ?> place(s)</span>
              </label>
            <?php endforeach; ?>
          </div>
        </div>

        <div class="form-grid" style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
          <div class="form-group">
            <label style="display:block; font-weight:600; font-size:.85rem; margin-bottom:.35rem;">Nom complet *</label>
            <input type="text" name="full_name" required style="width:100%; padding:.65rem .85rem; border:1px solid #DDE3E0; border-radius:8px;">
          </div>
          <div class="form-group">
            <label style="display:block; font-weight:600; font-size:.85rem; margin-bottom:.35rem;">Email *</label>
            <input type="email" name="email" required style="width:100%; padding:.65rem .85rem; border:1px solid #DDE3E0; border-radius:8px;">
          </div>
          <div class="form-group">
            <label style="display:block; font-weight:600; font-size:.85rem; margin-bottom:.35rem;">Telephone *</label>
            <input type="tel" name="phone" required style="width:100%; padding:.65rem .85rem; border:1px solid #DDE3E0; border-radius:8px;">
          </div>
          <div class="form-group">
            <label style="display:block; font-weight:600; font-size:.85rem; margin-bottom:.35rem;">Numero de reference (si candidature deja soumise)</label>
            <input type="text" name="reference_code" value="<?= htmlspecialchars($prefRef) ?>" placeholder="ERV-2026-XXXXX" style="width:100%; padding:.65rem .85rem; border:1px solid #DDE3E0; border-radius:8px;">
          </div>
        </div>

        <button type="submit" class="btn-primary" style="margin-top:1rem;"><i class="fas fa-calendar-check"></i> Confirmer le rendez-vous</button>
      </form>
      <?php endif; ?>
    <?php endif; ?>

  </div>
</section>

<?php include ROOT . '/includes/footer.php'; ?>
