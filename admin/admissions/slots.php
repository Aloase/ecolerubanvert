<?php
require_once __DIR__ . '/../includes/auth.php';
admin_require_login();

$pdo = db();
$notice = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && admin_csrf_check($_POST['csrf'] ?? null)) {
    if (($_POST['action'] ?? '') === 'create') {
        $date  = $_POST['slot_date'] ?? '';
        $start = $_POST['start_time'] ?? '';
        $end   = $_POST['end_time'] ?? '';
        $type  = $_POST['type'] ?? 'visite';
        $cap   = max(1, (int)($_POST['capacity'] ?? 1));

        if ($date && $start && $end) {
            try {
                $stmt = $pdo->prepare(
                    'INSERT INTO appointment_slots (slot_date, start_time, end_time, type, capacity) VALUES (:d, :s, :e, :t, :c)'
                );
                $stmt->execute([':d' => $date, ':s' => $start, ':e' => $end, ':t' => $type, ':c' => $cap]);
                $notice = 'Creneau ajoute.';
            } catch (Throwable $e) {
                $notice = 'Ce creneau existe deja.';
            }
        }
    } elseif (($_POST['action'] ?? '') === 'toggle') {
        $id = (int)($_POST['id'] ?? 0);
        $pdo->prepare('UPDATE appointment_slots SET is_open = 1 - is_open WHERE id = :id')->execute([':id' => $id]);
        $notice = 'Creneau mis a jour.';
    } elseif (($_POST['action'] ?? '') === 'delete') {
        $id = (int)($_POST['id'] ?? 0);
        $pdo->prepare('DELETE FROM appointment_slots WHERE id = :id')->execute([':id' => $id]);
        $notice = 'Creneau supprime.';
    }
}

$slots = $pdo->query(
    "SELECT s.*, (SELECT COUNT(*) FROM appointments a WHERE a.slot_id = s.id AND a.status='confirme') AS booked
     FROM appointment_slots s ORDER BY s.slot_date DESC, s.start_time"
)->fetchAll();

$pageTitle = 'Creneaux de rendez-vous';
$__active  = 'slots';
include __DIR__ . '/../includes/layout-header.php';
?>

<div class="admin-header-row">
  <div><h1>Creneaux de rendez-vous</h1><p>Gerez les disponibilites pour les visites et entretiens.</p></div>
</div>

<?php if ($notice): ?><div class="admin-alert success"><?= htmlspecialchars($notice) ?></div><?php endif; ?>

<div class="admin-panel">
  <h2>Ajouter un creneau</h2>
  <form method="post" class="form-grid" style="display:grid; grid-template-columns:repeat(5,1fr); gap:1rem; align-items:end;">
    <input type="hidden" name="csrf" value="<?= admin_csrf_token() ?>">
    <input type="hidden" name="action" value="create">
    <div class="form-group"><label>Date</label><input type="date" name="slot_date" required></div>
    <div class="form-group"><label>Debut</label><input type="time" name="start_time" required></div>
    <div class="form-group"><label>Fin</label><input type="time" name="end_time" required></div>
    <div class="form-group">
      <label>Type</label>
      <select name="type"><option value="visite">Visite</option><option value="entretien">Entretien</option></select>
    </div>
    <div class="form-group"><label>Capacite</label><input type="number" name="capacity" min="1" value="1"></div>
    <div class="form-group" style="grid-column:1/-1;"><button type="submit" class="btn-admin"><i class="fas fa-plus"></i> Ajouter</button></div>
  </form>
</div>

<div class="admin-panel">
  <h2>Tous les creneaux</h2>
  <table class="admin-table">
    <thead><tr><th>Date</th><th>Horaire</th><th>Type</th><th>Places</th><th>Statut</th><th></th></tr></thead>
    <tbody>
      <?php if (!$slots): ?><tr><td colspan="6" style="text-align:center; padding:1.5rem; color:var(--a-gray);">Aucun creneau.</td></tr><?php endif; ?>
      <?php foreach ($slots as $s): ?>
      <tr>
        <td><?= date('d/m/Y', strtotime($s['slot_date'])) ?></td>
        <td><?= substr($s['start_time'],0,5) ?>–<?= substr($s['end_time'],0,5) ?></td>
        <td><?= ucfirst($s['type']) ?></td>
        <td><?= $s['booked'] ?> / <?= $s['capacity'] ?></td>
        <td><span class="badge <?= $s['is_open'] ? 'badge-accepte' : 'badge-refuse' ?>"><?= $s['is_open'] ? 'Ouvert' : 'Ferme' ?></span></td>
        <td style="display:flex; gap:.4rem;">
          <form method="post"><input type="hidden" name="csrf" value="<?= admin_csrf_token() ?>"><input type="hidden" name="action" value="toggle"><input type="hidden" name="id" value="<?= $s['id'] ?>"><button type="submit" class="btn-admin small outline"><?= $s['is_open'] ? 'Fermer' : 'Ouvrir' ?></button></form>
          <form method="post" onsubmit="return confirm('Supprimer ce creneau ?');"><input type="hidden" name="csrf" value="<?= admin_csrf_token() ?>"><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= $s['id'] ?>"><button type="submit" class="btn-admin small danger">Suppr.</button></form>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php include __DIR__ . '/../includes/layout-footer.php'; ?>
