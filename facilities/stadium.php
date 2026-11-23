<?php
define('ROOT', dirname(__DIR__));
$pageTitle       = 'Stadium | Ecole Ruban Vert';
$pageDesc        = 'ERV\'s outdoor stadium hosts football, athletics and major school sporting events.';
$pageBannerTitle = 'Stadium';
$pageBannerDesc  = 'ERV\'s outdoor stadium hosts football, athletics and major school sporting events.';
$rootPath        = '../';
$r               = $rootPath;
$breadcrumbs     = [
    ['label'=>'Facilities','url'=>'../facilities/index.php'],
    ['label'=>'Stadium','url'=>'../facilities/stadium.php'],
];

ob_start();
include ROOT . '/includes/sidebar.php';
$sidebarContent = ob_get_clean();

$mainContent = <<<'HTML'
<h2>Stadium</h2>
<p>Our outdoor stadium provides a superb venue for football, athletics and major sporting fixtures, including inter-school competitions and Sports Day.</p>
<div style="border-radius:var(--radius-lg);background:linear-gradient(135deg,#E0F2F1,#4DB6AC);height:280px;display:flex;align-items:center;justify-content:center;font-size:5rem;margin:2rem 0;">🏟️</div>
HTML;

include ROOT . '/includes/page.php';
?>
