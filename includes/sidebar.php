<?php
/**
 * Shared sidebar for most inner pages
 */
if (!isset($r)) $r = '';
?>

<!-- Quick Nav -->
<div class="sidebar-card">
  <h4>Quick Navigation</h4>
  <ul>
    <li><a href="<?= $r ?>about-us/index.php"><i class="fas fa-info-circle"></i> About Us</a></li>
    <li><a href="<?= $r ?>admissions/index.php"><i class="fas fa-clipboard-list"></i> Admissions</a></li>
    <li><a href="<?= $r ?>curriculum/index.php"><i class="fas fa-book"></i> Curriculum</a></li>
    <li><a href="<?= $r ?>school-life/index.php"><i class="fas fa-star"></i> School Life</a></li>
    <li><a href="<?= $r ?>parents/index.php"><i class="fas fa-users"></i> Parents</a></li>
    <li><a href="<?= $r ?>facilities/index.php"><i class="fas fa-building"></i> Facilities</a></li>
  </ul>
</div>

<!-- CTA -->
<div class="sidebar-cta">
  <h4>Ready to Join ERV?</h4>
  <p>Applications are open for the 2024–25 academic year.</p>
  <a href="<?= $r ?>admissions/open-apply.php" class="btn-cta">Apply Now</a>
</div>

<!-- Contact -->
<div class="sidebar-card" style="border-left-color:var(--gold);">
  <h4>Contact Us</h4>
  <ul>
    <li style="border:none; padding:.2rem 0; font-size:.85rem; color:var(--gray);">
      <i class="fas fa-phone" style="color:var(--green-primary); margin-right:.4rem;"></i>
      +241 (0)74 84 33 80
    </li>
    <li style="border:none; padding:.2rem 0; font-size:.85rem; color:var(--gray);">
      <i class="fas fa-envelope" style="color:var(--green-primary); margin-right:.4rem;"></i>
      <a href="mailto:reception@ecolerubanvert.com" style="font-size:.82rem;">reception@ecolerubanvert.com</a>
    </li>
  </ul>
</div>

<!-- Social -->
<div class="sidebar-card">
  <h4>Follow Us</h4>
  <div style="display:flex; gap:.5rem; flex-wrap:wrap;">
    <a href="https://www.facebook.com/ecolerubanvertGabon/" target="_blank" style="
      width:38px; height:38px; border-radius:50%;
      background:var(--green-bg); display:flex; align-items:center;
      justify-content:center; color:var(--green-primary); font-size:.9rem;
      border:1px solid var(--green-pale); transition:all .3s;"
      onmouseover="this.style.background='var(--green-primary)';this.style.color='#fff';"
      onmouseout="this.style.background='var(--green-bg)';this.style.color='var(--green-primary)';">
      <i class="fab fa-facebook-f"></i>
    </a>
    <a href="https://twitter.com/erv_gabon" target="_blank" style="
      width:38px; height:38px; border-radius:50%;
      background:var(--green-bg); display:flex; align-items:center;
      justify-content:center; color:var(--green-primary); font-size:.9rem;
      border:1px solid var(--green-pale); transition:all .3s;"
      onmouseover="this.style.background='var(--green-primary)';this.style.color='#fff';"
      onmouseout="this.style.background='var(--green-bg)';this.style.color='var(--green-primary)';">
      <i class="fab fa-x-twitter"></i>
    </a>
    <a href="https://www.instagram.com/ecolerubanvert/" target="_blank" style="
      width:38px; height:38px; border-radius:50%;
      background:var(--green-bg); display:flex; align-items:center;
      justify-content:center; color:var(--green-primary); font-size:.9rem;
      border:1px solid var(--green-pale); transition:all .3s;"
      onmouseover="this.style.background='var(--green-primary)';this.style.color='#fff';"
      onmouseout="this.style.background='var(--green-bg)';this.style.color='var(--green-primary)';">
      <i class="fab fa-instagram"></i>
    </a>
    <a href="https://www.youtube.com/channel/UCQXuLlLH1-4BJi_Pvssk3Tg" target="_blank" style="
      width:38px; height:38px; border-radius:50%;
      background:var(--green-bg); display:flex; align-items:center;
      justify-content:center; color:var(--green-primary); font-size:.9rem;
      border:1px solid var(--green-pale); transition:all .3s;"
      onmouseover="this.style.background='var(--green-primary)';this.style.color='#fff';"
      onmouseout="this.style.background='var(--green-bg)';this.style.color='var(--green-primary)';">
      <i class="fab fa-youtube"></i>
    </a>
  </div>
</div>
