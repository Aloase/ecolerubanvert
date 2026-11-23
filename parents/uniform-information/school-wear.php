<?php
define('ROOT', dirname(__DIR__, 2));
$pageTitle       = 'School Wear | Ecole Ruban Vert';
$pageDesc        = 'ERV daily school uniform requirements for all year groups.';
$pageBannerTitle = 'School Wear';
$pageBannerDesc  = 'ERV daily school uniform requirements for all year groups.';
$rootPath        = '../../';
$r               = $rootPath;
$breadcrumbs     = [
    ['label'=>'Parents','url'=>'../../parents/index.php'],
    ['label'=>'Uniform Information','url'=>'../../parents/uniform-information/index.php'],
    ['label'=>'School Wear','url'=>'../../parents/uniform-information/school-wear.php'],
];

ob_start();
include ROOT . '/includes/sidebar.php';
$sidebarContent = ob_get_clean();

$mainContent = <<<'HTML'
<h2>School Wear</h2>
<p>The ERV daily uniform reflects our commitment to a professional, focused learning environment.</p>
<ul>
  <li>ERV branded polo shirt or blouse</li>
  <li>Navy trousers, skirt or shorts</li>
  <li>ERV jumper or cardigan</li>
  <li>Black school shoes</li>
</ul>
<div class="alert alert-info"><i class="fas fa-info-circle"></i> Uniform items can be purchased from the school uniform shop, open on select days each term.</div>
HTML;

include ROOT . '/includes/page.php';
?>
