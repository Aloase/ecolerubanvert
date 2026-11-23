<?php
define('ROOT', dirname(__DIR__, 2));
$pageTitle       = 'Theory of Knowledge | Ecole Ruban Vert';
$pageDesc        = 'TOK is a core element of the IB Diploma that develops critical thinking and explores the nature of knowledge.';
$pageBannerTitle = 'Theory of Knowledge (TOK)';
$pageBannerDesc  = 'TOK is a core element of the IB Diploma that develops critical thinking and explores the nature of knowledge.';
$rootPath        = '../../';
$r               = $rootPath;
$breadcrumbs     = [
    ['label'=>'Curriculum','url'=>'../../curriculum/index.php'],
    ['label'=>'IBDP','url'=>'../../curriculum/ibdp/index.php'],
    ['label'=>'TOK','url'=>'../../curriculum/ibdp/tok.php'],
];

ob_start();
include ROOT . '/includes/sidebar.php';
$sidebarContent = ob_get_clean();

$mainContent = <<<'HTML'
<h2>Theory of Knowledge (TOK)</h2>
<p>Theory of Knowledge is a unique feature of the IB Diploma Programme. It encourages students to reflect on the nature of knowledge and how we know what we claim to know.</p>
<h3>What Is TOK?</h3>
<p>TOK is an interdisciplinary course that challenges students to think critically about knowledge itself — examining it across different areas of knowledge such as the Natural Sciences, Human Sciences, History, the Arts, Ethics, and Mathematics.</p>
<h3>Assessment</h3>
<p>TOK is assessed through a 1,600-word exhibition essay and a TOK presentation. Together with the Extended Essay, TOK contributes up to 3 bonus points to the IB Diploma score.</p>
HTML;

include ROOT . '/includes/page.php';
?>
