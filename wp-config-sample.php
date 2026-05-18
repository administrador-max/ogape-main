<?php
/**
 * Ogape child theme — required wp-config.php constants.
 *
 * Copy the definitions below into your wp-config.php (NOT this file).
 * This file is documentation only and is never loaded by WordPress.
 *
 * Deployment checklist:
 *  1. Define all constants below in wp-config.php on the server.
 *  2. Set WP_DEBUG and WP_DEBUG_LOG to false in production.
 *  3. Set a strong AUTH_KEY in wp-config.php (used to sign session cookies).
 */

// ── SMTP (PHPMailer / wp_mail) ────────────────────────────────────────────────
// The theme hooks into phpmailer_init to configure outgoing mail.
define( 'OGAPE_SMTP_HOST',   'smtp-relay.gmail.com' ); // SMTP server hostname
define( 'OGAPE_SMTP_PORT',   587 );                    // 587 = STARTTLS, 465 = SSL
define( 'OGAPE_SMTP_SECURE', 'tls' );                  // 'tls' or 'ssl'

// ── Mail sender identity ──────────────────────────────────────────────────────
define( 'OGAPE_MAIL_FROM_EMAIL', 'no-reply@ogape.com.py' );
define( 'OGAPE_MAIL_FROM_NAME',  'Ogape' );
define( 'OGAPE_MAIL_REPLY_TO',   'hola@ogape.com.py' );

// ── Internal notifications ────────────────────────────────────────────────────
// Address that receives new waitlist signup alerts and admin notifications.
define( 'OGAPE_WAITLIST_TEAM_EMAIL', 'equipo@ogape.com.py' );

// ── Feature flags ─────────────────────────────────────────────────────────────
// Set to 1 once the pilot subscription period has started (controls UI copy).
define( 'OGAPE_PILOT_START', 0 );

// ── WhatsApp contact number ───────────────────────────────────────────────────
// Set via Customizer: Appearance → Customize → ogape_whatsapp (theme mod).
// Format: +595 XXX XXXXXX  — stored as a theme mod, not a constant.

// ── Debug (must be false in production) ──────────────────────────────────────
define( 'WP_DEBUG',         false );
define( 'WP_DEBUG_LOG',     false );
define( 'WP_DEBUG_DISPLAY', false );
