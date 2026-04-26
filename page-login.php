<?php
/**
 * Template Name: Login
 * Template Post Type: page
 *
 * Self-contained design from the Website-handoff bundle
 * (Website-handoff (4).zip, 2026-04-25, website/project/iniciar-sesion.html).
 * Theme chrome is hidden via assets/css/login.css so the page
 * renders the standalone design verbatim — no theme overlay.
 */

get_header();

$home_url            = home_url( '/' );
$register_url        = home_url( '/register/' );
$account_url         = home_url( '/account/' );
$forgot_password_url = home_url( '/forgot-password/' );
$menu_url            = home_url( '/menu/' );
$plans_url           = home_url( '/#plan' );
$logo_url            = get_stylesheet_directory_uri() . '/assets/img/ogape-logo.svg';
$privacy_url         = home_url( '/privacidad/' );
$terms_url           = home_url( '/terminos/' );
$wa_url              = function_exists( 'ogape_get_whatsapp_url' ) ? ogape_get_whatsapp_url() : '#';

$redirect_to = isset( $_GET['redirect_to'] ) ? rawurldecode( sanitize_text_field( wp_unslash( $_GET['redirect_to'] ) ) ) : '';

$login_error  = '';
$login_notice = '';
if ( isset( $_GET['error'] ) ) {
	$login_error = __( 'Email o contraseña incorrectos. Revisá los datos e intentá de nuevo.', 'ogape-child' );
}
if ( isset( $_GET['reset'] ) ) {
	$login_notice = __( 'Si ese email tiene una cuenta, te mandamos el enlace de recuperación.', 'ogape-child' );
}
?>

<div class="login-design">

<!-- NAV -->
<header class="nav">
  <div class="wrap nav__inner">
    <a href="<?php echo esc_url( $home_url ); ?>" class="nav__brand" aria-label="Ogape Tu Chef en Casa · inicio">
      <img src="<?php echo esc_url( $logo_url ); ?>" alt="">
      <span>
        <span class="wordmark">Ogape</span>
        <span class="where">Tu Chef en Casa</span>
      </span>
    </a>
    <nav aria-label="Principal">
      <ul class="nav__links">
        <li><a href="<?php echo esc_url( $plans_url ); ?>">Planes</a></li>
        <li><a href="<?php echo esc_url( home_url( '/nosotros/' ) ); ?>">Nosotros</a></li>
        <li><a href="<?php echo esc_url( $menu_url ); ?>">Menús</a></li>
        <li><a href="<?php echo esc_url( $plans_url ); ?>">Kits</a></li>
        <li><a href="<?php echo esc_url( home_url( '/tarjetas-regalo/' ) ); ?>">Tarjetas regalo</a></li>
        <li><a href="<?php echo esc_url( home_url( '/sostenibilidad/' ) ); ?>">Sostenibilidad</a></li>
        <li><a href="<?php echo esc_url( home_url( '/alianzas/' ) ); ?>">Alianzas</a></li>
      </ul>
    </nav>
    <div class="nav__right">
      <span class="nav__signin" style="color:var(--brand-primary-strong)"><?php esc_html_e( 'Iniciar sesión', 'ogape-child' ); ?></span>
      <a href="<?php echo esc_url( $register_url ); ?>" class="nav__cta"><?php esc_html_e( 'Unirme', 'ogape-child' ); ?></a>
    </div>
  </div>
</header>

<main class="page" id="main" role="main">
  <div class="card">

    <!-- HEADER -->
    <div class="card__head">
      <span class="card__eyebrow"><span class="dot"></span><?php esc_html_e( 'Tu cuenta', 'ogape-child' ); ?></span>
      <h1 class="card__title"><?php esc_html_e( 'Bienvenido', 'ogape-child' ); ?><br><em><?php esc_html_e( 'de vuelta.', 'ogape-child' ); ?></em></h1>
      <p class="card__sub"><?php esc_html_e( 'Ingresá para ver el menú de la semana, tu próxima entrega y tus recetas favoritas.', 'ogape-child' ); ?></p>
    </div>

    <!-- BOX -->
    <div class="box">

      <!-- ERROR -->
      <div class="error-msg<?php echo $login_error ? ' is-visible' : ''; ?>" id="loginErrorMsg" role="alert">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M12 8v4m0 4h.01"/></svg>
        <span id="loginErrorText"><?php echo $login_error ? esc_html( $login_error ) : esc_html__( 'Email o contraseña incorrectos. Intentá de nuevo.', 'ogape-child' ); ?></span>
      </div>

      <!-- NOTICE (password reset) -->
      <?php if ( $login_notice ) : ?>
      <div class="notice-msg" role="status">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12l4 4L19 7"/></svg>
        <span><?php echo esc_html( $login_notice ); ?></span>
      </div>
      <?php endif; ?>

      <form id="loginForm" action="<?php echo esc_url( home_url( '/login/' ) ); ?>" method="post" novalidate>
        <input type="hidden" name="ogape_demo_action" value="login">
        <input type="hidden" name="ogape_demo_nonce" value="<?php echo esc_attr( wp_create_nonce( 'ogape_demo_account_flow' ) ); ?>">
        <?php if ( $redirect_to ) : ?>
          <input type="hidden" name="redirect_to" value="<?php echo esc_attr( $redirect_to ); ?>">
        <?php endif; ?>

        <!-- EMAIL -->
        <div class="field">
          <label for="loginEmail"><?php esc_html_e( 'Email', 'ogape-child' ); ?></label>
          <input class="input" id="loginEmail" name="email" type="email" placeholder="maria@correo.com.py" autocomplete="email" required>
        </div>

        <!-- PASSWORD -->
        <div class="field">
          <label for="loginPw"><?php esc_html_e( 'Contraseña', 'ogape-child' ); ?></label>
          <div class="input-wrap">
            <input class="input input--pw" id="loginPw" name="password" type="password" placeholder="Tu contraseña" autocomplete="current-password" required>
            <button type="button" class="toggle" id="loginPwToggle" aria-label="<?php esc_attr_e( 'Mostrar contraseña', 'ogape-child' ); ?>">
              <svg id="loginEyeIcon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12Z"/>
                <circle cx="12" cy="12" r="3"/>
              </svg>
            </button>
          </div>
        </div>

        <!-- META -->
        <div class="meta">
          <label class="check">
            <input type="checkbox" id="loginRemember" name="remember">
            <span class="check__box">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l4 4L19 7"/></svg>
            </span>
            <?php esc_html_e( 'Recordarme', 'ogape-child' ); ?>
          </label>
          <a href="<?php echo esc_url( $forgot_password_url ); ?>" class="forgot"><?php esc_html_e( 'Olvidé mi contraseña', 'ogape-child' ); ?></a>
        </div>

        <!-- SUBMIT -->
        <button type="submit" class="btn btn--primary" id="loginSubmitBtn">
          <?php esc_html_e( 'Iniciar sesión', 'ogape-child' ); ?>
          <svg viewBox="0 0 16 16" fill="none" aria-hidden="true"><path d="M4 8h8m-3-3l3 3-3 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </button>
      </form>

      <!-- SOCIAL -->
      <div class="or"><?php esc_html_e( 'o ingresá con', 'ogape-child' ); ?></div>
      <div class="social">
        <button type="button" class="btn btn--social">
          <svg viewBox="0 0 24 24" width="18" height="18" aria-hidden="true"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09Z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.99.66-2.25 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84A10.99 10.99 0 0 0 12 23Z"/><path fill="#FBBC04" d="M5.84 14.1c-.22-.66-.35-1.36-.35-2.1s.13-1.44.35-2.1V7.06H2.18A10.97 10.97 0 0 0 1 12c0 1.77.42 3.45 1.18 4.94l3.66-2.84Z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.07.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84C6.71 7.31 9.14 5.38 12 5.38Z"/></svg>
          Google
        </button>
        <button type="button" class="btn btn--social">
          <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor" aria-hidden="true"><path d="M17.05 20.28c-.98.95-2.05.8-3.08.35-1.09-.46-2.09-.48-3.24 0-1.44.62-2.2.44-3.06-.35C2.79 15.25 3.51 7.59 9.05 7.31c1.35.07 2.29.74 3.08.8 1.18-.24 2.31-.93 3.57-.84 1.51.12 2.65.72 3.4 1.8-3.12 1.87-2.38 5.98.48 7.13-.57 1.5-1.31 2.99-2.53 4.08ZM12.03 7.25c-.15-2.23 1.66-4.07 3.74-4.25.29 2.58-2.34 4.5-3.74 4.25Z"/></svg>
          Apple
        </button>
      </div>
    </div>

    <!-- SIGNUP PROMPT -->
    <p class="signup-prompt"><?php esc_html_e( '¿Todavía no tenés cuenta?', 'ogape-child' ); ?><a href="<?php echo esc_url( $register_url ); ?>"><?php esc_html_e( 'Unirme a Ogape', 'ogape-child' ); ?></a></p>

  </div>
</main>

<footer class="foot">
  <a href="<?php echo esc_url( $terms_url ); ?>"><?php esc_html_e( 'Términos', 'ogape-child' ); ?></a> ·
  <a href="<?php echo esc_url( $privacy_url ); ?>"><?php esc_html_e( 'Privacidad', 'ogape-child' ); ?></a> ·
  <a href="<?php echo esc_url( $wa_url ); ?>"><?php esc_html_e( 'Ayuda por WhatsApp', 'ogape-child' ); ?></a>
</footer>

</div><!-- /.login-design -->

<script>
(function () {
  var root = document.querySelector('.login-design');
  if (!root) return;

  var $ = function (id) { return document.getElementById(id); };

  // Password toggle
  var pw = $('loginPw'), toggle = $('loginPwToggle'), eyeIcon = $('loginEyeIcon');
  toggle.addEventListener('click', function () {
    var isText = pw.type === 'text';
    pw.type = isText ? 'password' : 'text';
    toggle.setAttribute('aria-label', isText ? 'Mostrar contraseña' : 'Ocultar contraseña');
    eyeIcon.innerHTML = isText
      ? '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12Z"/><circle cx="12" cy="12" r="3"/>'
      : '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/><path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/><line x1="1" y1="1" x2="23" y2="23"/>';
  });

  // Client-side pre-submit validation (empty field check only — real auth is server-side)
  $('loginForm').addEventListener('submit', function (e) {
    var email = $('loginEmail').value.trim();
    var pass  = $('loginPw').value;
    var err   = $('loginErrorMsg');
    var errTxt = $('loginErrorText');

    if (!email || !pass) {
      e.preventDefault();
      errTxt.textContent = 'Completá tu email y contraseña.';
      err.classList.add('is-visible');
      (!email ? $('loginEmail') : $('loginPw')).focus();
      return;
    }

    // Loading state
    err.classList.remove('is-visible');
    var btn = $('loginSubmitBtn');
    btn.classList.add('btn--loading');
    btn.innerHTML = '<span class="spinner"></span> Ingresando…';
  });
})();
</script>

<?php get_footer(); ?>
