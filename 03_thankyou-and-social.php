<?php
/**
 * FJDF: Danke-Seite (ID 11) + Footer Social Links
 * Quelle: sinfoniaporelperu.us (adaptiert AT)
 * Ausführen: wp eval-file 03_thankyou-and-social.php --path=cms
 */

// ---------------------------------------------------------------
// 1. DANKE-SEITE
// ---------------------------------------------------------------
$thank_you_id = 11;

wp_update_post([
    'ID'          => $thank_you_id,
    'post_title'  => 'Vielen Dank für Ihre Spende!',
    'post_status' => 'publish',
    'post_content' => '<!-- wp:paragraph -->
<p>Herzlichen Dank, dass Sie sich der Mission der Juan Diego Flórez Association Austria angeschlossen haben.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Ihr Beitrag ermöglicht es, dass mehr als 6.400 Kinder und Jugendliche in Peru Zugang zu kostenlosem Musikunterricht erhalten, ihr Talent entfalten und in der Musik einen Weg der Hoffnung und persönlichen Veränderung finden.</p>
<!-- /wp:paragraph -->',
]);
echo "✓ Danke-Seite: Titel + Inhalt gesetzt\n";

// ---------------------------------------------------------------
// 2. FOOTER SOCIAL LINKS (Options)
// HINWEIS: Bitte echte FJDF-Austria-URLs eintragen!
// Die folgenden URLs verweisen auf Sinfonía por el Perú direkt –
// sobald eigene FJDF-Austria-Profile existieren, bitte ersetzen.
// ---------------------------------------------------------------
$social = [
    'fjdf_social_facebook'  => 'https://www.facebook.com/jdflassociation',
    'fjdf_social_instagram' => 'https://www.instagram.com/sinfoniaporelperu/',
    'fjdf_social_linkedin'  => 'https://www.linkedin.com/company/sinfoniaporelperu/',
    'fjdf_social_youtube'   => 'https://www.youtube.com/@SinfoniaporelPeru',
];

foreach ($social as $field => $url) {
    update_field($field, $url, 'option');
    echo "✓ {$field}: {$url}\n";
}

// ---------------------------------------------------------------
// 3. NEWSLETTER (Options) – falls noch nicht gesetzt
// ---------------------------------------------------------------
if (empty(get_field('fjdf_newsletter_headline', 'option'))) {
    update_field('fjdf_newsletter_headline', 'Bleiben Sie nah am Wandel, den Sie bewirken', 'option');
    update_field('fjdf_newsletter_placeholder', 'Ihre E-Mail-Adresse', 'option');
    update_field('fjdf_newsletter_button', 'Newsletter abonnieren', 'option');
    echo "✓ Newsletter-Texte gesetzt\n";
} else {
    echo "ℹ Newsletter-Texte bereits vorhanden\n";
}

// ---------------------------------------------------------------
// 4. HEADER/FOOTER CTA
// ---------------------------------------------------------------
if (empty(get_field('fjdf_header_cta_label', 'option'))) {
    update_field('fjdf_header_cta_label', 'Jetzt spenden', 'option');
    echo "✓ Header CTA Label gesetzt\n";
}
if (empty(get_field('fjdf_footer_cta_label', 'option'))) {
    update_field('fjdf_footer_cta_label', 'Jetzt spenden', 'option');
    echo "✓ Footer CTA Label gesetzt\n";
}

echo "\n=== Danke-Seite + Social Links ✓ ===\n";
