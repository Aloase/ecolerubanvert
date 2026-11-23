<?php
define('ROOT', dirname(__DIR__));
require_once ROOT . '/config/db.php';
require_once ROOT . '/config/mailer.php';
require_once ROOT . '/includes/rentals-helpers.php';

$rootPath = '../';
$r        = $rootPath;

$slug = trim($_GET['slug'] ?? '');
$stmt = db()->prepare('SELECT * FROM rental_spaces WHERE slug = :slug AND is_active = 1 LIMIT 1');
$stmt->execute([':slug' => $slug]);
$space = $stmt->fetch();

if (!$space) {
    header('Location: catalogue.php');
    exit;
}

$images = db()->prepare('SELECT * FROM rental_space_images WHERE space_id = :id ORDER BY sort_order');
$images->execute([':id' => $space['id']]);
$images = $images->fetchAll();

$recurring = db()->prepare('SELECT * FROM rental_recurring_slots WHERE space_id = :id ORDER BY weekday, start_time');
$recurring->execute([':id' => $space['id']]);
$recurring = $recurring->fetchAll();

// Reservations et exclusions des 60 prochains jours (pour construire le calendrier)
$upcoming = db()->prepare(
    "SELECT booking_date, start_time, end_time, status FROM rental_bookings
     WHERE space_id = :id AND status IN ('en_attente','confirmee') AND booking_date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 60 DAY)
     ORDER BY booking_date"
);
$upcoming->execute([':id' => $space['id']]);
$upcoming = $upcoming->fetchAll();
$bookedDates = [];
foreach ($upcoming as $b) {
    $bookedDates[$b['booking_date']][] = $b;
}

$exclusions = db()->prepare(
    "SELECT * FROM rental_exclusions WHERE (space_id = :id OR space_id IS NULL) AND end_date >= CURDATE() ORDER BY start_date"
);
$exclusions->execute([':id' => $space['id']]);
$exclusions = $exclusions->fetchAll();

$errors  = [];
$success = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date  = trim($_POST['booking_date'] ?? '');
    $start = trim($_POST['start_time'] ?? '');
    $end   = trim($_POST['end_time'] ?? '');
    $name  = trim($_POST['renter_name'] ?? '');
    $org   = trim($_POST['renter_org'] ?? '');
    $email = trim($_POST['renter_email'] ?? '');
    $phone = trim($_POST['renter_phone'] ?? '');
    $purpose = trim($_POST['purpose'] ?? '');
    $rgpd  = isset($_POST['rgpd']);

    if ($date === '' || strtotime($date) < strtotime(date('Y-m-d'))) $errors[] = 'Veuillez choisir une date valide (aujourd\'hui ou plus tard).';
    if ($start === '' || $end === '' || $end <= $start)              $errors[] = 'Veuillez indiquer un horaire de debut et de fin valide.';
    if ($name === '')                                                 $errors[] = 'Le nom du demandeur est requis.';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))                   $errors[] = 'Adresse email invalide.';
    if ($phone === '')                                                $errors[] = 'Le telephone est requis.';
    if (!$rgpd)                                                       $errors[] = 'Vous devez accepter la politique de confidentialite.';

    if (!$errors) {
        $availability = rental_check_availability((int)$space['id'], $date, $start, $end);
        if (!$availability['available']) {
            $errors[] = $availability['reason'];
        }
    }

    if (!$errors) {
        try {
            $ref = rental_generate_reference();
            $amount = rental_estimate_amount($space, $start, $end);
            $ins = db()->prepare(
                'INSERT INTO rental_bookings (reference_code, space_id, booking_date, start_time, end_time, renter_name, renter_org, renter_email, renter_phone, purpose, status, quote_amount)
                 VALUES (:ref, :sid, :d, :s, :e, :name, :org, :email, :phone, :purpose, "en_attente", :amount)'
            );
            $ins->execute([
                ':ref' => $ref, ':sid' => $space['id'], ':d' => $date, ':s' => $start, ':e' => $end,
                ':name' => $name, ':org' => ($org ?: null), ':email' => $email, ':phone' => $phone,
                ':purpose' => ($purpose ?: null), ':amount' => $amount,
            ]);
            $bookingId = (int)db()->lastInsertId();

            db()->prepare('INSERT INTO rental_booking_history (booking_id, status, note) VALUES (:id, "en_attente", "Demande soumise en ligne")')
                ->execute([':id' => $bookingId]);

            mail_send(
                $email,
                'Demande de location recue — Ecole Ruban Vert (' . $ref . ')',
                "<p>Bonjour {$name},</p>
                 <p>Votre demande de location pour <strong>" . htmlspecialchars($space['name']) . "</strong> le <strong>" . date('d/m/Y', strtotime($date)) . "</strong>
                 de <strong>{$start}</strong> a <strong>{$end}</strong> a bien ete recue.</p>
                 <p>Numero de reference : <strong>{$ref}</strong>. Notre equipe va l'examiner et vous recontactera rapidement.</p>
                 <p>L'equipe Ecole Ruban Vert.</p>",
                'rental_booking', $bookingId
            );
            mail_send(
                MAIL_ADMIN_ADDRESS,
                'Nouvelle demande de location : ' . $space['name'],
                "<p>{$name} ({$email}, {$phone}) demande la location de <strong>" . htmlspecialchars($space['name']) . "</strong> le " . date('d/m/Y', strtotime($date)) . " de {$start} a {$end}.</p>
                 <p>Reference : {$ref}</p>",
                'rental_booking', $bookingId
            );

            $success = ['reference' => $ref, 'date' => $date, 'start' => $start, 'end' => $end];
        } catch (Throwable $e) {
            $errors[] = 'Une erreur est survenue. Veuillez reessayer.';
        }
    }
}

$pageTitle       = htmlspecialchars($space['name']) . ' | Location d\'espaces | Ecole Ruban Vert';
$pageDesc        = (string)$space['description'];
$pageBannerTitle = $space['name'];
$pageBannerDesc  = "Consultez les disponibilites et envoyez votre demande de location.";
$breadcrumbs     = [
    ['label'=>"Location d'espaces",'url'=>'../location-espaces/catalogue.php'],
    ['label'=>$space['name'],'url'=>'../location-espaces/espace.php?slug='.$space['slug']],
];

include ROOT . '/includes/header.php';
?>

<section class="content-section">
  <div class="container" style="max-width:980px;">

    <div style="display:grid; grid-template-columns:1.1fr .9fr; gap:2.5rem; align-items:start; margin-bottom:2.5rem;">
      <div>
        <?php if ($space['cover_image']): ?>
          <img loading="lazy" src="<?= $r . htmlspecialchars($space['cover_image']) ?>" alt="<?= htmlspecialchars($space['name']) ?>" style="width:100%; border-radius:14px; box-shadow:var(--shadow-md);">
        <?php endif; ?>
        <?php if ($images): ?>
        <div style="display:flex; gap:.6rem; margin-top:.75rem; overflow-x:auto;">
          <?php foreach ($images as $img): ?>
            <img loading="lazy" src="<?= $r . htmlspecialchars($img['image_path']) ?>" style="width:90px; height:70px; object-fit:cover; border-radius:8px;">
          <?php endforeach; ?>
        </div>
        <?php endif; ?>
      </div>
      <div>
        <p style="font-size:1.05rem; line-height:1.7;"><?= nl2br(htmlspecialchars((string)$space['description'])) ?></p>
        <ul style="list-style:none; padding:0; margin:1.25rem 0; display:grid; gap:.6rem;">
          <li><i class="fas fa-users" style="color:var(--green-primary); width:20px;"></i> Capacite : <strong><?= (int)$space['capacity'] ?> personnes</strong></li>
          <?php if ($space['equipment']): ?><li><i class="fas fa-toolbox" style="color:var(--green-primary); width:20px;"></i> Equipements : <strong><?= htmlspecialchars($space['equipment']) ?></strong></li><?php endif; ?>
          <?php if ($space['price_per_hour']): ?><li><i class="fas fa-clock" style="color:var(--green-primary); width:20px;"></i> Tarif horaire : <strong><?= number_format((float)$space['price_per_hour'],0,',',' ') ?> FCFA / h</strong></li><?php endif; ?>
          <?php if ($space['price_per_day']): ?><li><i class="fas fa-calendar-day" style="color:var(--green-primary); width:20px;"></i> Tarif journee : <strong><?= number_format((float)$space['price_per_day'],0,',',' ') ?> FCFA / jour</strong></li><?php endif; ?>
        </ul>
        <?php if ($recurring): ?>
        <div style="background:var(--green-bg); border-radius:10px; padding:1rem 1.25rem;">
          <strong style="display:block; margin-bottom:.5rem;">Disponibilites habituelles</strong>
          <?php foreach ($recurring as $rec): ?>
            <div style="font-size:.9rem; color:var(--gray);"><?= rental_weekday_label((int)$rec['weekday']) ?> · <?= substr($rec['start_time'],0,5) ?>–<?= substr($rec['end_time'],0,5) ?></div>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>
        <?php if ($exclusions): ?>
        <div style="background:#FFF3E0; border-radius:10px; padding:1rem 1.25rem; margin-top:.75rem;">
          <strong style="display:block; margin-bottom:.5rem; color:#E65100;">Periodes indisponibles</strong>
          <?php foreach ($exclusions as $ex): ?>
            <div style="font-size:.9rem; color:#BF360C;">
              <?= date('d/m/Y', strtotime($ex['start_date'])) ?> — <?= date('d/m/Y', strtotime($ex['end_date'])) ?>
              <?php if ($ex['reason']): ?>(<?= htmlspecialchars($ex['reason']) ?>)<?php endif; ?>
            </div>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>
      </div>
    </div>

    <?php if ($success): ?>
      <div style="background:#E8F5E9; padding:1.75rem; border-radius:12px;">
        <h3 style="color:#2E7D32; margin-top:0;"><i class="fas fa-circle-check"></i> Demande envoyee !</h3>
        <p>Votre demande de location pour le <strong><?= date('d/m/Y', strtotime($success['date'])) ?></strong> de <strong><?= $success['start'] ?></strong> a <strong><?= $success['end'] ?></strong> a ete transmise a l'ecole.</p>
        <p>Numero de reference : <strong><?= htmlspecialchars($success['reference']) ?></strong>. Conservez-le pour suivre votre demande.</p>
        <p><a href="suivi.php?ref=<?= urlencode($success['reference']) ?>" class="btn-secondary" style="margin-top:.5rem; display:inline-block;">Suivre ma demande</a></p>
      </div>
    <?php else: ?>

      <?php if ($errors): ?>
        <div style="background:#FFEBEE; color:#C62828; padding:1rem 1.25rem; border-radius:10px; margin-bottom:1.5rem;">
          <ul style="margin:0; padding-left:1.25rem;"><?php foreach ($errors as $e): ?><li><?= htmlspecialchars($e) ?></li><?php endforeach; ?></ul>
        </div>
      <?php endif; ?>

      <h2 style="margin-bottom:1rem;">Demande de location</h2>
      <form method="post" style="background:#fff; border:1px solid #E3E7E5; border-radius:12px; padding:1.75rem;">
        <div class="form-grid" style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:1rem;">
          <div class="form-group">
            <label style="display:block; font-weight:600; font-size:.85rem; margin-bottom:.35rem;">Date souhaitee *</label>
            <input type="date" name="booking_date" min="<?= date('Y-m-d') ?>" required value="<?= htmlspecialchars($_POST['booking_date'] ?? '') ?>" style="width:100%; padding:.65rem .85rem; border:1px solid #DDE3E0; border-radius:8px;">
          </div>
          <div class="form-group">
            <label style="display:block; font-weight:600; font-size:.85rem; margin-bottom:.35rem;">Heure de debut *</label>
            <input type="time" name="start_time" required value="<?= htmlspecialchars($_POST['start_time'] ?? '') ?>" style="width:100%; padding:.65rem .85rem; border:1px solid #DDE3E0; border-radius:8px;">
          </div>
          <div class="form-group">
            <label style="display:block; font-weight:600; font-size:.85rem; margin-bottom:.35rem;">Heure de fin *</label>
            <input type="time" name="end_time" required value="<?= htmlspecialchars($_POST['end_time'] ?? '') ?>" style="width:100%; padding:.65rem .85rem; border:1px solid #DDE3E0; border-radius:8px;">
          </div>
        </div>
        <div class="form-grid" style="display:grid; grid-template-columns:1fr 1fr; gap:1rem; margin-top:1rem;">
          <div class="form-group">
            <label style="display:block; font-weight:600; font-size:.85rem; margin-bottom:.35rem;">Nom complet / Organisation *</label>
            <input type="text" name="renter_name" required value="<?= htmlspecialchars($_POST['renter_name'] ?? '') ?>" style="width:100%; padding:.65rem .85rem; border:1px solid #DDE3E0; border-radius:8px;">
          </div>
          <div class="form-group">
            <label style="display:block; font-weight:600; font-size:.85rem; margin-bottom:.35rem;">Organisation (optionnel)</label>
            <input type="text" name="renter_org" value="<?= htmlspecialchars($_POST['renter_org'] ?? '') ?>" style="width:100%; padding:.65rem .85rem; border:1px solid #DDE3E0; border-radius:8px;">
          </div>
          <div class="form-group">
            <label style="display:block; font-weight:600; font-size:.85rem; margin-bottom:.35rem;">Email *</label>
            <input type="email" name="renter_email" required value="<?= htmlspecialchars($_POST['renter_email'] ?? '') ?>" style="width:100%; padding:.65rem .85rem; border:1px solid #DDE3E0; border-radius:8px;">
          </div>
          <div class="form-group">
            <label style="display:block; font-weight:600; font-size:.85rem; margin-bottom:.35rem;">Telephone *</label>
            <input type="tel" name="renter_phone" required value="<?= htmlspecialchars($_POST['renter_phone'] ?? '') ?>" style="width:100%; padding:.65rem .85rem; border:1px solid #DDE3E0; border-radius:8px;">
          </div>
        </div>
        <div class="form-group" style="margin-top:1rem;">
          <label style="display:block; font-weight:600; font-size:.85rem; margin-bottom:.35rem;">Objet de la location</label>
          <textarea name="purpose" rows="3" style="width:100%; padding:.65rem .85rem; border:1px solid #DDE3E0; border-radius:8px;"><?= htmlspecialchars($_POST['purpose'] ?? '') ?></textarea>
        </div>
        <label style="display:flex; gap:.5rem; align-items:flex-start; margin-top:1rem; font-size:.85rem; color:var(--gray);">
          <input type="checkbox" name="rgpd" required style="margin-top:.2rem;">
          J'accepte que mes donnees soient utilisees pour traiter cette demande, conformement a la <a href="<?= $r ?>politique-confidentialite.php" target="_blank">politique de confidentialite</a>.
        </label>
        <button type="submit" class="btn-primary" style="margin-top:1.25rem;"><i class="fas fa-paper-plane"></i> Envoyer la demande</button>
      </form>
    <?php endif; ?>

  </div>
</section>

<?php include ROOT . '/includes/footer.php'; ?>
