<?php
/**
 * Blog page content.
 *
 * @var array $args Template args.
 */

$home_url     = $args['home_url'] ?? home_url( '/' );
$plans_url    = $args['plans_url'] ?? home_url( '/planes/' );
$menu_url     = $args['menu_url'] ?? home_url( '/menu/' );
$waitlist_url = $args['waitlist_url'] ?? home_url( '/waitlist/' );

$featured_story = array(
    'eyebrow' => 'Nota destacada',
    'title'   => 'La nueva rutina de entresemana: cocinar rico sin improvisar a las ocho de la noche.',
    'copy'    => 'Cuando el día viene cargado, el problema no es cocinar: es decidir, comprar y medir. En Ogape estamos diseñando una experiencia para que la cocina vuelva a ser un momento claro, breve y satisfactorio.',
    'points'  => array(
        'Planificación semanal para bajar la fricción antes de abrir la heladera.',
        'Ingredientes porcionados para que el tiempo se vaya en cocinar, no en calcular.',
        'Recetas pensadas para funcionar en una cocina real de Asunción.',
    ),
);

$stories = array(
    array(
        'id'       => 'rituales',
        'category' => 'Cocina diaria',
        'title'    => 'Tres rituales simples para que cocinar entre semana no se sienta como otra tarea.',
        'excerpt'  => 'Una mise en place mínima, una sartén confiable y veinte minutos sin notificaciones pueden cambiar por completo la experiencia.',
        'meta'     => '5 min de lectura',
        'image'    => get_stylesheet_directory_uri() . '/assets/img/hero-drive/linguini-con-camaron.jpg',
    ),
    array(
        'id'       => 'origen',
        'category' => 'Producto',
        'title'    => 'Qué significa para nosotros cocinar con criterio local desde Asunción.',
        'excerpt'  => 'No se trata solo de proximidad. Se trata de elegir ingredientes, tiempos y recetas que tengan sentido para la ciudad donde entregamos.',
        'meta'     => '4 min de lectura',
        'image'    => get_stylesheet_directory_uri() . '/assets/img/hero-drive/ensalada-de-salmon.jpg',
    ),
    array(
        'id'       => 'temporada',
        'category' => 'Menú editorial',
        'title'    => 'Cómo pensamos un menú semanal que se vea cuidado antes de llegar a tu cocina.',
        'excerpt'  => 'Editamos la semana como se edita una carta: equilibrio, contraste, una sorpresa y cero platos puestos solo para llenar espacio.',
        'meta'     => '6 min de lectura',
        'image'    => get_stylesheet_directory_uri() . '/assets/img/hero-drive/cazuela-de-tilapia.jpg',
    ),
);

$briefs = array(
    array(
        'label' => 'Ahora probando',
        'copy'  => 'Textos de receta más claros, con pasos breves y vocabulario menos técnico.',
    ),
    array(
        'label' => 'En cocina',
        'copy'  => 'Nuevas combinaciones de platos para semanas con más variedad sin subir la complejidad.',
    ),
    array(
        'label' => 'Próxima nota',
        'copy'  => 'Cómo armamos una caja que protege producto, presenta bien y desperdicia menos.',
    ),
);
?>

<main id="main" class="site-main blog-design" role="main">
    <section class="blog-hero">
        <div class="container">
            <div class="blog-hero__crumb">
                <a href="<?php echo esc_url( $home_url ); ?>">Inicio</a>
                <span>/</span>
                <span>Blog</span>
            </div>

            <div class="blog-hero__layout">
                <div class="blog-hero__copy">
                    <span class="blog-hero__eyebrow">Diario Ogape</span>
                    <h1>Ideas, cocina y decisiones de marca contadas desde adentro.</h1>
                    <p>
                        Este espacio nos sirve para compartir cómo pensamos Ogape:
                        desde la rutina de cocinar mejor en casa hasta la manera en que
                        elegimos menús, ingredientes y una experiencia más simple para la semana.
                    </p>
                    <div class="blog-hero__actions">
                        <a href="<?php echo esc_url( $menu_url ); ?>" class="btn btn--primary">Ver menú de la semana</a>
                        <a href="<?php echo esc_url( $plans_url ); ?>" class="btn btn--ghost">Explorar planes</a>
                    </div>
                </div>

                <aside class="blog-hero__note glass-card" aria-label="Qué vas a encontrar en el blog">
                    <span class="blog-mini-label">Qué vas a encontrar</span>
                    <ul class="blog-hero__list">
                        <li>Notas sobre cocina cotidiana y vida real.</li>
                        <li>Detalles del detrás de escena del piloto.</li>
                        <li>Criterio editorial para armar menús y cajas.</li>
                    </ul>
                </aside>
            </div>
        </div>
    </section>

    <section class="blog-featured">
        <div class="container">
            <article class="blog-featured__card">
                <div class="blog-featured__copy">
                    <span class="blog-mini-label"><?php echo esc_html( $featured_story['eyebrow'] ); ?></span>
                    <h2><?php echo esc_html( $featured_story['title'] ); ?></h2>
                    <p><?php echo esc_html( $featured_story['copy'] ); ?></p>
                    <ul class="blog-featured__points">
                        <?php foreach ( $featured_story['points'] as $point ) : ?>
                            <li><?php echo esc_html( $point ); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="blog-featured__quote">
                    <p>
                        “Queremos que abrir una caja Ogape se sienta como recibir una semana
                        ya más ordenada.”
                    </p>
                </div>
            </article>
        </div>
    </section>

    <section class="blog-stories">
        <div class="container">
            <div class="blog-section-head">
                <span class="blog-mini-label">Para empezar</span>
                <h2>Tres notas para abrir el blog con una voz clara.</h2>
            </div>

            <div class="blog-stories__grid">
                <?php foreach ( $stories as $story ) : ?>
                    <article class="blog-story-card glass-card">
                        <img
                            src="<?php echo esc_url( $story['image'] ); ?>"
                            alt="<?php echo esc_attr( $story['title'] ); ?>"
                            class="blog-story-card__image"
                            loading="lazy"
                            decoding="async"
                        >
                        <div class="blog-story-card__body">
                            <div class="blog-story-card__meta">
                                <span><?php echo esc_html( $story['category'] ); ?></span>
                                <span><?php echo esc_html( $story['meta'] ); ?></span>
                            </div>
                            <h3><?php echo esc_html( $story['title'] ); ?></h3>
                            <p><?php echo esc_html( $story['excerpt'] ); ?></p>
                            <a href="#<?php echo esc_attr( $story['id'] ); ?>" class="blog-story-card__link">Leer adelanto</a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="blog-articles">
        <div class="container">
            <div class="blog-article-list">
                <article id="rituales" class="blog-article glass-card">
                    <span class="blog-mini-label">Cocina diaria</span>
                    <h2>Tres rituales simples para llegar a la cena con menos ruido.</h2>
                    <p>
                        Cocinar mejor entre semana no siempre requiere más técnica. A veces
                        alcanza con repetir tres pequeños gestos: dejar una superficie libre,
                        elegir una receta antes de que empiece el hambre y tener una sartén
                        que ya conocés. Ese tipo de claridad es la que queremos diseñar.
                    </p>
                    <p>
                        Ogape nace alrededor de esa idea: que la decisión pesada ocurra antes,
                        para que el momento de cocinar se sienta liviano. Menos pestañas
                        abiertas. Menos delivery por agotamiento. Más ritmo propio.
                    </p>
                </article>

                <article id="origen" class="blog-article glass-card">
                    <span class="blog-mini-label">Producto</span>
                    <h2>Cocinar con criterio local también es una decisión de experiencia.</h2>
                    <p>
                        Hablar de producto local no es solo hablar de cercanía geográfica.
                        También es diseñar para el clima, los tiempos, la logística y la forma
                        en que realmente se cocina en Asunción. Eso afecta qué platos entran al
                        menú, cómo se porcionan y cuánto margen dejamos para que todo llegue bien.
                    </p>
                    <p>
                        Nuestro objetivo no es parecer global. Es construir una propuesta que
                        se sienta profundamente ubicada: contemporánea, sí, pero hecha para acá.
                    </p>
                </article>

                <article id="temporada" class="blog-article glass-card">
                    <span class="blog-mini-label">Menú editorial</span>
                    <h2>Editar una semana también es una forma de cocinar.</h2>
                    <p>
                        Un buen menú no es una colección aleatoria de recetas. Tiene contraste,
                        descanso, una pieza más fresca, otra más reconfortante y un nivel de
                        dificultad parejo. Lo pensamos como una edición: qué entra, qué queda
                        afuera y cómo se siente el conjunto cuando alguien mira sus opciones.
                    </p>
                    <p>
                        Este blog también va a mostrar eso: no solo el plato terminado, sino
                        la lógica que hace que una semana Ogape se sienta coherente.
                    </p>
                </article>
            </div>
        </div>
    </section>

    <section class="blog-briefs">
        <div class="container">
            <div class="blog-section-head">
                <span class="blog-mini-label">Notas breves</span>
                <h2>Pequeñas señales de lo que vamos construyendo.</h2>
            </div>

            <div class="blog-briefs__grid">
                <?php foreach ( $briefs as $brief ) : ?>
                    <article class="blog-brief glass-card">
                        <span><?php echo esc_html( $brief['label'] ); ?></span>
                        <p><?php echo esc_html( $brief['copy'] ); ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="blog-cta">
        <div class="container">
            <div class="blog-cta__card">
                <div>
                    <span class="blog-mini-label">Seguí de cerca el piloto</span>
                    <h2>Mientras el blog crece, la lista de espera sigue abierta.</h2>
                    <p>
                        Si querés enterarte cuando Ogape llegue a tu zona o cuando publiquemos
                        nuevas semanas, sumate y te escribimos.
                    </p>
                </div>
                <div class="blog-cta__actions">
                    <a href="<?php echo esc_url( $waitlist_url ); ?>" class="btn btn--primary">Unirme a la lista</a>
                    <a href="<?php echo esc_url( $menu_url ); ?>" class="btn btn--secondary">Ver menú</a>
                </div>
            </div>
        </div>
    </section>
</main>
