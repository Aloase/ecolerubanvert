<?php
define('ROOT', dirname(__DIR__, 2));
$pageTitle       = 'Parental Involvement | Ecole Ruban Vert';
$pageDesc        = 'Discover the many ways parents can get involved in school life at ERV.';
$pageBannerTitle = 'Parental Involvement';
$pageBannerDesc  = 'Discover the many ways parents can get involved in school life at ERV.';
$rootPath        = '../../';
$r               = $rootPath;
$breadcrumbs     = [
    ['label'=>'Parents','url'=>'../../parents/index.php'],
    ['label'=>'Friends of ERV','url'=>'../../parents/friends-of-erv/index.php'],
    ['label'=>'Parental Involvement','url'=>'../../parents/friends-of-erv/parental-involvement.php'],
];

ob_start();
include ROOT . '/includes/sidebar.php';
$sidebarContent = ob_get_clean();

$mainContent = <<<'HTML'
<h2>Parental Involvement</h2>
<p>We value the involvement of parents in school life. There are many ways to get involved, from classroom support to organising community events.</p>
<ul>
  <li>Classroom helper programmes</li>
  <li>Organising cultural and fundraising events</li>
  <li>Sharing professional expertise with students (career talks)</li>
  <li>Supporting school trips and outings</li>
  <li>Serving on the Friends of ERV committee</li>
</ul>
HTML;

include ROOT . '/includes/page.php';
?>
