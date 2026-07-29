<section class="video-quote-slider-block background-black">
    <div class="container">
        <div class="title-container">
            <h2 class="white-text bold-red"><?php the_sub_field( 'title' ); ?></h2>
        </div>
        <div class="video-quote-container">
            <div class="column text-column">
                <?php if ( have_rows( 'quotes' ) ) : ?>
                    <div class="video-quote-slider-container">
                        <?php while ( have_rows( 'quotes' ) ) : the_row(); ?>
                            <div class="video-quote-slide">
                                <span class="slide-top">
                                    <?php $company_logo = get_sub_field( 'company_logo' ); ?>
                                    <?php if ( $company_logo ) { ?>
                                        <span class="logo-container">
                                            <img src="<?php echo $company_logo['url']; ?>" alt="<?php echo $company_logo['alt']; ?>" loading="lazy"/>
                                        </span>
                                    <?php } ?>                                                        
                                    <span class="quote text-white"><?php echo get_sub_field( 'quote' ); ?></span>
                                    <span class="quoter text-white"><span class="name"><?php echo get_sub_field( 'name' ); ?></span><span class="role"><?php echo get_sub_field( 'role' ); ?></span></span>
                                </span>
                                <span class="slide-bottom">
                                    <a class="text-link external-link red-text red-underline-link" href="<?php echo get_sub_field( 'article_link' ); ?>">Read story</a>
                                </span>
                            </div>                        	
                        <?php endwhile; ?>
                    </div>
                <?php else : ?>
                    <?php // no rows found ?>
                <?php endif; ?>
            </div>
            <div class="column video-column">
                <div class="video-container image-container">                    
                    <div class="bg-container">
                        <?php $poster_image = get_sub_field( 'poster_image' ); ?>
                        <?php if ( $poster_image ) { ?>
                            <img src="<?php echo $poster_image['url']; ?>" alt="<?php echo $poster_image['alt']; ?>" loading="lazy"/>
                        <?php } ?>
                        <?php if( get_sub_field( 'vimeo_code' )) { ?>
                            <span class="opacity-overlay"></span>
                            <a class="popup-vimeo" href="https://vimeo.com/<?php echo get_sub_field('vimeo_code'); ?>"></a>
                        <?php } ?>
                    </div>
                </div>                            
            </div>
        </div>
    </div>
</section>