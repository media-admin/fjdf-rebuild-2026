<?php
/**
 * FJDF — ACF Field Group: Donation page (page-donate.php)
 *
 * Sections:
 *  1. Header
 *  2. Step 1 — Amount
 *  3. Step 2 — Payment method
 *  4. Step 3 — Personal details
 *  5. Certificate section
 *
 * @package fjdf
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'acf_add_local_field_group' ) ) {
	return;
}

acf_add_local_field_group( [
	'key'    => 'group_fjdf_donate',
	'title'  => __( 'FJDF: Spenden-Sektionen', 'fjdf' ),
	'fields' => [

		// =====================================================================
		// TAB: Header
		// =====================================================================
		[ 'key' => 'field_fjdf_donate_tab_header', 'label' => __( 'Kopfbereich', 'fjdf' ), 'type' => 'tab' ],
		[
			'key' => 'field_fjdf_donate_hero_image', 'label' => __( 'Split-Bild (linke Seite Desktop)', 'fjdf' ),
			'name' => 'fjdf_donate_hero_image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium',
			'instructions' => __( 'Hochformat empfohlen. Bildgröße: fjdf-donation-split.', 'fjdf' ),
		],
		[
			'key' => 'field_fjdf_donate_headline', 'label' => __( 'Headline', 'fjdf' ),
			'name' => 'fjdf_donate_headline', 'type' => 'text',
			'default_value' => __( 'Spenden und mitmachen', 'fjdf' ),
		],
		[
			'key' => 'field_fjdf_donate_subtext', 'label' => __( 'Untertext', 'fjdf' ),
			'name' => 'fjdf_donate_subtext', 'type' => 'textarea', 'rows' => 3,
			'default_value' => __( 'Wenn Menschen wie Sie spenden, werden die Leben tausender Kinder und Jugendlicher verändert und ihre Zukunft strahlender.', 'fjdf' ),
		],
		[
			'key' => 'field_fjdf_donate_cert_link_label', 'label' => __( 'Spendennachweis Link-Text', 'fjdf' ),
			'name' => 'fjdf_donate_cert_link_label', 'type' => 'text',
			'default_value' => __( 'Fordern Sie Ihr Spendennachweis-Zertifikat an.', 'fjdf' ),
		],

		// =====================================================================
		// TAB: Step 1 — Amount
		// =====================================================================
		[ 'key' => 'field_fjdf_donate_tab_step1', 'label' => __( 'Schritt 1: Betrag', 'fjdf' ), 'type' => 'tab' ],
		[
			'key' => 'field_fjdf_donate_step1_label', 'label' => __( 'Schritt-Label', 'fjdf' ),
			'name' => 'fjdf_donate_step1_label', 'type' => 'text',
			'default_value' => __( 'Wählen Sie Ihren Spendenbetrag', 'fjdf' ),
		],
		[
			'key' => 'field_fjdf_donate_tab_once', 'label' => __( 'Tab: Einmalig', 'fjdf' ),
			'name' => 'fjdf_donate_tab_once', 'type' => 'text',
			'default_value' => __( 'Einmalig', 'fjdf' ),
		],
		[
			'key' => 'field_fjdf_donate_tab_monthly', 'label' => __( 'Tab: Monatlich', 'fjdf' ),
			'name' => 'fjdf_donate_tab_monthly', 'type' => 'text',
			'default_value' => __( 'Monatlich', 'fjdf' ),
		],
		[
			'key' => 'field_fjdf_donate_amounts_once', 'label' => __( 'Einmalige Beträge (EUR)', 'fjdf' ),
			'name' => 'fjdf_donate_amounts_once', 'type' => 'repeater', 'layout' => 'table',
			'button_label' => __( 'Betrag hinzufügen', 'fjdf' ),
			'sub_fields' => [
				[ 'key' => 'field_fjdf_donate_amount_once', 'label' => 'EUR', 'name' => 'amount', 'type' => 'number', 'min' => 1 ],
			],
		],
		[
			'key' => 'field_fjdf_donate_amounts_monthly', 'label' => __( 'Monatliche Beträge (EUR)', 'fjdf' ),
			'name' => 'fjdf_donate_amounts_monthly', 'type' => 'repeater', 'layout' => 'table',
			'button_label' => __( 'Betrag hinzufügen', 'fjdf' ),
			'sub_fields' => [
				[ 'key' => 'field_fjdf_donate_amount_monthly', 'label' => 'EUR', 'name' => 'amount', 'type' => 'number', 'min' => 1 ],
			],
		],
		[
			'key' => 'field_fjdf_donate_custom_label', 'label' => __( 'Individueller Betrag Placeholder', 'fjdf' ),
			'name' => 'fjdf_donate_custom_label', 'type' => 'text',
			'default_value' => __( 'Individueller Betrag', 'fjdf' ),
		],

		// =====================================================================
		// TAB: Step 2 — Payment method
		// =====================================================================
		[ 'key' => 'field_fjdf_donate_tab_step2', 'label' => __( 'Schritt 2: Zahlungsmethode', 'fjdf' ), 'type' => 'tab' ],
		[
			'key' => 'field_fjdf_donate_step2_label', 'label' => __( 'Schritt-Label', 'fjdf' ),
			'name' => 'fjdf_donate_step2_label', 'type' => 'text',
			'default_value' => __( 'Wählen Sie eine Zahlungsmethode', 'fjdf' ),
		],
		[
			'key' => 'field_fjdf_donate_payment_stripe', 'label' => __( 'Stripe anzeigen', 'fjdf' ),
			'name' => 'fjdf_donate_payment_stripe', 'type' => 'true_false', 'default_value' => 1, 'ui' => 1,
		],
		[
			'key' => 'field_fjdf_donate_payment_paypal', 'label' => __( 'PayPal anzeigen', 'fjdf' ),
			'name' => 'fjdf_donate_payment_paypal', 'type' => 'true_false', 'default_value' => 1, 'ui' => 1,
		],
		[
			'key' => 'field_fjdf_donate_payment_eps', 'label' => __( 'EPS anzeigen', 'fjdf' ),
			'name' => 'fjdf_donate_payment_eps', 'type' => 'true_false', 'default_value' => 1, 'ui' => 1,
		],

				[
			'key' => 'field_fjdf_donate_payment_klarna', 'label' => __( 'Klarna anzeigen', 'fjdf' ),
			'name' => 'fjdf_donate_payment_klarna', 'type' => 'true_false', 'default_value' => 1, 'ui' => 1,
		],
		// =====================================================================
		// TAB: Step 3 — Personal details
		// =====================================================================
		[ 'key' => 'field_fjdf_donate_tab_step3', 'label' => __( 'Schritt 3: Angaben', 'fjdf' ), 'type' => 'tab' ],
		[
			'key' => 'field_fjdf_donate_step3_label', 'label' => __( 'Schritt-Label', 'fjdf' ),
			'name' => 'fjdf_donate_step3_label', 'type' => 'text',
			'default_value' => __( 'Ihre Angaben', 'fjdf' ),
		],
		[
			'key' => 'field_fjdf_donate_field_firstname', 'label' => __( 'Vorname Placeholder', 'fjdf' ),
			'name' => 'fjdf_donate_field_firstname', 'type' => 'text',
			'default_value' => __( 'Vorname(n)', 'fjdf' ),
		],
		[
			'key' => 'field_fjdf_donate_field_lastname', 'label' => __( 'Nachname Placeholder', 'fjdf' ),
			'name' => 'fjdf_donate_field_lastname', 'type' => 'text',
			'default_value' => __( 'Nachname(n)', 'fjdf' ),
		],
		[
			'key' => 'field_fjdf_donate_field_email', 'label' => __( 'E-Mail Placeholder', 'fjdf' ),
			'name' => 'fjdf_donate_field_email', 'type' => 'text',
			'default_value' => __( 'E-Mail-Adresse', 'fjdf' ),
		],
		[
			'key' => 'field_fjdf_donate_terms_label', 'label' => __( 'AGB Checkbox-Text', 'fjdf' ),
			'name' => 'fjdf_donate_terms_label', 'type' => 'text',
			'default_value' => __( 'Ja, ich akzeptiere die Nutzungsbedingungen', 'fjdf' ),
		],
		[
			'key' => 'field_fjdf_donate_anon_label', 'label' => __( 'Anonyme Spende Checkbox-Text', 'fjdf' ),
			'name' => 'fjdf_donate_anon_label', 'type' => 'text',
			'default_value' => __( 'Anonyme Spende', 'fjdf' ),
		],
		[
			'key' => 'field_fjdf_donate_submit_label', 'label' => __( 'Absenden Button-Text', 'fjdf' ),
			'name' => 'fjdf_donate_submit_label', 'type' => 'text',
			'default_value' => __( 'Jetzt spenden', 'fjdf' ),
		],

		// =====================================================================
		// TAB: Certificate section
		// =====================================================================
		[ 'key' => 'field_fjdf_donate_tab_cert', 'label' => __( 'Spendennachweis-Sektion', 'fjdf' ), 'type' => 'tab' ],
		[
			'key' => 'field_fjdf_donate_cert_headline', 'label' => __( 'Headline', 'fjdf' ),
			'name' => 'fjdf_donate_cert_headline', 'type' => 'text',
			'default_value' => __( 'Erhalten Sie Ihren Spendennachweis', 'fjdf' ),
		],
		[
			'key' => 'field_fjdf_donate_cert_subtext', 'label' => __( 'Untertext', 'fjdf' ),
			'name' => 'fjdf_donate_cert_subtext', 'type' => 'textarea', 'rows' => 2,
			'default_value' => __( 'Fordern Sie ihn einfach an, um Steuern in Österreich abzuziehen und Ihren Beitrag zu belegen.', 'fjdf' ),
		],
		[
			'key' => 'field_fjdf_donate_cert_button', 'label' => __( 'Button-Text', 'fjdf' ),
			'name' => 'fjdf_donate_cert_button', 'type' => 'text',
			'default_value' => __( 'Spendennachweis anfordern', 'fjdf' ),
		],
		[
			'key' => 'field_fjdf_donate_cert_image', 'label' => __( 'Modal Bild', 'fjdf' ),
			'name' => 'fjdf_donate_cert_image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium',
			'instructions' => __( 'Bild links im Zertifikats-Modal (nur Desktop).', 'fjdf' ),
		],

	],
	'location' => [
		[ [ 'param' => 'page_template', 'operator' => '==', 'value' => 'page-donate.php' ] ],
	],
	'menu_order' => 0, 'position' => 'normal',
	'label_placement' => 'top', 'instruction_placement' => 'label',
] );
