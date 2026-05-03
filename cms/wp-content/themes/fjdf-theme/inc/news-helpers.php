<?php
/**
 * FJDF — News Helpers
 * Post query helper functions for news / posts.
 *
 * @package fjdf
 */

defined( 'ABSPATH' ) || exit;


/**
 * Query latest posts
 *
 * @param int    $count    Number of posts
 * @param int    $exclude  Post ID to exclude
 * @param string $category Category slug (optional)
 */
function fjdf_get_news( int $count = 6, int $exclude = 0, string $category = '' ): WP_Query {
	$args = [
		'post_type'      => 'post',
		'post_status'    => 'publish',
		'posts_per_page' => $count,
		'orderby'        => 'date',
		'order'          => 'DESC',
		'no_found_rows'  => false,
	];

	if ( $exclude > 0 ) {
		$args['post__not_in'] = [ $exclude ];
	}

	if ( ! empty( $category ) ) {
		$args['category_name'] = $category;
	}

	return new WP_Query( $args );
}


/**
 * Get featured post (most recent)
 */
function fjdf_get_featured_news(): ?WP_Post {
	$query = new WP_Query( [
		'post_type'      => 'post',
		'post_status'    => 'publish',
		'posts_per_page' => 1,
		'orderby'        => 'date',
		'order'          => 'DESC',
		'no_found_rows'  => true,
	] );

	if ( $query->have_posts() ) {
		return $query->posts[0];
	}

	return null;
}


/**
 * Output news archive pagination
 */
function fjdf_news_pagination(): void {
	$pagination = paginate_links( [
		'type'      => 'array',
		'prev_text' => '‹',
		'next_text' => '›',
	] );

	if ( empty( $pagination ) ) {
		return;
	}
	?>
	<nav class="news-pagination" aria-label="<?php esc_attr_e( 'Seitennavigation', 'fjdf' ); ?>">
		<ul class="news-pagination__list">
			<?php foreach ( $pagination as $page ) : ?>
				<li class="news-pagination__item"><?php echo $page; // phpcs:ignore ?></li>
			<?php endforeach; ?>
		</ul>
	</nav>
	<?php
}


/**
 * AJAX: Load more news
 * Handler for "Mehr anzeigen" button in news archive.
 */
function fjdf_ajax_load_more_news(): void {
	check_ajax_referer( 'fjdf_nonce', 'nonce' );

	$page     = absint( $_POST['page'] ?? 1 );
	$per_page = 6;
	$exclude  = absint( $_POST['exclude'] ?? 0 );

	$query = new WP_Query( [
		'post_type'      => 'post',
		'post_status'    => 'publish',
		'posts_per_page' => $per_page,
		'paged'          => $page,
		'orderby'        => 'date',
		'order'          => 'DESC',
		'post__not_in'   => $exclude ? [ $exclude ] : [],
	] );

	if ( ! $query->have_posts() ) {
		wp_send_json_error( [ 'message' => __( 'Keine weiteren Beiträge.', 'fjdf' ) ] );
	}

	ob_start();
	while ( $query->have_posts() ) {
		$query->the_post();
		fjdf_news_card( get_the_ID() );
	}
	wp_reset_postdata();
	$html = ob_get_clean();

	wp_send_json_success( [
		'html'     => $html,
		'has_more' => $query->max_num_pages > $page,
	] );
}

add_action( 'wp_ajax_fjdf_load_more_news',        'fjdf_ajax_load_more_news' );
add_action( 'wp_ajax_nopriv_fjdf_load_more_news', 'fjdf_ajax_load_more_news' );
