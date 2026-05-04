<?php
/**
 * FJDF — page-about.php
 * Template Name: Über uns
 *
 * @package fjdf
 */

get_header();

$hero_image      = fjdf_field( 'fjdf_about_hero_image' );
$hero_head       = fjdf_field( 'fjdf_about_hero_headline', false, __( 'Eine solidarische Brücke zwischen Österreich und Peru', 'fjdf' ) );
$intro           = fjdf_field( 'fjdf_about_intro' );
$gallery         = fjdf_field( 'fjdf_about_gallery', false, [] );
$mission_head    = fjdf_field( 'fjdf_about_mission_headline', false, __( 'Wir mobilisieren Solidarität, um Leben durch Musik zu verändern', 'fjdf' ) );
$mission_text    = fjdf_field( 'fjdf_about_mission_text' );
?>

<main id="main" class="site-main about-page">

	<?php /* ================================================================
	   1. HERO
	   ================================================================ */ ?>
	<section class="page-hero page-hero--about">
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
	<section class="about-intro section">
		<div class="container">
			<div class="about-intro__inner">
				<h1 class="about-intro__headline"><?php echo wp_kses_post( $hero_head ); ?></h1>
				<?php if ( $intro ) : ?>
					<div class="about-intro__text">
						<?php echo wp_kses_post( $intro ); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<?php /* ================================================================
	   3. GALERIE — Swiper Slideshow + Thumbs
	   ================================================================ */ ?>
	<?php if ( ! empty( $gallery ) ) : ?>
		<section class="about-gallery section--sm">
			<div class="container">

				<!-- Haupt-Slider -->
				<div class="swiper js-gallery-main about-gallery__main-swiper container">
					<div class="swiper-wrapper">
						<?php foreach ( $gallery as $img ) : ?>
							<div class="swiper-slide">
								<?php echo wp_get_attachment_image( $img['id'], 'fjdf-article-header', false, [
									'class'   => 'about-gallery__main-img',
									'loading' => 'lazy',
									'alt'     => esc_attr( $img['alt'] ?? '' ),
								] ); ?>
							</div>
						<?php endforeach; ?>
					</div>
					<button class="about-gallery__nav about-gallery__nav--prev js-gallery-prev" aria-label="<?php esc_attr_e( 'Vorheriges Bild', 'fjdf' ); ?>">‹</button>
					<button class="about-gallery__nav about-gallery__nav--next js-gallery-next" aria-label="<?php esc_attr_e( 'Nächstes Bild', 'fjdf' ); ?>">›</button>
				</div>

				<!-- Thumbnail-Slider -->
				<div class="swiper js-gallery-thumbs about-gallery__thumbs-swiper">
					<div class="swiper-wrapper">
						<?php foreach ( $gallery as $img ) : ?>
							<div class="swiper-slide about-gallery__thumb">
								<?php echo wp_get_attachment_image( $img['id'], 'thumbnail', false, [
									'loading' => 'lazy',
									'alt'     => '',
								] ); ?>
							</div>
						<?php endforeach; ?>
					</div>
				</div>

			</div>
		</section>
	<?php endif; ?>

	<?php /* ================================================================
	   4. MISSION
	   ================================================================ */ ?>
	<?php if ( $mission_head || $mission_text ) : ?>
		<section class="about-mission section">
			<div class="container">
				<div class="about-mission__inner">
					<?php if ( $mission_head ) : ?>
						<h2 class="about-mission__headline"><?php echo esc_html( $mission_head ); ?></h2>
					<?php endif; ?>
					<?php if ( $mission_text ) : ?>
						<p class="about-mission__text"><?php echo esc_html( $mission_text ); ?></p>
					<?php endif; ?>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<?php /* ================================================================
	   5. DONATION CTA
	   ================================================================ */ ?>
	<?php fjdf_donation_cta(); ?>

	<?php /* ================================================================
	   6. NEWSLETTER
	   ================================================================ */ ?>
	<?php fjdf_newsletter_section(); ?>

</main>

<?php get_footer(); ?>
