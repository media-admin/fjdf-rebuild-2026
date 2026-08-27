<?php
/**
 * FJDF — Newsletter Signup via FluentCRM
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'wp_ajax_fjdf_newsletter_subscribe',        'fjdf_ajax_newsletter_subscribe' );
add_action( 'wp_ajax_nopriv_fjdf_newsletter_subscribe', 'fjdf_ajax_newsletter_subscribe' );

/**
 * Liefert die FluentCRM-Listen-ID passend zur aktuellen Polylang-Sprache.
 */
function fjdf_newsletter_list_id_for_language(): int {
    $lang = function_exists( 'pll_current_language' ) ? pll_current_language() : 'de';

    $map = [
        'de' => 1,
        'en' => 2,
        'es' => 3,
    ];

    return $map[ $lang ] ?? $map['de'];
}

function fjdf_ajax_newsletter_subscribe(): void {
    check_ajax_referer( 'fjdf_newsletter', 'fjdf_newsletter_nonce' );

    $email   = sanitize_email( $_POST['email'] ?? '' );
    $consent = isset( $_POST['consent'] ) && $_POST['consent'] === 'on';

    if ( ! is_email( $email ) ) {
        wp_send_json_error( [ 'message' => __( 'Bitte eine gültige E-Mail-Adresse eingeben.', 'fjdf' ) ] );
    }

    if ( ! $consent ) {
        wp_send_json_error( [ 'message' => __( 'Bitte stimme der Datenschutzerklärung zu.', 'fjdf' ) ] );
    }

    if ( ! function_exists( 'FluentCrmApi' ) ) {
        wp_send_json_error( [ 'message' => __( 'Newsletter-Dienst derzeit nicht verfügbar.', 'fjdf' ) ] );
    }

    $contactApi = FluentCrmApi( 'contacts' );

    $contact = $contactApi->createOrUpdate( [
        'email'  => $email,
        'status' => 'pending', // triggert Double-Opt-in-Mail, wenn global aktiviert
        'lists'  => [ fjdf_newsletter_list_id_for_language() ],
        'source' => 'Website Newsletter Form',
    ] );

    if ( is_wp_error( $contact ) ) {
        wp_send_json_error( [ 'message' => __( 'Etwas ist schiefgelaufen. Bitte später erneut versuchen.', 'fjdf' ) ] );
    }

    wp_send_json_success( [
        'message' => __( 'Fast geschafft! Bitte bestätige deine Anmeldung über den Link in der E-Mail.', 'fjdf' ),
    ] );
}