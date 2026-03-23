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
            'eyebrow'  => __( 'Account', 'ogape-child' ),
            'title'    => __( 'Log in to your Ogape account.', 'ogape-child' ),
            'subtitle' => __( 'This is the first live account-entry shell for the official site. From here we can build orders, subscriptions, saved addresses, preferences, and gift-card flows.', 'ogape-child' ),
        )
    );
    ?>

    <section class="editorial-page-section editorial-page-section--narrow account-entry-section">
        <div class="container">
            <div class="editorial-page-card glass-card editorial-page-card--split account-entry-card">
                <div class="editorial-page-card__copy">
                    <p class="section__label"><?php esc_html_e( 'Login', 'ogape-child' ); ?></p>
                    <h2 class="section__heading"><?php esc_html_e( 'Customer account access starts here.', 'ogape-child' ); ?></h2>
                    <p class="editorial-page-card__lead">
                        <?php esc_html_e( 'For now this page acts as the official entry point while we connect the full authentication and account system behind it.', 'ogape-child' ); ?>
                    </p>

                    <ul class="editorial-checklist">
                        <li><?php esc_html_e( 'Upcoming orders and delivery tracking', 'ogape-child' ); ?></li>
                        <li><?php esc_html_e( 'Saved addresses and account preferences', 'ogape-child' ); ?></li>
                        <li><?php esc_html_e( 'Subscriptions, gift cards, and support access', 'ogape-child' ); ?></li>
                    </ul>
                </div>

                <div class="editorial-page-card__visual account-entry-card__panel">
                    <div class="account-entry-shell">
                        <div class="account-entry-shell__header">
                            <h3><?php esc_html_e( 'Account Access', 'ogape-child' ); ?></h3>
                            <p><?php esc_html_e( 'UI draft now live.', 'ogape-child' ); ?></p>
                        </div>

                        <form class="account-entry-form" action="#" method="post" onsubmit="return false;">
                            <label class="account-entry-form__field">
                                <span><?php esc_html_e( 'Email', 'ogape-child' ); ?></span>
                                <input type="email" placeholder="name@example.com" disabled>
                            </label>

                            <label class="account-entry-form__field">
                                <span><?php esc_html_e( 'Password', 'ogape-child' ); ?></span>
                                <input type="password" placeholder="••••••••" disabled>
                            </label>

                            <button type="button" class="btn btn--primary btn--md account-entry-form__button" disabled>
                                <?php esc_html_e( 'Log in', 'ogape-child' ); ?>
                            </button>
                        </form>

                        <div class="account-entry-shell__actions">
                            <a href="<?php echo esc_url( $register_url ); ?>"><?php esc_html_e( 'Create account', 'ogape-child' ); ?></a>
                            <a href="<?php echo esc_url( $account_url ); ?>"><?php esc_html_e( 'Preview account area', 'ogape-child' ); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
