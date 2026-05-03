<?php
/**
 * FJDF Diagnose: Page-IDs und ACF-Felder ausgeben
 * Ausführen: wp eval-file 00_diagnose-pages.php --path=cms
 */

$slugs = ['ueber-uns', 'about', 'was-wir-tun', 'what-we-do', 'spenden', 'donate', 'danke', 'thank-you', 'aktuelles', 'news'];

echo "\n=== SEITEN ===\n";
foreach ($slugs as $slug) {
    $p = get_page_by_path($slug);
    if ($p) {
        echo sprintf("ID: %d | Slug: %s | Titel: %s | Template: %s\n",
            $p->ID, $p->post_name, $p->post_title,
            get_post_meta($p->ID, '_wp_page_template', true) ?: '(default)'
        );
    }
}

echo "\n=== ACF FELDGRUPPEN (registriert) ===\n";
if (function_exists('acf_get_field_groups')) {
    $groups = acf_get_field_groups();
    foreach ($groups as $group) {
        echo "\nGruppe: " . $group['title'] . " (key: " . $group['key'] . ")\n";
        $fields = acf_get_fields($group['key']);
        if ($fields) {
            foreach ($fields as $f) {
                echo "  - " . $f['name'] . " (" . $f['type'] . ") key=" . $f['key'] . "\n";
                // Sub-fields für Repeater/Group ausgeben
                if (!empty($f['sub_fields'])) {
                    foreach ($f['sub_fields'] as $sf) {
                        echo "      sub: " . $sf['name'] . " (" . $sf['type'] . ") key=" . $sf['key'] . "\n";
                        if (!empty($sf['sub_fields'])) {
                            foreach ($sf['sub_fields'] as $ssf) {
                                echo "          sub-sub: " . $ssf['name'] . " (" . $ssf['type'] . ") key=" . $ssf['key'] . "\n";
                            }
                        }
                    }
                }
            }
        }
    }
}

echo "\n=== ACF-WERTE ABOUT-SEITE ===\n";
$about = get_page_by_path('ueber-uns') ?: get_page_by_path('about');
if ($about) {
    $fields = get_fields($about->ID);
    if ($fields) {
        echo "Felder für ID " . $about->ID . ":\n";
        print_r($fields);
    } else {
        echo "Keine ACF-Werte gesetzt für ID " . $about->ID . "\n";
    }
}

echo "\n=== ACF-WERTE WHAT-WE-DO-SEITE ===\n";
$wwd = get_page_by_path('was-wir-tun') ?: get_page_by_path('what-we-do');
if ($wwd) {
    $fields = get_fields($wwd->ID);
    if ($fields) {
        echo "Felder für ID " . $wwd->ID . ":\n";
        print_r($fields);
    } else {
        echo "Keine ACF-Werte gesetzt für ID " . $wwd->ID . "\n";
    }
}

echo "\n=== TEMPLATE-DATEIEN IM THEME ===\n";
$theme_dir = get_template_directory();
$templates = glob($theme_dir . '/page-*.php');
foreach ($templates as $t) {
    echo basename($t) . "\n";
}

echo "\n=== DONE ===\n";
