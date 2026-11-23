<?php
define('ROOT', dirname(__DIR__, 2));
$pageTitle       = 'Friends of ERV | Ecole Ruban Vert';
$pageDesc        = 'Friends of ERV connects parents, staff and the wider community in support of the school.';
$pageBannerTitle = 'Friends of ERV';
$pageBannerDesc  = 'Friends of ERV connects parents, staff and the wider community in support of the school.';
$rootPath        = '../../';
$r               = $rootPath;
$breadcrumbs     = [
    ['label'=>'Parents','url'=>'../../parents/index.php'],
    ['label'=>'Friends of ERV','url'=>'../../parents/friends-of-erv/index.php'],
];

ob_start();
include ROOT . '/includes/sidebar.php';
$sidebarContent = ob_get_clean();

$mainContent = <<<'HTML'
<h2>Friends of ERV</h2>
<p>Friends of ERV (FoERV) is our dedicated parent association, working to strengthen the school community through events, fundraising and support initiatives.</p>
<div class="quick-links-grid" style="margin:2rem 0;">
  <a href="../friends-of-erv/parental-involvement.php" class="quick-link-card"><div class="quick-link-icon">🤝</div><div class="quick-link-title">Get Involved</div></a>
  <a href="../friends-of-erv/volunteer.php" class="quick-link-card"><div class="quick-link-icon">🙋</div><div class="quick-link-title">Volunteer</div></a>
</div>
HTML;

include ROOT . '/includes/page.php';
?>
