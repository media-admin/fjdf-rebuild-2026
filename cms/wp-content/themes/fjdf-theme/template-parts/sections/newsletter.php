<?php
/**
 * FJDF — Template Part: Newsletter section
 *
 * Usage:
 *   get_template_part( 'template-parts/sections/newsletter' );
 *   or via fjdf_newsletter_section() helper
 *
 * Args (via $args or directly):
 *   $args['headline']    — Heading text
 *   $args['placeholder'] — Input placeholder
 *   $args['button']      — Button text
 *   $args['image']       — ACF image array
 *   $args['shortcode']   — Newsletter plugin shortcode
 *
 * @package fjdf
 */

$headline    = $args['headline']    ?? fjdf_option( 'fjdf_newsletter_headline',    __( 'Bleiben Sie nah am Wandel, den Sie bewirken', 'fjdf' ) );
$placeholder = $args['placeholder'] ?? fjdf_option( 'fjdf_newsletter_placeholder', __( 'E-Mail-Adresse', 'fjdf' ) );
$button      = $args['button']      ?? fjdf_option( 'fjdf_newsletter_button',      __( 'Newsletter abonnieren', 'fjdf' ) );
$image       = $args['image']       ?? fjdf_option( 'fjdf_newsletter_image' );
$shortcode   = $args['shortcode']   ?? fjdf_option( 'fjdf_newsletter_shortcode' );
?>

<section class="newsletter-section" aria-label="<?php esc_attr_e( 'Newsletter', 'fjdf' ); ?>">
	<div class="container newsletter-section__inner">

		<div class="newsletter-section__content">
			<h2 class="newsletter-section__headline">
				<?php echo esc_html( $headline ); ?>
			</h2>

			<?php if ( $shortcode ) : ?>
				<div class="newsletter-section__form newsletter-section__form--plugin">
					<?php echo do_shortcode( wp_kses_post( $shortcode ) ); ?>
				</div>
			<?php else : ?>
				<!-- Fallback: simple HTML form -->
				<form class="newsletter-section__form"
				      action="#"
				      method="post"
				      aria-label="<?php esc_attr_e( 'Newsletter anmelden', 'fjdf' ); ?>">
					<?php wp_nonce_field( 'fjdf_newsletter', 'fjdf_newsletter_nonce' ); ?>
					<div class="newsletter-section__form-row">
						<label for="newsletter-email" class="screen-reader-text">
							<?php esc_html_e( 'E-Mail-Adresse', 'fjdf' ); ?>
						</label>
						<input
							type="email"
							id="newsletter-email"
							name="email"
							class="newsletter-section__input"
							placeholder="<?php echo esc_attr( $placeholder ); ?>"
							required
							autocomplete="email"
						>
						<button type="submit" class="newsletter-section__btn btn btn--primary">
							<?php echo esc_html( $button ); ?>
						</button>
					</div>
				</form>
			<?php endif; ?>
		</div>

		<?php if ( ! empty( $image['id'] ) ) : ?>
			<div class="newsletter-section__image" aria-hidden="true">
				<?php echo wp_get_attachment_image( $image['id'], 'fjdf-portrait', false, [
					'alt'     => '',
					'loading' => 'lazy',
					'class'   => 'newsletter-section__img',
				] ); ?>
			</div>
		<?php endif; ?>

	</div>
</section>
