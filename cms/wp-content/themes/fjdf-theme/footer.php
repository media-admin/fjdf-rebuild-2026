<?php
/**
 * FJDF Theme — footer.php
 *
 * @package fjdf
 */
?>

<footer class="site-footer" role="contentinfo">

        <!-- Footer Top: Logo + Navigation zentriert -->
        <div class="site-footer__top">
                <div class="container site-footer__top-inner">

                        <?php
                        $footer_logo = fjdf_option( 'fjdf_footer_logo' );
                        if ( ! empty( $footer_logo['id'] ) ) : ?>
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-footer__logo">
                                        <?php echo wp_get_attachment_image( $footer_logo['id'], 'fjdf-logo', false, [
                                                'alt'     => get_bloginfo( 'name' ),
                                                'loading' => 'lazy',
                                        ] ); ?>
                                </a>
                        <?php else : ?>
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-footer__logo-text">
                                        <?php bloginfo( 'name' ); ?>
                                </a>
                        <?php endif; ?>

                        <!-- Hauptnavigation -->
                        <?php
                        wp_nav_menu( [
                                'theme_location'  => 'primary',
                                'container'       => 'nav',
                                'container_class' => 'site-footer__nav',
                                'container_attr'  => [ 'aria-label' => __( 'Footer Navigation', 'fjdf' ) ],
                                'menu_class'      => 'site-footer__nav-list',
                                'fallback_cb'     => false,
                                'depth'           => 1,
                        ] );
                        ?>

                </div>
        </div><!-- .site-footer__top -->

        <!-- Footer Middle: Collab links, Social + Email rechts -->
        <div class="site-footer__middle">
                <div class="container site-footer__middle-inner">

                        <!-- Collaboration -->
                        <?php
                        $collab_label = fjdf_option( 'fjdf_footer_collab_label', __( 'Colaboración con:', 'fjdf' ) );
                        $collab_logo  = fjdf_option( 'fjdf_footer_collab_logo' );
                        ?>
                        <div class="site-footer__collab">
                                <span class="site-footer__collab-label"><?php echo esc_html( $collab_label ); ?></span>
                                <?php if ( ! empty( $collab_logo['id'] ) ) : ?>
                                        <?php echo wp_get_attachment_image( $collab_logo['id'], 'fjdf-logo', false, [
                                                'alt'     => 'Sinfonía por el Perú',
                                                'loading' => 'lazy',
                                        ] ); ?>
                                <?php endif; ?>
                        </div>

                        <!-- Social + Email -->
                        <div class="site-footer__social-wrap">
                                <ul class="site-footer__social-list" role="list">
                                        <?php
                                        $socials = [
                                                'fjdf_social_facebook'  => 'Facebook',
                                                'fjdf_social_linkedin'  => 'LinkedIn',
                                                'fjdf_social_instagram' => 'Instagram',
                                                'fjdf_social_youtube'   => 'YouTube',
                                        ];
                                        foreach ( $socials as $field => $label ) :
                                                $url = fjdf_option( $field );
                                                if ( ! $url ) continue;
                                        ?>
                                                <li>
                                                        <a href="<?php echo esc_url( $url ); ?>"
                                                           target="_blank"
                                                           rel="noopener noreferrer"
                                                           class="site-footer__social-link"
                                                           aria-label="<?php echo esc_attr( $label ); ?>">
                                                                <?php echo esc_html( $label ); ?>
                                                        </a>
                                                </li>
                                        <?php endforeach; ?>
                                </ul>

                                <?php $contact_email = fjdf_option( 'fjdf_contact_email', 'kontakt@friendsofjuandiegoflorez.org' ); ?>
                                <?php if ( $contact_email ) : ?>
                                        <p class="site-footer__email">
                                                <?php esc_html_e( 'E-Mail:', 'fjdf' ); ?>
                                                <a href="mailto:<?php echo esc_attr( $contact_email ); ?>" class="site-footer__email-link">
                                                        <?php echo esc_html( $contact_email ); ?>
                                                </a>
                                        </p>
                                <?php endif; ?>
                        </div>

                </div>
        </div><!-- .site-footer__middle -->

        <!-- Footer Bottom: Legal + Copyright -->
        <div class="site-footer__bottom">
                <div class="container site-footer__bottom-inner">

                        <?php
                        wp_nav_menu( [
                                'theme_location'  => 'footer-legal',
                                'container'       => 'nav',
                                'container_class' => 'site-footer__legal-nav',
                                'container_attr'  => [ 'aria-label' => __( 'Rechtliche Links', 'fjdf' ) ],
                                'menu_class'      => 'site-footer__legal-list',
                                'fallback_cb'     => false,
                                'depth'           => 1,
                        ] );
                        ?>

                        <p class="site-footer__copyright">
                                <?php echo wp_kses_post( fjdf_copyright() ); ?>
                        </p>

                        <?php if ( fjdf_option( 'fjdf_footer_agency_credit', true ) ) : ?>
                                <p class="site-footer__credit">
                                        <?php esc_html_e( 'Website by', 'fjdf' ); ?>
                                        <a href="https://media-lab.at"
                                           target="_blank"
                                           rel="noopener noreferrer"
                                           class="site-footer__credit-link">Media Lab</a>
                                </p>
                        <?php endif; ?>

                </div>
        </div><!-- .site-footer__bottom -->

</footer><!-- .site-footer -->

<?php
if ( ! is_page_template( 'page-thank-you.php' ) ) :
        fjdf_cert_modal();
endif;
?>

<?php wp_footer(); ?>
</body>
</html>
