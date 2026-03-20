    </div><!-- #content .site-content -->

    <?php
    $ogape_contact_email = ogape_get_contact_email();
    $wa                  = ogape_get_whatsapp_url();
    $wa_display          = ogape_get_whatsapp_display();
    $waitlist_url        = ogape_get_waitlist_url();
    $privacidad_page     = get_page_by_path( 'privacidad' );
    $terminos_page       = get_page_by_path( 'terminos' );
    ?>

    <!-- Site Footer -->
    <footer id="colophon" class="footer" role="contentinfo">
        <div class="container">
            <div class="footer__grid">

                <div class="footer__brand">
                    <div class="footer__logo-mark"><?php ogape_render_logo(); ?></div>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer__logo"><?php bloginfo( 'name' ); ?></a>
                    <p class="footer__tagline">Comida fresca y cuidada, pensada para Paraguay.</p>
                    <p class="footer__brand-copy">
                        <?php esc_html_e( 'Estamos abriendo con foco: una sola experiencia activa para acompañar el lanzamiento y ordenar la demanda del piloto.', 'ogape-child' ); ?>
                    </p>
                </div>

                <div class="footer__columns">
                    <div class="footer__nav">
                        <h3 class="footer__nav-title"><?php esc_html_e( 'Lista de espera', 'ogape-child' ); ?></h3>
                        <ul class="footer__menu">
                            <li><a href="<?php echo esc_url( $waitlist_url ); ?>"><?php esc_html_e( 'Unirme ahora', 'ogape-child' ); ?></a></li>
                        </ul>
                    </div>

                    <div class="footer__contact">
                        <h3 class="footer__nav-title"><?php esc_html_e( 'Contacto', 'ogape-child' ); ?></h3>
                        <div class="footer__contact-list">
                            <?php if ( $wa ) : ?>
                                <a href="<?php echo esc_url( $wa ); ?>" class="footer__contact-link" target="_blank" rel="noopener noreferrer">WhatsApp: <?php echo esc_html( $wa_display ); ?></a>
                            <?php endif; ?>
                            <?php if ( $ogape_contact_email ) : ?>
                                <a href="mailto:<?php echo esc_attr( $ogape_contact_email ); ?>" class="footer__contact-link"><?php echo esc_html( $ogape_contact_email ); ?></a>
                            <?php endif; ?>
                            <a href="https://www.instagram.com/ogapechefpy" class="footer__contact-link" target="_blank" rel="noopener noreferrer">Instagram</a>
                            <a href="https://x.com/ogapechefpy" class="footer__contact-link" target="_blank" rel="noopener noreferrer">X.com</a>
                            <a href="https://facebook.com/ogapechef1" class="footer__contact-link" target="_blank" rel="noopener noreferrer">Facebook</a>
                        </div>
                        <p class="footer__contact-note"><?php esc_html_e( 'Consultas sobre cobertura, piloto y lanzamiento.', 'ogape-child' ); ?></p>
                    </div>
                </div>

            </div><!-- .footer__grid -->

            <div class="footer__legal">
                <p>&copy; <?php echo esc_html( date( 'Y' ) ); ?> Ogape</p>
                <div class="footer__legal-links">
                    <?php if ( $privacidad_page ) : ?>
                        <a href="<?php echo esc_url( get_permalink( $privacidad_page ) ); ?>"><?php esc_html_e( 'Privacidad', 'ogape-child' ); ?></a>
                    <?php endif; ?>
                    <?php if ( $terminos_page ) : ?>
                        <a href="<?php echo esc_url( get_permalink( $terminos_page ) ); ?>"><?php esc_html_e( 'Términos', 'ogape-child' ); ?></a>
                    <?php endif; ?>
                </div>
            </div>

        </div><!-- .container -->
    </footer><!-- #colophon -->

</div><!-- #page .site -->

<?php wp_footer(); ?>

</body>
</html>
