<?php
require_once __DIR__ . '/includes/auth.php';
admin_require_login();

$pdo = db();
$counts = [
    'total'        => (int)$pdo->query("SELECT COUNT(*) FROM admission_applications")->fetchColumn(),
    'recu'         => (int)$pdo->query("SELECT COUNT(*) FROM admission_applications WHERE status='recu'")->fetchColumn(),
    'en_cours'     => (int)$pdo->query("SELECT COUNT(*) FROM admission_applications WHERE status='en_cours'")->fetchColumn(),
    'entretien'    => (int)$pdo->query("SELECT COUNT(*) FROM admission_applications WHERE status='entretien_planifie'")->fetchColumn(),
    'accepte'      => (int)$pdo->query("SELECT COUNT(*) FROM admission_applications WHERE status='accepte'")->fetchColumn(),
    'appointments' => (int)$pdo->query("SELECT COUNT(*) FROM appointments WHERE status='confirme'")->fetchColumn(),
];

$recent = $pdo->query(
    "SELECT a.*, l.name AS level_name FROM admission_applications a
     LEFT JOIN admission_levels l ON l.id = a.level_id
     ORDER BY a.created_at DESC LIMIT 6"
)->fetchAll();

$pageTitle = 'Tableau de bord';
$__active  = 'dashboard';
include __DIR__ . '/includes/layout-header.php';
?>

<div class="admin-header-row">
  <div>
    <h1>Tableau de bord</h1>
    <p>Vue d'ensemble des admissions et rendez-vous.</p>
  </div>
</div>

<div class="admin-cards">
  <div class="admin-card"><span class="num"><?= $counts['total'] ?></span><span class="label">Candidatures totales</span></div>
  <div class="admin-card"><span class="num"><?= $counts['recu'] ?></span><span class="label">Recues</span></div>
  <div class="admin-card"><span class="num"><?= $counts['en_cours'] ?></span><span class="label">En cours</span></div>
  <div class="admin-card"><span class="num"><?= $counts['entretien'] ?></span><span class="label">Entretien planifie</span></div>
  <div class="admin-card"><span class="num"><?= $counts['accepte'] ?></span><span class="label">Acceptees</span></div>
  <div class="admin-card"><span class="num"><?= $counts['appointments'] ?></span><span class="label">RDV confirmes</span></div>
</div>

<div class="admin-panel">
  <h2>Dernieres candidatures</h2>
  <table class="admin-table">
    <thead>
      <tr><th>Reference</th><th>Enfant</th><th>Niveau</th><th>Parent</th><th>Statut</th><th>Recu le</th><th></th></tr>
    </thead>
    <tbody>
      <?php if (!$recent): ?>
        <tr><td colspan="7" style="text-align:center; color:var(--a-gray); padding:1.5rem;">Aucune candidature pour le moment.</td></tr>
      <?php endif; ?>
      <?php foreach ($recent as $app): ?>
      <tr>
        <td><strong><?= htmlspecialchars($app['reference_code']) ?></strong></td>
        <td><?= htmlspecialchars($app['child_first_name'] . ' ' . $app['child_last_name']) ?></td>
        <td><?= htmlspecialchars($app['level_name'] ?? '—') ?></td>
        <td><?= htmlspecialchars($app['parent_name']) ?></td>
        <td><span class="badge badge-<?= $app['status'] ?>"><?= str_replace('_',' ',$app['status']) ?></span></td>
        <td><?= date('d/m/Y', strtotime($app['created_at'])) ?></td>
        <td><a href="admissions/view.php?id=<?= $app['id'] ?>" class="btn-admin small outline">Voir</a></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php include __DIR__ . '/includes/layout-footer.php'; ?>
