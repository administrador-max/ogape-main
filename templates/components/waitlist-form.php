<?php
/**
 * Waitlist / Lead Capture Form Component
 * Per Website-Component-Library.docx
 * TODO Phase 2: Wire up to email service (Mailchimp/ConvertKit) or CF7
 */
?>
<section class="waitlist-section" id="waitlist" aria-labelledby="waitlist-title">
  <div class="container">
    <div class="waitlist-card glass-card">

      <div class="waitlist-card__header">
        <h2 class="waitlist-card__title" id="waitlist-title">Entrá primero al lanzamiento piloto</h2>
        <p class="waitlist-card__subtitle">
          Sumate a la lista de espera para enterarte antes que nadie cuando confirmemos zonas, fechas y próximos pasos del piloto en Asunción.
        </p>
      </div>

      <form class="waitlist-form" id="waitlist-form" method="post" novalidate>
        <input type="hidden" name="source_page" value="">
        <input type="hidden" name="referrer" value="">
        <input type="hidden" name="utm_source" value="">
        <input type="hidden" name="utm_medium" value="">
        <input type="hidden" name="utm_campaign" value="">
        <input type="hidden" name="city" value="Asunción">

        <div class="waitlist-form__row">

          <div class="waitlist-form__field">
            <label for="wl-first-name" class="waitlist-form__label">Nombre *</label>
            <input type="text" id="wl-first-name" name="first_name" class="waitlist-form__input"
                   placeholder="Tu nombre" required autocomplete="given-name">
            <p class="waitlist-form__error" data-error-for="first_name" hidden></p>
          </div>

          <div class="waitlist-form__field">
            <label for="wl-email" class="waitlist-form__label">Email *</label>
            <input type="email" id="wl-email" name="email" class="waitlist-form__input"
                   placeholder="tu@email.com" required autocomplete="email">
            <p class="waitlist-form__error" data-error-for="email" hidden></p>
          </div>

          <div class="waitlist-form__field">
            <label for="wl-phone" class="waitlist-form__label">Teléfono / WhatsApp *</label>
            <input type="tel" id="wl-phone" name="phone_whatsapp" class="waitlist-form__input"
                   placeholder="Ej: +595 981 000 000" required autocomplete="tel">
            <p class="waitlist-form__error" data-error-for="phone_whatsapp" hidden></p>
          </div>

          <div class="waitlist-form__field">
            <label for="wl-neighbourhood" class="waitlist-form__label">Barrio (Asunción) *</label>
            <select id="wl-neighbourhood" name="neighbourhood" class="waitlist-form__input waitlist-form__select" required>
              <option value="">Seleccionar barrio</option>
              <option value="Villa Morra">Villa Morra</option>
              <option value="Las Mercedes">Las Mercedes</option>
              <option value="Carmelitas">Carmelitas</option>
              <option value="Recoleta">Recoleta</option>
              <option value="Mburucuyá">Mburucuyá</option>
              <option value="Herrera">Herrera</option>
              <option value="Trinidad">Trinidad</option>
              <option value="Ycuá Satí">Ycuá Satí</option>
              <option value="San Jorge">San Jorge</option>
              <option value="Madame Lynch">Madame Lynch</option>
              <option value="Los Laureles">Los Laureles</option>
              <option value="Manorá">Manorá</option>
              <option value="Ciudad Nueva">Ciudad Nueva</option>
              <option value="Centro">Centro</option>
              <option value="Otra zona de Asunción">Otra zona de Asunción</option>
            </select>
            <p class="waitlist-form__helper">Solo estamos lanzando en Asunción por ahora.</p>
            <p class="waitlist-form__error" data-error-for="neighbourhood" hidden></p>
          </div>

          <div class="waitlist-form__field waitlist-form__field--other-neighbourhood is-hidden" hidden aria-hidden="true">
            <label for="wl-neighbourhood-other" class="waitlist-form__label">Escribí tu barrio *</label>
            <input type="text" id="wl-neighbourhood-other" name="neighbourhood_other" class="waitlist-form__input"
                   placeholder="Escribí tu barrio" autocomplete="address-level3">
            <p class="waitlist-form__error" data-error-for="neighbourhood_other" hidden></p>
          </div>

          <div class="waitlist-form__field waitlist-form__field--full">
            <label for="wl-notes" class="waitlist-form__label">Notas (opcional)</label>
            <textarea id="wl-notes" name="notes" class="waitlist-form__textarea"
                      placeholder="Ej: Trabajo en la zona, me interesa el piloto para almuerzos o quiero recibir novedades por WhatsApp."></textarea>
          </div>

          <button type="submit" class="btn btn--primary btn--lg waitlist-form__btn">
            Unirme
          </button>

        </div>

        <p class="waitlist-form__privacy">
          Tu información es privada. Sin spam, nunca.
        </p>
      </form>

      <div class="waitlist-form__status" id="waitlist-status" hidden aria-live="polite"></div>

      <!-- Success message (hidden by default, shown after backend confirmation) -->
      <div class="waitlist-form__success" id="waitlist-success" hidden>
        <p></p>
        <div class="waitlist-form__success-actions">
          <a href="https://www.instagram.com/ogapechefpy" target="_blank" rel="noopener noreferrer" class="btn btn--secondary btn--md">Seguir en Instagram</a>
          <a href="<?php echo esc_url( ogape_get_whatsapp_url() ); ?>" target="_blank" rel="noopener noreferrer" class="btn btn--ghost btn--md">Escribir por WhatsApp</a>
        </div>
      </div>

    </div><!-- .waitlist-card -->
  </div><!-- .container -->
</section><!-- .waitlist-section -->
