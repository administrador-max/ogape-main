<?php
/**
 * Mail transport configuration for Ogape
 *
 * Routes wp_mail() through Google Workspace SMTP relay and keeps sender
 * identity consistent across transactional emails.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! function_exists( 'ogape_mail_from_email' ) ) {
    function ogape_mail_from_email() {
        $email = defined( 'OGAPE_MAIL_FROM_EMAIL' ) ? OGAPE_MAIL_FROM_EMAIL : 'no-reply@ogape.com.py';
        return sanitize_email( $email );
    }
}

if ( ! function_exists( 'ogape_mail_from_name' ) ) {
    function ogape_mail_from_name() {
        return defined( 'OGAPE_MAIL_FROM_NAME' ) && OGAPE_MAIL_FROM_NAME ? sanitize_text_field( OGAPE_MAIL_FROM_NAME ) : 'Ogape';
    }
}

if ( ! function_exists( 'ogape_mail_reply_to' ) ) {
    function ogape_mail_reply_to() {
        $email = defined( 'OGAPE_MAIL_REPLY_TO' ) ? OGAPE_MAIL_REPLY_TO : 'hola@ogape.com.py';
        return sanitize_email( $email );
    }
}

/**
 * Only register our own SMTP hooks if WP Mail SMTP (or a compatible plugin) is NOT active.
 * When WP Mail SMTP is active it owns phpmailer_init, wp_mail_from, and wp_mail_from_name —
 * registering the same hooks here causes double-configuration and unpredictable behaviour.
 */
function ogape_mail_smtp_plugin_active() {
    return class_exists( 'WPMailSMTP\Core' )          // WP Mail SMTP 2.x+
        || function_exists( 'wp_mail_smtp' )           // WP Mail SMTP 1.x
        || class_exists( 'PHPMailer\PHPMailer\Exception' ) && defined( 'WPMS_PLUGIN_VER' ); // extra guard
}

if ( ! function_exists( 'ogape_filter_mail_from' ) ) {
    function ogape_filter_mail_from( $from_email ) {
        $configured = ogape_mail_from_email();
        return $configured ? $configured : $from_email;
    }
    if ( ! ogape_mail_smtp_plugin_active() ) {
        add_filter( 'wp_mail_from', 'ogape_filter_mail_from' );
    }
}

if ( ! function_exists( 'ogape_filter_mail_from_name' ) ) {
    function ogape_filter_mail_from_name( $from_name ) {
        $configured = ogape_mail_from_name();
        return $configured ? $configured : $from_name;
    }
    if ( ! ogape_mail_smtp_plugin_active() ) {
        add_filter( 'wp_mail_from_name', 'ogape_filter_mail_from_name' );
    }
}

if ( ! function_exists( 'ogape_configure_phpmailer' ) ) {
    function ogape_configure_phpmailer( $phpmailer ) {
        $phpmailer->isSMTP();
        $phpmailer->Host       = defined( 'OGAPE_SMTP_HOST' ) ? OGAPE_SMTP_HOST : 'smtp-relay.gmail.com';
        $phpmailer->Port       = defined( 'OGAPE_SMTP_PORT' ) ? (int) OGAPE_SMTP_PORT : 587;
        $phpmailer->SMTPAuth   = false;
        $phpmailer->SMTPSecure = defined( 'OGAPE_SMTP_SECURE' ) ? OGAPE_SMTP_SECURE : 'tls';

        $from_email = ogape_mail_from_email();
        $from_name  = ogape_mail_from_name();
        $reply_to   = ogape_mail_reply_to();

        if ( $from_email && is_email( $from_email ) ) {
            $phpmailer->From   = $from_email;
            $phpmailer->Sender = $from_email;
        }

        if ( $from_name ) {
            $phpmailer->FromName = $from_name;
        }

        if ( $reply_to && is_email( $reply_to ) && empty( $phpmailer->getReplyToAddresses() ) ) {
            $phpmailer->addReplyTo( $reply_to, $from_name );
        }
    }
    if ( ! ogape_mail_smtp_plugin_active() ) {
        add_action( 'phpmailer_init', 'ogape_configure_phpmailer' );
    }
}
