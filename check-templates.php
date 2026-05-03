<?php
/**
 * FJDF: page-thank-you.php + page-about.php + page-what-we-do.php ausgeben
 * Ausführen: wp eval-file check-templates.php --path=cms
 */
$theme_dir = get_template_directory();
$templates = ['page-thank-you.php', 'page-about.php', 'page-what-we-do.php'];

foreach ($templates as $tpl) {
    $file = $theme_dir . '/' . $tpl;
    echo "\n" . str_repeat('=', 60) . "\n";
    echo "FILE: {$tpl}\n";
    echo str_repeat('=', 60) . "\n";
    if (file_exists($file)) {
        echo file_get_contents($file);
    } else {
        echo "NICHT GEFUNDEN\n";
    }
}
