# Ogape Brand Asset Notes

Master SVG source for this theme:

`/Users/ogape/My Drive/07 — Brand/Logos/Ogape Logos/Logo Only/Web/SVG/Logo.svg`

Rules:

- Do not commit `.ai`, `.eps`, or `.pdf` design masters to this repository.
- Keep branding changes inside `wp-content/themes/ogape-child-theme/`.
- Use the WordPress Customizer field `WhatsApp contact (include country code)` to set the live WhatsApp number.

Current web asset targets:

- `assets/img/ogape-logo.svg`
- `assets/img/ogape-logo.png`
- `assets/img/ogape-logo@2x.png`
- `assets/img/favicon.svg`
- `assets/img/favicon-32.png`

Optimization commands:

```bash
svgo wp-content/themes/ogape-child-theme/assets/img/ogape-logo.svg \
  -o wp-content/themes/ogape-child-theme/assets/img/ogape-logo.svg
```

```bash
inkscape wp-content/themes/ogape-child-theme/assets/img/ogape-logo.svg \
  --export-type=png \
  --export-filename=wp-content/themes/ogape-child-theme/assets/img/ogape-logo.png \
  --export-width=240
```

```bash
inkscape wp-content/themes/ogape-child-theme/assets/img/ogape-logo.svg \
  --export-type=png \
  --export-filename=wp-content/themes/ogape-child-theme/assets/img/ogape-logo@2x.png \
  --export-width=480
```

```bash
inkscape wp-content/themes/ogape-child-theme/assets/img/favicon.svg \
  --export-type=png \
  --export-filename=wp-content/themes/ogape-child-theme/assets/img/favicon-32.png \
  --export-width=32
```
