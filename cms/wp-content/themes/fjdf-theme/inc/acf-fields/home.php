<?php
/**
 * FJDF — ACF Field Group: Homepage (front-page.php)
 *
 * Sections:
 *  1. Hero
 *  2. Stats bar (3 key figures)
 *  3. About teaser
 *  4. What we do teaser
 *  5. Impact stats (4 percentages)
 *  6. Testimonial / Beneficiary
 *  7. Donation CTA block
 *  8. News preview settings
 *
 * @package fjdf
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'acf_add_local_field_group' ) ) {
	return;
}

acf_add_local_field_group( [
	'key'    => 'group_fjdf_home',
	'title'  => __( 'FJDF: Homepage-Sektionen', 'fjdf' ),
	'fields' => [

		// =====================================================================
		// TAB: Hero
		// =====================================================================
		[ 'key' => 'field_fjdf_home_tab_hero', 'label' => __( 'Hero', 'fjdf' ), 'type' => 'tab' ],
		[
			'key' => 'field_fjdf_hero_image', 'label' => __( 'Hero Hintergrundbild', 'fjdf' ),
			'name' => 'fjdf_hero_image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'large',
			'instructions' => __( 'Empfohlen: min. 1920×1080px. Bildgröße: fjdf-hero.', 'fjdf' ),
		],
		[
			'key' => 'field_fjdf_hero_headline', 'label' => __( 'Headline', 'fjdf' ),
			'name' => 'fjdf_hero_headline', 'type' => 'text',
			'default_value' => __( 'Lass Musik Leben verändern', 'fjdf' ),
			'instructions'  => __( 'Große Überschrift im Hero. HTML erlaubt für Zeilenumbrüche.', 'fjdf' ),
		],
		[
			'key' => 'field_fjdf_hero_subtext', 'label' => __( 'Subtext', 'fjdf' ),
			'name' => 'fjdf_hero_subtext', 'type' => 'textarea', 'rows' => 3,
			'default_value' => __( 'Deine Spende ermöglicht kostenlosen Musikunterricht für Kinder in Notlagen und öffnet ihnen einen Weg zu Hoffnung und Entwicklung.', 'fjdf' ),
		],
		[
			'key' => 'field_fjdf_hero_cta_label', 'label' => __( 'CTA Button-Text', 'fjdf' ),
			'name' => 'fjdf_hero_cta_label', 'type' => 'text',
			'default_value' => __( 'Jetzt spenden', 'fjdf' ),
		],
		[ 'key' => 'field_fjdf_hero_cta_url', 'label' => __( 'CTA Button URL', 'fjdf' ), 'name' => 'fjdf_hero_cta_url', 'type' => 'url' ],
		[
			'key' => 'field_fjdf_hero_scroll_label', 'label' => __( 'Scroll-Hinweis Text', 'fjdf' ),
			'name' => 'fjdf_hero_scroll_label', 'type' => 'text',
			'default_value' => __( 'Scrollen', 'fjdf' ),
		],

		// =====================================================================
		// TAB: Stats bar
		// =====================================================================
		[ 'key' => 'field_fjdf_home_tab_stats', 'label' => __( 'Kennzahlen-Leiste', 'fjdf' ), 'type' => 'tab' ],
		[
			'key' => 'field_fjdf_stats_bar', 'label' => __( 'Kennzahlen (max. 3)', 'fjdf' ),
			'name' => 'fjdf_stats_bar', 'type' => 'repeater', 'min' => 1, 'max' => 3, 'layout' => 'table',
			'button_label' => __( 'Kennzahl hinzufügen', 'fjdf' ),
			'sub_fields' => [
				[ 'key' => 'field_fjdf_stat_number', 'label' => __( 'Zahl / Wert', 'fjdf' ), 'name' => 'number', 'type' => 'text', 'instructions' => __( 'z.B. + 1.400', 'fjdf' ) ],
				[ 'key' => 'field_fjdf_stat_label', 'label' => __( 'Beschreibung', 'fjdf' ), 'name' => 'label', 'type' => 'textarea', 'rows' => 2 ],
				[ 'key' => 'field_fjdf_stat_icon', 'label' => __( 'Icon (optional)', 'fjdf' ), 'name' => 'icon', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail' ],
			],
		],

		// =====================================================================
		// TAB: About teaser
		// =====================================================================
		[ 'key' => 'field_fjdf_home_tab_about', 'label' => __( 'Über uns – Teaser', 'fjdf' ), 'type' => 'tab' ],
		[
			'key' => 'field_fjdf_about_label', 'label' => __( 'Abschnitts-Label', 'fjdf' ),
			'name' => 'fjdf_about_label', 'type' => 'text',
			'default_value' => __( 'ÜBER UNS', 'fjdf' ),
		],
		[
			'key' => 'field_fjdf_about_headline', 'label' => __( 'Headline', 'fjdf' ),
			'name' => 'fjdf_about_headline', 'type' => 'text',
			'default_value' => __( 'Partner für Wandel durch Musik', 'fjdf' ),
		],
		[
			'key' => 'field_fjdf_about_text', 'label' => __( 'Text', 'fjdf' ),
			'name' => 'fjdf_about_text', 'type' => 'textarea', 'rows' => 4,
			'default_value' => __( 'Von Österreich aus unterstützen wir Sinfonía por el Perú, indem wir solidarische Spenden fördern, die die Entwicklung von Kindern und Jugendlichen durch kostenlosen Musikunterricht vorantreiben.', 'fjdf' ),
		],
		[
			'key' => 'field_fjdf_about_cta_label', 'label' => __( 'CTA Button-Text', 'fjdf' ),
			'name' => 'fjdf_about_cta_label', 'type' => 'text',
			'default_value' => __( 'Mehr erfahren', 'fjdf' ),
		],
		[ 'key' => 'field_fjdf_about_cta_url', 'label' => __( 'CTA Button URL', 'fjdf' ), 'name' => 'fjdf_about_cta_url', 'type' => 'url' ],
		[ 'key' => 'field_fjdf_about_image', 'label' => __( 'Bild', 'fjdf' ), 'name' => 'fjdf_about_image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium' ],

		// =====================================================================
		// TAB: What we do teaser
		// =====================================================================
		[ 'key' => 'field_fjdf_home_tab_what', 'label' => __( 'Was wir tun – Teaser', 'fjdf' ), 'type' => 'tab' ],
		[
			'key' => 'field_fjdf_what_label', 'label' => __( 'Abschnitts-Label', 'fjdf' ),
			'name' => 'fjdf_what_label', 'type' => 'text',
			'default_value' => __( 'WAS WIR TUN', 'fjdf' ),
		],
		[
			'key' => 'field_fjdf_what_headline', 'label' => __( 'Headline', 'fjdf' ),
			'name' => 'fjdf_what_headline', 'type' => 'text',
			'default_value' => __( 'Wir verändern Leben durch Musik', 'fjdf' ),
		],
		[ 'key' => 'field_fjdf_what_text', 'label' => __( 'Text', 'fjdf' ), 'name' => 'fjdf_what_text', 'type' => 'textarea', 'rows' => 4 ],
		[
			'key' => 'field_fjdf_what_cta_label', 'label' => __( 'CTA Button-Text', 'fjdf' ),
			'name' => 'fjdf_what_cta_label', 'type' => 'text',
			'default_value' => __( 'Unser Einfluss', 'fjdf' ),
		],
		[ 'key' => 'field_fjdf_what_cta_url', 'label' => __( 'CTA Button URL', 'fjdf' ), 'name' => 'fjdf_what_cta_url', 'type' => 'url' ],
		[ 'key' => 'field_fjdf_what_image', 'label' => __( 'Bild', 'fjdf' ), 'name' => 'fjdf_what_image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium' ],

		// =====================================================================
		// TAB: Impact Stats
		// =====================================================================
		[ 'key' => 'field_fjdf_home_tab_impact', 'label' => __( 'Impact Stats', 'fjdf' ), 'type' => 'tab' ],
		[
			'key' => 'field_fjdf_impact_label', 'label' => __( 'Abschnitts-Label', 'fjdf' ),
			'name' => 'fjdf_impact_label', 'type' => 'text',
			'default_value' => __( 'SOZIALER EINFLUSS', 'fjdf' ),
		],
		[
			'key' => 'field_fjdf_impact_headline', 'label' => __( 'Headline', 'fjdf' ),
			'name' => 'fjdf_impact_headline', 'type' => 'text',
			'default_value' => __( 'Unser Einfluss – ihre neuen Möglichkeiten', 'fjdf' ),
		],
		[
			'key' => 'field_fjdf_impact_subtext', 'label' => __( 'Subtext', 'fjdf' ),
			'name' => 'fjdf_impact_subtext', 'type' => 'textarea', 'rows' => 3,
			'default_value' => __( 'Mit der Unterstützung von österreichischen Spendern haben über 30.000 Kinder und Jugendliche in Peru Zugang zu kostenlosem Musikunterricht.', 'fjdf' ),
		],
		[
			'key' => 'field_fjdf_impact_portrait', 'label' => __( 'Portrait-Bild (links, alle Tabs)', 'fjdf' ),
			'name' => 'fjdf_impact_portrait', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium',
			'instructions' => __( 'Hochformat. Erscheint links neben den Stats. Bleibt beim Tab-Wechsel gleich.', 'fjdf' ),
		],
		[
			'key' => 'field_fjdf_impact_tab1_label', 'label' => __( 'Tab 1: Label', 'fjdf' ),
			'name' => 'fjdf_impact_tab1_label', 'type' => 'text',
			'default_value' => __( 'Persönlich', 'fjdf' ),
		],
		[
			'key' => 'field_fjdf_impact_stats_individual', 'label' => __( 'Tab 1: Stats – Persönlich (max. 4)', 'fjdf' ),
			'name' => 'fjdf_impact_stats_individual', 'type' => 'repeater', 'min' => 1, 'max' => 4, 'layout' => 'table',
			'button_label' => __( 'Stat hinzufügen', 'fjdf' ),
			'sub_fields' => [
				[ 'key' => 'field_fjdf_impact_ind_value', 'label' => __( 'Wert', 'fjdf' ), 'name' => 'value', 'type' => 'text', 'instructions' => __( 'z.B. +90%', 'fjdf' ) ],
				[ 'key' => 'field_fjdf_impact_ind_text',  'label' => __( 'Beschreibung', 'fjdf' ), 'name' => 'text', 'type' => 'textarea', 'rows' => 2 ],
			],
		],
		[
			'key' => 'field_fjdf_impact_tab2_label', 'label' => __( 'Tab 2: Label', 'fjdf' ),
			'name' => 'fjdf_impact_tab2_label', 'type' => 'text',
			'default_value' => __( 'Bildung', 'fjdf' ),
		],
		[
			'key' => 'field_fjdf_impact_stats_educational', 'label' => __( 'Tab 2: Stats – Bildung (max. 4)', 'fjdf' ),
			'name' => 'fjdf_impact_stats_educational', 'type' => 'repeater', 'min' => 1, 'max' => 4, 'layout' => 'table',
			'button_label' => __( 'Stat hinzufügen', 'fjdf' ),
			'sub_fields' => [
				[ 'key' => 'field_fjdf_impact_edu_value', 'label' => __( 'Wert', 'fjdf' ), 'name' => 'value', 'type' => 'text', 'instructions' => __( 'z.B. +29%', 'fjdf' ) ],
				[ 'key' => 'field_fjdf_impact_edu_text',  'label' => __( 'Beschreibung', 'fjdf' ), 'name' => 'text', 'type' => 'textarea', 'rows' => 2 ],
			],
		],
		[
			'key' => 'field_fjdf_impact_tab3_label', 'label' => __( 'Tab 3: Label', 'fjdf' ),
			'name' => 'fjdf_impact_tab3_label', 'type' => 'text',
			'default_value' => __( 'Familie', 'fjdf' ),
		],
		[
			'key' => 'field_fjdf_impact_stats_family', 'label' => __( 'Tab 3: Stats – Familie (max. 4)', 'fjdf' ),
			'name' => 'fjdf_impact_stats_family', 'type' => 'repeater', 'min' => 1, 'max' => 4, 'layout' => 'table',
			'button_label' => __( 'Stat hinzufügen', 'fjdf' ),
			'sub_fields' => [
				[ 'key' => 'field_fjdf_impact_fam_value', 'label' => __( 'Wert', 'fjdf' ), 'name' => 'value', 'type' => 'text', 'instructions' => __( 'z.B. -51%', 'fjdf' ) ],
				[ 'key' => 'field_fjdf_impact_fam_text',  'label' => __( 'Beschreibung', 'fjdf' ), 'name' => 'text', 'type' => 'textarea', 'rows' => 2 ],
			],
		],

		// =====================================================================
		// TAB: Testimonial
		// =====================================================================
		[ 'key' => 'field_fjdf_home_tab_testimonial', 'label' => __( 'Testimonial', 'fjdf' ), 'type' => 'tab' ],
		[
			'key' => 'field_fjdf_testimonial_label', 'label' => __( 'Abschnitts-Label', 'fjdf' ),
			'name' => 'fjdf_testimonial_label', 'type' => 'text',
			'default_value' => __( 'BEGÜNSTIGTE', 'fjdf' ),
		],
		[
			'key' => 'field_fjdf_testimonial_headline', 'label' => __( 'Headline', 'fjdf' ),
			'name' => 'fjdf_testimonial_headline', 'type' => 'text',
			'default_value' => __( 'Ein wichtiges Zeugnis', 'fjdf' ),
		],
		[
			'key'           => 'field_fjdf_testimonial_video_id',
			'label'         => __( 'YouTube Video-ID', 'fjdf' ),
			'name'          => 'fjdf_testimonial_video_id',
			'type'          => 'text',
			'instructions'  => __( 'Nur die Video-ID aus der YouTube-URL, z.B. 30lFwLSgJHo', 'fjdf' ),
			'default_value' => '30lFwLSgJHo',
		],
		[
			'key'           => 'field_fjdf_testimonial_video_thumb',
			'label'         => __( 'Video Vorschaubild (optional)', 'fjdf' ),
			'name'          => 'fjdf_testimonial_video_thumb',
			'type'          => 'image',
			'return_format' => 'array',
			'preview_size'  => 'large',
			'instructions'  => __( 'Empfohlen: 1920x600px. Überschreibt YouTube-Thumbnail.', 'fjdf' ),
		],
			[ 'key' => 'field_fjdf_testimonials', 'label' => __( 'Testimonials', 'fjdf' ),
			'name' => 'fjdf_testimonials', 'type' => 'repeater', 'layout' => 'row',
			'button_label' => __( 'Testimonial hinzufügen', 'fjdf' ),
			'sub_fields' => [
				[ 'key' => 'field_fjdf_testimonial_image', 'label' => __( 'Portrait', 'fjdf' ), 'name' => 'image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail' ],
				[ 'key' => 'field_fjdf_testimonial_quote', 'label' => __( 'Zitat', 'fjdf' ), 'name' => 'quote', 'type' => 'textarea', 'rows' => 4 ],
				[ 'key' => 'field_fjdf_testimonial_name', 'label' => __( 'Name', 'fjdf' ), 'name' => 'name', 'type' => 'text', 'instructions' => __( 'z.B. Lucía Campos, 16 Jahre', 'fjdf' ) ],
				[
					'key' => 'field_fjdf_testimonial_origin', 'label' => __( 'Herkunft / Musikzentrum', 'fjdf' ),
					'name' => 'origin', 'type' => 'text',
					'instructions' => __( 'z.B. Begünstigte des Núcleo Cusco', 'fjdf' ),
				],
			],
		],

		// =====================================================================
		// TAB: Donation CTA
		// =====================================================================
		[ 'key' => 'field_fjdf_home_tab_cta', 'label' => __( 'Spenden-CTA Block', 'fjdf' ), 'type' => 'tab' ],
		[
			'key' => 'field_fjdf_cta_headline', 'label' => __( 'Headline', 'fjdf' ),
			'name' => 'fjdf_cta_headline', 'type' => 'text',
			'default_value' => __( 'Spenden und mitmachen', 'fjdf' ),
		],
		[
			'key' => 'field_fjdf_cta_text', 'label' => __( 'Text', 'fjdf' ),
			'name' => 'fjdf_cta_text', 'type' => 'textarea', 'rows' => 3,
			'default_value' => __( 'Mit Ihrem Beitrag helfen Sie, das Leben von über 6.000 Kindern, Jugendlichen und jungen Erwachsenen in 10 Regionen Perus zu verändern.', 'fjdf' ),
		],
		[
			'key' => 'field_fjdf_cta_button_label', 'label' => __( 'Button-Text', 'fjdf' ),
			'name' => 'fjdf_cta_button_label', 'type' => 'text',
			'default_value' => __( 'Jetzt spenden', 'fjdf' ),
		],
		[ 'key' => 'field_fjdf_cta_button_url', 'label' => __( 'Button URL', 'fjdf' ), 'name' => 'fjdf_cta_button_url', 'type' => 'url' ],
		[
			'key' => 'field_fjdf_cta_note', 'label' => __( 'Hinweis-Text (Steuer / Kontakt)', 'fjdf' ),
			'name' => 'fjdf_cta_note', 'type' => 'wysiwyg', 'tabs' => 'text', 'toolbar' => 'basic', 'media_upload' => 0,
			'default_value' => __( 'Reduzieren Sie Ihre Steuern mit Ihrer Spende durch das Spendennachweis-Zertifikat, das wir Ihnen ausstellen.\n\nBei Problemen mit der Spende kontaktieren Sie uns unter: donaciones@sinfoniaporelperu.org', 'fjdf' ),
		],
		[ 'key' => 'field_fjdf_cta_image', 'label' => __( 'Bild', 'fjdf' ), 'name' => 'fjdf_cta_image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium' ],

	],
	'location' => [
		[ [ 'param' => 'page_type', 'operator' => '==', 'value' => 'front_page' ] ],
	],
	'menu_order' => 0, 'position' => 'normal',
	'label_placement' => 'top', 'instruction_placement' => 'label',
] );
