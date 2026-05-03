<?php
/**
 * FJDF — ACF Field Group: What we do page (page-what-we-do.php)
 *
 * Sections:
 *  1. Hero
 *  2. Impact tabs (Individual / Educational / Family)
 *  3. Additional statistics
 *  4. Testimonial
 *  5. Contribution items
 *
 * @package fjdf
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'acf_add_local_field_group' ) ) {
	return;
}

acf_add_local_field_group( [
	'key'    => 'group_fjdf_what_we_do',
	'title'  => __( 'FJDF: Was-wir-tun-Sektionen', 'fjdf' ),
	'fields' => [

		// =====================================================================
		// TAB: Hero
		// =====================================================================
		[ 'key' => 'field_fjdf_what_tab_hero', 'label' => __( 'Hero', 'fjdf' ), 'type' => 'tab' ],
		[
			'key' => 'field_fjdf_what_hero_image', 'label' => __( 'Hero Bild', 'fjdf' ),
			'name' => 'fjdf_what_hero_image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'large',
		],
		[
			'key' => 'field_fjdf_what_hero_headline', 'label' => __( 'Headline', 'fjdf' ),
			'name' => 'fjdf_what_hero_headline', 'type' => 'text',
			'default_value' => __( 'Wir verändern Leben durch Musik', 'fjdf' ),
		],
		[
			'key' => 'field_fjdf_what_hero_subtext', 'label' => __( 'Subtext', 'fjdf' ),
			'name' => 'fjdf_what_hero_subtext', 'type' => 'textarea', 'rows' => 3,
			'default_value' => __( 'Wir verbinden Solidarität, Talent und Chancen: von Österreich zu tausenden von Jugendlichen in Peru.', 'fjdf' ),
		],

		// =====================================================================
		// TAB: Impact tabs
		// =====================================================================
		[ 'key' => 'field_fjdf_what_tab_impact', 'label' => __( 'Impact Tabs', 'fjdf' ), 'type' => 'tab' ],
		[
			'key' => 'field_fjdf_what_impact_label', 'label' => __( 'Abschnitts-Label', 'fjdf' ),
			'name' => 'fjdf_what_impact_label', 'type' => 'text',
			'default_value' => __( 'WAS WIR TUN', 'fjdf' ),
		],
		[
			'key' => 'field_fjdf_what_impact_headline', 'label' => __( 'Headline', 'fjdf' ),
			'name' => 'fjdf_what_impact_headline', 'type' => 'text',
			'default_value' => __( 'Unser Einfluss – ihre neuen Möglichkeiten', 'fjdf' ),
		],
		[
			'key' => 'field_fjdf_what_impact_intro', 'label' => __( 'Einleitungstext', 'fjdf' ),
			'name' => 'fjdf_what_impact_intro', 'type' => 'textarea', 'rows' => 3,
			'default_value' => __( 'Mit der Unterstützung von österreichischen Spendern haben über 30.000 Kinder und Jugendliche in Peru Zugang zu kostenlosem Musikunterricht.', 'fjdf' ),
		],
		[
			'key' => 'field_fjdf_what_tabs', 'label' => __( 'Impact Tabs (max. 3)', 'fjdf' ),
			'name' => 'fjdf_what_tabs', 'type' => 'repeater', 'max' => 3, 'layout' => 'block',
			'button_label' => __( 'Tab hinzufügen', 'fjdf' ),
			'sub_fields' => [
				[
					'key' => 'field_fjdf_what_tab_title', 'label' => __( 'Tab-Titel', 'fjdf' ),
					'name' => 'title', 'type' => 'text',
					'instructions' => __( 'z.B. Persönlich, Bildung, Familie', 'fjdf' ),
				],
				[
					'key' => 'field_fjdf_what_tab_stats', 'label' => __( 'Stats in diesem Tab (max. 4)', 'fjdf' ),
					'name' => 'stats', 'type' => 'repeater', 'max' => 4, 'layout' => 'table',
					'button_label' => __( 'Stat hinzufügen', 'fjdf' ),
					'sub_fields' => [
						[ 'key' => 'field_fjdf_what_tab_stat_value', 'label' => __( 'Wert', 'fjdf' ), 'name' => 'value', 'type' => 'text', 'instructions' => __( 'z.B. +90%', 'fjdf' ) ],
						[ 'key' => 'field_fjdf_what_tab_stat_text', 'label' => __( 'Beschreibung', 'fjdf' ), 'name' => 'text', 'type' => 'textarea', 'rows' => 2 ],
					],
				],
			],
		],

		// =====================================================================
		// TAB: Testimonial
		// =====================================================================
		[ 'key' => 'field_fjdf_what_tab_testimonial', 'label' => __( 'Testimonial', 'fjdf' ), 'type' => 'tab' ],
		[
			'key' => 'field_fjdf_what_test_label', 'label' => __( 'Abschnitts-Label', 'fjdf' ),
			'name' => 'fjdf_what_test_label', 'type' => 'text',
			'default_value' => __( 'ZEUGNIS', 'fjdf' ),
		],
		[
			'key' => 'field_fjdf_what_test_image', 'label' => __( 'Portrait', 'fjdf' ),
			'name' => 'fjdf_what_test_image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail',
		],
		[
			'key' => 'field_fjdf_what_test_quote', 'label' => __( 'Zitat', 'fjdf' ),
			'name' => 'fjdf_what_test_quote', 'type' => 'textarea', 'rows' => 5,
			'default_value' => __( 'Bevor ich zu Sinfonía kam, fiel es mir schwer, mit anderen zu reden, und ich wusste nicht, was ich mit meinem Leben anfangen wollte. Jetzt spiele ich Geige, habe Freunde und träume davon, Musik an der Universität zu studieren.', 'fjdf' ),
		],
		[
			'key' => 'field_fjdf_what_test_name', 'label' => __( 'Name', 'fjdf' ),
			'name' => 'fjdf_what_test_name', 'type' => 'text',
			'default_value' => 'Lucía Campos, 16 Jahre',
		],
		[
			'key' => 'field_fjdf_what_test_origin', 'label' => __( 'Herkunft / Musikzentrum', 'fjdf' ),
			'name' => 'fjdf_what_test_origin', 'type' => 'text',
			'default_value' => __( 'Begünstigte des Núcleo Cusco', 'fjdf' ),
		],
		[
			'key' => 'field_fjdf_what_test_cta_label', 'label' => __( 'CTA Button-Text', 'fjdf' ),
			'name' => 'fjdf_what_test_cta_label', 'type' => 'text',
			'default_value' => __( 'Jetzt spenden', 'fjdf' ),
		],
		[ 'key' => 'field_fjdf_what_test_cta_url', 'label' => __( 'CTA Button URL', 'fjdf' ), 'name' => 'fjdf_what_test_cta_url', 'type' => 'page_link' ],

		// =====================================================================
		// TAB: Contribution items
		// =====================================================================
		[ 'key' => 'field_fjdf_what_tab_contrib', 'label' => __( 'Beiträge / Wirkung', 'fjdf' ), 'type' => 'tab' ],
		[
			'key' => 'field_fjdf_what_contrib_label', 'label' => __( 'Abschnitts-Label', 'fjdf' ),
			'name' => 'fjdf_what_contrib_label', 'type' => 'text',
			'default_value' => __( 'IHRE SPENDE', 'fjdf' ),
		],
		[
			'key' => 'field_fjdf_what_contrib_headline', 'label' => __( 'Headline', 'fjdf' ),
			'name' => 'fjdf_what_contrib_headline', 'type' => 'text',
			'default_value' => __( 'Mit Ihrer solidarischen Spende tragen Sie bei zu:', 'fjdf' ),
		],
		[
			'key' => 'field_fjdf_what_contrib_items', 'label' => __( 'Beiträge (max. 3)', 'fjdf' ),
			'name' => 'fjdf_what_contrib_items', 'type' => 'repeater', 'max' => 3, 'layout' => 'block',
			'button_label' => __( 'Beitrag hinzufügen', 'fjdf' ),
			'sub_fields' => [
				[ 'key' => 'field_fjdf_what_contrib_image', 'label' => __( 'Bild', 'fjdf' ), 'name' => 'image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail' ],
				[ 'key' => 'field_fjdf_what_contrib_text', 'label' => __( 'Text', 'fjdf' ), 'name' => 'text', 'type' => 'text' ],
			],
		],

	],
	'location' => [
		[ [ 'param' => 'page_template', 'operator' => '==', 'value' => 'page-what-we-do.php' ] ],
	],
	'menu_order' => 0, 'position' => 'normal',
	'label_placement' => 'top', 'instruction_placement' => 'label',
] );
