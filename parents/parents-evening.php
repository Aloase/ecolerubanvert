<?php
define('ROOT', dirname(__DIR__));
$pageTitle       = 'Parents\' Evening | Ecole Ruban Vert';
$pageDesc        = 'Book your slot for ERV\'s Parents\' Evening — an opportunity to meet your child\'s teachers.';
$pageBannerTitle = 'Parents\' Evening';
$pageBannerDesc  = 'Book your slot for ERV\'s Parents\' Evening — an opportunity to meet your child\'s teachers.';
$rootPath        = '../';
$r               = $rootPath;
$breadcrumbs     = [
    ['label'=>'Parents','url'=>'../parents/index.php'],
    ['label'=>'Parents\' Evening','url'=>'../parents/parents-evening.php'],
];

ob_start();
include ROOT . '/includes/sidebar.php';
$sidebarContent = ob_get_clean();

$mainContent = <<<'HTML'
<h2>Parents Evening</h2>
<p>Parents Evenings are held each term, giving parents the opportunity to meet with teachers and discuss their child's progress in detail.</p>
<h3>How to Book</h3>
<p>Booking is managed through ManageBac. Parents will receive a notification when booking opens for each term&#39;s Parents Evening.</p>
<a href="https://ecolerubanvert.managebac.com/" target="_blank" rel="noopener" class="btn-primary"><i class="fas fa-external-link-alt"></i> Book via ManageBac</a>
HTML;

include ROOT . '/includes/page.php';
?>
