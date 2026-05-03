#!/usr/bin/env php
<?php
$fp = __DIR__ . '/cms/wp-content/themes/fjdf-theme/front-page.php';
$lines = file($fp);

$new = <<<'PHP'

        <?php /* ================================================================
           7b. CONTRIBUTION ITEMS
           ================================================================ */ ?>
        <?php
        $contrib_label = get_field( 'fjdf_what_contrib_label', 8 );
        $contrib_head  = get_field( 'fjdf_what_contrib_headline', 8 );
        $contrib_items = get_field( 'fjdf_what_contrib_items', 8 );
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
                                        <?php foreach ( $contrib_items as $item ) : ?>
                                                <div class="contrib-item">
                                                        <?php if ( ! empty( $item['image']['id'] ) ) : ?>
                                                                <div class="contrib-item__image">
                                                                        <?php echo wp_get_attachment_image( $item['image']['id'], 'fjdf-news-card', false, [
                                                                                'loading' => 'lazy',
                                                                                'alt'     => esc_attr( $item['text'] ?? '' ),
                                                                        ] ); ?>
                                                                </div>
                                                        <?php endif; ?>
                                                        <p class="contrib-item__text"><?php echo esc_html( $item['text'] ); ?></p>
                                                </div>
                                        <?php endforeach; ?>
                                </div>
                        </div>
                </section>
        <?php endif; ?>

PHP;

array_splice($lines, 334, 0, [$new]);
file_put_contents($fp, implode('', $lines));
echo "✓ Contrib-Block eingefügt\n";
