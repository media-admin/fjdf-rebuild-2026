<?php
/**
 * FJDF: Contribution Items (Seite 8) aktualisieren
 * Bilder von sinfoniaporelperu.us importieren
 * Ausführen: wp eval-file 11_update-contrib-items.php --path=cms
 */

$post_id = 8; // was-wir-tun

// ---------------------------------------------------------------
// 1. Bilder von US-Seite importieren
// ---------------------------------------------------------------
$images = [
    'contrib-foto-1' => 'https://sinfoniaporelperu.us/wp-content/uploads/2025/08/Foto-3.png',
    'contrib-foto-2' => 'https://sinfoniaporelperu.us/wp-content/uploads/2025/08/Foto-1-1.png',
    'contrib-foto-3' => 'https://sinfoniaporelperu.us/wp-content/uploads/2025/08/Foto-2-1.png',
];

$image_ids = [];
foreach ($images as $key => $url) {
    // Prüfen ob Bild bereits importiert
    $existing = get_posts([
        'post_type'   => 'attachment',
        'meta_key'    => '_source_url',
        'meta_value'  => $url,
        'numberposts' => 1,
    ]);

    if (!empty($existing)) {
        $image_ids[$key] = $existing[0]->ID;
        echo "ℹ Bild bereits vorhanden: {$key} (ID {$existing[0]->ID})\n";
        continue;
    }

    // Bild herunterladen und importieren
    require_once ABSPATH . 'wp-admin/includes/media.php';
    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/image.php';

    $tmp = download_url($url);
    if (is_wp_error($tmp)) {
        echo "✗ Download fehlgeschlagen: {$key} – " . $tmp->get_error_message() . "\n";
        $image_ids[$key] = 74; // Fallback
        continue;
    }

    $file = [
        'name'     => basename($url),
        'type'     => 'image/png',
        'tmp_name' => $tmp,
        'error'    => 0,
        'size'     => filesize($tmp),
    ];

    $id = media_handle_sideload($file, $post_id);
    if (is_wp_error($id)) {
        echo "✗ Import fehlgeschlagen: {$key} – " . $id->get_error_message() . "\n";
        $image_ids[$key] = 74;
        @unlink($tmp);
        continue;
    }

    update_post_meta($id, '_source_url', $url);
    $image_ids[$key] = $id;
    echo "✓ Bild importiert: {$key} → ID {$id}\n";
}

// ---------------------------------------------------------------
// 2. Contribution Items mit echten Bildern + deutschen Texten
// ---------------------------------------------------------------
$contrib_items = [
    [
        'image' => $image_ids['contrib-foto-1'] ?? 74,
        'text'  => 'Sichere und schützende Lernumgebungen schaffen',
    ],
    [
        'image' => $image_ids['contrib-foto-2'] ?? 74,
        'text'  => 'Künstlerische Ausbildung für eine umfassende Entwicklung stärken',
    ],
    [
        'image' => $image_ids['contrib-foto-3'] ?? 74,
        'text'  => 'Lebensprojekte fördern',
    ],
];

update_field('fjdf_what_contrib_label', 'IHRE SPENDE', $post_id);
update_field('fjdf_what_contrib_headline', 'Mit Ihrer großzügigen Spende unterstützen Sie:', $post_id);
update_field('fjdf_what_contrib_items', $contrib_items, $post_id);

echo "✓ Contribution Items aktualisiert\n";
echo "\n=== Fertig ===\n";
