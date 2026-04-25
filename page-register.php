<?php
/**
 * Register (account creation) page — Ogape Tu Chef en Casa.
 *
 * Template Name: Register
 * Template Post Type: page
 *
 * Self-contained design from the Website-handoff bundle
 * (Claude Design export, 2026-04-17, website/project/unirme.html).
 * Theme chrome is hidden via assets/css/register.css so the page
 * renders the standalone design verbatim — no theme overlay.
 */

get_header();

$home_url     = home_url( '/' );
$login_url    = home_url( '/login/' );
$menu_url     = home_url( '/menu/' );
$privacy_url  = home_url( '/privacidad/' );
$terms_url    = home_url( '/terminos/' );
$logo_url     = get_stylesheet_directory_uri() . '/assets/img/ogape-logo.svg';
$wa_url       = function_exists( 'ogape_get_whatsapp_url' ) ? ogape_get_whatsapp_url() : '#';
$demo_context = function_exists( 'ogape_get_demo_account_context' ) ? ogape_get_demo_account_context() : array();
$schedule     = $demo_context['schedule'] ?? array();

$delivery_label       = $schedule['delivery_label'] ?? __( 'el próximo jueves', 'ogape-child' );
$delivery_short_label = $schedule['delivery_short_label'] ?? __( 'Próximo jueves', 'ogape-child' );
$cutoff_label         = $schedule['cutoff_label'] ?? __( 'martes previo', 'ogape-child' );
$cutoff_time          = $schedule['cutoff_time'] ?? '23:59';
?>

<div class="register-design">

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
    <a href="<?php echo esc_url( $home_url ); ?>" class="nav__back">
      <svg viewBox="0 0 16 16" fill="none" aria-hidden="true"><path d="M12 8H4m3 3L4 8l3-3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
      Volver al inicio
    </a>
    <span class="nav__signin">¿Ya tenés cuenta? <b><a href="<?php echo esc_url( $login_url ); ?>">Iniciar sesión</a></b></span>
  </div>
</header>

<main class="page">
  <div class="wrap page__grid">

    <!-- ─── FORM ─── -->
    <section class="form" aria-labelledby="form-title">
	      <div class="form__head">
	        <span class="form__eyebrow"><span class="dot"></span>Unirme · Menú piloto</span>
	        <h1 class="form__title" id="form-title">Creá tu cuenta y <em>empezá a cocinar</em> el jueves.</h1>
	        <p class="form__sub">Cuatro pasos cortos. Sin suscripción rígida: pausás o cancelás la semana que necesites. La primera caja queda programada para <?php echo esc_html( $delivery_label ); ?> si confirmás antes del <?php echo esc_html( $cutoff_label ); ?> a las <?php echo esc_html( $cutoff_time ); ?>.</p>
	      </div>

      <!-- STEPPER -->
      <div class="steps" role="progressbar" aria-valuemin="1" aria-valuemax="4" aria-valuenow="1" id="register-stepper">
        <div class="step is-active" data-step="1">
          <div class="step__bar"></div>
          <div class="step__label"><span class="step__num">i.</span> Tu cuenta</div>
        </div>
        <div class="step" data-step="2">
          <div class="step__bar"></div>
          <div class="step__label"><span class="step__num">ii.</span> Entrega</div>
        </div>
        <div class="step" data-step="3">
          <div class="step__bar"></div>
          <div class="step__label"><span class="step__num">iii.</span> Tu caja</div>
        </div>
        <div class="step" data-step="4">
          <div class="step__bar"></div>
          <div class="step__label"><span class="step__num">iv.</span> Confirmar</div>
        </div>
      </div>

	      <form id="register-signup" action="<?php echo esc_url( home_url( '/register/' ) ); ?>" method="post" novalidate data-delivery-label="<?php echo esc_attr( $delivery_label ); ?>" data-delivery-short-label="<?php echo esc_attr( $delivery_short_label ); ?>" data-cutoff-label="<?php echo esc_attr( $cutoff_label ); ?>" data-cutoff-time="<?php echo esc_attr( $cutoff_time ); ?>">
	        <input type="hidden" name="ogape_demo_action" value="register">
	        <input type="hidden" name="ogape_demo_nonce" value="<?php echo esc_attr( wp_create_nonce( 'ogape_demo_account_flow' ) ); ?>">
	        <input type="hidden" name="zone" id="register-zoneLabel" value="">
	        <input type="hidden" name="delivery_window_label" id="register-windowLabel" value="Tarde · 14:00 – 19:00">

        <!-- PANEL 1 — ACCOUNT -->
        <div class="panel is-active" data-panel="1">
          <h2 class="panel__h">Tu cuenta</h2>
          <p class="panel__p">Con esto guardamos tus preferencias, historial de recetas y la dirección para el repartidor.</p>

          <div class="field field__row field__row--2">
            <div>
              <label class="lbl" for="register-fname">Nombre</label>
	              <input class="input" id="register-fname" name="first_name" type="text" placeholder="María" autocomplete="given-name" required>
            </div>
            <div>
              <label class="lbl" for="register-lname">Apellido</label>
	              <input class="input" id="register-lname" name="last_name" type="text" placeholder="Benítez" autocomplete="family-name" required>
            </div>
          </div>

          <div class="field">
            <label class="lbl" for="register-email">Email</label>
	            <input class="input" id="register-email" name="email" type="email" placeholder="maria@correo.com.py" autocomplete="email" required>
            <p class="hint">Te mandamos el menú de la semana los viernes a la mañana. Nada más.</p>
          </div>

          <div class="field">
            <label class="lbl" for="register-phone">Teléfono (WhatsApp)</label>
	            <input class="input" id="register-phone" name="phone" type="tel" placeholder="+595 981 000 000" autocomplete="tel">
            <p class="hint">Solo para avisarte de la entrega. Nunca para promociones.</p>
          </div>

          <div class="field">
            <label class="lbl" for="register-pw">Contraseña</label>
            <div class="input-wrap">
	              <input class="input input--pw" id="register-pw" name="password" type="password" placeholder="Mínimo 8 caracteres" autocomplete="new-password" required>
              <button type="button" class="toggle" id="register-pwToggle" aria-label="Mostrar contraseña">
                <svg id="register-pwEye" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12Z"/><circle cx="12" cy="12" r="3"/></svg>
              </button>
            </div>
            <div class="pwmeter" id="register-pwmeter" data-s="0"><span></span><span></span><span></span><span></span></div>
            <p class="pwmeter-label">Fuerza: <b id="register-pwLabel">—</b></p>
          </div>

          <label class="check">
	            <input type="checkbox" id="register-terms" name="terms" value="1" required>
            <span class="check__box"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l4 4L19 7"/></svg></span>
            <span>Al crear la cuenta acepto los <a href="<?php echo esc_url( $terms_url ); ?>">Términos</a> y la <a href="<?php echo esc_url( $privacy_url ); ?>">Política de privacidad</a> de Ogape. Puedo pausar o cancelar cuando quiera.</span>
          </label>

          <div class="or">o registrate con</div>
          <div class="social">
            <button type="button" class="btn">
              <svg viewBox="0 0 24 24" width="18" height="18" aria-hidden="true"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09Z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.99.66-2.25 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84A10.99 10.99 0 0 0 12 23Z"/><path fill="#FBBC04" d="M5.84 14.1c-.22-.66-.35-1.36-.35-2.1s.13-1.44.35-2.1V7.06H2.18A10.97 10.97 0 0 0 1 12c0 1.77.42 3.45 1.18 4.94l3.66-2.84Z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.07.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84C6.71 7.31 9.14 5.38 12 5.38Z"/></svg>
              Continuar con Google
            </button>
            <button type="button" class="btn">
              <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor" aria-hidden="true"><path d="M17.05 20.28c-.98.95-2.05.8-3.08.35-1.09-.46-2.09-.48-3.24 0-1.44.62-2.2.44-3.06-.35C2.79 15.25 3.51 7.59 9.05 7.31c1.35.07 2.29.74 3.08.8 1.18-.24 2.31-.93 3.57-.84 1.51.12 2.65.72 3.4 1.8-3.12 1.87-2.38 5.98.48 7.13-.57 1.5-1.31 2.99-2.53 4.08ZM12.03 7.25c-.15-2.23 1.66-4.07 3.74-4.25.29 2.58-2.34 4.5-3.74 4.25Z"/></svg>
              Continuar con Apple
            </button>
          </div>
        </div>

        <!-- PANEL 2 — DELIVERY -->
        <div class="panel" data-panel="2">
          <h2 class="panel__h">Entrega en Asunción</h2>
          <p class="panel__p">Hacemos entregas los jueves entre 10:00 y 19:00. Elegí tu barrio y dejanos la dirección exacta — si no estás, dejamos en portería.</p>

          <div class="field">
            <label class="lbl" for="register-zone">Tu barrio</label>
	            <select class="select" id="register-zone" name="zone_key" required>
              <option value="">Elegí tu barrio</option>
              <optgroup label="Zonas activas">
                <option value="villa-morra">Villa Morra</option>
                <option value="recoleta">Recoleta</option>
                <option value="las-carmelitas">Las Carmelitas</option>
                <option value="mburucuya">Mburucuyá</option>
                <option value="ykua-sati">Ykua Satí</option>
                <option value="centro">Centro</option>
              </optgroup>
              <optgroup label="Próximamente">
                <option value="san-lorenzo" data-soon="1">San Lorenzo</option>
                <option value="lambare" data-soon="1">Lambaré</option>
              </optgroup>
              <option value="otra" data-soon="1">Otra zona de Asunción</option>
            </select>
            <div id="register-zoneAlert"></div>
          </div>

          <div class="field">
            <label class="lbl" for="register-address">Dirección</label>
	            <input class="input" id="register-address" name="address" type="text" placeholder="Av. Mcal. López 1234" autocomplete="street-address" required>
          </div>

          <div class="field field__row field__row--2">
            <div>
              <label class="lbl" for="register-apt">Depto / Piso</label>
	              <input class="input" id="register-apt" name="apt" type="text" placeholder="5B — opcional">
            </div>
            <div>
              <label class="lbl" for="register-window">Horario preferido</label>
	              <select class="select" id="register-window" name="delivery_window">
                <option value="am">Mañana · 10:00 – 13:00</option>
                <option value="pm" selected>Tarde · 14:00 – 19:00</option>
                <option value="any">Cualquier horario del jueves</option>
              </select>
            </div>
          </div>

          <div class="field">
            <label class="lbl" for="register-notes">Instrucciones para el repartidor</label>
	            <input class="input" id="register-notes" name="notes" type="text" placeholder="Timbre roto — llamar al WhatsApp al llegar">
            <p class="hint">Opcional. Todo lo que ayude al repartidor a encontrarte.</p>
          </div>
        </div>

        <!-- PANEL 3 — BOX -->
        <div class="panel" data-panel="3">
          <h2 class="panel__h">Tu caja de la semana</h2>
          <p class="panel__p">Podés cambiar el tamaño cada semana — esto es solo tu punto de partida.</p>

          <label class="lbl" style="margin-bottom:var(--space-3);display:block">¿Para cuántas personas?</label>
          <div class="opts" style="margin-bottom:var(--space-6)">
            <label class="opt is-checked" data-group="people" data-val="2">
              <input type="radio" name="people" value="2" checked>
              <span class="opt__check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l4 4L19 7"/></svg></span>
              <span class="opt__body">
                <span class="opt__k">Para 2</span>
                <span class="opt__n">Pareja</span>
                <span class="opt__p">2 porciones por receta</span>
              </span>
            </label>
            <label class="opt" data-group="people" data-val="4">
              <input type="radio" name="people" value="4">
              <span class="opt__check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l4 4L19 7"/></svg></span>
              <span class="opt__body">
                <span class="opt__k">Para 4</span>
                <span class="opt__n">Familia</span>
                <span class="opt__p">4 porciones por receta</span>
              </span>
            </label>
          </div>

          <label class="lbl" style="margin-bottom:var(--space-3);display:block">¿Cuántas recetas por semana?</label>
          <div class="opts opts--4" style="margin-bottom:var(--space-6)">
            <label class="opt is-checked" data-group="recipes" data-val="3">
              <input type="radio" name="recipes" value="3" checked>
              <span class="opt__check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l4 4L19 7"/></svg></span>
              <span class="opt__body">
                <span class="opt__k">3 recetas</span>
                <span class="opt__n">Ligero</span>
                <span class="opt__p">media semana</span>
              </span>
            </label>
            <label class="opt" data-group="recipes" data-val="4">
              <input type="radio" name="recipes" value="4">
              <span class="opt__check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l4 4L19 7"/></svg></span>
              <span class="opt__body">
                <span class="opt__k">4 recetas</span>
                <span class="opt__n">Intermedio</span>
                <span class="opt__p">casi toda la semana</span>
              </span>
            </label>
            <label class="opt" data-group="recipes" data-val="5">
              <input type="radio" name="recipes" value="5">
              <span class="opt__check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l4 4L19 7"/></svg></span>
              <span class="opt__body">
                <span class="opt__k">5 recetas</span>
                <span class="opt__n">Completa</span>
                <span class="opt__p">toda la semana</span>
              </span>
            </label>
            <label class="opt" data-group="recipes" data-val="2">
              <input type="radio" name="recipes" value="2">
              <span class="opt__check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l4 4L19 7"/></svg></span>
              <span class="opt__body">
                <span class="opt__k">2 recetas</span>
                <span class="opt__n">Cata</span>
                <span class="opt__p">probar el servicio</span>
              </span>
            </label>
          </div>

          <label class="lbl" style="margin-bottom:var(--space-3);display:block">Preferencias — podés marcar varias</label>
          <div class="chips" style="margin-bottom:var(--space-3)">
	            <label class="chip"><input type="checkbox" name="preferences[]" value="sin-pescado">Sin pescado</label>
	            <label class="chip"><input type="checkbox" name="preferences[]" value="sin-carne-roja">Sin carne roja</label>
	            <label class="chip"><input type="checkbox" name="preferences[]" value="vegetariano">Vegetariano</label>
	            <label class="chip"><input type="checkbox" name="preferences[]" value="sin-gluten">Sin gluten</label>
	            <label class="chip"><input type="checkbox" name="preferences[]" value="sin-lacteos">Sin lácteos</label>
	            <label class="chip"><input type="checkbox" name="preferences[]" value="picante-ok">Me gusta picante</label>
	            <label class="chip"><input type="checkbox" name="preferences[]" value="rapido">Menos de 25 min</label>
          </div>
          <p class="hint">Usamos esto para sugerirte recetas. Siempre vas a poder elegir manualmente cada semana.</p>

          <div class="field" style="margin-top:var(--space-6)">
            <label class="lbl" for="register-allergies">Alergias o ingredientes a evitar</label>
	            <input class="input" id="register-allergies" name="allergies" type="text" placeholder="Maní, mariscos — opcional">
          </div>
        </div>

        <!-- PANEL 4 — CONFIRM -->
        <div class="panel" data-panel="4">
          <h2 class="panel__h">Repasemos tu caja</h2>
	          <p class="panel__p">Si todo está bien, arrancamos con tu primera entrega el <b style="color:var(--text-primary);font-weight:600"><?php echo esc_html( $delivery_label ); ?></b>. Se cobra recién cuando sale la caja.</p>

          <div class="price-line">
            <div class="k">Tu primera caja<b id="register-sumTitle">Para 2 · 3 recetas</b></div>
            <div class="v" id="register-sumPrice">Gs 285.000<small>/ semana</small></div>
          </div>

          <div class="summary">
            <div class="sum-row"><span class="k">Cuenta</span><span class="v" id="register-sumAccount">—<small id="register-sumAccountSub">—</small></span><button type="button" class="edit" data-goto="1">Editar</button></div>
            <div class="sum-row"><span class="k">Entrega</span><span class="v" id="register-sumDelivery">—<small id="register-sumDeliverySub">Jueves · 14:00 – 19:00</small></span><button type="button" class="edit" data-goto="2">Editar</button></div>
            <div class="sum-row"><span class="k">Caja</span><span class="v" id="register-sumBox">Para 2 · 3 recetas<small id="register-sumBoxSub">Sin preferencias marcadas</small></span><button type="button" class="edit" data-goto="3">Editar</button></div>
	            <div class="sum-row"><span class="k">Primera entrega</span><span class="v"><?php echo esc_html( $delivery_short_label ); ?><small>Cierre de pedidos <?php echo esc_html( $cutoff_label ); ?> · <?php echo esc_html( $cutoff_time ); ?></small></span><span></span></div>
          </div>

          <label class="check" style="margin-bottom:var(--space-3)">
	            <input type="checkbox" id="register-comms" name="comms" value="1">
            <span class="check__box"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l4 4L19 7"/></svg></span>
            <span>Quiero recibir el menú de la semana los viernes (podés darte de baja desde cualquier mail).</span>
          </label>
          <label class="check">
	            <input type="checkbox" id="register-confirm" name="confirm" value="1" required>
            <span class="check__box"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l4 4L19 7"/></svg></span>
            <span>Confirmo que los datos son correctos y entiendo que <b style="color:var(--text-primary)">no hay cargo hasta el jueves</b> que sale la primera caja.</span>
          </label>
        </div>

        <!-- PANEL SUCCESS -->
        <div class="panel" data-panel="5">
          <div class="celebrate">
            <div class="celebrate__stamp">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l4 4L19 7"/></svg>
            </div>
            <h2 class="panel__h" style="font-size:36px;margin-bottom:var(--space-3)">Bienvenida a la mesa, <em id="register-wlcName" style="font-style:italic;color:var(--brand-primary-strong)">María</em>.</h2>
	            <p class="panel__p" style="max-width:48ch;margin:0 auto var(--space-8)">Tu primera caja sale el <b style="color:var(--text-primary)"><?php echo esc_html( $delivery_label ); ?></b>. Te mandamos el menú confirmado y el tracking por WhatsApp apenas cerremos pedidos.</p>
            <div style="display:flex;gap:var(--space-3);justify-content:center;flex-wrap:wrap">
              <a href="<?php echo esc_url( $menu_url ); ?>" class="btn btn--warm">Ver el menú de la semana
                <svg viewBox="0 0 16 16" fill="none" aria-hidden="true"><path d="M4 8h8m-3-3l3 3-3 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
              </a>
              <a href="<?php echo esc_url( $home_url ); ?>" class="btn btn--outline">Ir al inicio</a>
            </div>
          </div>
        </div>

        <!-- NAV -->
        <div class="form__nav" id="register-formNav">
          <button type="button" class="btn btn--ghost" id="register-backBtn" style="visibility:hidden">
            <svg viewBox="0 0 16 16" fill="none" aria-hidden="true"><path d="M12 8H4m3 3L4 8l3-3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            Atrás
          </button>
          <span class="spacer"></span>
          <span style="font-size:12px;color:var(--muted);letter-spacing:.04em" id="register-stepMeta">Paso 1 de 4</span>
	          <button type="button" class="btn btn--primary" id="register-nextBtn">
            Continuar
            <svg viewBox="0 0 16 16" fill="none" aria-hidden="true"><path d="M4 8h8m-3-3l3 3-3 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </button>
	        </div>
	        <p class="form-error" id="register-formError" role="alert" aria-live="polite"></p>
	      </form>
    </section>

    <!-- ─── SIDEBAR ─── -->
    <aside class="aside" aria-label="Resumen">
      <span class="aside__eyebrow"><span class="dot"></span>Tu próxima caja</span>
      <h2 class="aside__h">Cinco recetas, <em>elegidas despacio</em>.</h2>
      <p class="aside__p">Lo que estás creando ahora mismo: una caja semanal con ingredientes porcionados, del río, el monte y la huerta paraguaya.</p>

      <div class="aside__kit" aria-hidden="true">
        <div class="aside__chips">
          <span class="aside__chip aside__chip--accent">Surubí</span>
          <span class="aside__chip">Maracuyá</span>
          <span class="aside__chip">Mandioca</span>
          <span class="aside__chip">Bife koygua</span>
          <span class="aside__chip">Curry de coco</span>
          <span class="aside__chip">Alioli</span>
        </div>
        <div class="aside__tape"><span>Ogape</span><span>· Tu Chef en Casa ·</span></div>
        <div class="aside__num">N.º 01</div>
        <div class="aside__cap"><span>Plato estrella</span><b>Surubí al Maracuyá</b></div>
      </div>

      <ul class="perks">
        <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l4 4L19 7"/></svg>Sin suscripción rígida — pausás la semana que no estás.</li>
        <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l4 4L19 7"/></svg>Primera caja el jueves; se cobra recién al salir.</li>
        <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l4 4L19 7"/></svg>Ingredientes de productores de Central y pescadores del Paraná.</li>
        <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l4 4L19 7"/></svg>25 – 40 minutos en la cocina. Instrucciones ilustradas.</li>
      </ul>

      <div class="aside__price">
        <div class="k">Estimado semanal<b id="register-asidePlan">Para 2 · 3 recetas</b></div>
        <div class="v" id="register-asidePrice">Gs 285.000</div>
      </div>
    </aside>
  </div>

  <p class="foot">
    Al crear tu cuenta aceptás los <a href="<?php echo esc_url( $terms_url ); ?>">Términos</a> y la <a href="<?php echo esc_url( $privacy_url ); ?>">Política de privacidad</a>.
    ¿Problemas? <a href="<?php echo esc_url( $wa_url ); ?>">Escribinos por WhatsApp</a>.
  </p>
</main>

</div><!-- /.register-design -->

<script>
(function () {
  var root = document.querySelector('.register-design');
  if (!root) return;

	  var $  = function (s) { return root.querySelector(s); };
	  var $$ = function (s) { return Array.prototype.slice.call(root.querySelectorAll(s)); };
	  var form = $('#register-signup');
	  var errorBox = $('#register-formError');
	  var deliveryLabel = form.dataset.deliveryLabel || 'el próximo jueves';
	  var deliveryShortLabel = form.dataset.deliveryShortLabel || 'Próximo jueves';

	  // ── STATE ─────────────────────────────────────────────
	  var state = { step: 1, max: 4 };

  // Pricing matrix (Gs) — people × recipes
  var PRICE = {
    '2-2': 195000, '2-3': 285000, '2-4': 370000, '2-5': 445000,
    '4-2': 360000, '4-3': 530000, '4-4': 685000, '4-5': 820000
  };
	  var fmtGs = function (n) { return 'Gs ' + n.toLocaleString('es-PY'); };

	  function selectedText(selector) {
	    var field = $(selector);
	    return field && field.selectedOptions[0] ? field.selectedOptions[0].text : '';
	  }

	  function updateHiddenLabels() {
	    var zoneLabel = $('#register-zoneLabel');
	    var windowLabel = $('#register-windowLabel');
	    if (zoneLabel) zoneLabel.value = selectedText('#register-zone');
	    if (windowLabel) windowLabel.value = selectedText('#register-window');
	  }

	  function clearValidation() {
	    if (errorBox) errorBox.textContent = '';
	    $$('.is-invalid').forEach(function (el) { el.classList.remove('is-invalid'); });
	  }

	  function showValidation(message, el) {
	    if (errorBox) errorBox.textContent = message;
	    if (el) {
	      var target = el.closest('.check') || el.closest('.field') || el.closest('label') || el;
	      target.classList.add('is-invalid');
	      el.focus({ preventScroll: true });
	    }
	  }

	  function validateStep(step) {
	    clearValidation();

	    if (step === 1) {
	      if (!$('#register-fname').value.trim()) {
	        showValidation('Completá tu nombre para seguir.', $('#register-fname'));
	        return false;
	      }
	      if (!$('#register-lname').value.trim()) {
	        showValidation('Completá tu apellido para seguir.', $('#register-lname'));
	        return false;
	      }
	      if (!$('#register-email').value.trim() || !$('#register-email').checkValidity()) {
	        showValidation('Ingresá un email válido para guardar tu cuenta demo.', $('#register-email'));
	        return false;
	      }
	      if ($('#register-pw').value.length < 8) {
	        showValidation('La contraseña demo necesita al menos 8 caracteres.', $('#register-pw'));
	        return false;
	      }
	      if (!$('#register-terms').checked) {
	        showValidation('Aceptá los términos y la política de privacidad para continuar.', $('#register-terms'));
	        return false;
	      }
	    }

	    if (step === 2) {
	      if (!$('#register-zone').value) {
	        showValidation('Elegí tu barrio o zona de entrega.', $('#register-zone'));
	        return false;
	      }
	      if (!$('#register-address').value.trim()) {
	        showValidation('Agregá una dirección principal para la entrega.', $('#register-address'));
	        return false;
	      }
	    }

	    if (step === 4 && !$('#register-confirm').checked) {
	      showValidation('Confirmá que los datos están correctos para crear la cuenta demo.', $('#register-confirm'));
	      return false;
	    }

	    return true;
	  }

	  // ── STEP NAV ──────────────────────────────────────────
	  function goStep(n) {
    state.step = n;
    $$('.panel').forEach(function (p) { p.classList.toggle('is-active', +p.dataset.panel === n); });
    $$('.step').forEach(function (s) {
      var sn = +s.dataset.step;
      s.classList.toggle('is-active', sn === n);
      s.classList.toggle('is-done', sn < n);
    });
    var isSuccess = n === 5;
    $('#register-formNav').style.display = isSuccess ? 'none' : 'flex';
    $('#register-backBtn').style.visibility = n > 1 && !isSuccess ? 'visible' : 'hidden';
    $('#register-stepMeta').textContent = isSuccess ? '' : ('Paso ' + n + ' de ' + state.max);
    $('#register-nextBtn').innerHTML = n === state.max
      ? 'Crear mi cuenta <svg viewBox="0 0 16 16" fill="none"><path d="M4 8h8m-3-3l3 3-3 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>'
      : 'Continuar <svg viewBox="0 0 16 16" fill="none"><path d="M4 8h8m-3-3l3 3-3 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';
    $('#register-nextBtn').classList.toggle('btn--warm', n === state.max);
    $('#register-nextBtn').classList.toggle('btn--primary', n !== state.max);
    $('#register-stepper').setAttribute('aria-valuenow', Math.min(n, state.max));
    if (n === 4) refreshSummary();
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }

	  $('#register-nextBtn').addEventListener('click', function () {
	    if (!validateStep(state.step)) return;
	    if (state.step < state.max) goStep(state.step + 1);
	    else {
	      updateHiddenLabels();
	      $('#register-nextBtn').disabled = true;
	      $('#register-nextBtn').textContent = 'Guardando...';
	      form.submit();
	    }
	  });
  $('#register-backBtn').addEventListener('click', function () { goStep(Math.max(1, state.step - 1)); });
  $$('.edit').forEach(function (b) { b.addEventListener('click', function () { goStep(+b.dataset.goto); }); });

  // ── OPTION (radio card) ───────────────────────────────
  $$('.opt').forEach(function (o) {
    o.addEventListener('click', function () {
      var g = o.dataset.group;
      $$('.opt[data-group="' + g + '"]').forEach(function (x) { x.classList.remove('is-checked'); });
      o.classList.add('is-checked');
      var inp = o.querySelector('input'); if (inp) inp.checked = true;
      refreshAside();
    });
  });

  // ── CHIPS (checkbox) ──────────────────────────────────
  $$('.chip').forEach(function (c) {
    c.addEventListener('click', function () {
      setTimeout(function () { c.classList.toggle('is-checked', c.querySelector('input').checked); }, 0);
    });
  });

  // ── PASSWORD TOGGLE + METER ───────────────────────────
  var pw = $('#register-pw'),
      pwToggle = $('#register-pwToggle'),
      meter = $('#register-pwmeter'),
      pwLabel = $('#register-pwLabel');
  pwToggle.addEventListener('click', function () {
    var is = pw.type === 'password';
    pw.type = is ? 'text' : 'password';
    pwToggle.setAttribute('aria-label', is ? 'Ocultar contraseña' : 'Mostrar contraseña');
  });
  pw.addEventListener('input', function () {
    var v = pw.value, s = 0;
    if (v.length >= 8) s++;
    if (/[A-Z]/.test(v) && /[a-z]/.test(v)) s++;
    if (/\d/.test(v)) s++;
    if (/[^A-Za-z0-9]/.test(v) || v.length >= 12) s++;
    meter.setAttribute('data-s', v ? s : 0);
    pwLabel.textContent = v ? ['muy débil','débil','ok','buena','fuerte'][s] : '—';
  });

  // ── ZONE ALERT ────────────────────────────────────────
	  $('#register-zone').addEventListener('change', function (e) {
	    var opt = e.target.selectedOptions[0];
	    var al = $('#register-zoneAlert');
	    updateHiddenLabels();
	    if (!opt || !opt.value) { al.innerHTML = ''; return; }
	    if (opt.dataset.soon) {
	      al.innerHTML = '<div class="zone-alert is-soon"><div class="zone-alert__ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg></div><div><h4>Todavía no llegamos — pero falta poco.</h4><p>Dejanos tus datos y te avisamos apenas abramos ' + opt.text + '. No se cobra nada hasta entonces.</p></div></div>';
	    } else {
	      al.innerHTML = '<div class="zone-alert"><div class="zone-alert__ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l4 4L19 7"/></svg></div><div><h4>¡Entregamos en ' + opt.text + '!</h4><p>Próxima ventana de entrega: <b>' + deliveryLabel + '</b> · 10:00 a 19:00.</p></div></div>';
	    }
	  });
	  $('#register-window').addEventListener('change', updateHiddenLabels);

  // ── SIDEBAR + SUMMARY refresh ─────────────────────────
  function currentPlan() {
    var ppl = (root.querySelector('input[name="people"]:checked') || {}).value || '2';
    var rec = (root.querySelector('input[name="recipes"]:checked') || {}).value || '3';
    var price = PRICE[ppl + '-' + rec] || 285000;
    return { ppl: ppl, rec: rec, price: price, label: 'Para ' + ppl + ' · ' + rec + ' recetas' };
  }
  function refreshAside() {
    var p = currentPlan();
    $('#register-asidePlan').textContent = p.label;
    $('#register-asidePrice').textContent = fmtGs(p.price);
  }
  function refreshSummary() {
    var p = currentPlan();
    $('#register-sumTitle').textContent = p.label;
    $('#register-sumPrice').innerHTML = fmtGs(p.price) + '<small>/ semana</small>';
    $('#register-sumBox').firstChild.textContent = p.label;

    var name = [$('#register-fname').value.trim(), $('#register-lname').value.trim()].filter(Boolean).join(' ') || '—';
    var email = $('#register-email').value.trim() || '—';
    $('#register-sumAccount').firstChild.textContent = name;
    $('#register-sumAccountSub').textContent = email;

    var zoneSel = $('#register-zone').selectedOptions[0];
    var zone = zoneSel && zoneSel.value ? zoneSel.text : 'Sin zona seleccionada';
    var addr = $('#register-address').value.trim();
    var win = $('#register-window').selectedOptions[0].text;
    $('#register-sumDelivery').firstChild.textContent = addr ? (zone + ' · ' + addr) : zone;
	    $('#register-sumDeliverySub').textContent = deliveryShortLabel + ' · ' + win;

	    var prefs = $$('input[name="preferences[]"]:checked').map(function (i) { return i.parentElement.textContent.trim(); });
	    $('#register-sumBoxSub').textContent = prefs.length ? prefs.join(' · ') : 'Sin preferencias marcadas';
	  }

	  updateHiddenLabels();
	  refreshAside();
	  goStep(1);
})();
</script>

<?php get_footer(); ?>
