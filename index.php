<?php
/**
 * Homepage — Ecole Ruban Vert
 */
define('ROOT', __DIR__);

$pageTitle = 'Ecole Ruban Vert | International School Libreville Gabon';
$pageDesc  = 'Ecole Internationale Ruban Vert — International IB World School in Libreville, Gabon. Offering PYP, IMYC, IGCSE & IB Diploma programmes. 100% IB pass rate for 6 consecutive years.';
$isHome    = true;
$r         = '';

include 'includes/header.php';
?>

<!-- ================================================
     NEWS TICKER
     ================================================ -->

<!-- <div class="news-ticker" aria-label="Latest news">
  <div class="container">
    <div class="ticker-inner">
      <span class="ticker-label">📢 Latest</span>
      <div class="ticker-track">
        <div class="ticker-content">
          
          <span class="ticker-item">ERV 100% pass rate for all IGCSE exams — 6th year running!</span>
          <span class="ticker-item">ERV students score high grades (7/8/9) for 62% of all IGCSE exams</span>
          <span class="ticker-item">Highest IBDP score ever: 43/45 points (96%) by an ERV student</span>
          <span class="ticker-item">ERV highest ever average IBDP: 36/45 points per student (80%)</span>
          <span class="ticker-item">100% pass rate for IB Diploma and IB Bilingual Diploma</span>
          <span class="ticker-item">Top grades in IBDP English, French, Computer Science, Geography & Visual Arts</span>
      
          <span class="ticker-item">ERV 100% pass rate for all IGCSE exams — 6th year running!</span>
          <span class="ticker-item">ERV students score high grades (7/8/9) for 62% of all IGCSE exams</span>
          <span class="ticker-item">Highest IBDP score ever: 43/45 points (96%) by an ERV student</span>
          <span class="ticker-item">ERV highest ever average IBDP: 36/45 points per student (80%)</span>
          <span class="ticker-item">100% pass rate for IB Diploma and IB Bilingual Diploma</span>
          <span class="ticker-item">Top grades in IBDP English, French, Computer Science, Geography & Visual Arts</span>
        </div>
      </div>
    </div>
  </div>
</div> -->

<!-- ================================================
     HERO SECTION
     ================================================ -->
<section class="hero" id="intro">
  <!-- Slider Backgrounds -->
  <div class="hero-slider">
    <div class="hero-slide active" style="background-image:url('assets/images/hero-1.jpg'); background-color:#1B5E20;"></div>
    <div class="hero-slide" style="background-image:url('assets/images/hero-2.jpg'); background-color:#2E7D32;"></div>
    <div class="hero-slide" style="background-image:url('assets/images/hero-3.jpg'); background-color:#388E3C;"></div>
  </div>

  <!-- Interactive 3D-style floating badge (CSS/JS "mock-Spline" — see note in js/animations.js) -->
  <div class="hero-3d-badge" id="hero3d" aria-hidden="true">
    <div class="hero-3d-layer hero-3d-ring"></div>
    <div class="hero-3d-layer hero-3d-ribbon">🎗️</div>
    <div class="hero-3d-layer hero-3d-orbit"></div>
  </div>

  <div class="container" style="position:relative; z-index:2; width:100%;">
    <div class="hero-content">
      <div class="hero-badge gsap-hero" data-gsap="badge">
        <i class="fas fa-globe-africa"></i>
        IB World School · Libreville, Gabon
      </div>

      <h1 class="gsap-split-words" data-gsap="title">
        International School<br>
        of <em>Gabon Ruban Vert</em>
      </h1>

      <p class="hero-desc gsap-hero" data-gsap="desc">
        A bilingual, accredited IB World School in the heart of Libreville,
        nurturing curious minds and building tomorrow's global leaders
        through excellence, respect and innovation.
      </p>

      <div class="hero-actions gsap-hero" data-gsap="actions">
        <a href="admissions/open-apply.php" class="btn-primary magnetic">
          <i class="fas fa-paper-plane"></i> Apply Now
        </a>
        <a href="about-us/index.php" class="btn-secondary magnetic">
          <i class="fas fa-play-circle"></i> Discover ERV
        </a>
      </div>
    </div>
  </div>

  <!-- Stats -->
  <div class="hero-stats gsap-hero" data-gsap="stats">
    <div class="hero-stat">
      <span class="stat-num">100%</span>
      <span class="stat-label">IB Pass Rate</span>
    </div>
    <div class="hero-stat">
      <span class="stat-num">43<small style="font-size:1rem;">/45</small></span>
      <span class="stat-label">Highest IB Score</span>
    </div>
    <div class="hero-stat">
      <span class="stat-num">6<small style="font-size:1rem;">yrs</small></span>
      <span class="stat-label">Consecutive</span>
    </div>
  </div>

  <!-- Slider Dots -->
  <div class="hero-dots" role="tablist">
    <button class="hero-dot active" role="tab" aria-label="Slide 1"></button>
    <button class="hero-dot"        role="tab" aria-label="Slide 2"></button>
    <button class="hero-dot"        role="tab" aria-label="Slide 3"></button>
  </div>

  <!-- Scroll Arrow -->
  <a href="#quick-links" style="
    position:absolute; bottom:5rem; left:50%; transform:translateX(-50%);
    z-index:3; color:rgba(255,255,255,.7); font-size:1.5rem; animation:bounce 2s infinite;
    text-decoration:none;
  " aria-label="Scroll down"><i class="fas fa-chevron-down"></i></a>
</section>

<style>
@keyframes bounce {
  0%,100%{transform:translateX(-50%) translateY(0)}
  50%{transform:translateX(-50%) translateY(8px)}
}
</style>

<!-- ================================================
     QUICK LINKS
     ================================================ -->
<section class="quick-links" id="quick-links" data-reveal="corner-bl">
  <div class="container">
    <div class="quick-links-grid">
      <a href="school-life/sports.php" class="quick-link-card" data-reveal>
        <div class="quick-link-icon">🏆</div>
        <div class="quick-link-title">Sports</div>
      </a>
      <a href="facilities/index.php" class="quick-link-card" data-reveal>
        <div class="quick-link-icon">🏫</div>
        <div class="quick-link-title">Facilities</div>
      </a>
      <a href="about-us/vacancies.php" class="quick-link-card" data-reveal>
        <div class="quick-link-icon">💼</div>
        <div class="quick-link-title">Vacancies</div>
      </a>
      <a href="school-life/extra-curricular.php" class="quick-link-card" data-reveal>
        <div class="quick-link-icon">🎨</div>
        <div class="quick-link-title">Activities</div>
      </a>
      <a href="school-life/news.php" class="quick-link-card" data-reveal>
        <div class="quick-link-icon">📰</div>
        <div class="quick-link-title">News</div>
      </a>
      <a href="admissions/index.php" class="quick-link-card" data-reveal>
        <div class="quick-link-icon">📋</div>
        <div class="quick-link-title">Admissions</div>
      </a>
    </div>
  </div>
</section>

<!-- ================================================
     TRUST STRIP — Accreditation badges (Lottie)
     ================================================ -->
<section class="trust-strip">
  <div class="container">
    <div class="trust-grid">
      <div class="trust-item" data-aos="fade-up" data-aos-delay="0">
        <lottie-player src="assets/lottie/check-badge.json" background="transparent" speed="1" style="width:64px;height:64px;" autoplay></lottie-player>
        <span>CIS Accredited</span>
      </div>
      <div class="trust-item" data-aos="fade-up" data-aos-delay="100">
        <lottie-player src="assets/lottie/check-badge.json" background="transparent" speed="1" style="width:64px;height:64px;" autoplay></lottie-player>
        <span>IB World School</span>
      </div>
      <div class="trust-item" data-aos="fade-up" data-aos-delay="200">
        <lottie-player src="assets/lottie/check-badge.json" background="transparent" speed="1" style="width:64px;height:64px;" autoplay></lottie-player>
        <span>Cambridge IGCSE</span>
      </div>
      <div class="trust-item" data-aos="fade-up" data-aos-delay="300">
        <lottie-player src="assets/lottie/check-badge.json" background="transparent" speed="1" style="width:64px;height:64px;" autoplay></lottie-player>
        <span>100% Pass Rate</span>
      </div>
    </div>
  </div>
</section>

<!-- ================================================
     ABOUT INTRO
     ================================================ -->
<section class="section bg-white" data-reveal="corner-tr">
  <div class="container">
    <div class="about-intro">

      <div data-reveal="corner-tl">
        <span class="section-tag">Who We Are</span>
        <h2 class="section-title gsap-split">Africa's Most <span>Enterprising</span> School</h2>
        <div class="divider" style="margin:1rem 0;"></div>
        <p style="color:var(--gray); line-height:1.9;">
          Ecole Internationale Ruban Vert (ERV) is a leading bilingual international school
          in Libreville, Gabon. We are proud to be a CIS-accredited IB World School,
          delivering world-class education that blends academic rigour with creativity,
          sustainability and innovation.
        </p>
        <p style="color:var(--gray); line-height:1.9;">
          With programmes from Early Years through IB Diploma, ERV shapes confident,
          compassionate and globally-minded individuals ready to lead in an ever-changing world.
        </p>
        <div style="display:flex; gap:1rem; margin-top:1.5rem; flex-wrap:wrap;">
          <a href="about-us/index.php" class="btn-primary">
            <i class="fas fa-info-circle"></i> About ERV
          </a>
          <a href="about-us/vision.php" class="btn-secondary" style="background:transparent; color:var(--green-primary); border-color:var(--green-primary);">
            Our Mission &amp; Vision
          </a>
        </div>
      </div>

      <!-- Image Grid -->
      <div class="about-image-grid" data-reveal="corner-br" style="display:grid; grid-template-columns:1fr 1fr; gap:1rem; border-radius:var(--radius-lg); overflow:hidden;">
        <img loading="lazy" src="assets/images/classroom-kids-writing.jpg" alt="Élèves de l'ERV en classe" style="height:200px; width:100%; object-fit:cover; border-radius:var(--radius-lg); grid-column:1 / -1;">
        <img loading="lazy" src="assets/images/concept-teach.jpg" alt="Apprentissage à l'ERV" style="height:160px; width:100%; object-fit:cover; border-radius:var(--radius-lg);">
        <img loading="lazy" src="assets/images/library-reading.jpg" alt="Bibliothèque de l'ERV" style="height:160px; width:100%; object-fit:cover; border-radius:var(--radius-lg);">
      </div>
    </div>
  </div>
</section>

<!-- ================================================
     STATS SECTION
     ================================================ -->
<section class="section stats-section" data-reveal="corner-br">
  <div class="container">
    <div class="stats-grid">
      <div class="stat-item" data-reveal>
        <span class="stat-num" data-target="100" data-suffix="%">100%</span>
        <span class="stat-label">IB Pass Rate</span>
      </div>
      <div class="stat-item" data-reveal>
        <span class="stat-num" data-target="36" data-suffix="/45">36/45</span>
        <span class="stat-label">Avg. IBDP Score</span>
      </div>
      <div class="stat-item" data-reveal>
        <span class="stat-num" data-target="6" data-suffix=" Years">6 Years</span>
        <span class="stat-label">Consecutive Excellence</span>
      </div>
      <div class="stat-item" data-reveal>
        <span class="stat-num" data-target="50" data-suffix="+">50+</span>
        <span class="stat-label">Nationalities</span>
      </div>
    </div>
  </div>
</section>

<!-- ================================================
     MISSION / VISION / VALUES
     ================================================ -->
<section class="section mvv-section" data-reveal="corner-tl">
  <div class="container">
    <div class="section-header">
      <span class="section-tag">Our Identity</span>
      <h2 class="section-title gsap-split">Mission, <span>Vision</span> &amp; Values</h2>
      <div class="divider"></div>
      <p class="section-subtitle">
        At the heart of everything we do are three guiding principles that shape
        our community and our students.
      </p>
    </div>

    <div class="mvv-grid">
      <div class="mvv-card mission" data-reveal>
        <div class="mvv-icon">🎯</div>
        <h3>Our Mission</h3>
        <p>
          To become Africa's most enterprising school, focusing on sustainability
          and innovation to play a significant role in Gabon's and in Africa's education.
        </p>
      </div>

      <div class="mvv-card vision" data-reveal>
        <div class="mvv-icon">🌟</div>
        <h3>Our Vision</h3>
        <p>
          To provide a legacy in education which promotes qualities of open-mindedness,
          tolerance and respect for others, which will provide a best practice model
          for the future of students from all nations in Gabon.
        </p>
      </div>

      <div class="mvv-card values" data-reveal>
        <div class="mvv-icon">💎</div>
        <h3>Our Values</h3>
        <ul class="values-list">
          <li>
            <span class="value-dot"></span>
            <div><strong>Excellence:</strong> We strive for excellence in every aspect of life: in human relations, in one's abilities and expectations.</div>
          </li>
          <li>
            <span class="value-dot"></span>
            <div><strong>Respect:</strong> We respect ourselves, our environment, and each other.</div>
          </li>
          <li>
            <span class="value-dot"></span>
            <div><strong>Virtues:</strong> We value truth and honesty, tolerance, integrity and responsibility.</div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- ================================================
     PROGRAMMES
     ================================================ -->
<section class="programme-journey" aria-labelledby="programmes-title">
  <div class="container">
    <div class="section-header programme-journey-header">
      <span class="section-tag">Curriculum</span>
      <h2 class="section-title gsap-split" id="programmes-title">Our <span>Programmes</span></h2>
      <div class="divider"></div>
      <p class="section-subtitle">
        From Early Years to IB Diploma, ERV provides a coherent, internationally
        recognised pathway for every learner.
      </p>
    </div>

    <div class="programme-stack">
      <article class="programme-scroll-card programme-early">
        <div class="programme-scroll-content">
          <span class="programme-scroll-number">01</span>
          <span class="section-tag">Ages 3–5</span>
          <h3>Early <em>Years</em></h3>
          <p>A nurturing bilingual environment where play, imagination and discovery establish a lifelong love of learning.</p>
          <div class="program-tags">
            <span class="program-tag">Bilingual</span><span class="program-tag">Play-based</span><span class="program-tag">Inquiry</span>
          </div>
          <a href="curriculum/early-years.php" class="read-more">Explore Early Years <i class="fas fa-arrow-right"></i></a>
        </div>
        <figure class="programme-scroll-media"><img loading="lazy" src="assets/images/classroom-kids-writing.jpg" alt="Children learning together in an ERV classroom"></figure>
      </article>

      <article class="programme-scroll-card programme-primary">
        <div class="programme-scroll-content">
          <span class="programme-scroll-number">02</span>
          <span class="section-tag">Ages 3–12 · IB PYP</span>
          <h3>Primary <em>Years</em></h3>
          <p>Inquiry-led learning builds confident communicators, capable thinkers and caring members of a global community.</p>
          <div class="program-tags">
            <span class="program-tag">IB PYP</span><span class="program-tag">Inquiry</span><span class="program-tag">Bilingual</span>
          </div>
          <a href="curriculum/primary-school.php" class="read-more">Explore Primary <i class="fas fa-arrow-right"></i></a>
        </div>
        <figure class="programme-scroll-media"><img loading="lazy" src="assets/images/library-reading.jpg" alt="Student reading in the ERV library"></figure>
      </article>

      <article class="programme-scroll-card programme-secondary">
        <div class="programme-scroll-content">
          <span class="programme-scroll-number">03</span>
          <span class="section-tag">Ages 11–16 · IMYC &amp; IGCSE</span>
          <h3>Secondary <em>School</em></h3>
          <p>Students connect disciplines, test ideas and develop the knowledge and independence to shape their own futures.</p>
          <div class="program-tags">
            <span class="program-tag">IMYC</span><span class="program-tag">IGCSE</span><span class="program-tag">Edexcel</span>
          </div>
          <a href="curriculum/secondary-school/index.php" class="read-more">Explore Secondary <i class="fas fa-arrow-right"></i></a>
        </div>
        <figure class="programme-scroll-media"><img loading="lazy" src="assets/images/science-experiment-kids.jpg" alt="Students carrying out a science experiment"></figure>
      </article>

      <article class="programme-scroll-card programme-diploma">
        <div class="programme-scroll-content">
          <span class="programme-scroll-number">04</span>
          <span class="section-tag">Ages 16–18 · IBDP</span>
          <h3>IB <em>Diploma</em></h3>
          <p>A rigorous international qualification that prepares purposeful, resilient graduates for university and beyond.</p>
          <div class="program-tags">
            <span class="program-tag">IBDP</span><span class="program-tag">TOK</span><span class="program-tag">CAS</span>
          </div>
          <a href="curriculum/ibdp/index.php" class="read-more">Explore IB Diploma <i class="fas fa-arrow-right"></i></a>
        </div>
        <figure class="programme-scroll-media"><img loading="lazy" src="assets/images/graduation-caps.jpg" alt="ERV graduation celebration"></figure>
      </article>
    </div>
  </div>
</section>


<!-- ================================================
     LEARNING EXPERIENCE — VERTICAL SPLIT SLIDER
     ================================================ -->
<section class="learning-story" aria-labelledby="learning-story-title">
  <div class="learning-slider-wrap">
    <div id="learning-slider">
      <div class="swiper-container learning-swiper">
        <div class="swiper-wrapper">

          <div class="swiper-slide">
            <div class="swiper-image" data-swiper-parallax-y="-20%">
              <div class="swiper-image-inner swiper-image-left" style="background-image:url('assets/images/student-art-drawing.jpg');">
                <span class="section-tag">Learning at ERV · 01</span>
                <h2 id="learning-story-title">Curiosity starts with <span class="emphasis">a question.</span></h2>
              </div>
            </div>
            <div class="swiper-image" data-swiper-parallax-y="35%">
              <div class="swiper-image-inner swiper-image-right" style="background-image:url('assets/images/student-art-drawing.jpg');">
                <p class="paragraph">In every classroom, students are encouraged to ask, explore and turn a first spark of curiosity into meaningful understanding.</p>
              </div>
            </div>
          </div>

          <div class="swiper-slide">
            <div class="swiper-image" data-swiper-parallax-y="-20%">
              <div class="swiper-image-inner swiper-image-left" style="background-image:url('assets/images/science-experiment-kids.jpg');">
                <span class="section-tag">Learning at ERV · 02</span>
                <h2>Ideas become <span class="emphasis">hands-on discovery.</span></h2>
              </div>
            </div>
            <div class="swiper-image" data-swiper-parallax-y="35%">
              <div class="swiper-image-inner swiper-image-right" style="background-image:url('assets/images/science-experiment-kids.jpg');">
                <p class="paragraph">Our teachers create active learning experiences where students read, experiment, collaborate and make connections across subjects.</p>
              </div>
            </div>
          </div>

          <div class="swiper-slide">
            <div class="swiper-image" data-swiper-parallax-y="-20%">
              <div class="swiper-image-inner swiper-image-left" style="background-image:url('assets/images/students-celebrating.jpg');">
                <span class="section-tag">Learning at ERV · 03</span>
                <h2>Every learner finds <span class="emphasis">their place.</span></h2>
              </div>
            </div>
            <div class="swiper-image" data-swiper-parallax-y="35%">
              <div class="swiper-image-inner swiper-image-right" style="background-image:url('assets/images/students-celebrating.jpg');">
                <p class="paragraph">Beyond the classroom, a diverse and supportive community helps young people build confidence, purpose and lasting friendships.</p>
                <a href="contact.php" class="btn-primary magnetic learning-slide-cta"><i class="fas fa-envelope"></i> Visit ERV</a>
              </div>
            </div>
          </div>

        </div>
        <div class="swiper-pagination learning-pagination"></div>
      </div>
    </div>
  </div>
</section>

<!-- ================================================
     TESTIMONIALS
     ================================================ -->
<section class="section testimonials" data-reveal="corner-tr">
  <div class="container">
    <div class="section-header">
      <span class="section-tag">Community Voices</span>
      <h2 class="section-title gsap-split" style="color:var(--white);">What People <span>Say</span></h2>
      <div class="divider"></div>
      <p class="section-subtitle" style="color:rgba(255,255,255,.7);">
        Hear from our students, parents, teachers and staff about life at ERV.
      </p>
    </div>

    <div class="testimonials-grid">
      <div class="testimonial-card" data-reveal>
        <div class="testimonial-quote">"</div>
        <p class="testimonial-text">
          ERV is a pioneer school where every child is dedicated to become an independent
          and knowledgeable person eager to discover around him.
        </p>
        <div class="testimonial-author">
          <div class="author-avatar">KP</div>
          <div>
            <div class="author-name">Karine Perkins</div>
            <div class="author-role">Director of Children's House</div>
          </div>
        </div>
      </div>

      <div class="testimonial-card" data-reveal>
        <div class="testimonial-quote">"</div>
        <p class="testimonial-text">
          Working in ERV is a rewarding and enriching experience. It is a bit like being
          at home. I am very proud to be here.
        </p>
        <div class="testimonial-author">
          <div class="author-avatar">F</div>
          <div>
            <div class="author-name">Félicia</div>
            <div class="author-role">ERV Support Staff</div>
          </div>
        </div>
      </div>

      <div class="testimonial-card" data-reveal>
        <div class="testimonial-quote">"</div>
        <p class="testimonial-text">
          ERV gave my children the confidence and skills to thrive in an international
          environment. The community here is truly special.
        </p>
        <div class="testimonial-author">
          <div class="author-avatar">MK</div>
          <div>
            <div class="author-name">Marie Koubat</div>
            <div class="author-role">Parent</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ================================================
     LATEST NEWS
     ================================================ -->
<section class="section news-section" data-reveal="corner-bl">
  <div class="container">
    <div class="section-header">
      <span class="section-tag">Latest Updates</span>
      <h2 class="section-title gsap-split">News &amp; <span>Events</span></h2>
      <div class="divider"></div>
    </div>

    <div class="news-grid">
      <?php
      $news = [
        [
          'cat'  => 'Academic',
          'date' => 'September 2024',
          'title'=> 'ERV Records Best-Ever IBDP Results',
          'desc' => 'Our IB Diploma students have achieved outstanding results with a record-breaking average of 36/45 points and a 100% pass rate.',
          'href' => 'school-life/news.php',
          'img'  => 'assets/images/graduation-caps.jpg',
        ],
        [
          'cat'  => 'Community',
          'date' => 'August 2024',
          'title'=> 'African Heritage Week Celebrates Culture',
          'desc' => 'ERV students, parents and staff came together for a vibrant celebration of African culture through music, dance, art and food.',
          'href' => 'school-life/events.php',
          'img'  => 'assets/images/students-celebrating.jpg',
        ],
        [
          'cat'  => 'Sports',
          'date' => 'July 2024',
          'title'=> 'ERV Football Team Wins Regional Championship',
          'desc' => 'Congratulations to the ERV football team on winning the 2024 AISA Regional Championship — an incredible team effort!',
          'href' => 'school-life/sports.php',
          'img'  => 'assets/images/team-highfive.jpg',
        ],
      ];
      foreach ($news as $n): ?>
      <article class="news-card" data-reveal>
        <div class="news-card-img">
          <img loading="lazy" src="<?= $n['img'] ?>" alt="<?= htmlspecialchars($n['title']) ?>">
          <span class="news-card-cat"><?= $n['cat'] ?></span>
        </div>
        <div class="news-card-body">
          <div class="news-card-date">
            <i class="fas fa-calendar-alt"></i> <?= $n['date'] ?>
          </div>
          <h3><?= htmlspecialchars($n['title']) ?></h3>
          <p><?= htmlspecialchars($n['desc']) ?></p>
          <a href="<?= $n['href'] ?>" class="read-more">
            Read more <i class="fas fa-arrow-right"></i>
          </a>
        </div>
      </article>
      <?php endforeach; ?>
    </div>

    <div style="text-align:center; margin-top:2.5rem;">
      <a href="school-life/news.php" class="btn-primary">
        <i class="fas fa-newspaper"></i> View All News
      </a>
    </div>
  </div>
</section>

<!-- ================================================
     CONTACT / ENQUIRY
     ================================================ -->
<section class="section contact-section" data-reveal="corner-br">
  <div class="container">
    <div class="contact-grid">

      <!-- Info -->
      <div data-reveal="corner-tl">
        <span class="section-tag">Get in Touch</span>
        <h3>We'd Love to <span style="color:var(--gold);">Hear</span> From You</h3>
        <p style="color:var(--gray); margin:1rem 0 1.5rem;">
          Whether you're a prospective parent, current family, student or simply curious
          about ERV — our team is here to help.
        </p>

        <div class="contact-details">
          <div class="contact-detail">
            <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
            <div class="contact-detail-text">
              <strong>Address</strong>
              <span>Batterie IV, Libreville, GABON — BP : 2144</span>
            </div>
          </div>
          <div class="contact-detail">
            <div class="contact-icon"><i class="fas fa-phone"></i></div>
            <div class="contact-detail-text">
              <strong>Phone</strong>
              <span>+241 (0)74 84 33 80 / (0)11 44 26 70</span>
            </div>
          </div>
          <div class="contact-detail">
            <div class="contact-icon"><i class="fas fa-envelope"></i></div>
            <div class="contact-detail-text">
              <strong>Email</strong>
              <a href="mailto:reception@ecolerubanvert.com">reception@ecolerubanvert.com</a><br>
              <a href="mailto:admissions@ecolerubanvert.com">admissions@ecolerubanvert.com</a>
            </div>
          </div>
        </div>

        <div style="margin-top:1.5rem;">
          <a href="admissions/index.php" class="btn-primary">
            <i class="fas fa-user-graduate"></i> Start Admissions
          </a>
        </div>

        <!-- Map placeholder -->
        <div style="
          margin-top:2rem; border-radius:var(--radius-lg);
          overflow:hidden; border:2px solid var(--green-pale);
          background:#E8F5E9; height:220px;
          display:flex; align-items:center; justify-content:center;
          color:var(--green-primary); font-size:3rem;
        ">
          🗺️
          <span style="font-size:1rem; margin-left:1rem; color:var(--gray);">
            Batterie IV, Libreville, Gabon
          </span>
        </div>
      </div>

      <!-- Form -->
      <div data-reveal="corner-br">
        <form id="contact-form" class="contact-form" novalidate>
          <h4 style="font-size:1.3rem; margin-bottom:1.5rem; color:var(--green-dark);">
            Send us a Message
          </h4>

          <div id="form-message"></div>

          <div class="form-row">
            <div class="form-group">
              <label for="cf-name">Full Name *</label>
              <input type="text" id="cf-name" name="name" class="form-control" placeholder="Your name" required>
            </div>
            <div class="form-group">
              <label for="cf-email">Email Address *</label>
              <input type="email" id="cf-email" name="email" class="form-control" placeholder="you@example.com" required>
            </div>
          </div>

          <div class="form-group">
            <label for="cf-subject">Subject</label>
            <select id="cf-subject" name="subject" class="form-control">
              <option value="">Select a topic…</option>
              <option>General Enquiry</option>
              <option>Admissions</option>
              <option>Fees &amp; Scholarships</option>
              <option>Curriculum</option>
              <option>School Life</option>
              <option>Work with Us</option>
            </select>
          </div>

          <div class="form-group">
            <label for="cf-message">Message *</label>
            <textarea id="cf-message" name="message" class="form-control" placeholder="Write your message here…" required></textarea>
          </div>

          <div class="form-group" style="display:flex; align-items:center; gap:.75rem;">
            <input type="checkbox" id="cf-privacy" name="privacy" required style="width:16px; height:16px;">
            <label for="cf-privacy" style="font-size:.82rem; color:var(--gray); margin:0;">
              I agree to the <a href="terms.php" target="_blank">Privacy Policy</a>
            </label>
          </div>

          <button type="submit" class="btn-submit">
            <i class="fas fa-paper-plane"></i> Send Message
          </button>
        </form>
      </div>

    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
