<?php
define('ROOT', dirname(__DIR__));
$pageTitle       = 'Term Dates | Ecole Ruban Vert';
$pageDesc        = 'ERV academic year term dates for the current school year.';
$pageBannerTitle = 'Term Dates';
$pageBannerDesc  = 'ERV academic year term dates for the current school year.';
$rootPath        = '../';
$r               = $rootPath;
$breadcrumbs     = [
    ['label'=>'Parents','url'=>'../parents/index.php'],
    ['label'=>'Term Dates','url'=>'../parents/term-dates.php'],
];

ob_start();
include ROOT . '/includes/sidebar.php';
$sidebarContent = ob_get_clean();

$mainContent = <<<'HTML'
<h2>Term Dates</h2>
<table class="styled-table" style="margin-top:1.5rem;">
  <thead><tr><th>Event</th><th>Date</th></tr></thead>
  <tbody>
    <tr><td>First Day of School</td><td>2 September 2024</td></tr>
    <tr><td>Mid-Term Break (Term 1)</td><td>21–25 October 2024</td></tr>
    <tr><td>Winter Break</td><td>16 December 2024 – 5 January 2025</td></tr>
    <tr><td>Mid-Term Break (Term 2)</td><td>17–21 February 2025</td></tr>
    <tr><td>Spring Break</td><td>7–21 April 2025</td></tr>
    <tr><td>Last Day of School</td><td>27 June 2025</td></tr>
  </tbody>
</table>
HTML;

include ROOT . '/includes/page.php';
?>
