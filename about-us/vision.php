<?php
define('ROOT', dirname(__DIR__));
$pageTitle       = 'Vision, Mission & Values | Ecole Ruban Vert';
$pageDesc        = 'Discover the vision, mission and values that guide everything we do at ERV.';
$pageBannerTitle = 'Vision, Mission & Values';
$pageBannerDesc  = 'Discover the vision, mission and values that guide everything we do at ERV.';
$rootPath        = '../';
$r               = $rootPath;
$breadcrumbs     = [
    ['label'=>'About Us','url'=>'../about-us/index.php'],
    ['label'=>'Vision, Mission & Values','url'=>'../about-us/vision.php'],
];

ob_start();
include ROOT . '/includes/sidebar.php';
$sidebarContent = ob_get_clean();

$mainContent = <<<'HTML'
<h2>Vision, Mission &amp; Values</h2>
<div class="mvv-grid" style="margin:2rem 0;">
  <div class="mvv-card mission"><div class="mvv-icon">🎯</div><h3>Our Mission</h3><p>To become Africa&#39;s most enterprising school, focusing on sustainability and innovation to play a significant role in Gabon&#39;s and in Africa&#39;s education.</p></div>
  <div class="mvv-card vision"><div class="mvv-icon">🌟</div><h3>Our Vision</h3><p>To provide a legacy in education which promotes qualities of open-mindedness, tolerance and respect for others, which will provide a best practice model for the future of students from all nations in Gabon.</p></div>
  <div class="mvv-card values"><div class="mvv-icon">💎</div><h3>Our Values</h3><ul class="values-list"><li><span class="value-dot"></span><div><strong>Excellence:</strong> We strive for excellence in every aspect of life.</div></li><li><span class="value-dot"></span><div><strong>Respect:</strong> We respect ourselves, our environment, and each other.</div></li><li><span class="value-dot"></span><div><strong>Virtues:</strong> We value truth, honesty, tolerance, integrity and responsibility.</div></li></ul></div>
</div>
<h3>Living Our Values</h3>
<p>Our values are not simply words on a page — they are the lived experience of every member of the ERV community, from our youngest Early Years students to our graduating IB Diploma cohort.</p>
HTML;

include ROOT . '/includes/page.php';
?>
