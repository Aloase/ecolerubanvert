<?php
define('ROOT', dirname(__DIR__));
$pageTitle       = 'Application via Open Apply | Ecole Ruban Vert';
$pageDesc        = 'Apply to ERV online using the Open Apply portal.';
$pageBannerTitle = 'Application via Open Apply';
$pageBannerDesc  = 'Apply to ERV online using the Open Apply portal.';
$rootPath        = '../';
$r               = $rootPath;
$breadcrumbs     = [
    ['label'=>'Admissions','url'=>'../admissions/index.php'],
    ['label'=>'Open Apply','url'=>'../admissions/open-apply.php'],
];

ob_start();
include ROOT . '/includes/sidebar.php';
$sidebarContent = ob_get_clean();

$mainContent = <<<'HTML'
<h2>Application via Open Apply</h2>
<p>ERV uses Open Apply, a secure online admissions management platform, to process all applications. The platform makes it easy for families to apply, track their application and upload supporting documents from anywhere in the world.</p>
<h3>What You Will Need</h3>
<ul>
  <li>Passport copies for the student and parents/guardians</li>
  <li>Most recent two years of school reports / transcripts</li>
  <li>A recent passport-sized photograph</li>
  <li>Immunisation/vaccination records</li>
  <li>Contact details for a current or previous school (for reference)</li>
</ul>
<div class="alert alert-info"><i class="fas fa-info-circle"></i> Please note: Submitting an application does not guarantee a place. All applications are reviewed by our Admissions Team and places are offered subject to availability.</div>
<a href="https://ecolerubanvert.openapply.com/" target="_blank" rel="noopener" class="btn-primary" style="margin-top:1rem;display:inline-flex;"><i class="fas fa-external-link-alt"></i> Apply via Open Apply</a>
HTML;

include ROOT . '/includes/page.php';
?>
