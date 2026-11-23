<?php
define('ROOT', dirname(__DIR__));
$pageTitle       = 'House System | Ecole Ruban Vert';
$pageDesc        = 'The ERV House System fosters friendly competition, community spirit and leadership across year groups.';
$pageBannerTitle = 'House System';
$pageBannerDesc  = 'The ERV House System fosters friendly competition, community spirit and leadership across year groups.';
$rootPath        = '../';
$r               = $rootPath;
$breadcrumbs     = [
    ['label'=>'School Life','url'=>'../school-life/index.php'],
    ['label'=>'House System','url'=>'../school-life/house-system.php'],
];

ob_start();
include ROOT . '/includes/sidebar.php';
$sidebarContent = ob_get_clean();

$mainContent = <<<'HTML'
<h2>House System</h2>
<p>Every ERV student belongs to one of our four Houses, fostering a sense of belonging, healthy competition and cross-year friendships.</p>
<div class="team-grid">
  <div class="team-card"><div class="team-photo" style="background:#E53935;"></div><div class="team-info"><div class="team-name">Baobab House</div><div class="team-role">Red</div></div></div>
  <div class="team-card"><div class="team-photo" style="background:#1E88E5;"></div><div class="team-info"><div class="team-name">Okoumé House</div><div class="team-role">Blue</div></div></div>
  <div class="team-card"><div class="team-photo" style="background:#43A047;"></div><div class="team-info"><div class="team-name">Iroko House</div><div class="team-role">Green</div></div></div>
  <div class="team-card"><div class="team-photo" style="background:#FDD835;"></div><div class="team-info"><div class="team-name">Ébène House</div><div class="team-role">Yellow</div></div></div>
</div>
<p style="margin-top:1.5rem;">Houses compete throughout the year in sports, music, arts and community service, culminating in the annual House Cup.</p>
HTML;

include ROOT . '/includes/page.php';
?>
