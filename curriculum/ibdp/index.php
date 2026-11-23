<?php
define('ROOT', dirname(__DIR__, 2));
$pageTitle       = 'IB Diploma Programme | Ecole Ruban Vert';
$pageDesc        = 'ERV offers the IB Diploma Programme — with a 100% pass rate for 6 consecutive years.';
$pageBannerTitle = 'IB Diploma Programme (IBDP)';
$pageBannerDesc  = 'ERV offers the IB Diploma Programme — with a 100% pass rate for 6 consecutive years.';
$rootPath        = '../../';
$r               = $rootPath;
$breadcrumbs     = [
    ['label'=>'Curriculum','url'=>'../../curriculum/index.php'],
    ['label'=>'IBDP','url'=>'../../curriculum/ibdp/index.php'],
];

ob_start();
include ROOT . '/includes/sidebar.php';
$sidebarContent = ob_get_clean();

$mainContent = <<<'HTML'
<h2>IB Diploma Programme (IBDP)</h2>
<p>The International Baccalaureate Diploma Programme (IBDP) is a rigorous, internationally-recognised pre-university qualification for students aged 16–18 (Years 12–13 at ERV). It is the gold standard of secondary education, respected by universities worldwide.</p>
<div class="alert alert-success"><i class="fas fa-trophy"></i> <strong>100% IBDP pass rate</strong> maintained for 6 consecutive years · Highest score: <strong>43/45 points</strong> · Average: <strong>36/45 points</strong></div>
<h3>The IBDP Framework</h3>
<p>Students study six subjects (three at Higher Level and three at Standard Level), plus three core elements:</p>
<ul>
  <li><strong>Theory of Knowledge (TOK):</strong> An interdisciplinary course that encourages critical thinking</li>
  <li><strong>Extended Essay (EE):</strong> An independent research project of up to 4,000 words</li>
  <li><strong>Creativity, Activity, Service (CAS):</strong> Projects that develop students beyond the classroom</li>
</ul>
<a href="https://www.ibo.org/programmes/diploma-programme/" target="_blank" rel="noopener" class="btn-primary"><i class="fas fa-external-link-alt"></i> About the IBDP</a>
HTML;

include ROOT . '/includes/page.php';
?>
