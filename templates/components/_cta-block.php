<section class="cta-button-block" style="padding: 35px 0;">
    <div class="container">
        <?php if ( have_rows( 'button' ) ) : ?>
            <span class="button-container" style="display: flex; width: 100%; justify-content: center;">
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

