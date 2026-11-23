<?php
define('ROOT', __DIR__);
$pageTitle       = 'Privacy / Terms | Ecole Ruban Vert';
$pageDesc        = "Ecole Ruban Vert's Privacy Policy and Terms of Use.";
$pageBannerTitle = 'Privacy / Terms';
$pageBannerDesc  = 'Our commitment to protecting your privacy and the terms governing use of this website.';
$rootPath        = '';
$r               = '';
$breadcrumbs     = [
  ['label'=>'Privacy / Terms','url'=>'terms.php'],
];

ob_start();
include ROOT . '/includes/sidebar.php';
$sidebarContent = ob_get_clean();

$mainContent = <<<'HTML'
<h2>Privacy Policy</h2>
<p>Ecole Internationale Ruban Vert ("ERV", "we", "us") is committed to protecting the privacy of our students, parents, staff and website visitors. This policy explains how we collect, use and protect personal information.</p>
<h3>Information We Collect</h3>
<p>We may collect names, contact details, and enquiry information submitted through our contact and admissions forms. This information is used solely to respond to enquiries and process applications.</p>
<h3>How We Use Your Information</h3>
<ul>
  <li>To respond to enquiries and admissions applications</li>
  <li>To communicate important school updates</li>
  <li>To improve our website and services</li>
</ul>
<h3>Data Protection</h3>
<p>We take appropriate technical and organisational measures to protect personal data against unauthorised access, loss or misuse.</p>

<h2 style="margin-top:2.5rem;">Terms of Use</h2>
<p>By accessing this website, you agree to these terms of use. Content on this site is the property of Ecole Internationale Ruban Vert and may not be reproduced without permission.</p>
<h3>Limitation of Liability</h3>
<p>While we strive to keep information on this website accurate and up to date, ERV makes no warranties regarding the completeness or accuracy of the content provided.</p>
<h3>Contact</h3>
<p>If you have any questions about this Privacy Policy or our Terms of Use, please <a href="contact.php">contact us</a>.</p>
HTML;

include ROOT . '/includes/page.php';
