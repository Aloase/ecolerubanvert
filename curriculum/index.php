<?php
define('ROOT', dirname(__DIR__));
$pageTitle       = 'Curriculum | Ecole Ruban Vert';
$pageDesc        = 'ERV offers a world-class curriculum from Early Years through IB Diploma, with programmes recognised globally.';
$pageBannerTitle = 'Our Curriculum';
$pageBannerDesc  = 'ERV offers a world-class curriculum from Early Years through IB Diploma, with programmes recognised globally.';
$rootPath        = '../';
$r               = $rootPath;
$breadcrumbs     = [
    ['label'=>'Curriculum','url'=>'../curriculum/index.php'],
];

ob_start();
include ROOT . '/includes/sidebar.php';
$sidebarContent = ob_get_clean();

$mainContent = <<<'HTML'
<h2>ERV Curriculum Overview</h2>
<p>At ERV, we offer a coherent, internationally-recognised educational pathway that spans from Early Years through to the IB Diploma Programme. Our curriculum is designed to develop the whole child — intellectually, socially, emotionally and physically.</p>
<div class="program-grid" style="margin:2rem 0;">
  <div class="program-card"><div class="program-header"><span class="program-icon">🌱</span><h3>Early Years</h3><div class="age-range">Ages 3–5</div></div><div class="program-body"><p>Nurturing, play-based learning that sparks curiosity.</p></div><div style="padding:0 1.5rem 1.5rem;"><a href="../curriculum/early-years.php" class="read-more">Learn more <i class="fas fa-arrow-right"></i></a></div></div>
  <div class="program-card gold-border"><div class="program-header" style="background:#FFF8E1;"><span class="program-icon">📗</span><h3>PYP (Primary)</h3><div class="age-range">Ages 3–12 · IB PYP</div></div><div class="program-body"><p>The IB Primary Years Programme develops the whole child.</p></div><div style="padding:0 1.5rem 1.5rem;"><a href="../curriculum/primary-school.php" class="read-more">Learn more <i class="fas fa-arrow-right"></i></a></div></div>
  <div class="program-card"><div class="program-header"><span class="program-icon">🔬</span><h3>Secondary</h3><div class="age-range">Ages 11–16 · IMYC & IGCSE</div></div><div class="program-body"><p>IMYC and internationally-recognised IGCSE qualifications.</p></div><div style="padding:0 1.5rem 1.5rem;"><a href="../curriculum/secondary-school/index.php" class="read-more">Learn more <i class="fas fa-arrow-right"></i></a></div></div>
  <div class="program-card navy-border"><div class="program-header" style="background:#E8EAF6;"><span class="program-icon">🏅</span><h3>IB Diploma</h3><div class="age-range">Ages 16–18 · IBDP</div></div><div class="program-body"><p>100% pass rate for 6 consecutive years.</p></div><div style="padding:0 1.5rem 1.5rem;"><a href="../curriculum/ibdp/index.php" class="read-more">Learn more <i class="fas fa-arrow-right"></i></a></div></div>
</div>
HTML;

include ROOT . '/includes/page.php';
?>
