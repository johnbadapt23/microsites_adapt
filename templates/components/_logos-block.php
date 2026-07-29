<section class="logos-block">
    <div class="logo-block-outer">
        <div class="container">
            <div class="top-block">
                <div class="column one-half">
                    <span class="title">
                        <?php echo get_sub_field( 'title' ); ?>
                    </span>
                </div>
                <div class="column one-half">
                    <span class="text">
                        <?php echo get_sub_field( 'text' ); ?>
                    </span>
                    <?php if ( have_rows( 'button' ) ) : ?>
                        <span class="button-container">
                            <?php while ( have_rows( 'button' ) ) : the_row(); ?>
                                <?php if ( get_sub_field( 'button_type' ) == 'scroll-to') { ?> 
                                    <a class="std-button red-button white-before scroll-to-button" href="#<?php echo get_sub_field( 'scroll_to_id' ); ?>"><?php echo get_sub_field( 'button_text' ); ?></a> 
                                <?php } else if(get_sub_field( 'button_type' ) == 'form-popup') { ?> 
                                    <span class="form-popup-button-container std-red-button"><?php echo get_sub_field( 'form_button' ); ?></span>
                                    <span class="popup-form-container"><?php echo get_sub_field( 'form_embed' ); ?></span>
                                <?php } else if(get_sub_field( 'button_type' ) == 'hubspot-popup') { ?> 
                                    <a class="formPopupHubspot std-button red-button no-before no-margin" href="#communityformPopup"><?php echo get_sub_field( 'button_text' ); ?></a>
                                    <div style="display: none;">         
                                        <div class="preview-cta-form login-form-container" id="communityformPopup">
                                            <div class="form-container"><?php echo get_sub_field( 'hubspot_form_embed' ); ?></div>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <a class="std-button red-button no-before no-margin" href="<?php echo get_sub_field( 'link' ); ?>" target="<?php echo get_sub_field( 'link_target' ); ?>"><?php echo get_sub_field( 'button_text' ); ?></a> 
                                <?php } ?>                                                                                                                                        
                            <?php endwhile; ?>
                        </span>
                    <?php else : ?>
                        <?php // no rows found ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="logos-block">
                <span class="logos-slider">
                    <?php if ( have_rows( 'logos' ) ) : ?>
        				<?php while ( have_rows( 'logos' ) ) : the_row(); ?>
        					<?php $logo = get_sub_field( 'logo' ); ?>
                            <?php if ( get_sub_field( 'link' )) { ?>
                                <a href="<?php echo get_sub_field( 'link' ); ?>" target="_blank">
                            <?php } ?>
                                <span class="slide">
                					<?php if ( $logo ) { ?>
                						<img class="logo" src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>" loading="lazy"/>
                					<?php } ?>
                                </span>
                            <?php if ( get_sub_field( 'link' )) { ?>
                                </a>
                            <?php } ?>
        				<?php endwhile; ?>
        			<?php else : ?>
        				<?php // no rows found ?>
        			<?php endif; ?>
                </span>
            </div>
        </div>
    </div>
</section>
