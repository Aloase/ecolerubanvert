<?php
require_once __DIR__ . '/../includes/auth.php';
admin_require_login();

$pdo = db();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && admin_csrf_check($_POST['csrf'] ?? null)) {
    $id     = (int)($_POST['id'] ?? 0);
    $status = $_POST['status'] ?? '';
    if (in_array($status, ['confirme','annule','honore','absent'], true)) {
        $pdo->prepare('UPDATE appointments SET status = :s WHERE id = :id')->execute([':s' => $status, ':id' => $id]);
    }
}

$appointments = $pdo->query(
    "SELECT ap.*, s.slot_date, s.start_time, s.end_time, s.type, a.reference_code
     FROM appointments ap
     JOIN appointment_slots s ON s.id = ap.slot_id
     LEFT JOIN admission_applications a ON a.id = ap.application_id
     ORDER BY s.slot_date DESC, s.start_time"
)->fetchAll();

$pageTitle = 'Rendez-vous';
$__active  = 'appointments';
include __DIR__ . '/../includes/layout-header.php';
?>

<div class="admin-header-row">
  <div><h1>Rendez-vous</h1><p>Visites et entretiens reserves par les familles.</p></div>
</div>

<div class="admin-panel">
  <table class="admin-table">
    <thead><tr><th>Date</th><th>Type</th><th>Nom</th><th>Contact</th><th>Reference candidature</th><th>Statut</th><th></th></tr></thead>
    <tbody>
      <?php if (!$appointments): ?><tr><td colspan="7" style="text-align:center; padding:1.5rem; color:var(--a-gray);">Aucun rendez-vous.</td></tr><?php endif; ?>
      <?php foreach ($appointments as $a): ?>
      <tr>
        <td><?= date('d/m/Y', strtotime($a['slot_date'])) ?> <?= substr($a['start_time'],0,5) ?></td>
        <td><?= ucfirst($a['type']) ?></td>
        <td><?= htmlspecialchars($a['full_name']) ?></td>
        <td><?= htmlspecialchars($a['email']) ?><br><small style="color:var(--a-gray);"><?= htmlspecialchars($a['phone']) ?></small></td>
        <td><?= $a['reference_code'] ? htmlspecialchars($a['reference_code']) : '—' ?></td>
        <td><span class="badge badge-<?= $a['status'] ?>"><?= $a['status'] ?></span></td>
        <td>
          <form method="post" style="display:flex; gap:.3rem;">
            <input type="hidden" name="csrf" value="<?= admin_csrf_token() ?>">
            <input type="hidden" name="id" value="<?= $a['id'] ?>">
            <select name="status" onchange="this.form.submit()" style="font-size:.78rem; padding:.3rem;">
              <?php foreach (['confirme','honore','absent','annule'] as $st): ?>
                <option value="<?= $st ?>" <?= $a['status'] === $st ? 'selected' : '' ?>><?= $st ?></option>
              <?php endforeach; ?>
            </select>
          </form>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php include __DIR__ . '/../includes/layout-footer.php'; ?>
