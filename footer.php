    </div><!-- #content .site-content -->

    <?php
    $ogape_contact_email    = ogape_get_contact_email();
    $wa                     = ogape_get_whatsapp_url();
    $wa_display             = ogape_get_whatsapp_display();
    $menu_page           = get_page_by_path( 'menu' );
    $nosotros_page       = get_page_by_path( 'nosotros' );
    $faq_page            = get_page_by_path( 'faq' );
    $como_funciona_page  = get_page_by_path( 'como-funciona' );
    $mision_page         = get_page_by_path( 'mision' );
    $privacidad_page     = get_page_by_path( 'politica-de-privacidad' );
    $terminos_page       = get_page_by_path( 'terminos-y-condiciones' );

    $links_navigation = array(
        array(
            'label' => __( 'Menú', 'ogape-child' ),
            'url'   => $menu_page ? get_permalink( $menu_page ) : '',
        ),
        array(
            'label' => __( 'Cómo funciona', 'ogape-child' ),
            'url'   => $como_funciona_page ? get_permalink( $como_funciona_page ) : home_url( '/#features' ),
        ),
        array(
            'label' => __( 'Preguntas frecuentes', 'ogape-child' ),
            'url'   => $faq_page ? get_permalink( $faq_page ) : '',
        ),
    );

    $links_company = array(
        array(
            'label' => __( 'Nosotros', 'ogape-child' ),
            'url'   => $nosotros_page ? get_permalink( $nosotros_page ) : '',
        ),
        array(
            'label' => __( 'Misión y propuesta', 'ogape-child' ),
            'url'   => $mision_page ? get_permalink( $mision_page ) : ( $nosotros_page ? get_permalink( $nosotros_page ) . '#nosotros-mision' : '' ),
        ),
    );

    $render_footer_links = static function( $links ) {
        $has_links = false;
        foreach ( $links as $link ) {
            if ( ! empty( $link['url'] ) ) {
                $has_links = true;
                break;
            }
        }

        if ( ! $has_links ) {
            return;
        }

        echo '<ul class="footer__menu">';
        foreach ( $links as $link ) {
            if ( empty( $link['url'] ) ) {
                continue;
            }

            printf(
                '<li><a href="%1$s">%2$s</a></li>',
                esc_url( $link['url'] ),
                esc_html( $link['label'] )
            );
        }
        echo '</ul>';
    };
    ?>

    <!-- Site Footer -->
    <footer id="colophon" class="footer" role="contentinfo">
        <div class="container">
            <div class="footer__grid">

                <div class="footer__brand">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer__logo"><?php bloginfo( 'name' ); ?></a>
                    <p class="footer__tagline">Comida fresca y cuidada, pensada para Paraguay.</p>
                    <p class="footer__brand-copy">
                        <?php esc_html_e( 'Piloto inicial en Asunción con una selección breve y confiable.', 'ogape-child' ); ?>
                    </p>
                </div>

                <div class="footer__columns">
                    <div class="footer__nav">
                        <h3 class="footer__nav-title"><?php esc_html_e( 'Navegación', 'ogape-child' ); ?></h3>
                        <?php $render_footer_links( $links_navigation ); ?>
                    </div>

                    <div class="footer__nav">
                        <h3 class="footer__nav-title"><?php esc_html_e( 'Empresa', 'ogape-child' ); ?></h3>
                        <?php $render_footer_links( $links_company ); ?>
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
                            <a href="https://www.instagram.com/ogapepy" class="footer__contact-link" target="_blank" rel="noopener noreferrer">Instagram</a>
                        </div>
                        <p class="footer__contact-note"><?php esc_html_e( 'Consultas sobre cobertura, piloto y alianzas.', 'ogape-child' ); ?></p>
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
