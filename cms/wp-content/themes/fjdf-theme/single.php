<?php
/**
 * FJDF — single.php
 * Single post / article detail
 *
 * Layout (desktop): content column left | other news sidebar right
 * Layout (mobile):  single column + carousel
 *
 * @package fjdf
 */

get_header();
the_post();
?>

<main id="main" class="site-main single-post-page">

	<div class="container single-post-layout">

		<!-- ARTICLE CONTENT -->
		<article class="single-post" <?php post_class(); ?>>

			<?php fjdf_breadcrumb(); ?>

			<header class="single-post__header">
				<?php fjdf_post_category( get_the_ID(), 'single-post__cat category-label' ); ?>
				<h1 class="single-post__title"><?php the_title(); ?></h1>
				<?php if ( get_the_excerpt() ) : ?>
					<p class="single-post__excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
				<?php endif; ?>
			</header>

			<?php if ( has_post_thumbnail() ) : ?>
				<div class="single-post__image">
					<?php the_post_thumbnail( 'fjdf-article-header', [
						'loading'       => 'eager',
						'fetchpriority' => 'high',
						'class'         => 'single-post__img',
					] ); ?>
				</div>
			<?php endif; ?>

			<div class="single-post__content entry-content">
				<?php the_content(); ?>
			</div>

			<!-- Mobile: Other News Carousel -->
			<aside class="single-post__mobile-news" aria-label="<?php esc_attr_e( 'Weitere Beiträge', 'fjdf' ); ?>">
				<h2 class="single-post__mobile-news-title"><?php esc_html_e( 'Weitere Beiträge', 'fjdf' ); ?></h2>

				<?php
				$other_posts = get_posts( [
					'post_type'      => 'post',
					'posts_per_page' => 4,
					'exclude'        => [ get_the_ID() ],
					'orderby'        => 'date',
					'order'          => 'DESC',
				] );
				?>
				<?php if ( ! empty( $other_posts ) ) : ?>
					<div class="other-news-carousel swiper" aria-roledescription="<?php esc_attr_e( 'Karussell', 'fjdf' ); ?>">
						<div class="swiper-wrapper">
							<?php foreach ( $other_posts as $other ) : ?>
								<div class="swiper-slide" role="group">
									<?php fjdf_news_card( $other->ID, 'card' ); ?>
								</div>
							<?php endforeach; ?>
						</div>
						<div class="swiper-pagination other-news-carousel__pagination"></div>
						<button class="swiper-button-prev" aria-label="<?php esc_attr_e( 'Vorheriges', 'fjdf' ); ?>"></button>
						<button class="swiper-button-next" aria-label="<?php esc_attr_e( 'Nächstes', 'fjdf' ); ?>"></button>
					</div>
				<?php endif; ?>
			</aside>

		</article>

		<!-- SIDEBAR: OTHER NEWS (desktop) -->
		<?php fjdf_other_news_sidebar( get_the_ID(), 3 ); ?>

	</div><!-- .single-post-layout -->

	<?php fjdf_newsletter_section(); ?>

</main>

<?php get_footer(); ?>
