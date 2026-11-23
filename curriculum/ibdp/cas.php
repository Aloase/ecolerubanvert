<?php
define('ROOT', dirname(__DIR__, 2));
$pageTitle       = 'CAS | Ecole Ruban Vert';
$pageDesc        = 'CAS is a core component of the IB Diploma that ensures students develop beyond the classroom.';
$pageBannerTitle = 'Creativity, Activity, Service (CAS)';
$pageBannerDesc  = 'CAS is a core component of the IB Diploma that ensures students develop beyond the classroom.';
$rootPath        = '../../';
$r               = $rootPath;
$breadcrumbs     = [
    ['label'=>'Curriculum','url'=>'../../curriculum/index.php'],
    ['label'=>'IBDP','url'=>'../../curriculum/ibdp/index.php'],
    ['label'=>'CAS','url'=>'../../curriculum/ibdp/cas.php'],
];

ob_start();
include ROOT . '/includes/sidebar.php';
$sidebarContent = ob_get_clean();

$mainContent = <<<'HTML'
<h2>Creativity, Activity, Service (CAS)</h2>
<p>CAS is at the heart of the IB Diploma Programme. It is not an academic subject — it is a commitment to experience the world beyond the classroom in a way that is engaging, purposeful and reflective.</p>
<h3>The Three Strands</h3>
<ul>
  <li><strong>Creativity:</strong> Arts and creative projects — music, theatre, visual arts, creative writing</li>
  <li><strong>Activity:</strong> Physical education, sport, outdoor pursuits, dance</li>
  <li><strong>Service:</strong> Community and voluntary work that makes a positive difference</li>
</ul>
<h3>CAS at ERV</h3>
<p>ERV students engage in a wide range of CAS activities both within and beyond the school community. Through CAS, students develop resilience, creativity, leadership and a genuine commitment to service.</p>
HTML;

include ROOT . '/includes/page.php';
?>
