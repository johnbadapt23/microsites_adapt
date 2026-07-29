<section class="ticketing-two-column-icon background-black">
    <div class="container">
        <div class="title-container">
            <h2 class="white-text"><?php echo get_sub_field( 'title' ); ?></h2>
        </div>
        <div class="column-container">
            <?php if ( have_rows( 'column' ) ) : ?>
                <?php while ( have_rows( 'column' ) ) : the_row(); ?>
                    <div class="column one-half background-secondary-black">
                        <?php $icon = get_sub_field( 'icon' ); ?>
                        <span class="icon-container-outer">
                            <span class="image-container">
                                <span class="bg-container">
                                    <?php if ( $icon ) { ?>
                                        <img src="<?php echo $icon['url']; ?>" alt="<?php echo $icon['alt']; ?>" />
                                    <?php } ?>
                                </span>
                            </span>
                        </span>
                        <h3><?php echo get_sub_field( 'title' ); ?></h3>
                        <span class="text"><?php echo get_sub_field( 'text' ); ?></span>
                    </div>
                <?php endwhile; ?>
            <?php else : ?>
                <?php // no rows found ?>
            <?php endif; ?>
        </div>
    </div>
</section>



