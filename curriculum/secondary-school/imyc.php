<?php
define('ROOT', dirname(__DIR__, 2));
$pageTitle       = 'IMYC | Ecole Ruban Vert';
$pageDesc        = 'The IMYC at ERV is our curriculum for students aged 11-14, Years 7-9.';
$pageBannerTitle = 'International Middle Years Curriculum (IMYC)';
$pageBannerDesc  = 'The IMYC at ERV is our curriculum for students aged 11-14, Years 7-9.';
$rootPath        = '../../';
$r               = $rootPath;
$breadcrumbs     = [
    ['label'=>'Curriculum','url'=>'../../curriculum/index.php'],
    ['label'=>'Secondary School','url'=>'../../curriculum/secondary-school/index.php'],
    ['label'=>'IMYC','url'=>'../../curriculum/secondary-school/imyc.php'],
];

ob_start();
include ROOT . '/includes/sidebar.php';
$sidebarContent = ob_get_clean();

$mainContent = <<<'HTML'
<h2>International Middle Years Curriculum (IMYC)</h2>
<p>The IMYC is a rigorous, globally-used curriculum for students aged 11–14 (Years 7–9 at ERV). Developed by Fieldwork Education, the IMYC provides a coherent approach to learning that supports academic, personal and international development.</p>
<h3>Key Features of the IMYC</h3>
<ul>
  <li>A clear, engaging theme-based structure that links learning across subjects</li>
  <li>A strong emphasis on personal development alongside academic growth</li>
  <li>An internationally-minded approach that respects and celebrates cultural diversity</li>
  <li>Regular formative and summative assessment to track progress</li>
</ul>
<a href="https://fieldworkeducation.com/curriculums/middle-years" target="_blank" rel="noopener" class="btn-primary"><i class="fas fa-external-link-alt"></i> About the IMYC</a>
HTML;

include ROOT . '/includes/page.php';
?>
