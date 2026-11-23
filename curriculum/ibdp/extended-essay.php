<?php
define('ROOT', dirname(__DIR__, 2));
$pageTitle       = 'Extended Essay | Ecole Ruban Vert';
$pageDesc        = 'The IB Extended Essay is an independent research project completed by all IBDP students at ERV.';
$pageBannerTitle = 'Extended Essay (EE)';
$pageBannerDesc  = 'The IB Extended Essay is an independent research project completed by all IBDP students at ERV.';
$rootPath        = '../../';
$r               = $rootPath;
$breadcrumbs     = [
    ['label'=>'Curriculum','url'=>'../../curriculum/index.php'],
    ['label'=>'IBDP','url'=>'../../curriculum/ibdp/index.php'],
    ['label'=>'Extended Essay','url'=>'../../curriculum/ibdp/extended-essay.php'],
];

ob_start();
include ROOT . '/includes/sidebar.php';
$sidebarContent = ob_get_clean();

$mainContent = <<<'HTML'
<h2>Extended Essay (EE)</h2>
<p>The Extended Essay is one of the three core elements of the IB Diploma Programme. It is an independent, self-directed piece of research, finishing with a 4,000-word essay, giving students an opportunity to investigate a topic of special interest to them.</p>
<h3>Why the Extended Essay Matters</h3>
<p>The EE prepares students for the kind of independent research and writing they will encounter in higher education. It develops critical thinking, research and academic writing skills that are invaluable at university level.</p>
<h3>EE at ERV</h3>
<p>At ERV, every student is assigned an experienced supervisor who guides and supports them through the research and writing process. Students present their research at a viva voce at the end of the process.</p>
HTML;

include ROOT . '/includes/page.php';
?>
