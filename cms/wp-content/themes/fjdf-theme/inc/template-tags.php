<?php
/**
 * FJDF — Template Tags
 * Reusable output functions for templates.
 *
 * @package fjdf
 */

defined( 'ABSPATH' ) || exit;


/**
 * Output news card
 * Used in listing, single sidebar, home preview.
 *
 * @param int    $post_id Post ID
 * @param string $size    'card' | 'thumb' — image size
 */
function fjdf_news_card( int $post_id, string $size = 'card' ): void {
	$image_size = 'card' === $size ? 'fjdf-news-card' : 'fjdf-news-thumb';

	setup_postdata( get_post( $post_id ) );
	?>
	<article class="news-card" data-post-id="<?php echo esc_attr( $post_id ); ?>">
		<?php if ( has_post_thumbnail( $post_id ) ) : ?>
			<a href="<?php echo esc_url( get_permalink( $post_id ) ); ?>"
			   class="news-card__image-wrap"
			   tabindex="-1"
			   aria-hidden="true">
				<?php echo get_the_post_thumbnail( $post_id, $image_size, [ 'loading' => 'lazy' ] ); ?>
			</a>
		<?php endif; ?>

		<div class="news-card__body">
			<?php fjdf_post_category( $post_id, 'news-card__cat category-label' ); ?>

			<h3 class="news-card__title">
				<a href="<?php echo esc_url( get_permalink( $post_id ) ); ?>">
					<?php echo esc_html( get_the_title( $post_id ) ); ?>
				</a>
			</h3>

			<?php if ( 'card' === $size ) : ?>
				<p class="news-card__excerpt">
					<?php echo esc_html( wp_trim_words( get_the_excerpt( $post_id ), 18, '…' ) ); ?>
				</p>
			<?php endif; ?>

				<p class="news-card__date"><?php echo esc_html( get_the_date( 'j. F Y', $post_id ) ); ?></p>
			<a href="<?php echo esc_url( get_permalink( $post_id ) ); ?>"
			   class="news-card__link"
			   aria-label="<?php printf( esc_attr__( 'Weiterlesen: %s', 'fjdf' ), esc_attr( get_the_title( $post_id ) ) ); ?>">
				<?php esc_html_e( 'Weiterlesen', 'fjdf' ); ?>
				<span aria-hidden="true">›</span>
			</a>
		</div>
	</article>
	<?php
	wp_reset_postdata();
}


/**
 * Output featured news card (large layout)
 *
 * @param int $post_id Post ID
 */
function fjdf_news_card_featured( int $post_id ): void {
	setup_postdata( get_post( $post_id ) );

	$categories = get_the_category( $post_id );
	$cat_name   = ! empty( $categories ) ? strtoupper( $categories[0]->name ) : '';
	?>
	<article class="news-card-featured" data-post-id="<?php echo esc_attr( $post_id ); ?>">
		<?php if ( has_post_thumbnail( $post_id ) ) : ?>
			<a href="<?php echo esc_url( get_permalink( $post_id ) ); ?>"
			   class="news-card-featured__image-wrap"
			   tabindex="-1"
			   aria-hidden="true">
				<?php echo get_the_post_thumbnail( $post_id, 'fjdf-news-featured', [
					'loading'       => 'eager',
					'fetchpriority' => 'high',
				] ); ?>
			</a>
		<?php endif; ?>

		<div class="news-card-featured__body">
			<?php if ( $cat_name ) : ?>
				<span class="news-card-featured__cat category-label"><?php echo esc_html( $cat_name ); ?></span>
			<?php endif; ?>

			<h2 class="news-card-featured__title">
				<a href="<?php echo esc_url( get_permalink( $post_id ) ); ?>">
					<?php echo esc_html( get_the_title( $post_id ) ); ?>
				</a>
			</h2>

			<?php if ( get_the_excerpt( $post_id ) ) : ?>
				<p class="news-card-featured__excerpt">
					<?php echo esc_html( wp_trim_words( get_the_excerpt( $post_id ), 25, '…' ) ); ?>
				</p>
			<?php endif; ?>

				<p class="news-card-featured__date"><?php echo esc_html( get_the_date( 'j. F Y', $post_id ) ); ?></p>
			<a href="<?php echo esc_url( get_permalink( $post_id ) ); ?>"
			   class="news-card-featured__link"
			   aria-label="<?php printf( esc_attr__( 'Weiterlesen: %s', 'fjdf' ), esc_attr( get_the_title( $post_id ) ) ); ?>">
				<?php esc_html_e( 'Weiterlesen', 'fjdf' ); ?>
				<span aria-hidden="true">›</span>
			</a>
		</div>
	</article>
	<?php
	wp_reset_postdata();
}


/**
 * Output other news sidebar (desktop single post)
 *
 * @param int $current_post_id Current post to exclude
 * @param int $count           Number of posts to show
 */
function fjdf_other_news_sidebar( int $current_post_id, int $count = 3 ): void {
	$posts = get_posts( [
		'post_type'      => 'post',
		'posts_per_page' => $count,
		'exclude'        => [ $current_post_id ],
		'orderby'        => 'date',
		'order'          => 'DESC',
	] );

	if ( empty( $posts ) ) {
		return;
	}
	?>
	<aside class="other-news-sidebar" aria-label="<?php esc_attr_e( 'Weitere Beiträge', 'fjdf' ); ?>">
		<p class="other-news-sidebar__label"><?php esc_html_e( 'WEITERE BEITRÄGE', 'fjdf' ); ?></p>
		<ul class="other-news-sidebar__list">
			<?php foreach ( $posts as $post ) : ?>
				<li class="other-news-sidebar__item">
					<a href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>">
						<?php echo esc_html( get_the_title( $post->ID ) ); ?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</aside>
	<?php
}


/**
 * Output partner logos section
 *
 * @param string $class Container CSS class
 */
function fjdf_partner_logos( string $class = 'partners' ): void {
	$label    = fjdf_option( 'fjdf_partners_label',    'PARTNERS' );
	$headline = fjdf_option( 'fjdf_partners_headline', __( 'Danke für Ihre Unterstützung', 'fjdf' ) );
	$partners = fjdf_option( 'fjdf_partners', [] );

	if ( empty( $partners ) ) {
		return;
	}
	?>
	<section class="<?php echo esc_attr( $class ); ?>" aria-label="<?php echo esc_attr( $headline ); ?>">
		<div class="container">
			<p class="<?php echo esc_attr( $class ); ?>__label category-label"><?php echo esc_html( $label ); ?></p>
			<h2 class="<?php echo esc_attr( $class ); ?>__headline"><?php echo esc_html( $headline ); ?></h2>
			<ul class="<?php echo esc_attr( $class ); ?>__list" role="list">
				<?php foreach ( $partners as $partner ) :
					$logo = $partner['logo'] ?? [];
					$name = $partner['name'] ?? '';
					$url  = $partner['url']  ?? '';
				?>
					<li class="<?php echo esc_attr( $class ); ?>__item">
						<?php if ( $url ) : ?>
							<a href="<?php echo esc_url( $url ); ?>"
							   target="_blank"
							   rel="noopener noreferrer"
							   aria-label="<?php echo esc_attr( $name ); ?>">
						<?php endif; ?>

						<?php if ( ! empty( $logo['id'] ) ) : ?>
							<?php echo wp_get_attachment_image( $logo['id'], 'fjdf-logo', false, [
								'alt'     => esc_attr( $name ),
								'loading' => 'lazy',
							] ); ?>
						<?php elseif ( $name ) : ?>
							<span><?php echo esc_html( $name ); ?></span>
						<?php endif; ?>

						<?php if ( $url ) : ?>
							</a>
						<?php endif; ?>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>
	<?php
}


/**
 * Output breadcrumb (single post)
 */
function fjdf_breadcrumb(): void {
	$archive_link  = get_post_type_archive_link( 'post' );
	$archive_label = __( 'Aktuelles', 'fjdf' );
	?>
	<nav class="breadcrumb" aria-label="<?php esc_attr_e( 'Breadcrumb', 'fjdf' ); ?>">
		<ol class="breadcrumb__list" itemscope itemtype="https://schema.org/BreadcrumbList">
			<li class="breadcrumb__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" itemprop="item">
					<span itemprop="name"><?php esc_html_e( 'Startseite', 'fjdf' ); ?></span>
				</a>
				<meta itemprop="position" content="1" />
			</li>
			<li class="breadcrumb__separator" aria-hidden="true">/</li>
			<li class="breadcrumb__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
				<a href="<?php echo esc_url( $archive_link ?: home_url( '/aktuelles/' ) ); ?>" itemprop="item">
					<span itemprop="name"><?php echo esc_html( $archive_label ); ?></span>
				</a>
				<meta itemprop="position" content="2" />
			</li>
		</ol>
	</nav>
	<?php
}
