<?php
/**
 * Template Name: Partner Template
 */

get_header();

?>

<main class="page event-listing" id="main">
    <?php if ( have_rows( 'content_blocks' ) ): ?>
	<?php while ( have_rows( 'content_blocks' ) ) : the_row(); ?>
		<?php if ( get_row_layout() == 'title_block_background' ) : ?>
            <?php get_template_part( 'templates/event-components/_title-block-background' ); ?>
        <?php elseif ( get_row_layout() == 'video_block' ) : ?>
            <?php get_template_part( 'templates/event-components/_video-block' ); ?>
        <?php elseif ( get_row_layout() == 'logos_text_block' ) : ?>
            <?php get_template_part( 'templates/event-components/_logos-text-block' ); ?>
        <?php elseif ( get_row_layout() == 'cards' ) : ?>
            <?php get_template_part( 'templates/event-components/_partner-cards' ); ?>
        <?php elseif ( get_row_layout() == 'vendors' ) : ?>
            <?php get_template_part( 'templates/event-components/_vendors' ); ?>
        <?php elseif ( get_row_layout() == 'quote_slide_block' ) : ?>
            <?php get_template_part( 'templates/components/_quote-slider-block' ); ?>
        <?php elseif ( get_row_layout() == 'partner_with_us_block' ) : ?>
            <?php get_template_part( 'templates/components/_partner-with-us' ); ?>
        <?php elseif ( get_row_layout() == 'sneak_peak_block' ) : ?>
            <?php get_template_part( 'templates/components/_sneak-peak' ); ?>
        <?php elseif ( get_row_layout() == 'new_quote_slider' ) : ?>
            <?php get_template_part( 'templates/components/_new-quote-slider' ); ?>
        <?php elseif ( get_row_layout() == 'three_column_icon_text' ) : ?>
            <?php get_template_part( 'templates/components/_three-column-icon-text' ); ?>
        <?php elseif ( get_row_layout() == 'two_column_animation_and_icons' ) : ?>
            <?php get_template_part( 'templates/components/_two-column-animation' ); ?>
        <?php elseif ( get_row_layout() == 'form_block' ) : ?>
            <?php get_template_part( 'templates/components/_form-block' ); ?>
        <?php elseif ( get_row_layout() == 'two_column_text' ) : ?>
            <?php get_template_part( 'templates/components/_two-column-text' ); ?>
		<?php endif; ?>
	<?php endwhile; ?>
<?php else: ?>
	<?php // no layouts found ?>
<?php endif; ?>
</main>
<?php get_footer(); ?>
