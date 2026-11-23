<?php
/**
 * Ecole Ruban Vert — Helpers partages module Location d'espaces
 */
require_once __DIR__ . '/../config/db.php';

function rental_generate_reference(): string {
    $pdo = db();
    do {
        $ref = 'LOC-' . date('Y') . '-' . strtoupper(substr(bin2hex(random_bytes(3)), 0, 5));
        $stmt = $pdo->prepare('SELECT COUNT(*) FROM rental_bookings WHERE reference_code = :ref');
        $stmt->execute([':ref' => $ref]);
    } while ((int)$stmt->fetchColumn() > 0);
    return $ref;
}

function rental_generate_invoice_number(): string {
    $pdo = db();
    do {
        $num = 'FAC-' . date('Y') . '-' . str_pad((string)random_int(1, 99999), 5, '0', STR_PAD_LEFT);
        $stmt = $pdo->prepare('SELECT COUNT(*) FROM rental_bookings WHERE invoice_number = :n');
        $stmt->execute([':n' => $num]);
    } while ((int)$stmt->fetchColumn() > 0);
    return $num;
}

function rental_status_label(string $status): string {
    $labels = [
        'en_attente' => 'En attente',
        'confirmee'  => 'Confirmee',
        'refusee'    => 'Refusee',
        'annulee'    => 'Annulee',
    ];
    return $labels[$status] ?? $status;
}

/** Nom du jour (0=dimanche..6=samedi) en francais. */
function rental_weekday_label(int $weekday): string {
    $days = ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
    return $days[$weekday] ?? (string)$weekday;
}

/**
 * Verifie si un espace est disponible pour une date/horaire donnes :
 * - pas d'exclusion (vacances, evenement interne) sur cette date pour cet espace (ou globale)
 * - pas de reservation existante (en_attente ou confirmee) qui chevauche le creneau demande
 * Retourne un tableau ['available' => bool, 'reason' => string|null].
 */
function rental_check_availability(int $spaceId, string $date, string $start, string $end, ?int $excludeBookingId = null): array {
    $pdo = db();

    $stmt = $pdo->prepare(
        'SELECT reason FROM rental_exclusions
         WHERE (space_id = :sid OR space_id IS NULL) AND :d BETWEEN start_date AND end_date
         LIMIT 1'
    );
    $stmt->execute([':sid' => $spaceId, ':d' => $date]);
    if ($row = $stmt->fetch()) {
        return ['available' => false, 'reason' => 'Periode indisponible : ' . ($row['reason'] ?: 'exclusion planifiee') . '.'];
    }

    $sql = 'SELECT COUNT(*) FROM rental_bookings
            WHERE space_id = :sid AND booking_date = :d
              AND status IN ("en_attente", "confirmee")
              AND start_time < :end AND end_time > :start';
    $params = [':sid' => $spaceId, ':d' => $date, ':start' => $start, ':end' => $end];
    if ($excludeBookingId) {
        $sql .= ' AND id != :ex';
        $params[':ex'] = $excludeBookingId;
    }
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    if ((int)$stmt->fetchColumn() > 0) {
        return ['available' => false, 'reason' => 'Ce creneau chevauche une reservation existante.'];
    }

    return ['available' => true, 'reason' => null];
}

/**
 * Gere l'upload d'une photo d'espace. Retourne le chemin relatif stocke ou null.
 */
function rental_handle_image_upload(array $file, string $slug): ?string {
    if (!isset($file['error']) || $file['error'] === UPLOAD_ERR_NO_FILE) {
        return null;
    }
    if ($file['error'] !== UPLOAD_ERR_OK) {
        return null;
    }
    $maxSize = 5 * 1024 * 1024;
    if ($file['size'] > $maxSize) {
        return null;
    }
    $allowed = ['jpg' => true, 'jpeg' => true, 'png' => true, 'webp' => true];
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!isset($allowed[$ext])) {
        return null;
    }
    $dir = dirname(__DIR__) . '/uploads/rentals/' . $slug;
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
    $safeName = uniqid('img_') . '.' . $ext;
    $dest = $dir . '/' . $safeName;
    if (!move_uploaded_file($file['tmp_name'], $dest)) {
        return null;
    }
    return 'uploads/rentals/' . $slug . '/' . $safeName;
}

/** Calcule un montant de devis simple a partir des tarifs de l'espace. */
function rental_estimate_amount(array $space, string $start, string $end): ?float {
    $startTs = strtotime($start);
    $endTs = strtotime($end);
    if ($startTs === false || $endTs === false || $endTs <= $startTs) {
        return null;
    }
    $hours = ($endTs - $startTs) / 3600;
    if ($hours >= 8 && !empty($space['price_per_day'])) {
        return round((float)$space['price_per_day'], 2);
    }
    if (!empty($space['price_per_hour'])) {
        return round((float)$space['price_per_hour'] * $hours, 2);
    }
    return null;
}
