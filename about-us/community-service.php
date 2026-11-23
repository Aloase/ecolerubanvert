<?php
define('ROOT', dirname(__DIR__));
$pageTitle       = 'Community Service | Ecole Ruban Vert';
$pageDesc        = 'ERV students actively contribute to their local community through service projects and outreach.';
$pageBannerTitle = 'Community Service';
$pageBannerDesc  = 'ERV students actively contribute to their local community through service projects and outreach.';
$rootPath        = '../';
$r               = $rootPath;
$breadcrumbs     = [
    ['label'=>'About Us','url'=>'../about-us/index.php'],
    ['label'=>'Community Service','url'=>'../about-us/community-service.php'],
];

ob_start();
include ROOT . '/includes/sidebar.php';
$sidebarContent = ob_get_clean();

$mainContent = <<<'HTML'
<h2>Community Service at ERV</h2>
<p>Service to others is a core value at ERV. We believe that education should extend beyond the classroom to make a genuine, positive impact on the local Gabonese community and beyond.</p>
<h3>Our Service Programmes</h3>
<ul>
  <li>Partnerships with local orphanages and community centres</li>
  <li>Environmental clean-up and conservation projects</li>
  <li>Fundraising initiatives for local causes</li>
  <li>CAS-linked service projects for IBDP students</li>
  <li>Duke of Edinburgh's Award service components</li>
</ul>
<p>Through these initiatives, ERV students develop empathy, leadership and a deep sense of civic responsibility — qualities that will serve them throughout their lives.</p>
HTML;

include ROOT . '/includes/page.php';
?>
