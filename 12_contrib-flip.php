#!/usr/bin/env php
<?php
/**
 * FJDF: Contribution Items Rückseiten-Texte speichern
 * Ausführen: wp eval-file 12_contrib-flip.php --path=cms
 */

// Rückseiten-Texte (aus sinfoniaporelperu.us, übersetzt)
$back_texts = [
    0 => 'Sinfonía por el Perú sorgt dafür, dass seine Zentren sichere Räume für Kinder, Jugendliche und junge Menschen sind – Orte, die Kreativität, Freiheit und eine starke Schutzkultur fördern.',
    1 => 'Das Interventionsmodell von Sinfonía begleitet die Begünstigten in ihrer persönlichen, schulischen und beruflichen Entwicklung – mit Zugang zu Stipendien, Austauschprogrammen und künstlerischen Residenzen.',
    2 => 'Jedes Kind und jeder Jugendliche hat Träume und Ziele. In der Musik finden sie einen Weg der Hoffnung. Ihr Beitrag ermöglicht es, diese Lebensprojekte Wirklichkeit werden zu lassen.',
];

update_option('fjdf_contrib_back_texts', $back_texts);
echo "✓ Rückseiten-Texte gespeichert\n";

// Bilder regenerieren (damit fjdf-news-card Größe verfügbar ist)
foreach ([118, 119, 120] as $id) {
    $file = get_attached_file($id);
    if ($file && file_exists($file)) {
        wp_update_attachment_metadata($id, wp_generate_attachment_metadata($id, $file));
        echo "✓ Bild {$id} neu generiert\n";
    }
}

echo "\n=== Fertig ===\n";
