<?php
/**
 * Ecole Ruban Vert — Connexion base de donnees (PDO MySQL)
 *
 * En local (WAMP) : utilisateur root, sans mot de passe (config par defaut WAMP).
 * En production : remplacer DB_USER / DB_PASS par les vrais identifiants,
 * idealement via variables d'environnement plutot qu'en dur dans ce fichier.
 */

define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'ecolerubanvert');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

/**
 * Retourne une instance PDO partagee (singleton simple).
 * @return PDO
 */
function db(): PDO {
    static $pdo = null;
    if ($pdo === null) {
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;
        try {
            $pdo = new PDO($dsn, DB_USER, DB_PASS, [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ]);
        } catch (PDOException $e) {
            http_response_code(500);
            die('Erreur de connexion a la base de donnees. Veuillez reessayer plus tard.');
        }
    }
    return $pdo;
}
