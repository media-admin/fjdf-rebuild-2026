<?php
/**
 * FJDF — page-donate.php
 * Template Name: Spenden
 *
 * Layout: split-screen (image left / GiveWP Modal-Trigger right) on desktop
 *
 * @package fjdf
 */

get_header();

$hero_image  = fjdf_field( 'fjdf_donate_hero_image' );
$headline    = fjdf_field( 'fjdf_donate_headline',        false, __( 'Spenden und mitmachen', 'fjdf' ) );
$subtext     = fjdf_field( 'fjdf_donate_subtext' );
$cert_link_l = fjdf_field( 'fjdf_donate_cert_link_label', false, __( 'Fordern Sie Ihr Spendennachweis-Zertifikat an.', 'fjdf' ) );
$cert_head   = fjdf_field( 'fjdf_donate_cert_headline',   false, __( 'Erhalten Sie Ihren Spendennachweis', 'fjdf' ) );
$cert_sub    = fjdf_field( 'fjdf_donate_cert_subtext',    false, __( 'Fordern Sie ihn einfach an, um Steuern in Österreich abzuziehen und Ihren Beitrag zu belegen.', 'fjdf' ) );
$cert_btn    = fjdf_field( 'fjdf_donate_cert_button',     false, __( 'Spendennachweis anfordern', 'fjdf' ) );
$field_fn    = fjdf_field( 'fjdf_donate_field_firstname', false, __( 'Vorname(n)', 'fjdf' ) );
$field_ln    = fjdf_field( 'fjdf_donate_field_lastname',  false, __( 'Nachname(n)', 'fjdf' ) );
?>

<main id="main" class="site-main donate-page">

	<div class="donate-layout">

		<?php if ( ! empty( $hero_image['id'] ) ) : ?>
			<div class="donate-layout__image" aria-hidden="true">
				<?php echo fjdf_image( $hero_image, 'fjdf-donation-split', 'donate-layout__img' ); ?>
			</div>
		<?php endif; ?>

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

				<?php
				$give_form_id = apply_filters( 'fjdf_give_form_id', 0 );

				if ( $give_form_id ) :
					echo do_blocks(
						'<!-- wp:give/donation-form {"id":' . absint( $give_form_id ) . ',"displayStyle":"modal"} /-->'
					);
				endif;
				?>

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