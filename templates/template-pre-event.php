<?php
/**
 * Template Name: Pre Event Template
 */

get_header();

?>

<?php $registerEmbed = get_field( 'register_form_embed' ); ?>

<main class="page flexible" id="main">
    <?php if ( have_rows( 'content_blocks' ) ): ?>
	<?php while ( have_rows( 'content_blocks' ) ) : the_row(); ?>
		<?php if ( get_row_layout() == 'introduction_block' ) : ?>
            <?php get_template_part( 'templates/components/_introduction-block' ); ?>
        <?php elseif ( get_row_layout() == 'title_background_image_block' ) : ?>
            <?php get_template_part( 'templates/components/_title-background-block' ); ?>
        <?php elseif ( get_row_layout() == 'speakers_block' ) : ?>
            <?php get_template_part( 'templates/components/_speakers-block' ); ?>
        <?php elseif ( get_row_layout() == 'logo_block' ) : ?>
            <?php get_template_part( 'templates/components/_logos-block' ); ?>
        <?php elseif ( get_row_layout() == 'two_column_two_image_and_text' ) : ?>
            <?php get_template_part( 'templates/components/_two-column-two-image-block' ); ?>
        <?php elseif ( get_row_layout() == 'four_column_image_and_icon' ) : ?>
            <?php get_template_part( 'templates/components/_four-column-block' ); ?>
        <?php elseif ( get_row_layout() == 'content_slider_block' ) : ?>
            <?php get_template_part( 'templates/components/_content-slider-block' ); ?>
        <?php elseif ( get_row_layout() == 'quote_slide_block' ) : ?>
            <?php get_template_part( 'templates/components/_quote-slider-block' ); ?>
        <?php elseif ( get_row_layout() == 'partners_block' ) : ?>
            <?php get_template_part( 'templates/components/_partners-block' ); ?>
        <?php elseif ( get_row_layout() == 'location_block' ) : ?>
            <?php get_template_part( 'templates/components/_location-block' ); ?>
        <?php elseif ( get_row_layout() == 'two_column_about_block' ) : ?>
            <?php get_template_part( 'templates/components/_about-block' ); ?>
        <?php elseif ( get_row_layout() == 'faq_block' ) : ?>
            <?php get_template_part( 'templates/components/_faq-block' ); ?>
        <?php elseif ( get_row_layout() == 'partner_with_us_block' ) : ?>
            <?php get_template_part( 'templates/components/_partner-with-us' ); ?>
		<?php endif; ?>
	<?php endwhile; ?>
<?php else: ?>
	<?php // no layouts found ?>
<?php endif; ?>
</main>
<?php get_footer(); ?>
