<?php
/**
 * Page d'accueil française — Ecole Ruban Vert
 */
define('ROOT', dirname(__DIR__));

$pageTitle = 'Ecole Ruban Vert | École Internationale Libreville Gabon';
$pageDesc  = "Ecole Internationale Ruban Vert — École internationale IB à Libreville, Gabon. Programmes PYP, IMYC, IGCSE et Baccalauréat International. 100% de réussite au Bac IB depuis 6 ans.";
$isHome    = true;
$rootPath  = '../';
$r         = $rootPath;

include ROOT . '/includes/header.php';
?>

<!-- ================================================
     BANDEAU D'ACTUALITÉS
     ================================================ -->
<div class="news-ticker" aria-label="Dernières actualités">
  <div class="container">
    <div class="ticker-inner">
      <span class="ticker-label">📢 Actus</span>
      <div class="ticker-track">
        <div class="ticker-content">
          <span class="ticker-item">L'ERV maintient 100% de réussite à l'IGCSE — 6e année consécutive !</span>
          <span class="ticker-item">62% des élèves obtiennent des notes élevées (7/8/9) à l'IGCSE</span>
          <span class="ticker-item">Meilleur score IBDP jamais atteint : 43/45 points (96%)</span>
          <span class="ticker-item">Moyenne IBDP la plus élevée : 36/45 points par élève (80%)</span>
          <span class="ticker-item">100% de réussite au Baccalauréat International et Bac Bilingue IB</span>
          <span class="ticker-item">Meilleures notes en Anglais, Français, Informatique, Géographie et Arts Visuels</span>
          <span class="ticker-item">L'ERV maintient 100% de réussite à l'IGCSE — 6e année consécutive !</span>
          <span class="ticker-item">62% des élèves obtiennent des notes élevées (7/8/9) à l'IGCSE</span>
          <span class="ticker-item">Meilleur score IBDP jamais atteint : 43/45 points (96%)</span>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ================================================
     HERO
     ================================================ -->
<section class="hero" id="intro">
  <div class="hero-slider">
    <div class="hero-slide active" style="background-image:url('../assets/images/hero-1.jpg'); background-color:#1B5E20;"></div>
    <div class="hero-slide" style="background-image:url('../assets/images/hero-2.jpg'); background-color:#2E7D32;"></div>
    <div class="hero-slide" style="background-image:url('../assets/images/hero-3.jpg'); background-color:#388E3C;"></div>
  </div>

  <div class="container" style="position:relative; z-index:2; width:100%;">
    <div class="hero-content">
      <div class="hero-badge">
        <i class="fas fa-globe-africa"></i>
        École du monde IB · Libreville, Gabon
      </div>

      <h1>
        École Internationale<br>
        du <em>Gabon Ruban Vert</em>
      </h1>

      <p class="hero-desc">
        Une école internationale IB bilingue au cœur de Libreville,
        qui cultive la curiosité et forme les leaders mondiaux de demain
        à travers l'excellence, le respect et l'innovation.
      </p>

      <div class="hero-actions">
        <a href="../admissions/open-apply.php" class="btn-primary">
          <i class="fas fa-paper-plane"></i> Candidater
        </a>
        <a href="../about-us/index.php" class="btn-secondary">
          <i class="fas fa-play-circle"></i> Découvrir l'ERV
        </a>
      </div>
    </div>
  </div>

  <div class="hero-stats">
    <div class="hero-stat">
      <span class="stat-num">100%</span>
      <span class="stat-label">Réussite au Bac IB</span>
    </div>
    <div class="hero-stat">
      <span class="stat-num">43<small style="font-size:1rem;">/45</span>
      <span class="stat-label">Meilleur Score IB</span>
    </div>
    <div class="hero-stat">
      <span class="stat-num">6<small style="font-size:1rem;">ans</small></span>
      <span class="stat-label">Consécutifs</span>
    </div>
  </div>

  <div class="hero-dots" role="tablist">
    <button class="hero-dot active" role="tab" aria-label="Slide 1"></button>
    <button class="hero-dot"        role="tab" aria-label="Slide 2"></button>
    <button class="hero-dot"        role="tab" aria-label="Slide 3"></button>
  </div>

  <a href="#liens-rapides" style="
    position:absolute; bottom:5rem; left:50%; transform:translateX(-50%);
    z-index:3; color:rgba(255,255,255,.7); font-size:1.5rem; animation:bounce 2s infinite;
    text-decoration:none;
  " aria-label="Défiler vers le bas"><i class="fas fa-chevron-down"></i></a>
</section>

<style>
@keyframes bounce {
  0%,100%{transform:translateX(-50%) translateY(0)}
  50%{transform:translateX(-50%) translateY(8px)}
}
</style>

<!-- ================================================
     LIENS RAPIDES
     ================================================ -->
<section class="quick-links" id="liens-rapides">
  <div class="container">
    <div class="quick-links-grid">
      <a href="../school-life/sports.php" class="quick-link-card" data-reveal>
        <div class="quick-link-icon">🏆</div>
        <div class="quick-link-title">Sports</div>
      </a>
      <a href="../facilities/index.php" class="quick-link-card" data-reveal>
        <div class="quick-link-icon">🏫</div>
        <div class="quick-link-title">Installations</div>
      </a>
      <a href="../about-us/vacancies.php" class="quick-link-card" data-reveal>
        <div class="quick-link-icon">💼</div>
        <div class="quick-link-title">Offres d'emploi</div>
      </a>
      <a href="../school-life/extra-curricular.php" class="quick-link-card" data-reveal>
        <div class="quick-link-icon">🎨</div>
        <div class="quick-link-title">Activités</div>
      </a>
      <a href="../school-life/news.php" class="quick-link-card" data-reveal>
        <div class="quick-link-icon">📰</div>
        <div class="quick-link-title">Actualités</div>
      </a>
      <a href="../admissions/index.php" class="quick-link-card" data-reveal>
        <div class="quick-link-icon">📋</div>
        <div class="quick-link-title">Admissions</div>
      </a>
    </div>
  </div>
</section>

<!-- ================================================
     PRÉSENTATION
     ================================================ -->
<section class="section bg-white">
  <div class="container">
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:4rem; align-items:center;">
      <div data-reveal="left">
        <span class="section-tag">Qui Sommes-Nous</span>
        <h2 class="section-title">L'École la Plus <span>Entreprenante</span> d'Afrique</h2>
        <div class="divider" style="margin:1rem 0;"></div>
        <p style="color:var(--gray); line-height:1.9;">
          L'Ecole Internationale Ruban Vert (ERV) est une école internationale bilingue
          de premier plan à Libreville, au Gabon. Nous sommes fiers d'être une école du
          monde IB accréditée par le CIS, offrant une éducation de classe mondiale alliant
          rigueur académique, créativité, durabilité et innovation.
        </p>
        <p style="color:var(--gray); line-height:1.9;">
          Avec des programmes allant de la Petite Enfance au Baccalauréat International,
          l'ERV forme des individus confiants, bienveillants et ouverts sur le monde,
          prêts à devenir des leaders dans un monde en constante évolution.
        </p>
        <div style="display:flex; gap:1rem; margin-top:1.5rem; flex-wrap:wrap;">
          <a href="../about-us/index.php" class="btn-primary">
            <i class="fas fa-info-circle"></i> À Propos de l'ERV
          </a>
          <a href="../about-us/vision.php" class="btn-secondary" style="background:transparent; color:var(--green-primary); border-color:var(--green-primary);">
            Notre Mission &amp; Vision
          </a>
        </div>
      </div>

      <div data-reveal="right" style="display:grid; grid-template-columns:1fr 1fr; gap:1rem; border-radius:var(--radius-lg); overflow:hidden;">
        <div style="height:200px; border-radius:var(--radius-lg); background:linear-gradient(135deg,#C8E6C9,#81C784); display:flex; align-items:center; justify-content:center; font-size:3rem; grid-column:1 / -1;">🎓</div>
        <div style="height:160px; border-radius:var(--radius-lg); background:linear-gradient(135deg,#FFF8E1,#FFE082); display:flex; align-items:center; justify-content:center; font-size:2.5rem;">🌍</div>
        <div style="height:160px; border-radius:var(--radius-lg); background:linear-gradient(135deg,#E3F2FD,#90CAF9); display:flex; align-items:center; justify-content:center; font-size:2.5rem;">📚</div>
      </div>
    </div>
  </div>
</section>

<!-- ================================================
     STATISTIQUES
     ================================================ -->
<section class="section stats-section">
  <div class="container">
    <div class="stats-grid">
      <div class="stat-item" data-reveal>
        <span class="stat-num" data-target="100" data-suffix="%">100%</span>
        <span class="stat-label">Réussite au Bac IB</span>
      </div>
      <div class="stat-item" data-reveal>
        <span class="stat-num" data-target="36" data-suffix="/45">36/45</span>
        <span class="stat-label">Score Moyen IBDP</span>
      </div>
      <div class="stat-item" data-reveal>
        <span class="stat-num" data-target="6" data-suffix=" Ans">6 Ans</span>
        <span class="stat-label">D'Excellence Consécutive</span>
      </div>
      <div class="stat-item" data-reveal>
        <span class="stat-num" data-target="50" data-suffix="+">50+</span>
        <span class="stat-label">Nationalités</span>
      </div>
    </div>
  </div>
</section>

<!-- ================================================
     MISSION / VISION / VALEURS
     ================================================ -->
<section class="section mvv-section">
  <div class="container">
    <div class="section-header">
      <span class="section-tag">Notre Identité</span>
      <h2 class="section-title">Mission, <span>Vision</span> &amp; Valeurs</h2>
      <div class="divider"></div>
      <p class="section-subtitle">
        Trois principes directeurs façonnent notre communauté et nos élèves.
      </p>
    </div>

    <div class="mvv-grid">
      <div class="mvv-card mission" data-reveal>
        <div class="mvv-icon">🎯</div>
        <h3>Notre Mission</h3>
        <p>
          Devenir l'école la plus entreprenante d'Afrique, en mettant l'accent sur
          la durabilité et l'innovation pour jouer un rôle important dans l'éducation
          au Gabon et en Afrique.
        </p>
      </div>

      <div class="mvv-card vision" data-reveal>
        <div class="mvv-icon">🌟</div>
        <h3>Notre Vision</h3>
        <p>
          Offrir un héritage éducatif qui promeut l'ouverture d'esprit, la tolérance
          et le respect d'autrui, un modèle de référence pour l'avenir des élèves de
          toutes les nations au Gabon.
        </p>
      </div>

      <div class="mvv-card values" data-reveal>
        <div class="mvv-icon">💎</div>
        <h3>Nos Valeurs</h3>
        <ul class="values-list">
          <li>
            <span class="value-dot"></span>
            <div><strong>Excellence :</strong> Nous visons l'excellence dans tous les aspects de la vie.</div>
          </li>
          <li>
            <span class="value-dot"></span>
            <div><strong>Respect :</strong> Nous nous respectons nous-mêmes, notre environnement et les autres.</div>
          </li>
          <li>
            <span class="value-dot"></span>
            <div><strong>Vertus :</strong> Nous valorisons la vérité, l'honnêteté, la tolérance, l'intégrité et la responsabilité.</div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- ================================================
     TÉMOIGNAGES
     ================================================ -->
<section class="section testimonials">
  <div class="container">
    <div class="section-header">
      <span class="section-tag">Voix de la Communauté</span>
      <h2 class="section-title" style="color:var(--white);">Ce Que L'on <span>Dit</span> de Nous</h2>
      <div class="divider"></div>
    </div>

    <div class="testimonials-grid">
      <div class="testimonial-card" data-reveal>
        <div class="testimonial-quote">"</div>
        <p class="testimonial-text">
          L'ERV est une école pionnière où chaque enfant s'engage à devenir une
          personne indépendante et curieuse, désireuse de découvrir le monde qui l'entoure.
        </p>
        <div class="testimonial-author">
          <div class="author-avatar">KP</div>
          <div>
            <div class="author-name">Karine Perkins</div>
            <div class="author-role">Directrice de la Maison des Enfants</div>
          </div>
        </div>
      </div>

      <div class="testimonial-card" data-reveal>
        <div class="testimonial-quote">"</div>
        <p class="testimonial-text">
          Travailler à l'ERV est une expérience enrichissante et gratifiante.
          C'est un peu comme être chez soi. Je suis très fière d'être ici.
        </p>
        <div class="testimonial-author">
          <div class="author-avatar">F</div>
          <div>
            <div class="author-name">Félicia</div>
            <div class="author-role">Personnel de Soutien ERV</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ================================================
     CONTACT
     ================================================ -->
<section class="section contact-section">
  <div class="container">
    <div class="contact-grid">
      <div data-reveal="left">
        <span class="section-tag">Contactez-Nous</span>
        <h3>Nous Aimerions <span style="color:var(--gold);">Vous Entendre</span></h3>
        <p style="color:var(--gray); margin:1rem 0 1.5rem;">
          Que vous soyez un parent, un élève ou simplement curieux de l'ERV,
          notre équipe est là pour vous aider.
        </p>

        <div class="contact-details">
          <div class="contact-detail">
            <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
            <div class="contact-detail-text">
              <strong>Adresse</strong>
              <span>Batterie IV, Libreville, GABON — BP : 2144</span>
            </div>
          </div>
          <div class="contact-detail">
            <div class="contact-icon"><i class="fas fa-phone"></i></div>
            <div class="contact-detail-text">
              <strong>Téléphone</strong>
              <span>+241 (0)74 84 33 80 / (0)11 44 26 70</span>
            </div>
          </div>
          <div class="contact-detail">
            <div class="contact-icon"><i class="fas fa-envelope"></i></div>
            <div class="contact-detail-text">
              <strong>Email</strong>
              <a href="mailto:reception@ecolerubanvert.com">reception@ecolerubanvert.com</a>
            </div>
          </div>
        </div>

        <a href="../admissions/index.php" class="btn-primary" style="margin-top:1rem;">
          <i class="fas fa-user-graduate"></i> Commencer les Admissions
        </a>
      </div>

      <div data-reveal="right">
        <form id="contact-form" class="contact-form" novalidate>
          <h4 style="font-size:1.3rem; margin-bottom:1.5rem; color:var(--green-dark);">
            Envoyez-Nous un Message
          </h4>
          <div id="form-message"></div>
          <div class="form-row">
            <div class="form-group">
              <label for="cf-name">Nom Complet *</label>
              <input type="text" id="cf-name" name="name" class="form-control" placeholder="Votre nom" required>
            </div>
            <div class="form-group">
              <label for="cf-email">Adresse Email *</label>
              <input type="email" id="cf-email" name="email" class="form-control" placeholder="vous@exemple.com" required>
            </div>
          </div>
          <div class="form-group">
            <label for="cf-message">Message *</label>
            <textarea id="cf-message" name="message" class="form-control" placeholder="Écrivez votre message ici…" required></textarea>
          </div>
          <div class="form-group" style="display:flex; align-items:center; gap:.75rem;">
            <input type="checkbox" id="cf-privacy" name="privacy" required style="width:16px; height:16px;">
            <label for="cf-privacy" style="font-size:.82rem; color:var(--gray); margin:0;">
              J'accepte la <a href="../terms.php" target="_blank">Politique de Confidentialité</a>
            </label>
          </div>
          <button type="submit" class="btn-submit">
            <i class="fas fa-paper-plane"></i> Envoyer le Message
          </button>
        </form>
      </div>
    </div>
  </div>
</section>

<?php include ROOT . '/includes/footer.php'; ?>
