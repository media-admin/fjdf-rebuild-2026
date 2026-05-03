<?php
/**
 * FJDF — Template Functions
 * General helper functions for templates.
 *
 * @package fjdf
 */

defined( 'ABSPATH' ) || exit;


/**
 * Get ACF field safely (with function_exists guard)
 */
function fjdf_field( string $field_name, mixed $post_id = false, mixed $fallback = '' ): mixed {
	if ( ! function_exists( 'get_field' ) ) {
		return $fallback;
	}
	$value = get_field( $field_name, $post_id );
	return ! empty( $value ) ? $value : $fallback;
}

/**
 * Get ACF options page field safely
 */
function fjdf_option( string $field_name, mixed $fallback = '' ): mixed {
	return fjdf_field( $field_name, 'option', $fallback );
}

/**
 * Output ACF image (responsive, with srcset)
 */
function fjdf_image( array $image, string $size = 'large', string $class = '', string $alt = '' ): string {
	if ( empty( $image['id'] ) ) {
		return '';
	}

	$alt_text = ! empty( $image['alt'] ) ? $image['alt'] : $alt;

	if ( false ) { // medialab_get_thumbnail erwartet Post-ID, nicht Attachment-ID
		return medialab_get_thumbnail( $image['id'], $size, ['class' => $class], $alt_text );
	}

	return wp_get_attachment_image( $image['id'], $size, false, [
		'class' => $class,
		'alt'   => esc_attr( $alt_text ),
	] );
}

/**
 * Output floating donate button
 */
function fjdf_floating_button(): void {
	$active = fjdf_option( 'fjdf_floating_active', true );
	if ( ! $active ) {
		return;
	}

	$label = fjdf_option( 'fjdf_floating_label', __( 'Spenden', 'fjdf' ) );
	$url   = fjdf_option( 'fjdf_floating_url', get_page_link( get_page_by_path( 'spenden' ) ) );

	if ( empty( $url ) ) {
		return;
	}
	?>
	<a href="<?php echo esc_url( $url ); ?>"
	   class="floating-donate-btn"
	   aria-label="<?php echo esc_attr( $label ); ?>">
		<span><?php echo esc_html( $label ); ?></span>
	</a>
	<?php
}

/**
 * Output copyright text (supports {year} placeholder)
 */
function fjdf_copyright(): string {
	$text = fjdf_option(
		'fjdf_footer_copyright',
		sprintf(
			__( 'Alle Rechte vorbehalten &copy; %s, Juan Diego Flórez Association.', 'fjdf' ),
			date( 'Y' ) // phpcs:ignore WordPress.DateTime.RestrictedFunctions
		)
	);
	return str_replace( '{year}', date( 'Y' ), $text ); // phpcs:ignore
}

/**
 * Output newsletter section (reusable across pages)
 */
function fjdf_newsletter_section(): void {
	$headline    = fjdf_option( 'fjdf_newsletter_headline',    __( 'Bleiben Sie nah am Wandel, den Sie bewirken', 'fjdf' ) );
	$placeholder = fjdf_option( 'fjdf_newsletter_placeholder', __( 'E-Mail-Adresse', 'fjdf' ) );
	$button      = fjdf_option( 'fjdf_newsletter_button',      __( 'Newsletter abonnieren', 'fjdf' ) );
	$image       = fjdf_option( 'fjdf_newsletter_image' );
	$shortcode   = fjdf_option( 'fjdf_newsletter_shortcode' );

	get_template_part( 'template-parts/sections/newsletter', null, [
		'headline'    => $headline,
		'placeholder' => $placeholder,
		'button'      => $button,
		'image'       => $image,
		'shortcode'   => $shortcode,
	] );
}

/**
 * Output donation certificate modal
 */
function fjdf_cert_modal(): void {
	get_template_part( 'template-parts/modals/cert-modal' );
}

/**
 * Output inline SVG icon
 */
function fjdf_icon( string $icon, string $class = '', string $title = '' ): void {
	$path = FJDF_DIR . '/assets/src/icons/' . $icon . '.svg';

	if ( ! file_exists( $path ) ) {
		return;
	}

	$svg = file_get_contents( $path ); // phpcs:ignore

	if ( ! empty( $class ) ) {
		$svg = str_replace( '<svg', '<svg class="' . esc_attr( $class ) . '"', $svg );
	}
	if ( ! empty( $title ) ) {
		$svg = str_replace( '<svg', '<svg aria-label="' . esc_attr( $title ) . '" role="img"', $svg );
	}

	echo $svg; // phpcs:ignore WordPress.Security.EscapeOutput
}

/**
 * Output first post category label
 */
function fjdf_post_category( int $post_id = 0, string $class = 'category-label' ): void {
	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	$categories = get_the_category( $post_id );
	if ( empty( $categories ) ) {
		return;
	}

	$cat = $categories[0];
	printf(
		'<span class="%s">%s</span>',
		esc_attr( $class ),
		esc_html( strtoupper( $cat->name ) )
	);
}

/**
 * Calculate post reading time
 */
function fjdf_reading_time( int $post_id = 0 ): string {
	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	$content    = get_post_field( 'post_content', $post_id );
	$word_count = str_word_count( wp_strip_all_tags( $content ) );
	$minutes    = max( 1, ceil( $word_count / 200 ) );

	return sprintf( '%d min', $minutes );
}


// =============================================================================
// AJAX: Certificate request
// =============================================================================

add_action( 'wp_ajax_fjdf_cert_request',        'fjdf_ajax_cert_request' );
add_action( 'wp_ajax_nopriv_fjdf_cert_request', 'fjdf_ajax_cert_request' );

function fjdf_ajax_cert_request(): void {
	check_ajax_referer( 'fjdf_nonce', 'nonce' );

	$firstname = sanitize_text_field( $_POST['firstname'] ?? '' );
	$lastname  = sanitize_text_field( $_POST['lastname']  ?? '' );
	$email     = sanitize_email(      $_POST['email']     ?? '' );

	if ( empty( $firstname ) || empty( $lastname ) || ! is_email( $email ) ) {
		wp_send_json_error( [
			'message' => __( 'Bitte füllen Sie alle Pflichtfelder aus.', 'fjdf' ),
		] );
	}

	$admin_email = get_option( 'admin_email' );
	$site_name   = get_bloginfo( 'name' );

	// Admin notification
	wp_mail(
		$admin_email,
		sprintf( '[%s] Neue Anfrage: Spendennachweis', $site_name ),
		sprintf(
			"Neue Anfrage für Spendennachweis:\n\nName: %s %s\nE-Mail: %s",
			$firstname, $lastname, $email
		),
		[ 'Content-Type: text/plain; charset=UTF-8' ]
	);

	// Confirmation to donor
	wp_mail(
		$email,
		sprintf( __( 'Ihre Anfrage für den Spendennachweis — %s', 'fjdf' ), $site_name ),
		sprintf(
			__( "Guten Tag %s,\n\nwir haben Ihre Anfrage für den Spendennachweis erhalten und werden uns in Kürze bei Ihnen melden.\n\nVielen Dank für Ihren Beitrag.\n\n%s", 'fjdf' ),
			$firstname,
			$site_name
		),
		[ 'Content-Type: text/plain; charset=UTF-8' ]
	);

	wp_send_json_success( [
		'message' => __( 'Anfrage erfolgreich gesendet! Wir melden uns in Kürze bei Ihnen.', 'fjdf' ),
	] );
}
