<?php
/**
 * FJDF — page-thank-you.php
 * Template Name: Danke für Ihre Spende
 *
 * Split layout: text left / image right (desktop)
 * No newsletter, no floating button
 *
 * @package fjdf
 */

get_header();
the_post();
?>

<main id="main" class="site-main thank-you-page">

	<section class="thank-you-split">

		<div class="thank-you-split__content">
			<div class="thank-you-split__inner">
				<h1 class="thank-you-split__title">
					<?php the_title(); ?>
				</h1>

				<div class="thank-you-split__divider" aria-hidden="true"></div>

				<div class="thank-you-split__text entry-content">
					<?php if ( get_the_content() ) :
						the_content();
					else : ?>
						<p><?php esc_html_e( 'Danke, dass Sie sich der Mission der Juan Diego Flórez Association angeschlossen haben.', 'fjdf' ); ?></p>
						<p><?php esc_html_e( 'Ihr Beitrag ermöglicht es über 6.300 Kindern und Jugendlichen in Peru, kostenlosen Musikunterricht zu erhalten, ihr Talent zu entwickeln und in der Musik einen Weg der Hoffnung und persönlichen Transformation zu finden.', 'fjdf' ); ?></p>
					<?php endif; ?>
				</div>

				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="thank-you-split__back">
					<?php esc_html_e( 'Zurück zur Startseite', 'fjdf' ); ?>
				</a>
			</div>
		</div>

		<?php if ( has_post_thumbnail() ) : ?>
			<div class="thank-you-split__image" aria-hidden="true">
				<?php the_post_thumbnail( 'fjdf-donation-split', [
					'class'   => 'thank-you-split__img',
					'loading' => 'eager',
					'alt'     => '',
				] ); ?>
			</div>
		<?php endif; ?>

	</section>

</main>

<?php get_footer(); ?>
