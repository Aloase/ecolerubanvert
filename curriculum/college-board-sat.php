<?php
define('ROOT', dirname(__DIR__));
$pageTitle       = 'College Board SAT | Ecole Ruban Vert';
$pageDesc        = 'ERV offers College Board SAT preparation and registration for students pursuing university entry in the USA.';
$pageBannerTitle = 'College Board SAT';
$pageBannerDesc  = 'ERV offers College Board SAT preparation and registration for students pursuing university entry in the USA.';
$rootPath        = '../';
$r               = $rootPath;
$breadcrumbs     = [
    ['label'=>'Curriculum','url'=>'../curriculum/index.php'],
    ['label'=>'College Board SAT','url'=>'../curriculum/college-board-sat.php'],
];

ob_start();
include ROOT . '/includes/sidebar.php';
$sidebarContent = ob_get_clean();

$mainContent = <<<'HTML'
<h2>College Board SAT at ERV</h2>
<p>ERV is an approved College Board SAT testing centre, supporting students who wish to apply to universities in the United States and other institutions that require SAT scores for entry.</p>
<h3>What Is the SAT?</h3>
<p>The SAT (Scholastic Assessment Test) is a standardised test widely used for college admissions in the United States. The SAT tests students in Evidence-Based Reading &amp; Writing and Mathematics.</p>
<h3>SAT Preparation at ERV</h3>
<p>Our experienced teachers provide SAT preparation support, helping students develop the skills and strategies they need to achieve their best score. We also offer practice tests and resources to support independent study.</p>
<a href="https://www.collegeboard.org/" target="_blank" rel="noopener" class="btn-primary"><i class="fas fa-external-link-alt"></i> College Board Website</a>
HTML;

include ROOT . '/includes/page.php';
?>
