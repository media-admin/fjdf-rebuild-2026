<?php
/**
 * FJDF: Was wir tun (ID 8)
 * Quelle: sinfoniaporelperu.us/what-we-do/ → übersetzt + Österreich-adaptiert
 * Ausführen: wp eval-file 02_populate-what-we-do.php --path=cms
 */

$post_id = 8;

// ---------------------------------------------------------------
// 1. HERO
// ---------------------------------------------------------------
update_field('fjdf_what_hero_headline', 'Wir fördern Chancen durch Musik', $post_id);
update_field('fjdf_what_hero_subtext',
    'Wir sind eine Brücke der Solidarität zwischen Sinfonía por el Perú und einem Netzwerk aus Einzelpersonen, Unternehmen und Institutionen in Österreich, die durch kollektiven Musikunterricht sozialen Wandel vorantreiben. Wir mobilisieren Ressourcen und Spenden, die die Wirkung dieser Organisation im Leben tausender Kinder, Jugendlicher und junger Menschen in Vulnerabilitätssituationen stärken.',
    $post_id
);
echo "✓ Hero gesetzt\n";

// ---------------------------------------------------------------
// 2. IMPACT-SEKTION
// ---------------------------------------------------------------
update_field('fjdf_what_impact_label', 'WAS WIR TUN', $post_id);
update_field('fjdf_what_impact_headline', 'Unser Einfluss – ihre neuen Möglichkeiten', $post_id);
update_field('fjdf_what_impact_intro',
    'Sinfonía por el Perú ist eine gemeinnützige Organisation, die durch Musik soziale und menschliche Entwicklung fördert. Seit ihrer Gründung vor fünfzehn Jahren hat sie mehr als 35.000 Begünstigte und ihre Familien positiv beeinflusst.',
    $post_id
);
echo "✓ Impact-Intro gesetzt\n";

// ---------------------------------------------------------------
// 3. IMPACT TABS – echte Zahlen aus sinfoniaporelperu.us
// ---------------------------------------------------------------
$tabs = [
    [
        'title' => 'Individuell',
        'stats' => [
            ['value' => '+90%', 'text' => 'der Kinder berichten von gesteigertem Selbstwertgefühl und persönlichem Vertrauen.'],
            ['value' => '+80%', 'text' => 'sagen, dass sie sich glücklicher fühlen, seit sie Teil von Sinfonía sind.'],
            ['value' => '+70%', 'text' => 'verbessern ihre Fähigkeit zur Teamarbeit und zum Ausdruck von Emotionen.'],
            ['value' => '+100%', 'text' => 'der Kinder entwickeln grundlegende musikalische Fähigkeiten in ihrem ersten Jahr.'],
        ],
    ],
    [
        'title' => 'Bildung',
        'stats' => [
            ['value' => '+29%', 'text' => 'streben nach einem Postgraduierten- oder Spezialisierungsstudium.'],
            ['value' => '+9%',  'text' => 'Anstieg des Homeschoolings unter Programmteilnehmenden.'],
            ['value' => '+18%', 'text' => 'üben täglich Musik – ein Zeichen für nachhaltige Bildungsintegration.'],
        ],
    ],
    [
        'title' => 'Familie',
        'stats' => [
            ['value' => '-51%', 'text' => 'Rückgang der körperlichen Bestrafung bei Respektlosigkeit.'],
            ['value' => '-42%', 'text' => 'Rückgang schwerer Disziplinarmaßnahmen innerhalb der Familie.'],
            ['value' => '-13%', 'text' => 'Rückgang der Zeit, die für Hausarbeit und familiäre Pflegeaufgaben aufgewendet wird.'],
        ],
    ],
];

update_field('fjdf_what_tabs', $tabs, $post_id);
echo "✓ Impact-Tabs gesetzt (3 Tabs mit echten Statistiken)\n";

// ---------------------------------------------------------------
// 4. TESTIMONIAL – Naysha Ubaldo (aus US-Seite, 1. Zeugnis)
// ---------------------------------------------------------------
update_field('fjdf_what_test_label', 'ZEUGNIS', $post_id);
update_field('fjdf_what_test_image', 48, $post_id); // Platzhalter – bitte ersetzen
update_field('fjdf_what_test_quote',
    'Musik erzeugt Klänge, die die Seele berühren, und wenn ich singe, fühle ich mich frei und ganz ich selbst. Für mich bedeutet Musik, dass Menschen Träume haben, frei sein können, Hoffnung haben – und wissen, dass Musik die Welt verändern kann.',
    $post_id
);
update_field('fjdf_what_test_name', 'Naysha Ubaldo', $post_id);
update_field('fjdf_what_test_origin', 'Begünstigte des Núcleo Huaraz', $post_id);
update_field('fjdf_what_test_cta_label', 'Jetzt spenden', $post_id);
update_field('fjdf_what_test_cta_url', get_permalink(10), $post_id);
echo "✓ Testimonial (Naysha Ubaldo) gesetzt\n";

// ---------------------------------------------------------------
// 5. CONTRIBUTION ITEMS – aus sinfoniaporelperu.us
// ---------------------------------------------------------------
update_field('fjdf_what_contrib_label', 'IHRE SPENDE', $post_id);
update_field('fjdf_what_contrib_headline', 'Mit Ihrer großzügigen Spende unterstützen Sie:', $post_id);

$contrib_items = [
    [
        'image' => 48,
        'text'  => 'Die Schaffung sicherer und schützender Lernumgebungen für Kinder und Jugendliche – Orte, die Kreativität, Freiheit und eine starke Schutzkultur fördern.',
    ],
    [
        'image' => 74,
        'text'  => 'Die Stärkung der künstlerischen Ausbildung für eine umfassende Entwicklung – mit Zugang zu Stipendien, Austauschprogrammen, Praktika, internationalen Tourneen und Residenzen.',
    ],
    [
        'image' => 48,
        'text'  => 'Die Förderung von Lebensprojekten: Jedes Kind und jeder Jugendliche hat Träume. In der Musik finden sie einen Weg der Hoffnung – Ihre Spende macht diese Projekte möglich.',
    ],
];

update_field('fjdf_what_contrib_items', $contrib_items, $post_id);
echo "✓ Contribution Items gesetzt\n";
echo "  → Tipp: Bilder durch thematische Fotos aus der Mediathek ersetzen (IDs 74 / 48 sind Platzhalter)\n";

// ---------------------------------------------------------------
// 6. Zusatztext nach Impact-Tabs (sofern Template es nutzt)
// ---------------------------------------------------------------
// Falls fjdf_what_impact_outro o. ä. existiert – hier einkommentieren:
// update_field('fjdf_what_impact_outro', '...', $post_id);

// ---------------------------------------------------------------
// 7. Publish
// ---------------------------------------------------------------
wp_update_post(['ID' => $post_id, 'post_status' => 'publish']);
echo "\n=== Was wir tun ✓ ===\n";
