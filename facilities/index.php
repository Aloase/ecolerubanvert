<?php
define('ROOT', dirname(__DIR__));
$pageTitle       = 'Facilities | Ecole Ruban Vert';
$pageDesc        = 'ERV boasts modern, purpose-built facilities supporting academic, sporting and creative excellence.';
$pageBannerTitle = 'Our Facilities';
$pageBannerDesc  = 'ERV boasts modern, purpose-built facilities supporting academic, sporting and creative excellence.';
$rootPath        = '../';
$r               = $rootPath;
$breadcrumbs     = [
    ['label'=>'Facilities','url'=>'../facilities/index.php'],
];

ob_start();
include ROOT . '/includes/sidebar.php';
$sidebarContent = ob_get_clean();

$mainContent = <<<'HTML'
<h2>Our Facilities</h2>
<p>ERV provides state-of-the-art facilities to support academic excellence, sporting achievement and creative expression.</p>
<div class="quick-links-grid" style="margin:2rem 0;">
  <a href="../facilities/auditorium.php" class="quick-link-card"><div class="quick-link-icon">🎭</div><div class="quick-link-title">Auditorium</div></a>
  <a href="../facilities/tennis.php" class="quick-link-card"><div class="quick-link-icon">🎾</div><div class="quick-link-title">Tennis</div></a>
  <a href="../facilities/gymnasium.php" class="quick-link-card"><div class="quick-link-icon">🏋️</div><div class="quick-link-title">Gymnasium</div></a>
  <a href="../facilities/dance.php" class="quick-link-card"><div class="quick-link-icon">💃</div><div class="quick-link-title">Dance</div></a>
  <a href="../facilities/stadium.php" class="quick-link-card"><div class="quick-link-icon">🏟️</div><div class="quick-link-title">Stadium</div></a>
</div>
HTML;

include ROOT . '/includes/page.php';
?>
