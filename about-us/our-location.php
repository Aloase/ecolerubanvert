<?php
define('ROOT', dirname(__DIR__));
$pageTitle       = 'Our Location | Ecole Ruban Vert';
$pageDesc        = 'Find Ecole Ruban Vert in Batterie IV, Libreville, Gabon.';
$pageBannerTitle = 'Our Location';
$pageBannerDesc  = 'Find Ecole Ruban Vert in Batterie IV, Libreville, Gabon.';
$rootPath        = '../';
$r               = $rootPath;
$breadcrumbs     = [
    ['label'=>'About Us','url'=>'../about-us/index.php'],
    ['label'=>'Our Location','url'=>'../about-us/our-location.php'],
];

ob_start();
include ROOT . '/includes/sidebar.php';
$sidebarContent = ob_get_clean();

$mainContent = <<<'HTML'
<h2>Our Location</h2>
<p>Ecole Internationale Ruban Vert is located in Batterie IV, Libreville, Gabon — easily accessible from all major residential areas of the capital.</p>
<div style="border-radius:var(--radius-lg);overflow:hidden;border:2px solid var(--green-pale);background:#E8F5E9;height:320px;display:flex;align-items:center;justify-content:center;color:var(--green-primary);font-size:4rem;margin:2rem 0;">
  🗺️
</div>
<h3>Address</h3>
<p>Ecole Internationale Ruban Vert<br>Batterie IV, Libreville<br>GABON — BP : 2144</p>
<h3>Getting Here</h3>
<p>ERV is conveniently located with easy access from central Libreville. Please contact our reception team if you need directions or transportation information.</p>
HTML;

include ROOT . '/includes/page.php';
?>
