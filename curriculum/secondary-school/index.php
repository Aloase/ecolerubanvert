<?php
define('ROOT', dirname(__DIR__, 2));
$pageTitle       = 'Secondary School | Ecole Ruban Vert';
$pageDesc        = 'ERV Secondary School offers the IMYC (Years 7-9) and International GCSE (Years 10-11) programmes.';
$pageBannerTitle = 'Secondary School';
$pageBannerDesc  = 'ERV Secondary School offers the IMYC (Years 7-9) and International GCSE (Years 10-11) programmes.';
$rootPath        = '../../';
$r               = $rootPath;
$breadcrumbs     = [
    ['label'=>'Curriculum','url'=>'../../curriculum/index.php'],
    ['label'=>'Secondary School','url'=>'../../curriculum/secondary-school/index.php'],
];

ob_start();
include ROOT . '/includes/sidebar.php';
$sidebarContent = ob_get_clean();

$mainContent = <<<'HTML'
<h2>Secondary School at ERV</h2>
<p>ERV Secondary School offers an engaging and rigorous curriculum for students aged 11 to 16. We use the International Middle Years Curriculum (IMYC) for Years 7–9 and internationally-recognised Edexcel IGCSE qualifications for Years 10–11.</p>
<h3>Our Secondary Programmes</h3>
<ul>
  <li><strong>Years 7–9:</strong> International Middle Years Curriculum (IMYC)</li>
  <li><strong>Years 10–11:</strong> International GCSE (IGCSE) — Edexcel</li>
</ul>
<h3>Our Exam Record</h3>
<div class="alert alert-success"><i class="fas fa-trophy"></i> <strong>100% pass rate</strong> for all ERV IGCSE exams — maintained for 6 consecutive years. Students achieve high grades (7/8/9) in 62% of all IGCSE exams taken.</div>
HTML;

include ROOT . '/includes/page.php';
?>
