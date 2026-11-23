<?php
define('ROOT', dirname(__DIR__));
require_once ROOT . '/config/db.php';
require_once ROOT . '/includes/rentals-helpers.php';

$rootPath = '../';
$r        = $rootPath;

$booking = null;
$notFound = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ref   = trim($_POST['reference_code'] ?? '');
    $email = trim($_POST['renter_email'] ?? '');

    $stmt = db()->prepare('SELECT b.*, s.name AS space_name FROM rental_bookings b JOIN rental_spaces s ON s.id = b.space_id WHERE b.reference_code = :ref AND b.renter_email = :email LIMIT 1');
    $stmt->execute([':ref' => $ref, ':email' => $email]);
    $booking = $stmt->fetch();
    if (!$booking) $notFound = true;
}

if ($booking) {
    $hist = db()->prepare('SELECT * FROM rental_booking_history WHERE booking_id = :id ORDER BY created_at DESC');
    $hist->execute([':id' => $booking['id']]);
    $history = $hist->fetchAll();
}

$pageTitle       = 'Suivi de ma demande de location | Ecole Ruban Vert';
$pageDesc        = 'Suivez le statut de votre demande de location d\'espace.';
$pageBannerTitle = 'Suivi de ma demande';
$pageBannerDesc  = 'Retrouvez le statut de votre demande de location grace a votre numero de reference.';
$robotsMeta      = 'noindex, nofollow';
$breadcrumbs     = [
    ['label'=>"Location d'espaces",'url'=>'../location-espaces/catalogue.php'],
    ['label'=>'Suivi de ma demande','url'=>'../location-espaces/suivi.php'],
];

include ROOT . '/includes/header.php';
?>

<section class="content-section">
  <div class="container" style="max-width:700px;">

    <form method="post" style="background:#fff; border:1px solid #E3E7E5; border-radius:12px; padding:1.75rem; margin-bottom:2rem;">
      <div class="form-grid" style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
        <div class="form-group">
          <label style="display:block; font-weight:600; font-size:.85rem; margin-bottom:.35rem;">Numero de reference</label>
          <input type="text" name="reference_code" required placeholder="LOC-2026-XXXXX" value="<?= htmlspecialchars($_POST['reference_code'] ?? $_GET['ref'] ?? '') ?>" style="width:100%; padding:.65rem .85rem; border:1px solid #DDE3E0; border-radius:8px;">
        </div>
        <div class="form-group">
          <label style="display:block; font-weight:600; font-size:.85rem; margin-bottom:.35rem;">Email utilise lors de la demande</label>
          <input type="email" name="renter_email" required value="<?= htmlspecialchars($_POST['renter_email'] ?? '') ?>" style="width:100%; padding:.65rem .85rem; border:1px solid #DDE3E0; border-radius:8px;">
        </div>
      </div>
      <button type="submit" class="btn-primary" style="margin-top:1rem;"><i class="fas fa-magnifying-glass"></i> Rechercher</button>
    </form>

    <?php if ($notFound): ?>
      <div style="background:#FFEBEE; color:#C62828; padding:1rem 1.25rem; border-radius:10px;">Aucune demande trouvee avec ces informations.</div>
    <?php endif; ?>

    <?php if ($booking): ?>
      <div style="background:#fff; border:1px solid #E3E7E5; border-radius:12px; padding:1.75rem;">
        <h3 style="margin-top:0;"><?= htmlspecialchars($booking['space_name']) ?></h3>
        <p style="color:var(--gray);">Reference : <strong><?= htmlspecialchars($booking['reference_code']) ?></strong></p>
        <p><?= date('d/m/Y', strtotime($booking['booking_date'])) ?> · <?= substr($booking['start_time'],0,5) ?>–<?= substr($booking['end_time'],0,5) ?></p>

        <div style="margin:1.25rem 0;">
          <?php
          $statusColors = ['en_attente'=>'#F57C00','confirmee'=>'#2E7D32','refusee'=>'#C62828','annulee'=>'#757575'];
          $c = $statusColors[$booking['status']] ?? '#757575';
          ?>
          <span style="background:<?= $c ?>1A; color:<?= $c ?>; padding:.4rem 1rem; border-radius:20px; font-weight:600; font-size:.85rem;">
            <?= rental_status_label($booking['status']) ?>
          </span>
        </div>

        <?php if ($booking['quote_amount']): ?>
          <p>Montant estime : <strong><?= number_format((float)$booking['quote_amount'],0,',',' ') ?> FCFA</strong></p>
        <?php endif; ?>
        <?php if ($booking['invoice_path']): ?>
          <p><a href="<?= $r . htmlspecialchars($booking['invoice_path']) ?>" class="btn-secondary" target="_blank"><i class="fas fa-file-invoice"></i> Telecharger la facture / le devis</a></p>
        <?php endif; ?>

        <h4 style="margin-top:2rem;">Historique</h4>
        <ul style="list-style:none; padding:0; margin:0;">
          <?php foreach ($history as $h): ?>
            <li style="border-left:3px solid var(--green-primary); padding:.5rem 0 .5rem 1rem; margin-bottom:.5rem;">
              <strong><?= rental_status_label($h['status']) ?></strong>
              <?php if ($h['note']): ?><br><span style="color:var(--gray); font-size:.9rem;"><?= htmlspecialchars($h['note']) ?></span><?php endif; ?>
              <br><span style="color:var(--gray); font-size:.8rem;"><?= date('d/m/Y H:i', strtotime($h['created_at'])) ?></span>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

  </div>
</section>

<?php include ROOT . '/includes/footer.php'; ?>
