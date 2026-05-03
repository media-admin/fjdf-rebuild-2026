<?php
/**
 * FJDF — Template Part: Donation certificate modal
 *
 * Global modal — included via fjdf_cert_modal() in footer.php.
 * Opened via JS when a [data-open-cert-modal] element is clicked.
 *
 * @package fjdf
 */

$headline = fjdf_option( 'fjdf_donate_cert_headline', __( 'Erhalten Sie Ihren Spendennachweis', 'fjdf' ) );
$subtext  = fjdf_option( 'fjdf_donate_cert_subtext',  __( 'Fordern Sie ihn einfach an, um Steuern in Österreich abzuziehen und Ihren Beitrag zu belegen.', 'fjdf' ) );
$button   = fjdf_option( 'fjdf_donate_cert_button',   __( 'Spendennachweis anfordern', 'fjdf' ) );
$image    = fjdf_option( 'fjdf_donate_cert_image' );
?>

<div class="cert-modal"
     id="cert-modal"
     role="dialog"
     aria-modal="true"
     aria-labelledby="cert-modal-title"
     aria-hidden="true">

	<div class="cert-modal__overlay" data-close-modal></div>

	<div class="cert-modal__dialog">

		<!-- Image (desktop only) -->
		<?php if ( ! empty( $image['id'] ) ) : ?>
			<div class="cert-modal__image" aria-hidden="true">
				<?php echo wp_get_attachment_image( $image['id'], 'fjdf-donation-split', false, [
					'alt'     => '',
					'loading' => 'lazy',
					'class'   => 'cert-modal__img',
				] ); ?>
			</div>
		<?php endif; ?>

		<!-- Form -->
		<div class="cert-modal__content">

			<button class="cert-modal__close"
			        data-close-modal
			        aria-label="<?php esc_attr_e( 'Schließen', 'fjdf' ); ?>">
				<span aria-hidden="true">&times;</span>
			</button>

			<h2 class="cert-modal__headline" id="cert-modal-title">
				<?php echo esc_html( $headline ); ?>
			</h2>

			<p class="cert-modal__subtext">
				<?php echo esc_html( $subtext ); ?>
			</p>

			<form class="cert-modal__form"
			      id="cert-modal-form"
			      novalidate
			      aria-label="<?php esc_attr_e( 'Spendennachweis anfordern', 'fjdf' ); ?>">
				<?php wp_nonce_field( 'fjdf_cert_request', 'fjdf_cert_nonce' ); ?>

				<div class="cert-modal__field">
					<label for="cert-firstname" class="screen-reader-text">
						<?php esc_html_e( 'Vorname', 'fjdf' ); ?>
					</label>
					<input
						type="text"
						id="cert-firstname"
						name="firstname"
						class="cert-modal__input"
						placeholder="<?php esc_attr_e( 'Vorname(n)', 'fjdf' ); ?>"
						required
						autocomplete="given-name"
					>
				</div>

				<div class="cert-modal__field">
					<label for="cert-lastname" class="screen-reader-text">
						<?php esc_html_e( 'Nachname', 'fjdf' ); ?>
					</label>
					<input
						type="text"
						id="cert-lastname"
						name="lastname"
						class="cert-modal__input"
						placeholder="<?php esc_attr_e( 'Nachname(n)', 'fjdf' ); ?>"
						required
						autocomplete="family-name"
					>
				</div>

				<div class="cert-modal__field">
					<label for="cert-email" class="screen-reader-text">
						<?php esc_html_e( 'E-Mail-Adresse', 'fjdf' ); ?>
					</label>
					<input
						type="email"
						id="cert-email"
						name="email"
						class="cert-modal__input"
						placeholder="<?php esc_attr_e( 'E-Mail-Adresse', 'fjdf' ); ?>"
						required
						autocomplete="email"
					>
				</div>

				<button type="submit" class="cert-modal__submit btn btn--primary">
					<?php echo esc_html( $button ); ?>
				</button>

				<div class="cert-modal__feedback" aria-live="polite" aria-atomic="true"></div>

			</form>

		</div><!-- .cert-modal__content -->

	</div><!-- .cert-modal__dialog -->

</div><!-- .cert-modal -->
