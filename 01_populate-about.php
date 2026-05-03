<?php
/**
 * FJDF: Über uns (ID 7)
 * Quelle: sinfoniaporelperu.us/about/ → übersetzt + Österreich-adaptiert
 * Ausführen: wp eval-file 01_populate-about.php --path=cms
 */

$post_id = 7;

update_field('fjdf_about_hero_headline', 'Eine solidarische Brücke zwischen Österreich und Peru', $post_id);
update_field('fjdf_about_hero_subtext',
    'Von Österreich aus unterstützen wir Sinfonía por el Perú – durch die Förderung von Spenden, die die Entwicklung von Kindern und Jugendlichen durch kostenlosen Musikunterricht vorantreiben.',
    $post_id
);
echo "✓ Hero gesetzt\n";

$intro = '<p><strong>Juan Diego Flórez Association Austria</strong> ist eine in Österreich gegründete Organisation und strategische Partnerin von Sinfonía por el Perú. Unser Zweck ist es, spendenbasierte Beiträge zu fördern, die zur sozialen und humanistischen Entwicklung von tausenden Kindern, Jugendlichen und jungen Menschen in Peru beitragen – durch kostenlosen, gemeinschaftlichen und qualitativ hochwertigen Musikunterricht. Auf diese Weise stärken wir die Arbeit der gemeinnützigen Organisation, die vom peruanischen Tenor Juan Diego Flórez gegründet wurde und der er vorsitzt.</p>';
update_field('fjdf_about_intro', $intro, $post_id);
echo "✓ Intro-Text gesetzt\n";

update_field('fjdf_about_bridge_text', 'Wir mobilisieren Solidarität, um Leben durch Musik zu verändern.', $post_id);
echo "✓ Bridge-Text gesetzt\n";

update_field('fjdf_about_gallery', [74, 48], $post_id);
echo "✓ Galerie gesetzt (IDs 74, 48 – bitte durch eigene Bilder ersetzen)\n";

update_field('fjdf_about_history_label', 'Wir fördern Unterstützung, um mehr als 6.400 Kindern ihre Träume zu ermöglichen', $post_id);

$history = '<p>Wir fördern die Unterstützung von Unternehmen, Institutionen, der Zivilgesellschaft und Einzelpersonen, damit mehr als 6.400 Kinder, Jugendliche und junge Menschen von Sinfonía por el Perú weiterhin ihre Träume durch Musikunterricht verwirklichen können.</p>';
update_field('fjdf_about_history_text', $history, $post_id);
echo "✓ History gesetzt\n";

wp_update_post(['ID' => $post_id, 'post_status' => 'publish']);
echo "\n=== Über uns ✓ ===\n";
