<?php
define('ROOT', dirname(__DIR__, 2));
$pageTitle       = 'School Counselling | Ecole Ruban Vert';
$pageDesc        = 'ERV\'s School Counsellor supports student mental health, wellbeing and personal development.';
$pageBannerTitle = 'School Counselling';
$pageBannerDesc  = 'ERV\'s School Counsellor supports student mental health, wellbeing and personal development.';
$rootPath        = '../../';
$r               = $rootPath;
$breadcrumbs     = [
    ['label'=>'School Life','url'=>'../../school-life/index.php'],
    ['label'=>'Pastoral Care','url'=>'../../school-life/pastoral-care/index.php'],
    ['label'=>'School Counselling','url'=>'../../school-life/pastoral-care/school-counselling.php'],
];

ob_start();
include ROOT . '/includes/sidebar.php';
$sidebarContent = ob_get_clean();

$mainContent = <<<'HTML'
<h2>School Counselling</h2>
<p>Our qualified School Counsellor provides confidential support to students facing academic, social or emotional challenges. Counselling is available to all students, from Early Years through IB Diploma.</p>
<h3>Areas of Support</h3>
<ul>
  <li>Emotional wellbeing and stress management</li>
  <li>Friendship and social difficulties</li>
  <li>Academic pressure and study skills</li>
  <li>Transition support (new students, moving year groups)</li>
  <li>University and career guidance (Secondary/IBDP)</li>
</ul>
<div class="alert alert-info"><i class="fas fa-info-circle"></i> All counselling sessions are confidential. Parents, teachers or students themselves may request an appointment.</div>
HTML;

include ROOT . '/includes/page.php';
?>
