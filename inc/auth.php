<?php
/**
 * inc/auth.php
 * Authentication helpers: login, register, forgot-password, account-setup.
 */

/**
 * Process a login POST submission.
 *
 * @return WP_User|WP_Error
 */
function ogape_process_login() {
    if (
        ! isset( $_POST['ogape_login_nonce'] ) ||
        ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['ogape_login_nonce'] ) ), 'ogape_login' )
    ) {
        return new WP_Error( 'invalid_nonce', __( 'Error de seguridad. Por favor, recargá la página.', 'ogape-child' ) );
    }

    $email    = sanitize_email( wp_unslash( $_POST['email'] ?? '' ) );
    $password = wp_unslash( $_POST['password'] ?? '' );

    if ( ! $email || ! $password ) {
        return new WP_Error( 'missing_fields', __( 'Email y contraseña son requeridos.', 'ogape-child' ) );
    }

    $user = wp_authenticate( $email, $password );

    if ( is_wp_error( $user ) ) {
        return new WP_Error( 'auth_failed', __( 'Email o contraseña incorrectos.', 'ogape-child' ) );
    }

    wp_set_auth_cookie( $user->ID, false );
    wp_set_current_user( $user->ID );

    return $user;
}

/**
 * Process a register POST submission.
 *
 * @return WP_User|WP_Error
 */
function ogape_process_register() {
    if (
        ! isset( $_POST['ogape_register_nonce'] ) ||
        ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['ogape_register_nonce'] ) ), 'ogape_register' )
    ) {
        return new WP_Error( 'invalid_nonce', __( 'Error de seguridad. Por favor, recargá la página.', 'ogape-child' ) );
    }

    $name     = sanitize_text_field( wp_unslash( $_POST['name'] ?? '' ) );
    $email    = sanitize_email( wp_unslash( $_POST['email'] ?? '' ) );
    $phone    = sanitize_text_field( wp_unslash( $_POST['phone'] ?? '' ) );
    $password = wp_unslash( $_POST['password'] ?? '' );

    if ( ! $name || ! $email || ! $password ) {
        return new WP_Error( 'missing_fields', __( 'Nombre, email y contraseña son requeridos.', 'ogape-child' ) );
    }

    if ( ! is_email( $email ) ) {
        return new WP_Error( 'invalid_email', __( 'El email ingresado no es válido.', 'ogape-child' ) );
    }

    if ( strlen( $password ) < 8 ) {
        return new WP_Error( 'weak_password', __( 'La contraseña debe tener al menos 8 caracteres.', 'ogape-child' ) );
    }

    if ( email_exists( $email ) ) {
        return new WP_Error( 'email_exists', __( 'Ya existe una cuenta con ese email.', 'ogape-child' ) );
    }

    $user_id = wp_insert_user( array(
        'user_login'   => $email,
        'user_email'   => $email,
        'user_pass'    => $password,
        'display_name' => $name,
        'first_name'   => $name,
    ) );

    if ( is_wp_error( $user_id ) ) {
        return new WP_Error( 'registration_failed', __( 'No se pudo crear la cuenta. Intentá de nuevo.', 'ogape-child' ) );
    }

    if ( $phone ) {
        update_user_meta( $user_id, 'ogape_phone', $phone );
    }

    wp_set_auth_cookie( $user_id, false );
    wp_set_current_user( $user_id );

    return get_user_by( 'id', $user_id );
}

/**
 * Process a forgot-password POST submission.
 * Always returns true to avoid leaking whether an email exists.
 *
 * @return true|WP_Error
 */
function ogape_process_forgot_password() {
    if (
        ! isset( $_POST['ogape_forgot_nonce'] ) ||
        ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['ogape_forgot_nonce'] ) ), 'ogape_forgot' )
    ) {
        return new WP_Error( 'invalid_nonce', __( 'Error de seguridad. Por favor, recargá la página.', 'ogape-child' ) );
    }

    $email = sanitize_email( wp_unslash( $_POST['email'] ?? '' ) );

    if ( ! $email || ! is_email( $email ) ) {
        return new WP_Error( 'invalid_email', __( 'Ingresá un email válido.', 'ogape-child' ) );
    }

    $user = get_user_by( 'email', $email );

    if ( $user ) {
        $key = get_password_reset_key( $user );
        if ( ! is_wp_error( $key ) ) {
            $reset_url = add_query_arg(
                array(
                    'key'   => rawurlencode( $key ),
                    'login' => rawurlencode( $user->user_login ),
                ),
                home_url( '/reset-password/' )
            );
            $message = sprintf(
                /* translators: %s: password reset URL */
                __( "Hola,\n\nRecibiste este mensaje porque solicitaste restablecer la contraseña de tu cuenta Ogape.\n\nUsá el siguiente enlace para crear una nueva contraseña:\n\n%s\n\nEste enlace expira en 24 horas.\n\nSi no pediste esto, podés ignorar este mensaje.\n\n— Ogape", 'ogape-child' ),
                $reset_url
            );
            wp_mail(
                $user->user_email,
                __( 'Restablecé tu contraseña — Ogape', 'ogape-child' ),
                $message
            );
        }
    }

    return true;
}

/**
 * Process an account-setup POST submission.
 *
 * @return true|WP_Error
 */
function ogape_process_account_setup() {
    if ( ! is_user_logged_in() ) {
        return new WP_Error( 'not_logged_in', '' );
    }

    if (
        ! isset( $_POST['ogape_setup_nonce'] ) ||
        ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['ogape_setup_nonce'] ) ), 'ogape_setup' )
    ) {
        return new WP_Error( 'invalid_nonce', __( 'Error de seguridad. Por favor, recargá la página.', 'ogape-child' ) );
    }

    $zone       = sanitize_text_field( wp_unslash( $_POST['zone'] ?? '' ) );
    $address    = sanitize_text_field( wp_unslash( $_POST['address'] ?? '' ) );
    $preference = sanitize_text_field( wp_unslash( $_POST['preference'] ?? '' ) );
    $notes      = sanitize_textarea_field( wp_unslash( $_POST['notes'] ?? '' ) );

    if ( ! $zone || ! $address ) {
        return new WP_Error( 'missing_fields', __( 'Barrio y dirección son requeridos.', 'ogape-child' ) );
    }

    $user_id = get_current_user_id();
    update_user_meta( $user_id, 'ogape_zone', $zone );
    update_user_meta( $user_id, 'ogape_address', $address );
    update_user_meta( $user_id, 'ogape_preference', $preference );
    update_user_meta( $user_id, 'ogape_delivery_notes', $notes );

    return true;
}

/**
 * Validate a password reset key from the URL.
 *
 * @param string $key   Raw key from query string.
 * @param string $login Raw login from query string.
 * @return WP_User|WP_Error
 */
function ogape_check_reset_key( $key, $login ) {
    $key   = sanitize_text_field( wp_unslash( $key ) );
    $login = sanitize_user( wp_unslash( $login ) );

    if ( ! $key || ! $login ) {
        return new WP_Error( 'invalid_key', __( 'El enlace de restablecimiento no es válido o ya fue usado.', 'ogape-child' ) );
    }

    $user = check_password_reset_key( $key, $login );

    if ( is_wp_error( $user ) ) {
        return new WP_Error( 'invalid_key', __( 'El enlace de restablecimiento no es válido o ya expiró. Solicitá uno nuevo.', 'ogape-child' ) );
    }

    return $user;
}

/**
 * Process a reset-password POST submission.
 *
 * @param WP_User $user The user object returned by ogape_check_reset_key().
 * @return true|WP_Error
 */
function ogape_process_reset_password( $user ) {
    if (
        ! isset( $_POST['ogape_reset_nonce'] ) ||
        ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['ogape_reset_nonce'] ) ), 'ogape_reset' )
    ) {
        return new WP_Error( 'invalid_nonce', __( 'Error de seguridad. Por favor, recargá la página.', 'ogape-child' ) );
    }

    $password = wp_unslash( $_POST['password'] ?? '' );
    $confirm  = wp_unslash( $_POST['password_confirm'] ?? '' );

    if ( ! $password ) {
        return new WP_Error( 'missing_password', __( 'Ingresá una nueva contraseña.', 'ogape-child' ) );
    }

    if ( strlen( $password ) < 8 ) {
        return new WP_Error( 'weak_password', __( 'La contraseña debe tener al menos 8 caracteres.', 'ogape-child' ) );
    }

    if ( $password !== $confirm ) {
        return new WP_Error( 'password_mismatch', __( 'Las contraseñas no coinciden.', 'ogape-child' ) );
    }

    reset_password( $user, $password );

    return true;
}
