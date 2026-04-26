<?php
/**
 * Ogape Ops — weekly box CPTs, helpers, and admin panel.
 * Loaded by functions.php via require.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// ── DELIVERY ZONES ───────────────────────────────────────────────────────────

function ogape_delivery_zones() {
    return array(
        'villa-morra'    => 'Villa Morra',
        'recoleta'       => 'Recoleta',
        'las-carmelitas' => 'Las Carmelitas',
        'mburucuya'      => 'Mburucuyá',
        'ykua-sati'      => 'Ykua Satí',
        'centro'         => 'Centro',
    );
}

// ── CPT REGISTRATION ─────────────────────────────────────────────────────────

function ogape_register_cpts() {
    register_post_type(
        'ogape_caja',
        array(
            'label'    => 'Cajas',
            'labels'   => array(
                'name'          => 'Cajas semanales',
                'singular_name' => 'Caja semanal',
            ),
            'public'   => false,
            'show_ui'  => false,
            'supports' => array( 'title' ),
        )
    );

    register_post_type(
        'ogape_recipe',
        array(
            'label'    => 'Recetas',
            'labels'   => array(
                'name'          => 'Recetas',
                'singular_name' => 'Receta',
            ),
            'public'   => false,
            'show_ui'  => false,
            'supports' => array( 'title', 'thumbnail', 'editor' ),
        )
    );
}
add_action( 'init', 'ogape_register_cpts' );

// ── STATUS DEFINITIONS ───────────────────────────────────────────────────────

function ogape_caja_statuses() {
    return array(
        'planning'   => 'Planificando',
        'confirmed'  => 'Pedido confirmado',
        'preparing'  => 'Ingredientes preparados',
        'in_transit' => 'En camino',
        'delivered'  => 'Entregada',
    );
}

function ogape_caja_status_next( $current ) {
    $keys = array_keys( ogape_caja_statuses() );
    $idx  = array_search( $current, $keys, true );
    if ( false === $idx || $idx >= count( $keys ) - 1 ) {
        return null;
    }
    return $keys[ $idx + 1 ];
}

function ogape_caja_status_label( $status ) {
    $map = ogape_caja_statuses();
    return $map[ $status ] ?? $status;
}

// ── CAJA HELPERS ─────────────────────────────────────────────────────────────

function ogape_get_current_caja() {
    $today = ( new DateTimeImmutable( 'today', wp_timezone() ) )->format( 'Y-m-d' );

    $posts = get_posts( array(
        'post_type'      => 'ogape_caja',
        'post_status'    => 'publish',
        'posts_per_page' => 1,
        'orderby'        => 'meta_value',
        'meta_key'       => '_ogape_delivery_date',
        'order'          => 'ASC',
        'meta_query'     => array(
            array(
                'key'     => '_ogape_delivery_date',
                'value'   => $today,
                'compare' => '>=',
                'type'    => 'DATE',
            ),
        ),
    ) );

    if ( $posts ) {
        return $posts[0];
    }

    $posts = get_posts( array(
        'post_type'      => 'ogape_caja',
        'post_status'    => 'publish',
        'posts_per_page' => 1,
        'orderby'        => 'meta_value',
        'meta_key'       => '_ogape_delivery_date',
        'order'          => 'DESC',
    ) );

    return $posts ? $posts[0] : null;
}

function ogape_get_caja_status_for_zone( $caja_id, $zone_key ) {
    if ( $zone_key ) {
        $overrides = get_post_meta( $caja_id, '_ogape_status_by_zone', true );
        if ( is_array( $overrides ) && ! empty( $overrides[ $zone_key ] ) ) {
            return $overrides[ $zone_key ];
        }
    }
    return get_post_meta( $caja_id, '_ogape_global_status', true ) ?: 'planning';
}

/**
 * Returns a context array for the customer-facing delivery tracker.
 * Falls back to null if no caja has been created yet.
 */
function ogape_get_caja_context( $zone_key = '' ) {
    $caja = ogape_get_current_caja();
    if ( ! $caja ) {
        return null;
    }

    $id            = $caja->ID;
    $status        = ogape_get_caja_status_for_zone( $id, $zone_key );
    $delivery_date = get_post_meta( $id, '_ogape_delivery_date', true );
    $week_number   = (int) ( get_post_meta( $id, '_ogape_week_number', true ) ?: 1 );
    $eta_by_zone   = get_post_meta( $id, '_ogape_eta_by_zone', true );
    $eta           = is_array( $eta_by_zone ) && ! empty( $eta_by_zone[ $zone_key ] ) ? $eta_by_zone[ $zone_key ] : '';

    $dt = null;
    if ( $delivery_date ) {
        try {
            $dt = new DateTimeImmutable( $delivery_date, wp_timezone() );
        } catch ( Exception $e ) {
            $dt = null;
        }
    }

    return array(
        'id'                  => $id,
        'week_number'         => str_pad( $week_number, 2, '0', STR_PAD_LEFT ),
        'status'              => $status,
        'status_label'        => ogape_caja_status_label( $status ),
        'delivery_date'       => $delivery_date,
        'delivery_dt'         => $dt,
        'delivery_label'      => $dt && function_exists( 'ogape_demo_format_date_label' )
                                    ? ogape_demo_format_date_label( $dt ) : '',
        'delivery_label_year' => $dt && function_exists( 'ogape_demo_format_date_label' )
                                    ? ogape_demo_format_date_label( $dt, true ) : '',
        'delivery_numeric'    => $dt ? $dt->format( 'd/m/Y' ) : '',
        'eta'                 => $eta,
    );
}

// ── ADMIN MENU ───────────────────────────────────────────────────────────────

function ogape_ops_admin_menu() {
    add_menu_page(
        'Ogape Ops',
        'Ogape Ops',
        'manage_options',
        'ogape-ops',
        'ogape_ops_semana_page',
        'dashicons-store',
        3
    );
    add_submenu_page(
        'ogape-ops',
        'Semana actual',
        'Semana actual',
        'manage_options',
        'ogape-ops',
        'ogape_ops_semana_page'
    );
    add_submenu_page(
        'ogape-ops',
        'Clientes',
        'Clientes',
        'manage_options',
        'ogape-clientes',
        'ogape_ops_clientes_page'
    );
    add_submenu_page(
        'ogape-ops',
        'Recetas',
        'Recetas',
        'manage_options',
        'ogape-recetas',
        'ogape_ops_recetas_page'
    );
}
add_action( 'admin_menu', 'ogape_ops_admin_menu' );

// ── POST ACTION HANDLERS ──────────────────────────────────────────────────────

function ogape_ops_handle_advance_status() {
    check_admin_referer( 'ogape_advance_status' );
    if ( ! current_user_can( 'manage_options' ) ) wp_die( 'No autorizado.' );

    $caja_id = (int) ( $_POST['caja_id'] ?? 0 );
    if ( ! $caja_id ) wp_die( 'Caja no válida.' );

    $current = get_post_meta( $caja_id, '_ogape_global_status', true ) ?: 'planning';
    $next    = ogape_caja_status_next( $current );
    if ( $next ) {
        update_post_meta( $caja_id, '_ogape_global_status', $next );
        do_action( 'ogape_caja_status_changed', $caja_id, $next, $current );
    }

    wp_safe_redirect( admin_url( 'admin.php?page=ogape-ops&updated=status' ) );
    exit;
}
add_action( 'admin_post_ogape_advance_status', 'ogape_ops_handle_advance_status' );

function ogape_ops_handle_zone_status() {
    check_admin_referer( 'ogape_zone_status' );
    if ( ! current_user_can( 'manage_options' ) ) wp_die( 'No autorizado.' );

    $caja_id  = (int) ( $_POST['caja_id'] ?? 0 );
    $zone_key = sanitize_key( $_POST['zone_key'] ?? '' );
    $status   = sanitize_key( $_POST['zone_status'] ?? '' );

    if ( ! $caja_id || ! $zone_key ) wp_die( 'Datos incompletos.' );

    $valid = array_keys( ogape_caja_statuses() );
    if ( $status && ! in_array( $status, $valid, true ) ) wp_die( 'Estado no válido.' );

    $overrides = get_post_meta( $caja_id, '_ogape_status_by_zone', true );
    if ( ! is_array( $overrides ) ) $overrides = array();

    if ( '' === $status ) {
        unset( $overrides[ $zone_key ] );
    } else {
        $overrides[ $zone_key ] = $status;
    }
    update_post_meta( $caja_id, '_ogape_status_by_zone', $overrides );

    wp_safe_redirect( admin_url( 'admin.php?page=ogape-ops&updated=zone' ) );
    exit;
}
add_action( 'admin_post_ogape_zone_status', 'ogape_ops_handle_zone_status' );

function ogape_ops_handle_zone_eta() {
    check_admin_referer( 'ogape_zone_eta' );
    if ( ! current_user_can( 'manage_options' ) ) wp_die( 'No autorizado.' );

    $caja_id  = (int) ( $_POST['caja_id'] ?? 0 );
    $zone_key = sanitize_key( $_POST['zone_key'] ?? '' );
    $eta      = sanitize_text_field( wp_unslash( $_POST['eta'] ?? '' ) );

    if ( ! $caja_id || ! $zone_key ) wp_die( 'Datos incompletos.' );

    $eta_map = get_post_meta( $caja_id, '_ogape_eta_by_zone', true );
    if ( ! is_array( $eta_map ) ) $eta_map = array();

    if ( '' === $eta ) {
        unset( $eta_map[ $zone_key ] );
    } else {
        $eta_map[ $zone_key ] = $eta;
    }
    update_post_meta( $caja_id, '_ogape_eta_by_zone', $eta_map );

    wp_safe_redirect( admin_url( 'admin.php?page=ogape-ops&updated=eta' ) );
    exit;
}
add_action( 'admin_post_ogape_zone_eta', 'ogape_ops_handle_zone_eta' );

function ogape_ops_handle_create_caja() {
    check_admin_referer( 'ogape_create_caja' );
    if ( ! current_user_can( 'manage_options' ) ) wp_die( 'No autorizado.' );

    $delivery_date = sanitize_text_field( wp_unslash( $_POST['delivery_date'] ?? '' ) );
    $week_number   = absint( $_POST['week_number'] ?? 0 );

    if ( ! $delivery_date || ! $week_number ) {
        wp_safe_redirect( admin_url( 'admin.php?page=ogape-ops&error=missing' ) );
        exit;
    }

    $dt = DateTimeImmutable::createFromFormat( 'Y-m-d', $delivery_date, wp_timezone() );
    if ( ! $dt ) {
        wp_safe_redirect( admin_url( 'admin.php?page=ogape-ops&error=date' ) );
        exit;
    }

    $label      = function_exists( 'ogape_demo_format_date_label' ) ? ogape_demo_format_date_label( $dt, true ) : $delivery_date;
    $post_title = 'Caja N.° ' . str_pad( $week_number, 2, '0', STR_PAD_LEFT ) . ' · ' . $label;

    $post_id = wp_insert_post( array(
        'post_type'   => 'ogape_caja',
        'post_title'  => wp_strip_all_tags( $post_title ),
        'post_status' => 'publish',
    ) );

    if ( is_wp_error( $post_id ) ) {
        wp_safe_redirect( admin_url( 'admin.php?page=ogape-ops&error=create' ) );
        exit;
    }

    update_post_meta( $post_id, '_ogape_week_number', $week_number );
    update_post_meta( $post_id, '_ogape_delivery_date', $delivery_date );
    update_post_meta( $post_id, '_ogape_global_status', 'planning' );

    wp_safe_redirect( admin_url( 'admin.php?page=ogape-ops&created=' . $post_id ) );
    exit;
}
add_action( 'admin_post_ogape_create_caja', 'ogape_ops_handle_create_caja' );

// ── ADMIN PAGE: SEMANA ACTUAL ─────────────────────────────────────────────────

function ogape_ops_semana_page() {
    if ( ! current_user_can( 'manage_options' ) ) return;

    $caja     = ogape_get_current_caja();
    $zones    = ogape_delivery_zones();
    $statuses = ogape_caja_statuses();
    $updated  = sanitize_key( $_GET['updated'] ?? '' );
    $err      = sanitize_key( $_GET['error'] ?? '' );
    $created  = (int) ( $_GET['created'] ?? 0 );

    // Suggest values for "create next week" form.
    if ( $caja ) {
        $last_num     = (int) get_post_meta( $caja->ID, '_ogape_week_number', true );
        $last_date_s  = get_post_meta( $caja->ID, '_ogape_delivery_date', true );
        $suggest_num  = $last_num + 1;
        $suggest_date = $last_date_s
            ? ( new DateTimeImmutable( $last_date_s, wp_timezone() ) )->modify( '+7 days' )->format( 'Y-m-d' )
            : ( new DateTimeImmutable( 'next thursday', wp_timezone() ) )->format( 'Y-m-d' );
    } else {
        $suggest_num  = 1;
        $suggest_date = ( new DateTimeImmutable( 'next thursday', wp_timezone() ) )->format( 'Y-m-d' );
    }

    ?>
    <div class="wrap">
        <h1 class="wp-heading-inline">Ogape Ops &mdash; Semana actual</h1>
        <hr class="wp-header-end">

        <?php if ( $updated ) : ?>
            <div class="notice notice-success is-dismissible"><p>Guardado correctamente.</p></div>
        <?php elseif ( $created ) : ?>
            <div class="notice notice-success is-dismissible"><p>Caja creada con ID <?php echo (int) $created; ?>.</p></div>
        <?php elseif ( $err ) : ?>
            <div class="notice notice-error is-dismissible"><p>Error: <?php echo esc_html( $err ); ?>. Revisá los datos.</p></div>
        <?php endif; ?>

        <?php if ( ! $caja ) : ?>
            <div class="notice notice-warning inline"><p><strong>No hay ninguna caja activa.</strong> Creá la primera semana en el formulario de abajo.</p></div>
        <?php else :
            $caja_id       = $caja->ID;
            $global_status = get_post_meta( $caja_id, '_ogape_global_status', true ) ?: 'planning';
            $zone_statuses = get_post_meta( $caja_id, '_ogape_status_by_zone', true );
            if ( ! is_array( $zone_statuses ) ) $zone_statuses = array();
            $eta_map       = get_post_meta( $caja_id, '_ogape_eta_by_zone', true );
            if ( ! is_array( $eta_map ) ) $eta_map = array();
            $delivery_date = get_post_meta( $caja_id, '_ogape_delivery_date', true );
            $week_number   = (int) ( get_post_meta( $caja_id, '_ogape_week_number', true ) ?: 1 );
            $next_status   = ogape_caja_status_next( $global_status );
            $status_keys   = array_keys( $statuses );
            $g_idx         = array_search( $global_status, $status_keys, true );
            ?>

            <!-- Current caja summary -->
            <div style="background:#fff;border:1px solid #c3c4c7;border-radius:4px;padding:20px 24px;margin:16px 0 0">
                <div style="display:flex;justify-content:space-between;align-items:flex-start;gap:16px;flex-wrap:wrap">
                    <div>
                        <h2 style="margin:0 0 4px;font-size:18px"><?php echo esc_html( $caja->post_title ); ?></h2>
                        <p style="margin:0;color:#50575e;font-size:13px">
                            Entrega: <strong><?php echo esc_html( $delivery_date ); ?></strong>
                            &nbsp;·&nbsp; Semana N.° <strong><?php echo (int) $week_number; ?></strong>
                        </p>
                    </div>
                    <div style="display:flex;align-items:center;gap:10px">
                        <span style="padding:4px 12px;border-radius:20px;font-size:12px;font-weight:600;white-space:nowrap;
                            background:<?php echo 'in_transit' === $global_status ? '#fff3cd' : ( 'delivered' === $global_status ? '#d4edda' : ( 'planning' === $global_status ? '#f0f0f0' : '#e8f0fe' ) ); ?>;
                            color:<?php echo 'in_transit' === $global_status ? '#856404' : ( 'delivered' === $global_status ? '#155724' : ( 'planning' === $global_status ? '#50575e' : '#1a56db' ) ); ?>">
                            <?php echo esc_html( ogape_caja_status_label( $global_status ) ); ?>
                        </span>
                        <?php if ( $next_status ) : ?>
                            <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" style="margin:0">
                                <input type="hidden" name="action" value="ogape_advance_status">
                                <input type="hidden" name="caja_id" value="<?php echo (int) $caja_id; ?>">
                                <?php wp_nonce_field( 'ogape_advance_status' ); ?>
                                <button type="submit" class="button button-primary">
                                    Avanzar &rarr; <?php echo esc_html( ogape_caja_status_label( $next_status ) ); ?>
                                </button>
                            </form>
                        <?php else : ?>
                            <span style="color:#888;font-size:13px">Estado final alcanzado</span>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Progress bar -->
                <div style="display:flex;gap:0;margin-top:16px;border-radius:4px;overflow:hidden;border:1px solid #ddd">
                    <?php foreach ( $statuses as $s_key => $s_label ) :
                        $s_idx = array_search( $s_key, $status_keys, true );
                        $bg    = $s_idx < $g_idx ? '#1a56db' : ( $s_key === $global_status ? '#2563eb' : '#f6f7f7' );
                        $color = $s_idx <= $g_idx ? '#fff' : '#9ca3af';
                        ?>
                        <div style="flex:1;padding:6px 4px;text-align:center;font-size:11px;font-weight:600;background:<?php echo esc_attr( $bg ); ?>;color:<?php echo esc_attr( $color ); ?>;border-right:1px solid rgba(255,255,255,.25)">
                            <?php echo esc_html( $s_label ); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Zone controls -->
            <h2 style="margin-top:28px">Estado y ETA por zona</h2>
            <table class="widefat striped" style="margin-bottom:24px">
                <thead>
                    <tr>
                        <th style="width:160px">Zona</th>
                        <th style="width:320px">Estado (override)</th>
                        <th style="width:260px">ETA estimada</th>
                        <th>Estado activo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ( $zones as $z_key => $z_name ) :
                        $z_status = $zone_statuses[ $z_key ] ?? '';
                        $z_eta    = $eta_map[ $z_key ] ?? '';
                        $active   = $z_status ? ogape_caja_status_label( $z_status ) : ogape_caja_status_label( $global_status ) . ' <em>(global)</em>';
                        ?>
                        <tr>
                            <td><strong><?php echo esc_html( $z_name ); ?></strong></td>
                            <td>
                                <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" style="display:flex;gap:6px;align-items:center">
                                    <input type="hidden" name="action" value="ogape_zone_status">
                                    <input type="hidden" name="caja_id" value="<?php echo (int) $caja_id; ?>">
                                    <input type="hidden" name="zone_key" value="<?php echo esc_attr( $z_key ); ?>">
                                    <?php wp_nonce_field( 'ogape_zone_status' ); ?>
                                    <select name="zone_status" style="font-size:12px">
                                        <option value="">— Igual que global —</option>
                                        <?php foreach ( $statuses as $s_key => $s_label ) : ?>
                                            <option value="<?php echo esc_attr( $s_key ); ?>"<?php selected( $z_status, $s_key ); ?>><?php echo esc_html( $s_label ); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <button type="submit" class="button button-small">Guardar</button>
                                </form>
                            </td>
                            <td>
                                <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" style="display:flex;gap:6px;align-items:center">
                                    <input type="hidden" name="action" value="ogape_zone_eta">
                                    <input type="hidden" name="caja_id" value="<?php echo (int) $caja_id; ?>">
                                    <input type="hidden" name="zone_key" value="<?php echo esc_attr( $z_key ); ?>">
                                    <?php wp_nonce_field( 'ogape_zone_eta' ); ?>
                                    <input type="text" name="eta" value="<?php echo esc_attr( $z_eta ); ?>" placeholder="10:30 – 11:15" style="font-size:12px;width:110px">
                                    <button type="submit" class="button button-small">Guardar</button>
                                </form>
                            </td>
                            <td style="font-size:12px;color:#50575e"><?php echo wp_kses( $active, array( 'em' => array() ) ); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Subscribers -->
            <?php
            $subscribers = get_users( array(
                'meta_key'   => 'ogape_zone',
                'meta_query' => array(
                    array( 'key' => 'ogape_zone', 'compare' => 'EXISTS' ),
                ),
                'number'  => 500,
                'orderby' => 'meta_value',
            ) );
            ?>
            <h2>Suscriptores de esta semana (<?php echo count( $subscribers ); ?>)</h2>
            <?php if ( $subscribers ) : ?>
                <table class="widefat striped" style="margin-bottom:24px">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Zona</th>
                            <th>Dirección</th>
                            <th>Horario</th>
                            <th>Plan</th>
                            <th>Notas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ( $subscribers as $u ) :
                            $uz      = get_user_meta( $u->ID, 'ogape_zone', true );
                            $uaddr   = trim( get_user_meta( $u->ID, 'ogape_address', true ) . ', ' . get_user_meta( $u->ID, 'ogape_apt', true ), ', ' );
                            $uwin    = get_user_meta( $u->ID, 'ogape_delivery_window_label', true );
                            $up      = get_user_meta( $u->ID, 'ogape_people', true );
                            $ur      = get_user_meta( $u->ID, 'ogape_recipes', true );
                            $unotes  = get_user_meta( $u->ID, 'ogape_notes', true );
                            ?>
                            <tr>
                                <td><strong><?php echo esc_html( $u->display_name ); ?></strong><br><span style="font-size:11px;color:#888"><?php echo esc_html( $u->user_email ); ?></span></td>
                                <td><?php echo esc_html( $uz ); ?></td>
                                <td><?php echo esc_html( $uaddr ); ?></td>
                                <td style="font-size:12px"><?php echo esc_html( $uwin ); ?></td>
                                <td style="font-size:12px"><?php echo $up ? 'Para ' . esc_html( $up ) . ' · ' . esc_html( $ur ) . ' rec.' : '—'; ?></td>
                                <td style="font-size:12px;color:#666"><?php echo esc_html( $unotes ); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else : ?>
                <p style="color:#888">Ningún cliente registrado todavía.</p>
            <?php endif; ?>

            <!-- Recipe assignment -->
            <?php
            $all_recipes      = get_posts( array( 'post_type' => 'ogape_recipe', 'numberposts' => 100, 'orderby' => 'title', 'order' => 'ASC' ) );
            $assigned_ids_raw = get_post_meta( $caja_id, '_ogape_recipe_ids', true );
            $assigned_ids     = is_array( $assigned_ids_raw ) ? array_map( 'intval', $assigned_ids_raw ) : array();
            ?>
            <h2 style="margin-top:28px">Recetas de esta semana</h2>
            <?php if ( $all_recipes ) : ?>
                <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" style="background:#fff;border:1px solid #c3c4c7;border-radius:4px;padding:16px 24px;margin-bottom:24px">
                    <input type="hidden" name="action" value="ogape_assign_recipes">
                    <input type="hidden" name="caja_id" value="<?php echo (int) $caja_id; ?>">
                    <?php wp_nonce_field( 'ogape_assign_recipes' ); ?>
                    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:8px;margin-bottom:14px">
                        <?php foreach ( $all_recipes as $rp ) : ?>
                            <label style="display:flex;align-items:center;gap:8px;font-size:13px;cursor:pointer">
                                <input type="checkbox" name="recipe_ids[]" value="<?php echo (int) $rp->ID; ?>"<?php checked( in_array( $rp->ID, $assigned_ids, true ) ); ?>>
                                <?php echo esc_html( $rp->post_title ); ?>
                                <span style="font-size:11px;color:#888">#<?php echo (int) $rp->ID; ?></span>
                            </label>
                        <?php endforeach; ?>
                    </div>
                    <button type="submit" class="button button-primary button-small">Guardar asignación</button>
                    <a href="<?php echo esc_url( admin_url( 'admin.php?page=ogape-recetas' ) ); ?>" class="button button-small" style="margin-left:8px">Administrar recetas</a>
                </form>
            <?php else : ?>
                <p style="color:#888">No hay recetas creadas todavía. <a href="<?php echo esc_url( admin_url( 'admin.php?page=ogape-recetas' ) ); ?>">Crear recetas →</a></p>
            <?php endif; ?>

        <?php endif; ?>

        <!-- Create next week -->
        <div style="background:#fff;border:1px solid #c3c4c7;border-radius:4px;padding:20px 24px;margin-top:8px">
            <h2 style="margin:0 0 16px">Crear semana siguiente</h2>
            <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
                <input type="hidden" name="action" value="ogape_create_caja">
                <?php wp_nonce_field( 'ogape_create_caja' ); ?>
                <table class="form-table" role="presentation">
                    <tr>
                        <th scope="row"><label for="week_number">N.° de semana</label></th>
                        <td><input type="number" id="week_number" name="week_number" value="<?php echo (int) $suggest_num; ?>" min="1" max="999" class="small-text" required></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="delivery_date">Fecha de entrega</label></th>
                        <td>
                            <input type="date" id="delivery_date" name="delivery_date" value="<?php echo esc_attr( $suggest_date ); ?>" required>
                            <p class="description">Seleccioná el jueves de entrega para esa semana.</p>
                        </td>
                    </tr>
                </table>
                <p class="submit"><button type="submit" class="button button-primary">Crear caja</button></p>
            </form>
        </div>
    </div>
    <?php
}

// ── POST HANDLER: ASSIGN RECIPES TO CAJA ─────────────────────────────────────

function ogape_ops_handle_assign_recipes() {
    check_admin_referer( 'ogape_assign_recipes' );
    if ( ! current_user_can( 'manage_options' ) ) wp_die( 'No autorizado.' );

    $caja_id    = (int) ( $_POST['caja_id'] ?? 0 );
    $recipe_ids = isset( $_POST['recipe_ids'] ) && is_array( $_POST['recipe_ids'] )
        ? array_map( 'absint', $_POST['recipe_ids'] )
        : array();

    if ( ! $caja_id ) wp_die( 'Caja no válida.' );

    update_post_meta( $caja_id, '_ogape_recipe_ids', $recipe_ids );
    wp_safe_redirect( admin_url( 'admin.php?page=ogape-ops&updated=recipes' ) );
    exit;
}
add_action( 'admin_post_ogape_assign_recipes', 'ogape_ops_handle_assign_recipes' );

// ── POST HANDLER: CREATE RECIPE ───────────────────────────────────────────────

function ogape_ops_handle_create_recipe() {
    check_admin_referer( 'ogape_create_recipe' );
    if ( ! current_user_can( 'manage_options' ) ) wp_die( 'No autorizado.' );

    $title      = sanitize_text_field( wp_unslash( $_POST['recipe_title'] ?? '' ) );
    $desc       = sanitize_textarea_field( wp_unslash( $_POST['recipe_desc'] ?? '' ) );
    $time       = sanitize_text_field( wp_unslash( $_POST['recipe_time'] ?? '' ) );
    $difficulty = sanitize_text_field( wp_unslash( $_POST['recipe_difficulty'] ?? '' ) );
    $allergens  = sanitize_text_field( wp_unslash( $_POST['recipe_allergens'] ?? '' ) );
    $grad       = sanitize_text_field( wp_unslash( $_POST['recipe_grad'] ?? '' ) );
    $is_hero    = isset( $_POST['recipe_hero'] ) ? 1 : 0;

    // Build tags array from checkboxes
    $tag_map = ogape_recipe_tag_map();
    $tags    = array();
    foreach ( $tag_map as $type => $label ) {
        if ( isset( $_POST[ 'tag_' . $type ] ) ) {
            $tags[] = array( 'label' => $label, 'type' => $type );
        }
    }

    if ( ! $title ) {
        wp_safe_redirect( admin_url( 'admin.php?page=ogape-recetas&error=missing' ) );
        exit;
    }

    $post_id = wp_insert_post( array(
        'post_type'   => 'ogape_recipe',
        'post_title'  => $title,
        'post_status' => 'publish',
    ) );

    if ( is_wp_error( $post_id ) ) {
        wp_safe_redirect( admin_url( 'admin.php?page=ogape-recetas&error=create' ) );
        exit;
    }

    update_post_meta( $post_id, '_ogape_recipe_desc',       $desc );
    update_post_meta( $post_id, '_ogape_recipe_time',       $time );
    update_post_meta( $post_id, '_ogape_recipe_difficulty', $difficulty );
    update_post_meta( $post_id, '_ogape_recipe_allergens',  $allergens );
    update_post_meta( $post_id, '_ogape_recipe_grad',       $grad );
    update_post_meta( $post_id, '_ogape_recipe_hero',       $is_hero );
    update_post_meta( $post_id, '_ogape_recipe_tags',       $tags );

    wp_safe_redirect( admin_url( 'admin.php?page=ogape-recetas&created=' . $post_id ) );
    exit;
}
add_action( 'admin_post_ogape_create_recipe', 'ogape_ops_handle_create_recipe' );

// ── POST HANDLER: DELETE RECIPE ───────────────────────────────────────────────

function ogape_ops_handle_delete_recipe() {
    check_admin_referer( 'ogape_delete_recipe' );
    if ( ! current_user_can( 'manage_options' ) ) wp_die( 'No autorizado.' );

    $recipe_id = (int) ( $_POST['recipe_id'] ?? 0 );
    if ( ! $recipe_id ) wp_die( 'Receta no válida.' );

    wp_delete_post( $recipe_id, true );
    wp_safe_redirect( admin_url( 'admin.php?page=ogape-recetas&deleted=1' ) );
    exit;
}
add_action( 'admin_post_ogape_delete_recipe', 'ogape_ops_handle_delete_recipe' );

// ── RECIPE HELPERS ────────────────────────────────────────────────────────────

function ogape_recipe_tag_map() {
    return array(
        'hero'    => 'Plato Estrella',
        'local'   => 'Local',
        'nomad'   => 'Favorito',
        'protein' => 'Alto en proteína',
        'veg'     => 'Vegetariano',
        'intl'    => 'Internacional',
        'family'  => 'Para toda la familia',
    );
}

// ── ADMIN PAGE: CLIENTES ──────────────────────────────────────────────────────

function ogape_ops_clientes_page() {
    if ( ! current_user_can( 'manage_options' ) ) return;

    $users = get_users( array(
        'meta_query' => array(
            array( 'key' => 'ogape_registered_at', 'compare' => 'EXISTS' ),
        ),
        'number'  => 500,
        'orderby' => 'registered',
        'order'   => 'DESC',
    ) );

    ?>
    <div class="wrap">
        <h1>Clientes Ogape (<?php echo count( $users ); ?>)</h1>
        <?php if ( $users ) : ?>
            <table class="widefat striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Zona</th>
                        <th>Dirección</th>
                        <th>Plan</th>
                        <th>Setup</th>
                        <th>Registro</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ( $users as $u ) :
                        $zone    = get_user_meta( $u->ID, 'ogape_zone', true );
                        $addr    = trim( get_user_meta( $u->ID, 'ogape_address', true ) . ', ' . get_user_meta( $u->ID, 'ogape_apt', true ), ', ' );
                        $phone   = get_user_meta( $u->ID, 'ogape_phone', true );
                        $people  = get_user_meta( $u->ID, 'ogape_people', true );
                        $recipes = get_user_meta( $u->ID, 'ogape_recipes', true );
                        $setup   = get_user_meta( $u->ID, 'ogape_setup_complete', true );
                        $reg_at  = get_user_meta( $u->ID, 'ogape_registered_at', true );
                        ?>
                        <tr>
                            <td><strong><?php echo esc_html( $u->display_name ); ?></strong></td>
                            <td><?php echo esc_html( $u->user_email ); ?></td>
                            <td><?php echo esc_html( $phone ); ?></td>
                            <td><?php echo esc_html( $zone ); ?></td>
                            <td><?php echo esc_html( $addr ); ?></td>
                            <td><?php echo $people ? 'Para ' . esc_html( $people ) . ' · ' . esc_html( $recipes ) . ' rec.' : '—'; ?></td>
                            <td><?php echo $setup ? '<span style="color:green;font-weight:600">✓</span>' : '<span style="color:#888">Pendiente</span>'; ?></td>
                            <td style="font-size:11px;color:#666"><?php echo esc_html( $reg_at ? wp_date( 'd/m/Y H:i', strtotime( $reg_at ) ) : '' ); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>No hay clientes registrados todavía.</p>
        <?php endif; ?>
    </div>
    <?php
}

// ── ADMIN PAGE: RECETAS ───────────────────────────────────────────────────────

function ogape_ops_recetas_page() {
    if ( ! current_user_can( 'manage_options' ) ) return;

    $created = isset( $_GET['created'] ) ? (int) $_GET['created'] : 0;
    $deleted = isset( $_GET['deleted'] );
    $err     = isset( $_GET['error'] ) ? sanitize_key( $_GET['error'] ) : '';

    $recipes = get_posts( array( 'post_type' => 'ogape_recipe', 'numberposts' => 200, 'orderby' => 'title', 'order' => 'ASC' ) );
    $tag_map = ogape_recipe_tag_map();

    $grad_options = array(
        'linear-gradient(145deg,#e8d5b0 0%,#c8a05a 50%,#9a6830 100%)' => 'Dorado (pescado/mandioca)',
        'linear-gradient(145deg,#d4b896 0%,#a87040 50%,#7a4a20 100%)' => 'Marrón (carne oscura)',
        'linear-gradient(145deg,#c5d8a0 0%,#8aad55 50%,#5a7a30 100%)' => 'Verde (bowl/vegetariano)',
        'linear-gradient(145deg,#c8d4e8 0%,#7890b0 50%,#486080 100%)' => 'Azul (curry/suave)',
        'linear-gradient(145deg,#e8c8b0 0%,#c09068 50%,#905840 100%)' => 'Salmón (milanesa/pollo)',
        'linear-gradient(145deg,#d8c8e0 0%,#9878b0 50%,#685088 100%)' => 'Violeta (vegetariano especial)',
        'linear-gradient(145deg,#f0e0c0 0%,#d4a060 50%,#a06830 100%)' => 'Ámbar (pasta/risotto)',
    );
    ?>
    <div class="wrap">
        <h1 class="wp-heading-inline">Recetas Ogape (<?php echo count( $recipes ); ?>)</h1>
        <a href="#agregar-receta" class="page-title-action">+ Agregar receta</a>
        <hr class="wp-header-end">

        <?php if ( $created ) : ?>
            <div class="notice notice-success is-dismissible"><p>Receta creada con ID <?php echo $created; ?>.</p></div>
        <?php elseif ( $deleted ) : ?>
            <div class="notice notice-success is-dismissible"><p>Receta eliminada.</p></div>
        <?php elseif ( $err ) : ?>
            <div class="notice notice-error is-dismissible"><p>Error: <?php echo esc_html( $err ); ?>.</p></div>
        <?php endif; ?>

        <?php if ( $recipes ) : ?>
            <table class="widefat striped" style="margin-bottom:32px">
                <thead>
                    <tr>
                        <th style="width:36px">ID</th>
                        <th>Nombre</th>
                        <th>Tiempo</th>
                        <th>Dificultad</th>
                        <th>Alérgenos</th>
                        <th>Tags</th>
                        <th style="width:70px">Estrella</th>
                        <th style="width:80px">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ( $recipes as $rp ) :
                        $r_tags = get_post_meta( $rp->ID, '_ogape_recipe_tags', true );
                        $r_tags = is_array( $r_tags ) ? $r_tags : array();
                        $tag_labels = array_map( function( $t ) { return $t['label'] ?? ''; }, $r_tags );
                        ?>
                        <tr>
                            <td style="color:#888;font-size:12px"><?php echo (int) $rp->ID; ?></td>
                            <td>
                                <strong><?php echo esc_html( $rp->post_title ); ?></strong>
                                <div style="font-size:11px;color:#666;margin-top:2px"><?php echo esc_html( mb_strimwidth( get_post_meta( $rp->ID, '_ogape_recipe_desc', true ), 0, 80, '…' ) ); ?></div>
                            </td>
                            <td style="font-size:12px"><?php echo esc_html( get_post_meta( $rp->ID, '_ogape_recipe_time', true ) ); ?></td>
                            <td style="font-size:12px"><?php echo esc_html( get_post_meta( $rp->ID, '_ogape_recipe_difficulty', true ) ); ?></td>
                            <td style="font-size:12px"><?php echo esc_html( get_post_meta( $rp->ID, '_ogape_recipe_allergens', true ) ); ?></td>
                            <td style="font-size:11px"><?php echo esc_html( implode( ' · ', $tag_labels ) ); ?></td>
                            <td style="text-align:center"><?php echo get_post_meta( $rp->ID, '_ogape_recipe_hero', true ) ? '⭐' : ''; ?></td>
                            <td>
                                <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" style="margin:0" onsubmit="return confirm('¿Eliminar esta receta?')">
                                    <input type="hidden" name="action" value="ogape_delete_recipe">
                                    <input type="hidden" name="recipe_id" value="<?php echo (int) $rp->ID; ?>">
                                    <?php wp_nonce_field( 'ogape_delete_recipe' ); ?>
                                    <button type="submit" class="button button-small" style="color:#c62828">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p style="color:#888">No hay recetas todavía. Creá la primera a continuación.</p>
        <?php endif; ?>

        <!-- Add recipe form -->
        <div id="agregar-receta" style="background:#fff;border:1px solid #c3c4c7;border-radius:4px;padding:24px;max-width:720px">
            <h2 style="margin-top:0">Agregar receta</h2>
            <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
                <input type="hidden" name="action" value="ogape_create_recipe">
                <?php wp_nonce_field( 'ogape_create_recipe' ); ?>
                <table class="form-table" role="presentation">
                    <tr>
                        <th><label for="recipe_title">Nombre *</label></th>
                        <td><input type="text" id="recipe_title" name="recipe_title" class="regular-text" required></td>
                    </tr>
                    <tr>
                        <th><label for="recipe_desc">Descripción</label></th>
                        <td><textarea id="recipe_desc" name="recipe_desc" class="large-text" rows="3"></textarea></td>
                    </tr>
                    <tr>
                        <th><label for="recipe_time">Tiempo</label></th>
                        <td><input type="text" id="recipe_time" name="recipe_time" placeholder="35 min" class="small-text"></td>
                    </tr>
                    <tr>
                        <th><label for="recipe_difficulty">Dificultad</label></th>
                        <td>
                            <select id="recipe_difficulty" name="recipe_difficulty">
                                <option value="Fácil">Fácil</option>
                                <option value="Media">Media</option>
                                <option value="Difícil">Difícil</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="recipe_allergens">Alérgenos</label></th>
                        <td><input type="text" id="recipe_allergens" name="recipe_allergens" placeholder="Gluten, lácteos — o Ninguno" class="regular-text"></td>
                    </tr>
                    <tr>
                        <th>Tags</th>
                        <td>
                            <?php foreach ( $tag_map as $type => $label ) : ?>
                                <label style="display:inline-flex;align-items:center;gap:6px;margin-right:14px;font-size:13px">
                                    <input type="checkbox" name="tag_<?php echo esc_attr( $type ); ?>" value="1">
                                    <?php echo esc_html( $label ); ?>
                                </label>
                            <?php endforeach; ?>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="recipe_hero">Plato estrella</label></th>
                        <td><label><input type="checkbox" id="recipe_hero" name="recipe_hero" value="1"> Marcar como plato estrella de la semana</label></td>
                    </tr>
                    <tr>
                        <th><label for="recipe_grad">Color de tarjeta</label></th>
                        <td>
                            <select id="recipe_grad" name="recipe_grad" class="regular-text">
                                <?php foreach ( $grad_options as $val => $label ) : ?>
                                    <option value="<?php echo esc_attr( $val ); ?>"><?php echo esc_html( $label ); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                </table>
                <p class="submit"><button type="submit" class="button button-primary">Guardar receta</button></p>
            </form>
        </div>
    </div>
    <?php
}
