<?php
define('ROOT', dirname(__DIR__));
$pageTitle       = 'Visit ERV | Ecole Ruban Vert';
$pageDesc        = 'Book a tour of Ecole Ruban Vert and experience our school community first-hand.';
$pageBannerTitle = 'Visit ERV';
$pageBannerDesc  = 'Book a tour of Ecole Ruban Vert and experience our school community first-hand.';
$rootPath        = '../';
$r               = $rootPath;
$breadcrumbs     = [
    ['label'=>'Admissions','url'=>'../admissions/index.php'],
    ['label'=>'Visit ERV','url'=>'../admissions/visit-erv.php'],
];

ob_start();
include ROOT . '/includes/sidebar.php';
$sidebarContent = ob_get_clean();

$mainContent = <<<'HTML'
<h2>Visit ERV</h2>
<p>We believe the best way to experience ERV is to visit us in person. Our open days and individual school tours give prospective families the opportunity to see our facilities, meet our staff and students, and get a real feel for life at ERV.</p>
<h3>Open Days</h3>
<p>We hold regular Open Days throughout the academic year. These are a great opportunity to explore the school, attend presentations by our Head of School and curriculum leaders, and ask any questions you may have.</p>
<h3>Individual Tours</h3>
<p>We also offer individual guided tours on request. Please contact our Admissions Team to arrange a visit at a time that suits your family.</p>
<a href="../contact.php" class="btn-primary"><i class="fas fa-calendar-alt"></i> Book a Visit</a>
HTML;

include ROOT . '/includes/page.php';
?>
