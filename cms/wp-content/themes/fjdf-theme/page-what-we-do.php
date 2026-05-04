<?php
/**
 * FJDF — page-what-we-do.php
 * Template Name: Was wir tun
 *
 * @package fjdf
 */

get_header();

$hero_image      = fjdf_field( 'fjdf_what_hero_image' );
$hero_head       = fjdf_field( 'fjdf_what_hero_headline', false, __( 'Wir verändern Leben durch Musik', 'fjdf' ) );
$intro_text      = fjdf_field( 'fjdf_what_intro_text' );
$intro_bridge    = fjdf_field( 'fjdf_what_intro_bridge' );
$impact_label    = fjdf_field( 'fjdf_what_impact_label', false, __( 'WAS WIR TUN', 'fjdf' ) );
$impact_head     = fjdf_field( 'fjdf_what_impact_headline' );
$impact_intro    = fjdf_field( 'fjdf_what_impact_intro' );
$impact_portrait = fjdf_field( 'fjdf_what_impact_portrait' );
$tabs            = fjdf_field( 'fjdf_what_tabs', false, [] );
$additional_text = fjdf_field( 'fjdf_what_additional_text' );
$contrib_label   = fjdf_field( 'fjdf_what_contrib_label' );
$contrib_head    = fjdf_field( 'fjdf_what_contrib_headline' );
$contrib_items   = fjdf_field( 'fjdf_what_contrib_items', false, [] );
?>

<main id="main" class="site-main what-we-do-page">

	<?php /* ================================================================
	   1. HERO — nur Bild, kein Text
	   ================================================================ */ ?>
	<section class="page-hero page-hero--what">
		<?php if ( ! empty( $hero_image['id'] ) ) : ?>
			<div class="page-hero__image" aria-hidden="true">
				<?php echo wp_get_attachment_image( $hero_image['id'], 'fjdf-hero', false, [
					'class'         => 'page-hero__img',
					'loading'       => 'eager',
					'fetchpriority' => 'high',
					'alt'           => '',
				] ); ?>
			</div>
		<?php endif; ?>
	</section>

	<?php /* ================================================================
	   2. INTRO — zentriert
	   ================================================================ */ ?>
	<?php if ( $intro_text || $intro_bridge ) : ?>
		<section class="what-intro section bg-white">
			<div class="container">
				<div class="what-intro__inner">
					<?php if ( $intro_text ) : ?>
						<div class="what-intro__text">
							<?php echo wp_kses_post( $intro_text ); ?>
						</div>
					<?php endif; ?>
					<?php if ( $intro_bridge ) : ?>
						<p class="what-intro__bridge"><?php echo esc_html( $intro_bridge ); ?></p>
					<?php endif; ?>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<?php /* ================================================================
	   3. IMPACT TABS
	   ================================================================ */ ?>
	<?php if ( ! empty( $tabs ) ) : ?>
		<section class="impact-section section">
			<div class="container">
				<?php if ( $impact_label ) : ?>
					<p class="impact-section__label category-label u-text-center"><?php echo esc_html( $impact_label ); ?></p>
				<?php endif; ?>
				<?php if ( $impact_head ) : ?>
					<h2 class="impact-section__headline"><?php echo esc_html( $impact_head ); ?></h2>
				<?php endif; ?>
				<?php if ( $impact_intro ) : ?>
					<p class="impact-section__intro"><?php echo esc_html( $impact_intro ); ?></p>
				<?php endif; ?>

				<div class="impact-tabs" role="tablist" aria-label="<?php esc_attr_e( 'Impact-Kategorien', 'fjdf' ); ?>">
					<?php foreach ( $tabs as $i => $tab ) : ?>
						<button class="impact-tabs__btn <?php echo $i === 0 ? 'is-active' : ''; ?>"
								role="tab"
								id="tab-<?php echo esc_attr( $i ); ?>"
								aria-selected="<?php echo $i === 0 ? 'true' : 'false'; ?>"
								aria-controls="tabpanel-<?php echo esc_attr( $i ); ?>">
							<?php echo esc_html( $tab['title'] ); ?>
						</button>
					<?php endforeach; ?>
				</div>

				<?php foreach ( $tabs as $i => $tab ) : ?>
					<div class="impact-tabpanel impact-split <?php echo $i === 0 ? 'is-active' : ''; ?>"
						 role="tabpanel"
						 id="tabpanel-<?php echo esc_attr( $i ); ?>"
						 aria-labelledby="tab-<?php echo esc_attr( $i ); ?>"
						 <?php echo $i !== 0 ? 'hidden' : ''; ?>>

						<?php if ( ! empty( $impact_portrait['id'] ) ) : ?>
							<div class="impact-split__image">
								<?php echo wp_get_attachment_image( $impact_portrait['id'], 'fjdf-portrait', false, [
									'class'   => 'impact-split__img',
									'loading' => 'lazy',
									'alt'     => '',
								] ); ?>
							</div>
						<?php endif; ?>

						<div class="impact-split__stats impact-stats__grid">
							<?php foreach ( $tab['stats'] as $stat ) : ?>
								<div class="impact-stat">
									<strong class="impact-stat__value"><?php echo esc_html( $stat['value'] ); ?></strong>
									<p class="impact-stat__text"><?php echo esc_html( $stat['text'] ); ?></p>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				<?php endforeach; ?>

				<?php if ( $additional_text ) : ?>
					<div class="what-additional-text entry-content">
						<?php echo wp_kses_post( $additional_text ); ?>
					</div>
				<?php endif; ?>
			</div>
		</section>
	<?php endif; ?>

	<?php /* ================================================================
	   4. VIDEO TESTIMONIAL
	   ================================================================ */ ?>
	<?php fjdf_video_testimonial( get_the_ID() ); ?>

	<?php /* ================================================================
	   4b. TESTIMONIAL SLIDER
	   ================================================================ */ ?>
	<?php
	$testimonials = fjdf_field( 'fjdf_testimonials', false, [] );
	?>
	<?php if ( ! empty( $testimonials ) ) : ?>
		<section class="testimonial-slider-section section bg-cream">
			<div class="swiper js-testimonial-slider">
				<div class="swiper-wrapper">
					<?php foreach ( $testimonials as $t ) : ?>
						<div class="swiper-slide">
							<div class="container testimonial-slide-item">
								<?php if ( ! empty( $t['image']['id'] ) ) : ?>
									<div class="testimonial-slide-item__image">
										<?php echo wp_get_attachment_image( $t['image']['id'], 'fjdf-portrait', false, [
											'class'   => 'testimonial-slide-item__img',
											'loading' => 'lazy',
											'alt'     => esc_attr( $t['name'] ?? '' ),
										] ); ?>
									</div>
								<?php endif; ?>
								<div class="testimonial-slide-item__content">
									<p class="testimonial-slide-item__label category-label"><?php esc_html_e( 'BEGÜNSTIGTE/R', 'fjdf' ); ?></p>
									<blockquote class="testimonial-slide-item__quote">
										<span class="testimonial-slide-item__mark">"</span>
										<p><?php echo esc_html( $t['quote'] ); ?></p>
										<footer>
											<cite class="testimonial-slide-item__name">— <?php echo esc_html( $t['name'] ); ?><?php if ( ! empty( $t['origin'] ) ) : ?>, <?php echo esc_html( $t['origin'] ); ?><?php endif; ?></cite>
										</footer>
									</blockquote>
									<?php
									$cta_btn_u = fjdf_field( 'fjdf_cta_button_url', 6 );
									$cta_btn_l = fjdf_field( 'fjdf_cta_button_label', 6, __( 'Jetzt spenden', 'fjdf' ) );
									?>
									<?php if ( $cta_btn_u ) : ?>
										<a href="<?php echo esc_url( $cta_btn_u ); ?>" class="btn btn--primary btn--heart">
											<?php echo esc_html( $cta_btn_l ); ?>
										</a>
									<?php endif; ?>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
				<div class="swiper-pagination js-testimonial-pagination"></div>
				<button class="testimonial-slider__nav testimonial-slider__nav--prev js-test-prev" aria-label="Vorheriges">&#8249;</button>
				<button class="testimonial-slider__nav testimonial-slider__nav--next js-test-next" aria-label="N&#228;chstes">&#8250;</button>
			</div>
		</section>
	<?php endif; ?>

	<?php /* ================================================================
	   6. DONATION CTA
	   ================================================================ */ ?>
	<?php fjdf_donation_cta(); ?>

	<?php /* ================================================================
	   7. NEWSLETTER
	   ================================================================ */ ?>
	<?php fjdf_newsletter_section(); ?>

</main>

<?php get_footer(); ?>
