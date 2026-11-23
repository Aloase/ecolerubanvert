<?php
define('ROOT', dirname(__DIR__));
$pageTitle       = 'About Us | Ecole Ruban Vert';
$pageDesc        = 'Learn about Ecole Ruban Vert — our history, community and commitment to excellence.';
$pageBannerTitle = 'About Us';
$pageBannerDesc  = 'Learn about Ecole Ruban Vert — our history, community and commitment to excellence.';
$rootPath        = '../';
$r               = $rootPath;
$breadcrumbs     = [
    ['label'=>'About Us','url'=>'../about-us/index.php'],
];

ob_start();
include ROOT . '/includes/sidebar.php';
$sidebarContent = ob_get_clean();

$mainContent = <<<'HTML'
<h2>About Ecole Ruban Vert</h2>
<p>Ecole Internationale Ruban Vert (ERV) is a leading bilingual international school located in Libreville, Gabon. Founded on the principles of excellence, respect and virtuous living, ERV has grown to become one of Africa's premier international schools.</p>
<p>As a CIS-accredited IB World School, ERV offers a comprehensive curriculum from Early Years through the IB Diploma Programme, serving students from over 50 nationalities in a vibrant, multicultural community.</p>
<h3>Our Story</h3>
<p>ERV was established with the vision of providing world-class education in the heart of Central Africa. Over the decades, we have built a reputation for academic excellence, innovation and community service that extends far beyond Gabon.</p>
<h3>Our Community</h3>
<p>At ERV, we believe that education is a collaborative endeavour. Our community of students, parents, teachers and staff work together to create an environment where every child can flourish — academically, socially and personally.</p>
<div class="alert alert-success"><i class="fas fa-award"></i> <strong>CIS Accredited</strong> · <strong>IB World School</strong> · <strong>Round Square Member</strong> · <strong>AISA Member</strong></div>
HTML;

include ROOT . '/includes/page.php';
?>
