<?php
define('ROOT', __DIR__);
header("HTTP/1.0 404 Not Found");

$pageTitle       = 'Page non trouvee (404) | Ecole Ruban Vert';
$pageDesc        = "La page que vous recherchez n'existe pas ou a ete deplacee.";
$pageBannerTitle = 'Page introuvable';
$pageBannerDesc  = "Desolee, cette page n'existe pas ou plus.";
$rootPath        = '';
$r               = '';
$breadcrumbs     = [
  ['label'=>'Page introuvable','url'=>'404.php'],
];

include ROOT . '/includes/header.php';
?>

<section class="content-section">
  <div class="container" style="text-align:center; max-width:600px;">
    <div style="font-size:5rem; color:var(--green-primary); font-weight:800; line-height:1;">404</div>
    <h2 style="margin-top:1rem;">Oups, cette page s'est envolee...</h2>
    <p style="color:var(--gray); margin:1rem 0 2rem;">La page que vous recherchez n'existe pas, a ete renommee ou deplacee. Utilisez les liens ci-dessous pour retrouver votre chemin.</p>
    <div style="display:flex; gap:1rem; justify-content:center; flex-wrap:wrap;">
      <a href="<?= $r ?>index.php" class="btn-primary"><i class="fas fa-house"></i> Retour a l'accueil</a>
      <a href="<?= $r ?>sitemap.php" class="btn-secondary"><i class="fas fa-map"></i> Voir le sitemap</a>
      <a href="<?= $r ?>contact.php" class="btn-secondary"><i class="fas fa-envelope"></i> Nous contacter</a>
    </div>
  </div>
</section>

<?php include ROOT . '/includes/footer.php'; ?>
