<?php
/**
 * Template Name: Login
 * Template Post Type: page
 *
 * Official Ogape account entry shell.
 */

get_header();

$register_url = home_url( '/register/' );
$account_url  = home_url( '/account/' );
?>

<main id="main" class="site-main" role="main">

    <?php
    get_template_part(
        'templates/components/editorial-page-hero',
        null,
        array(
            'eyebrow'  => __( 'Cuenta', 'ogape-child' ),
            'title'    => __( 'Iniciá sesión en tu cuenta Ogape.', 'ogape-child' ),
            'subtitle' => __( 'Este es el primer acceso visible del sistema de cuenta del sitio oficial. Desde acá vamos a conectar pedidos, suscripciones, direcciones guardadas, preferencias y gift cards.', 'ogape-child' ),
        )
    );
    ?>

    <section class="editorial-page-section editorial-page-section--narrow account-entry-section">
        <div class="container">
            <div class="editorial-page-card glass-card editorial-page-card--split account-entry-card">
                <div class="editorial-page-card__copy">
                    <p class="section__label"><?php esc_html_e( 'Acceso', 'ogape-child' ); ?></p>
                    <h2 class="section__heading"><?php esc_html_e( 'La entrada a la cuenta del cliente empieza acá.', 'ogape-child' ); ?></h2>
                    <p class="editorial-page-card__lead">
                        <?php esc_html_e( 'Por ahora esta página funciona como punto oficial de entrada mientras conectamos la autenticación real y el sistema completo de cuenta.', 'ogape-child' ); ?>
                    </p>

                    <ul class="editorial-checklist">
                        <li><?php esc_html_e( 'Próximos pedidos y seguimiento de entrega', 'ogape-child' ); ?></li>
                        <li><?php esc_html_e( 'Direcciones guardadas y preferencias de cuenta', 'ogape-child' ); ?></li>
                        <li><?php esc_html_e( 'Suscripciones, gift cards y acceso a soporte', 'ogape-child' ); ?></li>
                    </ul>
                </div>

                <div class="editorial-page-card__visual account-entry-card__panel">
                    <div class="account-entry-shell">
                        <div class="account-entry-shell__header">
                            <h3><?php esc_html_e( 'Acceso a cuenta', 'ogape-child' ); ?></h3>
                            <p><?php esc_html_e( 'Primer borrador visual ya en línea.', 'ogape-child' ); ?></p>
                        </div>

                        <form class="account-entry-form" action="#" method="post" onsubmit="return false;">
                            <label class="account-entry-form__field">
                                <span><?php esc_html_e( 'Email', 'ogape-child' ); ?></span>
                                <input type="email" placeholder="nombre@ejemplo.com" disabled>
                            </label>

                            <label class="account-entry-form__field">
                                <span><?php esc_html_e( 'Password', 'ogape-child' ); ?></span>
                                <input type="password" placeholder="••••••••" disabled>
                            </label>

                            <button type="button" class="btn btn--primary btn--md account-entry-form__button" disabled>
                                <?php esc_html_e( 'Iniciar sesión', 'ogape-child' ); ?>
                            </button>
                        </form>

                        <div class="account-entry-shell__actions">
                            <a href="<?php echo esc_url( $register_url ); ?>"><?php esc_html_e( 'Crear cuenta', 'ogape-child' ); ?></a>
                            <a href="<?php echo esc_url( $account_url ); ?>"><?php esc_html_e( 'Ver área de cuenta', 'ogape-child' ); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
