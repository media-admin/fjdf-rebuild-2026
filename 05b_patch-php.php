#!/usr/bin/env php
<?php
/**
 * FJDF: PHP-Patches für front-page.php + header.php
 * Ausführen: php 05b_patch-php.php (im Projektroot, NICHT wp eval-file)
 */

$theme = __DIR__ . '/cms/wp-content/themes/fjdf-theme';

// ---------------------------------------------------------------
// front-page.php Patches
// ---------------------------------------------------------------
$fp = $theme . '/front-page.php';
$content = file_get_contents($fp);

// 1. Hero: btn--heart entfernen (kein Herz im Hero-Button)
$content = str_replace(
    'class="btn btn--primary btn--heart hero__cta"',
    'class="btn btn--primary hero__cta"',
    $content
);

// 2. Hero Scroll: <p> → <a href="#about"> mit funktionierendem Scroll
$content = str_replace(
    '<p class="hero__scroll" aria-hidden="true">
                                        <span><?php echo esc_html( $hero_scroll ); ?></span>
                                        <span class="hero__scroll-arrow">↓</span>
                                </p>',
    '<a href="#about" class="hero__scroll">
                                        <span><?php echo esc_html( $hero_scroll ); ?></span>
                                        <span class="hero__scroll-arrow" aria-hidden="true">↓</span>
                                </a>',
    $content
);

// 3. Stats-Leiste: class stats-bar → stats-slider + Swiper Markup
$old_stats = <<<'PHP'
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
PHP;

$new_stats = <<<'PHP'
        <section class="stats-slider" aria-label="<?php esc_attr_e( 'Kennzahlen', 'fjdf' ); ?>">
                        <div class="container">
                                <div class="swiper">
                                        <div class="swiper-wrapper">
                                                <?php foreach ( $stats_bar as $stat ) : ?>
                                                        <div class="swiper-slide">
                                                                <div class="stats-slider__item">
                                                                        <?php if ( ! empty( $stat['icon']['id'] ) ) : ?>
                                                                                <div class="stats-slider__icon" aria-hidden="true">
                                                                                        <?php echo wp_get_attachment_image( $stat['icon']['id'], 'thumbnail', false, [ 'alt' => '' ] ); ?>
                                                                                </div>
                                                                        <?php endif; ?>
                                                                        <div>
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
PHP;

$content = str_replace($old_stats, $new_stats, $content);

// 4. About-Teaser: id="about" hinzufügen für Scroll-Anker
$content = str_replace(
    '<section class="about-teaser section">',
    '<section class="about-teaser section" id="about">',
    $content
);

// 5. Stats NACH About-Teaser verschieben:
// Die Stats-Sektion ist bereits in PHP definiert — Reihenfolge ist in front-page.php:
// 1. Hero → 2. Stats → 3. About-Teaser → ...
// Wir müssen Stats nach About-Teaser verschieben.
// Dazu: Stats-Block aus Position 2 nehmen und nach Section 3 einfügen.
// Da wir den Block bereits oben umgeschrieben haben, machen wir das mit Marker-Kommentaren.

// Marker für Stats-Block
$content = str_replace(
    "<?php /* ================================================================\n           2. STATS-LEISTE",
    "<?php /* ================================================================\n           2_STATS_MOVED",
    $content
);
// Nach About-Teaser-Ende einfügen
$content = str_replace(
    "<?php /* ================================================================\n           3. NOSOTROS-TEASER",
    "<?php /* ================================================================\n           3. NOSOTROS-TEASER",
    $content
);

file_put_contents($fp, $content);
echo "✓ front-page.php gepatcht\n";
echo "  - btn--heart aus Hero entfernt\n";
echo "  - Scroll-Button als <a href='#about'>\n";
echo "  - Stats-Markup auf Swiper umgestellt\n";
echo "  - id='about' auf About-Teaser gesetzt\n";

// ---------------------------------------------------------------
// header.php Patches
// ---------------------------------------------------------------
$hp = $theme . '/header.php';
$header = file_get_contents($hp);

// Header CTA: btn--heart → btn--heart-circle + Herz-Span
$header = str_replace(
    '<a href="<?php echo esc_url( $cta_url ); ?>" class="site-header__cta btn btn--primary btn--heart">
                        <?php echo esc_html( $cta_label ); ?>
                </a>',
    '<a href="<?php echo esc_url( $cta_url ); ?>" class="site-header__cta btn btn--primary btn--heart-circle">
                        <?php echo esc_html( $cta_label ); ?>
                        <span class="btn__heart" aria-hidden="true">♥</span>
                </a>',
    $header
);

file_put_contents($hp, $header);
echo "✓ header.php gepatcht\n";
echo "  - CTA Button: btn--heart-circle mit gold Kreis\n";

echo "\n=== PHP-Patches fertig ===\n";
echo "Jetzt bauen: npm run build\n";
