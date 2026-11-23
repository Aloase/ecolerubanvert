<?php
require_once __DIR__ . '/../includes/auth.php';
admin_require_login();

require_once dirname(__DIR__, 2) . '/includes/rentals-helpers.php';

$pdo = db();

$status = $_GET['status'] ?? '';
$spaceId = $_GET['space_id'] ?? '';
$search = trim($_GET['q'] ?? '');

$where = ['1=1'];
$params = [];
if ($status !== '') { $where[] = 'b.status = :status'; $params[':status'] = $status; }
if ($spaceId !== '') { $where[] = 'b.space_id = :space_id'; $params[':space_id'] = $spaceId; }
if ($search !== '') {
    $where[] = '(b.renter_name LIKE :q OR b.reference_code LIKE :q OR b.renter_email LIKE :q)';
    $params[':q'] = '%' . $search . '%';
}

$sql = "SELECT b.*, s.name AS space_name FROM rental_bookings b JOIN rental_spaces s ON s.id = b.space_id
        WHERE " . implode(' AND ', $where) . " ORDER BY b.booking_date DESC, b.start_time DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$bookings = $stmt->fetchAll();

$spaces = $pdo->query('SELECT id, name FROM rental_spaces ORDER BY name')->fetchAll();

$pageTitle = 'Reservations';
$__active  = 'rentals-bookings';
include __DIR__ . '/../includes/layout-header.php';
?>

<div class="admin-header-row">
  <div><h1>Reservations</h1><p><?= count($bookings) ?> resultat(s)</p></div>
</div>

<div class="admin-panel">
  <form method="get" class="form-grid" style="display:grid; grid-template-columns:2fr 1fr 1fr auto auto; gap:1rem; align-items:end;">
    <div class="form-group"><label>Recherche</label><input type="text" name="q" value="<?= htmlspecialchars($search) ?>" placeholder="Nom, reference, email..."></div>
    <div class="form-group">
      <label>Statut</label>
      <select name="status">
        <option value="">Tous</option>
        <?php foreach (['en_attente','confirmee','refusee','annulee'] as $st): ?>
          <option value="<?= $st ?>" <?= $status === $st ? 'selected' : '' ?>><?= rental_status_label($st) ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="form-group">
      <label>Espace</label>
      <select name="space_id">
        <option value="">Tous</option>
        <?php foreach ($spaces as $s): ?><option value="<?= $s['id'] ?>" <?= $spaceId == $s['id'] ? 'selected' : '' ?>><?= htmlspecialchars($s['name']) ?></option><?php endforeach; ?>
      </select>
    </div>
    <div class="form-group"><button type="submit" class="btn-admin"><i class="fas fa-filter"></i> Filtrer</button></div>
    <div class="form-group"><a href="bookings.php">Reinitialiser</a></div>
  </form>
</div>

<div class="admin-panel">
  <table class="admin-table">
    <thead><tr><th>Reference</th><th>Espace</th><th>Date</th><th>Demandeur</th><th>Contact</th><th>Statut</th><th></th></tr></thead>
    <tbody>
      <?php if (!$bookings): ?><tr><td colspan="7" style="text-align:center; padding:1.5rem; color:var(--a-gray);">Aucune reservation.</td></tr><?php endif; ?>
      <?php foreach ($bookings as $b): ?>
      <tr>
        <td><strong><?= htmlspecialchars($b['reference_code']) ?></strong></td>
        <td><?= htmlspecialchars($b['space_name']) ?></td>
        <td><?= date('d/m/Y', strtotime($b['booking_date'])) ?><br><span style="color:var(--a-gray); font-size:.8rem;"><?= substr($b['start_time'],0,5) ?>–<?= substr($b['end_time'],0,5) ?></span></td>
        <td><?= htmlspecialchars($b['renter_name']) ?><?= $b['renter_org'] ? '<br><span style="color:var(--a-gray); font-size:.8rem;">'.htmlspecialchars($b['renter_org']).'</span>' : '' ?></td>
        <td><?= htmlspecialchars($b['renter_email']) ?><br><span style="color:var(--a-gray); font-size:.8rem;"><?= htmlspecialchars($b['renter_phone']) ?></span></td>
        <td><span class="badge badge-<?= $b['status'] === 'confirmee' ? 'accepte' : ($b['status'] === 'refusee' || $b['status'] === 'annulee' ? 'refuse' : 'attente') ?>"><?= rental_status_label($b['status']) ?></span></td>
        <td><a href="booking-view.php?id=<?= $b['id'] ?>" class="btn-admin small outline">Voir</a></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php include __DIR__ . '/../includes/layout-footer.php'; ?>
