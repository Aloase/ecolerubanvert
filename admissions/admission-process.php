<?php
define('ROOT', dirname(__DIR__));
$pageTitle       = 'Admission Process | Ecole Ruban Vert';
$pageDesc        = 'Find out how to apply to ERV — a step-by-step guide to our admissions process.';
$pageBannerTitle = 'Admission Process';
$pageBannerDesc  = 'Find out how to apply to ERV — a step-by-step guide to our admissions process.';
$rootPath        = '../';
$r               = $rootPath;
$breadcrumbs     = [
    ['label'=>'Admissions','url'=>'../admissions/index.php'],
    ['label'=>'Admission Process','url'=>'../admissions/admission-process.php'],
];

ob_start();
include ROOT . '/includes/sidebar.php';
$sidebarContent = ob_get_clean();

$mainContent = <<<'HTML'
<h2>Admission Process</h2>
<p>Our admission process is designed to be straightforward and supportive. We welcome families at any time of the year and will work with you to ensure a smooth transition into the ERV community.</p>
<div class="accordion">
  <div class="accordion-item">
    <div class="accordion-header">Step 1: Enquiry &amp; Tour <span class="accordion-icon">+</span></div>
    <div class="accordion-body"><div class="accordion-content">Contact our Admissions Team to arrange a school tour and learn more about ERV. We encourage all prospective families to visit us in person.</div></div>
  </div>
  <div class="accordion-item">
    <div class="accordion-header">Step 2: Submit Application <span class="accordion-icon">+</span></div>
    <div class="accordion-body"><div class="accordion-content">Complete the online application form via our Open Apply portal. You will need to provide previous school reports, passport copies and other supporting documents.</div></div>
  </div>
  <div class="accordion-item">
    <div class="accordion-header">Step 3: Assessment (where applicable) <span class="accordion-icon">+</span></div>
    <div class="accordion-body"><div class="accordion-content">Depending on the year group, students may be invited to attend an assessment day to help us understand their learning needs and place them appropriately.</div></div>
  </div>
  <div class="accordion-item">
    <div class="accordion-header">Step 4: Offer of Place <span class="accordion-icon">+</span></div>
    <div class="accordion-body"><div class="accordion-content">Successful applicants will receive a formal offer of a place. To confirm the place, you will need to complete the enrolment forms and pay the registration fee.</div></div>
  </div>
  <div class="accordion-item">
    <div class="accordion-header">Step 5: Welcome to ERV! <span class="accordion-icon">+</span></div>
    <div class="accordion-body"><div class="accordion-content">Our Admissions and Pastoral teams will ensure your child settles in quickly and happily. A buddy system pairs new students with established pupils to help them feel at home.</div></div>
  </div>
</div>
HTML;

include ROOT . '/includes/page.php';
?>
