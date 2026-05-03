#!/usr/bin/env php
<?php
$fp = __DIR__ . '/cms/wp-content/themes/fjdf-theme/front-page.php';
$content = file_get_contents($fp);

// Stats-Block extrahieren (von <?php if ( ! empty( $stats_bar ) bis endif; ?>)
preg_match('/(\s*<\?php if \( ! empty\( \$stats_bar \) \) : \?>.*?endif; \?>)/s', $content, $m);
if (empty($m[1])) {
    echo "✗ Stats-Block nicht gefunden\n";
    exit;
}

$stats_block = $m[1];

// Stats-Block aus aktueller Position entfernen
$content = preg_replace('/\s*<\?php if \( ! empty\( \$stats_bar \) \) : \?>.*?endif; \?>/s', '', $content, 1);

// Nach dem About-Teaser einfügen (nach </section> des about-teaser)
// Der About-Teaser endet mit </section> gefolgt von dem What-Teaser-Kommentar
$content = preg_replace(
    '/(<\/section>\s*\n)(\s*<\?php \/\* ={64}\s*4\. QUÉ HACEMOS)/s',
    '$1' . "\n" . $stats_block . "\n" . '$2',
    $content
);

file_put_contents($fp, $content);
echo "✓ Stats-Slider nach About-Teaser verschoben\n";

// Kontrolle
preg_match_all('/stats_bar|about-teaser|what-teaser/', $content, $positions, PREG_OFFSET_CAPTURE);
foreach ($positions[0] as $p) {
    echo "  Pos " . $p[1] . ": " . $p[0] . "\n";
}
