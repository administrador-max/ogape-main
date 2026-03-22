<?php
/**
 * Features Component — 3 key benefits
 * Per Website-Component-Library.docx — use 3 or 6 items only.
 */
$features = [
  [ 'icon' => 'M12 20h9M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4L16.5 3.5z', 'title' => 'Diseñados por chefs', 'desc' => 'Cada kit nace desde una lógica de chef: recetas mejor pensadas, combinaciones más cuidadas y una experiencia de cocina en casa que se siente elevada de verdad.' ],
  [ 'icon' => 'M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5', 'title' => 'Inspiración paraguaya', 'desc' => 'La propuesta parte de Paraguay: ingredientes, sabores y criterio local interpretados con una mirada premium, contemporánea y lista para la mesa de todos los días.' ],
  [ 'icon' => 'M13 2L3 14h9l-1 8 10-12h-9l1-8z', 'title' => 'Más simple de principio a fin', 'desc' => 'Menos fricción, menos improvisación y más claridad: kits listos para cocinar en casa con una experiencia práctica, cuidada y convincente de punta a punta.' ],
];
?>
<section class="features" id="features">
  <div class="container">
    <div class="features__header">
      <p class="features__eyebrow">La dirección aprobada</p>
      <h2 class="features__title">Chef primero. Paraguay en el centro. Simplicidad que convierte.</h2>
      <p class="features__intro">Ogape no es delivery abierto ni una carta activa hoy: es un lanzamiento piloto de meal kits para cocinar en casa, con foco en calidad, identidad y una experiencia más limpia desde el primer clic.</p>
    </div>
    <div class="features__grid">
      <?php foreach ($features as $f) : ?>
      <div class="features__card glass-card">
        <div class="features__icon">
          <svg viewBox="0 0 24 24" width="48" height="48" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="<?php echo esc_attr($f['icon']); ?>"/>
          </svg>
        </div>
        <h3 class="features__card-title"><?php echo esc_html($f['title']); ?></h3>
        <p class="features__card-desc"><?php echo esc_html($f['desc']); ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
