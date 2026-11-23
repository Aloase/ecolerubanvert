<?php
define('ROOT', __DIR__);
$pageTitle       = 'Sitemap | Ecole Ruban Vert';
$pageDesc        = 'Full sitemap of the Ecole Ruban Vert website.';
$pageBannerTitle = 'Sitemap';
$pageBannerDesc  = 'A complete overview of all pages on the ERV website.';
$rootPath        = '';
$r               = '';
$breadcrumbs     = [
  ['label'=>'Sitemap','url'=>'sitemap.php'],
];

include ROOT . '/includes/header.php';
?>

<section class="content-section">
  <div class="container">
    <div class="content-main">
      <h2>Full Sitemap</h2>
      <p>Browse every page on the ERV website using the structured index below.</p>

      <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(240px,1fr)); gap:2rem; margin-top:2rem;">

        <div>
          <h3><i class="fas fa-info-circle" style="color:var(--green-primary);"></i> About Us</h3>
          <ul style="margin-top:.5rem;">
            <li><a href="about-us/index.php">About Us</a></li>
            <li><a href="about-us/board.php">Board</a></li>
            <li><a href="about-us/head-of-school.php">Head of School</a></li>
            <li><a href="about-us/vision.php">Vision, Mission &amp; Values</a></li>
            <li><a href="about-us/sustainability.php">Sustainability</a></li>
            <li><a href="about-us/innovation.php">Innovation</a></li>
            <li><a href="about-us/exam-results.php">Exam Results</a></li>
            <li><a href="about-us/community-service.php">Community Service</a></li>
            <li><a href="about-us/vacancies.php">Work with Us</a></li>
            <li><a href="about-us/senior-leadership-team.php">Senior Leadership Team</a></li>
            <li><a href="about-us/academic-leadership-team.php">Academic Leadership Team</a></li>
            <li><a href="about-us/support-team.php">Support Team</a></li>
            <li><a href="about-us/our-location.php">Our Location</a></li>
          </ul>
        </div>

        <div>
          <h3><i class="fas fa-clipboard-list" style="color:var(--green-primary);"></i> Admissions</h3>
          <ul style="margin-top:.5rem;">
            <li><a href="admissions/index.php">Admissions</a></li>
            <li><a href="admissions/admission-process.php">Admission Process</a></li>
            <li><a href="admissions/open-apply.php">Application via Open Apply</a></li>
            <li><a href="admissions/visit-erv.php">Visit ERV</a></li>
            <li><a href="admissions/scholarships.php">Scholarship &amp; Bursaries</a></li>
            <li><a href="admissions/fees.php">Fees</a></li>
            <li><a href="admissions/questions.php">Admissions Questions</a></li>
          </ul>
        </div>

        <div>
          <h3><i class="fas fa-book" style="color:var(--green-primary);"></i> Curriculum</h3>
          <ul style="margin-top:.5rem;">
            <li><a href="curriculum/index.php">Curriculum</a></li>
            <li><a href="curriculum/early-years.php">Early Years</a></li>
            <li><a href="curriculum/primary-school.php">Primary School (PYP)</a></li>
            <li><a href="curriculum/secondary-school/index.php">Secondary School</a></li>
            <li><a href="curriculum/secondary-school/imyc.php">IMYC</a></li>
            <li><a href="curriculum/secondary-school/igcse.php">International GCSE</a></li>
            <li><a href="curriculum/ibdp/index.php">IBDP</a></li>
            <li><a href="curriculum/ibdp/extended-essay.php">Extended Essay</a></li>
            <li><a href="curriculum/ibdp/tok.php">TOK</a></li>
            <li><a href="curriculum/ibdp/cas.php">CAS</a></li>
            <li><a href="curriculum/college-board-sat.php">College Board SAT</a></li>
          </ul>
        </div>

        <div>
          <h3><i class="fas fa-star" style="color:var(--green-primary);"></i> School Life</h3>
          <ul style="margin-top:.5rem;">
            <li><a href="school-life/index.php">School Life</a></li>
            <li><a href="school-life/news.php">News</a></li>
            <li><a href="school-life/events.php">Events</a></li>
            <li><a href="school-life/extra-curricular.php">Extra Curricular Activities</a></li>
            <li><a href="school-life/music-department.php">Music Department</a></li>
            <li><a href="school-life/sports.php">Sports</a></li>
            <li><a href="school-life/house-system.php">House System</a></li>
            <li><a href="school-life/pastoral-care/index.php">Pastoral Care</a></li>
            <li><a href="school-life/pastoral-care/school-counselling.php">School Counselling</a></li>
            <li><a href="school-life/alumni/index.php">Alumni</a></li>
            <li><a href="school-life/alumni/meet-alumni.php">Meet our Alumni</a></li>
          </ul>
        </div>

        <div>
          <h3><i class="fas fa-users" style="color:var(--green-primary);"></i> Parents</h3>
          <ul style="margin-top:.5rem;">
            <li><a href="parents/index.php">Parents</a></li>
            <li><a href="parents/faqs.php">FAQs</a></li>
            <li><a href="parents/calendar.php">Calendar</a></li>
            <li><a href="parents/term-dates.php">Term Dates</a></li>
            <li><a href="parents/school-policies.php">School Policies</a></li>
            <li><a href="parents/parents-evening.php">Parents' Evening</a></li>
            <li><a href="parents/uniform-information/index.php">Uniform Information</a></li>
            <li><a href="parents/uniform-information/pe-kit.php">PE Kit</a></li>
            <li><a href="parents/uniform-information/school-wear.php">School Wear</a></li>
            <li><a href="parents/stationery.php">Stationery</a></li>
            <li><a href="parents/friends-of-erv/index.php">Friends of ERV</a></li>
            <li><a href="parents/friends-of-erv/parental-involvement.php">Parental Involvement</a></li>
            <li><a href="parents/friends-of-erv/volunteer.php">Volunteer</a></li>
            <li><a href="parents/yearbook.php">Yearbook</a></li>
          </ul>
        </div>

        <div>
          <h3><i class="fas fa-building" style="color:var(--green-primary);"></i> Facilities</h3>
          <ul style="margin-top:.5rem;">
            <li><a href="facilities/index.php">Facilities</a></li>
            <li><a href="facilities/auditorium.php">Auditorium</a></li>
            <li><a href="facilities/tennis.php">Tennis</a></li>
            <li><a href="facilities/gymnasium.php">Gymnasium</a></li>
            <li><a href="facilities/dance.php">Dance</a></li>
            <li><a href="facilities/stadium.php">Stadium</a></li>
          </ul>
        </div>

        <div>
          <h3><i class="fas fa-envelope" style="color:var(--green-primary);"></i> Other</h3>
          <ul style="margin-top:.5rem;">
            <li><a href="index.php">Home</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="terms.php">Privacy / Terms</a></li>
            <li><a href="sitemap.php">Sitemap</a></li>
            <li><a href="fr/accueil.php">Français</a></li>
          </ul>
        </div>

      </div>
    </div>
  </div>
</section>

<?php include ROOT . '/includes/footer.php'; ?>
