<?php
define('ROOT', dirname(__DIR__));
$pageTitle       = 'Admissions Questions | Ecole Ruban Vert';
$pageDesc        = 'Answers to the most frequently asked questions about joining Ecole Ruban Vert.';
$pageBannerTitle = 'Admissions Questions';
$pageBannerDesc  = 'Answers to the most frequently asked questions about joining Ecole Ruban Vert.';
$rootPath        = '../';
$r               = $rootPath;
$breadcrumbs     = [
    ['label'=>'Admissions','url'=>'../admissions/index.php'],
    ['label'=>'Questions','url'=>'../admissions/questions.php'],
];

ob_start();
include ROOT . '/includes/sidebar.php';
$sidebarContent = ob_get_clean();

$mainContent = <<<'HTML'
<h2>Admissions Questions</h2>
<p>Have a question about joining ERV? We have compiled answers to the most frequently asked admissions questions below. If you cannot find what you are looking for, please do not hesitate to contact our Admissions Team.</p>
<div class="accordion">
  <div class="accordion-item">
    <div class="accordion-header">At what age can my child start at ERV? <span class="accordion-icon">+</span></div>
    <div class="accordion-body"><div class="accordion-content">ERV welcomes children from age 3 (Early Years / Nursery) through to age 18 (IB Diploma Year 2). We use Open Apply for all enrolments.</div></div>
  </div>
  <div class="accordion-item">
    <div class="accordion-header">Is ERV a bilingual school? <span class="accordion-icon">+</span></div>
    <div class="accordion-body"><div class="accordion-content">Yes! ERV is a fully bilingual school. Instruction is delivered in both English and French across all year groups, with additional language support available where needed.</div></div>
  </div>
  <div class="accordion-item">
    <div class="accordion-header">Can I apply mid-year? <span class="accordion-icon">+</span></div>
    <div class="accordion-body"><div class="accordion-content">Yes. We accept applications throughout the year, subject to availability. Please contact our Admissions Team to find out about current vacancies.</div></div>
  </div>
  <div class="accordion-item">
    <div class="accordion-header">What documents do I need to apply? <span class="accordion-icon">+</span></div>
    <div class="accordion-body"><div class="accordion-content">You will need: passport copies, recent school reports/transcripts, a passport photo, vaccination records, and contact details for a referee from your child&#39;s current school.</div></div>
  </div>
  <div class="accordion-item">
    <div class="accordion-header">Are there scholarship opportunities? <span class="accordion-icon">+</span></div>
    <div class="accordion-body"><div class="accordion-content">Yes. ERV offers academic scholarships and means-tested bursaries. Please contact our Admissions Team for further information.</div></div>
  </div>
</div>
HTML;

include ROOT . '/includes/page.php';
?>
