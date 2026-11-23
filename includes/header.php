<?php
/**
 * Header include — Ecole Ruban Vert
 * Usage: include ROOT . '/includes/header.php';
 *
 * Expected vars (set before including):
 *   $pageTitle       — full <title> tag content
 *   $pageDesc        — meta description
 *   $bodyClass       — extra body classes
 *   $breadcrumbs     — array of ['label'=>'...','url'=>'...'] (last item = current)
 *   $pageBannerTitle — inner-page hero title
 *   $pageBannerDesc  — inner-page hero description
 *   $rootPath        — relative path to root, default ''
 */

if (!defined('ROOT')) define('ROOT', dirname(__DIR__));
if (!isset($rootPath))        $rootPath        = '';
if (!isset($pageTitle))       $pageTitle       = 'Ecole Ruban Vert | International School Libreville Gabon';
if (!isset($pageDesc))        $pageDesc        = 'Ecole Internationale Ruban Vert — International School of Gabon in Libreville. IB World School offering PYP, IMYC, IGCSE and IB Diploma programmes.';
if (!isset($bodyClass))       $bodyClass       = '';
if (!isset($isHome))          $isHome          = false;
if (!isset($pageBannerTitle)) $pageBannerTitle = '';
if (!isset($pageBannerDesc))  $pageBannerDesc  = '';
if (!isset($breadcrumbs))     $breadcrumbs     = [];
$r = $rootPath; // shorthand

$requestUri = $_SERVER['REQUEST_URI'] ?? '/';
if (!isset($htmlLang)) {
    $htmlLang = (strpos($requestUri, '/fr/') !== false) ? 'fr' : 'en';
}
$canonicalUrl = 'https://ecolerubanvert.com' . strtok($requestUri, '?');
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars($htmlLang) ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($pageTitle) ?></title>
  <meta name="description" content="<?= htmlspecialchars($pageDesc) ?>">
  <meta name="keywords"    content="Ecole Ruban Vert, International School Gabon, Libreville, IB School, IGCSE, IB Diploma, bilingual school">
  <meta name="robots"      content="<?= htmlspecialchars($robotsMeta ?? 'index, follow') ?>">
  <link rel="canonical"    href="<?= htmlspecialchars($canonicalUrl) ?>">

  <!-- Open Graph -->
  <meta property="og:title"       content="<?= htmlspecialchars($pageTitle) ?>">
  <meta property="og:description" content="<?= htmlspecialchars($pageDesc) ?>">
  <meta property="og:type"        content="website">
  <meta property="og:url"         content="<?= htmlspecialchars($canonicalUrl) ?>">
  <meta property="og:image"       content="<?= $r ?>assets/images/og-image.jpg">
  <meta property="og:locale"      content="<?= $htmlLang === 'fr' ? 'fr_FR' : 'en_US' ?>">

  <!-- Twitter Card -->
  <meta name="twitter:card"        content="summary_large_image">
  <meta name="twitter:title"       content="<?= htmlspecialchars($pageTitle) ?>">
  <meta name="twitter:description" content="<?= htmlspecialchars($pageDesc) ?>">

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="<?= $r ?>assets/logos/favicon.png">
  <link rel="apple-touch-icon"       href="<?= $r ?>assets/logos/apple-touch-icon.png">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <!-- Main CSS -->
  <link rel="stylesheet" href="<?= $r ?>css/style.css">
  <!-- Design revision layer (editorial layout & components) -->
  <link rel="stylesheet" href="<?= $r ?>css/redesign.css">
  <link rel="stylesheet" href="<?= $r ?>css/scroll-effects.css">

  <!-- Structured data (Schema.org) -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "School",
    "name": "Ecole Ruban Vert",
    "alternateName": "ERV International School",
    "url": "https://ecolerubanvert.com",
    "logo": "https://ecolerubanvert.com/assets/logos/favicon.png",
    "sameAs": [
      "https://www.facebook.com/ecolerubanvertGabon/",
      "https://twitter.com/erv_gabon"
    ],
    "address": {
      "@type": "PostalAddress",
      "addressLocality": "Libreville",
      "addressCountry": "GA"
    }
  }
  </script>
</head>
<body class="<?= $bodyClass ?>">

<!-- ======== INTRO ANIMATION: E.R.V letters ======== -->
<?php if ($isHome): ?>
<noscript><style>#erv-intro{display:none!important;}body{overflow:visible!important;}</style></noscript>
<div id="erv-intro" aria-hidden="true">
  <div class="erv-letters">
    <span class="erv-letter">E</span><span class="erv-dot">.</span><span class="erv-letter">R</span><span class="erv-dot">.</span><span class="erv-letter">V</span>
  </div>
  <p class="erv-tagline">Ecole Ruban Vert · International School</p>
</div>
<?php endif; ?>

<!-- ======== SEARCH OVERLAY ======== -->
<div id="search-overlay" class="search-overlay" role="dialog" aria-label="Search">
  <button id="search-close" class="search-close" aria-label="Close search">&times;</button>
  <form class="search-form" action="<?= $r ?>search.php" method="get">
    <h2>What are you looking for?</h2>
    <div class="search-input-wrap">
      <input id="search-input" class="search-input" type="search" name="q" placeholder="Search…" autocomplete="off">
      <button type="submit" class="search-submit" aria-label="Search"><i class="fas fa-search"></i></button>
    </div>
  </form>
</div>

<!-- ======== TOP BAR ======== -->
<div class="top-bar">
  <div class="container">
    <!-- Social Media -->
    <div class="top-bar-social">
      <a href="https://www.facebook.com/ecolerubanvertGabon/" target="_blank" rel="noopener" aria-label="Facebook">
        <i class="fab fa-facebook-f"></i>
      </a>
      <a href="https://twitter.com/erv_gabon" target="_blank" rel="noopener" aria-label="Twitter/X">
        <i class="fab fa-x-twitter"></i>
      </a>
      <a href="https://www.youtube.com/channel/UCQXuLlLH1-4BJi_Pvssk3Tg" target="_blank" rel="noopener" aria-label="YouTube">
        <i class="fab fa-youtube"></i>
      </a>
      <a href="https://www.instagram.com/ecolerubanvert/" target="_blank" rel="noopener" aria-label="Instagram">
        <i class="fab fa-instagram"></i>
      </a>
    </div>

    <!-- Portals & Language -->
    <div style="display:flex; gap:1.5rem; align-items:center; flex-wrap:wrap;">
      <div class="top-bar-portals">
        <a href="https://school.eb.com/" target="_blank" rel="noopener" title="Britannica School">Britannica</a>
        <a href="https://ervlibrary.librarika.com/" target="_blank" rel="noopener" title="Library">Librarika</a>
        <a href="https://ecolerubanvert.managebac.com/" target="_blank" rel="noopener" title="ManageBac">ManageBac</a>
        <a href="<?= $r ?>curriculum/college-board-sat.php" title="College Board SAT">SAT</a>
      </div>
      <div class="lang-switcher">
        <a href="<?= $r ?>index.php"    class="<?= (!isset($_GET['lang']) || $_GET['lang']==='en') ? 'active' : '' ?>">EN</a>
        <a href="<?= $r ?>fr/accueil.php" class="<?= (isset($_GET['lang']) && $_GET['lang']==='fr') ? 'active' : '' ?>">FR</a>
      </div>
    </div>
  </div>
</div>

<!-- ======== HEADER ======== -->
<header id="main-header">
  <div class="container">
    <div class="header-inner">

      <!-- Logo -->
      <a href="<?= $r ?>index.php" class="site-logo">
        <div class="logo-placeholder" style="
          width:60px; height:60px; border-radius:50%;
          background:linear-gradient(135deg,#2E7D32,#4CAF50);
          display:flex; align-items:center; justify-content:center;
          flex-shrink:0;
        ">
          <span style="color:#fff; font-weight:800; font-family:serif; font-size:1.4rem;">ERV</span>
        </div>
        <div class="logo-text">
          <span class="school-name">Ecole Ruban Vert</span>
          <span class="school-sub">International School · Gabon</span>
        </div>
      </a>

      <!-- Navigation -->
      <nav id="main-nav" class="main-nav" aria-label="Main navigation">
        <button id="nav-close" class="nav-close" aria-label="Close menu">&times;</button>
        <ul class="nav-list">

          <!-- ABOUT US -->
          <li class="nav-item">
            <a href="<?= $r ?>about-us/index.php" class="nav-link">
              About Us <span class="nav-arrow">▾</span>
            </a>
            <ul class="dropdown">
              <li class="dropdown-item"><a href="<?= $r ?>about-us/board.php" class="dropdown-link">Board</a></li>
              <li class="dropdown-item"><a href="<?= $r ?>about-us/head-of-school.php" class="dropdown-link">Head of School</a></li>
              <li class="dropdown-item">
                <a href="<?= $r ?>about-us/vision.php" class="dropdown-link">Vision, Mission &amp; Values <span class="nav-arrow">▸</span></a>
                <ul class="sub-dropdown dropdown">
                  <li class="dropdown-item"><a href="<?= $r ?>about-us/vision.php" class="dropdown-link">Vision, Mission &amp; Values</a></li>
                  <li class="dropdown-item"><a href="<?= $r ?>about-us/sustainability.php" class="dropdown-link">Sustainability</a></li>
                  <li class="dropdown-item"><a href="<?= $r ?>about-us/innovation.php" class="dropdown-link">Innovation</a></li>
                </ul>
              </li>
              <li class="dropdown-item"><a href="<?= $r ?>about-us/exam-results.php" class="dropdown-link">Exam Results</a></li>
              <li class="dropdown-item"><a href="<?= $r ?>about-us/community-service.php" class="dropdown-link">Community Service</a></li>
              <li class="dropdown-item"><a href="<?= $r ?>about-us/vacancies.php" class="dropdown-link">Work with Us</a></li>
              <li class="dropdown-item">
                <a href="#" class="dropdown-link">Meet our Team <span class="nav-arrow">▸</span></a>
                <ul class="sub-dropdown dropdown">
                  <li class="dropdown-item"><a href="<?= $r ?>about-us/senior-leadership-team.php" class="dropdown-link">Senior Leadership Team</a></li>
                  <li class="dropdown-item"><a href="<?= $r ?>about-us/academic-leadership-team.php" class="dropdown-link">Academic Leadership Team</a></li>
                  <li class="dropdown-item"><a href="<?= $r ?>about-us/support-team.php" class="dropdown-link">Support Team</a></li>
                </ul>
              </li>
              <li class="dropdown-item"><a href="<?= $r ?>about-us/index.php" class="dropdown-link">About Us</a></li>
              <li class="dropdown-item"><a href="<?= $r ?>about-us/our-location.php" class="dropdown-link">Our Location</a></li>
            </ul>
          </li>

          <!-- ADMISSIONS -->
          <li class="nav-item">
            <a href="<?= $r ?>admissions/index.php" class="nav-link">
              Admissions <span class="nav-arrow">▾</span>
            </a>
            <ul class="dropdown">
              <li class="dropdown-item"><a href="<?= $r ?>admissions/admission-process.php" class="dropdown-link">Admission Process</a></li>
              <li class="dropdown-item"><a href="<?= $r ?>admissions/preinscription.php" class="dropdown-link">Apply Online (Pre-registration)</a></li>
              <li class="dropdown-item"><a href="<?= $r ?>admissions/rendez-vous.php" class="dropdown-link">Book a Visit / Interview</a></li>
              <li class="dropdown-item"><a href="<?= $r ?>admissions/suivi-dossier.php" class="dropdown-link">Track My Application</a></li>
              <li class="dropdown-item"><a href="<?= $r ?>admissions/open-apply.php" class="dropdown-link">Application via Open Apply</a></li>
              <li class="dropdown-item"><a href="<?= $r ?>admissions/visit-erv.php" class="dropdown-link">Visit ERV</a></li>
              <li class="dropdown-item"><a href="<?= $r ?>admissions/scholarships.php" class="dropdown-link">Scholarship &amp; Bursaries</a></li>
              <li class="dropdown-item"><a href="<?= $r ?>admissions/fees.php" class="dropdown-link">Fees</a></li>
              <li class="dropdown-item"><a href="<?= $r ?>admissions/questions.php" class="dropdown-link">Admissions Questions</a></li>
            </ul>
          </li>

          <!-- CURRICULUM -->
          <li class="nav-item">
            <a href="<?= $r ?>curriculum/index.php" class="nav-link">
              Curriculum <span class="nav-arrow">▾</span>
            </a>
            <ul class="dropdown">
              <li class="dropdown-item"><a href="<?= $r ?>curriculum/early-years.php" class="dropdown-link">Early Years</a></li>
              <li class="dropdown-item">
                <a href="<?= $r ?>curriculum/primary-school.php" class="dropdown-link">Primary School <span class="nav-arrow">▸</span></a>
                <ul class="sub-dropdown dropdown">
                  <li class="dropdown-item"><a href="<?= $r ?>curriculum/primary-school.php" class="dropdown-link">Primary Years Programme</a></li>
                </ul>
              </li>
              <li class="dropdown-item">
                <a href="<?= $r ?>curriculum/secondary-school/index.php" class="dropdown-link">Secondary School <span class="nav-arrow">▸</span></a>
                <ul class="sub-dropdown dropdown">
                  <li class="dropdown-item"><a href="<?= $r ?>curriculum/secondary-school/index.php" class="dropdown-link">Secondary School Welcome</a></li>
                  <li class="dropdown-item"><a href="<?= $r ?>curriculum/secondary-school/imyc.php" class="dropdown-link">IMYC</a></li>
                  <li class="dropdown-item"><a href="<?= $r ?>curriculum/secondary-school/igcse.php" class="dropdown-link">International GCSE</a></li>
                </ul>
              </li>
              <li class="dropdown-item">
                <a href="<?= $r ?>curriculum/ibdp/index.php" class="dropdown-link">IBDP <span class="nav-arrow">▸</span></a>
                <ul class="sub-dropdown dropdown">
                  <li class="dropdown-item"><a href="<?= $r ?>curriculum/ibdp/index.php" class="dropdown-link">IBDP General Information</a></li>
                  <li class="dropdown-item"><a href="<?= $r ?>curriculum/ibdp/extended-essay.php" class="dropdown-link">Extended Essay</a></li>
                  <li class="dropdown-item"><a href="<?= $r ?>curriculum/ibdp/tok.php" class="dropdown-link">TOK</a></li>
                  <li class="dropdown-item"><a href="<?= $r ?>curriculum/ibdp/cas.php" class="dropdown-link">CAS</a></li>
                </ul>
              </li>
              <li class="dropdown-item"><a href="<?= $r ?>curriculum/college-board-sat.php" class="dropdown-link">College Board SAT</a></li>
            </ul>
          </li>

          <!-- SCHOOL LIFE -->
          <li class="nav-item">
            <a href="<?= $r ?>school-life/index.php" class="nav-link">
              School Life <span class="nav-arrow">▾</span>
            </a>
            <ul class="dropdown">
              <li class="dropdown-item"><a href="<?= $r ?>school-life/news.php" class="dropdown-link">News</a></li>
              <li class="dropdown-item">
                <a href="#" class="dropdown-link">News &amp; Events <span class="nav-arrow">▸</span></a>
                <ul class="sub-dropdown dropdown">
                  <li class="dropdown-item"><a href="<?= $r ?>school-life/events.php" class="dropdown-link">Events</a></li>
                </ul>
              </li>
              <li class="dropdown-item"><a href="<?= $r ?>school-life/extra-curricular.php" class="dropdown-link">Extra Curricular Activities</a></li>
              <li class="dropdown-item"><a href="<?= $r ?>school-life/music-department.php" class="dropdown-link">Music Department</a></li>
              <li class="dropdown-item"><a href="<?= $r ?>school-life/sports.php" class="dropdown-link">Sports</a></li>
              <li class="dropdown-item"><a href="<?= $r ?>school-life/house-system.php" class="dropdown-link">House System</a></li>
              <li class="dropdown-item">
                <a href="<?= $r ?>school-life/pastoral-care/index.php" class="dropdown-link">Pastoral Care <span class="nav-arrow">▸</span></a>
                <ul class="sub-dropdown dropdown">
                  <li class="dropdown-item"><a href="<?= $r ?>school-life/pastoral-care/school-counselling.php" class="dropdown-link">School Counselling</a></li>
                </ul>
              </li>
              <li class="dropdown-item">
                <a href="<?= $r ?>school-life/alumni/index.php" class="dropdown-link">Alumni <span class="nav-arrow">▸</span></a>
                <ul class="sub-dropdown dropdown">
                  <li class="dropdown-item"><a href="<?= $r ?>school-life/alumni/meet-alumni.php" class="dropdown-link">Meet our Alumni</a></li>
                </ul>
              </li>
            </ul>
          </li>

          <!-- PARENTS -->
          <li class="nav-item">
            <a href="<?= $r ?>parents/index.php" class="nav-link">
              Parents <span class="nav-arrow">▾</span>
            </a>
            <ul class="dropdown">
              <li class="dropdown-item"><a href="<?= $r ?>parents/faqs.php" class="dropdown-link">FAQs</a></li>
              <li class="dropdown-item"><a href="<?= $r ?>parents/calendar.php" class="dropdown-link">Calendar</a></li>
              <li class="dropdown-item"><a href="<?= $r ?>parents/term-dates.php" class="dropdown-link">Term Dates</a></li>
              <li class="dropdown-item"><a href="<?= $r ?>parents/school-policies.php" class="dropdown-link">School Policies</a></li>
              <li class="dropdown-item"><a href="<?= $r ?>parents/parents-evening.php" class="dropdown-link">Parents' Evening</a></li>
              <li class="dropdown-item">
                <a href="<?= $r ?>parents/uniform-information/index.php" class="dropdown-link">Uniform Information <span class="nav-arrow">▸</span></a>
                <ul class="sub-dropdown dropdown">
                  <li class="dropdown-item"><a href="<?= $r ?>parents/uniform-information/pe-kit.php" class="dropdown-link">PE Kit</a></li>
                  <li class="dropdown-item"><a href="<?= $r ?>parents/uniform-information/school-wear.php" class="dropdown-link">School Wear</a></li>
                </ul>
              </li>
              <li class="dropdown-item"><a href="<?= $r ?>parents/stationery.php" class="dropdown-link">Stationery</a></li>
              <li class="dropdown-item">
                <a href="<?= $r ?>parents/friends-of-erv/index.php" class="dropdown-link">Friends of ERV <span class="nav-arrow">▸</span></a>
                <ul class="sub-dropdown dropdown">
                  <li class="dropdown-item"><a href="<?= $r ?>parents/friends-of-erv/parental-involvement.php" class="dropdown-link">Parental Involvement</a></li>
                  <li class="dropdown-item"><a href="<?= $r ?>parents/friends-of-erv/volunteer.php" class="dropdown-link">Volunteer</a></li>
                  <li class="dropdown-item"><a href="<?= $r ?>parents/friends-of-erv/index.php" class="dropdown-link">Friends of ERV</a></li>
                </ul>
              </li>
              <li class="dropdown-item"><a href="<?= $r ?>parents/yearbook.php" class="dropdown-link">Yearbook 2024</a></li>
            </ul>
          </li>

          <!-- FACILITIES -->
          <li class="nav-item">
            <a href="<?= $r ?>facilities/index.php" class="nav-link">
              Facilities <span class="nav-arrow">▾</span>
            </a>
            <ul class="dropdown">
              <li class="dropdown-item"><a href="<?= $r ?>facilities/auditorium.php" class="dropdown-link">Auditorium</a></li>
              <li class="dropdown-item"><a href="<?= $r ?>facilities/tennis.php" class="dropdown-link">Tennis</a></li>
              <li class="dropdown-item"><a href="<?= $r ?>facilities/gymnasium.php" class="dropdown-link">Gymnasium</a></li>
              <li class="dropdown-item"><a href="<?= $r ?>facilities/dance.php" class="dropdown-link">Dance</a></li>
              <li class="dropdown-item"><a href="<?= $r ?>facilities/stadium.php" class="dropdown-link">Stadium</a></li>
            </ul>
          </li>

          <!-- LOCATION D'ESPACES -->
          <li class="nav-item">
            <a href="<?= $r ?>location-espaces/catalogue.php" class="nav-link">
              Location d'espaces <span class="nav-arrow">▾</span>
            </a>
            <ul class="dropdown">
              <li class="dropdown-item"><a href="<?= $r ?>location-espaces/catalogue.php" class="dropdown-link">Nos espaces</a></li>
              <li class="dropdown-item"><a href="<?= $r ?>location-espaces/suivi.php" class="dropdown-link">Suivi de ma demande</a></li>
            </ul>
          </li>

          <!-- CONTACT -->
          <li class="nav-item">
            <a href="<?= $r ?>contact.php" class="nav-link">Contact</a>
          </li>

        </ul><!-- /.nav-list -->
      </nav>

      <!-- Nav Actions -->
      <div class="nav-actions">
        <button id="search-btn" class="nav-search-btn" aria-label="Search">
          <i class="fas fa-search"></i>
        </button>
        <a href="<?= $r ?>admissions/open-apply.php" class="btn-apply">Apply Now</a>
        <button id="nav-toggle" class="nav-toggle" aria-label="Open menu" aria-controls="main-nav">
          <span></span><span></span><span></span>
        </button>
      </div>

    </div><!-- /.header-inner -->
  </div><!-- /.container -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/css/swiper.min.css">
</header>

<!-- ======== INNER PAGE HERO ======== -->
<?php if (!$isHome && $pageBannerTitle):
  // Pick a photographic backdrop for the inner-page banner. Pages may set
  // $pageHeroImage explicitly (e.g. 'assets/images/classroom-kids-writing.jpg');
  // otherwise we infer a sensible one from the top-level breadcrumb section.
  if (!isset($pageHeroImage)) {
    $section = strtolower($breadcrumbs[0]['label'] ?? '');
    $heroMap = [
      'admissions'    => 'students-campus-steps.jpg',
      'curriculum'    => 'classroom-kids-writing.jpg',
      'school life'   => 'students-celebrating.jpg',
      'parents'       => 'team-meeting.jpg',
      'facilities'    => 'classroom-empty.jpg',
      'about us'      => 'team-handshake.jpg',
    ];
    $pageHeroImage = 'assets/images/hero-campus-default.jpg';
    foreach ($heroMap as $needle => $file) {
      if (strpos($section, $needle) !== false) { $pageHeroImage = 'assets/images/' . $file; break; }
    }
  }
?>
<section class="page-hero" style="--page-hero-img:url('<?= $r . $pageHeroImage ?>');">
  <div class="container">
    <div class="page-hero-content">
      <?php if (!empty($breadcrumbs)): ?>
      <nav class="breadcrumb" aria-label="Breadcrumb">
        <a href="<?= $r ?>index.php">Home</a>
        <?php foreach ($breadcrumbs as $i => $bc): ?>
          <span class="sep">›</span>
          <?php if ($i < count($breadcrumbs) - 1): ?>
            <a href="<?= htmlspecialchars($bc['url']) ?>"><?= htmlspecialchars($bc['label']) ?></a>
          <?php else: ?>
            <span class="current"><?= htmlspecialchars($bc['label']) ?></span>
          <?php endif; ?>
        <?php endforeach; ?>
      </nav>
      <?php endif; ?>
      <h1><?= htmlspecialchars($pageBannerTitle) ?></h1>
      <?php if ($pageBannerDesc): ?>
      <p><?= htmlspecialchars($pageBannerDesc) ?></p>
      <?php endif; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ======== MAIN CONTENT STARTS ======== -->
<main id="main-content">
