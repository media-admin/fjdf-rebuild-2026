<?php
/**
 * FJDF Theme — footer.php
 *
 * @package fjdf
 */

$fb_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>';
$li_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>';
$ig_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>';
$yt_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M23.495 6.205a3.007 3.007 0 00-2.088-2.088c-1.87-.501-9.396-.501-9.396-.501s-7.507-.01-9.396.501A3.007 3.007 0 00.527 6.205a31.247 31.247 0 00-.522 5.805 31.247 31.247 0 00.522 5.783 3.007 3.007 0 002.088 2.088c1.868.502 9.396.502 9.396.502s7.506 0 9.396-.502a3.007 3.007 0 002.088-2.088 31.247 31.247 0 00.5-5.783 31.247 31.247 0 00-.5-5.805zM9.609 15.601V8.408l6.264 3.602z"/></svg>';
?>

<footer class="site-footer" role="contentinfo">

        <!-- Footer Top: Logo + Navigation zentriert -->
        <div class="site-footer__top">
                <div class="container site-footer__top-inner">

                        <?php $footer_logo = fjdf_option( 'fjdf_footer_logo' ); ?>
                        <?php if ( ! empty( $footer_logo['id'] ) ) : ?>
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-footer__logo">
                                        <?php echo wp_get_attachment_image( $footer_logo['id'], 'fjdf-logo', false, [ 'alt' => get_bloginfo( 'name' ), 'loading' => 'lazy' ] ); ?>
                                </a>
                        <?php else : ?>
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-footer__logo-text"><?php bloginfo( 'name' ); ?></a>
                        <?php endif; ?>

                        <?php wp_nav_menu( [
                                'theme_location'  => 'primary',
                                'container'       => 'nav',
                                'container_class' => 'site-footer__nav',
                                'menu_class'      => 'site-footer__nav-list',
                                'fallback_cb'     => false,
                                'depth'           => 1,
                        ] ); ?>

                </div>
        </div>

        <!-- Footer Middle: Collab links, Social + Email rechts -->
        <div class="site-footer__middle">
                <div class="container site-footer__middle-inner">

                        <div class="site-footer__collab">
                                <span class="site-footer__collab-label"><?php echo esc_html( fjdf_option( 'fjdf_footer_collab_label', __( 'Zusammenarbeit mit:', 'fjdf' ) ) ); ?></span>
                                <?php $collab_logo = fjdf_option( 'fjdf_footer_collab_logo' ); ?>
                                <?php if ( ! empty( $collab_logo['id'] ) ) : ?>
                                        <?php echo wp_get_attachment_image( $collab_logo['id'], 'fjdf-logo', false, [ 'alt' => 'Sinfonía por el Perú', 'loading' => 'lazy', 'class' => 'site-footer__collab-img' ] ); ?>
                                <?php endif; ?>
                        </div>

                        <div class="site-footer__social-wrap">
                                <p class="site-footer__social-label"><?php esc_html_e( 'Lerne Sinfonía por el Perú kennen', 'fjdf' ); ?></p>
                                <ul class="site-footer__social-list" role="list">
                                        <?php
                                        $socials = [
                                                'fjdf_social_facebook'  => [ 'label' => 'Facebook',  'icon' => $fb_icon ],
                                                'fjdf_social_linkedin'  => [ 'label' => 'LinkedIn',  'icon' => $li_icon ],
                                                'fjdf_social_instagram' => [ 'label' => 'Instagram', 'icon' => $ig_icon ],
                                                'fjdf_social_youtube'   => [ 'label' => 'YouTube',   'icon' => $yt_icon ],
                                        ];
                                        foreach ( $socials as $field => $data ) :
                                                $url = fjdf_option( $field );
                                                if ( ! $url ) continue; ?>
                                                <li>
                                                        <a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener noreferrer" class="site-footer__social-link" aria-label="<?php echo esc_attr( $data['label'] ); ?>">
                                                                <?php echo $data['icon']; ?>
                                                        </a>
                                                </li>
                                        <?php endforeach; ?>
                                </ul>

                                <?php $contact_email = fjdf_option( 'fjdf_contact_email', 'kontakt@friendsofjuandiegoflorez.org' ); ?>
                                <?php if ( $contact_email ) : ?>
                                        <p class="site-footer__email">
                                                <?php esc_html_e( 'E-Mail:', 'fjdf' ); ?>
                                                <a href="mailto:<?php echo esc_attr( $contact_email ); ?>" class="site-footer__email-link"><?php echo esc_html( $contact_email ); ?></a>
                                        </p>
                                <?php endif; ?>
                        </div>

                </div>
        </div>

        <!-- Footer Bottom -->
        <div class="site-footer__bottom">
                <div class="container site-footer__bottom-inner">

                        <?php wp_nav_menu( [
                                'theme_location'  => 'footer-legal',
                                'container'       => 'nav',
                                'container_class' => 'site-footer__legal-nav',
                                'menu_class'      => 'site-footer__legal-list',
                                'fallback_cb'     => false,
                                'depth'           => 1,
                        ] ); ?>

                        <p class="site-footer__copyright"><?php echo wp_kses_post( fjdf_copyright() ); ?></p>

                        <?php if ( fjdf_option( 'fjdf_footer_agency_credit', true ) ) : ?>
                                <p class="site-footer__credit">
                                        <?php esc_html_e( 'Website by', 'fjdf' ); ?>
                                        <a href="https://media-lab.at" target="_blank" rel="noopener noreferrer" class="site-footer__credit-link">Media Lab</a>
                                </p>
                        <?php endif; ?>

                </div>
        </div>

</footer>

<?php if ( ! is_page_template( 'page-thank-you.php' ) ) : fjdf_cert_modal(); endif; ?>
<?php wp_footer(); ?>
</body>
</html>
