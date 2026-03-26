# Asset Build Instructions

SVG optimization and PNG generation have been completed. All output files are committed to the repo.

## Generated files

| File | Size | Notes |
|---|---|---|
| `assets/img/ogape-logo.svg` | 5.5 KB | Optimized with svgo (−38% from 8.8 KB) |
| `assets/img/favicon.svg` | 5.5 KB | Optimized with svgo (−38% from 8.8 KB) |
| `assets/img/ogape-logo.png` | 16 KB | 240 px wide, rendered with @resvg/resvg-js |
| `assets/img/ogape-logo@2x.png` | 33 KB | 480 px wide (retina), rendered with @resvg/resvg-js |
| `assets/img/favicon-32.png` | 1.8 KB | 32×32 px, rendered with @resvg/resvg-js |

## How to regenerate

Requires Node 18+ (available at `/opt/node22/bin/node`).

```bash
# Optimize SVGs
npx svgo assets/img/ogape-logo.svg -o assets/img/ogape-logo.svg --multipass
npx svgo assets/img/favicon.svg    -o assets/img/favicon.svg    --multipass

# Generate PNGs (run from project root after npm install)
node -e "
const { Resvg } = require('@resvg/resvg-js');
const { readFileSync, writeFileSync } = require('fs');
const logo = readFileSync('./assets/img/ogape-logo.svg');
const fav  = readFileSync('./assets/img/favicon.svg');
const render = (svg, w, out) => writeFileSync(out, new Resvg(svg, { fitTo: { mode: 'width', value: w } }).render().asPng());
render(logo, 240, './assets/img/ogape-logo.png');
render(logo, 480, './assets/img/ogape-logo@2x.png');
render(fav,   32, './assets/img/favicon-32.png');
console.log('Done');
"
```

## Source SVG

Original source: `07 — Brand/Logos/Ogape Logos/Logo Only/Web/SVG/Logo.svg` (Google Drive).

Replace `assets/img/ogape-logo.svg` and `assets/img/favicon.svg` with the latest brand asset before regenerating.
