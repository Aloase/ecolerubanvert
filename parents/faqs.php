<?php
define('ROOT', dirname(__DIR__));
$pageTitle       = 'FAQs | Ecole Ruban Vert';
$pageDesc        = 'Answers to common questions from ERV parents.';
$pageBannerTitle = 'Frequently Asked Questions';
$pageBannerDesc  = 'Answers to common questions from ERV parents.';
$rootPath        = '../';
$r               = $rootPath;
$breadcrumbs     = [
    ['label'=>'Parents','url'=>'../parents/index.php'],
    ['label'=>'FAQs','url'=>'../parents/faqs.php'],
];

ob_start();
include ROOT . '/includes/sidebar.php';
$sidebarContent = ob_get_clean();

$mainContent = <<<'HTML'
<h2>Frequently Asked Questions</h2>
<div class="accordion">
  <div class="accordion-item"><div class="accordion-header">What are the school hours? <span class="accordion-icon">+</span></div><div class="accordion-body"><div class="accordion-content">School hours are typically 7:30am to 3:30pm, Monday to Friday. Exact times vary slightly by year group.</div></div></div>
  <div class="accordion-item"><div class="accordion-header">Does ERV provide transport? <span class="accordion-icon">+</span></div><div class="accordion-body"><div class="accordion-content">Please contact our reception team for the latest information on school transport arrangements.</div></div></div>
  <div class="accordion-item"><div class="accordion-header">Is there a school canteen? <span class="accordion-icon">+</span></div><div class="accordion-body"><div class="accordion-content">Yes, ERV has an on-site canteen offering healthy, balanced meals for students.</div></div></div>
  <div class="accordion-item"><div class="accordion-header">How do I contact my child's teacher? <span class="accordion-icon">+</span></div><div class="accordion-body"><div class="accordion-content">Teachers can be contacted via email or through ManageBac. Reception can also help arrange a meeting.</div></div></div>
</div>
HTML;

include ROOT . '/includes/page.php';
?>
