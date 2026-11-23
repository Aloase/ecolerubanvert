<?php
define('ROOT', dirname(__DIR__));
$pageTitle       = 'Events | Ecole Ruban Vert';
$pageDesc        = 'Explore upcoming events and celebrations happening at ERV.';
$pageBannerTitle = 'News & Events';
$pageBannerDesc  = 'Explore upcoming events and celebrations happening at ERV.';
$rootPath        = '../';
$r               = $rootPath;
$breadcrumbs     = [
    ['label'=>'School Life','url'=>'../school-life/index.php'],
    ['label'=>'Events','url'=>'../school-life/events.php'],
];

ob_start();
include ROOT . '/includes/sidebar.php';
$sidebarContent = ob_get_clean();

$mainContent = <<<'HTML'
<h2>Upcoming Events</h2>
<table class="styled-table" style="margin-top:1.5rem;">
  <thead><tr><th>Date</th><th>Event</th><th>Location</th></tr></thead>
  <tbody>
    <tr><td>15 Sept 2024</td><td>Back to School Assembly</td><td>Auditorium</td></tr>
    <tr><td>28 Sept 2024</td><td>Open Day</td><td>Main Campus</td></tr>
    <tr><td>12 Oct 2024</td><td>African Heritage Week</td><td>Whole School</td></tr>
    <tr><td>05 Nov 2024</td><td>Parents Evening (Secondary)</td><td>Classrooms</td></tr>
    <tr><td>20 Dec 2024</td><td>Winter Concert</td><td>Auditorium</td></tr>
  </tbody>
</table>
HTML;

include ROOT . '/includes/page.php';
?>
