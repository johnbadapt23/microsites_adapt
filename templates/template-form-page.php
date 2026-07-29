<?php
/**
 * Template Name: Contact Template
 */

get_header();

?>

<main class="page flexible form-page" id="main">
    <section class="form-section">
        <div class="container">
            <div class="form-inner">
                <h2 class="form-title"><?php the_field( 'contact_form_title' ); ?></h2>
                <div class="form-container">
                    <?php echo get_field( 'contact_form_embed' ); ?>
                </div>
            </div>
        </div>
    </section>
</main>
<?php get_footer(); ?>
