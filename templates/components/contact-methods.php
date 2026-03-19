<?php
/**
 * Contact Methods component
 *
 * Usage: get_template_part( 'templates/components/contact-methods', null, [ 'methods' => [] ] );
 */

$methods = $args['methods'] ?? array();

if ( empty( $methods ) ) {
    return;
}
?>
<div class="contact-methods">
    <?php foreach ( $methods as $method ) : ?>
        <article class="contact-methods__item glass-card">
            <?php if ( ! empty( $method['eyebrow'] ) ) : ?>
                <p class="contact-methods__eyebrow"><?php echo esc_html( $method['eyebrow'] ); ?></p>
            <?php endif; ?>

            <?php if ( ! empty( $method['title'] ) ) : ?>
                <h3 class="contact-methods__title"><?php echo esc_html( $method['title'] ); ?></h3>
            <?php endif; ?>

            <?php if ( ! empty( $method['body'] ) ) : ?>
                <p class="contact-methods__body"><?php echo esc_html( $method['body'] ); ?></p>
            <?php endif; ?>

            <?php if ( ! empty( $method['url'] ) && ! empty( $method['label'] ) ) : ?>
                <a class="contact-methods__link" href="<?php echo esc_url( $method['url'] ); ?>"<?php echo ! empty( $method['external'] ) ? ' target="_blank" rel="noopener noreferrer"' : ''; ?>>
                    <?php echo esc_html( $method['label'] ); ?>
                </a>
            <?php endif; ?>
        </article>
    <?php endforeach; ?>
</div>
