#!/usr/bin/env php
<?php
$fp = __DIR__ . '/cms/wp-content/themes/fjdf-theme/front-page.php';
$content = file_get_contents($fp);

$old = <<<'PHP'
        <?php if ( ! empty( $stats_bar ) ) : ?>
                <section class="stats-bar" aria-label="<?php esc_attr_e( 'Kennzahlen', 'fjdf' ); ?>">
                        <div class="container stats-bar__inner">
                                <?php foreach ( $stats_bar as $stat ) : ?>
                                        <div class="stats-bar__item">
                                                <?php if ( ! empty( $stat['icon']['id'] ) ) : ?>
                                                        <div class="stats-bar__icon" aria-hidden="true">
                                                                <?php echo wp_get_attachment_image( $stat['icon']['id'], 'thumbnail', false, [ 'alt' => '' ] ); ?>
                                                        </div>
                                                <?php endif; ?>
                                                <div class="stats-bar__text">
                                                        <strong class="stats-bar__number"><?php echo esc_html( $stat['number'] ); ?></strong>
                                                        <span class="stats-bar__label"><?php echo esc_html( $stat['label'] ); ?></span>
                                                </div>
                                        </div>
                                <?php endforeach; ?>
                        </div>
                </section>
        <?php endif; ?>
PHP;

$new = <<<'PHP'
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
PHP;

if (strpos($content, $old) !== false) {
    $content = str_replace($old, $new, $content);
    file_put_contents($fp, $content);
    echo "✓ front-page.php: stats-bar → stats-slider (Swiper) ersetzt\n";
} else {
    echo "✗ Block nicht gefunden — bitte manuell prüfen\n";
}
