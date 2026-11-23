vit de<?php
/**
 * Contact page — Ecole Ruban Vert
 */
define('ROOT', __DIR__);

$pageTitle       = 'Contact Us | Ecole Ruban Vert';
$pageDesc        = 'Get in touch with Ecole Ruban Vert — International School of Gabon in Libreville. Contact our admissions or reception team today.';
$pageBannerTitle = 'Contact Us';
$pageBannerDesc  = "We'd love to hear from you. Reach out with any questions about admissions, curriculum or school life.";
$rootPath        = '';
$r               = '';
$breadcrumbs     = [
  ['label'=>'Contact','url'=>'contact.php'],
];

include 'includes/header.php';
?>

<section class="content-section">
  <div class="container">
    <div class="contact-grid" style="align-items:flex-start;">

      <!-- Info -->
      <div>
        <h2 style="font-size:1.6rem;margin-bottom:1rem;">Get in Touch</h2>
        <p style="color:var(--gray);margin-bottom:1.5rem;">
          Whether you're a prospective parent, current family, student or simply curious
          about ERV — our team is here to help.
        </p>

        <div class="contact-details">
          <div class="contact-detail">
            <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
            <div class="contact-detail-text">
              <strong>Address</strong>
              <span>Ecole Internationale Ruban Vert<br>Batterie IV, Libreville<br>GABON — BP : 2144</span>
            </div>
          </div>
          <div class="contact-detail">
            <div class="contact-icon"><i class="fas fa-phone"></i></div>
            <div class="contact-detail-text">
              <strong>Phone</strong>
              <span>+241 (0)74 84 33 80<br>+241 (0)11 44 26 70</span>
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
          <div class="contact-detail">
            <div class="contact-icon"><i class="fas fa-clock"></i></div>
            <div class="contact-detail-text">
              <strong>Office Hours</strong>
              <span>Monday – Friday: 7:30am – 4:30pm</span>
            </div>
          </div>
        </div>

        <div style="margin-top:1.5rem;display:flex;gap:.75rem;flex-wrap:wrap;">
          <a href="https://www.facebook.com/ecolerubanvertGabon/" target="_blank" rel="noopener" class="footer-social" style="
            width:44px;height:44px;border-radius:50%;background:var(--green-bg);
            display:flex;align-items:center;justify-content:center;color:var(--green-primary);
            border:1px solid var(--green-pale);">
            <i class="fab fa-facebook-f"></i>
          </a>
          <a href="https://twitter.com/erv_gabon" target="_blank" rel="noopener" style="
            width:44px;height:44px;border-radius:50%;background:var(--green-bg);
            display:flex;align-items:center;justify-content:center;color:var(--green-primary);
            border:1px solid var(--green-pale);">
            <i class="fab fa-x-twitter"></i>
          </a>
          <a href="https://www.instagram.com/ecolerubanvert/" target="_blank" rel="noopener" style="
            width:44px;height:44px;border-radius:50%;background:var(--green-bg);
            display:flex;align-items:center;justify-content:center;color:var(--green-primary);
            border:1px solid var(--green-pale);">
            <i class="fab fa-instagram"></i>
          </a>
          <a href="https://www.youtube.com/channel/UCQXuLlLH1-4BJi_Pvssk3Tg" target="_blank" rel="noopener" style="
            width:44px;height:44px;border-radius:50%;background:var(--green-bg);
            display:flex;align-items:center;justify-content:center;color:var(--green-primary);
            border:1px solid var(--green-pale);">
            <i class="fab fa-youtube"></i>
          </a>
        </div>

        <!-- Map -->
        <div style="
          margin-top:2rem; border-radius:var(--radius-lg);
          overflow:hidden; border:2px solid var(--green-pale);
          background:#E8F5E9; height:280px;
          display:flex; align-items:center; justify-content:center;
          color:var(--green-primary); font-size:4rem;
        ">
          🗺️
        </div>
      </div>

      <!-- Form -->
      <div>
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

          <div class="form-row">
            <div class="form-group">
              <label for="cf-phone">Phone Number</label>
              <input type="tel" id="cf-phone" name="phone" class="form-control" placeholder="+241…">
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
