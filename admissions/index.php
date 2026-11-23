<?php
define('ROOT', dirname(__DIR__));
$pageTitle       = 'Admissions | Ecole Ruban Vert';
$pageDesc        = 'Apply to Ecole Ruban Vert. Find out about our admissions process, fees and scholarship opportunities.';
$pageBannerTitle = 'Admissions';
$pageBannerDesc  = 'Apply to Ecole Ruban Vert. Find out about our admissions process, fees and scholarship opportunities.';
$rootPath        = '../';
$r               = $rootPath;
$breadcrumbs     = [
    ['label'=>'Admissions','url'=>'../admissions/index.php'],
];

ob_start();
include ROOT . '/includes/sidebar.php';
$sidebarContent = ob_get_clean();

$mainContent = <<<'HTML'
<h2>Admissions at ERV</h2>
<p>We welcome applications from families of all nationalities. ERV is an inclusive school that values diversity and believes every child deserves access to outstanding international education.</p>
<h3>Key Information</h3>
<ul>
  <li>Admissions are open throughout the year, subject to availability</li>
  <li>We offer places from Early Years (age 3) through IB Diploma (age 18)</li>
  <li>ERV is a bilingual school — English and French are both taught and used</li>
  <li>Scholarship opportunities are available for exceptional students</li>
</ul>
<h3>How to Apply</h3>
<p>Applications are processed through our Open Apply platform. Our Admissions Team is on hand to guide you through every step of the process.</p>
<a href="admissions/open-apply.php" class="btn-primary"><i class="fas fa-paper-plane"></i> Start Your Application</a>
HTML;

include ROOT . '/includes/page.php';
?>
