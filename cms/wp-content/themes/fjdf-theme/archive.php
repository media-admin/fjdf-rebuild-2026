<?php
/**
 * FJDF — archive.php
 * News listing — WordPress standard post archive
 *
 * @package fjdf
 */

get_header();

$featured_post = fjdf_get_featured_news();
$featured_id   = $featured_post ? $featured_post->ID : 0;
?>

<main id="main" class="site-main news-page">

	<!-- Page Header -->
	<div class="archive-header section--sm">
		<div class="container">
			<h1 class="archive-header__title"><?php esc_html_e( 'Aktuelles', 'fjdf' ); ?></h1>
			<p class="archive-header__desc">
				<?php esc_html_e( 'Erfahren Sie die neuesten Nachrichten und Ereignisse rund um Sinfonía por el Perú und wie Ihr Beitrag vielen Kindern und Jugendlichen in Peru zugutekommen kann.', 'fjdf' ); ?>
			</p>
		</div>
	</div>

	<!-- Featured Post -->
	<?php if ( $featured_post ) : ?>
		<section class="section--sm">
			<div class="container">
				<?php fjdf_news_card_featured( $featured_id ); ?>
			</div>
		</section>
	<?php endif; ?>

	<!-- Other News Grid -->
	<?php
	$paged      = get_query_var( 'paged', 1 );
	$news_query = new WP_Query( [
		'post_type'      => 'post',
		'post_status'    => 'publish',
		'posts_per_page' => 6,
		'paged'          => $paged,
		'post__not_in'   => $featured_id ? [ $featured_id ] : [],
		'orderby'        => 'date',
		'order'          => 'DESC',
	] );
	?>

	<?php if ( $news_query->have_posts() ) : ?>
		<section class="other-news section--sm">
			<div class="container">
				<h2 class="other-news__title"><?php esc_html_e( 'Weitere Beiträge', 'fjdf' ); ?></h2>

				<div class="other-news__grid"
				     id="news-grid"
				     data-featured="<?php echo esc_attr( $featured_id ); ?>">
					<?php while ( $news_query->have_posts() ) : $news_query->the_post(); ?>
						<?php fjdf_news_card( get_the_ID() ); ?>
					<?php endwhile; wp_reset_postdata(); ?>
				</div>

				<?php if ( $news_query->max_num_pages > 1 ) : ?>
					<div class="other-news__more">
						<button class="btn btn--outline load-more-btn"
						        id="load-more-news"
						        data-page="2"
						        data-max="<?php echo esc_attr( $news_query->max_num_pages ); ?>"
						        data-exclude="<?php echo esc_attr( $featured_id ); ?>">
							<?php esc_html_e( 'Mehr anzeigen', 'fjdf' ); ?>
							<span class="load-more-btn__icon" aria-hidden="true">↓</span>
						</button>
					</div>
				<?php endif; ?>

			</div>
		</section>
	<?php endif; ?>

	<?php fjdf_newsletter_section(); ?>

</main>

<?php get_footer(); ?>
