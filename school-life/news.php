<?php
define('ROOT', dirname(__DIR__));
$pageTitle       = 'News | Ecole Ruban Vert';
$pageDesc        = 'Stay up to date with the latest news and achievements from ERV.';
$pageBannerTitle = 'School News';
$pageBannerDesc  = 'Stay up to date with the latest news and achievements from ERV.';
$rootPath        = '../';
$r               = $rootPath;
$breadcrumbs     = [
    ['label'=>'School Life','url'=>'../school-life/index.php'],
    ['label'=>'News','url'=>'../school-life/news.php'],
];

ob_start();
include ROOT . '/includes/sidebar.php';
$sidebarContent = ob_get_clean();

$mainContent = <<<'HTML'
<h2>Latest News</h2>
<div class="news-grid" style="grid-template-columns:1fr;gap:1.5rem;margin-top:1.5rem;">
  <article class="news-card" style="display:flex;flex-direction:row;overflow:hidden;">
    <div class="news-card-img" style="width:200px;flex-shrink:0;height:auto;background:#C8E6C9;"><div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:3rem;">🏅</div></div>
    <div class="news-card-body"><div class="news-card-date"><i class="fas fa-calendar-alt"></i> September 2024</div><h3>ERV Records Best-Ever IBDP Results</h3><p>Our IB Diploma students achieved a record average of 36/45 points with a 100% pass rate.</p></div>
  </article>
  <article class="news-card" style="display:flex;flex-direction:row;overflow:hidden;">
    <div class="news-card-img" style="width:200px;flex-shrink:0;height:auto;background:#FFF8E1;"><div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:3rem;">🥁</div></div>
    <div class="news-card-body"><div class="news-card-date"><i class="fas fa-calendar-alt"></i> August 2024</div><h3>African Heritage Week Celebrates Culture</h3><p>ERV students, parents and staff celebrated African culture through music, dance and art.</p></div>
  </article>
  <article class="news-card" style="display:flex;flex-direction:row;overflow:hidden;">
    <div class="news-card-img" style="width:200px;flex-shrink:0;height:auto;background:#E3F2FD;"><div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:3rem;">⚽</div></div>
    <div class="news-card-body"><div class="news-card-date"><i class="fas fa-calendar-alt"></i> July 2024</div><h3>ERV Football Team Wins Regional Championship</h3><p>Congratulations to the ERV football team on winning the AISA Regional Championship.</p></div>
  </article>
</div>
HTML;

include ROOT . '/includes/page.php';
?>
