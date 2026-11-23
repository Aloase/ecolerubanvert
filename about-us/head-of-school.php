<?php
define('ROOT', dirname(__DIR__));
$pageTitle       = 'Head of School | Ecole Ruban Vert';
$pageDesc        = 'A welcome message and introduction from the Head of Ecole Ruban Vert.';
$pageBannerTitle = 'Head of School';
$pageBannerDesc  = 'A welcome message and introduction from the Head of Ecole Ruban Vert.';
$rootPath        = '../';
$r               = $rootPath;
$breadcrumbs     = [
    ['label'=>'About Us','url'=>'../about-us/index.php'],
    ['label'=>'Head of School','url'=>'../about-us/head-of-school.php'],
];

ob_start();
include ROOT . '/includes/sidebar.php';
$sidebarContent = ob_get_clean();

$mainContent = <<<'HTML'
<h2>Head of School</h2>
<div style="display:flex;gap:2rem;align-items:flex-start;margin-bottom:2rem;flex-wrap:wrap;">
  <div style="width:160px;height:200px;border-radius:var(--radius-lg);background:linear-gradient(135deg,#C8E6C9,#81C784);flex-shrink:0;display:flex;align-items:center;justify-content:center;font-size:4rem;">👤</div>
  <div>
    <h3 style="margin-bottom:.25rem;">Head of School</h3>
    <p style="color:var(--green-primary);font-weight:600;">Ecole Internationale Ruban Vert</p>
    <p style="margin-top:1rem;">Welcome to ERV! Our Head of School leads with passion, vision and a deep commitment to international education. Under their leadership, ERV continues to achieve outstanding academic results and nurture a thriving school community.</p>
  </div>
</div>
<h3>Welcome Message</h3>
<p>Welcome to Ecole Internationale Ruban Vert. At ERV, we are committed to providing the very best international education in Gabon and across Africa. Our students are at the heart of everything we do, and we work tirelessly to ensure that every child receives the support, challenge and inspiration they need to achieve their full potential.</p>
<p>Whether you are a prospective family, a current member of our community, or simply curious about who we are, I invite you to explore our school and discover the ERV difference.</p>
HTML;

include ROOT . '/includes/page.php';
?>
