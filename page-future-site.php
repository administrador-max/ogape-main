<?php
/**
 * Template Name: FutureSite
 * Template Post Type: page
 *
 * WordPress-native implementation of the "Ogape Tu Chef en Casa" landing in /future-site.
 */

get_header();

$waitlist_url = home_url( '/waitlist/' );
$menu_url     = home_url( '/menu/' );
$login_url    = home_url( '/login/' );
$register_url = home_url( '/register/' );
$account_url  = home_url( '/account/' );
$faq_url      = home_url( '/faq/' );
$privacy_url  = home_url( '/privacidad/' );
?>

<main id="main" class="site-main" role="main">
    <div class="future-site-v2">
        <style>
            .future-site-v2 {
                --fs-bg: #f7efe3;
                --fs-bg-alt: #fbf6ec;
                --fs-surface: #fff;
                --fs-ink: #1b1b1e;
                --fs-muted: #6b6258;
                --fs-brand: #e8a045;
                --fs-brand-strong: #ba6e15;
                --fs-border: rgba(27, 27, 30, 0.12);
                --fs-shadow: 0 26px 60px -22px rgba(27, 27, 30, 0.35);
                --fs-radius: 18px;
                --fs-radius-lg: 24px;
                color: var(--fs-ink);
                background: radial-gradient(circle at 20% -10%, rgba(232, 160, 69, 0.18), transparent 40%), var(--fs-bg);
                font-family: "Inter", "Avenir Next", "Segoe UI", sans-serif;
            }

            .future-site-v2 * {
                box-sizing: border-box;
            }

            .future-site-v2 a {
                color: inherit;
                text-decoration: none;
            }

            .future-site-v2 .wrap {
                width: min(1100px, calc(100% - 2.5rem));
                margin: 0 auto;
            }

            .future-site-v2 .eyebrow {
                display: inline-block;
                font-size: 11px;
                font-weight: 600;
                letter-spacing: 0.18em;
                text-transform: uppercase;
                color: var(--fs-brand-strong);
            }

            .future-site-v2 h1,
            .future-site-v2 h2,
            .future-site-v2 h3,
            .future-site-v2 h4 {
                font-family: "Cormorant Garamond", Georgia, serif;
                font-weight: 600;
                letter-spacing: -0.015em;
                line-height: 1.05;
                margin: 0;
            }

            .future-site-v2 section {
                padding: 5.25rem 0;
            }

            .future-site-v2 .hero {
                padding-top: 4.25rem;
            }

            .future-site-v2 .hero__grid {
                display: grid;
                gap: 2rem;
                align-items: center;
            }

            .future-site-v2 .hero__title {
                margin-top: 0.9rem;
                font-size: clamp(2.5rem, 5vw + 1rem, 5.1rem);
            }

            .future-site-v2 .hero__title em,
            .future-site-v2 h2 em {
                color: var(--fs-brand-strong);
                font-style: italic;
            }

            .future-site-v2 .hero__lede {
                margin-top: 1.1rem;
                max-width: 44ch;
                color: var(--fs-muted);
                line-height: 1.7;
            }

            .future-site-v2 .hero__ctas,
            .future-site-v2 .btns {
                display: flex;
                flex-wrap: wrap;
                gap: 0.75rem;
                margin-top: 1.4rem;
            }

            .future-site-v2 .btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 0.45rem;
                border-radius: 999px;
                padding: 0.68rem 1.05rem;
                font-size: 14px;
                font-weight: 600;
                border: 1px solid var(--fs-border);
                transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
            }

            .future-site-v2 .btn:hover {
                transform: translateY(-1px);
            }

            .future-site-v2 .btn--primary,
            .future-site-v2 .btn--warm {
                background: var(--fs-ink);
                color: var(--fs-bg);
                border-color: var(--fs-ink);
            }

            .future-site-v2 .btn--ghost {
                background: rgba(255, 255, 255, 0.72);
            }

            .future-site-v2 .hero__meta {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
                gap: 0.75rem;
                margin-top: 1.25rem;
                max-width: 600px;
            }

            .future-site-v2 .hero__meta div {
                background: rgba(255, 255, 255, 0.68);
                border: 1px solid var(--fs-border);
                border-radius: 14px;
                padding: 0.7rem 0.8rem;
                font-size: 12px;
                color: var(--fs-muted);
            }

            .future-site-v2 .hero__meta b {
                display: block;
                color: var(--fs-ink);
                font-size: 17px;
                margin-bottom: 0.2rem;
            }

            .future-site-v2 .hero__media {
                margin: 0;
                border-radius: var(--fs-radius-lg);
                padding: 1.5rem;
                background: linear-gradient(165deg, #c89e5c 0%, #8c5925 100%);
                box-shadow: var(--fs-shadow);
                color: #f9f1e4;
                position: relative;
                overflow: hidden;
            }

            .future-site-v2 .kit-box {
                height: 220px;
                border: 1px solid rgba(247, 239, 227, 0.35);
                border-radius: 14px;
                background: linear-gradient(140deg, rgba(247, 239, 227, 0.2), rgba(27, 27, 30, 0.32));
            }

            .future-site-v2 .kit-items {
                margin-top: 1rem;
                display: flex;
                flex-wrap: wrap;
                gap: 0.45rem;
            }

            .future-site-v2 .kit-chip {
                display: inline-flex;
                align-items: center;
                padding: 0.33rem 0.68rem;
                border-radius: 999px;
                background: rgba(247, 239, 227, 0.18);
                border: 1px solid rgba(247, 239, 227, 0.3);
                font-size: 12px;
            }

            .future-site-v2 .kit-chip--accent {
                background: rgba(27, 27, 30, 0.28);
            }

            .future-site-v2 .hero__caption {
                display: flex;
                gap: 0.9rem;
                margin-top: 1rem;
                border-top: 1px solid rgba(247, 239, 227, 0.24);
                padding-top: 1rem;
            }

            .future-site-v2 .hero__caption .num {
                font-size: 2.5rem;
                line-height: 1;
                font-family: "Cormorant Garamond", Georgia, serif;
            }

            .future-site-v2 .cap-eyebrow {
                display: block;
                font-size: 10px;
                letter-spacing: 0.14em;
                text-transform: uppercase;
                opacity: 0.8;
            }

            .future-site-v2 .cap-title {
                margin-top: 0.2rem;
                font-size: 1.25rem;
                font-family: "Cormorant Garamond", Georgia, serif;
            }

            .future-site-v2 .cap-sub {
                margin-top: 0.3rem;
                font-size: 13px;
                opacity: 0.88;
            }

            .future-site-v2 .sec-head {
                display: flex;
                flex-wrap: wrap;
                gap: 1.1rem;
                justify-content: space-between;
                align-items: end;
                margin-bottom: 1.6rem;
            }

            .future-site-v2 .sec-head h2 {
                font-size: clamp(2rem, 2vw + 1.2rem, 3.3rem);
                max-width: 18ch;
            }

            .future-site-v2 .sec-head p {
                margin: 0;
                max-width: 43ch;
                color: var(--fs-muted);
                line-height: 1.65;
            }

            .future-site-v2 .how {
                background: var(--fs-bg-alt);
            }

            .future-site-v2 .how__grid,
            .future-site-v2 .dishes,
            .future-site-v2 .sizes,
            .future-site-v2 .plan__facts,
            .future-site-v2 .faq__grid,
            .future-site-v2 .pillars,
            .future-site-v2 .zone-list {
                display: grid;
                gap: 0.85rem;
            }

            .future-site-v2 .how__grid {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            }

            .future-site-v2 .step,
            .future-site-v2 .dish,
            .future-site-v2 .size,
            .future-site-v2 .plan__fact,
            .future-site-v2 details.q,
            .future-site-v2 .pillar,
            .future-site-v2 .zone-list > div,
            .future-site-v2 .plan__card {
                border-radius: var(--fs-radius);
                border: 1px solid var(--fs-border);
                background: var(--fs-surface);
            }

            .future-site-v2 .step {
                padding: 1rem;
            }

            .future-site-v2 .step h3 {
                font-size: 1.45rem;
                margin-top: 0.4rem;
            }

            .future-site-v2 .step p {
                color: var(--fs-muted);
                margin-top: 0.4rem;
                font-size: 14px;
                line-height: 1.6;
            }

            .future-site-v2 .step__num {
                font-size: 11px;
                text-transform: uppercase;
                letter-spacing: 0.12em;
                color: var(--fs-brand-strong);
            }

            .future-site-v2 .week__bar {
                margin-bottom: 1rem;
                border: 1px solid var(--fs-border);
                border-radius: 999px;
                background: rgba(255, 255, 255, 0.74);
                padding: 0.5rem 0.9rem;
                display: flex;
                flex-wrap: wrap;
                gap: 0.6rem;
                font-size: 12px;
                color: var(--fs-muted);
            }

            .future-site-v2 .pill {
                padding: 0.1rem 0.55rem;
                border-radius: 999px;
                background: rgba(232, 160, 69, 0.2);
                color: #7d4509;
                font-weight: 600;
            }

            .future-site-v2 .dishes {
                grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
            }

            .future-site-v2 .dish {
                overflow: hidden;
            }

            .future-site-v2 .dish__img {
                min-height: 130px;
                padding: 0.75rem;
                color: #f8efe2;
                display: flex;
                justify-content: space-between;
                flex-direction: column;
                gap: 0.75rem;
                background: linear-gradient(150deg, #2f2a26 0%, #9f6d2b 100%);
            }

            .future-site-v2 .dish--beef .dish__img { background: linear-gradient(150deg, #2f2118 0%, #7b4631 100%); }
            .future-site-v2 .dish--bowl .dish__img { background: linear-gradient(150deg, #1f3329 0%, #3f8155 100%); }
            .future-site-v2 .dish--curry .dish__img { background: linear-gradient(150deg, #533619 0%, #b97820 100%); }
            .future-site-v2 .dish--mila .dish__img { background: linear-gradient(150deg, #412b1b 0%, #8b6a39 100%); }

            .future-site-v2 .dish__meta,
            .future-site-v2 .dish__tags {
                display: flex;
                justify-content: space-between;
                gap: 0.4rem;
                font-size: 11px;
            }

            .future-site-v2 .tag {
                border: 1px solid rgba(247, 239, 227, 0.38);
                border-radius: 999px;
                padding: 0.15rem 0.45rem;
            }

            .future-site-v2 .dish__body {
                padding: 0.95rem;
            }

            .future-site-v2 .dish__num {
                font-size: 11px;
                text-transform: uppercase;
                letter-spacing: 0.12em;
                color: var(--fs-brand-strong);
            }

            .future-site-v2 .dish__title {
                margin-top: 0.35rem;
                font-size: 1.6rem;
            }

            .future-site-v2 .dish__title-en {
                margin-top: 0.1rem;
                font-size: 12px;
                color: var(--fs-muted);
            }

            .future-site-v2 .dish__desc {
                margin-top: 0.5rem;
                color: var(--fs-muted);
                line-height: 1.65;
                font-size: 14px;
            }

            .future-site-v2 .dish__foot {
                margin-top: 0.65rem;
                display: flex;
                justify-content: space-between;
                gap: 0.8rem;
                align-items: flex-end;
            }

            .future-site-v2 .dish__stats {
                display: flex;
                flex-wrap: wrap;
                gap: 0.65rem;
                font-size: 11px;
                color: var(--fs-muted);
            }

            .future-site-v2 .dish__stats b {
                display: block;
                color: var(--fs-ink);
                font-size: 13px;
                margin-top: 0.1rem;
            }

            .future-site-v2 .dish__link {
                font-size: 13px;
                font-weight: 600;
            }

            .future-site-v2 .week__foot {
                margin-top: 1rem;
                padding-top: 1rem;
                border-top: 1px solid var(--fs-border);
                display: flex;
                justify-content: space-between;
                flex-wrap: wrap;
                gap: 0.7rem;
                color: var(--fs-muted);
                font-size: 13px;
            }

            .future-site-v2 .plan {
                background: var(--fs-bg-alt);
            }

            .future-site-v2 .plan__grid,
            .future-site-v2 .zones__grid,
            .future-site-v2 .story__grid {
                display: grid;
                gap: 1.1rem;
            }

            .future-site-v2 .plan h2,
            .future-site-v2 .zones h2,
            .future-site-v2 .story h2 {
                margin-top: 0.4rem;
                font-size: clamp(2rem, 2.4vw + 1.1rem, 3.6rem);
            }

            .future-site-v2 .plan .lede,
            .future-site-v2 .zones p,
            .future-site-v2 .story p {
                margin-top: 0.65rem;
                color: var(--fs-muted);
                line-height: 1.7;
            }

            .future-site-v2 .size {
                padding: 0.75rem;
                cursor: pointer;
                transition: border-color 0.2s ease, box-shadow 0.2s ease;
            }

            .future-site-v2 .size .k {
                display: block;
                font-size: 11px;
                text-transform: uppercase;
                letter-spacing: 0.12em;
                color: var(--fs-brand-strong);
            }

            .future-site-v2 .size .n {
                margin-top: 0.25rem;
                font-size: 1.4rem;
                font-family: "Cormorant Garamond", Georgia, serif;
            }

            .future-site-v2 .size .p {
                margin-top: 0.15rem;
                color: var(--fs-muted);
                font-size: 13px;
            }

            .future-site-v2 .size.is-active {
                border-color: rgba(232, 160, 69, 0.55);
                box-shadow: 0 10px 24px rgba(186, 110, 21, 0.14);
            }

            .future-site-v2 .plan__fact {
                padding: 0.72rem;
            }

            .future-site-v2 .plan__fact .k {
                font-size: 11px;
                letter-spacing: 0.12em;
                text-transform: uppercase;
                color: var(--fs-brand-strong);
            }

            .future-site-v2 .plan__fact .v {
                margin-top: 0.2rem;
                font-size: 14px;
                color: var(--fs-muted);
                line-height: 1.55;
            }

            .future-site-v2 .plan__card {
                padding: 1rem;
            }

            .future-site-v2 .plan__card h3 {
                font-size: 1.8rem;
            }

            .future-site-v2 .price {
                display: flex;
                flex-direction: column;
                margin-top: 0.4rem;
            }

            .future-site-v2 .price .amt {
                font-size: 2rem;
                font-family: "Cormorant Garamond", Georgia, serif;
            }

            .future-site-v2 .price .per {
                font-size: 12px;
                color: var(--fs-muted);
            }

            .future-site-v2 .includes {
                margin: 0.8rem 0;
                padding-left: 1rem;
                display: grid;
                gap: 0.34rem;
                color: var(--fs-muted);
                font-size: 14px;
            }

            .future-site-v2 .includes li::marker {
                color: var(--fs-brand-strong);
            }

            .future-site-v2 .caveat {
                margin-top: 0.65rem;
                color: var(--fs-muted);
                font-size: 12px;
            }

            .future-site-v2 .zone-list {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
                margin-top: 0.75rem;
            }

            .future-site-v2 .zone-list > div {
                padding: 0.62rem;
                font-size: 13px;
                display: flex;
                justify-content: space-between;
                gap: 0.5rem;
            }

            .future-site-v2 .zone-list small {
                color: var(--fs-muted);
            }

            .future-site-v2 .mapcard {
                border-radius: var(--fs-radius-lg);
                overflow: hidden;
                min-height: 320px;
                border: 1px solid var(--fs-border);
                background: linear-gradient(160deg, #2a3a4a 0%, #3b2a14 100%);
                position: relative;
            }

            .future-site-v2 .mapcard svg {
                width: 100%;
                height: 100%;
            }

            .future-site-v2 .mapcard .pin {
                position: absolute;
                width: 14px;
                height: 14px;
                border-radius: 999px;
                background: var(--fs-brand);
                box-shadow: 0 0 0 5px rgba(232, 160, 69, 0.2);
            }

            .future-site-v2 .mapcard .label {
                position: absolute;
                font-size: 10px;
                color: rgba(247, 239, 227, 0.86);
                letter-spacing: 0.13em;
                text-transform: uppercase;
                padding: 0.25rem 0.45rem;
                border-radius: 999px;
                background: rgba(27, 27, 30, 0.62);
            }

            .future-site-v2 .check-form {
                margin-top: 0.8rem;
                display: flex;
                gap: 0.6rem;
                flex-wrap: wrap;
            }

            .future-site-v2 .check-form input {
                min-width: 220px;
                flex: 1;
                border: 1px solid var(--fs-border);
                border-radius: 999px;
                padding: 0.7rem 0.95rem;
                font: inherit;
            }

            .future-site-v2 .check-help {
                margin-top: 0.5rem;
                color: var(--fs-muted);
                font-size: 12px;
            }

            .future-site-v2 .pillars {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            }

            .future-site-v2 .pillar {
                padding: 0.9rem;
            }

            .future-site-v2 .pillar .n {
                color: var(--fs-brand-strong);
                font-style: italic;
                font-family: "Cormorant Garamond", Georgia, serif;
            }

            .future-site-v2 .pillar h3 {
                margin-top: 0.25rem;
                font-size: 1.45rem;
            }

            .future-site-v2 .pillar p {
                margin: 0.3rem 0 0;
                color: var(--fs-muted);
                font-size: 13px;
            }

            .future-site-v2 .faq {
                background: var(--fs-bg-alt);
            }

            .future-site-v2 details.q {
                padding: 0.8rem 0.95rem;
            }

            .future-site-v2 details.q summary {
                cursor: pointer;
                list-style: none;
                font-size: 1.4rem;
                font-family: "Cormorant Garamond", Georgia, serif;
            }

            .future-site-v2 details.q summary::-webkit-details-marker {
                display: none;
            }

            .future-site-v2 details.q p {
                margin-top: 0.45rem;
                color: var(--fs-muted);
                line-height: 1.65;
                font-size: 14px;
            }

            .future-site-v2 .final {
                text-align: center;
                background: radial-gradient(circle at 50% 0%, rgba(232, 160, 69, 0.2), transparent 58%), #faf4ea;
            }

            .future-site-v2 .final h2 {
                font-size: clamp(2.3rem, 3.8vw + 1rem, 4.2rem);
                margin-top: 0.5rem;
            }

            .future-site-v2 .final p {
                max-width: 48ch;
                margin: 0.8rem auto 0;
                color: var(--fs-muted);
                line-height: 1.65;
            }

            .future-site-v2 .future-footer {
                padding: 2.5rem 0 3.5rem;
                background: #1b1b1e;
                color: rgba(247, 239, 227, 0.75);
            }

            .future-site-v2 .future-footer-grid {
                display: grid;
                gap: 1rem;
                grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            }

            .future-site-v2 .future-footer h4 {
                font-family: "Inter", "Avenir Next", "Segoe UI", sans-serif;
                text-transform: uppercase;
                letter-spacing: 0.15em;
                font-size: 11px;
                color: rgba(247, 239, 227, 0.52);
            }

            .future-site-v2 .future-footer ul {
                margin: 0.45rem 0 0;
                padding: 0;
                list-style: none;
                display: grid;
                gap: 0.3rem;
            }

            .future-site-v2 .future-footer li,
            .future-site-v2 .future-footer a {
                font-size: 14px;
                color: rgba(247, 239, 227, 0.76);
            }

            @media (min-width: 880px) {
                .future-site-v2 .hero__grid,
                .future-site-v2 .plan__grid,
                .future-site-v2 .zones__grid,
                .future-site-v2 .story__grid {
                    grid-template-columns: 1fr 1fr;
                    gap: 1.6rem;
                }

                .future-site-v2 .sizes,
                .future-site-v2 .plan__facts {
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                }
            }
        </style>

        <section class="hero">
            <div class="wrap hero__grid">
                <div>
                    <div class="hero__kicker">
                        <span class="eyebrow">Ogape Tu Chef en Casa · Semana del 20 al 26 de abril</span>
                    </div>
                    <h1 class="hero__title">Cocina paraguaya,<br><em>lista para tu casa.</em></h1>
                    <p class="hero__lede">Cinco recetas por semana. Ingredientes del río, del monte y de la huerta porcionados y fríos, con instrucciones simples. Vos cocinás en 30 minutos. Nosotros pensamos el resto.</p>
                    <div class="hero__ctas">
                        <a href="#final" class="btn btn--primary">Unirme</a>
                        <a href="#semana" class="btn btn--ghost">Ver el menú de la semana</a>
                    </div>
                    <div class="hero__meta">
                        <div><b>5 recetas</b>nuevas cada semana</div>
                        <div><b>~30 min</b>de cocción en casa</div>
                        <div><b>Asunción</b>entrega los jueves</div>
                    </div>
                </div>

                <figure class="hero__media" aria-label="Ogape Tu Chef en Casa">
                    <div class="kit-box" aria-hidden="true"></div>
                    <div class="kit-items" aria-hidden="true">
                        <span class="kit-chip kit-chip--accent">Surubí</span>
                        <span class="kit-chip">Maracuyá</span>
                        <span class="kit-chip">Mandioca</span>
                        <span class="kit-chip">Curry de coco</span>
                        <span class="kit-chip">Bife koygua</span>
                        <span class="kit-chip">Alioli</span>
                        <span class="kit-chip">Hierbas</span>
                    </div>
                    <figcaption class="hero__caption">
                        <div class="num">N.º 01</div>
                        <div class="cap-r">
                            <span class="cap-eyebrow">Plato estrella esta semana</span>
                            <div class="cap-title">Surubí al Maracuyá</div>
                            <div class="cap-sub">Paraná · mantequilla de maracuyá · mandioca</div>
                        </div>
                    </figcaption>
                </figure>
            </div>
        </section>

        <section class="how" id="como">
            <div class="wrap">
                <div class="sec-head">
                    <div>
                        <span class="eyebrow">01 · Cómo funciona</span>
                        <h2>De la huerta a tu mesa, en cuatro pasos.</h2>
                    </div>
                    <p>Sin suscripción rígida. Pedís la semana que querés. Pausás cuando querés.</p>
                </div>
                <div class="how__grid">
                    <article class="step">
                        <span class="step__num">paso i.</span>
                        <h3>Elegís el menú</h3>
                        <p>Mirás las 5 recetas de la semana y elegís cuántas porciones querés para 2 o 4 personas.</p>
                    </article>
                    <article class="step">
                        <span class="step__num">paso ii.</span>
                        <h3>Preparamos tu caja</h3>
                        <p>Porcionamos todo y lo enviamos en una caja refrigerada lista para entrar en tu rutina.</p>
                    </article>
                    <article class="step">
                        <span class="step__num">paso iii.</span>
                        <h3>Llega a tu puerta</h3>
                        <p>Entregas los jueves entre 10:00 y 19:00 en Asunción, con opción de portería.</p>
                    </article>
                    <article class="step">
                        <span class="step__num">paso iv.</span>
                        <h3>Cocinás en 30 min</h3>
                        <p>Instrucciones claras para que cocinar sea simple y consistente cada semana.</p>
                    </article>
                </div>
            </div>
        </section>

        <section class="week" id="semana">
            <div class="wrap">
                <div class="sec-head">
                    <div>
                        <span class="eyebrow">02 · El menú de esta semana</span>
                        <h2>Cinco recetas, elegidas despacio.</h2>
                    </div>
                    <p>Cada semana renovamos las recetas según lo que llega del río, del monte y de la huerta.</p>
                </div>

                <div class="week__bar">
                    <span class="pill">Semana activa</span>
                    <span>Pedidos cierran: <b>martes 23:59</b></span>
                    <span>Entrega: <b>jueves</b></span>
                </div>

                <div class="dishes">
                    <article class="dish dish--hero">
                        <div class="dish__img">
                            <div class="dish__tags"><span class="tag">Plato Estrella</span><span class="tag">Local</span></div>
                            <div class="dish__meta"><span>35 min</span><span>Dificultad media</span></div>
                        </div>
                        <div class="dish__body">
                            <span class="dish__num">Receta N.º 01 · del río</span>
                            <h3 class="dish__title">Surubí al Maracuyá</h3>
                            <div class="dish__title-en">Surubi with passion fruit butter</div>
                            <p class="dish__desc">Surubí del Paraná con mantequilla de maracuyá y mandioca dorada, pensado para un resultado premium en minutos.</p>
                            <div class="dish__foot">
                                <div class="dish__stats"><div>Porciones<b>2 · 4</b></div><div>Calorías<b>620 kcal</b></div></div>
                                <a href="<?php echo esc_url( $menu_url ); ?>" class="dish__link">Ver receta</a>
                            </div>
                        </div>
                    </article>

                    <article class="dish dish--beef">
                        <div class="dish__img"><div class="dish__tags"><span class="tag">Favorito</span></div><div class="dish__meta"><span>40 min</span><span>Dificultad baja</span></div></div>
                        <div class="dish__body">
                            <span class="dish__num">Receta N.º 02 · del monte</span>
                            <h3 class="dish__title">Bife Koygua Negro</h3>
                            <div class="dish__title-en">Black beer countryside beef</div>
                            <p class="dish__desc">Costilla braseada con cebolla asada y puré rústico.</p>
                            <div class="dish__foot"><div class="dish__stats"><div>Porciones<b>2 · 4</b></div><div>Calorías<b>710 kcal</b></div></div><a href="<?php echo esc_url( $menu_url ); ?>" class="dish__link">Ver receta</a></div>
                        </div>
                    </article>

                    <article class="dish dish--bowl">
                        <div class="dish__img"><div class="dish__tags"><span class="tag">Favorito</span></div><div class="dish__meta"><span>25 min</span><span>Dificultad baja</span></div></div>
                        <div class="dish__body">
                            <span class="dish__num">Receta N.º 03 · de la huerta</span>
                            <h3 class="dish__title">Bowl Proteico Ogape</h3>
                            <div class="dish__title-en">Ogape protein bowl</div>
                            <p class="dish__desc">Pollo grillado, arroz jazmín, hummus suave y verduras encurtidas.</p>
                            <div class="dish__foot"><div class="dish__stats"><div>Porciones<b>2 · 4</b></div><div>Calorías<b>540 kcal</b></div></div><a href="<?php echo esc_url( $menu_url ); ?>" class="dish__link">Ver receta</a></div>
                        </div>
                    </article>

                    <article class="dish dish--curry">
                        <div class="dish__img"><div class="dish__tags"><span class="tag">Internacional</span></div><div class="dish__meta"><span>30 min</span><span>Dificultad baja</span></div></div>
                        <div class="dish__body">
                            <span class="dish__num">Receta N.º 04 · del mundo</span>
                            <h3 class="dish__title">Pollo al Curry Suave</h3>
                            <div class="dish__title-en">Mild coconut curry chicken</div>
                            <p class="dish__desc">Curry de coco con especias dosificadas y arroz perfumado.</p>
                            <div class="dish__foot"><div class="dish__stats"><div>Porciones<b>2 · 4</b></div><div>Calorías<b>580 kcal</b></div></div><a href="<?php echo esc_url( $menu_url ); ?>" class="dish__link">Ver receta</a></div>
                        </div>
                    </article>

                    <article class="dish dish--mila">
                        <div class="dish__img"><div class="dish__tags"><span class="tag">Favorito</span></div><div class="dish__meta"><span>25 min</span><span>Dificultad muy baja</span></div></div>
                        <div class="dish__body">
                            <span class="dish__num">Receta N.º 05 · clásico de casa</span>
                            <h3 class="dish__title">Milanesa Signature</h3>
                            <div class="dish__title-en">Signature milanesa</div>
                            <p class="dish__desc">Milanesa premium apanada con papas rústicas y alioli casero.</p>
                            <div class="dish__foot"><div class="dish__stats"><div>Porciones<b>2 · 4</b></div><div>Calorías<b>670 kcal</b></div></div><a href="<?php echo esc_url( $menu_url ); ?>" class="dish__link">Ver receta</a></div>
                        </div>
                    </article>
                </div>

                <div class="week__foot">
                    <p>Sumás al kit sopa paraguaya artesanal, mandioca frita con alioli o ensalada de temporada.</p>
                    <a href="#plan" class="btn btn--ghost">Ver precios y tamaños</a>
                </div>
            </div>
        </section>

        <section class="plan" id="plan">
            <div class="wrap plan__grid">
                <div>
                    <span class="eyebrow">03 · La caja</span>
                    <h2>Una caja, <em>dos tamaños.</em></h2>
                    <p class="lede">Elegís cuántas recetas por semana y para cuántas personas. Sin suscripción. Pausás o cancelás sin fricción.</p>

                    <div class="sizes" role="group" aria-label="Tamaños">
                        <div class="size is-active" data-size="2p3"><span class="k">Para 2</span><div class="n">3 recetas</div><div class="p">6 porciones · ideal pareja</div></div>
                        <div class="size" data-size="2p5"><span class="k">Para 2</span><div class="n">5 recetas</div><div class="p">10 porciones · toda la semana</div></div>
                        <div class="size" data-size="4p3"><span class="k">Para 4</span><div class="n">3 recetas</div><div class="p">12 porciones · familia corta</div></div>
                        <div class="size" data-size="4p5"><span class="k">Para 4</span><div class="n">5 recetas</div><div class="p">20 porciones · familia completa</div></div>
                    </div>

                    <div class="plan__facts">
                        <div class="plan__fact"><span class="k">Sin compromiso</span><div class="v">Pausás o cancelás cuando quieras</div></div>
                        <div class="plan__fact"><span class="k">Frescura</span><div class="v">Caja refrigerada con entrega el mismo día</div></div>
                        <div class="plan__fact"><span class="k">Origen</span><div class="v">Productores de Central y pescadores locales</div></div>
                        <div class="plan__fact"><span class="k">Tiempo en casa</span><div class="v">25 a 40 min por receta</div></div>
                    </div>
                </div>

                <aside class="plan__card">
                    <h3>Para 2 · 3 recetas</h3>
                    <div class="price"><span class="amt">Gs 285.000</span><span class="per">/ semana · Gs 47.500 por porción</span></div>
                    <ul class="includes">
                        <li>Ingredientes porcionados para 3 recetas (6 porciones)</li>
                        <li>Receta impresa e ilustrada con pasos claros</li>
                        <li>Caja refrigerada y compostable</li>
                        <li>Entrega jueves en Asunción sin cargo extra</li>
                        <li>Pausá la semana que no estás</li>
                    </ul>
                    <a href="<?php echo esc_url( $register_url ); ?>?fresh=1" class="btn btn--warm" style="width:100%;">Comenzar con esta caja</a>
                    <p class="caveat">Precio indicativo del piloto. Ajustes finales al cierre del programa.</p>
                </aside>
            </div>
        </section>

        <section class="zones" id="zonas">
            <div class="wrap zones__grid">
                <div>
                    <span class="eyebrow">04 · Zonas de entrega</span>
                    <h2>Entregamos los jueves en <em>Asunción</em>.</h2>
                    <p>Empezamos en piloto con 6 barrios de Asunción. Si tu zona no está todavía, dejanos tu email y te avisamos cuando abramos.</p>

                    <div class="zone-list">
                        <div><span>Villa Morra</span><small>Activa</small></div>
                        <div><span>Recoleta</span><small>Activa</small></div>
                        <div><span>Las Carmelitas</span><small>Activa</small></div>
                        <div><span>Mburucuyá</span><small>Activa</small></div>
                        <div><span>Ykua Satí</span><small>Activa</small></div>
                        <div><span>Centro</span><small>Activa</small></div>
                        <div><span>San Lorenzo</span><small>Próximamente</small></div>
                        <div><span>Lambaré</span><small>Próximamente</small></div>
                    </div>

                    <form class="check-form" onsubmit="event.preventDefault();this.querySelector('[data-ok]').textContent='¡Listo! Te avisamos cuando abramos tu zona.';">
                        <input type="email" placeholder="tu@email.com · avisame cuando abra mi barrio" required>
                        <button class="btn btn--primary" type="submit">Avisarme</button>
                    </form>
                    <p class="check-help" data-ok>Respetamos tu email. Un mensaje cuando haya novedad, nada más.</p>
                </div>

                <div class="mapcard" role="img" aria-label="Mapa simplificado de zonas de entrega en Asunción">
                    <svg viewBox="0 0 400 400" aria-hidden="true">
                        <path d="M-20 260 Q 80 240 140 260 T 280 240 T 420 260 L 420 420 L -20 420 Z" fill="rgba(107,127,232,.12)"></path>
                        <path d="M-20 260 Q 80 240 140 260 T 280 240 T 420 260" fill="none" stroke="rgba(107,127,232,.3)" stroke-width="1.5"></path>
                        <g fill="rgba(232,160,69,.18)" stroke="rgba(232,160,69,.55)" stroke-width="1">
                            <path d="M180 140 Q 220 120 250 145 Q 260 175 230 185 Q 195 185 175 170 Z"></path>
                            <path d="M130 180 Q 155 165 180 180 Q 180 210 155 215 Q 130 210 125 195 Z"></path>
                            <path d="M240 180 Q 275 170 300 195 Q 295 225 265 230 Q 240 220 235 200 Z"></path>
                            <path d="M95 220 Q 125 210 145 230 Q 140 255 115 255 Q 95 245 90 235 Z"></path>
                            <path d="M200 210 Q 235 200 260 225 Q 255 250 225 255 Q 200 245 195 230 Z"></path>
                        </g>
                    </svg>
                    <div class="pin" style="top:46%;left:54%;"></div>
                    <div class="label" style="top:8%;left:8%;">Asunción</div>
                    <div class="label" style="bottom:8%;right:10%;">Río Paraguay</div>
                    <div class="label" style="top:48%;left:60%;">Villa Morra · Ogape HQ</div>
                </div>
            </div>
        </section>

        <section class="story" id="historia">
            <div class="wrap story__grid">
                <div>
                    <span class="eyebrow">05 · La cocina</span>
                    <h2>Paraguay, <em>sin pedir permiso.</em></h2>
                    <p>Ogape empieza con un pescado del Paraná y una fruta de monte. Desde ahí pensamos la porción, la especia y el tiempo de tu cocina.</p>
                    <p>Trabajamos con productores del departamento Central y pescadores de Asunción para que cada receta se pueda cocinar bien en una cocina real.</p>
                </div>
                <div class="pillars">
                    <div class="pillar"><span class="n">i.</span><h3>Río y monte</h3><p>Surubí del Paraná y frutas de estación.</p></div>
                    <div class="pillar"><span class="n">ii.</span><h3>Mano corta</h3><p>Tres a cinco ingredientes clave por receta.</p></div>
                    <div class="pillar"><span class="n">iii.</span><h3>Porción honesta</h3><p>Pesado real en cocina, no en packaging.</p></div>
                    <div class="pillar"><span class="n">iv.</span><h3>Temporada viva</h3><p>Menú renovado cada semana.</p></div>
                </div>
            </div>
        </section>

        <section class="faq" id="preguntas">
            <div class="wrap">
                <div class="sec-head" style="justify-content:center;text-align:center;">
                    <div>
                        <span class="eyebrow">06 · Preguntas frecuentes</span>
                        <h2>Lo que suelen preguntarnos.</h2>
                    </div>
                </div>
                <div class="faq__grid">
                    <details class="q" open>
                        <summary>¿Tengo que suscribirme?</summary>
                        <p>No. Pedís la semana que querés y pausás el resto cuando quieras.</p>
                    </details>
                    <details class="q">
                        <summary>¿Cuándo cierra el pedido y cuándo llega la caja?</summary>
                        <p>Los pedidos cierran el martes a las 23:59 y la caja llega el jueves entre las 10:00 y 19:00.</p>
                    </details>
                    <details class="q">
                        <summary>¿Qué pasa si algún ingrediente no me gusta?</summary>
                        <p>Podés marcar alergias y aversiones, o reemplazar recetas dentro del menú semanal.</p>
                    </details>
                    <details class="q">
                        <summary>¿Cuánto se tarda en cocinar?</summary>
                        <p>Entre 25 y 40 minutos por receta, con instrucciones simples e ilustradas.</p>
                    </details>
                    <details class="q">
                        <summary>¿La caja es reciclable?</summary>
                        <p>Sí. Usamos cartón reciclado y materiales compatibles con una logística más limpia.</p>
                    </details>
                </div>
            </div>
        </section>

        <section class="final" id="final">
            <div class="wrap">
                <span class="eyebrow">Empezá esta semana</span>
                <h2>Tu primera caja <em>Ogape,</em> lista el jueves.</h2>
                <p>Pedidos para esta semana cierran el martes a las 23:59. Después, todos los jueves, si vos querés.</p>
                <div class="btns">
                    <a href="<?php echo esc_url( $register_url ); ?>?fresh=1" class="btn btn--primary">Unirme</a>
                    <a href="<?php echo esc_url( $waitlist_url ); ?>" class="btn btn--ghost">Lista de espera</a>
                    <a href="<?php echo esc_url( $menu_url ); ?>" class="btn btn--ghost">Ver menú</a>
                </div>
            </div>
        </section>

        <section class="future-footer">
            <div class="wrap future-footer-grid">
                <div>
                    <h4>El producto</h4>
                    <ul>
                        <li><a href="#como">Cómo funciona</a></li>
                        <li><a href="#semana">Menú de la semana</a></li>
                        <li><a href="#plan">Cajas y precios</a></li>
                        <li><a href="#zonas">Zonas de entrega</a></li>
                    </ul>
                </div>
                <div>
                    <h4>Cuenta</h4>
                    <ul>
                        <li><a href="<?php echo esc_url( $login_url ); ?>?fresh=1">Iniciar sesión</a></li>
                        <li><a href="<?php echo esc_url( $register_url ); ?>?fresh=1">Crear cuenta</a></li>
                        <li><a href="<?php echo esc_url( $account_url ); ?>?fresh=1">Mi cuenta</a></li>
                    </ul>
                </div>
                <div>
                    <h4>Soporte</h4>
                    <ul>
                        <li><a href="<?php echo esc_url( $faq_url ); ?>">FAQ</a></li>
                        <li><a href="<?php echo esc_url( $privacy_url ); ?>">Privacidad</a></li>
                        <li><a href="mailto:hola@ogape.com.py">hola@ogape.com.py</a></li>
                    </ul>
                </div>
            </div>
        </section>

        <script>
            document.querySelectorAll('.future-site-v2 .size').forEach(function (el) {
                el.addEventListener('click', function () {
                    document.querySelectorAll('.future-site-v2 .size').forEach(function (s) {
                        s.classList.remove('is-active');
                    });
                    el.classList.add('is-active');

                    var card = document.querySelector('.future-site-v2 .plan__card');
                    if (!card) {
                        return;
                    }

                    var map = {
                        '2p3': { t: 'Para 2 · 3 recetas', p: 'Gs 285.000', pp: 'Gs 47.500 por porción', n: '6 porciones' },
                        '2p5': { t: 'Para 2 · 5 recetas', p: 'Gs 445.000', pp: 'Gs 44.500 por porción', n: '10 porciones' },
                        '4p3': { t: 'Para 4 · 3 recetas', p: 'Gs 545.000', pp: 'Gs 45.500 por porción', n: '12 porciones' },
                        '4p5': { t: 'Para 4 · 5 recetas', p: 'Gs 870.000', pp: 'Gs 43.500 por porción', n: '20 porciones' }
                    }[el.dataset.size];

                    if (!map) {
                        return;
                    }

                    card.querySelector('h3').textContent = map.t;
                    card.querySelector('.amt').textContent = map.p;
                    card.querySelector('.per').textContent = '/ semana · ' + map.pp;
                    card.querySelector('.includes li').textContent = 'Ingredientes porcionados para 3 recetas (' + map.n + ')';
                });
            });
        </script>
    </div>
</main>

<?php get_footer(); ?>
