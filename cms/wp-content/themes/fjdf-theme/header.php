<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#main">
	<?php esc_html_e( 'Zum Inhalt springen', 'fjdf' ); ?>
</a>


<header class="site-header" id="site-header" role="banner">
	<?php
		$logo_w_desktop = fjdf_option( 'logo_desktop_width' );
		$logo_w_mobile  = fjdf_option( 'logo_mobile_width' );
		$header_style = '';
		if ( $logo_w_desktop ) $header_style .= '--logo-w-desktop: ' . intval( $logo_w_desktop ) . 'px;';
		if ( $logo_w_mobile )  $header_style .= '--logo-w-mobile: ' . intval( $logo_w_mobile ) . 'px;';
		?>
		<div class="site-header__inner container"<?php if ( $header_style ) echo ' style="' . esc_attr( $header_style ) . '"'; ?>>

		<!-- Logo -->
		<a class="site-header__logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php bloginfo( 'name' ); ?> – <?php esc_attr_e( 'Zur Startseite', 'fjdf' ); ?>">
			<?php
			if ( has_custom_logo() ) :
				the_custom_logo();
			else : ?>
				<span class="site-header__logo-text"><?php bloginfo( 'name' ); ?></span>
			<?php endif; ?>
		</a>

		<!-- Desktop Navigation -->
		<nav class="site-nav" id="site-nav" aria-label="<?php esc_attr_e( 'Hauptnavigation', 'fjdf' ); ?>">
			<?php
			wp_nav_menu( [
				'theme_location' => 'primary',
				'container'      => false,
				'menu_class'     => 'site-nav__list',
				'fallback_cb'    => false,
				'depth'          => 2,
				'walker'         => class_exists( 'FJDF_Nav_Walker' ) ? new FJDF_Nav_Walker() : null,
			] );
			?>
		</nav>

                <!-- Language Switcher -->
                <?php if ( function_exists( 'pll_the_languages' ) ) : ?>
                <ul class="site-header__lang-switcher">
                        <?php pll_the_languages( [ 'show_flags' => 0, 'show_names' => 1, 'display_names_as' => 'slug', 'echo' => 1 ] ); ?>
                </ul>
                <?php endif; ?>
		<!-- CTA Button -->
		<?php
		$cta_url   = fjdf_option( 'fjdf_floating_url' ) ?: get_page_link( get_page_by_path( 'spenden' ) );
		$cta_label = fjdf_option( 'fjdf_header_cta_label', __( 'Jetzt spenden', 'fjdf' ) );
		if ( $cta_url ) : ?>
			<a href="<?php echo esc_url( $cta_url ); ?>" class="site-header__cta btn btn--primary btn--heart-circle">
				<?php echo esc_html( $cta_label ); ?>
                        <span class="btn__heart" aria-hidden="true"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg></span>			</a>
		<?php endif; ?>

		<!-- Mobile Hamburger -->
		<button class="site-header__hamburger"
		        id="nav-toggle"
		        aria-expanded="false"
		        aria-controls="site-nav"
		        aria-label="<?php esc_attr_e( 'Menü öffnen', 'fjdf' ); ?>">
			<span class="site-header__hamburger-bar"></span>
			<span class="site-header__hamburger-bar"></span>
			<span class="site-header__hamburger-bar"></span>
		</button>

	</div><!-- .site-header__inner -->
</header><!-- .site-header -->
