<?php
require_once __DIR__ . '/../includes/auth.php';
admin_require_login();
require_once dirname(__DIR__, 2) . '/includes/admissions-helpers.php';

$pdo = db();
$levels = $pdo->query('SELECT id, name FROM admission_levels ORDER BY sort_order')->fetchAll();

$statusFilter = $_GET['status'] ?? '';
$levelFilter  = $_GET['level'] ?? '';
$search       = trim($_GET['q'] ?? '');

$where  = [];
$params = [];
if ($statusFilter !== '') { $where[] = 'a.status = :status'; $params[':status'] = $statusFilter; }
if ($levelFilter !== '')  { $where[] = 'a.level_id = :level'; $params[':level'] = $levelFilter; }
if ($search !== '') {
    $where[] = '(a.child_first_name LIKE :q OR a.child_last_name LIKE :q OR a.parent_name LIKE :q OR a.reference_code LIKE :q OR a.parent_email LIKE :q)';
    $params[':q'] = '%' . $search . '%';
}
$whereSql = $where ? ('WHERE ' . implode(' AND ', $where)) : '';

$stmt = $pdo->prepare(
    "SELECT a.*, l.name AS level_name FROM admission_applications a
     LEFT JOIN admission_levels l ON l.id = a.level_id
     $whereSql
     ORDER BY a.created_at DESC"
);
$stmt->execute($params);
$applications = $stmt->fetchAll();

$pageTitle = 'Candidatures';
$__active  = 'admissions';
include __DIR__ . '/../includes/layout-header.php';
?>

<div class="admin-header-row">
  <div>
    <h1>Candidatures admissions</h1>
    <p><?= count($applications) ?> resultat(s)</p>
  </div>
</div>

<div class="admin-panel">
  <form method="get" style="display:flex; gap:.75rem; flex-wrap:wrap; align-items:flex-end; margin-bottom:1.25rem;">
    <div class="form-group" style="margin:0; min-width:200px; flex:1;">
      <label>Recherche</label>
      <input type="text" name="q" value="<?= htmlspecialchars($search) ?>" placeholder="Nom, reference, email...">
    </div>
    <div class="form-group" style="margin:0;">
      <label>Statut</label>
      <select name="status">
        <option value="">Tous</option>
        <?php foreach (['recu','en_cours','entretien_planifie','accepte','liste_attente','refuse'] as $s): ?>
          <option value="<?= $s ?>" <?= $statusFilter === $s ? 'selected' : '' ?>><?= admission_status_label($s) ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="form-group" style="margin:0;">
      <label>Niveau</label>
      <select name="level">
        <option value="">Tous</option>
        <?php foreach ($levels as $lvl): ?>
          <option value="<?= $lvl['id'] ?>" <?= $levelFilter == $lvl['id'] ? 'selected' : '' ?>><?= htmlspecialchars($lvl['name']) ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <button type="submit" class="btn-admin"><i class="fas fa-filter"></i> Filtrer</button>
    <a href="index.php" class="btn-admin outline">Reinitialiser</a>
  </form>

  <table class="admin-table">
    <thead><tr><th>Reference</th><th>Enfant</th><th>Niveau</th><th>Parent</th><th>Contact</th><th>Statut</th><th>Recu le</th><th></th></tr></thead>
    <tbody>
      <?php if (!$applications): ?>
        <tr><td colspan="8" style="text-align:center; padding:1.5rem; color:var(--a-gray);">Aucun resultat.</td></tr>
      <?php endif; ?>
      <?php foreach ($applications as $app): ?>
      <tr>
        <td><strong><?= htmlspecialchars($app['reference_code']) ?></strong></td>
        <td><?= htmlspecialchars($app['child_first_name'] . ' ' . $app['child_last_name']) ?></td>
        <td><?= htmlspecialchars($app['level_name'] ?? '—') ?></td>
        <td><?= htmlspecialchars($app['parent_name']) ?></td>
        <td><?= htmlspecialchars($app['parent_email']) ?><br><small style="color:var(--a-gray);"><?= htmlspecialchars($app['parent_phone']) ?></small></td>
        <td><span class="badge badge-<?= $app['status'] ?>"><?= admission_status_label($app['status']) ?></span></td>
        <td><?= date('d/m/Y', strtotime($app['created_at'])) ?></td>
        <td><a href="view.php?id=<?= $app['id'] ?>" class="btn-admin small outline">Voir</a></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php include __DIR__ . '/../includes/layout-footer.php'; ?>
