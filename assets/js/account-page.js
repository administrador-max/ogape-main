/*
 * account-page.js — Mi cuenta interactive JS
 * Source: Website-handoff (3) bundle (Claude Design export, 2026-04-24)
 * website/project/mi-cuenta.html inline <script> block.
 */
/* global document, window, navigator */
const $ = id => document.getElementById(id);
  const $$ = sel => Array.from(document.querySelectorAll(sel));
  function on(id, ev, fn){ const el=$(id); if(el) el.addEventListener(ev,fn); }
  window._isPaused = false;

  // ── PRICING MATRIX ──────────────────────────────────
  const PRICE = {
    '2-2':195000,'2-3':285000,'2-4':370000,'2-5':445000,
    '4-2':360000,'4-3':530000,'4-4':685000,'4-5':820000,
  };
  const fmtGs = n => 'Gs ' + n.toLocaleString('es-PY');

  // current plan state (mirrors sidebar)
  const plan = { people: '2', recipes: '3' };

  // ── COPY REFERRAL ────────────────────────────────────
  on('copyBtn', 'click', () => {
    const refCode = $('refCode');
    const copyBtn = $('copyBtn');
    navigator.clipboard.writeText(refCode.textContent).then(() => {
      copyBtn.textContent = '¡Copiado!';
      copyBtn.style.background = '#4CAF50';
      setTimeout(() => { copyBtn.textContent = 'Copiar'; copyBtn.style.background = ''; }, 2000);
    });
  });

  // ── RECIPE HEARTS ────────────────────────────────────
  $$('.recipe-heart').forEach(btn => {
    btn.addEventListener('click', e => {
      e.stopPropagation();
      const svg = btn.querySelector('svg');
      const liked = btn.dataset.liked === '1';
      btn.dataset.liked = liked ? '0' : '1';
      svg.style.fill = liked ? 'none' : '#E86B9A';
      svg.style.stroke = liked ? 'currentColor' : '#E86B9A';
      btn.style.color = liked ? '' : '#E86B9A';
    });
  });

  // ── MODAL HELPERS ────────────────────────────────────
  function openOverlay(overlayId) {
    const el = $(overlayId);
    el.classList.add('is-open');
    document.body.style.overflow = 'hidden';
    // reset to form state
    const form = el.querySelector('[id$="Form"]');
    const success = el.querySelector('[id$="Success"]');
    if (form) form.style.display = '';
    if (success) success.classList.remove('is-shown');
  }
  function closeOverlay(overlayId) {
    $(overlayId).classList.remove('is-open');
    document.body.style.overflow = '';
  }

  // close on backdrop click
  $$('.overlay').forEach(ov => {
    ov.addEventListener('click', e => {
      if (e.target === ov) closeOverlay(ov.id);
    });
  });
  // close on Escape
  document.addEventListener('keydown', e => {
    if (e.key === 'Escape') $$('.overlay.is-open').forEach(ov => closeOverlay(ov.id));
  });

  // ── PLAN OPTION PICKERS (modal) ──────────────────────
  function initPlanOpts() {
    $$('#planOverlay .plan-opt').forEach(opt => {
      opt.addEventListener('click', () => {
        const g = opt.dataset.group;
        $$(`#planOverlay .plan-opt[data-group="${g}"]`).forEach(x => x.classList.remove('is-checked'));
        opt.classList.add('is-checked');
        const inp = opt.querySelector('input');
        if (inp) inp.checked = true;
        refreshPlanPreview();
      });
    });
  }

  function refreshPlanPreview() {
    const p = $('planOverlay').querySelector('input[name="mp"]:checked')?.value || '2';
    const r = $('planOverlay').querySelector('input[name="mr"]:checked')?.value || '3';
    const price = PRICE[`${p}-${r}`] || 285000;
    $('planPreviewLabel').textContent = `Para ${p} · ${r} recetas`;
    $('planPreviewPrice').innerHTML = `${fmtGs(price)}<small>/ sem</small>`;
    return { p, r, price };
  }

  // ── CAMBIAR PLAN MODAL ───────────────────────────────
  function openPlanModal() {
    openOverlay('planOverlay');
    // sync opts to current plan
    $$('#planOverlay .plan-opt[data-group="mp"]').forEach(o => {
      o.classList.toggle('is-checked', o.dataset.val === plan.people);
      const inp = o.querySelector('input');
      if (inp) inp.checked = (o.dataset.val === plan.people);
    });
    $$('#planOverlay .plan-opt[data-group="mr"]').forEach(o => {
      o.classList.toggle('is-checked', o.dataset.val === plan.recipes);
      const inp = o.querySelector('input');
      if (inp) inp.checked = (o.dataset.val === plan.recipes);
    });
    refreshPlanPreview();
  }

  // open triggers — sidebar buttons + next-week "Cambiar plan" shortcut
  $$('[id]').forEach(el => {
    if (el.id === 'planOverlay' || el.id === 'pauseOverlay') return;
  });
  // Sidebar plan-actions buttons
  document.querySelectorAll('.plan-actions .btn').forEach((btn, i) => {
    if (i === 0) btn.addEventListener('click', openPlanModal);
    if (i === 1) btn.addEventListener('click', () => $('pauseBtn')?.click()); // delegate to pauseBtn
  });

  on('planClose',     'click', () => closeOverlay('planOverlay'));
  on('planCancelBtn', 'click', () => closeOverlay('planOverlay'));

  on('planConfirmBtn', 'click', () => {
    const { p, r, price } = refreshPlanPreview();
    // persist to state
    plan.people = p;
    plan.recipes = r;
    // update sidebar card
    document.querySelector('.plan-title').innerHTML = `Para ${p} · <em>${r} recetas</em>`;
    document.querySelector('.plan-price').innerHTML = `${fmtGs(price)}<small>/ sem</small>`;
    document.querySelectorAll('.plan-detail .v')[0].textContent = `${p} personas`;
    document.querySelectorAll('.plan-detail .v')[1].textContent = `${r} por semana`;
    // update next-week card heading
    document.querySelector('.next-week-info h3').textContent = `Caja N.º 02 · Jueves 1 de mayo`;
    // show success
    $('planForm').style.display = 'none';
    $('planSuccessMsg').textContent = `Tu próxima caja: Para ${p} · ${r} recetas — ${fmtGs(price)} / semana.`;
    $('planSuccess').classList.add('is-shown');
  });

  on('planDoneBtn', 'click', () => closeOverlay('planOverlay'));

  initPlanOpts();

  // ── PAUSAR MODAL ─────────────────────────────────────
  // "Pausar semana" button in next-week card
  on('pauseBtn', 'click', () => {
    if (window._isPaused) {
      // Resume directly
      window._isPaused = false;
      const nwCard = document.querySelector('.next-week');
      if (nwCard) {
        nwCard.style.background = '';
        nwCard.style.borderColor = '';
        const h3 = nwCard.querySelector('h3');
        if (h3) h3.textContent = 'Caja N.º 02 · Jueves 1 de mayo';
        const p = nwCard.querySelector('p');
        if (p) p.textContent = 'Tu próxima entrega está programada. Cierre de pedidos: martes 29 a las 23:59. Podés pausar, cambiar el tamaño o elegir recetas antes de esa hora.';
      }
      const pauseBtn = $('pauseBtn');
      if (pauseBtn) {
        pauseBtn.innerHTML = `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" width="14" height="14"><rect x="6" y="4" width="4" height="16"/><rect x="14" y="4" width="4" height="16"/></svg> Pausar semana`;
        pauseBtn.style.color = '';
      }
    } else {
      openOverlay('pauseOverlay');
    }
  });

  // pause option selection
  $$('#pauseOpts .pause-opt').forEach(opt => {
    opt.addEventListener('click', () => {
      $$('#pauseOpts .pause-opt').forEach(x => x.classList.remove('is-checked'));
      opt.classList.add('is-checked');
      const inp = opt.querySelector('input');
      if (inp) inp.checked = true;
    });
  });

  on('pauseClose',     'click', () => closeOverlay('pauseOverlay'));
  on('pauseCancelBtn', 'click', () => closeOverlay('pauseOverlay'));

  on('pauseConfirmBtn', 'click', () => {
    const selected = $('pauseOverlay').querySelector('input[name="pauseWhen"]:checked')?.value || 'next';
    const msgs = {
      next:       'No recibís caja el jueves 1 de mayo. Volvés automáticamente el 8 de mayo.',
      two:        'Pausamos el 1 y el 8 de mayo. Tu próxima caja llega el 15 de mayo.',
      indefinite: 'Tu suscripción está pausada. Reactivá cuando quieras desde esta página.',
    };
    $('pauseForm').style.display = 'none';
    $('pauseSuccessMsg').textContent = msgs[selected];
    $('pauseSuccess').classList.add('is-shown');

    // update the next-week card to reflect pause
    window._isPaused = true;
    const nwCard = document.querySelector('.next-week');
    if (nwCard) {
      nwCard.style.background = 'rgba(255,248,225,.6)';
      nwCard.style.borderColor = 'rgba(255,193,7,.35)';
      const h3 = nwCard.querySelector('h3');
      if (h3) h3.textContent = 'Caja N.º 02 — Pausada';
      const p = nwCard.querySelector('p');
      if (p) p.textContent = msgs[selected];
      // swap pause btn to resume
      const pauseBtn2 = $('pauseBtn');
      if (pauseBtn2) {
        pauseBtn2.innerHTML = `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" width="14" height="14"><polygon points="5 3 19 12 5 21 5 3"/></svg> Reanudar`;
        pauseBtn2.style.color = 'var(--brand-primary-strong)';
      }
    }
  });

  on('pauseDoneBtn', 'click', () => closeOverlay('pauseOverlay'));

  // ── MI CUENTA BUTTONS ────────────────────────────────
  on('openPerfil',     'click', () => openOverlay('perfilOverlay'));
  on('openDireccion',   'click', () => openOverlay('direccionOverlay'));
  on('openFacturacion', 'click', () => openOverlay('facturacionOverlay'));
  on('openNotifs',      'click', () => openOverlay('notifsOverlay'));
  on('openCancelar',    'click', () => openOverlay('cancelarOverlay'));

  // ── EDITAR PERFIL ────────────────────────────────────
  on('perfilClose',     'click',  () => closeOverlay('perfilOverlay'));
  on('perfilCancelBtn', 'click',  () => closeOverlay('perfilOverlay'));
  on('perfilForm',      'submit', e => {
    e.preventDefault();
    const name = $('pfNombre').value.trim() || 'María';
    // update greeting + avatar
    document.querySelector('.greeting__h').innerHTML = `Buenos días, <em>${name.split(' ')[0]}</em>.`;
    document.querySelector('.avatar-btn .name').textContent = name.split(' ')[0];
    document.querySelector('.avatar').textContent = name.split(' ').map(w=>w[0]).join('').slice(0,2).toUpperCase();
    document.querySelector('.user-menu__head .uname').textContent = name;
    showModalSuccess('perfilOverlay','perfilFormWrap','perfilSuccess', `Perfil actualizado. Hola, <em style="color:var(--brand-primary-strong)">${name.split(' ')[0]}</em>.`);
  });
  on('perfilDoneBtn', 'click', () => closeOverlay('perfilOverlay'));

  // pw toggle in perfil modal
  on('pfPwToggle', 'click', () => {
    const inp = $('pfPw');
    inp.type = inp.type === 'password' ? 'text' : 'password';
  });

  // ── CAMBIAR DIRECCIÓN ────────────────────────────────
  on('dirClose',     'click',  () => closeOverlay('direccionOverlay'));
  on('dirCancelBtn', 'click',  () => closeOverlay('direccionOverlay'));
  on('dirForm',      'submit', e => {
    e.preventDefault();
    const addr  = $('dirAddress').value.trim() || 'Av. Mcal. López 1234';
    const zone  = $('dirZone').selectedOptions[0]?.text || 'Villa Morra';
    document.querySelectorAll('.plan-detail .v')[3].textContent = zone;
    document.querySelector('.greeting__sub').textContent =
      `Tu caja está en camino. Llegá temprano a casa — el repartidor pasa por ${zone} antes del mediodía.`;
    showModalSuccess('direccionOverlay','dirFormWrap','dirSuccess', `Dirección actualizada: ${addr}, ${zone}.`);
  });
  on('dirDoneBtn', 'click', () => closeOverlay('direccionOverlay'));

  // zone alert in dir modal
  on('dirZone', 'change', e => {
    const opt = e.target.selectedOptions[0];
    const al = $('dirZoneAlert');
    if (!opt?.value){ al.innerHTML=''; return; }
    if (opt.dataset.soon) {
      al.innerHTML=`<div class="pause-note"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" width="16" height="16"><circle cx="12" cy="12" r="10"/><path d="M12 8v4m0 4h.01"/></svg><p>Todavía no llegamos a <b>${opt.text}</b> — pero falta poco. Podés dejar tus datos y te avisamos.</p></div>`;
    } else {
      al.innerHTML=`<div class="pause-note" style="background:#E8F5E9;border-color:rgba(76,175,80,.3)"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" width="16" height="16" style="color:#388E3C"><path d="M5 12l4 4L19 7"/></svg><p style="color:#1B5E20">¡Entregamos en <b>${opt.text}</b>! Próxima ventana: jueves 1 de mayo.</p></div>`;
    }
  });

  // ── FACTURACIÓN ──────────────────────────────────────
  on('factClose',    'click', () => closeOverlay('facturacionOverlay'));
  on('factCloseBtn', 'click', () => closeOverlay('facturacionOverlay'));

  // ── NOTIFICACIONES ───────────────────────────────────
  on('notifsClose',     'click',  () => closeOverlay('notifsOverlay'));
  on('notifsCancelBtn', 'click',  () => closeOverlay('notifsOverlay'));
  on('notifsForm',      'submit', e => {
    e.preventDefault();
    showModalSuccess('notifsOverlay','notifsFormWrap','notifsSuccess', 'Preferencias guardadas. Te avisamos solo cuando importa.');
  });
  on('notifsDoneBtn', 'click', () => closeOverlay('notifsOverlay'));

  // toggle switch logic
  $$('.toggle-switch input').forEach(inp => {
    inp.addEventListener('change', () => {
      inp.closest('.toggle-row').querySelector('.toggle-val').textContent = inp.checked ? 'Activado' : 'Desactivado';
    });
  });

  // ── CANCELAR SUSCRIPCIÓN ─────────────────────────────
  on('cancelClose',   'click', () => closeOverlay('cancelarOverlay'));
  on('cancelKeepBtn', 'click', () => closeOverlay('cancelarOverlay'));
  // enable confirm only when typed
  on('cancelConfirmText', 'input', () => {
    const ok = $('cancelConfirmText').value.trim().toLowerCase() === 'cancelar';
    $('cancelConfirmBtn').disabled = !ok;
    $('cancelConfirmBtn').style.opacity = ok ? '1' : '.45';
  });
  on('cancelConfirmBtn', 'click', () => {
    showModalSuccess('cancelarOverlay','cancelarFormWrap','cancelarSuccess', 'Tu cuenta está pausada. Todos tus datos se conservan por 90 días — podés reactivar cuando quieras.');
  });
  on('cancelDoneBtn', 'click', () => closeOverlay('cancelarOverlay'));

  // ── FACTURA VIEWER ───────────────────────────────────
  // Handlers deferred so elements after <script> are parsed first
  document.addEventListener('DOMContentLoaded', () => {
    function openFactura(data) {
      const ov = $('facturaOverlay');
      if (!ov) return;
      ov.querySelector('.tf-title').textContent = `Factura Caja N.º ${data.num}`;
      ov.querySelector('.tf-sub').textContent = `${data.date} · Gs ${data.amount}`;
      ov.classList.add('is-open');
      document.body.style.overflow = 'hidden';
    }

    // delegated click for all .open-factura buttons
    document.addEventListener('click', e => {
      const btn = e.target.closest('.open-factura');
      if (btn) openFactura({ num: btn.dataset.num, date: btn.dataset.date, desc: btn.dataset.desc, amount: btn.dataset.amount });
    });

    on('facturaClose', 'click', () => {
      $('facturaOverlay').classList.remove('is-open');
      document.body.style.overflow = '';
    });
    on('facturaOverlay', 'click', e => {
      const viewer = $('facturaOverlay')?.querySelector('.factura-viewer');
      if (viewer && !viewer.contains(e.target)) {
        $('facturaOverlay').classList.remove('is-open');
        document.body.style.overflow = '';
      }
    });
    on('facturaDownloadBtn', 'click', () => {
      const page = $('facturaPDF');
      const win = window.open('', '_blank', 'width=700,height=900');
      win.document.write(`<!doctype html><html><head>
        <meta charset="utf-8">
        <title>Factura Ogape N.º 001-001-0000001</title>
        <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
        <style>
          *{box-sizing:border-box;margin:0;padding:0}
          body{font-family:'Inter',sans-serif;background:#fff;padding:40px;color:#111;font-size:12px}
          ${[...document.styleSheets].flatMap(ss => {
            try { return [...ss.cssRules].filter(r => r.selectorText && (r.selectorText.startsWith('.f-') || r.selectorText.startsWith('.factura-page'))).map(r => r.cssText); }
            catch(e){ return []; }
          }).join('\n')}
        </style>
      </head><body>${page.outerHTML}
      <script>window.onload=()=>{window.print();window.close()}<\/script>
      </body></html>`);
      win.document.close();
    });
  });

  // ── SHARED SUCCESS HELPER ────────────────────────────
  function showModalSuccess(overlayId, formId, successId, msg) {
    $(formId).style.display = 'none';
    const s = $(successId);
    s.classList.add('is-shown');
    const p = s.querySelector('p');
    if (p) p.innerHTML = msg;
  }
