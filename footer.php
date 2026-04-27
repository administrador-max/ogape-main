    </div><!-- #content .site-content -->

    <?php
    $footer_wa            = ogape_get_whatsapp_url();
    $footer_wa_display    = ogape_get_whatsapp_display();
    $footer_contact_email = ogape_get_contact_email();
    $footer_orders_email  = 'pedidos@ogape.com.py';
    $footer_logo_url      = get_stylesheet_directory_uri() . '/assets/img/ogape-logo.svg';
    $footer_how_url       = home_url( '/como-funciona/' );
    $footer_menu_url      = home_url( '/menu/' );
    $footer_plans_url     = home_url( '/planes/' );
    $footer_coverage_url  = home_url( '/cobertura/' );
    $footer_privacy_url   = home_url( '/privacidad/' );
    $footer_terms_url     = home_url( '/terminos/' );
    $footer_contact_url   = home_url( '/contacto/' );
    ?>

    <!-- Site Footer -->
    <footer id="colophon" class="foot" role="contentinfo">
        <div class="container">
            <div class="foot__top">
                <div>
                    <div class="foot__brand">
                        <img src="<?php echo esc_url( $footer_logo_url ); ?>" alt="">
                        <div>
                            <div class="foot__wordmark">Ogape</div>
                            <span class="foot__where">Tu Chef en Casa</span>
                        </div>
                    </div>
                    <p class="foot__copy">Recetas semanales, listas para cocinar en 30 minutos.</p>
                </div>
                <div class="foot__col">
                    <h4>El producto</h4>
                    <ul>
                        <li><a href="<?php echo esc_url( $footer_how_url ); ?>">Cómo funciona</a></li>
                        <li><a href="<?php echo esc_url( $footer_menu_url ); ?>">Menú de la semana</a></li>
                        <li><a href="<?php echo esc_url( $footer_plans_url ); ?>">Cajas &amp; precios</a></li>
                        <li><a href="<?php echo esc_url( $footer_coverage_url ); ?>">Zonas de entrega</a></li>
                    </ul>
                </div>
                <div class="foot__col">
                    <h4>Contacto</h4>
                    <ul>
                        <?php if ( $footer_wa ) : ?>
                            <li><a href="<?php echo esc_url( $footer_wa ); ?>">WhatsApp <?php echo esc_html( $footer_wa_display ); ?></a></li>
                        <?php endif; ?>
                        <?php if ( $footer_contact_email ) : ?>
                            <li><a href="mailto:<?php echo esc_attr( $footer_contact_email ); ?>"><?php echo esc_html( $footer_contact_email ); ?></a></li>
                        <?php endif; ?>
                        <li><a href="mailto:<?php echo esc_attr( $footer_orders_email ); ?>"><?php echo esc_html( $footer_orders_email ); ?></a></li>
                    </ul>
                </div>
                <div class="foot__col">
                    <h4>Calendario</h4>
                    <ul>
                        <li><span>Pedidos cierran · martes 23:59</span></li>
                        <li><span>Entrega · jueves 10 – 19 h</span></li>
                        <li><span>Menú nuevo · todos los viernes</span></li>
                    </ul>
                </div>
            </div>
            <div class="foot__legal">
                <span>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> Ogape Tu Chef en Casa</span>
                <span>
                    <a href="<?php echo esc_url( $footer_privacy_url ); ?>">Privacidad</a> ·
                    <a href="<?php echo esc_url( $footer_terms_url ); ?>">Términos</a> ·
                    <a href="<?php echo esc_url( $footer_contact_url ); ?>">Contacto</a>
                </span>
            </div>
        </div><!-- .container -->
    </footer><!-- #colophon -->

</div><!-- #page .site -->

<?php wp_footer(); ?>

</body>
</html>
