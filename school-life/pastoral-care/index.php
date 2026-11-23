<?php
define('ROOT', dirname(__DIR__, 2));
$pageTitle       = 'Pastoral Care | Ecole Ruban Vert';
$pageDesc        = 'ERV\'s pastoral care system ensures every student\'s wellbeing is supported throughout their journey.';
$pageBannerTitle = 'Pastoral Care';
$pageBannerDesc  = 'ERV\'s pastoral care system ensures every student\'s wellbeing is supported throughout their journey.';
$rootPath        = '../../';
$r               = $rootPath;
$breadcrumbs     = [
    ['label'=>'School Life','url'=>'../../school-life/index.php'],
    ['label'=>'Pastoral Care','url'=>'../../school-life/pastoral-care/index.php'],
];

ob_start();
include ROOT . '/includes/sidebar.php';
$sidebarContent = ob_get_clean();

$mainContent = <<<'HTML'
<h2>Pastoral Care at ERV</h2>
<p>The wellbeing of every student is at the heart of our pastoral care programme. We believe that happy, secure students are best placed to thrive academically and socially.</p>
<h3>Our Pastoral Approach</h3>
<ul>
  <li>Dedicated Form Tutors and Year Group Leaders</li>
  <li>A comprehensive anti-bullying policy</li>
  <li>Regular wellbeing check-ins</li>
  <li>Peer mentoring and buddy systems</li>
  <li>Access to professional school counselling</li>
</ul>
<a href="../pastoral-care/school-counselling.php" class="btn-primary" style="margin-top:1rem;display:inline-flex;">Learn about School Counselling</a>
HTML;

include ROOT . '/includes/page.php';
?>
