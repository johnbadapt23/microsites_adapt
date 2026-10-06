<section class="ticketing-three-column-icon-text background-white">
    <div class="container">
        <?php if ( have_rows( 'column' ) ) : ?>
            <div class="column-container">
                <?php while ( have_rows( 'column' ) ) : the_row(); ?>
                    <div class="column one-third">
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
                        <span class="text-container">
                        </span>               
                        <h3><?php echo get_sub_field( 'title' ); ?></h3>
                        <span class="text"><?php echo get_sub_field( 'text' ); ?></span>                        
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else : ?>
            <?php // no rows found ?>
        <?php endif; ?>
    </div>
</section>