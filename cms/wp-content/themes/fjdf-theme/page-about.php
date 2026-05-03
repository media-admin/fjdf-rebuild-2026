<?php
/**
 * FJDF — page-about.php
 * Template Name: Über uns
 *
 * @package fjdf
 */

get_header();

$hero_image   = fjdf_field( 'fjdf_about_hero_image' );
$hero_head    = fjdf_field( 'fjdf_about_hero_headline', false, __( 'Eine solidarische Brücke zwischen Österreich und Peru', 'fjdf' ) );
$hero_sub     = fjdf_field( 'fjdf_about_hero_subtext' );
$intro        = fjdf_field( 'fjdf_about_intro' );
$bridge_text  = fjdf_field( 'fjdf_about_bridge_text' );
$gallery      = fjdf_field( 'fjdf_about_gallery', false, [] );
$hist_label   = fjdf_field( 'fjdf_about_history_label' );
$hist_text    = fjdf_field( 'fjdf_about_history_text' );
?>

<main id="main" class="site-main about-page">

	<!-- Hero -->
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

	<!-- Intro -->
	<section class="about-intro section">
		<div class="container about-intro__inner">
			<div class="about-intro__content">
				<h1 class="about-intro__headline"><?php echo wp_kses_post( $hero_head ); ?></h1>

				<?php if ( $intro ) : ?>
					<div class="about-intro__text entry-content">
						<?php echo wp_kses_post( $intro ); ?>
					</div>
				<?php elseif ( $hero_sub ) : ?>
					<p class="about-intro__subtext"><?php echo esc_html( $hero_sub ); ?></p>
				<?php endif; ?>

				<?php if ( $bridge_text ) : ?>
					<p class="about-intro__bridge"><?php echo esc_html( $bridge_text ); ?></p>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<!-- Gallery -->
	<?php if ( ! empty( $gallery ) ) : ?>
		<section class="about-gallery section--sm">
			<div class="container">
				<div class="about-gallery__main">
					<?php
					$main_image = $gallery[0];
					echo wp_get_attachment_image( $main_image['id'], 'fjdf-article-header', false, [
						'class'   => 'about-gallery__main-img',
						'loading' => 'lazy',
						'alt'     => esc_attr( $main_image['alt'] ?? '' ),
						'id'      => 'gallery-main-img',
					] );
					?>
				</div>
				<div class="about-gallery__thumbs" role="list">
					<?php foreach ( $gallery as $i => $img ) : ?>
						<button class="about-gallery__thumb <?php echo $i === 0 ? 'is-active' : ''; ?>"
						        data-full="<?php echo esc_url( wp_get_attachment_image_url( $img['id'], 'fjdf-article-header' ) ); ?>"
						        data-alt="<?php echo esc_attr( $img['alt'] ?? '' ); ?>"
						        aria-label="<?php printf( esc_attr__( 'Bild %d anzeigen', 'fjdf' ), $i + 1 ); ?>"
						        role="listitem">
							<?php echo wp_get_attachment_image( $img['id'], 'thumbnail', false, [
								'loading' => 'lazy',
								'alt'     => '',
							] ); ?>
						</button>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<!-- History / Since section -->
	<?php if ( $hist_label || $hist_text ) : ?>
		<section class="about-history section bg-cream-dark">
			<div class="container about-history__inner">
				<?php if ( $hist_label ) : ?>
					<h2 class="about-history__headline"><?php echo esc_html( $hist_label ); ?></h2>
				<?php endif; ?>
				<?php if ( $hist_text ) : ?>
					<div class="about-history__text entry-content">
						<?php echo wp_kses_post( $hist_text ); ?>
					</div>
				<?php endif; ?>
			</div>
		</section>
	<?php endif; ?>

	<?php fjdf_partner_logos(); ?>
	<?php fjdf_newsletter_section(); ?>

</main>

<?php get_footer(); ?>
