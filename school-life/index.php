<?php
define('ROOT', dirname(__DIR__));
$pageTitle       = 'School Life | Ecole Ruban Vert';
$pageDesc        = 'Discover the vibrant school life at ERV — from sports and music to house system and pastoral care.';
$pageBannerTitle = 'School Life at ERV';
$pageBannerDesc  = 'Discover the vibrant school life at ERV — from sports and music to house system and pastoral care.';
$rootPath        = '../';
$r               = $rootPath;
$breadcrumbs     = [
    ['label'=>'School Life','url'=>'../school-life/index.php'],
];

ob_start();
include ROOT . '/includes/sidebar.php';
$sidebarContent = ob_get_clean();

$mainContent = <<<'HTML'
<h2>School Life at ERV</h2>
<p>Life at ERV extends far beyond the classroom. Our students enjoy a rich programme of extra-curricular activities, sports, music, and community events that build character, friendships and lifelong memories.</p>
<div class="quick-links-grid" style="margin:2rem 0;">
  <a href="../school-life/sports.php" class="quick-link-card"><div class="quick-link-icon">⚽</div><div class="quick-link-title">Sports</div></a>
  <a href="../school-life/music-department.php" class="quick-link-card"><div class="quick-link-icon">🎵</div><div class="quick-link-title">Music</div></a>
  <a href="../school-life/extra-curricular.php" class="quick-link-card"><div class="quick-link-icon">🎨</div><div class="quick-link-title">Activities</div></a>
  <a href="../school-life/house-system.php" class="quick-link-card"><div class="quick-link-icon">🏠</div><div class="quick-link-title">Houses</div></a>
</div>
HTML;

include ROOT . '/includes/page.php';
?>
