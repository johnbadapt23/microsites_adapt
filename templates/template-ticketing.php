<?php
/**
 * Template Name: Ticketing Template
 */

get_header();

?>

<main class="page flexible ticketing" id="main">
    <?php if ( have_rows( 'content' ) ): ?>
        <?php while ( have_rows( 'content' ) ) : the_row(); ?>
            <?php if ( get_row_layout() == 'ticketing_block' ) : ?>
                <?php get_template_part( 'templates/components/_ticketing-block' ); ?> 
            <?php elseif ( get_row_layout() == 'faqs' ) : ?>
                <?php get_template_part( 'templates/components/_ticketing-faqs' ); ?> 
            <?php elseif ( get_row_layout() == 'infinite_image_carousel' ) : ?>
                <?php get_template_part( 'templates/components/_infinite-images' ); ?> 
            <?php elseif ( get_row_layout() == 'three_column_icon_and_text' ) : ?>
                <?php get_template_part( 'templates/components/_ticketing-three-column-icon-text' ); ?> 
            <?php elseif ( get_row_layout() == 'three_column_number_and_text' ) : ?>
                <?php get_template_part( 'templates/components/_ticketing-three-column-number-text' ); ?> 
            <?php elseif ( get_row_layout() == 'two_column_icon_text' ) : ?>
                <?php get_template_part( 'templates/components/_ticketing-two-column-icon-text' ); ?>
            <?php endif; ?>
        <?php endwhile; ?>
    <?php else: ?>
        <?php // no layouts found ?>
    <?php endif; ?>
</main>
<?php get_footer(); ?>
