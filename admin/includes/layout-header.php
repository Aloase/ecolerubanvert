<?php
/**
 * Layout header admin — a inclure apres avoir defini $pageTitle (optionnel)
 * et apres admin_require_login() si la page est protegee.
 */
$__user = admin_current_user();
$__base = admin_base_path();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= isset($pageTitle) ? htmlspecialchars($pageTitle) . ' — ' : '' ?>Administration ERV</title>
<meta name="robots" content="noindex,nofollow">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="<?= $__base ?>/admin/assets/admin.css">
</head>
<body class="admin-body">

<?php if ($__user): ?>
<div class="admin-shell">
  <aside class="admin-sidebar">
    <div class="admin-brand">
      <span class="admin-brand-badge">ERV</span>
      <span>Administration</span>
    </div>
    <nav class="admin-nav">
      <a href="<?= $__base ?>/admin/index.php" class="admin-nav-link<?= ($__active ?? '') === 'dashboard' ? ' active' : '' ?>">
        <i class="fas fa-gauge-high"></i> Tableau de bord
      </a>
      <div class="admin-nav-group">Admissions</div>
      <a href="<?= $__base ?>/admin/admissions/index.php" class="admin-nav-link<?= ($__active ?? '') === 'admissions' ? ' active' : '' ?>">
        <i class="fas fa-file-lines"></i> Candidatures
      </a>
      <a href="<?= $__base ?>/admin/admissions/slots.php" class="admin-nav-link<?= ($__active ?? '') === 'slots' ? ' active' : '' ?>">
        <i class="fas fa-calendar-days"></i> Creneaux RDV
      </a>
      <a href="<?= $__base ?>/admin/admissions/appointments.php" class="admin-nav-link<?= ($__active ?? '') === 'appointments' ? ' active' : '' ?>">
        <i class="fas fa-handshake"></i> Rendez-vous
      </a>
      <div class="admin-nav-group">Location d'espaces</div>
      <a href="<?= $__base ?>/admin/rentals/index.php" class="admin-nav-link<?= ($__active ?? '') === 'rentals' ? ' active' : '' ?>">
        <i class="fas fa-door-open"></i> Espaces
      </a>
      <a href="<?= $__base ?>/admin/rentals/availability.php" class="admin-nav-link<?= ($__active ?? '') === 'rentals-availability' ? ' active' : '' ?>">
        <i class="fas fa-calendar-week"></i> Disponibilites
      </a>
      <a href="<?= $__base ?>/admin/rentals/bookings.php" class="admin-nav-link<?= ($__active ?? '') === 'rentals-bookings' ? ' active' : '' ?>">
        <i class="fas fa-clipboard-check"></i> Reservations
      </a>
    </nav>
    <div class="admin-user">
      <div class="admin-user-name"><?= htmlspecialchars($__user['name']) ?></div>
      <div class="admin-user-role"><?= htmlspecialchars($__user['role']) ?></div>
      <a href="<?= $__base ?>/admin/logout.php" class="admin-logout"><i class="fas fa-right-from-bracket"></i> Deconnexion</a>
    </div>
  </aside>
  <main class="admin-main">
<?php endif; ?>
