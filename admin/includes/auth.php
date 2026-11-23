<?php
/**
 * Ecole Ruban Vert — Auth admin (session-based)
 */
require_once __DIR__ . '/../../config/db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_name('erv_admin_sess');
    session_start();
}

/** Chemin base de l'app (ex: /ecolerubanvert) calcule dynamiquement,
 *  pour ne pas dependre d'un chemin de deploiement fixe. */
function admin_base_path(): string {
    static $base = null;
    if ($base === null) {
        $docRoot = str_replace('\\', '/', rtrim($_SERVER['DOCUMENT_ROOT'] ?? '', '/'));
        $appRoot = str_replace('\\', '/', rtrim(dirname(__DIR__, 2), '/'));
        $base = substr($appRoot, strlen($docRoot));
        if ($base === false) $base = '';
    }
    return $base;
}

/** Redirige vers le login si l'utilisateur n'est pas connecte. */
function admin_require_login(): void {
    if (empty($_SESSION['admin_id'])) {
        $back = urlencode($_SERVER['REQUEST_URI'] ?? '');
        header('Location: ' . admin_base_path() . '/admin/login.php?next=' . $back);
        exit;
    }
}

/** Retourne l'utilisateur admin courant (array) ou null. */
function admin_current_user(): ?array {
    if (empty($_SESSION['admin_id'])) return null;
    return [
        'id'    => $_SESSION['admin_id'],
        'name'  => $_SESSION['admin_name'] ?? '',
        'email' => $_SESSION['admin_email'] ?? '',
        'role'  => $_SESSION['admin_role'] ?? '',
    ];
}

/** Tente une connexion. Retourne true si succes. */
function admin_attempt_login(string $email, string $password): bool {
    $stmt = db()->prepare('SELECT * FROM admin_users WHERE email = :email AND is_active = 1 LIMIT 1');
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch();

    if (!$user || !password_verify($password, $user['password_hash'])) {
        return false;
    }

    session_regenerate_id(true);
    $_SESSION['admin_id']    = $user['id'];
    $_SESSION['admin_name']  = $user['name'];
    $_SESSION['admin_email'] = $user['email'];
    $_SESSION['admin_role']  = $user['role'];

    $upd = db()->prepare('UPDATE admin_users SET last_login_at = NOW() WHERE id = :id');
    $upd->execute([':id' => $user['id']]);

    return true;
}

function admin_logout(): void {
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }
    session_destroy();
}

/** Simple protection CSRF pour les formulaires admin. */
function admin_csrf_token(): string {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function admin_csrf_check(?string $token): bool {
    return !empty($token) && !empty($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}
