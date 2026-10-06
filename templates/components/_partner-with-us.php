<section class="partner-with-us-block" <?php if (get_sub_field('id')) { ?>id="<?php echo esc_attr( get_sub_field('id') );?>"<?php } ?>>
    <div class="block-container">
        <div class="container">
            <div class="column one-half text-column">
                <span class="text-container">
                    <h2><?php echo get_sub_field( 'title' ); ?></h2>
                    <span class="text"><?php echo get_sub_field( 'text' ); ?></span>
                    <?php if ( have_rows( 'button' ) ) : ?>
	                    <?php while ( have_rows( 'button' ) ) : the_row(); ?>
                            <span class="button-container">
                                <?php if ( get_sub_field( 'button_type' ) == 'register-link') { ?>
                                    <a class="std-button white-button register-button" href="#register"><?php echo get_sub_field( 'button_text' ); ?></a>
                                <?php } else if ( get_sub_field( 'button_type' ) == 'form'){ ?>
                                    <a class="std-button white-button form-popup-button" href="#partnerForm"><?php echo get_sub_field( 'button_text' ); ?></a>
                                    <span style="display: none;">
                                        <div class="popupBlockOuter" id="partnerForm">
                            		        <div class="requestFormContainer">
                            					<div class="container">
                            						<div class="form-container">
                            							<?php echo get_sub_field('form_embed'); ?>
                            						</div>
                            					</div>
                            				</div>
                            			</div>
                                    </span>
                                <?php } else if ( get_sub_field( 'button_type' ) == 'formcraft'){ ?>
                                    <span class="form-popup-button-container std-button white-button"><?php echo get_sub_field( 'formcrafts_button' ); ?></span>
                                    <span class="form-popup-embed"><?php echo get_sub_field( 'form_embed_formcrafts' ); ?></span>
                                <?php } else { ?>
                                    <a class="std-button white-button" href="<?php echo esc_attr( get_sub_field( 'link' ) ); ?>" target="<?php echo esc_attr( get_sub_field( 'link_target' ) ); ?>"><?php echo get_sub_field( 'button_text' ); ?></a>
                                <?php } ?>
                            </span>
                        <?php endwhile; ?>
        			<?php else : ?>
        				<?php // no rows found ?>
        			<?php endif; ?>                    
                </span>
            </div>
            <div class="column one-half image-column">
                <?php $image = get_sub_field( 'image' ); ?>
    			<?php if ( $image ) { ?>
                    <span class="image-container">
                        <span class="bg-container">
                            <img src="<?php echo esc_attr( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" loading="lazy"/>
                        </span>
                    </span>
    			<?php } ?>
            </div>
        </div>
    </div>
</section>
