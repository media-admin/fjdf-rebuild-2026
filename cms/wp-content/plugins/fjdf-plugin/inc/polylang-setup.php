<?php
/**
 * FJDF — Polylang Setup & CPT/Taxonomy Registration
 *
 * Registers CPTs and taxonomies with Polylang (free version).
 * Activated when the Agency Core "Multilanguage" toggle is ON.
 *
 * Languages: DE (default/primary) → EN → ES
 *
 * Requires:
 *  - Polylang free (plugin active)
 *  - Agency Core multi-language toggle enabled
 *
 * @package fjdf
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register translatable post types with Polylang.
 * Called on pll_init hook (fires after Polylang is ready).
 */
add_action( 'pll_init', 'fjdf_polylang_register_post_types' );

function fjdf_polylang_register_post_types(): void {
    if ( ! function_exists( 'pll_register_string' ) ) {
        return;
    }

    // Nothing to register for post types here — Polylang picks up
    // all public CPTs automatically. We only need to handle strings.
}

/**
 * Register translatable strings with Polylang.
 * These strings appear in Polylang → Translations → Strings.
 *
 * After activation: go to Polylang → Strings and translate each entry.
 */
add_action( 'init', 'fjdf_polylang_register_strings' );

function fjdf_polylang_register_strings(): void {
    if ( ! function_exists( 'pll_register_string' ) ) {
        return;
    }

    $group = 'FJDF Theme';

    // Navigation
    pll_register_string( 'nav_home',         __( 'Startseite', 'fjdf' ),                $group );
    pll_register_string( 'nav_about',        __( 'Über uns', 'fjdf' ),                  $group );
    pll_register_string( 'nav_what',         __( 'Was wir tun', 'fjdf' ),               $group );
    pll_register_string( 'nav_news',         __( 'Aktuelles', 'fjdf' ),                 $group );
    pll_register_string( 'nav_donate',       __( 'Jetzt spenden', 'fjdf' ),             $group );

    // Global UI
    pll_register_string( 'btn_donate',       __( 'Jetzt spenden', 'fjdf' ),             $group );
    pll_register_string( 'btn_floating',     __( 'Spenden', 'fjdf' ),                   $group );
    pll_register_string( 'btn_read_more',    __( 'Weiterlesen', 'fjdf' ),               $group );
    pll_register_string( 'btn_load_more',    __( 'Mehr anzeigen', 'fjdf' ),             $group );
    pll_register_string( 'btn_learn_more',   __( 'Mehr erfahren', 'fjdf' ),             $group );
    pll_register_string( 'btn_all_news',     __( 'Alle Neuigkeiten', 'fjdf' ),          $group );

    // Archive
    pll_register_string( 'archive_title',    __( 'Aktuelles', 'fjdf' ),                 $group );
    pll_register_string( 'archive_desc',     __( 'Erfahren Sie die neuesten Nachrichten und Ereignisse rund um Sinfonía por el Perú und wie Ihr Beitrag vielen Kindern und Jugendlichen in Peru zugutekommen kann.', 'fjdf' ), $group );
    pll_register_string( 'other_news',       __( 'Weitere Beiträge', 'fjdf' ),          $group );

    // Footer
    pll_register_string( 'footer_collab',    __( 'Zusammenarbeit mit:', 'fjdf' ),       $group );
    pll_register_string( 'footer_social',    __( 'Folgen Sie uns:', 'fjdf' ),           $group );
    pll_register_string( 'footer_copyright', __( 'Alle Rechte vorbehalten © {year}, Juan Diego Flórez Association.', 'fjdf' ), $group );

    // Newsletter
    pll_register_string( 'newsletter_head',  __( 'Bleiben Sie nah am Wandel, den Sie bewirken', 'fjdf' ), $group );
    pll_register_string( 'newsletter_btn',   __( 'Newsletter abonnieren', 'fjdf' ),     $group );
    pll_register_string( 'newsletter_input', __( 'E-Mail-Adresse', 'fjdf' ),            $group );

    // Certificate modal
    pll_register_string( 'cert_headline',    __( 'Erhalten Sie Ihren Spendennachweis', 'fjdf' ), $group );
    pll_register_string( 'cert_subtext',     __( 'Fordern Sie ihn einfach an, um Steuern in Österreich abzuziehen und Ihren Beitrag zu belegen.', 'fjdf' ), $group );
    pll_register_string( 'cert_btn',         __( 'Spendennachweis anfordern', 'fjdf' ), $group );

    // Thank you page
    pll_register_string( 'thankyou_back',    __( 'Zurück zur Startseite', 'fjdf' ),     $group );

    // Breadcrumb
    pll_register_string( 'breadcrumb_home',  __( 'Startseite', 'fjdf' ),                $group );
    pll_register_string( 'breadcrumb_news',  __( 'Aktuelles', 'fjdf' ),                 $group );
}

/**
 * Language switcher shortcode.
 * Usage: [fjdf_language_switcher] or [fjdf_language_switcher type="flags"]
 *
 * Polylang free does NOT support the_languages() widget in all contexts,
 * so we provide a lightweight shortcode fallback.
 */
add_shortcode( 'fjdf_language_switcher', 'fjdf_language_switcher_shortcode' );

function fjdf_language_switcher_shortcode( array $atts ): string {
    if ( ! function_exists( 'pll_the_languages' ) ) {
        return '';
    }

    $atts = shortcode_atts( [
        'type'       => 'text', // 'text' or 'flags'
        'show_names' => true,
    ], $atts );

    $languages = pll_the_languages( [ 'raw' => 1 ] );

    if ( empty( $languages ) ) {
        return '';
    }

    ob_start();
    ?>
    <ul class="language-switcher" role="list" aria-label="<?php esc_attr_e( 'Sprachauswahl', 'fjdf' ); ?>">
        <?php foreach ( $languages as $lang ) : ?>
            <li class="language-switcher__item <?php echo $lang['current_lang'] ? 'is-current' : ''; ?>">
                <a href="<?php echo esc_url( $lang['url'] ); ?>"
                   lang="<?php echo esc_attr( $lang['slug'] ); ?>"
                   hreflang="<?php echo esc_attr( $lang['slug'] ); ?>"
                   <?php echo $lang['current_lang'] ? 'aria-current="true"' : ''; ?>
                   class="language-switcher__link">
                    <?php if ( 'flags' === $atts['type'] && ! empty( $lang['flag'] ) ) : ?>
                        <img src="<?php echo esc_url( $lang['flag'] ); ?>"
                             alt="<?php echo esc_attr( $lang['name'] ); ?>"
                             width="18" height="12" loading="lazy">
                    <?php endif; ?>
                    <?php if ( $atts['show_names'] ) : ?>
                        <span><?php echo esc_html( strtoupper( $lang['slug'] ) ); ?></span>
                    <?php endif; ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
    <?php
    return ob_get_clean();
}
