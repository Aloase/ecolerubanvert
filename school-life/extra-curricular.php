<?php
define('ROOT', dirname(__DIR__));
$pageTitle       = 'Extra Curricular Activities | Ecole Ruban Vert';
$pageDesc        = 'ERV offers a wide range of extra-curricular activities to enrich student life beyond the classroom.';
$pageBannerTitle = 'Extra Curricular Activities';
$pageBannerDesc  = 'ERV offers a wide range of extra-curricular activities to enrich student life beyond the classroom.';
$rootPath        = '../';
$r               = $rootPath;
$breadcrumbs     = [
    ['label'=>'School Life','url'=>'../school-life/index.php'],
    ['label'=>'Extra Curricular Activities','url'=>'../school-life/extra-curricular.php'],
];

ob_start();
include ROOT . '/includes/sidebar.php';
$sidebarContent = ob_get_clean();

$mainContent = <<<'HTML'
<h2>Extra Curricular Activities (ECAs)</h2>
<p>ERV offers an extensive range of extra-curricular activities designed to help students discover new passions, develop skills and build friendships outside the classroom.</p>
<h3>Activities on Offer</h3>
<ul>
  <li>Football, Basketball, Tennis, Swimming</li>
  <li>Drama and Theatre Club</li>
  <li>Robotics and Coding Club</li>
  <li>Art and Design Club</li>
  <li>Choir and Instrumental Ensembles</li>
  <li>Model United Nations (MUN)</li>
  <li>Duke of Edinburgh's Award</li>
  <li>Debate Club</li>
</ul>
HTML;

include ROOT . '/includes/page.php';
?>
