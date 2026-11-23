<?php
define('ROOT', dirname(__DIR__));
$pageTitle       = 'Parents | Ecole Ruban Vert';
$pageDesc        = 'Everything ERV parents need — calendars, policies, FAQs and more.';
$pageBannerTitle = 'Parent Resources';
$pageBannerDesc  = 'Everything ERV parents need — calendars, policies, FAQs and more.';
$rootPath        = '../';
$r               = $rootPath;
$breadcrumbs     = [
    ['label'=>'Parents','url'=>'../parents/index.php'],
];

ob_start();
include ROOT . '/includes/sidebar.php';
$sidebarContent = ob_get_clean();

$mainContent = <<<'HTML'
<h2>Parent Resources</h2>
<p>We know that being an ERV parent means staying informed and involved. This section brings together all the resources, information and policies you need to support your child at ERV.</p>
<div class="quick-links-grid" style="margin:2rem 0;">
  <a href="../parents/calendar.php" class="quick-link-card"><div class="quick-link-icon">📅</div><div class="quick-link-title">Calendar</div></a>
  <a href="../parents/faqs.php" class="quick-link-card"><div class="quick-link-icon">❓</div><div class="quick-link-title">FAQs</div></a>
  <a href="../parents/uniform-information/index.php" class="quick-link-card"><div class="quick-link-icon">👕</div><div class="quick-link-title">Uniform</div></a>
  <a href="../parents/friends-of-erv/index.php" class="quick-link-card"><div class="quick-link-icon">🤝</div><div class="quick-link-title">Friends of ERV</div></a>
</div>
HTML;

include ROOT . '/includes/page.php';
?>
