
<section class="delegate-block" id="<?php echo esc_attr( get_sub_field( 'id' ) ); ?>">
    <div class="container">
        <div class="top-container">
            <div class="title-column">
                <h2 class="text-black"><?php echo get_sub_field( 'title' ); ?></h2>                
                <span class="text text-black"><?php echo get_sub_field( 'subtitle' ); ?></span> 
                <?php if ( have_rows( 'button' ) ) : ?>
                    <span class="button-container">
                        <?php while ( have_rows( 'button' ) ) : the_row(); ?>
                            <?php if ( get_sub_field( 'button_type' ) == 'form'){ ?>
                                <span class="form-popup-button-container std-button with-red-button">
                                    <?php echo get_sub_field('formcrafts_button_code'); ?>
                                </span>
                                <span class="formcraft-popup-container">
                                    <?php echo get_sub_field('formcrafts_code'); ?>
                                </span>                               
                            <?php } else { ?>
                                <a class="std-button red-button" href="<?php echo esc_attr( get_sub_field( 'link' ) ); ?>" target="<?php echo esc_attr( get_sub_field( 'link_target' ) ); ?>"><?php echo get_sub_field( 'button_text' ); ?></a>
                            <?php } ?>
                        <?php endwhile; ?>
                    </span>
                <?php else : ?>
                    <?php // no rows found ?>
                <?php endif; ?>              
            </div>
        </div>
        <div class="delegate-slide-container">
            <?php if ( have_rows( 'delegate_slider' ) ) : ?>
                <?php while ( have_rows( 'delegate_slider' ) ) : the_row(); ?>
                    <div class="delegate-slides">
                        <?php if ( have_rows( 'slide' ) ) : ?>
                            <?php while ( have_rows( 'slide' ) ) : the_row(); ?>
                                <div class="delegate-slide">
                                    <span class="slide-inner">
                                        <span class="logo-container">
                                            <?php $logo = get_sub_field( 'logo' ); ?>
                                            <?php if ( $logo ) { ?>
                                                <img src="<?php echo esc_attr( $logo['url'] ); ?>" alt="<?php echo esc_attr( $logo['alt'] ); ?>" loading="lazy"/>
                                            <?php } ?>
                                        </span>
                                        <span class="text-container">
                                            <span class="slide-text"><?php echo get_sub_field( 'text' ); ?></span>
                                        </span>
                                    </span>
                                </div>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <?php // no rows found ?>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            <?php else : ?>
                <?php // no rows found ?>
            <?php endif; ?>
        </div>
    </div>
</section>
