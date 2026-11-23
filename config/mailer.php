<?php
/**
 * Ecole Ruban Vert — Helper d'envoi d'emails (PHPMailer + log)
 */
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/mail.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as PHPMailerException;

/**
 * Envoie un email (ou simule si SMTP non configure) et journalise le resultat.
 *
 * @param string $to           Destinataire
 * @param string $subject      Sujet
 * @param string $htmlBody     Corps HTML
 * @param string|null $related Type d'entite liee (ex: 'admission_application')
 * @param int|null $relatedId  Id de l'entite liee
 * @return bool Succes de l'envoi (ou simulation)
 */
function mail_send(string $to, string $subject, string $htmlBody, ?string $related = null, ?int $relatedId = null): bool {
    $simulate = (SMTP_HOST === '' || SMTP_USER === '');
    $status = 'sent';
    $error  = null;

    if ($simulate) {
        $error = 'SIMULATION: SMTP non configure (voir config/mail.php). Email non envoye reellement.';
        $status = 'failed';
    } else {
        try {
            $mailer = new PHPMailer(true);
            $mailer->isSMTP();
            $mailer->Host       = SMTP_HOST;
            $mailer->Port       = SMTP_PORT;
            $mailer->SMTPAuth   = true;
            $mailer->Username   = SMTP_USER;
            $mailer->Password   = SMTP_PASS;
            $mailer->SMTPSecure = SMTP_SECURE;
            $mailer->CharSet    = 'UTF-8';

            $mailer->setFrom(MAIL_FROM_ADDRESS, MAIL_FROM_NAME);
            $mailer->addAddress($to);
            $mailer->isHTML(true);
            $mailer->Subject = $subject;
            $mailer->Body    = $htmlBody;
            $mailer->AltBody = strip_tags($htmlBody);

            $mailer->send();
        } catch (PHPMailerException $e) {
            $status = 'failed';
            $error  = $e->getMessage();
        }
    }

    try {
        $stmt = db()->prepare(
            'INSERT INTO notifications_log (channel, recipient, subject, related_type, related_id, status, error_message)
             VALUES ("email", :recipient, :subject, :related_type, :related_id, :status, :error_message)'
        );
        $stmt->execute([
            ':recipient'     => $to,
            ':subject'       => $subject,
            ':related_type'  => $related,
            ':related_id'    => $relatedId,
            ':status'        => $status,
            ':error_message' => $error,
        ]);
    } catch (Throwable $e) {
        // Le log ne doit jamais faire planter le flux principal.
    }

    return $status === 'sent';
}
