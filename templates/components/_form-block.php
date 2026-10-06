<section class="partner-form" id="<?php echo esc_attr( get_sub_field( 'id' ) ); ?>">
    <div class="container">
        <div class="form-text-container background-pink">
            <div class="column text-content-column one-half">
    			<h2 class="form-module-title"><?php echo get_sub_field( 'title' ); ?></h2>
	             <span class="text black-text"><?php echo get_sub_field( 'text' ); ?></span>
                 <span class="image-arrow-container">
                     <span class="image-container">
                         <span class="bg-container">
                             <?php $image = get_sub_field( 'image' ); ?>
                 			<?php if ( $image ) { ?>
                 				<img src="<?php echo esc_attr( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" loading="lazy"/>
                 			<?php } ?>
                         </span>
                         <span class="arrow-container">
                             <span class="image-container">
                                 <span class="bg-container">
                                     <?php $arrow_image = get_sub_field( 'arrow_image' ); ?>
                         			<?php if ( $arrow_image ) { ?>
                         				<img src="<?php echo esc_attr( $arrow_image['url'] ); ?>" alt="<?php echo esc_attr( $arrow_image['alt'] ); ?>" loading="lazy"/>
                         			<?php } ?>
                                </span>
                            </span>
                         </span>
                     </span>
                 </span>
                 <span class="bottom-container">
                     <span class="form-popup-button-container"><?php echo get_sub_field( 'mobile_form_button' ); ?></span>
                     <span class="popup-form-container"><?php echo get_sub_field( 'mobile_form_embed' ); ?></span>
                     <span class="fast-track-text black-text"><?php echo get_sub_field( 'fast_track_text' ); ?></span>
                 </span>
            </div>
            <div class="column one-half form-column">
                <span class="form-container">
                    <?php echo get_sub_field( 'form_embed' ); ?>
                </span>

            </div>
        </div>
    </div>
</section>
