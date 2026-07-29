<section class="community-block background-black landing-community" <?php if(get_sub_field('id')){ ?> id="<?php echo get_sub_field('id'); ?>"<?php } ?>>
    <div class="container">
        <div class="top-container">
            <div class="title-column">
                <h2 class="text-white"><?php echo get_sub_field( 'title' ); ?></h2>
                <span class="text text-white p-large"><?php echo get_sub_field( 'text' ); ?></span>  
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
                                <a class="std-button red-button white-before" href="<?php echo get_sub_field( 'link' ); ?>" target="<?php echo get_sub_field( 'link_target' ); ?>"><?php echo get_sub_field( 'button_text' ); ?></a> 
                            <?php } ?>                                                                                                                                        
                        <?php endwhile; ?>
                    </span>
                <?php else : ?>
                    <?php // no rows found ?>
                <?php endif; ?>                             
            </div>
        </div>
        <div class="bottom-container column-container">
            <div class="one-third column image-column large-column first-column" data-aos="fade-up" data-aos-anchor-placement="center-bottom" data-aos-duration="800">
                <span class="image-large">
                    <?php $column_one_image_one = get_sub_field( 'column_one_image' ); ?>
                    <?php if ( $column_one_image_one ) { ?>
                    	<img src="<?php echo $column_one_image_one['url']; ?>" alt="<?php echo $column_one_image_one['alt']; ?>" />
                    <?php } ?>
                </span>               
            </div>
            <div class="one-third column image-column two-image-column" >
                <span class="image-one" data-aos="fade-up" data-aos-anchor-placement="center-bottom" data-aos-duration="800" data-aos-delay="400">
                    <?php $column_two_image = get_sub_field( 'column_two_image_one' ); ?>
                    <?php if ( $column_two_image ) { ?>
                    	<img src="<?php echo $column_two_image['url']; ?>" alt="<?php echo $column_two_image['alt']; ?>" />
                    <?php } ?>
                </span>
                 <span class="image-two" data-aos="fade-up" data-aos-anchor-placement="center-bottom" data-aos-duration="800">
                    <?php $column_one_image_two = get_sub_field( 'column_two_image_two' ); ?>
                    <?php if ( $column_one_image_two ) { ?>
                    	<img src="<?php echo $column_one_image_two['url']; ?>" alt="<?php echo $column_one_image_two['alt']; ?>" />
                    <?php } ?>
                </span>
            </div>
            <div class="one-third column image-column large-column" data-aos="fade-up" data-aos-anchor-placement="center-bottom" data-aos-duration="800" data-aos-delay="800">
                <span class="image-large">
                    <?php $column_three_image = get_sub_field( 'column_three_image' ); ?>
                    <?php if ( $column_three_image ) { ?>
                    	<img src="<?php echo $column_three_image['url']; ?>" alt="<?php echo $column_three_image['alt']; ?>" />
                    <?php } ?>
                </span>
            </div>
        </div>
        <?php if ( have_rows( 'logo_scroller' ) ) : ?>
            <?php while ( have_rows( 'logo_scroller' ) ) : the_row(); ?>
                <div class="community-logo-ticker">
                    <div class="logo-ticker-title">
                        <span class="labelXXL"><?php echo get_sub_field( 'title' ); ?></span>
                    </div>
                    <div class="community-logo-ticker-container">
                        <span class="band-container-backwards">
                            <span class="moving-text">
                                <?php if ( have_rows( 'logos' ) ) : ?>
                                    <?php while ( have_rows( 'logos' ) ) : the_row(); ?>
                                    <span class="ticker-logo-container community-logo-container">
                                        <span class="logo-container">
                                            <?php $logo = get_sub_field( 'logo' ); ?>
                                            <?php if ( $logo ) { ?>
                                                <img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>" />
                                            <?php } ?>
                                        </span>
                                        <span class="logo-text labelXSmall">
                                            <?php echo get_sub_field( 'logo_text' ); ?>
                                        </span>
                                    </span>
                                    <?php endwhile; ?>
                                <?php else : ?>
                                    <?php // no rows found ?>
                                <?php endif; ?>      
                                
                                <?php if ( have_rows( 'logos' ) ) : ?>
                                    <?php while ( have_rows( 'logos' ) ) : the_row(); ?>
                                    <span class="ticker-logo-container community-logo-container">
                                        <span class="logo-container">
                                            <?php $logo = get_sub_field( 'logo' ); ?>
                                            <?php if ( $logo ) { ?>
                                                <img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>" />
                                            <?php } ?>
                                        </span>
                                        <span class="logo-text labelXSmall">
                                            <?php echo get_sub_field( 'logo_text' ); ?>
                                        </span>
                                    </span>
                                    <?php endwhile; ?>
                                <?php else : ?>
                                    <?php // no rows found ?>
                                <?php endif; ?>    

                                <?php if ( have_rows( 'logos' ) ) : ?>
                                    <?php while ( have_rows( 'logos' ) ) : the_row(); ?>
                                    <span class="ticker-logo-container community-logo-container">
                                        <span class="logo-container">
                                            <?php $logo = get_sub_field( 'logo' ); ?>
                                            <?php if ( $logo ) { ?>
                                                <img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>" />
                                            <?php } ?>
                                        </span>
                                        <span class="logo-text labelXSmall">
                                            <?php echo get_sub_field( 'logo_text' ); ?>
                                        </span>
                                    </span>
                                    <?php endwhile; ?>
                                <?php else : ?>
                                    <?php // no rows found ?>
                                <?php endif; ?>    
                            </span>
                        </span>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else : ?>
            <?php // no rows found ?>
        <?php endif; ?>
    </div>
</section>
