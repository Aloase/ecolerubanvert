<?php
define('ROOT', dirname(__DIR__));
$pageTitle       = 'Work with Us | Ecole Ruban Vert';
$pageDesc        = 'Explore career opportunities at Ecole Ruban Vert — join our team of dedicated educators and staff.';
$pageBannerTitle = 'Vacancies & Careers';
$pageBannerDesc  = 'Explore career opportunities at Ecole Ruban Vert — join our team of dedicated educators and staff.';
$rootPath        = '../';
$r               = $rootPath;
$breadcrumbs     = [
    ['label'=>'About Us','url'=>'../about-us/index.php'],
    ['label'=>'Work with Us','url'=>'../about-us/vacancies.php'],
];

ob_start();
include ROOT . '/includes/sidebar.php';
$sidebarContent = ob_get_clean();

$mainContent = <<<'HTML'
<h2>Work with Us</h2>
<p>ERV is always looking for talented, passionate educators and support staff who share our commitment to excellence, innovation and sustainability in education.</p>
<h3>Why Work at ERV?</h3>
<ul>
  <li>Competitive, internationally-benchmarked salaries</li>
  <li>Professional development opportunities</li>
  <li>A vibrant, multicultural community of over 50 nationalities</li>
  <li>Modern facilities and resources</li>
  <li>The unique experience of living and working in Gabon</li>
</ul>
<h3>Current Vacancies</h3>
<div class="alert alert-info"><i class="fas fa-info-circle"></i> Please check back regularly or contact our HR team directly for the latest vacancy listings.</div>
<a href="../contact.php" class="btn-primary"><i class="fas fa-briefcase"></i> Contact HR / Send CV</a>
HTML;

include ROOT . '/includes/page.php';
?>
