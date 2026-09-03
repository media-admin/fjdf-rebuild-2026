<?php
/**
 * FJDF – Polylang-bewusste Weiterleitung zur GiveWP-Erfolgsseite
 *
 * Ermittelt die Sprache anhand des Spendenformulars (nicht anhand von
 * pll_current_language(), das im AJAX-Kontext der Zahlungsabwicklung
 * unzuverlässig ist) und leitet auf die passende Sprachversion der
 * GiveWP-Erfolgsseite weiter.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class FJDF_GiveWP_Polylang_Redirect {

	/** @var int|null Formular-ID, zwischengespeichert für den aktuellen Request */
	private static $current_form_id = null;

	public static function init() {
		add_action( 'give_complete_donation', array( __CLASS__, 'remember_form_id' ), 1 );
		add_filter( 'give_get_success_page_uri', array( __CLASS__, 'localize_redirect' ), 20 );
	}

	public static function remember_form_id( $payment_id ) {
		self::$current_form_id = give_get_payment_form_id( $payment_id );
	}

	public static function localize_redirect( $uri ) {
		if ( ! function_exists( 'pll_get_post_language' ) || ! function_exists( 'pll_get_post' ) ) {
			return $uri;
		}

		if ( empty( self::$current_form_id ) ) {
			error_log( 'FJDF Redirect Debug: kein Formular-Kontext vorhanden' );
			return $uri;
		}

		$form_lang = pll_get_post_language( self::$current_form_id, 'slug' );

		error_log( sprintf(
			'FJDF Redirect Debug: uri=%s | form_id=%d | form_lang=%s',
			$uri,
			self::$current_form_id,
			$form_lang
		) );

		if ( ! $form_lang ) {
			return $uri;
		}

		$success_page_id = (int) give_get_option( 'success_page' );

		if ( ! $success_page_id ) {
			return $uri;
		}

		$translated_id = pll_get_post( $success_page_id, $form_lang );

		error_log( sprintf( 'FJDF Redirect Debug: translated_id=%s', var_export( $translated_id, true ) ) );

		if ( ! $translated_id || $translated_id === $success_page_id ) {
			return $uri;
		}

		$translated_permalink = get_permalink( $translated_id );
		$query                = wp_parse_url( $uri, PHP_URL_QUERY );
		$final_uri             = $query ? $translated_permalink . '?' . $query : $translated_permalink;

		error_log( sprintf( 'FJDF Redirect Debug: final_uri=%s', $final_uri ) );

		return $final_uri;
	}
}

FJDF_GiveWP_Polylang_Redirect::init();