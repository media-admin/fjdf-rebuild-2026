#!/usr/bin/env php
<?php
/**
 * FJDF: Contrib-Section in front-page.php durch Flip-Card-Version ersetzen
 * Ausführen: php 13_contrib-flip-template.php
 */

$fp = __DIR__ . '/cms/wp-content/themes/fjdf-theme/front-page.php';
$content = file_get_contents($fp);

// Alten Contrib-Block entfernen
$content = preg_replace(
    '/\s*<\?php \/\* ={64}\s*7b\. CONTRIBUTION ITEMS.*?<\?php endif; \?>\s*/s',
    "\n\n",
    $content
);

// Neuen Flip-Card-Block einfügen (vor Zeile mit "7. DONATION CTA")
$new_block = <<<'PHP'

        <?php /* ================================================================
           7b. CONTRIBUTION ITEMS (Flip Cards)
           ================================================================ */ ?>
        <?php
        $contrib_label = get_field( 'fjdf_what_contrib_label', 8 );
        $contrib_head  = get_field( 'fjdf_what_contrib_headline', 8 );
        $contrib_items = get_field( 'fjdf_what_contrib_items', 8 );
        $back_texts    = get_option( 'fjdf_contrib_back_texts', [] );
        ?>
        <?php if ( ! empty( $contrib_items ) ) : ?>
                <section class="contrib-section section">
                        <div class="container">
                                <?php if ( $contrib_label ) : ?>
                                        <p class="contrib-section__label category-label u-text-center"><?php echo esc_html( $contrib_label ); ?></p>
                                <?php endif; ?>
                                <?php if ( $contrib_head ) : ?>
                                        <h2 class="contrib-section__headline"><?php echo esc_html( $contrib_head ); ?></h2>
                                <?php endif; ?>
                                <div class="contrib-section__grid">
                                        <?php foreach ( $contrib_items as $i => $item ) :
                                                $back_text = $back_texts[ $i ] ?? '';
                                        ?>
                                                <div class="contrib-card">
                                                        <div class="contrib-card__inner">
                                                                <!-- Vorderseite -->
                                                                <div class="contrib-card__front">
                                                                        <?php if ( ! empty( $item['image']['id'] ) ) : ?>
                                                                                <div class="contrib-card__image">
                                                                                        <?php echo wp_get_attachment_image(
                                                                                                $item['image']['id'],
                                                                                                'large',
                                                                                                false,
                                                                                                [ 'loading' => 'lazy', 'alt' => '' ]
                                                                                        ); ?>
                                                                                </div>
                                                                        <?php endif; ?>
                                                                        <p class="contrib-card__text"><?php echo esc_html( $item['text'] ); ?></p>
                                                                </div>
                                                                <!-- Rückseite -->
                                                                <?php if ( $back_text ) : ?>
                                                                        <div class="contrib-card__back">
                                                                                <p class="contrib-card__back-text"><?php echo esc_html( $back_text ); ?></p>
                                                                        </div>
                                                                <?php endif; ?>
                                                        </div>
                                                </div>
                                        <?php endforeach; ?>
                                </div>
                        </div>
                </section>
        <?php endif; ?>

PHP;

$marker = "<?php /* ================================================================\n           7. DONATION CTA BLOCK";
$content = str_replace($marker, $new_block . "\t\t" . $marker, $content);

file_put_contents($fp, $content);
echo "✓ Flip-Card-Template eingefügt\n";

// SCSS anhängen
$scss_path = __DIR__ . '/cms/wp-content/themes/fjdf-theme/assets/src/scss/pages/_home.scss';
$scss = file_get_contents($scss_path);

if (strpos($scss, '.contrib-section') === false) {
    $scss .= <<<'SCSS'


// ---------------------------------------------------------------
// Contribution Section (Flip Cards)
// ---------------------------------------------------------------
.contrib-section {
        background: var(--color-white);
}

.contrib-section__label {
        margin-bottom: var(--space-3);
}

.contrib-section__headline {
        font-family: var(--font-serif);
        font-size: clamp(1.75rem, 3vw, 2.5rem);
        font-weight: 400;
        color: var(--color-dark);
        text-align: center;
        max-width: 700px;
        margin-inline: auto;
        margin-bottom: var(--space-10);

        @include gold-underline-center;
}

.contrib-section__grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: var(--space-6);

        @include respond-to('md') {
                grid-template-columns: repeat(3, 1fr);
        }
}

// Flip Card
.contrib-card {
        perspective: 1000px;
        height: 420px;
}

.contrib-card__inner {
        position: relative;
        width: 100%;
        height: 100%;
        transition: transform 0.6s ease;
        transform-style: preserve-3d;

        .contrib-card:hover & {
                transform: rotateY(180deg);
        }
}

.contrib-card__front,
.contrib-card__back {
        position: absolute;
        inset: 0;
        border-radius: var(--radius-lg, 16px);
        backface-visibility: hidden;
        -webkit-backface-visibility: hidden;
        overflow: hidden;
}

.contrib-card__front {
        background: var(--color-cream);
        display: flex;
        flex-direction: column;
}

.contrib-card__image {
        flex: 1;
        overflow: hidden;

        img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                display: block;
        }
}

.contrib-card__text {
        padding: var(--space-4) var(--space-5);
        font-size: var(--text-body-sm);
        font-weight: 600;
        color: var(--color-dark);
        text-align: center;
        background: var(--color-cream);
        line-height: var(--leading-snug);

        &::after {
                content: '';
                display: block;
                width: 32px;
                height: 2px;
                background: var(--color-gold);
                margin: var(--space-2) auto 0;
        }
}

.contrib-card__back {
        background: var(--color-primary);
        transform: rotateY(180deg);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: var(--space-8);
}

.contrib-card__back-text {
        color: var(--color-white);
        font-size: var(--text-body-sm);
        line-height: var(--leading-relaxed);
        text-align: center;
}
SCSS;

    file_put_contents($scss_path, $scss);
    echo "✓ SCSS hinzugefügt\n";
} else {
    echo "ℹ SCSS bereits vorhanden\n";
}
