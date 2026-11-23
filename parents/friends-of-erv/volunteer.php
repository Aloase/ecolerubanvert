<?php
define('ROOT', dirname(__DIR__, 2));
$pageTitle       = 'Volunteer | Ecole Ruban Vert';
$pageDesc        = 'Learn how to volunteer your time and skills to support the ERV community.';
$pageBannerTitle = 'Volunteer';
$pageBannerDesc  = 'Learn how to volunteer your time and skills to support the ERV community.';
$rootPath        = '../../';
$r               = $rootPath;
$breadcrumbs     = [
    ['label'=>'Parents','url'=>'../../parents/index.php'],
    ['label'=>'Friends of ERV','url'=>'../../parents/friends-of-erv/index.php'],
    ['label'=>'Volunteer','url'=>'../../parents/friends-of-erv/volunteer.php'],
];

ob_start();
include ROOT . '/includes/sidebar.php';
$sidebarContent = ob_get_clean();

$mainContent = <<<'HTML'
<h2>Volunteer at ERV</h2>
<p>Volunteering is a wonderful way to contribute to the ERV community while getting closer to school life. We welcome volunteers for events, activities and ongoing initiatives throughout the year.</p>
<a href="../../contact.php" class="btn-primary"><i class="fas fa-hand-holding-heart"></i> Register to Volunteer</a>
HTML;

include ROOT . '/includes/page.php';
?>
