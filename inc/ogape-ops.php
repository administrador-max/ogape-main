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
