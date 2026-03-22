# Asset Build Instructions

Local tooling was not available in this environment:

- `svgo` not found
- `inkscape` not found
- `node` not found
- `npm` not found

The source SVG was copied into the theme as-is:

- `assets/img/ogape-logo.svg`
- `assets/img/favicon.svg`

To finish optimization locally or in CI, run:

```bash
cp "/Users/ogape/My Drive/07 — Brand/Logos/Ogape Logos/Logo Only/Web/SVG/Logo.svg" \
  wp-content/themes/ogape-child-theme/assets/img/ogape-logo.svg
```

```bash
cp "/Users/ogape/My Drive/07 — Brand/Logos/Ogape Logos/Logo Only/Web/SVG/Logo.svg" \
  wp-content/themes/ogape-child-theme/assets/img/favicon.svg
```

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

After generating the PNGs, verify the header fallback logo and favicon load without 404s on staging.
