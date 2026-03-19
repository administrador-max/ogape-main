<?php
/**
 * Tag Row partial
 * Usage: get_template_part('templates/components/tag-row', null, ['tags' => $tags_array]);
 * Each tag: ['label' => 'Hero Dish', 'type' => 'hero'] — type: hero|local|nomad|intl
 */

$tags = $args['tags'] ?? [];

if ( empty( $tags ) ) {
    return;
}
?>
<div class="tag-row" role="list">
  <?php foreach ( $tags as $tag ) : ?>
    <?php
    $type  = esc_attr( $tag['type'] ?? 'local' );
    $label = esc_html( $tag['label'] ?? '' );
    ?>
    <span class="tag tag--<?php echo $type; ?>" role="listitem"><?php echo $label; ?></span>
  <?php endforeach; ?>
</div>
