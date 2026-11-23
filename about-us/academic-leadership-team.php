<?php
define('ROOT', dirname(__DIR__));
$pageTitle       = 'Academic Leadership Team | Ecole Ruban Vert';
$pageDesc        = 'Meet the Academic Leadership Team responsible for curriculum and teaching quality at ERV.';
$pageBannerTitle = 'Academic Leadership Team';
$pageBannerDesc  = 'Meet the Academic Leadership Team responsible for curriculum and teaching quality at ERV.';
$rootPath        = '../';
$r               = $rootPath;
$breadcrumbs     = [
    ['label'=>'About Us','url'=>'../about-us/index.php'],
    ['label'=>'Academic Leadership Team','url'=>'../about-us/academic-leadership-team.php'],
];

ob_start();
include ROOT . '/includes/sidebar.php';
$sidebarContent = ob_get_clean();

$mainContent = <<<'HTML'
<h2>Academic Leadership Team</h2>
<p>Our Academic Leadership Team (ALT) is responsible for curriculum design, teaching quality and academic standards across all programmes at ERV.</p>
<div class="team-grid">
  <div class="team-card"><div class="team-photo"><div class="team-photo-placeholder"><div class="team-initials">EY</div></div></div><div class="team-info"><div class="team-name">Early Years Coordinator</div><div class="team-role">Head of Early Years</div></div></div>
  <div class="team-card"><div class="team-photo"><div class="team-photo-placeholder"><div class="team-initials">PY</div></div></div><div class="team-info"><div class="team-name">PYP Coordinator</div><div class="team-role">Head of Primary</div></div></div>
  <div class="team-card"><div class="team-photo"><div class="team-photo-placeholder"><div class="team-initials">SS</div></div></div><div class="team-info"><div class="team-name">Secondary Coordinator</div><div class="team-role">Head of Secondary</div></div></div>
  <div class="team-card"><div class="team-photo"><div class="team-photo-placeholder"><div class="team-initials">DP</div></div></div><div class="team-info"><div class="team-name">IBDP Coordinator</div><div class="team-role">Head of IB Diploma</div></div></div>
</div>
HTML;

include ROOT . '/includes/page.php';
?>
