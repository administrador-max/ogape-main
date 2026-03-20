/**
 * main.js — Ogape Child Theme
 * Core JavaScript: navigation, event tracking, form handling
 * Version: 1.0.0 | 2026-03-12
 *
 * AI AGENTS: Add new features in separate component files.
 * Only add truly global behaviour here.
 */

(function () {
  'use strict';

  // ── MOBILE NAVIGATION ─────────────────────────────────────
  const hamburger = document.querySelector('.nav__hamburger');
  const mobileMenu = document.querySelector('.nav__mobile-menu');

  if (hamburger && mobileMenu) {
    hamburger.addEventListener('click', function () {
      const isOpen = mobileMenu.classList.toggle('is-open');
      hamburger.setAttribute('aria-expanded', isOpen);
      mobileMenu.setAttribute('aria-hidden', !isOpen);
      document.body.style.overflow = isOpen ? 'hidden' : '';
    });

    // Close menu when a link is clicked
    mobileMenu.querySelectorAll('a').forEach(function (link) {
      link.addEventListener('click', function () {
        mobileMenu.classList.remove('is-open');
        hamburger.setAttribute('aria-expanded', 'false');
        mobileMenu.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
      });
    });
  }

  // ── SMOOTH SCROLL for anchor links ────────────────────────
  document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
    anchor.addEventListener('click', function (e) {
      const target = document.querySelector(this.getAttribute('href'));
      if (target) {
        e.preventDefault();
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    });
  });

  // ── ANALYTICS EVENT TRACKING ──────────────────────────────
  // Only fires if GA4 (gtag) is loaded
  function track(eventName, params) {
    if (typeof gtag === 'function') {
      gtag('event', eventName, params);
    }
  }

  // CTA Button clicks
  document.querySelectorAll('.btn--primary').forEach(function (btn) {
    btn.addEventListener('click', function () {
      track('cta_click', {
        button_text: btn.textContent.trim(),
        location: (btn.closest('section') || {}).id || 'unknown',
        page: window.location.pathname
      });
    });
  });

  // WhatsApp link clicks
  document.querySelectorAll('a[href*="wa.me"], a[href*="whatsapp"]').forEach(function (link) {
    link.addEventListener('click', function () {
      track('whatsapp_click', {
        page: window.location.pathname,
        location: (link.closest('section') || {}).id || 'footer'
      });
    });
  });

  // Footer legal links — force direct navigation if any stale client behavior interferes.
  document.querySelectorAll('.footer__legal-links a').forEach(function (link) {
    link.addEventListener('click', function (e) {
      e.preventDefault();
      e.stopPropagation();
      window.location.assign(link.href);
    });
  });

  // Scroll depth tracking
  var depths = [25, 50, 75, 90];
  var fired = {};
  window.addEventListener('scroll', function () {
    var scrolled = (window.scrollY / (document.body.scrollHeight - window.innerHeight)) * 100;
    depths.forEach(function (d) {
      if (scrolled >= d && !fired[d]) {
        fired[d] = true;
        track('scroll_depth', { percent_scrolled: d });
      }
    });
  }, { passive: true });

  // ── WAITLIST SUBMISSION ───────────────────────────────────
  var waitlistForm = document.querySelector('form.waitlist-form');
  var waitlistStatus = document.getElementById('waitlist-status');
  var waitlistSuccess = document.getElementById('waitlist-success');

  function clearWaitlistErrors(form) {
    form.querySelectorAll('.waitlist-form__field').forEach(function (field) {
      field.classList.remove('has-error');
    });
    form.querySelectorAll('.waitlist-form__error').forEach(function (error) {
      error.hidden = true;
      error.textContent = '';
    });
  }

  function setFieldError(form, fieldName, message) {
    var field = form.querySelector('[name="' + fieldName + '"]');
    var error = form.querySelector('[data-error-for="' + fieldName + '"]');
    if (field && field.closest('.waitlist-form__field')) {
      field.closest('.waitlist-form__field').classList.add('has-error');
    }
    if (error) {
      error.textContent = message;
      error.hidden = false;
    }
  }

  function setWaitlistStatus(message, type) {
    if (!waitlistStatus) return;

    waitlistStatus.textContent = message;
    waitlistStatus.className = 'waitlist-form__status';
    waitlistStatus.hidden = false;

    if (type === 'error') {
      waitlistStatus.classList.add('is-error');
    }
  }

  if (waitlistForm && window.ogapeTheme && ogapeTheme.ajaxUrl && ogapeTheme.nonce) {
    var submitButton = waitlistForm.querySelector('button[type="submit"]');
    var successCopy = waitlistSuccess ? waitlistSuccess.querySelector('p') : null;
    var pageParams = new URLSearchParams(window.location.search);
    var sourceField = waitlistForm.querySelector('[name="source_page"]');
    var referrerField = waitlistForm.querySelector('[name="referrer"]');
    var utmSourceField = waitlistForm.querySelector('[name="utm_source"]');
    var utmMediumField = waitlistForm.querySelector('[name="utm_medium"]');
    var utmCampaignField = waitlistForm.querySelector('[name="utm_campaign"]');
    var neighbourhoodSelect = waitlistForm.querySelector('[name="neighbourhood"]');
    var otherNeighbourhoodField = waitlistForm.querySelector('.waitlist-form__field--other-neighbourhood');
    var otherNeighbourhoodInput = waitlistForm.querySelector('[name="neighbourhood_other"]');
    var validationMessages = {
      first_name: 'Por favor, escribí tu nombre.',
      email: 'Ingresá un email válido.',
      phone_whatsapp: 'Ingresá un WhatsApp válido con +595 o al menos 8 dígitos.',
      neighbourhood: 'Seleccioná tu barrio.',
      neighbourhood_other: 'Escribí tu barrio para continuar.'
    };

    function syncNeighbourhoodOther() {
      if (!neighbourhoodSelect || !otherNeighbourhoodField || !otherNeighbourhoodInput) return;

      var needsOther = neighbourhoodSelect.value === 'Otra zona de Asunción';
      otherNeighbourhoodField.hidden = !needsOther;
      otherNeighbourhoodField.setAttribute('aria-hidden', String(!needsOther));
      otherNeighbourhoodField.classList.toggle('is-hidden', !needsOther);
      otherNeighbourhoodInput.required = needsOther;
      otherNeighbourhoodInput.disabled = !needsOther;
      otherNeighbourhoodInput.tabIndex = needsOther ? 0 : -1;

      if (!needsOther) {
        otherNeighbourhoodInput.value = '';
      }
    }

    if (sourceField) {
      sourceField.value = window.location.pathname;
    }
    if (referrerField) {
      referrerField.value = document.referrer || '';
    }
    if (utmSourceField) {
      utmSourceField.value = pageParams.get('utm_source') || '';
    }
    if (utmMediumField) {
      utmMediumField.value = pageParams.get('utm_medium') || '';
    }
    if (utmCampaignField) {
      utmCampaignField.value = pageParams.get('utm_campaign') || '';
    }
    syncNeighbourhoodOther();
    if (neighbourhoodSelect) {
      neighbourhoodSelect.addEventListener('change', syncNeighbourhoodOther);
    }

    function validateField(field) {
      if (!field) return true;

      var name = field.name;
      var value = (field.value || '').trim();
      var valid = true;

      if (name === 'email') {
        valid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value);
      } else if (name === 'phone_whatsapp') {
        var digits = value.replace(/\D+/g, '');
        valid = value.indexOf('+595') === 0 || digits.length >= 8;
      } else if (field.required) {
        valid = value !== '';
      }

      if (!valid) {
        setFieldError(waitlistForm, name, validationMessages[name] || 'Revisá este campo.');
      }

      return valid;
    }

    ['first_name', 'email', 'phone_whatsapp', 'neighbourhood', 'neighbourhood_other'].forEach(function (fieldName) {
      var field = waitlistForm.querySelector('[name="' + fieldName + '"]');
      if (!field) return;
      field.addEventListener('blur', function () {
        clearWaitlistErrors(waitlistForm);
        validateField(field);
      });
    });

    waitlistForm.addEventListener('submit', function (e) {
      e.preventDefault();

      clearWaitlistErrors(waitlistForm);
      if (waitlistStatus) {
        waitlistStatus.hidden = true;
      }

      var requiredFields = [
        waitlistForm.querySelector('[name="first_name"]'),
        waitlistForm.querySelector('[name="email"]'),
        waitlistForm.querySelector('[name="phone_whatsapp"]'),
        waitlistForm.querySelector('[name="neighbourhood"]')
      ];

      var formIsValid = requiredFields.every(validateField);
      if (otherNeighbourhoodInput && otherNeighbourhoodInput.required) {
        formIsValid = validateField(otherNeighbourhoodInput) && formIsValid;
      }

      if (!formIsValid) {
        var firstInvalid = waitlistForm.querySelector('.waitlist-form__field.has-error input, .waitlist-form__field.has-error select');
        if (firstInvalid) firstInvalid.focus();
        setWaitlistStatus('Revisá los campos marcados antes de enviar.', 'error');
        return;
      }

      var formData = new FormData(waitlistForm);
      formData.append('action', 'ogape_waitlist_submit');
      formData.append('nonce', ogapeTheme.nonce);

      if (submitButton) {
        submitButton.disabled = true;
        submitButton.setAttribute('aria-busy', 'true');
      }

      fetch(ogapeTheme.ajaxUrl, {
        method: 'POST',
        credentials: 'same-origin',
        body: formData
      })
        .then(function (response) {
          return response.json().then(function (payload) {
            return { ok: response.ok, payload: payload };
          });
        })
        .then(function (result) {
          var payload = result.payload || {};
          var data = payload.data || {};

          if (!result.ok || !payload.success) {
            if (data.field) {
              var invalidField = waitlistForm.querySelector('[name="' + data.field + '"]');
              if (invalidField) {
                setFieldError(waitlistForm, data.field, data.message || ogapeTheme.messages.error);
                invalidField.focus();
              }
            }

            setWaitlistStatus(data.message || ogapeTheme.messages.error, 'error');
            return;
          }

          if (successCopy) {
            successCopy.textContent = '¡Listo! Te avisamos cuando abramos tu zona. 🎉';
          }

          waitlistForm.hidden = true;
          if (waitlistStatus) {
            waitlistStatus.hidden = true;
          }
          if (waitlistSuccess) {
            waitlistSuccess.hidden = false;
          }
          waitlistForm.reset();
          syncNeighbourhoodOther();

          if (typeof gtag === 'function') {
            gtag('event', 'waitlist_signup', {
              form_location: (sourceField && sourceField.value) || window.location.pathname,
              submission_status: data.status || 'created',
              has_neighbourhood: !!waitlistForm.querySelector('[name="neighbourhood"]').value
            });
          }
          if (typeof fbq === 'function') {
            fbq('track', 'Lead');
          }
        })
        .catch(function () {
          setWaitlistStatus(ogapeTheme.messages.error, 'error');
        })
        .finally(function () {
          if (submitButton) {
            submitButton.disabled = false;
            submitButton.removeAttribute('aria-busy');
          }
        });
    });
  }

  // ── FAQ ACCORDION ────────────────────────────────────────
  document.querySelectorAll('.faq-accordion__trigger').forEach(function (trigger) {
    trigger.addEventListener('click', function () {
      var panel = document.getElementById(trigger.getAttribute('aria-controls'));
      var isExpanded = trigger.getAttribute('aria-expanded') === 'true';

      trigger.setAttribute('aria-expanded', String(!isExpanded));

      if (panel) {
        panel.hidden = isExpanded;
      }
    });
  });

})();
