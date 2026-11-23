<?php
define('ROOT', dirname(__DIR__));
$pageTitle       = 'Exam Results | Ecole Ruban Vert';
$pageDesc        = 'ERV\'s outstanding IGCSE and IB Diploma exam results reflect our commitment to academic excellence.';
$pageBannerTitle = 'Exam Results & School Profile';
$pageBannerDesc  = 'ERV\'s outstanding IGCSE and IB Diploma exam results reflect our commitment to academic excellence.';
$rootPath        = '../';
$r               = $rootPath;
$breadcrumbs     = [
    ['label'=>'About Us','url'=>'../about-us/index.php'],
    ['label'=>'Exam Results','url'=>'../about-us/exam-results.php'],
];

ob_start();
include ROOT . '/includes/sidebar.php';
$sidebarContent = ob_get_clean();

$mainContent = <<<'HTML'
<h2>Exam Results &amp; School Profile</h2>
<p>ERV is proud of its outstanding academic record. Our results consistently place us among the leading international schools in Africa.</p>
<div class="alert alert-success"><i class="fas fa-trophy"></i> <strong>100% pass rate</strong> for International GCSE — 6th consecutive year</div>
<div class="alert alert-success"><i class="fas fa-trophy"></i> <strong>100% pass rate</strong> for IB Diploma and IB Bilingual Diploma — 6th consecutive year</div>
<h3>2024 Highlights</h3>
<table class="styled-table">
  <thead><tr><th>Metric</th><th>Result</th></tr></thead>
  <tbody>
    <tr><td>IGCSE Pass Rate</td><td>100%</td></tr>
    <tr><td>IGCSE High Grades (7/8/9)</td><td>62%</td></tr>
    <tr><td>IGCSE Grade 9 (Top Grade)</td><td>28%</td></tr>
    <tr><td>IBDP Pass Rate</td><td>100%</td></tr>
    <tr><td>Highest IBDP Score</td><td>43/45 (96%)</td></tr>
    <tr><td>Average IBDP Score</td><td>36/45 (80%)</td></tr>
  </tbody>
</table>
<p style="margin-top:1.5rem;">Top grades were achieved in IBDP English, French, Computer Science, Geography and Visual Arts, alongside the highest-ever result in International GCSE Further Mathematics.</p>
HTML;

include ROOT . '/includes/page.php';
?>
