<?php
/**
 * FJDF — page-what-we-do.php
 * Template Name: Was wir tun
 *
 * @package fjdf
 */

get_header();

$hero_image    = fjdf_field( 'fjdf_what_hero_image' );
$hero_head     = fjdf_field( 'fjdf_what_hero_headline', false, __( 'Wir verändern Leben durch Musik', 'fjdf' ) );
$hero_sub      = fjdf_field( 'fjdf_what_hero_subtext' );
$impact_label  = fjdf_field( 'fjdf_what_impact_label',    false, __( 'WAS WIR TUN', 'fjdf' ) );
$impact_head   = fjdf_field( 'fjdf_what_impact_headline' );
$impact_intro  = fjdf_field( 'fjdf_what_impact_intro' );
$tabs          = fjdf_field( 'fjdf_what_tabs', false, [] );
$test_label    = fjdf_field( 'fjdf_what_test_label',    false, __( 'ZEUGNIS', 'fjdf' ) );
$test_image    = fjdf_field( 'fjdf_what_test_image' );
$test_quote    = fjdf_field( 'fjdf_what_test_quote' );
$test_name     = fjdf_field( 'fjdf_what_test_name' );
$test_origin   = fjdf_field( 'fjdf_what_test_origin' );
$test_cta_l    = fjdf_field( 'fjdf_what_test_cta_label', false, __( 'Jetzt spenden', 'fjdf' ) );
$test_cta_u    = fjdf_field( 'fjdf_what_test_cta_url' );
$contrib_label = fjdf_field( 'fjdf_what_contrib_label' );
$contrib_head  = fjdf_field( 'fjdf_what_contrib_headline' );
$contrib_items = fjdf_field( 'fjdf_what_contrib_items', false, [] );
?>

<main id="main" class="site-main what-we-do-page">

	<!-- Hero -->
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
		<div class="container page-hero__content">
			<h1 class="page-hero__headline"><?php echo esc_html( $hero_head ); ?></h1>
			<?php if ( $hero_sub ) : ?>
				<p class="page-hero__subtext"><?php echo esc_html( $hero_sub ); ?></p>
			<?php endif; ?>
		</div>
	</section>

	<!-- Impact Tabs + Stats -->
	<?php if ( ! empty( $tabs ) ) : ?>
		<section class="impact-section section">
			<div class="container">
				<p class="impact-section__label category-label u-text-center"><?php echo esc_html( $impact_label ); ?></p>
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
					<div class="impact-tabpanel <?php echo $i === 0 ? 'is-active' : ''; ?>"
					     role="tabpanel"
					     id="tabpanel-<?php echo esc_attr( $i ); ?>"
					     aria-labelledby="tab-<?php echo esc_attr( $i ); ?>"
					     <?php echo $i !== 0 ? 'hidden' : ''; ?>>
						<?php if ( ! empty( $tab['stats'] ) ) : ?>
							<div class="impact-stats__grid">
								<?php foreach ( $tab['stats'] as $stat ) : ?>
									<div class="impact-stat">
										<strong class="impact-stat__value"><?php echo esc_html( $stat['value'] ); ?></strong>
										<p class="impact-stat__text"><?php echo esc_html( $stat['text'] ); ?></p>
									</div>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		</section>
	<?php endif; ?>

	<!-- Testimonial -->
	<?php if ( $test_quote ) : ?>
		<section class="testimonial-featured section bg-dark">
			<div class="container testimonial-featured__inner">
				<?php if ( ! empty( $test_image['id'] ) ) : ?>
					<div class="testimonial-featured__image">
						<?php echo fjdf_image( $test_image, 'fjdf-portrait', 'testimonial-featured__img' ); ?>
					</div>
				<?php endif; ?>
				<div class="testimonial-featured__content">
					<?php if ( $test_label ) : ?>
						<p class="testimonial-featured__label category-label"><?php echo esc_html( $test_label ); ?></p>
					<?php endif; ?>
					<blockquote class="testimonial-featured__quote">
						<p><?php echo esc_html( $test_quote ); ?></p>
						<footer>
							<?php if ( $test_name ) : ?>
								<cite class="testimonial-featured__name">— <?php echo esc_html( $test_name ); ?></cite>
							<?php endif; ?>
							<?php if ( $test_origin ) : ?>
								<span class="testimonial-featured__origin"><?php echo esc_html( $test_origin ); ?></span>
							<?php endif; ?>
						</footer>
					</blockquote>
					<?php if ( $test_cta_u ) : ?>
						<a href="<?php echo esc_url( $test_cta_u ); ?>" class="btn btn--primary btn--heart">
							<?php echo esc_html( $test_cta_l ); ?>
						</a>
					<?php endif; ?>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<!-- Contribution items -->
	<?php if ( ! empty( $contrib_items ) ) : ?>
		<section class="contrib-section section">
			<div class="container">
				<?php if ( $contrib_label ) : ?>
					<p class="contrib-section__label category-label u-text-center"><?php echo esc_html( $contrib_label ); ?></p>
				<?php endif; ?>
				<?php if ( $contrib_head ) : ?>
					<h2 class="contrib-section__headline"><?php echo esc_html( $contrib_head ); ?></h2>
				<?php endif; ?>
				<div class="contrib-section__grid">
					<?php foreach ( $contrib_items as $item ) : ?>
						<div class="contrib-item">
							<?php if ( ! empty( $item['image']['id'] ) ) : ?>
								<div class="contrib-item__image">
									<?php echo wp_get_attachment_image( $item['image']['id'], 'fjdf-news-card', false, [
										'loading' => 'lazy',
										'alt'     => esc_attr( $item['text'] ?? '' ),
									] ); ?>
								</div>
							<?php endif; ?>
							<p class="contrib-item__text"><?php echo esc_html( $item['text'] ); ?></p>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<?php fjdf_newsletter_section(); ?>

</main>

<?php get_footer(); ?>
