<?php
/**
 * FJDF Theme — functions.php
 * Juan Diego Flórez Association
 *
 * @package fjdf
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;


// =============================================================================
// 1. CONSTANTS
// =============================================================================

define( 'FJDF_VERSION',   wp_get_theme()->get( 'Version' ) );
define( 'FJDF_DIR',       get_template_directory() );
define( 'FJDF_URI',       get_template_directory_uri() );
define( 'FJDF_ASSETS',    FJDF_URI . '/assets/dist' );
define( 'FJDF_INC',       FJDF_DIR . '/inc' );


// =============================================================================
// 2. THEME SETUP
// =============================================================================

add_action( 'after_setup_theme', 'fjdf_setup' );

function fjdf_setup(): void {

	// Load text domain
	load_theme_textdomain( 'fjdf', FJDF_DIR . '/languages' );

	// WordPress Core Features
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', [
		'search-form', 'comment-form', 'comment-list',
		'gallery', 'caption', 'style', 'script',
	] );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'editor-styles' );
	add_editor_style( 'assets/dist/css/style.css' );
	add_theme_support( 'give' );
	add_theme_support( 'custom-logo', [
		'height'      => 80,
		'width'       => 240,
		'flex-height' => true,
		'flex-width'  => true,
	] );
}


// =============================================================================
// 3. ASSET ENQUEUE
// =============================================================================

add_action( 'wp_enqueue_scripts', 'fjdf_enqueue_assets' );

add_action( 'wp_head', function () {
    $f = get_template_directory_uri() . '/assets/dist/fonts/';
    echo '<style>
@font-face{font-family:"Larken";src:url("' . $f . 'larken/larkenvariablegx.woff2") format("woff2-variations");font-weight:100 900;font-style:normal;font-display:swap}
@font-face{font-family:"Larken";src:url("' . $f . 'larken/larkenvariableitalicgx.woff2") format("woff2-variations");font-weight:100 900;font-style:italic;font-display:swap}
@font-face{font-family:"Aribau Grotesk";src:url("' . $f . 'aribau/aribaugrotesk-rg.woff2") format("woff2");font-weight:400;font-style:normal;font-display:swap}
@font-face{font-family:"Aribau Grotesk";src:url("' . $f . 'aribau/aribaugrotesk-rgit.woff2") format("woff2");font-weight:400;font-style:italic;font-display:swap}
@font-face{font-family:"Aribau Grotesk";src:url("' . $f . 'aribau/aribaugrotesk-md.woff2") format("woff2");font-weight:500;font-style:normal;font-display:swap}
@font-face{font-family:"Aribau Grotesk";src:url("' . $f . 'aribau/aribaugrotesk-mdit.woff2") format("woff2");font-weight:500;font-style:italic;font-display:swap}
@font-face{font-family:"Aribau Grotesk";src:url("' . $f . 'aribau/aribaugrotesk-bd.woff2") format("woff2");font-weight:700;font-style:normal;font-display:swap}
</style>';
}, 1 );

add_filter( 'script_loader_tag', 'fjdf_add_module_type', 10, 3 );

function fjdf_add_module_type( string $tag, string $handle, string $src ): string {
	if ( in_array( $handle, [ 'fjdf-main', 'fjdf-vite-client' ], true ) ) {
		return '<script type="module" src="' . esc_url( $src ) . '"></script>' . "\n";
	}
	return $tag;
}

function fjdf_enqueue_assets(): void {

	$version  = FJDF_VERSION;
	$hot_file = FJDF_DIR . '/assets/hot';

	if ( file_exists( $hot_file ) ) {
		$hot_url = rtrim( trim( file_get_contents( $hot_file ) ), '/' ); // phpcs:ignore
		wp_enqueue_script( 'fjdf-vite-client', $hot_url . '/@vite/client',          [], null, true );
		wp_enqueue_script( 'fjdf-main',        $hot_url . '/assets/src/js/main.js', [], null, true );
		return;
	}

	$css_path = FJDF_DIR . '/assets/dist/css/style.css';
	wp_enqueue_style(
		'fjdf-style',
		FJDF_ASSETS . '/css/style.css',
		[],
		file_exists( $css_path ) ? filemtime( $css_path ) : FJDF_VERSION
	);

	$js_path = FJDF_DIR . '/assets/dist/js/main.js';
	if ( file_exists( $js_path ) ) {
		wp_enqueue_script(
			'fjdf-main',
			FJDF_ASSETS . '/js/main.js',
			[],
			filemtime( $js_path ),
			true
		);
	}

	// Inline data for AJAX
	wp_localize_script( 'fjdf-main', 'fjdfData', [
		'ajaxUrl' => admin_url( 'admin-ajax.php' ),
		'nonce'   => wp_create_nonce( 'fjdf_nonce' ),
		'siteUrl' => get_site_url(),
		'i18n'    => [
			'loading'    => __( 'Wird geladen…', 'fjdf' ),
			'noResults'  => __( 'Keine Ergebnisse gefunden.', 'fjdf' ),
			'error'      => __( 'Ein Fehler ist aufgetreten. Bitte versuche es erneut.', 'fjdf' ),
		],
	] );
}


// =============================================================================
// 4. IMAGE SIZES
// =============================================================================

add_action( 'after_setup_theme', 'fjdf_image_sizes' );

function fjdf_image_sizes(): void {

	update_option( 'thumbnail_size_w', 400 );
	update_option( 'thumbnail_size_h', 300 );
	update_option( 'thumbnail_size_crop', true );
	update_option( 'medium_size_w', 768 );
	update_option( 'medium_size_h', 0 );
	update_option( 'large_size_w', 1280 );
	update_option( 'large_size_h', 0 );

	// News — featured card (large listing image)
	add_image_size( 'fjdf-news-featured', 780, 520, true );
	// News — card grid (3-column listing)
	add_image_size( 'fjdf-news-card', 520, 360, true );
	// News — thumbnail (sidebar / other news)
	add_image_size( 'fjdf-news-thumb', 300, 200, true );
	// Article header (single post, full width)
	add_image_size( 'fjdf-article-header', 1280, 600, true );
	// Hero (homepage, full width)
	add_image_size( 'fjdf-hero', 1920, 1080, true );
	// Testimonial / beneficiary portrait
	add_image_size( 'fjdf-portrait', 640, 800, true );
	// Partner logos (About, Footer)
	add_image_size( 'fjdf-logo', 240, 120, false );
	// Donation page split (left image column)
	add_image_size( 'fjdf-donation-split', 960, 1200, true );
}

add_filter( 'image_size_names_choose', 'fjdf_image_size_names' );

function fjdf_image_size_names( array $sizes ): array {
	return array_merge( $sizes, [
		'fjdf-news-featured'  => __( 'FJDF: News Featured', 'fjdf' ),
		'fjdf-news-card'      => __( 'FJDF: News Card', 'fjdf' ),
		'fjdf-news-thumb'     => __( 'FJDF: News Thumbnail', 'fjdf' ),
		'fjdf-article-header' => __( 'FJDF: Article Header', 'fjdf' ),
		'fjdf-hero'           => __( 'FJDF: Hero', 'fjdf' ),
		'fjdf-portrait'       => __( 'FJDF: Portrait', 'fjdf' ),
		'fjdf-logo'           => __( 'FJDF: Partner Logo', 'fjdf' ),
		'fjdf-donation-split' => __( 'FJDF: Donation Split', 'fjdf' ),
	] );
}


// =============================================================================
// 5. NAVIGATION MENUS
// =============================================================================

add_action( 'after_setup_theme', 'fjdf_register_menus' );

function fjdf_register_menus(): void {
	register_nav_menus( [
		'primary'      => __( 'Hauptnavigation', 'fjdf' ),
		'footer'       => __( 'Footer Navigation', 'fjdf' ),
		'footer-legal' => __( 'Footer Legal (Impressum, Datenschutz)', 'fjdf' ),
	] );
}


// =============================================================================
// 6. GIVEWP SUPPORT
// =============================================================================

add_filter( 'give_get_template_part', 'fjdf_givewp_template_path', 10, 1 );

function fjdf_givewp_template_path( string $template ): string {
	$custom = FJDF_DIR . '/give-templates/' . $template;
	if ( file_exists( $custom ) ) {
		return $custom;
	}
	return $template;
}

add_action( 'wp_enqueue_scripts', 'fjdf_givewp_styles', 999 );

function fjdf_givewp_styles(): void {
	if ( ! function_exists( 'give_is_success_page' ) ) {
		return;
	}
	wp_dequeue_style( 'give-styles' );
	wp_dequeue_style( 'give-base-styles' );
}

add_filter( 'give_currency', 'fjdf_givewp_currency' );

function fjdf_givewp_currency( string $currency ): string {
	return 'EUR'; // Austria
}

add_filter( 'give_currency_position', 'fjdf_givewp_currency_position' );

function fjdf_givewp_currency_position( string $position ): string {
	return 'before'; // EUR 10
}


// =============================================================================
// 7. ACF INTEGRATION
// =============================================================================

add_action( 'acf/init', 'fjdf_acf_options_page' );

function fjdf_acf_options_page(): void {
	if ( ! function_exists( 'acf_add_options_page' ) ) {
		return;
	}

	acf_add_options_page( [
		'page_title' => __( 'FJDF Theme-Einstellungen', 'fjdf' ),
		'menu_title' => __( 'FJDF Einstellungen', 'fjdf' ),
		'menu_slug'  => 'fjdf-settings',
		'capability' => 'manage_options',
		'icon_url'   => 'dashicons-heart',
		'position'   => 60,
	] );
}

add_action( 'acf/init', 'fjdf_load_acf_fields' );

function fjdf_load_acf_fields(): void {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	$field_files = glob( FJDF_INC . '/acf-fields/*.php' );

	if ( empty( $field_files ) ) {
		return;
	}

	foreach ( $field_files as $file ) {
		require_once $file;
	}
}

add_action( 'admin_notices', 'fjdf_acf_notice' );

function fjdf_acf_notice(): void {
	if ( function_exists( 'get_field' ) ) {
		return;
	}
	echo '<div class="notice notice-error"><p>';
	printf(
		esc_html__( '%s: ACF PRO ist nicht aktiviert. Bitte aktiviere Advanced Custom Fields PRO.', 'fjdf' ),
		'<strong>FJDF Theme</strong>'
	);
	echo '</p></div>';
}


// =============================================================================
// 8. INCLUDES
// =============================================================================

$fjdf_includes = [
	'/inc/acf-fields/options.php',       // Global ACF options fields
	'/inc/acf-fields/home.php',          // Homepage ACF fields
	'/inc/acf-fields/about.php',         // About page ACF fields       (was: nosotros.php)
	'/inc/acf-fields/what-we-do.php',    // What we do ACF fields       (was: que-hacemos.php)
	'/inc/acf-fields/donate.php',        // Donation page ACF fields    (was: dona.php)
	'/inc/template-functions.php',
	'/inc/template-tags.php',
	'/inc/news-helpers.php',
];

foreach ( $fjdf_includes as $file ) {
	$path = FJDF_DIR . $file;
	if ( file_exists( $path ) ) {
		require_once $path;
	}
}


// =============================================================================
// PERFORMANCE & CLEANUP
// =============================================================================

remove_action( 'wp_head',           'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles',   'print_emoji_styles' );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
remove_action( 'wp_head', 'wp_oembed_add_host_js' );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );
remove_action( 'wp_head', 'feed_links_extra', 3 );

// SVG Logo Größe fix
add_filter( 'get_custom_logo', function( $html ) {
	return str_replace(
		'class="custom-logo"',
		'class="custom-logo" width="240" height="51"',
		$html
	);
} );

// GiveWP Formular ID
add_filter( 'fjdf_give_form_id', function() {
	return 51;
} );

/**
 * width/height Attribute vom Hero-Hintergrundbild entfernen
 */
add_filter( 'wp_get_attachment_image_attributes', function( $attr, $attachment, $size ) {
	if ( isset( $attr['class'] ) && strpos( $attr['class'], 'hero__bg-img' ) !== false ) {
		unset( $attr['width'], $attr['height'] );
	}
	return $attr;
}, 10, 3 );
