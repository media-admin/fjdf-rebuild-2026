<?php
/**
 * FJDF — 404.php
 * @package fjdf
 */

get_header();
?>

<main id="main" class="site-main error-404-page">
	<div class="container error-404">
		<h1 class="error-404__code">404</h1>
		<h2 class="error-404__title"><?php esc_html_e( 'Página no encontrada', 'fjdf' ); ?></h2>
		<p class="error-404__text">
			<?php esc_html_e( 'Lo sentimos, la página que buscas no existe o ha sido movida.', 'fjdf' ); ?>
		</p>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--primary">
			<?php esc_html_e( 'Volver al inicio', 'fjdf' ); ?>
		</a>
	</div>
</main>

<?php get_footer(); ?>
