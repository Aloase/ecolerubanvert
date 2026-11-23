<?php
define('ROOT', dirname(__DIR__));
$pageTitle       = 'Yearbook 2024 | Ecole Ruban Vert';
$pageDesc        = 'View and download the ERV 2024 Yearbook, celebrating the achievements of our school community.';
$pageBannerTitle = 'Yearbook 2024';
$pageBannerDesc  = 'View and download the ERV 2024 Yearbook, celebrating the achievements of our school community.';
$rootPath        = '../';
$r               = $rootPath;
$breadcrumbs     = [
    ['label'=>'Parents','url'=>'../parents/index.php'],
    ['label'=>'Yearbook','url'=>'../parents/yearbook.php'],
];

ob_start();
include ROOT . '/includes/sidebar.php';
$sidebarContent = ob_get_clean();

$mainContent = <<<'HTML'
<h2>Yearbook 2024</h2>
<p>Our annual yearbook celebrates the achievements, memories and milestones of the ERV community throughout the academic year.</p>
<div style="border-radius:var(--radius-lg);background:linear-gradient(135deg,#C8E6C9,#4CAF50);height:300px;display:flex;align-items:center;justify-content:center;font-size:5rem;margin:2rem 0;">📖</div>
<a href="#" class="btn-primary"><i class="fas fa-download"></i> Download Yearbook (PDF)</a>
HTML;

include ROOT . '/includes/page.php';
?>
