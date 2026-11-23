<?php
define('ROOT', dirname(__DIR__));
$pageTitle       = 'Innovation | Ecole Ruban Vert';
$pageDesc        = 'ERV embraces innovation in teaching, learning and technology to prepare students for the future.';
$pageBannerTitle = 'Innovation at ERV';
$pageBannerDesc  = 'ERV embraces innovation in teaching, learning and technology to prepare students for the future.';
$rootPath        = '../';
$r               = $rootPath;
$breadcrumbs     = [
    ['label'=>'About Us','url'=>'../about-us/index.php'],
    ['label'=>'Vision, Mission & Values','url'=>'../about-us/vision.php'],
    ['label'=>'Innovation','url'=>'../about-us/innovation.php'],
];

ob_start();
include ROOT . '/includes/sidebar.php';
$sidebarContent = ob_get_clean();

$mainContent = <<<'HTML'
<h2>Innovation at ERV</h2>
<p>Innovation drives everything we do at ERV. From cutting-edge teaching methodologies to the integration of digital technologies, we continually seek new ways to enhance learning and prepare our students for an ever-changing world.</p>
<h3>Innovative Learning</h3>
<ul>
  <li>Project-based and inquiry-led learning across all programmes</li>
  <li>Digital literacy and computer science from an early age</li>
  <li>Design thinking and entrepreneurship opportunities</li>
  <li>Partnerships with local and international organisations</li>
  <li>State-of-the-art facilities supporting hands-on learning</li>
</ul>
<h3>Preparing Future-Ready Graduates</h3>
<p>Our goal is to nurture students who are not only academically excellent but also adaptable, creative problem-solvers ready to thrive in the 21st century economy.</p>
HTML;

include ROOT . '/includes/page.php';
?>
