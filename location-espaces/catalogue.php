<?php
define('ROOT', dirname(__DIR__));
require_once ROOT . '/config/db.php';
require_once ROOT . '/includes/rentals-helpers.php';

$rootPath = '../';
$r        = $rootPath;

$spaces = db()->query(
    "SELECT s.*, (SELECT image_path FROM rental_space_images WHERE space_id = s.id ORDER BY sort_order LIMIT 1) AS extra_image
     FROM rental_spaces s WHERE s.is_active = 1 ORDER BY s.name"
)->fetchAll();

$pageTitle       = 'Location d\'espaces | Ecole Ruban Vert';
$pageDesc        = 'Louez nos salles, gymnase, auditorium ou espaces exterieurs pour vos evenements.';
$pageBannerTitle = "Location d'espaces";
$pageBannerDesc  = "Salles de classe, gymnase, auditorium, cour ou cantine : decouvrez nos espaces disponibles a la location.";
$breadcrumbs     = [
    ['label'=>"Location d'espaces",'url'=>'../location-espaces/catalogue.php'],
];

include ROOT . '/includes/header.php';
?>

<section class="content-section">
  <div class="container">

    <?php if (!$spaces): ?>
      <div style="background:#FFF8E1; color:#E65100; padding:1.25rem; border-radius:10px;">
        Aucun espace n'est actuellement publie. Revenez bientot ou <a href="<?= $r ?>contact.php">contactez-nous</a>.
      </div>
    <?php else: ?>
    <div class="grid" style="display:grid; grid-template-columns:repeat(auto-fill,minmax(300px,1fr)); gap:2rem;">
      <?php foreach ($spaces as $s): ?>
      <article class="news-card" data-reveal>
        <div class="news-card-img">
          <?php if ($s['cover_image']): ?>
            <img loading="lazy" src="<?= $r . htmlspecialchars($s['cover_image']) ?>" alt="<?= htmlspecialchars($s['name']) ?>">
          <?php else: ?>
            <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:3rem;background:var(--green-bg);"><i class="fas fa-door-open"></i></div>
          <?php endif; ?>
          <span class="news-card-cat"><?= (int)$s['capacity'] ?> pers.</span>
        </div>
        <div class="news-card-body">
          <h3><?= htmlspecialchars($s['name']) ?></h3>
          <p><?= htmlspecialchars(mb_strimwidth((string)$s['description'], 0, 140, '...')) ?></p>
          <div style="display:flex; justify-content:space-between; align-items:center; margin-top:1rem;">
            <div style="font-weight:700; color:var(--green-primary);">
              <?php if ($s['price_per_hour']): ?>
                <?= number_format((float)$s['price_per_hour'], 0, ',', ' ') ?> FCFA / h
              <?php elseif ($s['price_per_day']): ?>
                <?= number_format((float)$s['price_per_day'], 0, ',', ' ') ?> FCFA / jour
              <?php else: ?>
                Sur devis
              <?php endif; ?>
            </div>
            <a href="espace.php?slug=<?= urlencode($s['slug']) ?>" class="btn-secondary" style="padding:.5rem 1.1rem; font-size:.85rem;">Voir &amp; reserver</a>
          </div>
        </div>
      </article>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <div style="text-align:center; margin-top:3rem;">
      <p style="color:var(--gray);">Vous avez deja fait une demande de location ?</p>
      <a href="suivi.php" class="btn-secondary"><i class="fas fa-magnifying-glass"></i> Suivre ma demande</a>
    </div>

  </div>
</section>

<?php include ROOT . '/includes/footer.php'; ?>
