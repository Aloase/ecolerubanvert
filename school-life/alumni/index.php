<?php
define('ROOT', dirname(__DIR__, 2));
$pageTitle       = 'Alumni | Ecole Ruban Vert';
$pageDesc        = 'Stay connected with the global ERV Alumni network.';
$pageBannerTitle = 'ERV Alumni';
$pageBannerDesc  = 'Stay connected with the global ERV Alumni network.';
$rootPath        = '../../';
$r               = $rootPath;
$breadcrumbs     = [
    ['label'=>'School Life','url'=>'../../school-life/index.php'],
    ['label'=>'Alumni','url'=>'../../school-life/alumni/index.php'],
];

ob_start();
include ROOT . '/includes/sidebar.php';
$sidebarContent = ob_get_clean();

$mainContent = <<<'HTML'
<h2>ERV Alumni Network</h2>
<p>Once part of ERV, always part of ERV. Our alumni network connects graduates across the globe, providing opportunities for mentorship, networking and ongoing engagement with the school community.</p>
<h3>Stay Connected</h3>
<ul>
  <li>Annual Alumni Reunion events</li>
  <li>Mentorship opportunities for current students</li>
  <li>Alumni newsletter and updates</li>
  <li>Networking across industries and universities worldwide</li>
</ul>
<a href="../alumni/meet-alumni.php" class="btn-primary" style="margin-top:1rem;display:inline-flex;">Meet Our Alumni</a>
HTML;

include ROOT . '/includes/page.php';
?>
