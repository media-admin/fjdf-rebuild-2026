<?php
/**
 * FJDF: 2 neue News-Beiträge
 * Quelle: sinfoniaporelperu.us/news/ → übersetzt auf Deutsch
 * Ausführen: wp eval-file 04_news-posts.php --path=cms
 */

function fjdf_upsert_post($slug, $args) {
    $existing = get_posts([
        'name'        => $slug,
        'post_type'   => 'post',
        'post_status' => 'any',
        'numberposts' => 1,
    ]);
    if (!empty($existing)) {
        echo "ℹ '{$slug}' existiert bereits (ID {$existing[0]->ID}) – übersprungen.\n";
        return $existing[0]->ID;
    }
    $id = wp_insert_post(array_merge(['post_type' => 'post', 'post_status' => 'publish', 'post_author' => 1, 'post_name' => $slug], $args));
    if (is_wp_error($id)) { echo "✗ " . $id->get_error_message() . "\n"; return null; }
    echo "✓ Erstellt: ID {$id} | {$args['post_title']}\n";
    return $id;
}

// ---------------------------------------------------------------
// BEITRAG 2: Juan Diego Flórez bei der UNO (9. Feb 2026)
// Quelle: sinfoniaporelperu.us/juan-diego-florez-highlights-at-the-un-...
// ---------------------------------------------------------------
$post2 = fjdf_upsert_post('juan-diego-florez-bei-der-uno-kultur-frieden-wohlbefinden', [
    'post_title'   => 'Juan Diego Flórez betont bei der UNO die Rolle der Kultur für Frieden, Wohlbefinden und psychische Gesundheit',
    'post_date'    => '2026-02-09 09:00:00',
    'post_excerpt' => 'Juan Diego Flórez, Präsident von Sinfonía por el Perú, traf sich bei den Vereinten Nationen mit Dr. Felipe Paullier, dem Untergeneralsekretär für Jugendangelegenheiten – mit dem Fokus auf psychische Gesundheit und die Wirkung von Musik.',
    'post_content' => '<!-- wp:paragraph -->
<p><strong>New York City –</strong> Juan Diego Flórez, Präsident von Sinfonía por el Perú, traf sich bei den Vereinten Nationen mit Dr. Felipe Paullier, dem Untergeneralsekretär für Jugendangelegenheiten der UN. Das Treffen konzentrierte sich auf die psychische Gesundheit und das Wohlbefinden von Jugendlichen sowie auf die globale Jugendstrategie des UN-Systems. Dabei wurde die Wirkung von Sinfonía por el Perú auf mehr als 35.000 Kinder, Jugendliche und junge Menschen hervorgehoben – in Übereinstimmung mit den globalen Entwicklungszielen und dem Aufbau demokratischerer und friedlicherer Gesellschaften.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>In einem globalen und regionalen Kontext, der von zunehmender Gewalt geprägt ist – in dem transnationale organisierte Kriminalität die Chancen und die Zukunft junger Generationen bedroht –, gibt es auch ein wachsendes Risiko für die psychische Gesundheit von Jugendlichen. Das Treffen unterstrich die Relevanz von kulturellen und bildungsbezogenen Initiativen, die Schutzfaktoren stärken, den gesellschaftlichen Zusammenhalt fördern und sozio-emotionale Kompetenzen ausbauen – besonders in gefährdeten Gemeinschaften.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2>Musik als Weg zum Frieden</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Sinfonía por el Perú präsentierte, wie sein Modell – das seit fast fünfzehn Jahren konsolidiert wird – konkrete Ergebnisse in der sozio-emotionalen Entwicklung, der Stärkung von Lebenskompetenzen, der Erhöhung von Schutzfaktoren und dem Wohlbefinden von Familien erzielt – durch kollektive Musikpraxis und die gemeinschaftsbasierte Arbeit seiner Zentren.</p>
<!-- /wp:paragraph -->

<!-- wp:quote -->
<blockquote class="wp-block-quote"><p>„In Peru haben wir ein auf Zusammenarbeit basierendes soziales Interventionsmodell aufgebaut, das seit fast fünfzehn Jahren unsere Zentren in Räume des Friedens und der Werte in Gemeinschaften verwandelt – und in Entwicklungschancen für tausende Familien. Wir wollen diese Erfahrung mit der Welt teilen und eine heute dringende Botschaft verbreiten: Chancen für Frieden, Solidarität und Zusammenarbeit für Jugendliche schaffen."</p><cite>Juan Diego Flórez</cite></blockquote>
<!-- /wp:quote -->

<!-- wp:paragraph -->
<p>Das Treffen war sehr positiv und ermöglichte es, Synergien zu identifizieren, um die internationale Sichtbarkeit der Wirkung von Sinfonía por el Perú zu stärken und Wege der Zusammenarbeit im Einklang mit der Agenda 2030 und der Strategie Youth 2030 auszuloten.</p>
<!-- /wp:paragraph -->',
]);

if ($post2) {
    set_post_thumbnail($post2, 48);
    update_post_meta($post2, '_fjdf_post_label', 'NEUIGKEIT');
    echo "  → Featured Image: ID 48 (Platzhalter)\n";
}

// ---------------------------------------------------------------
// BEITRAG 3: Sinfonía por el Perú beim Weltkongress (1. Dez 2025)
// Quelle: sinfoniaporelperu.us/gracias-a-ti-instrumentos-nuevos-...
// ---------------------------------------------------------------
$post3 = fjdf_upsert_post('sinfonia-beim-weltkongress-soziale-wirkung-der-musik', [
    'post_title'   => 'Sinfonía por el Perú beim Ersten Weltkongress zur sozialen Wirkung von Musik: „The Promise of Music"',
    'post_date'    => '2025-12-01 09:00:00',
    'post_excerpt' => 'Sinfonía por el Perú war beim Ersten Weltkongress zur sozialen Wirkung von Musik vertreten und präsentierte sein Bildungsmodell, das in fünfzehn Jahren mehr als 35.000 Kinder und Jugendliche in Peru erreicht hat.',
    'post_content' => '<!-- wp:paragraph -->
<p>Sinfonía por el Perú nahm am Ersten Weltkongress zur sozialen Wirkung von Musik – „The Promise of Music" – teil und präsentierte sein einzigartiges Bildungsmodell, das die Kraft der kollektiven Musik nutzt, um tausende Kinder und Jugendliche in vulnerablen Gemeinschaften Perus zu fördern.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2>Musik als internationales Modell sozialer Transformation</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Der Kongress brachte Organisationen, Forscher und Künstler aus aller Welt zusammen, die die soziale Wirkung von Musik auf Gemeinschaften dokumentieren und fördern. Sinfonía por el Perú präsentierte dabei seine experimentellen Wirkungsstudien und die Zeugnisse seiner Begünstigten – ein klarer Beleg für die Entwicklungs- und Transformationsmöglichkeiten, die kollektive Musik schafft.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Dank der Unterstützung von Spenderinnen und Spendern aus Österreich und aller Welt konnte Sinfonía por el Perú in fünfzehn Jahren mehr als 35.000 Kinder, Jugendliche und junge Menschen sowie ihre Familien positiv beeinflussen. Derzeit nehmen mehr als 6.400 Kinder und Jugendliche an den Programmen in über 30 Musikzentren in ganz Peru teil.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2>Ihre Spende macht diesen Einfluss möglich</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Jeder Beitrag, der bei der Juan Diego Flórez Association Austria eingeht, fließt direkt in die Finanzierung von Musikunterricht, Instrumenten und die Begleitung der Kinder in ihrer persönlichen und künstlerischen Entwicklung. Mit Ihrer Spende werden Sie Teil einer Bewegung, die Leben verändert – in Peru und weit darüber hinaus.</p>
<!-- /wp:paragraph -->',
]);

if ($post3) {
    set_post_thumbnail($post3, 48);
    update_post_meta($post3, '_fjdf_post_label', 'NEUIGKEIT');
    echo "  → Featured Image: ID 48 (Platzhalter)\n";
}

// ---------------------------------------------------------------
// ÜBERSICHT
// ---------------------------------------------------------------
echo "\n=== Alle News-Beiträge ===\n";
$posts = get_posts(['post_type' => 'post', 'post_status' => 'publish', 'numberposts' => 10, 'orderby' => 'date', 'order' => 'DESC']);
foreach ($posts as $p) {
    $thumb = has_post_thumbnail($p->ID) ? '🖼' : '○';
    printf("%s ID: %d | %s | %s\n", $thumb, $p->ID, get_the_date('d.m.Y', $p), $p->post_title);
}

echo "\nHINWEIS: Featured Images (ID 48) sind Platzhalter.\n";
echo "Eigene Bilder hochladen und ersetzen mit:\n";
echo "  wp post meta update <POST-ID> _thumbnail_id <BILD-ID> --path=cms\n";
