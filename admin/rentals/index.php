<?php
require_once __DIR__ . '/../includes/auth.php';
admin_require_login();

require_once dirname(__DIR__, 2) . '/includes/rentals-helpers.php';

$pdo = db();
$notice = '';

function rental_slugify(string $text): string {
    $text = iconv('UTF-8', 'ASCII//TRANSLIT', $text) ?: $text;
    $text = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $text));
    return trim($text, '-');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && admin_csrf_check($_POST['csrf'] ?? null)) {
    $action = $_POST['action'] ?? '';

    if ($action === 'create' || $action === 'update') {
        $name        = trim($_POST['name'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $capacity    = max(0, (int)($_POST['capacity'] ?? 0));
        $equipment   = trim($_POST['equipment'] ?? '');
        $priceHour   = $_POST['price_per_hour'] !== '' ? (float)$_POST['price_per_hour'] : null;
        $priceDay    = $_POST['price_per_day'] !== '' ? (float)$_POST['price_per_day'] : null;
        $isActive    = isset($_POST['is_active']) ? 1 : 0;

        if ($name === '') {
            $notice = 'Le nom de l\'espace est requis.';
        } else {
            try {
                if ($action === 'create') {
                    $slugBase = rental_slugify($name);
                    $slug = $slugBase;
                    $i = 1;
                    $check = $pdo->prepare('SELECT COUNT(*) FROM rental_spaces WHERE slug = :s');
                    do {
                        $check->execute([':s' => $slug]);
                        if ((int)$check->fetchColumn() === 0) break;
                        $slug = $slugBase . '-' . (++$i);
                    } while (true);

                    $coverImage = null;
                    if (!empty($_FILES['cover_image']['name'])) {
                        $coverImage = rental_handle_image_upload($_FILES['cover_image'], $slug);
                    }

                    $stmt = $pdo->prepare(
                        'INSERT INTO rental_spaces (name, slug, description, capacity, equipment, price_per_hour, price_per_day, cover_image, is_active)
                         VALUES (:name, :slug, :desc, :cap, :equip, :ph, :pd, :cover, :active)'
                    );
                    $stmt->execute([
                        ':name' => $name, ':slug' => $slug, ':desc' => $description, ':cap' => $capacity,
                        ':equip' => ($equipment ?: null), ':ph' => $priceHour, ':pd' => $priceDay,
                        ':cover' => $coverImage, ':active' => $isActive,
                    ]);
                    $notice = 'Espace cree.';
                } else {
                    $id = (int)($_POST['id'] ?? 0);
                    $slugStmt = $pdo->prepare('SELECT slug FROM rental_spaces WHERE id = :id');
                    $slugStmt->execute([':id' => $id]);
                    $slug = $slugStmt->fetchColumn();

                    $coverSql = '';
                    $params = [
                        ':id' => $id, ':name' => $name, ':desc' => $description, ':cap' => $capacity,
                        ':equip' => ($equipment ?: null), ':ph' => $priceHour, ':pd' => $priceDay, ':active' => $isActive,
                    ];
                    if ($slug && !empty($_FILES['cover_image']['name'])) {
                        $newCover = rental_handle_image_upload($_FILES['cover_image'], $slug);
                        if ($newCover) {
                            $coverSql = ', cover_image = :cover';
                            $params[':cover'] = $newCover;
                        }
                    }

                    $stmt = $pdo->prepare(
                        "UPDATE rental_spaces SET name=:name, description=:desc, capacity=:cap, equipment=:equip,
                         price_per_hour=:ph, price_per_day=:pd, is_active=:active $coverSql WHERE id=:id"
                    );
                    $stmt->execute($params);
                    $notice = 'Espace mis a jour.';
                }
            } catch (Throwable $e) {
                $notice = 'Erreur : cet espace existe peut-etre deja.';
            }
        }
    } elseif ($action === 'delete') {
        $id = (int)($_POST['id'] ?? 0);
        $pdo->prepare('DELETE FROM rental_spaces WHERE id = :id')->execute([':id' => $id]);
        $notice = 'Espace supprime.';
    }
}

$spaces = $pdo->query(
    "SELECT s.*, (SELECT COUNT(*) FROM rental_bookings b WHERE b.space_id = s.id AND b.status IN ('en_attente','confirmee')) AS active_bookings
     FROM rental_spaces s ORDER BY s.name"
)->fetchAll();

$editSpace = null;
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare('SELECT * FROM rental_spaces WHERE id = :id');
    $stmt->execute([':id' => (int)$_GET['edit']]);
    $editSpace = $stmt->fetch();
}

$pageTitle = 'Espaces a louer';
$__active  = 'rentals';
include __DIR__ . '/../includes/layout-header.php';
?>

<div class="admin-header-row">
  <div><h1>Espaces a louer</h1><p>Gerez le catalogue des espaces disponibles a la location.</p></div>
</div>

<?php if ($notice): ?><div class="admin-alert success"><?= htmlspecialchars($notice) ?></div><?php endif; ?>

<div class="admin-panel">
  <h2><?= $editSpace ? 'Modifier "' . htmlspecialchars($editSpace['name']) . '"' : 'Ajouter un espace' ?></h2>
  <form method="post" enctype="multipart/form-data" class="form-grid" style="display:grid; grid-template-columns:repeat(3,1fr); gap:1rem;">
    <input type="hidden" name="csrf" value="<?= admin_csrf_token() ?>">
    <input type="hidden" name="action" value="<?= $editSpace ? 'update' : 'create' ?>">
    <?php if ($editSpace): ?><input type="hidden" name="id" value="<?= $editSpace['id'] ?>"><?php endif; ?>

    <div class="form-group"><label>Nom *</label><input type="text" name="name" required value="<?= htmlspecialchars($editSpace['name'] ?? '') ?>"></div>
    <div class="form-group"><label>Capacite (personnes)</label><input type="number" name="capacity" min="0" value="<?= htmlspecialchars((string)($editSpace['capacity'] ?? 0)) ?>"></div>
    <div class="form-group"><label>Photo de couverture</label><input type="file" name="cover_image" accept="image/*"></div>
    <div class="form-group" style="grid-column:1/-1;"><label>Description</label><textarea name="description" rows="2" style="width:100%;"><?= htmlspecialchars($editSpace['description'] ?? '') ?></textarea></div>
    <div class="form-group"><label>Equipements (texte libre)</label><input type="text" name="equipment" value="<?= htmlspecialchars($editSpace['equipment'] ?? '') ?>"></div>
    <div class="form-group"><label>Tarif / heure (FCFA)</label><input type="number" step="0.01" name="price_per_hour" value="<?= htmlspecialchars((string)($editSpace['price_per_hour'] ?? '')) ?>"></div>
    <div class="form-group"><label>Tarif / jour (FCFA)</label><input type="number" step="0.01" name="price_per_day" value="<?= htmlspecialchars((string)($editSpace['price_per_day'] ?? '')) ?>"></div>
    <div class="form-group"><label><input type="checkbox" name="is_active" <?= (!$editSpace || $editSpace['is_active']) ? 'checked' : '' ?>> Visible sur le site public</label></div>
    <div class="form-group" style="grid-column:1/-1; display:flex; gap:.75rem;">
      <button type="submit" class="btn-admin"><i class="fas fa-<?= $editSpace ? 'save' : 'plus' ?>"></i> <?= $editSpace ? 'Enregistrer' : 'Ajouter' ?></button>
      <?php if ($editSpace): ?><a href="index.php" class="btn-admin small outline">Annuler</a><?php endif; ?>
    </div>
  </form>
</div>

<div class="admin-panel">
  <h2>Tous les espaces</h2>
  <table class="admin-table">
    <thead><tr><th>Nom</th><th>Capacite</th><th>Tarifs</th><th>Reservations actives</th><th>Statut</th><th></th></tr></thead>
    <tbody>
      <?php if (!$spaces): ?><tr><td colspan="6" style="text-align:center; padding:1.5rem; color:var(--a-gray);">Aucun espace.</td></tr><?php endif; ?>
      <?php foreach ($spaces as $s): ?>
      <tr>
        <td><?= htmlspecialchars($s['name']) ?></td>
        <td><?= (int)$s['capacity'] ?></td>
        <td>
          <?php if ($s['price_per_hour']): ?><?= number_format((float)$s['price_per_hour'],0,',',' ') ?>/h<?php endif; ?>
          <?php if ($s['price_per_day']): ?> · <?= number_format((float)$s['price_per_day'],0,',',' ') ?>/j<?php endif; ?>
        </td>
        <td><?= (int)$s['active_bookings'] ?></td>
        <td><span class="badge <?= $s['is_active'] ? 'badge-accepte' : 'badge-refuse' ?>"><?= $s['is_active'] ? 'Publie' : 'Masque' ?></span></td>
        <td style="display:flex; gap:.4rem;">
          <a href="?edit=<?= $s['id'] ?>" class="btn-admin small outline">Modifier</a>
          <form method="post" onsubmit="return confirm('Supprimer cet espace ?');"><input type="hidden" name="csrf" value="<?= admin_csrf_token() ?>"><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= $s['id'] ?>"><button type="submit" class="btn-admin small danger">Suppr.</button></form>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php include __DIR__ . '/../includes/layout-footer.php'; ?>
