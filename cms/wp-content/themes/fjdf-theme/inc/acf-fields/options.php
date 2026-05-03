<?php
/**
 * FJDF — ACF Field Group: Global theme settings
 * Options page: /wp-admin/admin.php?page=fjdf-settings
 *
 * Fields:
 *  - Floating donate button
 *  - Social media links
 *  - Newsletter section
 *  - Footer
 *  - Partner logos
 *
 * @package fjdf
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'acf_add_local_field_group' ) ) {
	return;
}

acf_add_local_field_group( [
	'key'    => 'group_fjdf_options',
	'title'  => __( 'FJDF: Globale Einstellungen', 'fjdf' ),
	'fields' => [

		// =====================================================================
		// TAB: Floating Button
		// =====================================================================
		[
			'key'   => 'field_fjdf_tab_floating',
			'label' => __( 'Floating Button', 'fjdf' ),
			'type'  => 'tab',
		],
		[
			'key'           => 'field_fjdf_floating_label',
			'label'         => __( 'Button-Text', 'fjdf' ),
			'name'          => 'fjdf_floating_label',
			'type'          => 'text',
			'default_value' => __( 'Spenden', 'fjdf' ),
			'instructions'  => __( 'Vertikaler Text des schwebenden Buttons (rechts, alle Seiten).', 'fjdf' ),
		],
		[
			'key'          => 'field_fjdf_floating_url',
			'label'        => __( 'Button URL', 'fjdf' ),
			'name'         => 'fjdf_floating_url',
			'type'         => 'page_link',
			'instructions' => __( 'Verlinkung — normalerweise die Spenden-Seite.', 'fjdf' ),
		],
		[
			'key'           => 'field_fjdf_floating_active',
			'label'         => __( 'Button aktiv', 'fjdf' ),
			'name'          => 'fjdf_floating_active',
			'type'          => 'true_false',
			'default_value' => 1,
			'ui'            => 1,
			'ui_on_text'    => __( 'Ja', 'fjdf' ),
			'ui_off_text'   => __( 'Nein', 'fjdf' ),
		],
		[
			'key'           => 'field_fjdf_header_cta_label',
			'label'         => __( 'Header CTA Button-Text', 'fjdf' ),
			'name'          => 'fjdf_header_cta_label',
			'type'          => 'text',
			'default_value' => __( 'Jetzt spenden', 'fjdf' ),
			'instructions'  => __( 'Text des CTA-Buttons in der Hauptnavigation.', 'fjdf' ),
		],
		[
			'key'           => 'field_fjdf_footer_cta_label',
			'label'         => __( 'Footer CTA Button-Text', 'fjdf' ),
			'name'          => 'fjdf_footer_cta_label',
			'type'          => 'text',
			'default_value' => __( 'Jetzt spenden', 'fjdf' ),
			'instructions'  => __( 'Text des CTA-Buttons im Footer.', 'fjdf' ),
		],

		// =====================================================================
		// TAB: Social Media
		// =====================================================================
		[
			'key'   => 'field_fjdf_tab_social',
			'label' => __( 'Social Media', 'fjdf' ),
			'type'  => 'tab',
		],
		[
			'key'          => 'field_fjdf_social_facebook',
			'label'        => __( 'Facebook URL', 'fjdf' ),
			'name'         => 'fjdf_social_facebook',
			'type'         => 'url',
			'instructions' => __( 'Vollständige URL: https://facebook.com/…', 'fjdf' ),
		],
		[
			'key'          => 'field_fjdf_social_linkedin',
			'label'        => __( 'LinkedIn URL', 'fjdf' ),
			'name'         => 'fjdf_social_linkedin',
			'type'         => 'url',
			'instructions' => __( 'Vollständige URL: https://linkedin.com/…', 'fjdf' ),
		],
		[
			'key'   => 'field_fjdf_social_instagram',
			'label' => __( 'Instagram URL', 'fjdf' ),
			'name'  => 'fjdf_social_instagram',
			'type'  => 'url',
		],
		[
			'key'   => 'field_fjdf_social_youtube',
			'label' => __( 'YouTube URL', 'fjdf' ),
			'name'  => 'fjdf_social_youtube',
			'type'  => 'url',
		],

		// =====================================================================
		// TAB: Newsletter
		// =====================================================================
		[
			'key'   => 'field_fjdf_tab_newsletter',
			'label' => __( 'Newsletter-Sektion', 'fjdf' ),
			'type'  => 'tab',
		],
		[
			'key'           => 'field_fjdf_newsletter_headline',
			'label'         => __( 'Headline', 'fjdf' ),
			'name'          => 'fjdf_newsletter_headline',
			'type'          => 'text',
			'default_value' => __( 'Bleiben Sie nah am Wandel, den Sie bewirken', 'fjdf' ),
			'instructions'  => __( 'Große Überschrift der goldenen Newsletter-Sektion.', 'fjdf' ),
		],
		[
			'key'           => 'field_fjdf_newsletter_placeholder',
			'label'         => __( 'Input Placeholder', 'fjdf' ),
			'name'          => 'fjdf_newsletter_placeholder',
			'type'          => 'text',
			'default_value' => __( 'E-Mail-Adresse', 'fjdf' ),
		],
		[
			'key'           => 'field_fjdf_newsletter_button',
			'label'         => __( 'Button-Text', 'fjdf' ),
			'name'          => 'fjdf_newsletter_button',
			'type'          => 'text',
			'default_value' => __( 'Newsletter abonnieren', 'fjdf' ),
		],
		[
			'key'           => 'field_fjdf_newsletter_image',
			'label'         => __( 'Dekoratives Bild (rechts)', 'fjdf' ),
			'name'          => 'fjdf_newsletter_image',
			'type'          => 'image',
			'return_format' => 'array',
			'preview_size'  => 'medium',
			'instructions'  => __( 'Kind mit Instrument — erscheint rechts in der Newsletter-Sektion.', 'fjdf' ),
		],
		[
			'key'          => 'field_fjdf_newsletter_shortcode',
			'label'        => __( 'Newsletter Shortcode', 'fjdf' ),
			'name'         => 'fjdf_newsletter_shortcode',
			'type'         => 'text',
			'instructions' => __( 'Optional: Shortcode des Newsletter-Plugins, z.B. Mailchimp.', 'fjdf' ),
		],

		// =====================================================================
		// TAB: Footer
		// =====================================================================
		[
			'key'   => 'field_fjdf_tab_footer',
			'label' => __( 'Footer', 'fjdf' ),
			'type'  => 'tab',
		],
		[
			'key'           => 'field_fjdf_footer_logo',
			'label'         => __( 'Footer Logo', 'fjdf' ),
			'name'          => 'fjdf_footer_logo',
			'type'          => 'image',
			'return_format' => 'array',
			'preview_size'  => 'medium',
			'instructions'  => __( 'Logo für dunklen Hintergrund (helle Variante).', 'fjdf' ),
		],
		[
			'key'           => 'field_fjdf_footer_collab_label',
			'label'         => __( 'Kooperations-Label', 'fjdf' ),
			'name'          => 'fjdf_footer_collab_label',
			'type'          => 'text',
			'default_value' => __( 'Zusammenarbeit mit:', 'fjdf' ),
		],
		[
			'key'           => 'field_fjdf_footer_collab_logo',
			'label'         => __( 'Kooperations-Logo', 'fjdf' ),
			'name'          => 'fjdf_footer_collab_logo',
			'type'          => 'image',
			'return_format' => 'array',
			'preview_size'  => 'medium',
			'instructions'  => __( 'Logo von Sinfonía por el Perú.', 'fjdf' ),
		],
		[
			'key'           => 'field_fjdf_footer_copyright',
			'label'         => __( 'Copyright-Text', 'fjdf' ),
			'name'          => 'fjdf_footer_copyright',
			'type'          => 'text',
			'default_value' => __( 'Alle Rechte vorbehalten © {year}, Juan Diego Flórez Association.', 'fjdf' ),
			'instructions'  => __( '{year} wird automatisch durch das aktuelle Jahr ersetzt.', 'fjdf' ),
		],
		[
			'key'           => 'field_fjdf_footer_agency_credit',
			'label'         => __( 'Agentur Creditline anzeigen', 'fjdf' ),
			'name'          => 'fjdf_footer_agency_credit',
			'type'          => 'true_false',
			'default_value' => 1,
			'ui'            => 1,
		],

		// =====================================================================
		// TAB: Partner Logos
		// =====================================================================
		[
			'key'   => 'field_fjdf_tab_partners',
			'label' => __( 'Partner Logos', 'fjdf' ),
			'type'  => 'tab',
		],
		[
			'key'           => 'field_fjdf_partners_label',
			'label'         => __( 'Abschnitts-Label', 'fjdf' ),
			'name'          => 'fjdf_partners_label',
			'type'          => 'text',
			'default_value' => 'PARTNERS',
		],
		[
			'key'           => 'field_fjdf_partners_headline',
			'label'         => __( 'Abschnitts-Headline', 'fjdf' ),
			'name'          => 'fjdf_partners_headline',
			'type'          => 'text',
			'default_value' => __( 'Danke für Ihre Unterstützung', 'fjdf' ),
		],
		[
			'key'          => 'field_fjdf_partners',
			'label'        => __( 'Partner', 'fjdf' ),
			'name'         => 'fjdf_partners',
			'type'         => 'repeater',
			'layout'       => 'table',
			'button_label' => __( 'Partner hinzufügen', 'fjdf' ),
			'sub_fields'   => [
				[
					'key'           => 'field_fjdf_partner_logo',
					'label'         => __( 'Logo', 'fjdf' ),
					'name'          => 'logo',
					'type'          => 'image',
					'return_format' => 'array',
					'preview_size'  => 'thumbnail',
				],
				[
					'key'   => 'field_fjdf_partner_name',
					'label' => __( 'Name', 'fjdf' ),
					'name'  => 'name',
					'type'  => 'text',
				],
				[
					'key'   => 'field_fjdf_partner_url',
					'label' => __( 'Website URL', 'fjdf' ),
					'name'  => 'url',
					'type'  => 'url',
				],
			],
		],

	],
	'location' => [
		[
			[
				'param'    => 'options_page',
				'operator' => '==',
				'value'    => 'fjdf-settings',
			],
		],
	],
	'menu_order'            => 0,
	'position'              => 'normal',
	'label_placement'       => 'top',
	'instruction_placement' => 'label',
] );
