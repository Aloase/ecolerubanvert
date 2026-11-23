<?php
require_once __DIR__ . '/../includes/auth.php';
admin_require_login();

require_once dirname(__DIR__, 2) . '/includes/rentals-helpers.php';
require_once dirname(__DIR__, 2) . '/config/mailer.php';
require_once dirname(__DIR__, 2) . '/includes/invoice-pdf.php';

$pdo = db();
$id = (int)($_GET['id'] ?? 0);

$stmt = $pdo->prepare('SELECT b.*, s.name AS space_name, s.price_per_hour, s.price_per_day FROM rental_bookings b JOIN rental_spaces s ON s.id = b.space_id WHERE b.id = :id');
$stmt->execute([':id' => $id]);
$booking = $stmt->fetch();

if (!$booking) {
    header('Location: bookings.php');
    exit;
}

$notice = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && admin_csrf_check($_POST['csrf'] ?? null)) {
    $action = $_POST['action'] ?? '';

    if ($action === 'update_status') {
        $newStatus = $_POST['status'] ?? '';
        $note = trim($_POST['note'] ?? '');
        $amount = $_POST['quote_amount'] !== '' ? (float)$_POST['quote_amount'] : $booking['quote_amount'];

        if (in_array($newStatus, ['en_attente','confirmee','refusee','annulee'], true)) {
            $user = admin_current_user();
            $pdo->prepare('UPDATE rental_bookings SET status = :st, quote_amount = :amt, admin_note = :note, decided_by = :admin, decided_at = NOW() WHERE id = :id')
                ->execute([':st' => $newStatus, ':amt' => $amount, ':note' => ($note ?: null), ':admin' => $user['id'], ':id' => $id]);
            $pdo->prepare('INSERT INTO rental_booking_history (booking_id, status, note, admin_id) VALUES (:id, :st, :note, :admin)')
                ->execute([':id' => $id, ':st' => $newStatus, ':note' => ($note ?: null), ':admin' => $user['id']]);

            $subject = 'Mise a jour de votre demande de location — ' . rental_status_label($newStatus);
            $body = "<p>Bonjour {$booking['renter_name']},</p>
                     <p>Le statut de votre demande de location (reference <strong>{$booking['reference_code']}</strong>) pour <strong>" . htmlspecialchars($booking['space_name']) . "</strong> est desormais : <strong>" . rental_status_label($newStatus) . "</strong>.</p>";
            if ($note) $body .= "<p>Message de l'ecole : " . htmlspecialchars($note) . "</p>";
            $body .= "<p>L'equipe Ecole Ruban Vert.</p>";
            mail_send($booking['renter_email'], $subject, $body, 'rental_booking', $id);

            $notice = 'Statut mis a jour et demandeur notifie.';
            $stmt->execute([':id' => $id]);
            $booking = $stmt->fetch();
        }
    } elseif ($action === 'generate_invoice') {
        $invoiceNumber = $booking['invoice_number'] ?: rental_generate_invoice_number();
        $spaceInfo = ['name' => $booking['space_name']];
        $path = rental_generate_invoice_pdf($booking, $spaceInfo, $invoiceNumber);
        $pdo->prepare('UPDATE rental_bookings SET invoice_number = :num, invoice_path = :path WHERE id = :id')
            ->execute([':num' => $invoiceNumber, ':path' => $path, ':id' => $id]);
        $notice = 'Devis/facture PDF genere.';
        $stmt->execute([':id' => $id]);
        $booking = $stmt->fetch();
    }
}

$history = $pdo->prepare('SELECT h.*, a.name AS admin_name FROM rental_booking_history h LEFT JOIN admin_users a ON a.id = h.admin_id WHERE booking_id = :id ORDER BY created_at DESC');
$history->execute([':id' => $id]);
$history = $history->fetchAll();

$pageTitle = 'Reservation ' . $booking['reference_code'];
$__active  = 'rentals-bookings';
include __DIR__ . '/../includes/layout-header.php';
?>

<div class="admin-header-row">
  <div>
    <h1><?= htmlspecialchars($booking['space_name']) ?></h1>
    <p>Reference <strong><?= htmlspecialchars($booking['reference_code']) ?></strong> · <?= date('d/m/Y', strtotime($booking['booking_date'])) ?> · <?= substr($booking['start_time'],0,5) ?>–<?= substr($booking['end_time'],0,5) ?></p>
  </div>
  <a href="bookings.php" class="btn-admin small outline"><i class="fas fa-arrow-left"></i> Retour a la liste</a>
</div>

<?php if ($notice): ?><div class="admin-alert success"><?= htmlspecialchars($notice) ?></div><?php endif; ?>

<div class="admin-detail-grid" style="display:grid; grid-template-columns:1.4fr 1fr; gap:1.5rem;">
  <div>
    <div class="admin-panel">
      <h2>Demandeur</h2>
      <p><strong>Nom :</strong> <?= htmlspecialchars($booking['renter_name']) ?></p>
      <?php if ($booking['renter_org']): ?><p><strong>Organisation :</strong> <?= htmlspecialchars($booking['renter_org']) ?></p><?php endif; ?>
      <p><strong>Email :</strong> <a href="mailto:<?= htmlspecialchars($booking['renter_email']) ?>"><?= htmlspecialchars($booking['renter_email']) ?></a></p>
      <p><strong>Telephone :</strong> <?= htmlspecialchars($booking['renter_phone']) ?></p>
      <?php if ($booking['purpose']): ?><p><strong>Objet :</strong> <?= nl2br(htmlspecialchars($booking['purpose'])) ?></p><?php endif; ?>
    </div>

    <div class="admin-panel">
      <h2>Devis / Facture</h2>
      <p><strong>Montant :</strong> <?= $booking['quote_amount'] ? number_format((float)$booking['quote_amount'],0,',',' ') . ' FCFA' : 'Non defini' ?></p>
      <?php if ($booking['invoice_number']): ?><p><strong>N&deg; document :</strong> <?= htmlspecialchars($booking['invoice_number']) ?></p><?php endif; ?>
      <form method="post">
        <input type="hidden" name="csrf" value="<?= admin_csrf_token() ?>">
        <input type="hidden" name="action" value="generate_invoice">
        <button type="submit" class="btn-admin"><i class="fas fa-file-invoice"></i> <?= $booking['invoice_path'] ? 'Regenerer le PDF' : 'Generer devis/facture PDF' ?></button>
      </form>
      <?php if ($booking['invoice_path']): ?>
        <p style="margin-top:.75rem;"><a href="<?= admin_base_path() ?>/<?= htmlspecialchars($booking['invoice_path']) ?>" target="_blank"><i class="fas fa-download"></i> Telecharger le PDF</a></p>
      <?php endif; ?>
    </div>

    <div class="admin-panel">
      <h2>Historique</h2>
      <ul class="status-timeline">
        <?php foreach ($history as $h): ?>
          <li>
            <span class="badge badge-<?= $h['status'] === 'confirmee' ? 'accepte' : ($h['status'] === 'refusee' || $h['status'] === 'annulee' ? 'refuse' : 'attente') ?>"><?= rental_status_label($h['status']) ?></span>
            <?php if ($h['note']): ?><p style="margin:.35rem 0;"><?= htmlspecialchars($h['note']) ?></p><?php endif; ?>
            <span style="color:var(--a-gray); font-size:.8rem;"><?= date('d/m/Y H:i', strtotime($h['created_at'])) ?><?= $h['admin_name'] ? ' · ' . htmlspecialchars($h['admin_name']) : '' ?></span>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>

  <div>
    <div class="admin-panel">
      <h2>Changer le statut</h2>
      <form method="post">
        <input type="hidden" name="csrf" value="<?= admin_csrf_token() ?>">
        <input type="hidden" name="action" value="update_status">
        <div class="form-group">
          <label>Nouveau statut</label>
          <select name="status">
            <?php foreach (['en_attente','confirmee','refusee','annulee'] as $st): ?>
              <option value="<?= $st ?>" <?= $booking['status'] === $st ? 'selected' : '' ?>><?= rental_status_label($st) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group">
          <label>Montant du devis (FCFA)</label>
          <input type="number" step="0.01" name="quote_amount" value="<?= htmlspecialchars((string)($booking['quote_amount'] ?? '')) ?>">
        </div>
        <div class="form-group">
          <label>Note (envoyee par email au demandeur)</label>
          <textarea name="note" rows="3" placeholder="Optionnel"></textarea>
        </div>
        <button type="submit" class="btn-admin"><i class="fas fa-check"></i> Mettre a jour &amp; notifier</button>
      </form>
    </div>
  </div>
</div>

<?php include __DIR__ . '/../includes/layout-footer.php'; ?>
