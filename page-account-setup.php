<?php
/**
 * Template Name: Account Setup
 * Template Post Type: page
 *
 * Official Ogape account setup shell.
 */

get_header();

$account_url       = home_url( '/account/' );
$account_setup_url = add_query_arg( 'setup', 'complete', $account_url );
?>

<main id="main" class="site-main" role="main">
    <section class="future-site-hero account-hero-shell">
        <div class="container">
            <div class="future-site-hero__grid">
                <div class="future-site-hero__content glass-card">
                    <p class="future-site-hero__eyebrow"><?php esc_html_e( 'Configuración inicial', 'ogape-child' ); ?></p>
                    <h1 class="future-site-hero__title"><?php esc_html_e( 'La cuenta se completa mejor con un onboarding corto y útil.', 'ogape-child' ); ?></h1>
                    <p class="future-site-hero__subtitle"><?php esc_html_e( 'Esta etapa conecta el alta de cuenta con dirección, preferencias y contexto de compra, para que el dashboard tenga sentido desde el primer ingreso.', 'ogape-child' ); ?></p>
                    <ul class="future-site-hero__trust">
                        <li><?php esc_html_e( 'Dirección principal', 'ogape-child' ); ?></li>
                        <li><?php esc_html_e( 'Preferencias alimentarias', 'ogape-child' ); ?></li>
                        <li><?php esc_html_e( 'Base para recomendaciones futuras', 'ogape-child' ); ?></li>
                    </ul>
                </div>

                <div class="future-site-hero__panel glass-card">
                    <div class="account-setup-shell">
                        <div class="account-setup-stepper">
                            <span class="account-setup-stepper__item account-setup-stepper__item--active">1. Dirección</span>
                            <span class="account-setup-stepper__item">2. Preferencias</span>
                            <span class="account-setup-stepper__item">3. Confirmación</span>
                        </div>
                        <div class="account-entry-shell__header">
                            <h3><?php esc_html_e( 'Configurar cuenta', 'ogape-child' ); ?></h3>
                            <p><?php esc_html_e( 'Template visual de onboarding inicial.', 'ogape-child' ); ?></p>
                        </div>
                        <form class="account-entry-form account-entry-form--setup" action="<?php echo esc_url( $account_setup_url ); ?>" method="get">
                            <p class="account-entry-form__demo-note"><?php esc_html_e( 'Demo interactivo: esta configuración aún no guarda datos, pero ya habilita la experiencia de prueba.', 'ogape-child' ); ?></p>
                            <label class="account-entry-form__field"><span><?php esc_html_e( 'Barrio / zona', 'ogape-child' ); ?></span><input type="text" name="zone" placeholder="Asunción"></label>
                            <label class="account-entry-form__field"><span><?php esc_html_e( 'Dirección principal', 'ogape-child' ); ?></span><input type="text" name="address" placeholder="Calle, número, referencia"></label>
                            <label class="account-entry-form__field"><span><?php esc_html_e( 'Preferencia principal', 'ogape-child' ); ?></span><input type="text" name="preference" placeholder="Ej. cenas livianas"></label>
                            <label class="account-entry-form__field"><span><?php esc_html_e( 'Notas de entrega', 'ogape-child' ); ?></span><input type="text" name="notes" placeholder="Opcional"></label>
                            <button type="submit" class="btn btn--primary btn--md account-entry-form__button"><?php esc_html_e( 'Guardar y continuar', 'ogape-child' ); ?></button>
                        </form>
                        <div class="account-entry-shell__actions">
                            <a href="<?php echo esc_url( $account_url ); ?>?fresh=1"><?php esc_html_e( 'Ver dashboard', 'ogape-child' ); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
