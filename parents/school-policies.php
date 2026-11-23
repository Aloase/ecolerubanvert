<?php
define('ROOT', dirname(__DIR__));
$pageTitle       = 'School Policies | Ecole Ruban Vert';
$pageDesc        = 'Access ERV\'s key school policies including safeguarding, behaviour and health and safety.';
$pageBannerTitle = 'School Policies';
$pageBannerDesc  = 'Access ERV\'s key school policies including safeguarding, behaviour and health and safety.';
$rootPath        = '../';
$r               = $rootPath;
$breadcrumbs     = [
    ['label'=>'Parents','url'=>'../parents/index.php'],
    ['label'=>'School Policies','url'=>'../parents/school-policies.php'],
];

ob_start();
include ROOT . '/includes/sidebar.php';
$sidebarContent = ob_get_clean();

$mainContent = <<<'HTML'
<h2>School Policies</h2>
<p>ERV maintains a comprehensive set of policies to ensure the safety, wellbeing and success of every student. Key policies include:</p>
<ul>
  <li>Safeguarding &amp; Child Protection Policy</li>
  <li>Behaviour &amp; Discipline Policy</li>
  <li>Anti-Bullying Policy</li>
  <li>Health &amp; Safety Policy</li>
  <li>Data Protection &amp; Privacy Policy</li>
  <li>Admissions Policy</li>
</ul>
<div class="alert alert-info"><i class="fas fa-info-circle"></i> Full policy documents are available on request from the school office.</div>
HTML;

include ROOT . '/includes/page.php';
?>
