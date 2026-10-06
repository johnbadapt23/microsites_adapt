<section class="ticketing background-white" id="tickets">
    <div class="container">
        <span class="title-container">
            <h1 class="h2-style"><?php echo get_sub_field( 'title' ); ?></h1>
            <p><?php echo get_sub_field( 'sub_title' ); ?></p>
            <?php $rotating_icon = get_sub_field( 'rotating_image' ); ?>
            <span class="rotating-image-container">
                <?php if ( $rotating_icon ) { ?>
                    <img id="rotatingImage" src="<?php echo esc_attr( $rotating_icon['url'] ); ?>" alt="<?php echo esc_attr( $rotating_icon['alt'] ); ?>" loading="lazy"/>
                <?php } ?>
            </span>
        </span>
        <div class="column-container">
            <?php if ( have_rows( 'card' ) ) : ?>
                <?php while ( have_rows( 'card' ) ) : the_row(); ?>
                    <div class="column one-third ticket-card">
                        <div class="card-top">
                            <?php $icon = get_sub_field( 'icon' ); ?>
                            <span class="icon-container-outer">
                                <span class="image-container">
                                    <span class="bg-container">
                                        <?php if ( $icon ) { ?>
                                            <img src="<?php echo esc_attr( $icon['url'] ); ?>" alt="<?php echo esc_attr( $icon['alt'] ); ?>" loading="lazy"/>
                                        <?php } ?>
                                    </span>
                                </span>
                            </span>
                            <h3 class="card-title bold-red italic-grey"><?php echo get_sub_field( 'title' ); ?></h3>
                            <span class="text"><?php echo get_sub_field( 'text' ); ?></span>                
                        </div>
                        <div class="card-bottom">
                            <?php if ( have_rows( 'button' ) ) : ?>
                                <span class="button-container link-container">
                                    <?php while ( have_rows( 'button' ) ) : the_row(); ?>
                                        <?php if( get_sub_field( 'link_type' ) == 'link'){ ?> 
                                            <a class="red-arrow-button std-button red-outline" href="<?php echo esc_attr( get_sub_field( 'link' ) ); ?>" target="<?php echo esc_attr( get_sub_field( 'link_target' ) ); ?>"><?php echo get_sub_field( 'link_text' ); ?></a>                           
                                        <?php } else { ?> 
                                            <span style="display: none"><?php echo get_sub_field( 'form_code' ); ?></span>
                                            <span class="form-popup-button-container std-button red-outline red-arrow-button"><?php echo get_sub_field( 'form_button' ); ?></span>                                                               
                                        <?php } ?>     
                                    <?php endwhile; ?>
                                </span>
                            <?php else : ?>
                                <?php // no rows found ?>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</section>



