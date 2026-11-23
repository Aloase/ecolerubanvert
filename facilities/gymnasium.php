<?php
define('ROOT', dirname(__DIR__));
$pageTitle       = 'Gymnasium | Ecole Ruban Vert';
$pageDesc        = 'ERV\'s fully-equipped gymnasium supports PE lessons, indoor sports and fitness training.';
$pageBannerTitle = 'Gymnasium';
$pageBannerDesc  = 'ERV\'s fully-equipped gymnasium supports PE lessons, indoor sports and fitness training.';
$rootPath        = '../';
$r               = $rootPath;
$breadcrumbs     = [
    ['label'=>'Facilities','url'=>'../facilities/index.php'],
    ['label'=>'Gymnasium','url'=>'../facilities/gymnasium.php'],
];

ob_start();
include ROOT . '/includes/sidebar.php';
$sidebarContent = ob_get_clean();

$mainContent = <<<'HTML'
<h2>Gymnasium</h2>
<p>Our modern gymnasium is used for Physical Education lessons, indoor sports such as basketball and volleyball, and school assemblies.</p>
<div style="border-radius:var(--radius-lg);background:linear-gradient(135deg,#FFF3E0,#FFB74D);height:280px;display:flex;align-items:center;justify-content:center;font-size:5rem;margin:2rem 0;">🏋️</div>
HTML;

include ROOT . '/includes/page.php';
?>
