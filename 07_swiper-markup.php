#!/usr/bin/env php
<?php
$fp = __DIR__ . '/cms/wp-content/themes/fjdf-theme/front-page.php';
$content = file_get_contents($fp);

$new_section = <<<'NEWBLOCK'

        <?php if ( ! empty( $stats_bar ) ) : ?>
                <section class="stats-slider" aria-label="<?php esc_attr_e( 'Kennzahlen', 'fjdf' ); ?>">
                        <div class="container">
                                <div class="swiper js-stats-slider">
                                        <div class="swiper-wrapper">
                                                <?php foreach ( $stats_bar as $stat ) : ?>
                                                        <div class="swiper-slide">
                                                                <div class="stats-slider__item">
                                                                        <?php if ( ! empty( $stat['icon']['id'] ) ) : ?>
                                                                                <div class="stats-slider__icon" aria-hidden="true">
                                                                                        <?php echo wp_get_attachment_image( $stat['icon']['id'], 'medium', false, [ 'alt' => '' ] ); ?>
                                                                                </div>
                                                                        <?php endif; ?>
                                                                        <div class="stats-slider__text">
                                                                                <strong class="stats-slider__number"><?php echo esc_html( $stat['number'] ); ?></strong>
                                                                                <span class="stats-slider__label"><?php echo esc_html( $stat['label'] ); ?></span>
                                                                        </div>
                                                                </div>
                                                        </div>
                                                <?php endforeach; ?>
                                        </div>
                                        <div class="swiper-pagination"></div>
                                </div>
                        </div>
                </section>
        <?php endif; ?>
NEWBLOCK;

$pattern = '/\s*<\?php if \( ! empty\( \$stats_bar \) \) : \?>\s*<section class="stats-slider".*?endif; \?>/s';

if (preg_match($pattern, $content)) {
    $result = preg_replace($pattern, $new_section, $content);
    file_put_contents($fp, $result);
    echo "✓ Swiper-Markup eingefügt\n";
} else {
    echo "✗ Pattern nicht gefunden — manueller Fallback\n";
    // Manuell: Zeilen 78-96 direkt ersetzen
    $lines = file($fp);
    $new_lines = [];
    $skip = false;
    $inserted = false;
    foreach ($lines as $i => $line) {
        $linenum = $i + 1;
        if ($linenum == 78) {
            $skip = true;
            $new_lines[] = $new_section . "\n";
        }
        if ($skip && $linenum >= 78 && $linenum <= 96) {
            continue;
        }
        if ($linenum > 96) $skip = false;
        if (!$skip) $new_lines[] = $line;
    }
    file_put_contents($fp, implode('', $new_lines));
    echo "✓ Zeilenbasierter Fallback angewendet (Zeilen 78-96 ersetzt)\n";
}

// Kontrolle
echo "\nKontrolle (Zeilen 78-104):\n";
$lines = file($fp);
for ($i = 77; $i < min(104, count($lines)); $i++) {
    echo ($i+1) . ": " . $lines[$i];
}
