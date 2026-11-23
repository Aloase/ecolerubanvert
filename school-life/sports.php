<?php
define('ROOT', dirname(__DIR__));
$pageTitle       = 'Sports | Ecole Ruban Vert';
$pageDesc        = 'ERV\'s sports programme develops teamwork, discipline and physical wellbeing through a wide range of sports.';
$pageBannerTitle = 'Sports at ERV';
$pageBannerDesc  = 'ERV\'s sports programme develops teamwork, discipline and physical wellbeing through a wide range of sports.';
$rootPath        = '../';
$r               = $rootPath;
$breadcrumbs     = [
    ['label'=>'School Life','url'=>'../school-life/index.php'],
    ['label'=>'Sports','url'=>'../school-life/sports.php'],
];

ob_start();
include ROOT . '/includes/sidebar.php';
$sidebarContent = ob_get_clean();

$mainContent = <<<'HTML'
<h2>Sports at ERV</h2>
<p>Sport plays a vital role in student development at ERV. Our comprehensive sports programme helps students build fitness, teamwork, resilience and leadership skills.</p>
<h3>Sports We Offer</h3>
<ul>
  <li>Football</li>
  <li>Basketball</li>
  <li>Tennis</li>
  <li>Swimming</li>
  <li>Athletics</li>
  <li>Volleyball</li>
</ul>
<div class="alert alert-success"><i class="fas fa-trophy"></i> ERV Football Team — 2024 AISA Regional Champions!</div>
HTML;

include ROOT . '/includes/page.php';
?>
