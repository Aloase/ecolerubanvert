<?php
define('ROOT', dirname(__DIR__, 2));
$pageTitle       = 'Uniform Information | Ecole Ruban Vert';
$pageDesc        = 'Find ERV school uniform requirements for all year groups.';
$pageBannerTitle = 'Uniform Information';
$pageBannerDesc  = 'Find ERV school uniform requirements for all year groups.';
$rootPath        = '../../';
$r               = $rootPath;
$breadcrumbs     = [
    ['label'=>'Parents','url'=>'../../parents/index.php'],
    ['label'=>'Uniform Information','url'=>'../../parents/uniform-information/index.php'],
];

ob_start();
include ROOT . '/includes/sidebar.php';
$sidebarContent = ob_get_clean();

$mainContent = <<<'HTML'
<h2>Uniform Information</h2>
<p>ERV requires all students to wear the official school uniform, promoting a sense of identity, equality and school pride.</p>
<div class="quick-links-grid" style="margin:2rem 0;">
  <a href="../uniform-information/pe-kit.php" class="quick-link-card"><div class="quick-link-icon">🏃</div><div class="quick-link-title">PE Kit</div></a>
  <a href="../uniform-information/school-wear.php" class="quick-link-card"><div class="quick-link-icon">👔</div><div class="quick-link-title">School Wear</div></a>
</div>
HTML;

include ROOT . '/includes/page.php';
?>
