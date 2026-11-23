<?php
/**
 * Footer include — Ecole Ruban Vert
 */
if (!isset($r)) $r = '';
?>

</main><!-- /#main-content -->

<!-- ======== FOOTER ======== -->
<footer id="main-footer">

  <!-- Accreditation Bar -->
  <div class="footer-accred">
    <div class="container">
      <div class="footer-accred-logos">
        <!-- Logos seront remplacés par de vraies images -->
        <?php
        $accreds = [
          ['label'=>'CIS Accredited School','url'=>'https://www.cois.org/about-cis/cis-icons/accredited-school'],
          ['label'=>'IB World School','url'=>'https://www.ibo.org/'],
          ['label'=>'IMYC','url'=>'https://fieldworkeducation.com/curriculums/middle-years'],
          ['label'=>'Edexcel','url'=>'https://qualifications.pearson.com/en/about-us/qualification-brands/edexcel.html'],
          ['label'=>'IB PYP','url'=>'https://ibo.org/programmes/primary-years-programme/'],
          ['label'=>'Round Square','url'=>'https://www.roundsquare.org/'],
          ['label'=>'AISA','url'=>'https://www.aisa.or.ke/'],
          ['label'=>"Duke of Edinburgh",'url'=>'https://www.dofe.org/'],
          ['label'=>'College Board SAT','url'=>'https://www.collegeboard.org/'],
          ['label'=>'London School of Music','url'=>'https://www.uwl.ac.uk/academic-schools/music'],
        ];
        foreach ($accreds as $a): ?>
        <a href="<?= $a['url'] ?>" target="_blank" rel="noopener" title="<?= htmlspecialchars($a['label']) ?>"
           style="
             display:inline-flex; align-items:center; justify-content:center;
             height:36px; padding:0 .75rem;
             background:rgba(255,255,255,0.07); border-radius:6px;
             color:rgba(255,255,255,0.45); font-size:.72rem; font-weight:600;
             letter-spacing:.5px; text-transform:uppercase; transition:all .3s;
             text-decoration:none; border:1px solid rgba(255,255,255,0.08);
           "
           onmouseover="this.style.opacity='.85';this.style.color='#fff';"
           onmouseout="this.style.opacity='1';this.style.color='rgba(255,255,255,0.45)';">
          <?= htmlspecialchars($a['label']) ?>
        </a>
        <?php endforeach; ?>
      </div>
    </div>
  </div>

  <!-- Footer Main -->
  <div class="container">
    <div class="footer-grid">

      <!-- Brand -->
      <div class="footer-brand">
        <a href="<?= $r ?>index.php" class="site-logo" style="margin-bottom:1rem; display:inline-flex;">
          <div style="
            width:52px; height:52px; border-radius:50%;
            background:linear-gradient(135deg,#388E3C,#4CAF50);
            display:flex; align-items:center; justify-content:center; flex-shrink:0;">
            <span style="color:#fff; font-weight:800; font-size:1.1rem; font-family:serif;">ERV</span>
          </div>
          <div class="logo-text" style="margin-left:.75rem;">
            <span class="school-name">Ecole Ruban Vert</span>
            <span class="school-sub">International School · Gabon</span>
          </div>
        </a>
        <p class="footer-desc">
          Ecole Internationale Ruban Vert is Africa's most enterprising international school,
          offering IB programmes in the heart of Libreville, Gabon since 1975.
          A place where every child thrives.
        </p>
        <div class="footer-social">
          <a href="https://www.facebook.com/ecolerubanvertGabon/" target="_blank" rel="noopener" aria-label="Facebook">
            <i class="fab fa-facebook-f"></i>
          </a>
          <a href="https://twitter.com/erv_gabon" target="_blank" rel="noopener" aria-label="X (Twitter)">
            <i class="fab fa-x-twitter"></i>
          </a>
          <a href="https://www.youtube.com/channel/UCQXuLlLH1-4BJi_Pvssk3Tg" target="_blank" rel="noopener" aria-label="YouTube">
            <i class="fab fa-youtube"></i>
          </a>
          <a href="https://www.instagram.com/ecolerubanvert/" target="_blank" rel="noopener" aria-label="Instagram">
            <i class="fab fa-instagram"></i>
          </a>
        </div>
      </div>

      <!-- Quick Links -->
      <div class="footer-col">
        <h5>Quick Links</h5>
        <ul class="footer-links">
          <li><a href="<?= $r ?>about-us/index.php"><i class="fas fa-chevron-right"></i> About Us</a></li>
          <li><a href="<?= $r ?>admissions/index.php"><i class="fas fa-chevron-right"></i> Admissions</a></li>
          <li><a href="<?= $r ?>curriculum/index.php"><i class="fas fa-chevron-right"></i> Curriculum</a></li>
          <li><a href="<?= $r ?>school-life/index.php"><i class="fas fa-chevron-right"></i> School Life</a></li>
          <li><a href="<?= $r ?>parents/index.php"><i class="fas fa-chevron-right"></i> Parents</a></li>
          <li><a href="<?= $r ?>facilities/index.php"><i class="fas fa-chevron-right"></i> Facilities</a></li>
          <li><a href="<?= $r ?>school-life/news.php"><i class="fas fa-chevron-right"></i> News</a></li>
          <li><a href="<?= $r ?>contact.php"><i class="fas fa-chevron-right"></i> Contact</a></li>
        </ul>
      </div>

      <!-- Programmes -->
      <div class="footer-col">
        <h5>Programmes</h5>
        <ul class="footer-links">
          <li><a href="<?= $r ?>curriculum/early-years.php"><i class="fas fa-chevron-right"></i> Early Years</a></li>
          <li><a href="<?= $r ?>curriculum/primary-school.php"><i class="fas fa-chevron-right"></i> PYP (Primary)</a></li>
          <li><a href="<?= $r ?>curriculum/secondary-school/index.php"><i class="fas fa-chevron-right"></i> Secondary</a></li>
          <li><a href="<?= $r ?>curriculum/secondary-school/imyc.php"><i class="fas fa-chevron-right"></i> IMYC</a></li>
          <li><a href="<?= $r ?>curriculum/secondary-school/igcse.php"><i class="fas fa-chevron-right"></i> Int'l GCSE</a></li>
          <li><a href="<?= $r ?>curriculum/ibdp/index.php"><i class="fas fa-chevron-right"></i> IB Diploma (DP)</a></li>
          <li><a href="<?= $r ?>curriculum/ibdp/tok.php"><i class="fas fa-chevron-right"></i> Theory of Knowledge</a></li>
          <li><a href="<?= $r ?>curriculum/college-board-sat.php"><i class="fas fa-chevron-right"></i> College Board SAT</a></li>
        </ul>
      </div>

      <!-- Contact -->
      <div class="footer-col">
        <h5>Contact Us</h5>
        <div class="footer-contact-item">
          <i class="fas fa-map-marker-alt"></i>
          <span>Batterie IV, Libreville<br>GABON — BP : 2144</span>
        </div>
        <div class="footer-contact-item">
          <i class="fas fa-phone"></i>
          <span>+241 (0)74 84 33 80<br>+241 (0)11 44 26 70</span>
        </div>
        <div class="footer-contact-item">
          <i class="fas fa-envelope"></i>
          <span>
            <a href="mailto:reception@ecolerubanvert.com" style="color:rgba(255,255,255,.6);">reception@ecolerubanvert.com</a><br>
            <a href="mailto:admissions@ecolerubanvert.com" style="color:rgba(255,255,255,.6);">admissions@ecolerubanvert.com</a>
          </span>
        </div>
        <div class="footer-contact-item">
          <i class="fas fa-clock"></i>
          <span>Mon–Fri: 7:30am – 4:30pm</span>
        </div>

        <!-- External Portals -->
        <div style="margin-top:1.25rem; display:flex; flex-wrap:wrap; gap:.5rem;">
          <a href="https://school.eb.com/" target="_blank" rel="noopener" style="
            font-size:.72rem; color:rgba(255,255,255,.6); padding:.25rem .65rem;
            border:1px solid rgba(255,255,255,.2); border-radius:4px; transition:all .3s;
            text-decoration:none;"
            onmouseover="this.style.borderColor='#4CAF50';this.style.color='#4CAF50';"
            onmouseout="this.style.borderColor='rgba(255,255,255,.2)';this.style.color='rgba(255,255,255,.6)';">
            Britannica
          </a>
          <a href="https://ecolerubanvert.managebac.com/" target="_blank" rel="noopener" style="
            font-size:.72rem; color:rgba(255,255,255,.6); padding:.25rem .65rem;
            border:1px solid rgba(255,255,255,.2); border-radius:4px; transition:all .3s;
            text-decoration:none;"
            onmouseover="this.style.borderColor='#4CAF50';this.style.color='#4CAF50';"
            onmouseout="this.style.borderColor='rgba(255,255,255,.2)';this.style.color='rgba(255,255,255,.6)';">
            ManageBac
          </a>
          <a href="https://ervlibrary.librarika.com/" target="_blank" rel="noopener" style="
            font-size:.72rem; color:rgba(255,255,255,.6); padding:.25rem .65rem;
            border:1px solid rgba(255,255,255,.2); border-radius:4px; transition:all .3s;
            text-decoration:none;"
            onmouseover="this.style.borderColor='#4CAF50';this.style.color='#4CAF50';"
            onmouseout="this.style.borderColor='rgba(255,255,255,.2)';this.style.color='rgba(255,255,255,.6)';">
            Library
          </a>
        </div>
      </div>

    </div><!-- /.footer-grid -->

    <!-- Footer Bottom -->
    <div class="footer-bottom">
      <span>
        &copy; <?= date('Y') ?> Ecole Internationale Ruban Vert. All rights reserved.
      </span>
      <div class="footer-bottom-links">
        <a href="<?= $r ?>terms.php">Privacy / Terms</a>
        <a href="<?= $r ?>sitemap.php">Sitemap</a>
        <a href="<?= $r ?>contact.php">Contact</a>
        <a href="<?= $r ?>fr/accueil.php">Français</a>
      </div>
    </div>

  </div><!-- /.container -->
</footer>

<!-- ======== SCROLL TO TOP ======== -->
<button id="scroll-top" aria-label="Scroll to top">
  <i class="fas fa-arrow-up"></i>
</button>

<?php if (!empty($isHome)): ?>
<!-- ======== HOMEPAGE ANIMATION STACK: GSAP + ScrollTrigger, AOS, Lottie ======== -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css">
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script type="module" src="https://unpkg.com/@lottiefiles/lottie-player@2.0.4/dist/lottie-player.js"></script>
<script src="<?= $r ?>js/animations.js" defer></script>
<?php endif; ?>

<!-- ======== MAIN JS ======== -->
<script src="<?= $r ?>js/main.js"></script>
<script src="js/scroll-effects.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
<script src="js/scroll-effects.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/js/swiper.min.js"></script>

</body>
</html>
