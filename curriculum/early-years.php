<?php
define('ROOT', dirname(__DIR__));
$pageTitle       = 'Early Years | Ecole Ruban Vert';
$pageDesc        = 'ERV Early Years programme — a nurturing, bilingual play-based learning environment for children aged 3-5.';
$pageBannerTitle = 'Early Years';
$pageBannerDesc  = 'ERV Early Years programme — a nurturing, bilingual play-based learning environment for children aged 3-5.';
$rootPath        = '../';
$r               = $rootPath;
$breadcrumbs     = [
    ['label'=>'Curriculum','url'=>'../curriculum/index.php'],
    ['label'=>'Early Years','url'=>'../curriculum/early-years.php'],
];

ob_start();
include ROOT . '/includes/sidebar.php';
$sidebarContent = ob_get_clean();

$mainContent = <<<'HTML'
<h2>Early Years at ERV</h2>
<p>Our Early Years programme provides a warm, nurturing and stimulating environment for children from age 3. We believe that the early years are the most critical in a child's development, and we work hard to ensure every child has the best possible start.</p>
<h3>Our Approach</h3>
<p>We use a play-based, inquiry-led approach that encourages children to explore, discover and make sense of the world around them. Our bilingual environment means children develop strong foundations in both English and French from the very beginning.</p>
<h3>Key Features</h3>
<ul>
  <li>Small class sizes with high adult-to-child ratios</li>
  <li>Bilingual instruction (English and French)</li>
  <li>Purpose-built Early Years facilities</li>
  <li>Outdoor learning and nature-based activities</li>
  <li>Regular communication with parents</li>
  <li>Music, art and physical education from day one</li>
</ul>
HTML;

include ROOT . '/includes/page.php';
?>
