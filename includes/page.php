<?php
/**
 * Generic inner page template — Ecole Ruban Vert
 * Include this file after setting $page config vars:
 *   $pageTitle, $pageDesc, $pageBannerTitle, $pageBannerDesc,
 *   $breadcrumbs, $mainContent (HTML string), $sidebarContent (HTML string, optional)
 *   $rootPath, $bodyClass
 */
if (!defined('ROOT')) define('ROOT', dirname(__DIR__));
include ROOT . '/includes/header.php';
?>

<section class="content-section">
  <div class="container">
    <?php if (isset($sidebarContent) && $sidebarContent): ?>
    <div class="content-grid">
      <div class="content-main">
        <?= $mainContent ?>
      </div>
      <aside class="sidebar">
        <?= $sidebarContent ?>
      </aside>
    </div>
    <?php else: ?>
    <div class="content-main" style="max-width:860px; margin:0 auto;">
      <?= $mainContent ?>
    </div>
    <?php endif; ?>
  </div>
</section>

<?php include ROOT . '/includes/footer.php'; ?>
