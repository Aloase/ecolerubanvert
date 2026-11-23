<?php
define('ROOT', dirname(__DIR__));
$pageTitle       = 'Sustainability | Ecole Ruban Vert';
$pageDesc        = 'ERV is committed to environmental sustainability and instilling eco-conscious values in every student.';
$pageBannerTitle = 'Sustainability at ERV';
$pageBannerDesc  = 'ERV is committed to environmental sustainability and instilling eco-conscious values in every student.';
$rootPath        = '../';
$r               = $rootPath;
$breadcrumbs     = [
    ['label'=>'About Us','url'=>'../about-us/index.php'],
    ['label'=>'Vision, Mission & Values','url'=>'../about-us/vision.php'],
    ['label'=>'Sustainability','url'=>'../about-us/sustainability.php'],
];

ob_start();
include ROOT . '/includes/sidebar.php';
$sidebarContent = ob_get_clean();

$mainContent = <<<'HTML'
<h2>Sustainability at ERV</h2>
<p>Sustainability is at the core of ERV&#39;s mission. We believe that education has a vital role to play in tackling the environmental challenges facing our world, and we are committed to modelling sustainable practices throughout school life.</p>
<h3>Our Green Initiatives</h3>
<ul>
  <li>Campus-wide recycling and waste reduction programmes</li>
  <li>Solar energy initiatives to reduce our carbon footprint</li>
  <li>School gardens where students grow their own produce</li>
  <li>Water conservation systems across our facilities</li>
  <li>Sustainability integrated across the curriculum, from Early Years to IBDP</li>
</ul>
<h3>Student-Led Action</h3>
<p>Our students are empowered to lead sustainability projects through CAS, Eco-Committee initiatives and community outreach programmes, ensuring the next generation is equipped to build a more sustainable future.</p>
HTML;

include ROOT . '/includes/page.php';
?>
