<?php
/**
 * Ecole Ruban Vert — Generateur de sitemap.xml dynamique.
 * Parcourt l'arborescence du site et liste toutes les pages publiques
 * (exclut admin/, config/, includes/, vendor/, uploads/, database/, node_modules/).
 * Accessible via /sitemap.xml (voir .htaccess) ou directement /sitemap-generator.php
 */
header('Content-Type: application/xml; charset=UTF-8');

$root = __DIR__;
$baseUrl = 'https://ecolerubanvert.com';

$excludeDirs = ['admin', 'config', 'includes', 'vendor', 'uploads', 'database', 'node_modules', '.git'];
$excludeFiles = ['404.php', 'sitemap-generator.php', 'admissions/suivi-dossier.php', 'location-espaces/suivi.php'];

$files = [];
$iterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($root, FilesystemIterator::SKIP_DOTS)
);

foreach ($iterator as $file) {
    if ($file->getExtension() !== 'php') continue;

    $relativePath = str_replace('\\', '/', substr($file->getPathname(), strlen($root) + 1));

    $topDir = explode('/', $relativePath)[0];
    if (in_array($topDir, $excludeDirs, true)) continue;
    if (in_array($relativePath, $excludeFiles, true)) continue;

    $files[] = [
        'loc' => $baseUrl . '/' . $relativePath,
        'lastmod' => date('Y-m-d', $file->getMTime()),
        'priority' => $relativePath === 'index.php' ? '1.0' : (substr_count($relativePath, '/') === 0 ? '0.8' : '0.6'),
    ];
}

usort($files, fn($a, $b) => strcmp($a['loc'], $b['loc']));

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
foreach ($files as $f) {
    echo "  <url>\n";
    echo '    <loc>' . htmlspecialchars($f['loc']) . "</loc>\n";
    echo '    <lastmod>' . $f['lastmod'] . "</lastmod>\n";
    echo '    <priority>' . $f['priority'] . "</priority>\n";
    echo "  </url>\n";
}
echo '</urlset>';
