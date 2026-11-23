<?php
define('ROOT', dirname(__DIR__));
$pageTitle       = 'Stationery | Ecole Ruban Vert';
$pageDesc        = 'Find the ERV stationery list for your child\'s year group.';
$pageBannerTitle = 'Stationery List';
$pageBannerDesc  = 'Find the ERV stationery list for your child\'s year group.';
$rootPath        = '../';
$r               = $rootPath;
$breadcrumbs     = [
    ['label'=>'Parents','url'=>'../parents/index.php'],
    ['label'=>'Stationery','url'=>'../parents/stationery.php'],
];

ob_start();
include ROOT . '/includes/sidebar.php';
$sidebarContent = ob_get_clean();

$mainContent = <<<'HTML'
<h2>Stationery Lists</h2>
<p>Each year group has a specific stationery list to support learning throughout the year. Lists are shared with parents before the start of each academic year.</p>
<div class="alert alert-info"><i class="fas fa-info-circle"></i> Stationery lists are distributed via email and available at the school office each August.</div>
HTML;

include ROOT . '/includes/page.php';
?>
