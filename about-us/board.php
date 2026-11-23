<?php
define('ROOT', dirname(__DIR__));
$pageTitle       = 'Board of Governors | Ecole Ruban Vert';
$pageDesc        = 'Meet the ERV Board of Governors who provide strategic leadership for our school.';
$pageBannerTitle = 'Board of Governors';
$pageBannerDesc  = 'Meet the ERV Board of Governors who provide strategic leadership for our school.';
$rootPath        = '../';
$r               = $rootPath;
$breadcrumbs     = [
    ['label'=>'About Us','url'=>'../about-us/index.php'],
    ['label'=>'Board','url'=>'../about-us/board.php'],
];

ob_start();
include ROOT . '/includes/sidebar.php';
$sidebarContent = ob_get_clean();

$mainContent = <<<'HTML'
<h2>Our Board of Governors</h2>
<p>The ERV Board of Governors provides strategic leadership and oversight, ensuring that the school remains true to its mission of delivering outstanding international education in Gabon.</p>
<p>Our board comprises experienced educational leaders, business professionals and community representatives who bring diverse expertise to guide ERV's development.</p>
<h3>Board Responsibilities</h3>
<ul>
  <li>Setting the strategic direction and vision of the school</li>
  <li>Ensuring fiscal responsibility and long-term sustainability</li>
  <li>Appointing and supporting the Head of School</li>
  <li>Upholding the school's accreditation standards</li>
  <li>Representing the ERV community's interests</li>
</ul>
HTML;

include ROOT . '/includes/page.php';
?>
