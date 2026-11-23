<?php
define('ROOT', dirname(__DIR__, 2));
$pageTitle       = 'Meet our Alumni | Ecole Ruban Vert';
$pageDesc        = 'Discover the success stories of ERV alumni around the world.';
$pageBannerTitle = 'Meet Our Alumni';
$pageBannerDesc  = 'Discover the success stories of ERV alumni around the world.';
$rootPath        = '../../';
$r               = $rootPath;
$breadcrumbs     = [
    ['label'=>'School Life','url'=>'../../school-life/index.php'],
    ['label'=>'Alumni','url'=>'../../school-life/alumni/index.php'],
    ['label'=>'Meet our Alumni','url'=>'../../school-life/alumni/meet-alumni.php'],
];

ob_start();
include ROOT . '/includes/sidebar.php';
$sidebarContent = ob_get_clean();

$mainContent = <<<'HTML'
<h2>Meet Our Alumni</h2>
<p>Our alumni have gone on to study and work at leading universities and organisations around the world. Here are just a few of their stories.</p>
<div class="team-grid">
  <div class="team-card"><div class="team-photo"><div class="team-photo-placeholder"><div class="team-initials">JM</div></div></div><div class="team-info"><div class="team-name">Jean M.</div><div class="team-role">Class of 2018 · Engineer</div></div></div>
  <div class="team-card"><div class="team-photo"><div class="team-photo-placeholder"><div class="team-initials">SA</div></div></div><div class="team-info"><div class="team-name">Sarah A.</div><div class="team-role">Class of 2020 · Medical Student</div></div></div>
  <div class="team-card"><div class="team-photo"><div class="team-photo-placeholder"><div class="team-initials">DK</div></div></div><div class="team-info"><div class="team-name">David K.</div><div class="team-role">Class of 2019 · Entrepreneur</div></div></div>
</div>
HTML;

include ROOT . '/includes/page.php';
?>
