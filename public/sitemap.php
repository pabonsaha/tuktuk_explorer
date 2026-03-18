<?php

ob_start();

header("Content-Type: application/xml; charset=utf-8");

require_once "../config/database.php";

$baseUrl = "https://lisbontuktukexplorer.com";

echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

// Static pages
echo '
<url>
  <loc>'.$baseUrl.'</loc>
  <changefreq>weekly</changefreq>
  <priority>1.0</priority>
</url>

<url>
  <loc>'.$baseUrl.'/explore</loc>
  <changefreq>weekly</changefreq>
  <priority>0.9</priority>
</url>
';

// Dynamic pages
$query = $pdo->query("SELECT slug FROM tours");

while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    echo '
    <url>
      <loc>'.$baseUrl.'/place/'.$row['slug'].'</loc>
      <changefreq>monthly</changefreq>
      <priority>0.8</priority>
    </url>';
}

echo '</urlset>';