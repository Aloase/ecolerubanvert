<?php
define('ROOT', dirname(__DIR__));
$pageTitle       = 'Support Team | Ecole Ruban Vert';
$pageDesc        = 'Meet the dedicated support staff who keep ERV running smoothly every day.';
$pageBannerTitle = 'Support Team';
$pageBannerDesc  = 'Meet the dedicated support staff who keep ERV running smoothly every day.';
$rootPath        = '../';
$r               = $rootPath;
$breadcrumbs     = [
    ['label'=>'About Us','url'=>'../about-us/index.php'],
    ['label'=>'Support Team','url'=>'../about-us/support-team.php'],
];

ob_start();
include ROOT . '/includes/sidebar.php';
$sidebarContent = ob_get_clean();

$mainContent = <<<'HTML'
<h2>Support Team</h2>
<p>Behind every great school is a dedicated support team. Our administrative, IT, facilities, catering and security staff work tirelessly to ensure ERV runs smoothly every single day.</p>
<div class="team-grid">
  <div class="team-card"><div class="team-photo"><div class="team-photo-placeholder"><div class="team-initials">IT</div></div></div><div class="team-info"><div class="team-name">IT Department</div><div class="team-role">Technology Support</div></div></div>
  <div class="team-card"><div class="team-photo"><div class="team-photo-placeholder"><div class="team-initials">FA</div></div></div><div class="team-info"><div class="team-name">Facilities Team</div><div class="team-role">Maintenance & Grounds</div></div></div>
  <div class="team-card"><div class="team-photo"><div class="team-photo-placeholder"><div class="team-initials">RE</div></div></div><div class="team-info"><div class="team-name">Reception Team</div><div class="team-role">Front Office</div></div></div>
  <div class="team-card"><div class="team-photo"><div class="team-photo-placeholder"><div class="team-initials">NU</div></div></div><div class="team-info"><div class="team-name">School Nurse</div><div class="team-role">Health & Wellbeing</div></div></div>
</div>
HTML;

include ROOT . '/includes/page.php';
?>
