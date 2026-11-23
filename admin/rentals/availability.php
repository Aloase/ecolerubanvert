<?php
require_once __DIR__ . '/../includes/auth.php';
admin_require_login();

require_once dirname(__DIR__, 2) . '/includes/rentals-helpers.php';

$pdo = db();
$notice = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && admin_csrf_check($_POST['csrf'] ?? null)) {
    $action = $_POST['action'] ?? '';

    if ($action === 'add_recurring') {
        $spaceId = (int)($_POST['space_id'] ?? 0);
        $weekday = (int)($_POST['weekday'] ?? 0);
        $start   = $_POST['start_time'] ?? '';
        $end     = $_POST['end_time'] ?? '';
        if ($spaceId && $start && $end) {
            $pdo->prepare('INSERT INTO rental_recurring_slots (space_id, weekday, start_time, end_time) VALUES (:sid, :wd, :s, :e)')
                ->execute([':sid' => $spaceId, ':wd' => $weekday, ':s' => $start, ':e' => $end]);
            $notice = 'Disponibilite recurrente ajoutee.';
        }
    } elseif ($action === 'delete_recurring') {
        $pdo->prepare('DELETE FROM rental_recurring_slots WHERE id = :id')->execute([':id' => (int)($_POST['id'] ?? 0)]);
        $notice = 'Disponibilite recurrente supprimee.';
    } elseif ($action === 'add_exclusion') {
        $spaceId = $_POST['space_id'] !== '' ? (int)$_POST['space_id'] : null;
        $start   = $_POST['start_date'] ?? '';
        $end     = $_POST['end_date'] ?? '';
        $reason  = trim($_POST['reason'] ?? '');
        if ($start && $end) {
            $pdo->prepare('INSERT INTO rental_exclusions (space_id, start_date, end_date, reason) VALUES (:sid, :s, :e, :r)')
                ->execute([':sid' => $spaceId, ':s' => $start, ':e' => $end, ':r' => ($reason ?: null)]);
            $notice = 'Periode d\'exclusion ajoutee.';
        }
    } elseif ($action === 'delete_exclusion') {
        $pdo->prepare('DELETE FROM rental_exclusions WHERE id = :id')->execute([':id' => (int)($_POST['id'] ?? 0)]);
        $notice = 'Exclusion supprimee.';
    }
}

$spaces = $pdo->query('SELECT id, name FROM rental_spaces ORDER BY name')->fetchAll();

$recurring = $pdo->query(
    'SELECT r.*, s.name AS space_name FROM rental_recurring_slots r JOIN rental_spaces s ON s.id = r.space_id ORDER BY s.name, r.weekday, r.start_time'
)->fetchAll();

$exclusions = $pdo->query(
    'SELECT e.*, s.name AS space_name FROM rental_exclusions e LEFT JOIN rental_spaces s ON s.id = e.space_id ORDER BY e.start_date DESC'
)->fetchAll();

$pageTitle = 'Disponibilites';
$__active  = 'rentals-availability';
include __DIR__ . '/../includes/layout-header.php';
?>

<div class="admin-header-row">
  <div><h1>Disponibilites</h1><p>Creneaux recurrents et periodes d'exclusion (vacances, evenements internes).</p></div>
</div>

<?php if ($notice): ?><div class="admin-alert success"><?= htmlspecialchars($notice) ?></div><?php endif; ?>

<div class="admin-panel">
  <h2>Ajouter une disponibilite recurrente</h2>
  <form method="post" class="form-grid" style="display:grid; grid-template-columns:repeat(5,1fr); gap:1rem; align-items:end;">
    <input type="hidden" name="csrf" value="<?= admin_csrf_token() ?>">
    <input type="hidden" name="action" value="add_recurring">
    <div class="form-group">
      <label>Espace</label>
      <select name="space_id" required>
        <?php foreach ($spaces as $s): ?><option value="<?= $s['id'] ?>"><?= htmlspecialchars($s['name']) ?></option><?php endforeach; ?>
      </select>
    </div>
    <div class="form-group">
      <label>Jour</label>
      <select name="weekday">
        <?php foreach ([1=>'Lundi',2=>'Mardi',3=>'Mercredi',4=>'Jeudi',5=>'Vendredi',6=>'Samedi',0=>'Dimanche'] as $val => $label): ?>
          <option value="<?= $val ?>"><?= $label ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="form-group"><label>Debut</label><input type="time" name="start_time" required></div>
    <div class="form-group"><label>Fin</label><input type="time" name="end_time" required></div>
    <div class="form-group"><button type="submit" class="btn-admin"><i class="fas fa-plus"></i> Ajouter</button></div>
  </form>
</div>

<div class="admin-panel">
  <h2>Disponibilites recurrentes</h2>
  <table class="admin-table">
    <thead><tr><th>Espace</th><th>Jour</th><th>Horaire</th><th></th></tr></thead>
    <tbody>
      <?php if (!$recurring): ?><tr><td colspan="4" style="text-align:center; padding:1.5rem; color:var(--a-gray);">Aucune disponibilite recurrente.</td></tr><?php endif; ?>
      <?php foreach ($recurring as $rec): ?>
      <tr>
        <td><?= htmlspecialchars($rec['space_name']) ?></td>
        <td><?= rental_weekday_label((int)$rec['weekday']) ?></td>
        <td><?= substr($rec['start_time'],0,5) ?>–<?= substr($rec['end_time'],0,5) ?></td>
        <td><form method="post" onsubmit="return confirm('Supprimer ?');"><input type="hidden" name="csrf" value="<?= admin_csrf_token() ?>"><input type="hidden" name="action" value="delete_recurring"><input type="hidden" name="id" value="<?= $rec['id'] ?>"><button type="submit" class="btn-admin small danger">Suppr.</button></form></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<div class="admin-panel">
  <h2>Ajouter une periode d'exclusion</h2>
  <form method="post" class="form-grid" style="display:grid; grid-template-columns:repeat(4,1fr); gap:1rem; align-items:end;">
    <input type="hidden" name="csrf" value="<?= admin_csrf_token() ?>">
    <input type="hidden" name="action" value="add_exclusion">
    <div class="form-group">
      <label>Espace (vide = tous)</label>
      <select name="space_id">
        <option value="">Tous les espaces</option>
        <?php foreach ($spaces as $s): ?><option value="<?= $s['id'] ?>"><?= htmlspecialchars($s['name']) ?></option><?php endforeach; ?>
      </select>
    </div>
    <div class="form-group"><label>Du</label><input type="date" name="start_date" required></div>
    <div class="form-group"><label>Au</label><input type="date" name="end_date" required></div>
    <div class="form-group"><label>Raison</label><input type="text" name="reason" placeholder="Vacances scolaires, evenement..."></div>
    <div class="form-group" style="grid-column:1/-1;"><button type="submit" class="btn-admin"><i class="fas fa-plus"></i> Ajouter l'exclusion</button></div>
  </form>
</div>

<div class="admin-panel">
  <h2>Periodes d'exclusion</h2>
  <table class="admin-table">
    <thead><tr><th>Espace</th><th>Periode</th><th>Raison</th><th></th></tr></thead>
    <tbody>
      <?php if (!$exclusions): ?><tr><td colspan="4" style="text-align:center; padding:1.5rem; color:var(--a-gray);">Aucune exclusion.</td></tr><?php endif; ?>
      <?php foreach ($exclusions as $ex): ?>
      <tr>
        <td><?= $ex['space_name'] ? htmlspecialchars($ex['space_name']) : 'Tous les espaces' ?></td>
        <td><?= date('d/m/Y', strtotime($ex['start_date'])) ?> — <?= date('d/m/Y', strtotime($ex['end_date'])) ?></td>
        <td><?= htmlspecialchars((string)$ex['reason']) ?></td>
        <td><form method="post" onsubmit="return confirm('Supprimer ?');"><input type="hidden" name="csrf" value="<?= admin_csrf_token() ?>"><input type="hidden" name="action" value="delete_exclusion"><input type="hidden" name="id" value="<?= $ex['id'] ?>"><button type="submit" class="btn-admin small danger">Suppr.</button></form></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php include __DIR__ . '/../includes/layout-footer.php'; ?>
