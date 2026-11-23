<?php
define('ROOT', dirname(__DIR__));
$pageTitle       = 'Music Department | Ecole Ruban Vert';
$pageDesc        = 'The ERV Music Department, in partnership with the London School of Music, offers instrumental and vocal tuition.';
$pageBannerTitle = 'Music Department';
$pageBannerDesc  = 'The ERV Music Department, in partnership with the London School of Music, offers instrumental and vocal tuition.';
$rootPath        = '../';
$r               = $rootPath;
$breadcrumbs     = [
    ['label'=>'School Life','url'=>'../school-life/index.php'],
    ['label'=>'Music Department','url'=>'../school-life/music-department.php'],
];

ob_start();
include ROOT . '/includes/sidebar.php';
$sidebarContent = ob_get_clean();

$mainContent = <<<'HTML'
<h2>Music Department</h2>
<p>The ERV Music Department nurtures musical talent at every level, from beginner to advanced. In partnership with the London School of Music, we offer structured tuition and examination opportunities.</p>
<h3>What We Offer</h3>
<ul>
  <li>Individual and group instrumental lessons (piano, guitar, violin, percussion)</li>
  <li>Vocal training and choir</li>
  <li>School orchestra and ensembles</li>
  <li>Annual concerts and recitals</li>
  <li>London School of Music graded examinations</li>
</ul>
HTML;

include ROOT . '/includes/page.php';
?>
