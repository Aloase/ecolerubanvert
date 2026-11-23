<?php
define('ROOT', dirname(__DIR__));
$pageTitle       = 'Calendar | Ecole Ruban Vert';
$pageDesc        = 'View the ERV school calendar including term dates, holidays and key events.';
$pageBannerTitle = 'School Calendar';
$pageBannerDesc  = 'View the ERV school calendar including term dates, holidays and key events.';
$rootPath        = '../';
$r               = $rootPath;
$breadcrumbs     = [
    ['label'=>'Parents','url'=>'../parents/index.php'],
    ['label'=>'Calendar','url'=>'../parents/calendar.php'],
];

ob_start();
include ROOT . '/includes/sidebar.php';
$sidebarContent = ob_get_clean();

$mainContent = <<<'HTML'
<h2>School Calendar</h2>
<p>Stay up to date with important school dates, holidays and events throughout the academic year.</p>
<table class="styled-table" style="margin-top:1.5rem;">
  <thead><tr><th>Term</th><th>Start Date</th><th>End Date</th></tr></thead>
  <tbody>
    <tr><td>Term 1</td><td>2 September 2024</td><td>13 December 2024</td></tr>
    <tr><td>Term 2</td><td>6 January 2025</td><td>4 April 2025</td></tr>
    <tr><td>Term 3</td><td>22 April 2025</td><td>27 June 2025</td></tr>
  </tbody>
</table>
HTML;

include ROOT . '/includes/page.php';
?>
