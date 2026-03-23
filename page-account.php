<?php
/**
 * Template Name: Account
 * Template Post Type: page
 *
 * Official Ogape account area shell.
 */

get_header();
?>

<main id="main" class="site-main" role="main">
    <?php
    get_template_part(
        'templates/components/editorial-page-hero',
        null,
        array(
            'eyebrow'  => __( 'My Account', 'ogape-child' ),
            'title'    => __( 'Your future Ogape account area.', 'ogape-child' ),
            'subtitle' => __( 'This shell defines the structure for account overview, orders, subscriptions, addresses, preferences, and support.', 'ogape-child' ),
        )
    );
    ?>

    <section class="editorial-page-section editorial-page-section--narrow account-dashboard-section">
        <div class="container">
            <div class="account-dashboard-shell glass-card">
                <aside class="account-dashboard-shell__sidebar">
                    <p class="section__label"><?php esc_html_e( 'Account navigation', 'ogape-child' ); ?></p>
                    <ul class="account-dashboard-shell__nav">
                        <li><a href="#"><?php esc_html_e( 'Overview', 'ogape-child' ); ?></a></li>
                        <li><a href="#"><?php esc_html_e( 'Orders', 'ogape-child' ); ?></a></li>
                        <li><a href="#"><?php esc_html_e( 'Subscriptions', 'ogape-child' ); ?></a></li>
                        <li><a href="#"><?php esc_html_e( 'Addresses', 'ogape-child' ); ?></a></li>
                        <li><a href="#"><?php esc_html_e( 'Preferences', 'ogape-child' ); ?></a></li>
                        <li><a href="#"><?php esc_html_e( 'Gift Cards', 'ogape-child' ); ?></a></li>
                    </ul>
                </aside>

                <div class="account-dashboard-shell__content">
                    <div class="account-stat-grid">
                        <div class="account-stat-card">
                            <span><?php esc_html_e( 'Next delivery', 'ogape-child' ); ?></span>
                            <strong><?php esc_html_e( 'Not connected yet', 'ogape-child' ); ?></strong>
                        </div>
                        <div class="account-stat-card">
                            <span><?php esc_html_e( 'Active plan', 'ogape-child' ); ?></span>
                            <strong><?php esc_html_e( 'Pending implementation', 'ogape-child' ); ?></strong>
                        </div>
                        <div class="account-stat-card">
                            <span><?php esc_html_e( 'Saved addresses', 'ogape-child' ); ?></span>
                            <strong><?php esc_html_e( '0 linked', 'ogape-child' ); ?></strong>
                        </div>
                    </div>

                    <div class="account-panel-card">
                        <h2><?php esc_html_e( 'Overview panel', 'ogape-child' ); ?></h2>
                        <p><?php esc_html_e( 'This live shell gives us a connected destination for the new Login entry point. Next steps are wiring real auth, customer profile data, and order/subscription modules.', 'ogape-child' ); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
