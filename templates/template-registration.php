<?php
/**
 * Template Name: Registration Template
 */

get_header();

?>

<main class="page flexible registration form-page" id="main">

    <section class="register-header">
        <div class="container">
            <?php $footer_icon = get_field( 'footer_icon', 'options'  ); ?>
            <?php if ( $footer_icon ) { ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <img class="logo" src="<?php echo $footer_icon['url']; ?>" alt="<?php echo $footer_icon['alt']; ?>" width="115"/>
                </a>
            <?php } ?>
        </div>
    </section>
    <section class="form-section registration-form-section">
        <div class="container">
            <div class="form-inner">
                <span class="icon-container">
                    <?php $icon = get_field( 'icon' ); ?>
                    <?php if ( $icon ) { ?>
                    	<img src="<?php echo $icon['url']; ?>" alt="<?php echo $icon['alt']; ?>" />
                    <?php } ?>
                </span>
                <span class="pre-title text-red"><?php echo get_field( 'registration_form_pre_title' ); ?></span>
                <h2 class="form-title"><?php echo get_field( 'registration_form_title' ); ?></h2>
                <div class="form-container">
                    <?php echo get_field( 'registration_form_embed' ); ?>
                </div>
            </div>
            <div class="after-form-text">
                <div class="text-inner">
                    <h3><?php echo get_field( 'after_form_title' ); ?></h3>
                    <span class="text-container">
                        <?php echo get_field( 'after_form_text' ); ?>
                    </span>
                </div>
            </div>
        </div>
    </section>
</main>
<?php get_footer(); ?>
