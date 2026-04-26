<?php
/**
 * Elegir Menú — weekly menu selection page.
 *
 * Template Name: Elegir Menú
 * Template Post Type: page
 *
 * Shown after successful registration (source=register → new-account welcome)
 * and weekly for returning customers. Post-cutoff: read-only view with a
 * "Ver Próximo Menú" link to /menu/ in a new window.
 */

get_header();

$home_url    = home_url( '/' );
$account_url = home_url( '/account/' );
$menu_url    = home_url( '/menu/' );
$terms_url   = home_url( '/terminos/' );
$logo_url    = get_stylesheet_directory_uri() . '/assets/img/ogape-logo.svg';
$wa_url      = function_exists( 'ogape_get_whatsapp_url' ) ? ogape_get_whatsapp_url() : '#';

// ── CONTEXT ──────────────────────────────────────────────────────────────────

$demo_context = function_exists( 'ogape_get_demo_account_context' ) ? ogape_get_demo_account_context() : array();
$first_name   = $demo_context['first_name'] ?? 'María';
$plan         = $demo_context['plan'] ?? array();
$schedule     = ( ! empty( $demo_context['schedule'] ) )
    ? $demo_context['schedule']
    : ( function_exists( 'ogape_demo_schedule' ) ? ogape_demo_schedule() : array() );

// ── PLAN ─────────────────────────────────────────────────────────────────────

$portions      = (int) ( $plan['people'] ?? 2 );
$recipe_count  = (int) ( $plan['recipes'] ?? 4 );
$plan_price    = (int) ( $plan['price'] ?? 370000 );
$plan_price_d  = function_exists( 'ogape_demo_format_price' )
    ? ogape_demo_format_price( $plan_price )
    : ( 'Gs ' . number_format( $plan_price, 0, ',', '.' ) );

if ( $portions >= 4 ) {
    $plan_name = 'Familia';
} elseif ( $recipe_count <= 3 ) {
    $plan_name = 'Solo';
} else {
    $plan_name = 'Standard';
}

// ── SCHEDULE ─────────────────────────────────────────────────────────────────

$delivery_dt  = ( isset( $schedule['delivery'] ) && $schedule['delivery'] instanceof DateTimeImmutable )
    ? $schedule['delivery'] : null;
$cutoff_dt    = ( isset( $schedule['cutoff'] ) && $schedule['cutoff'] instanceof DateTimeImmutable )
    ? $schedule['cutoff'] : null;
$next_dt      = ( isset( $schedule['next_delivery'] ) && $schedule['next_delivery'] instanceof DateTimeImmutable )
    ? $schedule['next_delivery'] : null;

$now_dt          = new DateTimeImmutable( 'now', wp_timezone() );
$is_past_cutoff  = $cutoff_dt && $now_dt > $cutoff_dt;

$delivery_label = $schedule['delivery_label'] ?? __( 'el próximo jueves', 'ogape-child' );
$cutoff_label   = $schedule['cutoff_label']   ?? __( 'el martes previo', 'ogape-child' );
$cutoff_time    = $schedule['cutoff_time']    ?? '23:59';

// Week label for page eyebrow — "Menú · Semana del 28 de abril"
$week_eyebrow = __( 'Menú · Semana actual', 'ogape-child' );
$week_key     = $delivery_dt ? $delivery_dt->format( 'Ymd' ) : wp_date( 'Ymd' );
if ( $delivery_dt && function_exists( 'ogape_demo_date_words' ) ) {
    $words       = ogape_demo_date_words();
    $monday      = $delivery_dt->modify( 'monday this week' );
    $month_name  = $words['months'][ (int) $monday->format( 'n' ) ] ?? '';
    $week_eyebrow = 'Menú · Semana del ' . $monday->format( 'j' ) . ' de ' . $month_name;
}

// "Ver Próximo Menú" CTA label shown when past cutoff
$next_cta_label = __( 'Ver Próximo Menú', 'ogape-child' );
if ( $next_dt && function_exists( 'ogape_demo_date_words' ) ) {
    $words          = function_exists( 'ogape_demo_date_words' ) ? ogape_demo_date_words() : array( 'months' => array() );
    $next_month     = $words['months'][ (int) $next_dt->format( 'n' ) ] ?? '';
    $next_cta_label = 'Ver Próximo Menú · jue. ' . $next_dt->format( 'j' ) . ' ' . $next_month;
}

// Customer state — new vs returning
$is_new = isset( $_GET['source'] ) && 'register' === sanitize_key( wp_unslash( $_GET['source'] ) );

// ── RECIPE DATA ───────────────────────────────────────────────────────────────

$menu_recipes = function_exists( 'ogape_get_current_menu_recipes' )
    ? ogape_get_current_menu_recipes()
    : array();

// ── JS CONFIG ─────────────────────────────────────────────────────────────────

$js_config = array(
    'planName'      => $plan_name,
    'planLabel'     => $plan['label'] ?? ( 'Para ' . $portions . ' · ' . $recipe_count . ' recetas' ),
    'portions'      => $portions,
    'required'      => $recipe_count,
    'price'         => $plan_price,
    'priceDisplay'  => $plan_price_d,
    'isNew'         => $is_new,
    'isPastCutoff'  => $is_past_cutoff,
    'userName'      => $first_name,
    'accountUrl'    => $account_url,
    'menuUrl'       => $menu_url,
    'deliveryLabel' => $delivery_label,
    'cutoffLabel'   => $cutoff_label,
    'cutoffTime'    => $cutoff_time,
    'nextCtaLabel'  => $next_cta_label,
    'weekLabel'     => $week_eyebrow,
    'weekKey'       => $week_key,
    'menuRecipes'   => $menu_recipes,
    'ajaxUrl'       => admin_url( 'admin-ajax.php' ),
    'nonce'         => wp_create_nonce( 'ogape_account_actions' ),
);
?>

<div class="elegir-menu-design<?php echo $is_past_cutoff ? ' is-past-cutoff' : ''; ?>">

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
    <div class="nav__right">
      <?php if ( $is_new ) : ?>
        <span class="nav__step">Paso <b>3 de 3</b> · Elegir menú</span>
      <?php else : ?>
        <span class="nav__step"><b>Selección semanal</b></span>
      <?php endif; ?>
      <span class="nav__user">
        <span class="dot"></span>
        <?php echo esc_html( $first_name ); ?>
      </span>
    </div>
  </div>
</header>

<?php if ( $is_new ) : ?>
<!-- WELCOME BANNER — new accounts only -->
<div class="welcome-banner">
  <div class="wrap welcome-banner__inner">
    <div>
      <div class="welcome-banner__eyebrow">
        <span class="check">
          <svg viewBox="0 0 12 12" fill="none" aria-hidden="true"><path d="M2 6l3 3 5-5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </span>
        Cuenta creada · Pago confirmado
      </div>
      <h2>¡Bienvenida, <em><?php echo esc_html( $first_name ); ?></em>! Elegí tus recetas para empezar.</h2>
      <p>Seleccioná exactamente <?php echo (int) $recipe_count; ?> recetas de esta semana. Tu caja llega <?php echo esc_html( $delivery_label ); ?>.</p>
    </div>
    <div class="welcome-banner__plan">
      <div style="font-size:10px;letter-spacing:.2em;text-transform:uppercase;color:rgba(247,239,227,.5);font-weight:600;margin-bottom:.2rem">Tu plan</div>
      <div class="plan-name"><?php echo esc_html( $plan_name ); ?></div>
      <div class="plan-meta"><?php echo esc_html( $portions . ' porciones · ' . $recipe_count . ' recetas/semana' ); ?></div>
    </div>
  </div>
</div>
<?php endif; ?>

<!-- DEADLINE STRIP -->
<div class="deadline<?php echo $is_past_cutoff ? ' deadline--passed' : ''; ?>" id="deadline-strip">
  <div class="wrap deadline__inner">
    <svg viewBox="0 0 16 16" fill="none" aria-hidden="true"><circle cx="8" cy="8" r="6.5" stroke="currentColor" stroke-width="1.3"/><path d="M8 5v3.5L10 10" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/></svg>
    <span id="deadline-text">
      <?php if ( $is_past_cutoff ) : ?>
        El corte de esta semana ha pasado. Tu selección está confirmada para el <b><?php echo esc_html( $delivery_label ); ?></b>.
      <?php else : ?>
        <b>Confirmá antes del <?php echo esc_html( $cutoff_label ); ?> a las <?php echo esc_html( $cutoff_time ); ?></b> para recibir tu caja este jueves.
      <?php endif; ?>
    </span>
  </div>
</div>

<!-- MAIN -->
<main class="page" id="main" role="main">
  <div class="wrap">
    <div class="page__head">
      <div class="page__head__left">
        <div class="page__eyebrow"><span class="dot"></span><?php echo esc_html( $week_eyebrow ); ?></div>
        <h1 class="page__title">Elegí tus <em>recetas</em> de esta semana.</h1>
        <p class="page__sub">
          <?php if ( $is_past_cutoff ) : ?>
            Tu selección para esta semana está confirmada. El próximo menú estará disponible el viernes.
          <?php else : ?>
            Los ingredientes llegan frescos y listos para cocinar. Seleccioná <span id="sub-count"><?php echo (int) $recipe_count; ?></span> recetas del menú de esta semana.
          <?php endif; ?>
        </p>
      </div>
    </div>
    <div class="recipe-grid" id="recipe-grid" role="list"></div>
  </div>
</main>

<footer class="foot">
  <div class="wrap">
    <a href="<?php echo esc_url( $wa_url ); ?>">Ayuda</a> · <a href="<?php echo esc_url( home_url( '/cobertura/' ) ); ?>">Política de entregas</a> · <a href="<?php echo esc_url( $terms_url ); ?>">Términos</a>
    <br style="margin-bottom:.3rem">
    &copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> Ogape Tu Chef en Casa &middot; Asunción, Paraguay
  </div>
</footer>

<!-- STICKY BOTTOM BAR -->
<div class="bottom-bar" role="region" aria-label="Resumen del pedido">
  <div class="wrap">
    <div class="bottom-bar__main">

      <div class="bottom-bar__plan">
        <div class="bottom-bar__plan-name"><?php echo esc_html( $plan_name ); ?></div>
        <div class="bottom-bar__plan-meta"><?php echo esc_html( $portions . ' porciones' ); ?></div>
      </div>

      <div class="bottom-bar__divider"></div>

      <div class="bottom-bar__progress">
        <div class="bottom-bar__dots" id="bar-dots"></div>
        <span class="bottom-bar__prog-label" id="bar-prog-label">
          <b>0</b> de <?php echo (int) $recipe_count; ?>
        </span>
      </div>

      <div class="bottom-bar__right">
        <div class="bottom-bar__price">
          <div class="k">Total</div>
          <div class="v" id="bar-total"><?php echo esc_html( $plan_price_d ); ?></div>
        </div>
        <button
          class="bottom-bar__cta"
          id="cta-btn"
          <?php echo $is_past_cutoff ? '' : 'disabled'; ?>
          aria-label="<?php echo $is_past_cutoff ? esc_attr( $next_cta_label ) : 'Confirmar selección de menú'; ?>"
        >
          <svg viewBox="0 0 16 16" fill="none" aria-hidden="true"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
          <?php echo $is_past_cutoff ? esc_html( $next_cta_label ) : 'Confirmar menú'; ?>
        </button>
      </div>

    </div>
  </div>
</div>

</div><!-- /.elegir-menu-design -->

<script>
window.OGAPE_MENU = <?php echo wp_json_encode( $js_config ); ?>;
</script>
<script>
(function () {
  var CFG      = window.OGAPE_MENU || {};
  var required = CFG.required || 4;
  var storeKey = 'ogape_menu_w' + (CFG.weekKey || '');

  /* ── Restore saved selection for this week ── */
  var selected = new Set();
  try {
    var saved = JSON.parse(localStorage.getItem(storeKey) || '{}');
    if (Array.isArray(saved.selected)) selected = new Set(saved.selected);
  } catch (e) {}

  function save() {
    localStorage.setItem(storeKey, JSON.stringify({ selected: Array.from(selected) }));
  }

  function gs(n) {
    return 'Gs ' + Math.round(n).toLocaleString('es-PY');
  }

  /* ── Render progress dots in the bottom bar ── */
  function renderDots(total, filled) {
    var container = document.getElementById('bar-dots');
    if (!container) return;
    container.innerHTML = '';
    for (var i = 0; i < total; i++) {
      var d = document.createElement('div');
      d.className = 'bottom-bar__dot' + (i < filled ? ' is-filled' : '');
      d.innerHTML = i < filled
        ? '<svg viewBox="0 0 14 14" fill="none"><path d="M3 7l3 3 5-5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>'
        : String(i + 1);
      container.appendChild(d);
    }
  }

  /* ── Sync card visual state ── */
  function syncCards() {
    var selCount = selected.size;
    var grid     = document.getElementById('recipe-grid');
    if (!grid) return;
    grid.querySelectorAll('.recipe-card').forEach(function (card) {
      var id  = card.dataset.id;
      var sel = selected.has(id);
      /* Non-selected cards are "disabled" when the quota is full or past cutoff */
      var dis = !sel && (CFG.isPastCutoff || selCount >= required);
      card.classList.toggle('is-selected', sel);
      card.classList.toggle('is-disabled', dis);
      card.setAttribute('aria-pressed', sel ? 'true' : 'false');
      var btn = card.querySelector('.recipe-card__sel-btn');
      if (!btn) return;
      if (sel) {
        btn.innerHTML = '<svg viewBox="0 0 14 14" fill="none"><path d="M3 7l3 3 5-5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg> Seleccionada';
      } else {
        btn.textContent = CFG.isPastCutoff ? 'No seleccionada' : '+ Seleccionar';
      }
    });
  }

  /* ── Full render pass ── */
  function render() {
    var selCount = selected.size;
    var complete = selCount === required;

    renderDots(required, selCount);

    var progLabel = document.getElementById('bar-prog-label');
    if (progLabel) {
      progLabel.className = 'bottom-bar__prog-label' + (complete ? ' is-complete' : '');
      progLabel.innerHTML = '<b>' + selCount + '</b> de ' + required;
    }

    var ctaBtn = document.getElementById('cta-btn');
    if (ctaBtn) {
      var arrowSvg = '<svg viewBox="0 0 16 16" fill="none" aria-hidden="true"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';
      if (CFG.isPastCutoff) {
        ctaBtn.disabled = false;
        ctaBtn.innerHTML = arrowSvg + ' ' + CFG.nextCtaLabel;
      } else {
        ctaBtn.disabled  = !complete;
        ctaBtn.innerHTML = arrowSvg + ' Confirmar menú';
      }
    }

    syncCards();
  }

  /* ── Toggle card selection ── */
  function toggle(id) {
    if (CFG.isPastCutoff) return;
    if (selected.has(id)) {
      selected.delete(id);
    } else {
      if (selected.size >= required) return;
      selected.add(id);
    }
    save();
    render();
  }

  /* ── Build recipe cards (once on load) ── */
  function buildCards() {
    var grid    = document.getElementById('recipe-grid');
    var recipes = CFG.menuRecipes;
    if (!grid || !Array.isArray(recipes)) return;
    grid.innerHTML = '';
    recipes.forEach(function (r) {
      var card = document.createElement('article');
      card.className = 'recipe-card';
      card.dataset.id = r.id;
      card.setAttribute('role', 'listitem');
      card.setAttribute('aria-pressed', 'false');

      var heroBadge = r.isHero
        ? '<div class="recipe-card__hero"><svg viewBox="0 0 12 12" fill="none"><path d="M6 1l1.4 2.8 3.1.45-2.25 2.2.53 3.1L6 8.1 3.22 9.55l.53-3.1L1.5 4.25l3.1-.45L6 1z" fill="currentColor"/></svg> Plato Estrella</div>'
        : '';

      var tagsHtml = (r.tags || []).map(function (t) {
        return '<span class="tag tag--' + t.type + '">' + t.label + '</span>';
      }).join('');

      card.innerHTML =
        '<div class="recipe-card__photo" style="background:' + r.photoGrad + '">' +
          heroBadge +
          '<div class="recipe-card__check"><svg viewBox="0 0 14 14" fill="none"><path d="M3 7l3 3 5-5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg></div>' +
          '<div class="recipe-card__photo-label">Foto próximamente</div>' +
        '</div>' +
        '<div class="recipe-card__body">' +
          '<h2 class="recipe-card__name">' + r.name + '</h2>' +
          '<p class="recipe-card__desc">' + r.desc + '</p>' +
          '<div class="recipe-card__tags">' + tagsHtml + '</div>' +
          '<div class="recipe-card__meta">' +
            '<span class="meta-item"><svg viewBox="0 0 12 12" fill="none"><circle cx="6" cy="6" r="4.5" stroke="currentColor" stroke-width="1.2"/><path d="M6 3.5V6l1.5 1.5" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/></svg>' + r.time + '</span>' +
            '<span class="meta-item"><svg viewBox="0 0 12 12" fill="none"><path d="M2 10c0-2.2 1.8-4 4-4s4 1.8 4 4" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/><circle cx="6" cy="3.5" r="1.5" stroke="currentColor" stroke-width="1.2"/></svg>' + r.difficulty + '</span>' +
          '</div>' +
          '<div class="recipe-card__allergens"><b>Alérgenos:</b> ' + r.allergens + '</div>' +
        '</div>' +
        '<div class="recipe-card__foot">' +
          '<button class="recipe-card__sel-btn">+ Seleccionar</button>' +
        '</div>';

      if (!CFG.isPastCutoff) {
        card.addEventListener('click', function () { toggle(r.id); });
      }
      grid.appendChild(card);
    });
  }

  /* ── CTA: confirm menu OR open next menu page ── */
  document.getElementById('cta-btn').addEventListener('click', function () {
    if (CFG.isPastCutoff) {
      window.open(CFG.menuUrl, '_blank', 'noopener');
      return;
    }
    if (this.disabled) return;
    var btn = this;
    btn.textContent = 'Guardando…';
    btn.disabled = true;

    var fd = new FormData();
    fd.append('action',   'ogape_save_menu_selection');
    fd.append('nonce',    CFG.nonce || '');
    fd.append('week_key', CFG.weekKey || '');
    Array.from(selected).forEach(function (id) { fd.append('selected[]', id); });

    fetch(CFG.ajaxUrl || '/wp-admin/admin-ajax.php', {
      method: 'POST', body: fd, credentials: 'same-origin'
    })
    .then(function (r) { return r.json(); })
    .catch(function () { return { success: true }; }) // redirect regardless on network err
    .then(function () { window.location.href = CFG.accountUrl; });
  });

  /* ── Init ── */
  buildCards();
  render();
})();
</script>

<?php get_footer(); ?>
