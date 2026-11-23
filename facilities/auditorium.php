<?php
define('ROOT', dirname(__DIR__));
$pageTitle       = 'Auditorium | Ecole Ruban Vert';
$pageDesc        = 'ERV\'s modern auditorium hosts concerts, performances and school assemblies.';
$pageBannerTitle = 'Auditorium';
$pageBannerDesc  = 'ERV\'s modern auditorium hosts concerts, performances and school assemblies.';
$rootPath        = '../';
$r               = $rootPath;
$breadcrumbs     = [
    ['label'=>'Facilities','url'=>'../facilities/index.php'],
    ['label'=>'Auditorium','url'=>'../facilities/auditorium.php'],
];

ob_start();
include ROOT . '/includes/sidebar.php';
$sidebarContent = ob_get_clean();

$mainContent = <<<'HTML'
<h2>Auditorium</h2>
<p>Our state-of-the-art auditorium provides a versatile space for concerts, theatre productions, assemblies and community events. Equipped with professional sound and lighting systems, it is a hub for creative expression at ERV.</p>
<div style="border-radius:var(--radius-lg);background:linear-gradient(135deg,#E8EAF6,#9FA8DA);height:280px;display:flex;align-items:center;justify-content:center;font-size:5rem;margin:2rem 0;">🎭</div>
HTML;

include ROOT . '/includes/page.php';
?>
