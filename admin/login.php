<?php
require_once __DIR__ . '/includes/auth.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = trim($_POST['email'] ?? '');
    $password = (string)($_POST['password'] ?? '');

    if ($email === '' || $password === '') {
        $error = 'Veuillez renseigner votre email et votre mot de passe.';
    } elseif (admin_attempt_login($email, $password)) {
        $next = $_GET['next'] ?? ($_POST['next'] ?? '');
        $next = $next ? urldecode($next) : (admin_base_path() . '/admin/index.php');
        header('Location: ' . $next);
        exit;
    } else {
        $error = 'Identifiants incorrects.';
    }
}

if (admin_current_user()) {
    header('Location: ' . admin_base_path() . '/admin/index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Connexion — Administration ERV</title>
<meta name="robots" content="noindex,nofollow">
<link rel="stylesheet" href="<?= admin_base_path() ?>/admin/assets/admin.css">
</head>
<body class="admin-body">
  <div class="admin-login-wrap">
    <div class="admin-login-box">
      <h1>Ecole Ruban Vert</h1>
      <p class="sub">Espace d'administration</p>
      <?php if ($error): ?>
        <div class="admin-alert error"><?= htmlspecialchars($error) ?></div>
      <?php endif; ?>
      <form method="post" action="">
        <input type="hidden" name="next" value="<?= htmlspecialchars($_GET['next'] ?? '') ?>">
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" required autofocus value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
        </div>
        <div class="form-group">
          <label for="password">Mot de passe</label>
          <input type="password" id="password" name="password" required>
        </div>
        <button type="submit" class="btn-admin" style="width:100%; justify-content:center;">
          Se connecter
        </button>
      </form>
    </div>
  </div>
</body>
</html>
