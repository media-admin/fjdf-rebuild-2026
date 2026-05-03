<?php
/**
 * FJDF — page-donate.php
 * Template Name: Spenden
 *
 * Layout: split-screen (image left / form right) on desktop
 * GiveWP Form + custom step UI
 *
 * @package fjdf
 */

get_header();

$hero_image   = fjdf_field( 'fjdf_donate_hero_image' );
$headline     = fjdf_field( 'fjdf_donate_headline',          false, __( 'Spenden und mitmachen', 'fjdf' ) );
$subtext      = fjdf_field( 'fjdf_donate_subtext' );
$cert_link_l  = fjdf_field( 'fjdf_donate_cert_link_label',   false, __( 'Fordern Sie Ihr Spendennachweis-Zertifikat an.', 'fjdf' ) );
$step1_label  = fjdf_field( 'fjdf_donate_step1_label',       false, __( 'Wählen Sie Ihren Spendenbetrag', 'fjdf' ) );
$step2_label  = fjdf_field( 'fjdf_donate_step2_label',       false, __( 'Wählen Sie eine Zahlungsmethode', 'fjdf' ) );
$step3_label  = fjdf_field( 'fjdf_donate_step3_label',       false, __( 'Ihre Angaben', 'fjdf' ) );
$tab_once     = fjdf_field( 'fjdf_donate_tab_once',          false, __( 'Einmalig', 'fjdf' ) );
$tab_monthly  = fjdf_field( 'fjdf_donate_tab_monthly',       false, __( 'Monatlich', 'fjdf' ) );
$amounts_once = fjdf_field( 'fjdf_donate_amounts_once',      false, [ ['amount'=>10], ['amount'=>20], ['amount'=>30], ['amount'=>100] ] );
$amounts_mo   = fjdf_field( 'fjdf_donate_amounts_monthly',   false, [ ['amount'=>5], ['amount'=>10], ['amount'=>20], ['amount'=>50] ] );
$custom_label = fjdf_field( 'fjdf_donate_custom_label',      false, __( 'Individueller Betrag', 'fjdf' ) );
$pay_stripe   = fjdf_field( 'fjdf_donate_payment_stripe',    false, true );
$pay_paypal   = fjdf_field( 'fjdf_donate_payment_paypal',    false, true );
$pay_eps      = fjdf_field( 'fjdf_donate_payment_eps',       false, true );
$pay_klarna   = fjdf_field( 'fjdf_donate_payment_klarna',    false, true );
$field_fn     = fjdf_field( 'fjdf_donate_field_firstname',   false, __( 'Vorname(n)', 'fjdf' ) );
$field_ln     = fjdf_field( 'fjdf_donate_field_lastname',    false, __( 'Nachname(n)', 'fjdf' ) );
$field_email  = fjdf_field( 'fjdf_donate_field_email',       false, __( 'E-Mail-Adresse', 'fjdf' ) );
$terms_label  = fjdf_field( 'fjdf_donate_terms_label',       false, __( 'Ja, ich akzeptiere die Nutzungsbedingungen', 'fjdf' ) );
$anon_label   = fjdf_field( 'fjdf_donate_anon_label',        false, __( 'Anonyme Spende', 'fjdf' ) );
$submit_label = fjdf_field( 'fjdf_donate_submit_label',      false, __( 'Jetzt spenden', 'fjdf' ) );
$cert_head    = fjdf_field( 'fjdf_donate_cert_headline',     false, __( 'Erhalten Sie Ihren Spendennachweis', 'fjdf' ) );
$cert_sub     = fjdf_field( 'fjdf_donate_cert_subtext',      false, __( 'Fordern Sie ihn einfach an, um Steuern in Österreich abzuziehen und Ihren Beitrag zu belegen.', 'fjdf' ) );
$cert_btn     = fjdf_field( 'fjdf_donate_cert_button',       false, __( 'Spendennachweis anfordern', 'fjdf' ) );
?>

<main id="main" class="site-main donate-page">

	<div class="donate-layout">

		<!-- Split image (desktop left) -->
		<?php if ( ! empty( $hero_image['id'] ) ) : ?>
			<div class="donate-layout__image" aria-hidden="true">
				<?php echo fjdf_image( $hero_image, 'fjdf-donation-split', 'donate-layout__img' ); ?>
			</div>
		<?php endif; ?>

		<!-- Form side -->
		<div class="donate-layout__form-wrap">
			<div class="donate-layout__form-inner">

				<header class="donate-header">
					<h1 class="donate-header__title"><?php echo esc_html( $headline ); ?></h1>
					<?php if ( $subtext ) : ?>
						<p class="donate-header__subtext"><?php echo esc_html( $subtext ); ?></p>
					<?php endif; ?>
					<p class="donate-header__cert-link">
						<button class="link-btn" data-open-cert-modal>
							<?php echo esc_html( $cert_link_l ); ?>
						</button>
					</p>
				</header>

				<!-- STEP 1: Amount -->
				<div class="donate-step">
					<h2 class="donate-step__label">
						<span class="donate-step__num">1</span>
						<?php echo esc_html( $step1_label ); ?>
					</h2>

					<div class="donate-frequency" role="tablist" aria-label="<?php esc_attr_e( 'Zahlungsfrequenz', 'fjdf' ); ?>">
						<button class="donate-frequency__btn is-active"
						        role="tab" id="freq-once"
						        aria-selected="true"
						        aria-controls="amounts-once"
						        data-frequency="once">
							<span class="donate-frequency__icon" aria-hidden="true">●</span>
							<?php echo esc_html( $tab_once ); ?>
						</button>
						<button class="donate-frequency__btn"
						        role="tab" id="freq-monthly"
						        aria-selected="false"
						        aria-controls="amounts-monthly"
						        data-frequency="monthly">
							<span class="donate-frequency__icon" aria-hidden="true">○</span>
							<?php echo esc_html( $tab_monthly ); ?>
						</button>
					</div>

					<!-- One-time amounts -->
					<div class="donate-amounts is-active" id="amounts-once" role="tabpanel" aria-labelledby="freq-once">
						<div class="donate-amounts__grid">
							<?php foreach ( $amounts_once as $i => $item ) : ?>
								<label class="donate-amount-option">
									<input type="radio" name="amount_once" value="<?php echo esc_attr( $item['amount'] ); ?>" <?php checked( $i, 0 ); ?>>
									<span class="donate-amount-option__label">
										EUR <strong><?php echo esc_html( $item['amount'] ); ?></strong>
									</span>
								</label>
							<?php endforeach; ?>
							<label class="donate-amount-option donate-amount-option--custom">
								<input type="radio" name="amount_once" value="custom">
								<span class="donate-amount-option__label">
									EUR <input type="number"
									           class="donate-custom-input"
									           min="1" step="1"
									           placeholder="<?php echo esc_attr( $custom_label ); ?>"
									           aria-label="<?php esc_attr_e( 'Individueller Betrag in EUR', 'fjdf' ); ?>">
								</span>
							</label>
						</div>
					</div>

					<!-- Monthly amounts -->
					<div class="donate-amounts" id="amounts-monthly" role="tabpanel" aria-labelledby="freq-monthly" hidden>
						<div class="donate-amounts__grid">
							<?php foreach ( $amounts_mo as $i => $item ) : ?>
								<label class="donate-amount-option">
									<input type="radio" name="amount_monthly" value="<?php echo esc_attr( $item['amount'] ); ?>" <?php checked( $i, 0 ); ?>>
									<span class="donate-amount-option__label">
										EUR <strong><?php echo esc_html( $item['amount'] ); ?></strong>
									</span>
								</label>
							<?php endforeach; ?>
							<label class="donate-amount-option donate-amount-option--custom">
								<input type="radio" name="amount_monthly" value="custom">
								<span class="donate-amount-option__label">
									EUR <input type="number"
									           class="donate-custom-input"
									           min="1" step="1"
									           placeholder="<?php echo esc_attr( $custom_label ); ?>"
									           aria-label="<?php esc_attr_e( 'Individueller Betrag in EUR', 'fjdf' ); ?>">
								</span>
							</label>
						</div>
					</div>
				</div>

				<!-- STEP 2: Payment method -->
				<div class="donate-step">
					<h2 class="donate-step__label">
						<span class="donate-step__num">2</span>
						<?php echo esc_html( $step2_label ); ?>
					</h2>

					<div class="donate-payment-methods" role="group" aria-label="<?php esc_attr_e( 'Zahlungsmethode wählen', 'fjdf' ); ?>">
						<?php if ( $pay_stripe ) : ?>
							<label class="donate-payment-option">
								<input type="radio" name="payment_method" value="stripe" checked>
								<span class="donate-payment-option__inner">
									<img src="<?php echo esc_url( FJDF_URI . '/assets/src/icons/stripe.svg' ); ?>" alt="Stripe" width="48" height="24" loading="lazy">
									<span>Kreditkarte</span>
								</span>
							</label>
						<?php endif; ?>
						<?php if ( $pay_paypal ) : ?>
							<label class="donate-payment-option">
								<input type="radio" name="payment_method" value="paypal">
								<span class="donate-payment-option__inner">
									<img src="<?php echo esc_url( FJDF_URI . '/assets/src/icons/paypal.svg' ); ?>" alt="PayPal" width="48" height="24" loading="lazy">
									<span>PayPal</span>
								</span>
							</label>
						<?php endif; ?>
										<?php if ( $pay_eps ) : ?>
						<label class="donate-payment-option">
							<input type="radio" name="payment_method" value="eps">
							<span class="donate-payment-option__inner">
								<img src="<?php echo esc_url( FJDF_URI . '/assets/src/icons/eps.svg' ); ?>" alt="EPS" width="48" height="24" loading="lazy">
								<span>EPS</span>
							</span>
						</label>
					<?php endif; ?>
					<?php if ( $pay_klarna ) : ?>
							<label class="donate-payment-option">
								<input type="radio" name="payment_method" value="klarna">
								<span class="donate-payment-option__inner">
									<img src="<?php echo esc_url( FJDF_URI . '/assets/src/icons/klarna.svg' ); ?>" alt="Klarna" width="48" height="24" loading="lazy">
									<span>Klarna</span>
								</span>
							</label>
						<?php endif; ?>
					</div>
				</div>

				<!-- STEP 3: GiveWP form / details -->
				<div class="donate-step">
					<h2 class="donate-step__label">
						<span class="donate-step__num">3</span>
						<?php echo esc_html( $step3_label ); ?>
					</h2>

					<?php
					$give_form_id = apply_filters( 'fjdf_give_form_id', 0 );

					if ( $give_form_id && function_exists( 'give_get_form_html' ) ) :
						echo do_shortcode( '[give_form id="' . absint( $give_form_id ) . '" show_title="false" show_goal="false"]' );
					else :
					?>
						<div class="donate-form-placeholder">
							<div class="donate-form__fields">
								<div class="form-field">
									<label for="donate-firstname" class="screen-reader-text"><?php esc_html_e( 'Vorname', 'fjdf' ); ?></label>
									<input type="text" id="donate-firstname" class="form-input" placeholder="<?php echo esc_attr( $field_fn ); ?>" autocomplete="given-name">
								</div>
								<div class="form-field">
									<label for="donate-lastname" class="screen-reader-text"><?php esc_html_e( 'Nachname', 'fjdf' ); ?></label>
									<input type="text" id="donate-lastname" class="form-input" placeholder="<?php echo esc_attr( $field_ln ); ?>" autocomplete="family-name">
								</div>
								<div class="form-field">
									<label for="donate-email" class="screen-reader-text"><?php esc_html_e( 'E-Mail-Adresse', 'fjdf' ); ?></label>
									<input type="email" id="donate-email" class="form-input" placeholder="<?php echo esc_attr( $field_email ); ?>" autocomplete="email">
								</div>
								<label class="form-checkbox">
									<input type="checkbox" required>
									<span><?php echo esc_html( $terms_label ); ?></span>
								</label>
								<label class="form-checkbox">
									<input type="checkbox">
									<span><?php echo esc_html( $anon_label ); ?></span>
								</label>
							</div>
							<button class="btn btn--primary btn--heart btn--full donate-submit" id="donate-submit">
								<?php echo esc_html( $submit_label ); ?> <span id="donate-submit-amount"></span>
							</button>
						</div>
					<?php endif; ?>
				</div>

			</div>
		</div>

	</div><!-- .donate-layout -->

	<!-- Certificate section -->
	<section class="cert-section section bg-cream-dark">
		<div class="container cert-section__inner">
			<div class="cert-section__content">
				<h2 class="cert-section__headline"><?php echo esc_html( $cert_head ); ?></h2>
				<p class="cert-section__subtext"><?php echo esc_html( $cert_sub ); ?></p>
				<div class="cert-section__fields">
					<input type="text"  class="form-input" placeholder="<?php echo esc_attr( $field_fn ); ?>">
					<input type="text"  class="form-input" placeholder="<?php echo esc_attr( $field_ln ); ?>">
					<input type="email" class="form-input" placeholder="<?php esc_attr_e( 'E-Mail-Adresse', 'fjdf' ); ?>">
				</div>
				<button class="btn btn--outline cert-section__btn" data-open-cert-modal>
					<?php echo esc_html( $cert_btn ); ?>
				</button>
			</div>
		</div>
	</section>

</main>

<?php get_footer(); ?>
