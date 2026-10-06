<?php
/**
 * Template Name: Agenda Template
 */

get_header();

?>

<main class="page flexible agenda" id="main">
    <?php if( get_field( 'number_of_days' ) == 'one') { ?>
        <section class="agenda-title one-day">
            <?php
                $date_string = get_field( 'date');
            //     $date = DateTime::createFromFormat('Ymd', $date_string);
            // ?>
            <?php
                $heading = 'Agenda'; // default

                if ($date_string) {
                    $date = DateTime::createFromFormat('Ymd', $date_string);
                    $today = new DateTime('today', new DateTimeZone('Australia/Sydney')); // optional: use your timezone

                    if ($date < $today) {
                        $heading = 'Past Agenda';
                    }
                }
                ?>
            <div class="container">
                <h1 class="agenda-title">
                    <?php if(get_field('title')){ ?> 
                        <?php $heading = get_field('title'); ?>
                    <?php } ?>
                    <?php echo esc_html($heading); ?>
                </h1>
                <?php if ($date) { ?>
                    <h2 class="sub-title"><?php echo $date->format('l, j F Y'); ?></h2>
                <?php } ?>
                <?php if(get_field('subtext')){ ?>
                    <span class="sub-text-container"><?php the_field('subtext'); ?></span>
                <?php } ?>
                 <?php if ( have_rows( 'button' ) ) : ?>
                    <span class="button-container" style="display: flex; width: 100%; justify-content: flex-start">
                        <?php while ( have_rows( 'button' ) ) : the_row(); ?>
                            <?php if ( get_sub_field( 'button_type' ) == 'scroll-to') { ?> 
                                <a class="std-button red-button no-before no-margin scroll-to-button" href="#<?php echo esc_attr( get_sub_field( 'scroll_to_id' ) ); ?>"><?php echo get_sub_field( 'button_text' ); ?></a> 
                            <?php } else if(get_sub_field( 'button_type' ) == 'form-popup') { ?> 
                                <span class="form-popup-button-container std-button red-button no-before no-margin"><?php echo get_sub_field( 'form_button' ); ?></span>
                                <span class="popup-form-container"><?php echo get_sub_field( 'form_embed' ); ?></span>
                            <?php } else if(get_sub_field( 'button_type' ) == 'hubspot-popup') { ?> 
                                <a class="formPopupHubspot std-button red-button no-before no-margin" href="#communityformPopup"><?php echo get_sub_field( 'button_text' ); ?></a>
                                <div style="display: none;">         
                                    <div class="preview-cta-form login-form-container" id="communityformPopup">
                                        <div class="form-container"><?php echo get_sub_field( 'hubspot_form_embed' ); ?></div>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <a class="std-button red-button no-before no-margin" href="<?php echo esc_attr( get_sub_field( 'link' ) ); ?>" target="<?php echo esc_attr( get_sub_field( 'link_target' ) ); ?>"><?php echo get_sub_field( 'button_text' ); ?></a> 
                            <?php } ?>                                                                                                                                        
                        <?php endwhile; ?>
                    </span>
                <?php else : ?>
                    <?php // no rows found ?>
                <?php endif; ?>
            </div>
        </section>
        <?php if ( have_rows( 'content' ) ): ?>
            <?php while ( have_rows( 'content' ) ) : the_row(); ?>
                <?php if ( get_row_layout() == 'agenda_item_house_keeping' ) : ?>
                    <?php get_template_part( 'templates/components/_agenda-house-keeping' ); ?>
                <?php elseif ( get_row_layout() == 'agenda_item' ) : ?>
                    <?php get_template_part( 'templates/components/_agenda-item' ); ?>
                <?php elseif ( get_row_layout() == 'agenda_item_roundtable' ) : ?>
                    <?php get_template_part( 'templates/components/_agenda-item-roundtable' ); ?>
                <?php endif; ?>
            <?php endwhile; ?>
        <?php else: ?>
            <?php // no layouts found ?>
        <?php endif; ?>
    <?php } else { ?>
        <?php if ( have_rows( 'agenda_day' ) ) : ?>
            <section class="agenda-title multi-day">
                <div class="container">
                    <h1 class="agenda-title">Agenda</h1>
                </div>
                <div class="day-switcher-outside">
                    <div class="day-switcher-container">
                        <div class="day-switcher-inside">
                            <div class="container">
                                <?php $dayCounter = 1; ?>
                            	<?php while ( have_rows( 'agenda_day' ) ) : the_row(); ?>
                                    <?php
                                        $date_string = get_sub_field( 'date');
                                        $date = DateTime::createFromFormat('Ymd', $date_string);
                                    ?>
                                    <a class="agenda-days-switcher<?php if ($dayCounter == 1){ ?> active<?php } ?>" href="#<?php echo esc_attr( get_sub_field( 'date') );?>"><?php echo $date->format('l, j F Y'); ?></a>
                                    <?php $dayCounter++; ?>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php else : ?>
            <?php // no rows found ?>
        <?php endif; ?>
        <?php if ( have_rows( 'agenda_day' ) ) : ?>
            <?php $dayMainCounter = 1; ?>
        	<?php while ( have_rows( 'agenda_day' ) ) : the_row(); ?>
                <div class="agenda-day<?php if ($dayMainCounter == 1){ ?> active<?php } ?>" id="<?php echo esc_attr( get_sub_field( 'date') );?>">
            		<?php if ( have_rows( 'agenda_content' ) ): ?>
            			<?php while ( have_rows( 'agenda_content' ) ) : the_row(); ?>
            				<?php if ( get_row_layout() == 'agenda_item_house_keeping' ) : ?>
            					<?php get_template_part( 'templates/components/_agenda-house-keeping' ); ?>
            				<?php elseif ( get_row_layout() == 'agenda_item' ) : ?>
                                <?php get_template_part( 'templates/components/_agenda-item' ); ?>
                            <?php elseif ( get_row_layout() == 'agenda_item_roundtable' ) : ?>
                                <?php get_template_part( 'templates/components/_agenda-item-roundtable' ); ?>
                            <?php elseif ( get_row_layout() == 'cta_button_module' ) : ?>
                                <?php get_template_part( 'templates/components/_cta-block' ); ?>
            				<?php endif; ?>
            			<?php endwhile; ?>
            		<?php else: ?>
            			<?php // no layouts found ?>
            		<?php endif; ?>
                </div>
                <?php $dayMainCounter++; ?>
        	<?php endwhile; ?>
        <?php else : ?>
        	<?php // no rows found ?>
        <?php endif; ?>
    <?php }?>

</main>
<?php get_footer(); ?>
