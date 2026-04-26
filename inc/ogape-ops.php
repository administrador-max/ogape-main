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
    // Hidden detail page — not shown in nav, accessible via ?page=ogape-cliente&uid=X
    add_submenu_page( null, 'Editar cliente', 'Editar cliente', 'manage_options', 'ogape-cliente', 'ogape_ops_cliente_page' );
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

function ogape_ops_handle_edit_caja() {
    check_admin_referer( 'ogape_edit_caja' );
    if ( ! current_user_can( 'manage_options' ) ) wp_die( 'No autorizado.' );

    $caja_id       = (int) ( $_POST['caja_id'] ?? 0 );
    $delivery_date = sanitize_text_field( wp_unslash( $_POST['delivery_date'] ?? '' ) );
    $week_number   = absint( $_POST['week_number'] ?? 0 );
    $global_status = sanitize_key( $_POST['global_status'] ?? '' );

    if ( ! $caja_id || ! $delivery_date || ! $week_number ) {
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

    wp_update_post( array(
        'ID'         => $caja_id,
        'post_title' => wp_strip_all_tags( $post_title ),
    ) );
    update_post_meta( $caja_id, '_ogape_week_number', $week_number );
    update_post_meta( $caja_id, '_ogape_delivery_date', $delivery_date );

    $valid_statuses = array_keys( ogape_caja_statuses() );
    if ( $global_status && in_array( $global_status, $valid_statuses, true ) ) {
        $old_status = get_post_meta( $caja_id, '_ogape_global_status', true );
        update_post_meta( $caja_id, '_ogape_global_status', $global_status );
        if ( $old_status !== $global_status ) {
            do_action( 'ogape_caja_status_changed', $caja_id, $global_status, $old_status );
        }
    }

    wp_safe_redirect( admin_url( 'admin.php?page=ogape-ops&updated=caja' ) );
    exit;
}
add_action( 'admin_post_ogape_edit_caja', 'ogape_ops_handle_edit_caja' );

// ── ADMIN PAGE: SEMANA ACTUAL ─────────────────────────────────────────────────

function ogape_ops_semana_page() {
    if ( ! current_user_can( 'manage_options' ) ) return;

    $caja     = ogape_get_current_caja();
    $zones    = ogape_delivery_zones();
    $statuses = ogape_caja_statuses();
    $updated  = sanitize_key( $_GET['updated'] ?? '' );
    $err      = sanitize_key( $_GET['error'] ?? '' );
    $created  = (int) ( $_GET['created'] ?? 0 );

    // KPI data
    $kpi_users = get_users( array(
        'meta_query' => array( array( 'key' => 'ogape_registered_at', 'compare' => 'EXISTS' ) ),
        'fields'     => array( 'ID' ),
        'number'     => -1,
    ) );
    $kpi_count   = count( $kpi_users );
    $kpi_revenue = 0;
    $kpi_zones   = array();
    foreach ( $kpi_users as $ku ) {
        $price = (int) get_user_meta( $ku->ID, 'ogape_price', true );
        $kpi_revenue += $price ?: 285000;
        $zk = get_user_meta( $ku->ID, 'ogape_zone_key', true );
        if ( $zk ) $kpi_zones[ $zk ] = ( $kpi_zones[ $zk ] ?? 0 ) + 1;
    }
    $schedule    = function_exists( 'ogape_demo_schedule' ) ? ogape_demo_schedule() : array();
    $cutoff_dt   = $schedule['cutoff'] ?? null;
    $now         = new DateTimeImmutable( 'now', wp_timezone() );
    $cutoff_open = $cutoff_dt instanceof DateTimeImmutable && $cutoff_dt > $now;
    if ( $cutoff_open ) {
        $diff             = $now->diff( $cutoff_dt );
        $cutoff_remaining = $diff->days > 0 ? "{$diff->days}d {$diff->h}h" : "{$diff->h}h {$diff->i}m";
    } else {
        $cutoff_remaining = 'Cerrado';
    }

    // Edit-caja state
    $edit_caja_id = isset( $_GET['edit_caja'] ) ? (int) $_GET['edit_caja'] : 0;
    $edit_caja    = $edit_caja_id ? get_post( $edit_caja_id ) : null;
    if ( $edit_caja && 'ogape_caja' !== $edit_caja->post_type ) $edit_caja = null;

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

        <!-- KPI bar -->
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:12px;margin:16px 0 24px">
            <div style="background:#fff;border:1px solid #c3c4c7;border-radius:4px;padding:14px 18px">
                <div style="font-size:11px;color:#50575e;text-transform:uppercase;letter-spacing:.04em;margin-bottom:6px">Clientes</div>
                <div style="font-size:30px;font-weight:700;color:#1a1a1a;line-height:1"><?php echo $kpi_count; ?></div>
            </div>
            <div style="background:#fff;border:1px solid #c3c4c7;border-radius:4px;padding:14px 18px">
                <div style="font-size:11px;color:#50575e;text-transform:uppercase;letter-spacing:.04em;margin-bottom:6px">Ingreso estimado / sem.</div>
                <div style="font-size:20px;font-weight:700;color:#1a56db;line-height:1">Gs&nbsp;<?php echo number_format( $kpi_revenue, 0, ',', '.' ); ?></div>
            </div>
            <div style="background:#fff;border:1px solid #c3c4c7;border-radius:4px;padding:14px 18px">
                <div style="font-size:11px;color:#50575e;text-transform:uppercase;letter-spacing:.04em;margin-bottom:6px">Cierre de pedidos</div>
                <div style="font-size:20px;font-weight:700;line-height:1;color:<?php echo $cutoff_open ? '#155724' : '#721c24'; ?>"><?php echo esc_html( $cutoff_remaining ); ?></div>
                <?php if ( ! empty( $schedule['cutoff_label'] ) ) : ?>
                    <div style="font-size:11px;color:#888;margin-top:4px"><?php echo esc_html( $schedule['cutoff_label'] ); ?></div>
                <?php endif; ?>
            </div>
            <div style="background:#fff;border:1px solid #c3c4c7;border-radius:4px;padding:14px 18px">
                <div style="font-size:11px;color:#50575e;text-transform:uppercase;letter-spacing:.04em;margin-bottom:6px">Clientes por zona</div>
                <?php foreach ( $zones as $zk => $zn ) : ?>
                    <div style="display:flex;justify-content:space-between;font-size:12px;margin-bottom:3px">
                        <span style="color:#50575e"><?php echo esc_html( $zn ); ?></span>
                        <strong><?php echo (int) ( $kpi_zones[ $zk ] ?? 0 ); ?></strong>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

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
            <div style="background:#fff;border:1px solid #c3c4c7;border-radius:4px;padding:20px 24px;margin:0 0 0">
                <div style="display:flex;justify-content:space-between;align-items:flex-start;gap:16px;flex-wrap:wrap">
                    <div>
                        <h2 style="margin:0 0 4px;font-size:18px"><?php echo esc_html( $caja->post_title ); ?></h2>
                        <p style="margin:0;color:#50575e;font-size:13px">
                            Entrega: <strong><?php echo esc_html( $delivery_date ); ?></strong>
                            &nbsp;·&nbsp; Semana N.° <strong><?php echo (int) $week_number; ?></strong>
                            &nbsp;·&nbsp; <a href="<?php echo esc_url( admin_url( 'admin.php?page=ogape-ops&edit_caja=' . $caja_id . '#edit-caja' ) ); ?>" style="font-size:12px">Editar datos</a>
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

        <!-- Caja history -->
        <?php
        $all_cajas = get_posts( array(
            'post_type'      => 'ogape_caja',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'orderby'        => 'meta_value',
            'meta_key'       => '_ogape_delivery_date',
            'order'          => 'DESC',
        ) );
        if ( $all_cajas ) :
        ?>
        <h2 style="margin-top:32px">Historial de cajas</h2>
        <table class="widefat striped" style="margin-bottom:24px">
            <thead><tr>
                <th>Caja</th>
                <th style="width:130px">Fecha entrega</th>
                <th style="width:180px">Estado global</th>
                <th style="width:80px">Acciones</th>
            </tr></thead>
            <tbody>
            <?php foreach ( $all_cajas as $hc ) :
                $h_status   = get_post_meta( $hc->ID, '_ogape_global_status', true ) ?: 'planning';
                $h_date     = get_post_meta( $hc->ID, '_ogape_delivery_date', true );
                $is_current = $caja && $hc->ID === $caja->ID;
                ?>
                <tr<?php echo $is_current ? ' style="background:#e8f0fe"' : ''; ?>>
                    <td>
                        <strong><?php echo esc_html( $hc->post_title ); ?></strong>
                        <?php if ( $is_current ) : ?>
                            <span style="display:inline-block;margin-left:6px;padding:1px 8px;background:#1a56db;color:#fff;border-radius:10px;font-size:10px;font-weight:600;vertical-align:middle">Activa</span>
                        <?php endif; ?>
                    </td>
                    <td><?php echo esc_html( $h_date ); ?></td>
                    <td style="font-size:12px"><?php echo esc_html( ogape_caja_status_label( $h_status ) ); ?></td>
                    <td><a href="<?php echo esc_url( admin_url( 'admin.php?page=ogape-ops&edit_caja=' . $hc->ID . '#edit-caja' ) ); ?>" class="button button-small">Editar</a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>

        <!-- Edit caja form (shown when ?edit_caja=ID is in URL) -->
        <?php if ( $edit_caja ) : ?>
        <div id="edit-caja" style="background:#fff;border:2px solid #1a56db;border-radius:4px;padding:20px 24px;margin-bottom:24px">
            <h2 style="margin:0 0 16px;color:#1a56db">Editando: <?php echo esc_html( $edit_caja->post_title ); ?></h2>
            <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
                <input type="hidden" name="action" value="ogape_edit_caja">
                <input type="hidden" name="caja_id" value="<?php echo (int) $edit_caja_id; ?>">
                <?php wp_nonce_field( 'ogape_edit_caja' ); ?>
                <table class="form-table" role="presentation">
                    <tr>
                        <th><label for="edit_week_number">N.° de semana</label></th>
                        <td><input type="number" id="edit_week_number" name="week_number" value="<?php echo (int) get_post_meta( $edit_caja_id, '_ogape_week_number', true ); ?>" min="1" max="999" class="small-text" required></td>
                    </tr>
                    <tr>
                        <th><label for="edit_delivery_date">Fecha de entrega</label></th>
                        <td><input type="date" id="edit_delivery_date" name="delivery_date" value="<?php echo esc_attr( get_post_meta( $edit_caja_id, '_ogape_delivery_date', true ) ); ?>" required></td>
                    </tr>
                    <tr>
                        <th><label for="edit_global_status">Estado global</label></th>
                        <td>
                            <select id="edit_global_status" name="global_status">
                                <?php foreach ( $statuses as $sk => $sl ) : ?>
                                    <option value="<?php echo esc_attr( $sk ); ?>"<?php selected( get_post_meta( $edit_caja_id, '_ogape_global_status', true ), $sk ); ?>><?php echo esc_html( $sl ); ?></option>
                                <?php endforeach; ?>
                            </select>
                            <p class="description">Podés retroceder o saltar estados directamente desde aquí.</p>
                        </td>
                    </tr>
                </table>
                <p class="submit">
                    <button type="submit" class="button button-primary">Guardar cambios</button>
                    <a href="<?php echo esc_url( admin_url( 'admin.php?page=ogape-ops' ) ); ?>" class="button">Cancelar</a>
                </p>
            </form>
        </div>
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

    $ingredients = sanitize_textarea_field( wp_unslash( $_POST['recipe_ingredients'] ?? '' ) );

    update_post_meta( $post_id, '_ogape_recipe_desc',        $desc );
    update_post_meta( $post_id, '_ogape_recipe_time',        $time );
    update_post_meta( $post_id, '_ogape_recipe_difficulty',  $difficulty );
    update_post_meta( $post_id, '_ogape_recipe_allergens',   $allergens );
    update_post_meta( $post_id, '_ogape_recipe_grad',        $grad );
    update_post_meta( $post_id, '_ogape_recipe_hero',        $is_hero );
    update_post_meta( $post_id, '_ogape_recipe_tags',        $tags );
    update_post_meta( $post_id, '_ogape_recipe_ingredients', $ingredients );

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

// ── POST HANDLER: EDIT RECIPE ─────────────────────────────────────────────────

function ogape_ops_handle_edit_recipe() {
    check_admin_referer( 'ogape_edit_recipe' );
    if ( ! current_user_can( 'manage_options' ) ) wp_die( 'No autorizado.' );

    $recipe_id  = (int) ( $_POST['recipe_id'] ?? 0 );
    if ( ! $recipe_id ) wp_die( 'Receta no válida.' );

    $title       = sanitize_text_field( wp_unslash( $_POST['recipe_title'] ?? '' ) );
    $desc        = sanitize_textarea_field( wp_unslash( $_POST['recipe_desc'] ?? '' ) );
    $time        = sanitize_text_field( wp_unslash( $_POST['recipe_time'] ?? '' ) );
    $difficulty  = sanitize_text_field( wp_unslash( $_POST['recipe_difficulty'] ?? '' ) );
    $allergens   = sanitize_text_field( wp_unslash( $_POST['recipe_allergens'] ?? '' ) );
    $grad        = sanitize_text_field( wp_unslash( $_POST['recipe_grad'] ?? '' ) );
    $ingredients = sanitize_textarea_field( wp_unslash( $_POST['recipe_ingredients'] ?? '' ) );
    $is_hero     = isset( $_POST['recipe_hero'] ) ? 1 : 0;

    $tag_map = ogape_recipe_tag_map();
    $tags    = array();
    foreach ( $tag_map as $type => $label ) {
        if ( isset( $_POST[ 'tag_' . $type ] ) ) {
            $tags[] = array( 'label' => $label, 'type' => $type );
        }
    }

    if ( ! $title ) {
        wp_safe_redirect( admin_url( 'admin.php?page=ogape-recetas&edit=' . $recipe_id . '&error=missing' ) );
        exit;
    }

    wp_update_post( array( 'ID' => $recipe_id, 'post_title' => $title ) );
    update_post_meta( $recipe_id, '_ogape_recipe_desc',        $desc );
    update_post_meta( $recipe_id, '_ogape_recipe_time',        $time );
    update_post_meta( $recipe_id, '_ogape_recipe_difficulty',  $difficulty );
    update_post_meta( $recipe_id, '_ogape_recipe_allergens',   $allergens );
    update_post_meta( $recipe_id, '_ogape_recipe_grad',        $grad );
    update_post_meta( $recipe_id, '_ogape_recipe_hero',        $is_hero );
    update_post_meta( $recipe_id, '_ogape_recipe_tags',        $tags );
    update_post_meta( $recipe_id, '_ogape_recipe_ingredients', $ingredients );

    wp_safe_redirect( admin_url( 'admin.php?page=ogape-recetas&updated=1' ) );
    exit;
}
add_action( 'admin_post_ogape_edit_recipe', 'ogape_ops_handle_edit_recipe' );

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

function ogape_default_menu_recipes() {
    return array(
        array(
            'id'         => 'surubi',
            'name'       => 'Surubí al Maracuyá',
            'desc'       => 'Filete del río Paraná con mantequilla de maracuyá, mandioca dorada y vegetales tiernos.',
            'tags'       => array(
                array( 'label' => 'Plato Estrella', 'type' => 'hero' ),
                array( 'label' => 'Local', 'type' => 'local' ),
            ),
            'time'       => '35 min',
            'difficulty' => 'Media',
            'allergens'  => 'Pescado, lácteos',
            'isHero'     => true,
            'photoGrad'  => 'linear-gradient(145deg,#e8d5b0 0%,#c8a05a 50%,#9a6830 100%)',
        ),
        array(
            'id'         => 'bife',
            'name'       => 'Bife Koygua Negro',
            'desc'       => 'Costilla de res braseada con reducción de cerveza negra, cebolla asada y puré rústico.',
            'tags'       => array(
                array( 'label' => 'Favorito', 'type' => 'nomad' ),
            ),
            'time'       => '50 min',
            'difficulty' => 'Fácil',
            'allergens'  => 'Gluten (cerveza)',
            'isHero'     => false,
            'photoGrad'  => 'linear-gradient(145deg,#d4b896 0%,#a87040 50%,#7a4a20 100%)',
        ),
        array(
            'id'         => 'bowl',
            'name'       => 'Bowl Proteico Ogape',
            'desc'       => 'Pollo grillado, arroz jazmín, hummus suave, verduras encurtidas y crocante de semillas.',
            'tags'       => array(
                array( 'label' => 'Favorito', 'type' => 'nomad' ),
                array( 'label' => 'Alto en proteína', 'type' => 'protein' ),
            ),
            'time'       => '30 min',
            'difficulty' => 'Fácil',
            'allergens'  => 'Sésamo',
            'isHero'     => false,
            'photoGrad'  => 'linear-gradient(145deg,#c5d8a0 0%,#8aad55 50%,#5a7a30 100%)',
        ),
        array(
            'id'         => 'curry',
            'name'       => 'Pollo al Curry Suave',
            'desc'       => 'Pollo en curry suave de coco con arroz perfumado y hierbas frescas.',
            'tags'       => array(
                array( 'label' => 'Internacional', 'type' => 'intl' ),
                array( 'label' => 'Para toda la familia', 'type' => 'family' ),
            ),
            'time'       => '40 min',
            'difficulty' => 'Fácil',
            'allergens'  => 'Ninguno',
            'isHero'     => false,
            'photoGrad'  => 'linear-gradient(145deg,#c8d4e8 0%,#7890b0 50%,#486080 100%)',
        ),
        array(
            'id'         => 'milanesa',
            'name'       => 'Milanesa Signature',
            'desc'       => 'Milanesa crocante de corte premium con papas rústicas, limón y alioli casero.',
            'tags'       => array(
                array( 'label' => 'Favorito', 'type' => 'nomad' ),
                array( 'label' => 'Para toda la familia', 'type' => 'family' ),
            ),
            'time'       => '30 min',
            'difficulty' => 'Fácil',
            'allergens'  => 'Gluten, huevo, lácteos',
            'isHero'     => false,
            'photoGrad'  => 'linear-gradient(145deg,#e8c8b0 0%,#c09068 50%,#905840 100%)',
        ),
        array(
            'id'         => 'risotto',
            'name'       => 'Risotto de Mandioca',
            'desc'       => 'Risotto cremoso con mandioca paraguaya, queso de campo y aceite de hierbas de la huerta.',
            'tags'       => array(
                array( 'label' => 'Local', 'type' => 'local' ),
                array( 'label' => 'Vegetariano', 'type' => 'veg' ),
            ),
            'time'       => '45 min',
            'difficulty' => 'Media',
            'allergens'  => 'Lácteos',
            'isHero'     => false,
            'photoGrad'  => 'linear-gradient(145deg,#d8c8e0 0%,#9878b0 50%,#685088 100%)',
        ),
    );
}

function ogape_normalize_recipe_tags( $tags_raw ) {
    if ( ! is_array( $tags_raw ) ) {
        return array();
    }

    $tags = array();
    foreach ( $tags_raw as $tag ) {
        if ( ! is_array( $tag ) ) {
            continue;
        }

        $label = sanitize_text_field( $tag['label'] ?? '' );
        $type  = sanitize_key( $tag['type'] ?? '' );
        if ( '' === $label || '' === $type ) {
            continue;
        }

        $tags[] = array(
            'label' => $label,
            'type'  => $type,
        );
    }

    return $tags;
}

function ogape_map_recipe_post_to_menu_item( $recipe_post ) {
    $tags_raw = get_post_meta( $recipe_post->ID, '_ogape_recipe_tags', true );

    return array(
        'id'         => 'r' . $recipe_post->ID,
        'name'       => $recipe_post->post_title,
        'desc'       => get_post_meta( $recipe_post->ID, '_ogape_recipe_desc', true ) ?: get_the_excerpt( $recipe_post ),
        'tags'       => ogape_normalize_recipe_tags( $tags_raw ),
        'time'       => get_post_meta( $recipe_post->ID, '_ogape_recipe_time', true ) ?: '35 min',
        'difficulty' => get_post_meta( $recipe_post->ID, '_ogape_recipe_difficulty', true ) ?: 'Fácil',
        'allergens'  => get_post_meta( $recipe_post->ID, '_ogape_recipe_allergens', true ) ?: 'Ninguno',
        'isHero'     => (bool) get_post_meta( $recipe_post->ID, '_ogape_recipe_hero', true ),
        'photoGrad'  => get_post_meta( $recipe_post->ID, '_ogape_recipe_grad', true )
            ?: 'linear-gradient(145deg,#e8d5b0 0%,#c8a05a 50%,#9a6830 100%)',
    );
}

function ogape_normalize_menu_recipe_item( $recipe ) {
    if ( ! is_array( $recipe ) ) {
        return null;
    }

    $id = sanitize_key( $recipe['id'] ?? '' );
    if ( '' === $id ) {
        return null;
    }

    return array(
        'id'         => $id,
        'name'       => sanitize_text_field( $recipe['name'] ?? '' ),
        'desc'       => sanitize_textarea_field( $recipe['desc'] ?? '' ),
        'tags'       => ogape_normalize_recipe_tags( $recipe['tags'] ?? array() ),
        'time'       => sanitize_text_field( $recipe['time'] ?? '' ),
        'difficulty' => sanitize_text_field( $recipe['difficulty'] ?? '' ),
        'allergens'  => sanitize_text_field( $recipe['allergens'] ?? '' ),
        'isHero'     => ! empty( $recipe['isHero'] ),
        'photoGrad'  => sanitize_text_field( $recipe['photoGrad'] ?? '' ),
    );
}

function ogape_get_current_menu_recipes() {
    $fallback = ogape_default_menu_recipes();
    $caja_obj = ogape_get_current_caja();

    if ( ! $caja_obj ) {
        return $fallback;
    }

    $caja_recipe_ids = get_post_meta( $caja_obj->ID, '_ogape_recipe_ids', true );
    if ( empty( $caja_recipe_ids ) || ! is_array( $caja_recipe_ids ) ) {
        return $fallback;
    }

    $recipe_posts = get_posts( array(
        'post_type'   => 'ogape_recipe',
        'include'     => array_map( 'absint', $caja_recipe_ids ),
        'orderby'     => 'post__in',
        'numberposts' => 20,
    ) );

    if ( ! $recipe_posts ) {
        return $fallback;
    }

    $recipes = array();
    foreach ( $recipe_posts as $recipe_post ) {
        $recipes[] = ogape_map_recipe_post_to_menu_item( $recipe_post );
    }

    return $recipes ?: $fallback;
}

function ogape_get_user_selected_menu_recipe_ids( $user_id, $week_key = '' ) {
    $user_id = absint( $user_id );
    if ( ! $user_id ) {
        return array();
    }

    $selected = array();
    if ( $week_key ) {
        $selected = get_user_meta( $user_id, 'ogape_menu_selection_' . sanitize_key( $week_key ), true );
    }

    if ( empty( $selected ) ) {
        $selected = get_user_meta( $user_id, 'ogape_menu_last_selection', true );
    }

    if ( ! is_array( $selected ) ) {
        return array();
    }

    return array_values( array_unique( array_filter( array_map( 'sanitize_key', $selected ) ) ) );
}

function ogape_get_user_selected_menu_recipe_snapshot( $user_id, $week_key = '' ) {
    $user_id = absint( $user_id );
    if ( ! $user_id ) {
        return array();
    }

    $snapshot = array();
    if ( $week_key ) {
        $snapshot = get_user_meta( $user_id, 'ogape_menu_selection_snapshot_' . sanitize_key( $week_key ), true );
    }

    if ( empty( $snapshot ) ) {
        $snapshot = get_user_meta( $user_id, 'ogape_menu_last_selection_snapshot', true );
    }

    if ( ! is_array( $snapshot ) ) {
        return array();
    }

    $normalized = array();
    foreach ( $snapshot as $recipe ) {
        $item = ogape_normalize_menu_recipe_item( $recipe );
        if ( $item ) {
            $normalized[] = $item;
        }
    }

    return $normalized;
}

function ogape_get_account_selected_menu_recipes( $user_id, $week_key = '', $limit = 0 ) {
    $snapshot = ogape_get_user_selected_menu_recipe_snapshot( $user_id, $week_key );
    if ( $snapshot ) {
        return $limit ? array_slice( $snapshot, 0, absint( $limit ) ) : $snapshot;
    }

    $recipes = ogape_get_current_menu_recipes();
    if ( ! $recipes ) {
        return array();
    }

    $limit        = absint( $limit );
    $recipe_index = array();
    $lookup_recipes = array_merge( $recipes, ogape_default_menu_recipes() );
    foreach ( $lookup_recipes as $recipe ) {
        if ( empty( $recipe['id'] ) ) {
            continue;
        }
        $recipe_index[ $recipe['id'] ] = $recipe;
    }

    $selected_ids = ogape_get_user_selected_menu_recipe_ids( $user_id, $week_key );
    $selected     = array();
    $selected_map = array();

    foreach ( $selected_ids as $selected_id ) {
        if ( empty( $recipe_index[ $selected_id ] ) ) {
            continue;
        }

        $selected[]               = $recipe_index[ $selected_id ];
        $selected_map[ $selected_id ] = true;
    }

    if ( ! $selected ) {
        $selected = $recipes;
        foreach ( $selected as $recipe ) {
            if ( ! empty( $recipe['id'] ) ) {
                $selected_map[ $recipe['id'] ] = true;
            }
        }
    }

    if ( $limit && count( $selected ) < $limit ) {
        foreach ( $recipes as $recipe ) {
            $recipe_id = $recipe['id'] ?? '';
            if ( ! $recipe_id || isset( $selected_map[ $recipe_id ] ) ) {
                continue;
            }

            $selected[] = $recipe;
            $selected_map[ $recipe_id ] = true;

            if ( count( $selected ) >= $limit ) {
                break;
            }
        }
    }

    return $limit ? array_slice( $selected, 0, $limit ) : $selected;
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
                        <th style="width:80px">Acciones</th>
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
                        $edit_url = admin_url( 'admin.php?page=ogape-cliente&uid=' . $u->ID );
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
                            <td><a href="<?php echo esc_url( $edit_url ); ?>" class="button button-small">Editar</a></td>
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

// ── ADMIN PAGE: CLIENTE (DETAIL / EDIT) ──────────────────────────────────────

function ogape_ops_cliente_page() {
    if ( ! current_user_can( 'manage_options' ) ) return;

    $uid = isset( $_GET['uid'] ) ? (int) $_GET['uid'] : 0;
    if ( ! $uid ) {
        echo '<div class="wrap"><p>UID no especificado.</p></div>';
        return;
    }

    $user = get_userdata( $uid );
    if ( ! $user ) {
        echo '<div class="wrap"><p>Cliente no encontrado.</p></div>';
        return;
    }

    $m               = ogape_get_customer_meta( $uid );
    $zones           = ogape_delivery_zones();
    $pref_labels     = ogape_demo_preference_labels();
    $saved_prefs     = (array) ( get_user_meta( $uid, 'ogape_preferences', true ) ?: array() );
    $updated         = isset( $_GET['updated'] ) ? sanitize_key( $_GET['updated'] ) : '';
    $back_url        = admin_url( 'admin.php?page=ogape-clientes' );
    ?>
    <div class="wrap">
        <h1>
            <a href="<?php echo esc_url( $back_url ); ?>" style="text-decoration:none;font-size:18px;margin-right:8px">←</a>
            <?php echo esc_html( $user->display_name ); ?>
            <span style="font-size:14px;font-weight:400;color:#666;margin-left:8px">#<?php echo $uid; ?></span>
        </h1>
        <?php if ( 'cliente' === $updated ) : ?>
            <div class="notice notice-success is-dismissible"><p>Cliente actualizado correctamente.</p></div>
        <?php endif; ?>

        <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
            <input type="hidden" name="action" value="ogape_edit_cliente">
            <input type="hidden" name="uid" value="<?php echo $uid; ?>">
            <?php wp_nonce_field( 'ogape_edit_cliente_' . $uid ); ?>

            <!-- WP User fields -->
            <h2 style="margin-top:24px;border-bottom:1px solid #ddd;padding-bottom:6px">Datos de cuenta</h2>
            <table class="form-table" role="presentation">
                <tr>
                    <th><label for="ec_first_name">Nombre</label></th>
                    <td><input type="text" id="ec_first_name" name="first_name" class="regular-text" value="<?php echo esc_attr( $user->first_name ); ?>"></td>
                </tr>
                <tr>
                    <th><label for="ec_last_name">Apellido</label></th>
                    <td><input type="text" id="ec_last_name" name="last_name" class="regular-text" value="<?php echo esc_attr( $user->last_name ); ?>"></td>
                </tr>
                <tr>
                    <th><label for="ec_email">Email</label></th>
                    <td><input type="email" id="ec_email" name="email" class="regular-text" value="<?php echo esc_attr( $user->user_email ); ?>"></td>
                </tr>
                <tr>
                    <th><label for="ec_phone">Teléfono</label></th>
                    <td><input type="text" id="ec_phone" name="phone" class="regular-text" value="<?php echo esc_attr( $m['phone'] ); ?>"></td>
                </tr>
            </table>

            <!-- Delivery -->
            <h2 style="margin-top:24px;border-bottom:1px solid #ddd;padding-bottom:6px">Entrega</h2>
            <table class="form-table" role="presentation">
                <tr>
                    <th><label for="ec_zone">Zona</label></th>
                    <td>
                        <select id="ec_zone" name="zone">
                            <option value="">— Sin asignar —</option>
                            <?php foreach ( $zones as $zk => $zl ) : ?>
                                <option value="<?php echo esc_attr( $zk ); ?>"<?php selected( $m['zone_key'], $zk ); ?>><?php echo esc_html( $zl ); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><label for="ec_address">Dirección</label></th>
                    <td><input type="text" id="ec_address" name="address" class="regular-text" value="<?php echo esc_attr( $m['address'] ); ?>"></td>
                </tr>
                <tr>
                    <th><label for="ec_apt">Apto / Torre</label></th>
                    <td><input type="text" id="ec_apt" name="apt" class="small-text" value="<?php echo esc_attr( $m['apt'] ); ?>"></td>
                </tr>
                <tr>
                    <th><label for="ec_window">Ventana de entrega</label></th>
                    <td>
                        <select id="ec_window" name="delivery_window">
                            <option value="am"<?php selected( $m['delivery_window'], 'am' ); ?>>Mañana (AM)</option>
                            <option value="pm"<?php selected( $m['delivery_window'], 'pm' ); ?>>Tarde (PM)</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><label for="ec_window_label">Etiqueta de ventana</label></th>
                    <td>
                        <input type="text" id="ec_window_label" name="delivery_window_label" class="regular-text" placeholder="Ej: 17:00 – 20:00" value="<?php echo esc_attr( $m['delivery_window_label'] ); ?>">
                        <p class="description">Texto libre que se muestra al cliente en su cuenta.</p>
                    </td>
                </tr>
                <tr>
                    <th><label for="ec_notes">Notas de entrega</label></th>
                    <td><textarea id="ec_notes" name="notes" class="large-text" rows="3"><?php echo esc_textarea( $m['notes'] ); ?></textarea></td>
                </tr>
            </table>

            <!-- Plan -->
            <h2 style="margin-top:24px;border-bottom:1px solid #ddd;padding-bottom:6px">Plan</h2>
            <table class="form-table" role="presentation">
                <tr>
                    <th><label for="ec_people">Personas</label></th>
                    <td>
                        <select id="ec_people" name="people">
                            <?php foreach ( array( '2', '3', '4' ) as $n ) : ?>
                                <option value="<?php echo $n; ?>"<?php selected( $m['people'], $n ); ?>><?php echo $n; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><label for="ec_recipes">Recetas por semana</label></th>
                    <td>
                        <select id="ec_recipes" name="recipes">
                            <?php foreach ( array( '2', '3', '4', '5' ) as $n ) : ?>
                                <option value="<?php echo $n; ?>"<?php selected( $m['recipes'], $n ); ?>><?php echo $n; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><label for="ec_price">Precio semanal (₲)</label></th>
                    <td><input type="number" id="ec_price" name="price" class="small-text" step="500" min="0" value="<?php echo esc_attr( $m['price'] ); ?>"></td>
                </tr>
            </table>

            <!-- Preferences -->
            <h2 style="margin-top:24px;border-bottom:1px solid #ddd;padding-bottom:6px">Preferencias alimentarias</h2>
            <table class="form-table" role="presentation">
                <tr>
                    <th>Preferencias</th>
                    <td>
                        <?php foreach ( $pref_labels as $pkey => $plabel ) : ?>
                            <label style="display:inline-flex;align-items:center;gap:6px;margin-right:16px;margin-bottom:6px;font-size:13px">
                                <input type="checkbox" name="preferences[]" value="<?php echo esc_attr( $pkey ); ?>"
                                    <?php checked( in_array( $plabel, $saved_prefs, true ) ); ?>>
                                <?php echo esc_html( $plabel ); ?>
                            </label>
                        <?php endforeach; ?>
                    </td>
                </tr>
                <tr>
                    <th><label for="ec_allergies">Alergias / restricciones</label></th>
                    <td>
                        <input type="text" id="ec_allergies" name="allergies" class="regular-text" placeholder="Nueces, mariscos…" value="<?php echo esc_attr( $m['allergies'] ); ?>">
                    </td>
                </tr>
            </table>

            <!-- Notifications -->
            <h2 style="margin-top:24px;border-bottom:1px solid #ddd;padding-bottom:6px">Notificaciones</h2>
            <table class="form-table" role="presentation">
                <tr>
                    <th>Preferencias de notif.</th>
                    <td>
                        <label style="display:block;margin-bottom:6px"><input type="checkbox" name="notif_weekly_menu" value="1"<?php checked( $m['notif_weekly_menu'] ); ?>> Menú semanal</label>
                        <label style="display:block;margin-bottom:6px"><input type="checkbox" name="notif_whatsapp" value="1"<?php checked( $m['notif_whatsapp'] ); ?>> WhatsApp</label>
                        <label style="display:block;margin-bottom:6px"><input type="checkbox" name="notif_cutoff" value="1"<?php checked( $m['notif_cutoff'] ); ?>> Recordatorio de cierre</label>
                        <label style="display:block;margin-bottom:6px"><input type="checkbox" name="notif_promo" value="1"<?php checked( $m['notif_promo'] ); ?>> Promociones</label>
                    </td>
                </tr>
                <tr>
                    <th><label for="ec_comms">Comunicaciones</label></th>
                    <td><label><input type="checkbox" id="ec_comms" name="comms" value="1"<?php checked( $m['comms'] ); ?>> Acepta comunicaciones de marketing</label></td>
                </tr>
            </table>

            <!-- Account state -->
            <h2 style="margin-top:24px;border-bottom:1px solid #ddd;padding-bottom:6px">Estado de cuenta</h2>
            <table class="form-table" role="presentation">
                <tr>
                    <th><label for="ec_setup">Setup completo</label></th>
                    <td><label><input type="checkbox" id="ec_setup" name="setup_complete" value="1"<?php checked( $m['setup_complete'] ); ?>> Marcar setup como completado</label></td>
                </tr>
                <tr>
                    <th><label for="ec_pause">Estado de pausa</label></th>
                    <td>
                        <select id="ec_pause" name="pause_status">
                            <option value=""<?php selected( $m['pause_status'], '' ); ?>>Activo</option>
                            <option value="paused"<?php selected( $m['pause_status'], 'paused' ); ?>>Pausado</option>
                            <option value="cancelled"<?php selected( $m['pause_status'], 'cancelled' ); ?>>Cancelado</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><label for="ec_pause_until">Pausado hasta</label></th>
                    <td>
                        <input type="date" id="ec_pause_until" name="pause_until" value="<?php echo esc_attr( $m['pause_until'] ? wp_date( 'Y-m-d', strtotime( $m['pause_until'] ) ) : '' ); ?>">
                        <p class="description">Solo aplica cuando el estado es "Pausado".</p>
                    </td>
                </tr>
            </table>

            <p class="submit" style="margin-top:24px">
                <button type="submit" class="button button-primary">Guardar cambios</button>
                <a href="<?php echo esc_url( $back_url ); ?>" class="button">Cancelar</a>
            </p>
        </form>
    </div>
    <?php
}

// ── POST HANDLER: EDIT CLIENTE ────────────────────────────────────────────────

function ogape_ops_handle_edit_cliente() {
    $uid = isset( $_POST['uid'] ) ? (int) $_POST['uid'] : 0;
    check_admin_referer( 'ogape_edit_cliente_' . $uid );
    if ( ! current_user_can( 'manage_options' ) || ! $uid ) wp_die( 'No autorizado.' );

    // WP user core fields
    $update_args = array( 'ID' => $uid );
    if ( isset( $_POST['first_name'] ) )
        $update_args['first_name'] = sanitize_text_field( wp_unslash( $_POST['first_name'] ) );
    if ( isset( $_POST['last_name'] ) )
        $update_args['last_name'] = sanitize_text_field( wp_unslash( $_POST['last_name'] ) );
    if ( isset( $_POST['email'] ) ) {
        $new_email = sanitize_email( wp_unslash( $_POST['email'] ) );
        if ( $new_email && is_email( $new_email ) ) {
            $existing = get_user_by( 'email', $new_email );
            if ( ! $existing || (int) $existing->ID === $uid ) {
                $update_args['user_email'] = $new_email;
            }
        }
    }
    wp_update_user( $update_args );

    // display_name from first + last
    $fn = sanitize_text_field( wp_unslash( $_POST['first_name'] ?? '' ) );
    $ln = sanitize_text_field( wp_unslash( $_POST['last_name'] ?? '' ) );
    if ( $fn || $ln ) {
        wp_update_user( array( 'ID' => $uid, 'display_name' => trim( $fn . ' ' . $ln ) ) );
    }

    // Zone: resolve label from key
    $zones   = ogape_delivery_zones();
    $zone_key = sanitize_key( wp_unslash( $_POST['zone'] ?? '' ) );
    $zone_label = $zones[ $zone_key ] ?? '';

    // Preferences: submitted as keys, stored as labels
    $raw_prefs = isset( $_POST['preferences'] ) && is_array( $_POST['preferences'] ) ? $_POST['preferences'] : array();
    $prefs = ogape_sanitize_demo_preferences( $raw_prefs );
    $pref_str = $prefs ? implode( ' · ', $prefs ) : '';

    // Meta save
    ogape_save_customer_meta( $uid, array(
        'phone'                 => sanitize_text_field( wp_unslash( $_POST['phone'] ?? '' ) ),
        'zone'                  => $zone_label,
        'zone_key'              => $zone_key,
        'address'               => sanitize_text_field( wp_unslash( $_POST['address'] ?? '' ) ),
        'apt'                   => sanitize_text_field( wp_unslash( $_POST['apt'] ?? '' ) ),
        'delivery_window'       => sanitize_key( wp_unslash( $_POST['delivery_window'] ?? 'pm' ) ),
        'delivery_window_label' => sanitize_text_field( wp_unslash( $_POST['delivery_window_label'] ?? '' ) ),
        'notes'                 => sanitize_textarea_field( wp_unslash( $_POST['notes'] ?? '' ) ),
        'people'                => in_array( $_POST['people'] ?? '', array( '2', '3', '4' ) ) ? $_POST['people'] : '2',
        'recipes'               => in_array( $_POST['recipes'] ?? '', array( '2', '3', '4', '5' ) ) ? $_POST['recipes'] : '3',
        'price'                 => absint( $_POST['price'] ?? 0 ),
        'preferences'           => $prefs,
        'preference'            => $pref_str,
        'allergies'             => sanitize_text_field( wp_unslash( $_POST['allergies'] ?? '' ) ),
        'comms'                 => isset( $_POST['comms'] ) ? 1 : 0,
        'setup_complete'        => isset( $_POST['setup_complete'] ) ? 1 : 0,
        'pause_status'          => sanitize_key( wp_unslash( $_POST['pause_status'] ?? '' ) ),
        'pause_until'           => sanitize_text_field( wp_unslash( $_POST['pause_until'] ?? '' ) ),
        'notif_weekly_menu'     => isset( $_POST['notif_weekly_menu'] ) ? 1 : 0,
        'notif_whatsapp'        => isset( $_POST['notif_whatsapp'] ) ? 1 : 0,
        'notif_cutoff'          => isset( $_POST['notif_cutoff'] ) ? 1 : 0,
        'notif_promo'           => isset( $_POST['notif_promo'] ) ? 1 : 0,
    ) );

    wp_safe_redirect( admin_url( 'admin.php?page=ogape-cliente&uid=' . $uid . '&updated=cliente' ) );
    exit;
}
add_action( 'admin_post_ogape_edit_cliente', 'ogape_ops_handle_edit_cliente' );

// ── RECIPE FORM HELPER ───────────────────────────────────────────────────────

function ogape_ops_recipe_form_fields( $grad_options, $tag_map, $v = array() ) {
    $title       = $v['title']       ?? '';
    $desc        = $v['desc']        ?? '';
    $time        = $v['time']        ?? '';
    $difficulty  = $v['difficulty']  ?? 'Fácil';
    $allergens   = $v['allergens']   ?? '';
    $grad        = $v['grad']        ?? array_key_first( $grad_options );
    $hero        = (int) ( $v['hero'] ?? 0 );
    $tags        = (array) ( $v['tags'] ?? array() );
    $ingredients = $v['ingredients'] ?? '';
    ?>
    <table class="form-table" role="presentation">
        <tr>
            <th><label>Nombre *</label></th>
            <td><input type="text" name="recipe_title" class="regular-text" value="<?php echo esc_attr( $title ); ?>" required></td>
        </tr>
        <tr>
            <th><label>Descripción</label></th>
            <td><textarea name="recipe_desc" class="large-text" rows="3"><?php echo esc_textarea( $desc ); ?></textarea></td>
        </tr>
        <tr>
            <th><label>Ingredientes</label></th>
            <td>
                <textarea name="recipe_ingredients" class="large-text" rows="7" placeholder="250g pechuga de pollo&#10;1 taza arroz&#10;2 dientes de ajo"><?php echo esc_textarea( $ingredients ); ?></textarea>
                <p class="description">Un ingrediente por línea. Se muestra en la tarjeta de receta del cliente.</p>
            </td>
        </tr>
        <tr>
            <th><label>Tiempo</label></th>
            <td><input type="text" name="recipe_time" placeholder="35 min" class="small-text" value="<?php echo esc_attr( $time ); ?>"></td>
        </tr>
        <tr>
            <th><label>Dificultad</label></th>
            <td>
                <select name="recipe_difficulty">
                    <option value="Fácil"<?php selected( $difficulty, 'Fácil' ); ?>>Fácil</option>
                    <option value="Media"<?php selected( $difficulty, 'Media' ); ?>>Media</option>
                    <option value="Difícil"<?php selected( $difficulty, 'Difícil' ); ?>>Difícil</option>
                </select>
            </td>
        </tr>
        <tr>
            <th><label>Alérgenos</label></th>
            <td><input type="text" name="recipe_allergens" placeholder="Gluten, lácteos — o Ninguno" class="regular-text" value="<?php echo esc_attr( $allergens ); ?>"></td>
        </tr>
        <tr>
            <th>Tags</th>
            <td>
                <?php foreach ( $tag_map as $type => $label ) : ?>
                    <label style="display:inline-flex;align-items:center;gap:6px;margin-right:14px;font-size:13px">
                        <input type="checkbox" name="tag_<?php echo esc_attr( $type ); ?>" value="1"<?php checked( in_array( $type, $tags, true ) ); ?>>
                        <?php echo esc_html( $label ); ?>
                    </label>
                <?php endforeach; ?>
            </td>
        </tr>
        <tr>
            <th><label>Plato estrella</label></th>
            <td><label><input type="checkbox" name="recipe_hero" value="1"<?php checked( $hero, 1 ); ?>> Marcar como plato estrella de la semana</label></td>
        </tr>
        <tr>
            <th><label>Color de tarjeta</label></th>
            <td>
                <select name="recipe_grad" class="regular-text">
                    <?php foreach ( $grad_options as $val => $label ) : ?>
                        <option value="<?php echo esc_attr( $val ); ?>"<?php selected( $grad, $val ); ?>><?php echo esc_html( $label ); ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
    </table>
    <?php
}

// ── ADMIN PAGE: RECETAS ───────────────────────────────────────────────────────

function ogape_ops_recetas_page() {
    if ( ! current_user_can( 'manage_options' ) ) return;

    $created = isset( $_GET['created'] ) ? (int) $_GET['created'] : 0;
    $deleted = isset( $_GET['deleted'] );
    $updated = isset( $_GET['updated'] );
    $err     = isset( $_GET['error'] ) ? sanitize_key( $_GET['error'] ) : '';

    // Edit state
    $edit_id  = isset( $_GET['edit'] ) ? (int) $_GET['edit'] : 0;
    $edit_rec = $edit_id ? get_post( $edit_id ) : null;
    if ( $edit_rec && 'ogape_recipe' !== $edit_rec->post_type ) $edit_rec = null;

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

    // Pre-load edit values
    if ( $edit_rec ) {
        $e_tags_raw   = get_post_meta( $edit_id, '_ogape_recipe_tags', true );
        $e_tags_raw   = is_array( $e_tags_raw ) ? $e_tags_raw : array();
        $e_vals = array(
            'title'       => $edit_rec->post_title,
            'desc'        => get_post_meta( $edit_id, '_ogape_recipe_desc', true ),
            'time'        => get_post_meta( $edit_id, '_ogape_recipe_time', true ),
            'difficulty'  => get_post_meta( $edit_id, '_ogape_recipe_difficulty', true ),
            'allergens'   => get_post_meta( $edit_id, '_ogape_recipe_allergens', true ),
            'grad'        => get_post_meta( $edit_id, '_ogape_recipe_grad', true ),
            'hero'        => (int) get_post_meta( $edit_id, '_ogape_recipe_hero', true ),
            'tags'        => array_column( $e_tags_raw, 'type' ),
            'ingredients' => get_post_meta( $edit_id, '_ogape_recipe_ingredients', true ),
        );
    }
    ?>
    <div class="wrap">
        <h1 class="wp-heading-inline">Recetas Ogape (<?php echo count( $recipes ); ?>)</h1>
        <?php if ( ! $edit_rec ) : ?>
            <a href="#agregar-receta" class="page-title-action">+ Agregar receta</a>
        <?php else : ?>
            <a href="<?php echo esc_url( admin_url( 'admin.php?page=ogape-recetas' ) ); ?>" class="page-title-action">← Volver a la lista</a>
        <?php endif; ?>
        <hr class="wp-header-end">

        <?php if ( $created ) : ?>
            <div class="notice notice-success is-dismissible"><p>Receta creada con ID <?php echo $created; ?>.</p></div>
        <?php elseif ( $updated ) : ?>
            <div class="notice notice-success is-dismissible"><p>Receta actualizada correctamente.</p></div>
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
                        <th style="width:60px">⭐</th>
                        <th style="width:130px">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ( $recipes as $rp ) :
                        $r_tags     = get_post_meta( $rp->ID, '_ogape_recipe_tags', true );
                        $r_tags     = is_array( $r_tags ) ? $r_tags : array();
                        $tag_labels = array_map( function( $t ) { return $t['label'] ?? ''; }, $r_tags );
                        $is_editing = $edit_rec && $rp->ID === $edit_id;
                        ?>
                        <tr<?php echo $is_editing ? ' style="background:#e8f0fe"' : ''; ?>>
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
                            <td style="white-space:nowrap">
                                <a href="<?php echo esc_url( admin_url( 'admin.php?page=ogape-recetas&edit=' . $rp->ID . '#editar-receta' ) ); ?>" class="button button-small">Editar</a>
                                <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" style="display:inline;margin:0" onsubmit="return confirm('¿Eliminar esta receta?')">
                                    <input type="hidden" name="action" value="ogape_delete_recipe">
                                    <input type="hidden" name="recipe_id" value="<?php echo (int) $rp->ID; ?>">
                                    <?php wp_nonce_field( 'ogape_delete_recipe' ); ?>
                                    <button type="submit" class="button button-small" style="color:#c62828;margin-left:4px">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p style="color:#888">No hay recetas todavía. Creá la primera a continuación.</p>
        <?php endif; ?>

        <?php if ( $edit_rec ) : ?>
        <!-- Edit recipe form -->
        <div id="editar-receta" style="background:#fff;border:2px solid #1a56db;border-radius:4px;padding:24px;max-width:720px;margin-bottom:32px">
            <h2 style="margin-top:0;color:#1a56db">Editando: <?php echo esc_html( $edit_rec->post_title ); ?></h2>
            <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
                <input type="hidden" name="action" value="ogape_edit_recipe">
                <input type="hidden" name="recipe_id" value="<?php echo (int) $edit_id; ?>">
                <?php wp_nonce_field( 'ogape_edit_recipe' ); ?>
                <?php ogape_ops_recipe_form_fields( $grad_options, $tag_map, $e_vals ?? array() ); ?>
                <p class="submit">
                    <button type="submit" class="button button-primary">Guardar cambios</button>
                    <a href="<?php echo esc_url( admin_url( 'admin.php?page=ogape-recetas' ) ); ?>" class="button">Cancelar</a>
                </p>
            </form>
        </div>
        <?php endif; ?>

        <!-- Add recipe form -->
        <div id="agregar-receta" style="background:#fff;border:1px solid #c3c4c7;border-radius:4px;padding:24px;max-width:720px">
            <h2 style="margin-top:0">Agregar receta</h2>
            <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
                <input type="hidden" name="action" value="ogape_create_recipe">
                <?php wp_nonce_field( 'ogape_create_recipe' ); ?>
                <?php ogape_ops_recipe_form_fields( $grad_options, $tag_map ); ?>
                <p class="submit"><button type="submit" class="button button-primary">Guardar receta</button></p>
            </form>
        </div>
    </div>
    <?php
}
