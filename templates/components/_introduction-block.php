<section class="introduction-block">    
    <div class="container">
        <div class="column-container">
        <?php
                $date_string = get_sub_field( 'date');
                $date = DateTime::createFromFormat('Ymd', $date_string);
            ?>
            <div class="text-container text-column one-half">

                <span class="information">
                    <span class="date"><?php echo $date->format('j F, Y'); ?> | </span>
                    <span class="location"><?php echo get_sub_field( 'location' ); ?></span>
                </span>
                <h1><?php echo get_sub_field( 'title' ); ?></h1>
                <span class="text"><?php echo get_sub_field( 'text' ); ?></span>
                <span class="button-container">
                    <?php if( get_sub_field( 'register_button_text' )) { ?>
                        <a class="std-button red-button white-before register-button" href="#register"><?php echo get_sub_field( 'register_button_text' ); ?></a>
                    <?php } ?>
                    <?php if ( have_rows( 'secondary_button' ) ) : ?>
                        <?php while ( have_rows( 'secondary_button' ) ) : the_row(); ?>
                            <?php if ( get_sub_field( 'button_type' ) == 'form'){ ?>
                                <a class="text-link red-text large-link-text red-underline-link register-button" href="#secondForm"><?php echo get_sub_field( 'button_text' ); ?></a>
                                <span style="display: none;">
                                    <div class="popupBlockOuter" id="secondForm">
                                        <div class="requestFormContainer">
                                            <div class="container">
                                                <div class="form-container">
                                                    <?php echo get_sub_field('form_embed'); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </span>
                            <?php } else { ?>
                                <a class="text-link red-text large-link-text red-underline-link" href="<?php echo get_sub_field( 'link' ); ?>" target="<?php echo get_sub_field( 'link_target' ); ?>"><?php echo get_sub_field( 'button_text' ); ?><a/>
                            <?php } ?>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <?php // no rows found ?>
                    <?php endif; ?>                       
                </span>
                <?php if ( have_rows( 'tertiary_link' ) ) : ?>
                    <span class="bottom-text">
                        <?php while ( have_rows( 'tertiary_link' ) ) : the_row(); ?>
                            <span class="text arrow-icon white-text"><?php echo get_sub_field( 'pre_link_text' ); ?></span>
                            <span class="text-link-container">
                                <a class="text-link red-text large-link-text red-underline-link" href="<?php echo get_sub_field( 'link' ); ?>" target="<?php echo get_sub_field( 'link_target' ); ?>"><?php echo get_sub_field( 'link_text' ); ?></a>
                            </span>
                        <?php endwhile; ?>
                    </span>
                <?php else : ?>
                    <?php // no rows found ?>
                <?php endif; ?>
            </div>
            <div class="image-column column one-half">
                <div class="image-container">
                    <div class="bg-container">
                        <?php if( get_sub_field( 'vimeo_code' )) { ?>
                            <a class="replay-button popup-vimeo mobile" href="https://vimeo.com/<?php echo get_sub_field('vimeo_code'); ?>">
                        <?php } ?>
                        <?php $image = get_sub_field('image'); ?>
                        <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" loading="lazy"/>
                        <?php if( get_sub_field( 'vimeo_code' )) { ?>                            
                            <span class="play-button"></span>
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
