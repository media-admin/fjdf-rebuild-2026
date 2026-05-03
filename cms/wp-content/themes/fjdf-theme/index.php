<?php
/**
 * FJDF Theme — Fallback Template
 * WordPress erfordert diese Datei.
 * Alle eigentlichen Templates liegen in den jeweiligen page-*.php / single.php Dateien.
 *
 * @package fjdf
 */

get_header(); ?>

<main id="main" class="site-main">
	<div class="container">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<article <?php post_class(); ?>>
				<h1><?php the_title(); ?></h1>
				<div class="entry-content">
					<?php the_content(); ?>
				</div>
			</article>
		<?php endwhile; endif; ?>
	</div>
</main>

<?php get_footer();
