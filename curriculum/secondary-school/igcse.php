<?php
define('ROOT', dirname(__DIR__, 2));
$pageTitle       = 'International GCSE | Ecole Ruban Vert';
$pageDesc        = 'ERV offers Edexcel International GCSE qualifications for students in Years 10-11.';
$pageBannerTitle = 'International GCSE (IGCSE)';
$pageBannerDesc  = 'ERV offers Edexcel International GCSE qualifications for students in Years 10-11.';
$rootPath        = '../../';
$r               = $rootPath;
$breadcrumbs     = [
    ['label'=>'Curriculum','url'=>'../../curriculum/index.php'],
    ['label'=>'Secondary School','url'=>'../../curriculum/secondary-school/index.php'],
    ['label'=>'IGCSE','url'=>'../../curriculum/secondary-school/igcse.php'],
];

ob_start();
include ROOT . '/includes/sidebar.php';
$sidebarContent = ob_get_clean();

$mainContent = <<<'HTML'
<h2>International GCSE (IGCSE)</h2>
<p>ERV students in Years 10 and 11 sit Edexcel International GCSE (IGCSE) examinations — internationally-recognised qualifications that prepare students for the IB Diploma Programme and other post-16 pathways.</p>
<h3>Subjects Offered</h3>
<p>ERV offers a broad range of IGCSE subjects including: English Language, English Literature, French, Mathematics, Further Mathematics, Sciences (Biology, Chemistry, Physics), History, Geography, ICT, Business Studies, Art &amp; Design, and Physical Education.</p>
<div class="alert alert-success"><i class="fas fa-trophy"></i> ERV records a <strong>100% IGCSE pass rate</strong> and 62% of grades are in the top band (grades 7/8/9) — maintained for 6 consecutive years.</div>
HTML;

include ROOT . '/includes/page.php';
?>
