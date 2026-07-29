<section class="testimonials-slider-block">
    <div class="container">        
        <div class="testimonials-slider-container">
            <div class="testimonials-slider">
                <?php if ( have_rows( 'slide' ) ) : ?>
                    <?php while ( have_rows( 'slide' ) ) : the_row(); ?>
                        <div class="testimonials-slide">
                            <div class="column-container">
                                <div class="column one-half text-column">
                                    <span class="quote-marks"></span>
                                    <span class="testimonial"><?php echo get_sub_field( 'testimonial' ); ?></span>
                                    <span class="testimonial-title"><?php echo get_sub_field( 'title' ); ?></span>
                                </div>
                                <div class="column one-half image-column">
                                    <div class="image-container">
                                        <div class="bg-container">
                                             <?php $image = get_sub_field( 'image' ); ?>
                                            <?php if ( $image ) { ?>
                                                <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" loading="lazy"/>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>                                                              
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else : ?>
                    <?php // no rows found ?>
                <?php endif; ?>
            </div>
            <div class="progress-container-testimonials" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                <span class="slider__label sr-only"></span>
            </div>
        </div>
    </div>
</section>