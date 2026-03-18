<?php
// Start output buffering to prevent any accidental whitespace
ob_start();

// Set correct header for XML
header("Content-Type: application/xml; charset=utf-8");

// Include database config
require_once "../config/database.php";

// Base URL of your website
$baseUrl = "https://lisbontuktukexplorer.com";

// Start XML
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

// ---- Static pages ----
$staticPages = [
    ['loc' => $baseUrl, 'changefreq' => 'weekly', 'priority' => '1.0'],
    ['loc' => $baseUrl . '/explore', 'changefreq' => 'weekly', 'priority' => '0.9'],
];

foreach ($staticPages as $page) {
    echo '<url>';
    echo '<loc>' . htmlspecialchars($page['loc'], ENT_QUOTES, 'UTF-8') . '</loc>';
    echo '<changefreq>' . $page['changefreq'] . '</changefreq>';
    echo '<priority>' . $page['priority'] . '</priority>';
    echo '</url>';
}

// ---- Dynamic pages from tours table ----
try {
    $query = $pdo->query("SELECT slug FROM tours");
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $slug = $row['slug'];
        echo '<url>';
        echo '<loc>' . htmlspecialchars($baseUrl . '/place/' . $slug, ENT_QUOTES, 'UTF-8') . '</loc>';
        echo '<changefreq>monthly</changefreq>';
        echo '<priority>0.8</priority>';
        echo '</url>';
    }
} catch (Exception $e) {
    // If something goes wrong, don't output errors in XML
    // You can log errors instead
    error_log("Sitemap error: " . $e->getMessage());
}

// Close URL set
echo '</urlset>';

// Flush output buffer
ob_end_flush();