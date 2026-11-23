<?php
define('ROOT', dirname(__DIR__));
$pageTitle       = 'Primary School — IB PYP | Ecole Ruban Vert';
$pageDesc        = 'ERV Primary School follows the IB Primary Years Programme (PYP) for students aged 3-12.';
$pageBannerTitle = 'Primary Years Programme';
$pageBannerDesc  = 'ERV Primary School follows the IB Primary Years Programme (PYP) for students aged 3-12.';
$rootPath        = '../';
$r               = $rootPath;
$breadcrumbs     = [
    ['label'=>'Curriculum','url'=>'../curriculum/index.php'],
    ['label'=>'Primary School','url'=>'../curriculum/primary-school.php'],
];

ob_start();
include ROOT . '/includes/sidebar.php';
$sidebarContent = ob_get_clean();

$mainContent = <<<'HTML'
<h2>IB Primary Years Programme (PYP)</h2>
<p>The International Baccalaureate Primary Years Programme (PYP) at ERV provides a transdisciplinary framework that nurtures and develops young students as caring, active participants in a lifelong journey of learning.</p>
<div class="alert alert-success"><i class="fas fa-globe"></i> ERV is an authorised IB World School — PYP, IBDP</div>
<h3>What Is the PYP?</h3>
<p>The PYP is designed for students aged 3–12. It focuses on the development of the whole child — their physical, emotional, social, aesthetic, cognitive and cultural needs — and is guided by six transdisciplinary themes that help children understand the world.</p>
<h3>The Six Themes</h3>
<ul>
  <li>Who We Are</li>
  <li>Where We Are in Place and Time</li>
  <li>How We Express Ourselves</li>
  <li>How the World Works</li>
  <li>How We Organise Ourselves</li>
  <li>Sharing the Planet</li>
</ul>
<h3>Languages in the PYP</h3>
<p>All PYP students at ERV study in both English and French. Additional language support is available for students who are developing their proficiency in either language.</p>
HTML;

include ROOT . '/includes/page.php';
?>
