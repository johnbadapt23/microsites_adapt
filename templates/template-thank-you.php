<?php
/**
 * Template Name: Thank You Template
 */

get_header();

?>

<main class="page flexible thank-you-page" id="main">
    <?php if ( have_rows( 'content_blocks' ) ): ?>
	<?php while ( have_rows( 'content_blocks' ) ) : the_row(); ?>
		<?php if ( get_row_layout() == 'thank_you_banner' ) : ?>
            <?php get_template_part( 'templates/components/_thank-you-banner' ); ?>
		<?php elseif ( get_row_layout() == 'download_module' ) : ?>
            <?php get_template_part( 'templates/components/_download-module' ); ?>
		<?php elseif ( get_row_layout() == 'steps_block' ) : ?>
            <?php get_template_part( 'templates/components/_steps-module' ); ?>
		<?php elseif ( get_row_layout() == 'faq_block' ) : ?>
			<?php get_template_part( 'templates/components/_faq-block' ); ?>
        <?php elseif ( get_row_layout() == 'text_module' ) : ?>
            <?php get_template_part( 'templates/components/_thank-you-text' ); ?>
		<?php endif; ?>
	<?php endwhile; ?>
<?php else: ?>
	<?php // no layouts found ?>
<?php endif; ?>
</main>
<?php get_footer(); ?>
