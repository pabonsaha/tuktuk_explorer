<?php

header("Content-Type: application/xml; charset=utf-8");

require_once "../config/database.php";

$baseUrl = "https://lisbontuktukexplorer.com";

echo '<?xml version="1.0" encoding="UTF-8"?>';

?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

<!-- Static pages -->

<url>
<loc><?php echo $baseUrl; ?></loc>
<changefreq>weekly</changefreq>
<priority>1.0</priority>
</url>

<url>
<loc><?php echo $baseUrl; ?>/explore</loc>
<changefreq>weekly</changefreq>
<priority>0.9</priority>
</url>

<?php

// Fetch all slugs from tours table
$query = $pdo->query("SELECT slug FROM tours");

while ($row = $query->fetch(PDO::FETCH_ASSOC)) {

$slug = $row['slug'];

?>

<url>
<loc><?php echo $baseUrl."/place/".$slug; ?></loc>
<changefreq>monthly</changefreq>
<priority>0.8</priority>
</url>

<?php } ?>

</urlset>