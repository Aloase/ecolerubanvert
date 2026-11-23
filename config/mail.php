<?php
/**
 * Ecole Ruban Vert — Configuration Email (SMTP)
 *
 * A completer par l'ecole avec de vrais identifiants SMTP (ex: Gmail
 * Workspace, Office365, ou l'hebergeur de production). Tant que ce
 * fichier garde des valeurs vides, mail_send() bascule automatiquement
 * en "mode simulation" : les emails sont ecrits dans notifications_log
 * (statut 'failed', message commencant par "SIMULATION:") au lieu
 * d'etre reellement envoyes, pour ne jamais bloquer le parcours
 * utilisateur en attendant la configuration definitive.
 */

define('SMTP_HOST', '');
define('SMTP_PORT', 587);
define('SMTP_USER', '');
define('SMTP_PASS', '');
define('SMTP_SECURE', 'tls'); // 'tls' ou 'ssl'
define('MAIL_FROM_ADDRESS', 'no-reply@ecolerubanvert.com');
define('MAIL_FROM_NAME', 'Ecole Ruban Vert');
define('MAIL_ADMIN_ADDRESS', 'admin@ecolerubanvert.com');
