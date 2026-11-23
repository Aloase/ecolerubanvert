<?php
define('ROOT', dirname(__DIR__));
$pageTitle       = 'Tennis | Ecole Ruban Vert';
$pageDesc        = 'ERV\'s tennis courts support both curricular PE lessons and competitive tennis training.';
$pageBannerTitle = 'Tennis Courts';
$pageBannerDesc  = 'ERV\'s tennis courts support both curricular PE lessons and competitive tennis training.';
$rootPath        = '../';
$r               = $rootPath;
$breadcrumbs     = [
    ['label'=>'Facilities','url'=>'../facilities/index.php'],
    ['label'=>'Tennis','url'=>'../facilities/tennis.php'],
];

ob_start();
include ROOT . '/includes/sidebar.php';
$sidebarContent = ob_get_clean();

$mainContent = <<<'HTML'
<h2>Tennis Courts</h2>
<p>ERV's tennis courts provide excellent facilities for students to develop their skills, whether through PE lessons, extra-curricular clubs or competitive fixtures.</p>
<div style="border-radius:var(--radius-lg);background:linear-gradient(135deg,#C8E6C9,#66BB6A);height:280px;display:flex;align-items:center;justify-content:center;font-size:5rem;margin:2rem 0;">🎾</div>
HTML;

include ROOT . '/includes/page.php';
?>
