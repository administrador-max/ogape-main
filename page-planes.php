<?php
/**
 * Template Name: Planes
 * Template Post Type: page
 */

get_header();

$waitlist_page = get_page_by_path( 'waitlist' );
$register_page = get_page_by_path( 'register' );
$waitlist_url  = $waitlist_page ? get_permalink( $waitlist_page ) : home_url( '/waitlist/' );
$register_url  = $register_page ? get_permalink( $register_page ) : home_url( '/register/' );
?>

<main id="main" class="site-main" role="main">
    <?php
    get_template_part(
        'templates/components/editorial-page-hero',
        null,
        array(
            'eyebrow'  => __( 'Planes', 'ogape-child' ),
            'title'    => __( 'Distintas formas de entrar a Ogape según tu ritmo, tu hogar y el nivel de continuidad que buscás.', 'ogape-child' ),
            'subtitle' => __( 'La idea no es ofrecer complejidad artificial. Es ordenar la propuesta para que probar, repetir o regalar Ogape se sienta claro desde el primer vistazo.', 'ogape-child' ),
        )
    );
    ?>

    <section class="editorial-page-section">
        <div class="container">
            <div class="future-plan-grid">
                <article class="future-plan-card glass-card">
                    <span class="future-plan-card__badge">Empezar</span>
                    <h3>Plan Básico</h3>
                    <p>La forma más simple de conocer la propuesta, probar formatos y entender si Ogape encaja con tu rutina.</p>
                    <div class="future-plan-card__meta">1–2 personas · flexible</div>
                    <ul>
                        <li>Entrada con menos fricción</li>
                        <li>Ideal para primeras compras</li>
                        <li>Perfecto para descubrir favoritos</li>
                    </ul>
                    <a href="<?php echo esc_url( $waitlist_url ); ?>" class="future-plan-card__link">Empezar</a>
                </article>

                <article class="future-plan-card glass-card future-plan-card--featured">
                    <span class="future-plan-card__badge">Más elegido</span>
                    <h3>Plan Hogar</h3>
                    <p>La propuesta central: más continuidad, mejor orden semanal y una relación más útil con el menú y la cuenta.</p>
                    <div class="future-plan-card__meta">2–4 personas · semanal</div>
                    <ul>
                        <li>Más valor para repetir</li>
                        <li>Organización real para el hogar</li>
                        <li>Mejor base para preferencias y cuenta</li>
                    </ul>
                    <a href="<?php echo esc_url( $register_url ); ?>?fresh=1" class="future-plan-card__link">Crear cuenta</a>
                </article>

                <article class="future-plan-card glass-card">
                    <span class="future-plan-card__badge">Premium</span>
                    <h3>Plan Signature</h3>
                    <p>Una versión más cuidada para ocasiones, regalos o clientes que quieren una experiencia con más peso de marca.</p>
                    <div class="future-plan-card__meta">especial · gifting</div>
                    <ul>
                        <li>Presentación más premium</li>
                        <li>Ideal para regalo o campañas</li>
                        <li>Más espacio para experiencias especiales</li>
                    </ul>
                    <a href="<?php echo esc_url( home_url( '/tarjetas-regalo/' ) ); ?>" class="future-plan-card__link">Ver regalos</a>
                </article>
            </div>
        </div>
    </section>

    <section class="editorial-page-section editorial-page-section--narrow">
        <div class="container">
            <div class="editorial-page-card glass-card">
                <p class="section__label">Cómo elegir</p>
                <h2 class="section__heading">No todos entran a Ogape por la misma razón.</h2>
                <p class="section__sub editorial-page-card__lead">Algunos quieren resolver la semana. Otros probar sin compromiso. Otros regalar algo útil y bien presentado. Los planes ordenan esa lógica comercial sin volverla confusa.</p>
                <div class="editorial-inline-actions">
                    <a href="<?php echo esc_url( $waitlist_url ); ?>" class="btn btn--secondary btn--md">Lista de espera</a>
                    <a href="<?php echo esc_url( home_url( '/menu/' ) ); ?>" class="btn btn--primary btn--md">Ver menú</a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
