<?php
define('ROOT', dirname(__DIR__, 2));
$pageTitle       = 'PE Kit | Ecole Ruban Vert';
$pageDesc        = 'ERV Physical Education kit requirements for all students.';
$pageBannerTitle = 'PE Kit';
$pageBannerDesc  = 'ERV Physical Education kit requirements for all students.';
$rootPath        = '../../';
$r               = $rootPath;
$breadcrumbs     = [
    ['label'=>'Parents','url'=>'../../parents/index.php'],
    ['label'=>'Uniform Information','url'=>'../../parents/uniform-information/index.php'],
    ['label'=>'PE Kit','url'=>'../../parents/uniform-information/pe-kit.php'],
];

ob_start();
include ROOT . '/includes/sidebar.php';
$sidebarContent = ob_get_clean();

$mainContent = <<<'HTML'
<h2>PE Kit</h2>
<p>All students are required to wear the official ERV PE kit during Physical Education lessons and sports activities.</p>
<ul>
  <li>ERV branded polo shirt</li>
  <li>ERV branded shorts or tracksuit bottoms</li>
  <li>White sports socks</li>
  <li>Trainers/sports shoes</li>
</ul>
<div class="alert alert-info"><i class="fas fa-info-circle"></i> PE kit can be purchased from the school uniform shop.</div>
HTML;

include ROOT . '/includes/page.php';
?>
