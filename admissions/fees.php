<?php
define('ROOT', dirname(__DIR__));
$pageTitle       = 'Fees | Ecole Ruban Vert';
$pageDesc        = 'Find out about ERV school fees and what is included in your child\'s education.';
$pageBannerTitle = 'School Fees';
$pageBannerDesc  = 'Find out about ERV school fees and what is included in your child\'s education.';
$rootPath        = '../';
$r               = $rootPath;
$breadcrumbs     = [
    ['label'=>'Admissions','url'=>'../admissions/index.php'],
    ['label'=>'Fees','url'=>'../admissions/fees.php'],
];

ob_start();
include ROOT . '/includes/sidebar.php';
$sidebarContent = ob_get_clean();

$mainContent = <<<'HTML'
<h2>School Fees</h2>
<p>Our fees reflect the exceptional quality of education and facilities we provide. We are committed to transparency and will always provide full information on fees before you commit to joining ERV.</p>
<div class="alert alert-info"><i class="fas fa-info-circle"></i> Fee schedules are updated annually. For the most current fee information, please contact our Admissions Team directly.</div>
<h3>What Is Included?</h3>
<ul>
  <li>Full tuition across all subjects</li>
  <li>Access to all school facilities (gymnasium, auditorium, sports fields)</li>
  <li>IB registration and examination fees (for Diploma students)</li>
  <li>Comprehensive pastoral care and student support</li>
  <li>Library and digital learning resources</li>
</ul>
<h3>Additional Costs</h3>
<p>Some items are charged separately, including school uniform, certain extra-curricular activities, field trips, and optional music tuition. Full details are provided in the fee schedule.</p>
<a href="../contact.php" class="btn-primary"><i class="fas fa-file-invoice-dollar"></i> Request Fee Schedule</a>
HTML;

include ROOT . '/includes/page.php';
?>
