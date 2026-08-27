<?php
/**
 * FJDF — 404.php
 * @package fjdf
 */

get_header();
?>

<main id="main" class="site-main error-404-page">
	<div class="container error-404">
		<div class="error-404__inner">
			<h1 class="error-404__code">404</h1>
			<h2 class="error-404__title"><?php echo esc_html( fjdf_str( 'Seite nicht gefunden' ) ); ?></h2>
			<p class="error-404__message">
				<?php echo esc_html( fjdf_str( 'Entschuldigung, die gesuchte Seite existiert nicht oder wurde verschoben.' ) ); ?>
			</p>
			<div class="error-404__actions">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--primary">
					<?php echo esc_html( fjdf_str( 'Zurück zur Startseite' ) ); ?>
				</a>
			</div>
		</div>
	</div>
</main>

<?php get_footer(); ?>