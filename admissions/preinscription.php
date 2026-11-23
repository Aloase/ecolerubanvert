<?php
define('ROOT', dirname(__DIR__));
require_once ROOT . '/config/db.php';
require_once ROOT . '/config/mailer.php';
require_once ROOT . '/includes/admissions-helpers.php';

$rootPath = '../';
$r        = $rootPath;

$levels = db()->query('SELECT id, name FROM admission_levels ORDER BY sort_order')->fetchAll();

$errors  = [];
$success = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $childFirst   = trim($_POST['child_first_name'] ?? '');
    $childLast    = trim($_POST['child_last_name'] ?? '');
    $childDob     = trim($_POST['child_dob'] ?? '');
    $childGender  = $_POST['child_gender'] ?? 'O';
    $currentSchool= trim($_POST['current_school'] ?? '');
    $levelId      = (int)($_POST['level_id'] ?? 0);
    $parentName   = trim($_POST['parent_name'] ?? '');
    $parentEmail  = trim($_POST['parent_email'] ?? '');
    $parentPhone  = trim($_POST['parent_phone'] ?? '');
    $parentAddr   = trim($_POST['parent_address'] ?? '');
    $entryYear    = trim($_POST['entry_school_year'] ?? '');
    $message      = trim($_POST['message'] ?? '');
    $consent      = isset($_POST['consent_rgpd']);

    if ($childFirst === '' || $childLast === '')      $errors[] = 'Le prenom et le nom de l\'enfant sont requis.';
    if ($childDob === '')                             $errors[] = 'La date de naissance de l\'enfant est requise.';
    if (!$levelId)                                     $errors[] = 'Veuillez choisir un niveau souhaite.';
    if ($parentName === '')                            $errors[] = 'Le nom du parent/tuteur est requis.';
    if (!filter_var($parentEmail, FILTER_VALIDATE_EMAIL)) $errors[] = 'Adresse email invalide.';
    if ($parentPhone === '')                            $errors[] = 'Le telephone est requis.';
    if (!$consent)                                       $errors[] = 'Vous devez accepter la politique de confidentialite pour continuer.';

    $uploadedFiles = [];
    if (!$errors) {
        $reference = admission_generate_reference();
        $docFields = ['etat_civil' => 'etat_civil', 'bulletin' => 'bulletin', 'photo' => 'photo', 'vaccin' => 'vaccin'];
        foreach ($docFields as $field => $type) {
            if (!empty($_FILES[$field]['name'])) {
                $res = admission_handle_upload($_FILES[$field], $reference, $type);
                if ($res && isset($res['error'])) {
                    $errors[] = $res['error'];
                } elseif ($res) {
                    $uploadedFiles[$type] = $res;
                }
            }
        }
    }

    if (!$errors) {
        try {
            $pdo = db();
            $pdo->beginTransaction();

            $token = admission_generate_token();
            $stmt = $pdo->prepare(
                'INSERT INTO admission_applications
                 (reference_code, level_id, child_first_name, child_last_name, child_dob, child_gender,
                  current_school, parent_name, parent_email, parent_phone, parent_address, entry_school_year,
                  message, status, access_token, consent_rgpd)
                 VALUES (:ref, :level_id, :cfn, :cln, :dob, :gender, :cschool, :pname, :pemail, :pphone, :paddr,
                         :entry, :message, "recu", :token, 1)'
            );
            $stmt->execute([
                ':ref' => $reference, ':level_id' => $levelId, ':cfn' => $childFirst, ':cln' => $childLast,
                ':dob' => $childDob, ':gender' => $childGender, ':cschool' => $currentSchool ?: null,
                ':pname' => $parentName, ':pemail' => $parentEmail, ':pphone' => $parentPhone,
                ':paddr' => $parentAddr ?: null, ':entry' => $entryYear ?: null, ':message' => $message ?: null,
                ':token' => $token,
            ]);
            $applicationId = (int)$pdo->lastInsertId();

            foreach ($uploadedFiles as $type => $info) {
                $docStmt = $pdo->prepare(
                    'INSERT INTO admission_documents (application_id, doc_type, original_name, stored_path, file_size)
                     VALUES (:aid, :type, :name, :path, :size)'
                );
                $docStmt->execute([
                    ':aid' => $applicationId, ':type' => $type, ':name' => $info['original_name'],
                    ':path' => $info['stored_path'], ':size' => $info['file_size'],
                ]);
            }

            $histStmt = $pdo->prepare(
                'INSERT INTO admission_status_history (application_id, status, note) VALUES (:aid, "recu", "Candidature soumise en ligne")'
            );
            $histStmt->execute([':aid' => $applicationId]);

            $pdo->commit();

            // Emails (mode simulation si SMTP non configure — voir config/mail.php)
            $trackingUrl = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']) . '/suivi-dossier.php';
            mail_send(
                $parentEmail,
                'Votre candidature ERV a bien ete recue — ' . $reference,
                "<p>Bonjour {$parentName},</p>
                 <p>Nous avons bien recu la candidature de <strong>{$childFirst} {$childLast}</strong>.</p>
                 <p>Votre numero de reference : <strong>{$reference}</strong></p>
                 <p>Vous pouvez suivre l'avancement de votre dossier a tout moment ici : <a href=\"{$trackingUrl}\">{$trackingUrl}</a></p>
                 <p>L'equipe Admissions — Ecole Ruban Vert</p>",
                'admission_application', $applicationId
            );
            mail_send(
                MAIL_ADMIN_ADDRESS,
                'Nouvelle candidature recue — ' . $reference,
                "<p>Nouvelle candidature de <strong>{$childFirst} {$childLast}</strong> (parent : {$parentName}, {$parentEmail}, {$parentPhone}).</p>
                 <p>Reference : {$reference}</p>",
                'admission_application', $applicationId
            );

            $success = $reference;
        } catch (Throwable $e) {
            $errors[] = 'Une erreur est survenue lors de l\'enregistrement. Veuillez reessayer.';
        }
    }
}

$pageTitle       = 'Pre-inscription en ligne | Ecole Ruban Vert';
$pageDesc        = 'Soumettez votre demande de pre-inscription a l\'Ecole Ruban Vert en ligne, avec upload de documents.';
$pageBannerTitle = 'Pre-inscription en ligne';
$pageBannerDesc  = 'Completez le formulaire ci-dessous pour demarrer le processus d\'admission de votre enfant.';
$breadcrumbs     = [
    ['label'=>'Admissions','url'=>'../admissions/index.php'],
    ['label'=>'Pre-inscription','url'=>'../admissions/preinscription.php'],
];

include ROOT . '/includes/header.php';
?>

<section class="content-section">
  <div class="container" style="max-width:820px;">

    <?php if ($success): ?>
      <div class="admin-alert success" style="padding:1.5rem; border-radius:12px; background:#E8F5E9; margin-bottom:1.5rem;">
        <h2 style="margin-top:0; color:#2E7D32;"><i class="fas fa-circle-check"></i> Candidature envoyee avec succes !</h2>
        <p>Votre numero de reference est <strong style="font-family:var(--font-mono); font-size:1.1rem;"><?= htmlspecialchars($success) ?></strong>.</p>
        <p>Conservez precieusement ce numero : il vous permettra de suivre l'etat de votre dossier et de prendre rendez-vous pour une visite ou un entretien.</p>
        <div style="display:flex; gap:1rem; flex-wrap:wrap; margin-top:1.25rem;">
          <a href="suivi-dossier.php" class="btn-primary"><i class="fas fa-magnifying-glass"></i> Suivre mon dossier</a>
          <a href="rendez-vous.php" class="btn-secondary" style="background:transparent; color:var(--green-primary); border:1px solid var(--green-primary);"><i class="fas fa-calendar-check"></i> Prendre rendez-vous</a>
        </div>
      </div>
    <?php else: ?>

      <?php if ($errors): ?>
        <div class="admin-alert error" style="padding:1rem 1.25rem; border-radius:10px; background:#FFEBEE; margin-bottom:1.5rem;">
          <strong>Veuillez corriger les erreurs suivantes :</strong>
          <ul style="margin:.5rem 0 0; padding-left:1.25rem;">
            <?php foreach ($errors as $err): ?><li><?= htmlspecialchars($err) ?></li><?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>

      <form method="post" enctype="multipart/form-data" class="admission-form">
        <h3>Informations sur l'enfant</h3>
        <div class="form-grid" style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
          <div class="form-group">
            <label>Prenom *</label>
            <input type="text" name="child_first_name" required value="<?= htmlspecialchars($_POST['child_first_name'] ?? '') ?>">
          </div>
          <div class="form-group">
            <label>Nom *</label>
            <input type="text" name="child_last_name" required value="<?= htmlspecialchars($_POST['child_last_name'] ?? '') ?>">
          </div>
          <div class="form-group">
            <label>Date de naissance *</label>
            <input type="date" name="child_dob" required value="<?= htmlspecialchars($_POST['child_dob'] ?? '') ?>">
          </div>
          <div class="form-group">
            <label>Genre</label>
            <select name="child_gender">
              <option value="F">Feminin</option>
              <option value="M">Masculin</option>
              <option value="O">Prefere ne pas dire</option>
            </select>
          </div>
          <div class="form-group">
            <label>Niveau souhaite *</label>
            <select name="level_id" required>
              <option value="">-- Choisir --</option>
              <?php foreach ($levels as $lvl): ?>
                <option value="<?= $lvl['id'] ?>" <?= (isset($_POST['level_id']) && $_POST['level_id']==$lvl['id']) ? 'selected' : '' ?>><?= htmlspecialchars($lvl['name']) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label>Annee scolaire d'entree souhaitee</label>
            <input type="text" name="entry_school_year" placeholder="ex: 2026-2027" value="<?= htmlspecialchars($_POST['entry_school_year'] ?? '') ?>">
          </div>
          <div class="form-group" style="grid-column:1/-1;">
            <label>Ecole actuelle (le cas echeant)</label>
            <input type="text" name="current_school" value="<?= htmlspecialchars($_POST['current_school'] ?? '') ?>">
          </div>
        </div>

        <h3>Informations du parent / tuteur</h3>
        <div class="form-grid" style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
          <div class="form-group">
            <label>Nom complet *</label>
            <input type="text" name="parent_name" required value="<?= htmlspecialchars($_POST['parent_name'] ?? '') ?>">
          </div>
          <div class="form-group">
            <label>Email *</label>
            <input type="email" name="parent_email" required value="<?= htmlspecialchars($_POST['parent_email'] ?? '') ?>">
          </div>
          <div class="form-group">
            <label>Telephone *</label>
            <input type="tel" name="parent_phone" required value="<?= htmlspecialchars($_POST['parent_phone'] ?? '') ?>">
          </div>
          <div class="form-group" style="grid-column:1/-1;">
            <label>Adresse</label>
            <input type="text" name="parent_address" value="<?= htmlspecialchars($_POST['parent_address'] ?? '') ?>">
          </div>
          <div class="form-group" style="grid-column:1/-1;">
            <label>Message (optionnel)</label>
            <textarea name="message" rows="3"><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
          </div>
        </div>

        <h3>Documents a fournir (PDF, JPG ou PNG — 5 Mo max chacun)</h3>
        <div class="form-grid" style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
          <div class="form-group"><label>Acte de naissance / etat civil</label><input type="file" name="etat_civil" accept=".pdf,.jpg,.jpeg,.png"></div>
          <div class="form-group"><label>Bulletins scolaires</label><input type="file" name="bulletin" accept=".pdf,.jpg,.jpeg,.png"></div>
          <div class="form-group"><label>Photo d'identite</label><input type="file" name="photo" accept=".jpg,.jpeg,.png"></div>
          <div class="form-group"><label>Carnet de vaccination</label><input type="file" name="vaccin" accept=".pdf,.jpg,.jpeg,.png"></div>
        </div>

        <div class="form-group" style="margin-top:1rem;">
          <label style="display:flex; align-items:flex-start; gap:.6rem; font-weight:400;">
            <input type="checkbox" name="consent_rgpd" style="width:auto; margin-top:.2rem;" <?= isset($_POST['consent_rgpd']) ? 'checked' : '' ?>>
            <span>J'accepte que mes donnees et celles de mon enfant soient traitees par l'Ecole Ruban Vert dans le cadre du processus d'admission, conformement a la <a href="<?= $r ?>politique-confidentialite.php" target="_blank">politique de confidentialite</a>. *</span>
          </label>
        </div>

        <button type="submit" class="btn-primary" style="margin-top:1rem;"><i class="fas fa-paper-plane"></i> Soumettre ma candidature</button>
      </form>

    <?php endif; ?>
  </div>
</section>

<style>
.admission-form h3 { color: var(--green-dark, #01463C); margin: 1.75rem 0 1rem; font-size: 1.1rem; }
.admission-form h3:first-child { margin-top: 0; }
.admission-form .form-group label { display:block; font-weight:600; font-size:.85rem; margin-bottom:.35rem; }
.admission-form input[type=text], .admission-form input[type=date], .admission-form input[type=email],
.admission-form input[type=tel], .admission-form select, .admission-form textarea, .admission-form input[type=file] {
  width:100%; padding:.65rem .85rem; border:1px solid #DDE3E0; border-radius:8px; font-family:inherit; font-size:.92rem;
}
@media (max-width: 700px) { .admission-form .form-grid { grid-template-columns:1fr !important; } }
</style>

<?php include ROOT . '/includes/footer.php'; ?>
