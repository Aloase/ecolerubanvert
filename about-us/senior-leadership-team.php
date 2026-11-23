<?php
define('ROOT', dirname(__DIR__));
$pageTitle       = 'Senior Leadership Team | Ecole Ruban Vert';
$pageDesc        = 'Meet the Senior Leadership Team who guide ERV\'s strategic direction and daily operations.';
$pageBannerTitle = 'Senior Leadership Team';
$pageBannerDesc  = 'Meet the Senior Leadership Team who guide ERV\'s strategic direction and daily operations.';
$rootPath        = '../';
$r               = $rootPath;
$breadcrumbs     = [
    ['label'=>'About Us','url'=>'../about-us/index.php'],
    ['label'=>'Senior Leadership Team','url'=>'../about-us/senior-leadership-team.php'],
];

ob_start();
include ROOT . '/includes/sidebar.php';
$sidebarContent = ob_get_clean();

$mainContent = <<<'HTML'
<h2>Senior Leadership Team</h2>
<p>Our Senior Leadership Team (SLT) brings together experienced international educators who oversee the strategic and operational direction of ERV.</p>
<div class="team-grid">
  <div class="team-card"><div class="team-photo"><div class="team-photo-placeholder"><div class="team-initials">HS</div></div></div><div class="team-info"><div class="team-name">Head of School</div><div class="team-role">Head of School</div></div></div>
  <div class="team-card"><div class="team-photo"><div class="team-photo-placeholder"><div class="team-initials">DP</div></div></div><div class="team-info"><div class="team-name">Deputy Head</div><div class="team-role">Deputy Head of School</div></div></div>
  <div class="team-card"><div class="team-photo"><div class="team-photo-placeholder"><div class="team-initials">BM</div></div></div><div class="team-info"><div class="team-name">Business Manager</div><div class="team-role">Head of Finance & Operations</div></div></div>
  <div class="team-card"><div class="team-photo"><div class="team-photo-placeholder"><div class="team-initials">AD</div></div></div><div class="team-info"><div class="team-name">Admissions Director</div><div class="team-role">Director of Admissions</div></div></div>
</div>
HTML;

include ROOT . '/includes/page.php';
?>
