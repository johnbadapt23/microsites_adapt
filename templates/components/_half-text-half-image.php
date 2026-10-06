<section class="half-text-half-image background-white">    
    <div class="container">
        <div class="column-container">        
            <div class="text-container text-column one-half">                
                <span class="h2-style" class="black-text"><?php echo get_sub_field( 'title' ); ?></span>
                 <span class="sub-title red-text"><?php echo get_sub_field( 'sub_title' ); ?></span>
                <span class="text black-text"><?php echo get_sub_field( 'text' ); ?></span>
                <?php if( get_sub_field( 'register_button_text' )) { ?>
                    <span class="button-container-black-before">
                        <a class="std-button red-button register-button" href="#register"><?php echo get_sub_field( 'register_button_text' ); ?></a>
                    </span>
                <?php } ?>                                     
            </div>
            <div class="image-column column one-half">
                <div class="image-container">
                    <div class="bg-container">
                        <?php if( get_sub_field( 'vimeo_code' )) { ?>
                            <a class="replay-button popup-vimeo mobile" href="https://vimeo.com/<?php echo esc_attr( get_sub_field('vimeo_code') ); ?>">
                        <?php } ?>
                        <?php $image = get_sub_field('image'); ?>
                        <img src="<?php echo esc_attr( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" loading="lazy"/>
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
