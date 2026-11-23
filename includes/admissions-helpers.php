<?php
/**
 * Ecole Ruban Vert — Helpers partages module Admissions
 */
require_once __DIR__ . '/../config/db.php';

function admission_generate_reference(): string {
    $pdo = db();
    do {
        $ref = 'ERV-' . date('Y') . '-' . strtoupper(substr(bin2hex(random_bytes(3)), 0, 5));
        $stmt = $pdo->prepare('SELECT COUNT(*) FROM admission_applications WHERE reference_code = :ref');
        $stmt->execute([':ref' => $ref]);
    } while ((int)$stmt->fetchColumn() > 0);
    return $ref;
}

function admission_generate_token(): string {
    return bin2hex(random_bytes(32));
}

/** Libelles humains pour les statuts de candidature. */
function admission_status_label(string $status): string {
    $labels = [
        'recu'               => 'Recu',
        'en_cours'           => 'En cours d\'examen',
        'entretien_planifie' => 'Entretien planifie',
        'accepte'            => 'Accepte',
        'liste_attente'      => 'Liste d\'attente',
        'refuse'             => 'Non retenu',
    ];
    return $labels[$status] ?? $status;
}

function admission_doc_type_label(string $type): string {
    $labels = [
        'etat_civil' => 'Acte de naissance / Etat civil',
        'bulletin'   => 'Bulletins scolaires',
        'photo'      => 'Photo d\'identite',
        'vaccin'     => 'Carnet de vaccination',
        'autre'      => 'Autre document',
    ];
    return $labels[$type] ?? $type;
}

/**
 * Gere l'upload d'un fichier pour une candidature donnee.
 * Retourne le chemin relatif stocke, ou null si aucun fichier / erreur.
 */
function admission_handle_upload(array $file, string $referenceCode, string $docType): ?array {
    if (!isset($file['error']) || $file['error'] === UPLOAD_ERR_NO_FILE) {
        return null;
    }
    if ($file['error'] !== UPLOAD_ERR_OK) {
        return ['error' => 'Erreur lors de l\'envoi du fichier (' . $docType . ').'];
    }

    $maxSize = 5 * 1024 * 1024; // 5 Mo
    if ($file['size'] > $maxSize) {
        return ['error' => 'Le fichier "' . $docType . '" depasse 5 Mo.'];
    }

    $allowed = ['pdf' => 'application/pdf', 'jpg' => 'image/jpeg', 'jpeg' => 'image/jpeg', 'png' => 'image/png'];
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!array_key_exists($ext, $allowed)) {
        return ['error' => 'Format non autorise pour "' . $docType . '" (PDF, JPG ou PNG uniquement).'];
    }

    $dir = dirname(__DIR__) . '/uploads/admissions/' . $referenceCode;
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
    $safeName = $docType . '_' . uniqid() . '.' . $ext;
    $dest = $dir . '/' . $safeName;

    if (!move_uploaded_file($file['tmp_name'], $dest)) {
        return ['error' => 'Impossible d\'enregistrer le fichier "' . $docType . '".'];
    }

    return [
        'stored_path'   => 'uploads/admissions/' . $referenceCode . '/' . $safeName,
        'original_name' => $file['name'],
        'file_size'     => $file['size'],
    ];
}
