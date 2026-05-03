<?php
/**
 * FJDF — ACF Field Group: About page (page-about.php)
 *
 * Sections:
 *  1. Hero
 *  2. Intro text
 *  3. Gallery
 *  4. History / Timeline text
 *  5. Partners
 *
 * @package fjdf
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'acf_add_local_field_group' ) ) {
	return;
}

acf_add_local_field_group( [
	'key'    => 'group_fjdf_about',
	'title'  => __( 'FJDF: Über-uns-Sektionen', 'fjdf' ),
	'fields' => [

		// =====================================================================
		// TAB: Hero
		// =====================================================================
		[ 'key' => 'field_fjdf_about_tab_hero', 'label' => __( 'Hero', 'fjdf' ), 'type' => 'tab' ],
		[
			'key' => 'field_fjdf_about_hero_image', 'label' => __( 'Hero Bild', 'fjdf' ),
			'name' => 'fjdf_about_hero_image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'large',
			'instructions' => __( 'Grosses Gruppenbild — füllt die volle Breite.', 'fjdf' ),
		],
		[
			'key' => 'field_fjdf_about_hero_headline', 'label' => __( 'Headline', 'fjdf' ),
			'name' => 'fjdf_about_hero_headline', 'type' => 'text',
			'default_value' => __( 'Eine solidarische Brücke zwischen Österreich und Peru', 'fjdf' ),
		],
		[
			'key' => 'field_fjdf_about_hero_subtext', 'label' => __( 'Subtext', 'fjdf' ),
			'name' => 'fjdf_about_hero_subtext', 'type' => 'textarea', 'rows' => 3,
			'default_value' => __( 'Von Österreich aus unterstützen wir Sinfonía por el Perú, indem wir solidarische Spenden fördern, die die Entwicklung von Kindern und Jugendlichen durch kostenlosen Musikunterricht vorantreiben.', 'fjdf' ),
		],

		// =====================================================================
		// TAB: Intro text
		// =====================================================================
		[ 'key' => 'field_fjdf_about_tab_intro', 'label' => __( 'Intro-Text', 'fjdf' ), 'type' => 'tab' ],
		[
			'key' => 'field_fjdf_about_intro', 'label' => __( 'Einleitungstext', 'fjdf' ),
			'name' => 'fjdf_about_intro', 'type' => 'wysiwyg', 'tabs' => 'visual', 'toolbar' => 'basic', 'media_upload' => 0,
			'instructions' => __( 'Beschreibung der Juan Diego Flórez Association.', 'fjdf' ),
		],
		[
			'key' => 'field_fjdf_about_bridge_text', 'label' => __( 'Highlight-Satz (goldene Hervorhebung)', 'fjdf' ),
			'name' => 'fjdf_about_bridge_text', 'type' => 'text',
			'default_value' => __( 'Wir verbinden Solidarität, Talent und Chancen: von Österreich zu tausenden von Jugendlichen in Peru.', 'fjdf' ),
			'instructions' => __( 'Wird als goldener Infotext hervorgehoben angezeigt.', 'fjdf' ),
		],

		// =====================================================================
		// TAB: Gallery
		// =====================================================================
		[ 'key' => 'field_fjdf_about_tab_gallery', 'label' => __( 'Galerie', 'fjdf' ), 'type' => 'tab' ],
		[
			'key' => 'field_fjdf_about_gallery', 'label' => __( 'Bilder (Empfehlung: 6 Fotos)', 'fjdf' ),
			'name' => 'fjdf_about_gallery', 'type' => 'gallery', 'return_format' => 'array', 'preview_size' => 'medium',
			'instructions' => __( 'Bilder erscheinen als großes Hauptbild mit Thumbnail-Leiste darunter.', 'fjdf' ),
		],

		// =====================================================================
		// TAB: History
		// =====================================================================
		[ 'key' => 'field_fjdf_about_tab_history', 'label' => __( 'Geschichte', 'fjdf' ), 'type' => 'tab' ],
		[
			'key' => 'field_fjdf_about_history_label', 'label' => __( 'Label', 'fjdf' ),
			'name' => 'fjdf_about_history_label', 'type' => 'text',
			'default_value' => __( 'Seit 2023 mobilisieren wir Solidarität, um Leben durch Musik zu verändern', 'fjdf' ),
		],
		[
			'key' => 'field_fjdf_about_history_text', 'label' => __( 'Text', 'fjdf' ),
			'name' => 'fjdf_about_history_text', 'type' => 'wysiwyg', 'tabs' => 'visual', 'toolbar' => 'basic', 'media_upload' => 0,
		],

	],
	'location' => [
		[ [ 'param' => 'page_template', 'operator' => '==', 'value' => 'page-about.php' ] ],
	],
	'menu_order' => 0, 'position' => 'normal',
	'label_placement' => 'top', 'instruction_placement' => 'label',
] );
