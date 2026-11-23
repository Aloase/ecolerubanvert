<?php
define('ROOT', dirname(__DIR__));
$pageTitle       = 'Dance | Ecole Ruban Vert';
$pageDesc        = 'ERV\'s dedicated dance studio supports creative movement and performance training.';
$pageBannerTitle = 'Dance Studio';
$pageBannerDesc  = 'ERV\'s dedicated dance studio supports creative movement and performance training.';
$rootPath        = '../';
$r               = $rootPath;
$breadcrumbs     = [
    ['label'=>'Facilities','url'=>'../facilities/index.php'],
    ['label'=>'Dance','url'=>'../facilities/dance.php'],
];

ob_start();
include ROOT . '/includes/sidebar.php';
$sidebarContent = ob_get_clean();

$mainContent = <<<'HTML'
<h2>Dance Studio</h2>
<p>Our dedicated dance studio provides a professional space for students to explore movement, choreography and performance across a range of dance styles.</p>
<div style="border-radius:var(--radius-lg);background:linear-gradient(135deg,#FCE4EC,#F06292);height:280px;display:flex;align-items:center;justify-content:center;font-size:5rem;margin:2rem 0;">💃</div>
HTML;

include ROOT . '/includes/page.php';
?>
