<?php
define('ROOT', dirname(__DIR__));
$pageTitle       = 'Scholarship & Bursaries | Ecole Ruban Vert';
$pageDesc        = 'Learn about ERV scholarship and bursary opportunities for exceptional students.';
$pageBannerTitle = 'Scholarship & Bursaries';
$pageBannerDesc  = 'Learn about ERV scholarship and bursary opportunities for exceptional students.';
$rootPath        = '../';
$r               = $rootPath;
$breadcrumbs     = [
    ['label'=>'Admissions','url'=>'../admissions/index.php'],
    ['label'=>'Scholarships & Bursaries','url'=>'../admissions/scholarships.php'],
];

ob_start();
include ROOT . '/includes/sidebar.php';
$sidebarContent = ob_get_clean();

$mainContent = <<<'HTML'
<h2>Scholarship &amp; Bursaries</h2>
<p>ERV is committed to making an exceptional international education accessible to talented students from all backgrounds. We offer a range of scholarships and bursaries to support outstanding pupils.</p>
<h3>Academic Scholarships</h3>
<p>Academic scholarships are awarded to students who demonstrate exceptional academic ability. Candidates are assessed through examination and interview.</p>
<h3>Bursaries</h3>
<p>Means-tested bursaries are available to families who would not otherwise be able to afford ERV fees. Bursary awards are based on financial need and academic merit.</p>
<h3>How to Apply</h3>
<p>To apply for a scholarship or bursary, please contact our Admissions Team. Scholarship and bursary applications are reviewed annually and places are limited.</p>
<a href="../contact.php" class="btn-primary"><i class="fas fa-envelope"></i> Enquire About Scholarships</a>
HTML;

include ROOT . '/includes/page.php';
?>
