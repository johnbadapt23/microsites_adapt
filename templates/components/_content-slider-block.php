<section class="content-slider">
    <div class="container">
        <div class="content-top">
            <div class="column one-half">
                <h2><?php echo get_sub_field( 'title' ); ?></h2>
            </div>
            <div class="column one-half">
                <?php if ( have_rows( 'button' ) ) : ?>
                	<?php while ( have_rows( 'button' ) ) : the_row(); ?>
                        <a class="white-ouline-button std-button" href="<?php echo esc_attr( get_sub_field( 'button_link' ) ); ?>" target="<?php echo esc_attr( get_sub_field( 'link_target' ) ); ?>"><?php echo get_sub_field( 'button_text' ); ?></a>
                	<?php endwhile; ?>
                <?php else : ?>
                	<?php // no rows found ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="content-slider-container">
        <span class="leftSlideCover"></span>
        <div class="container">
            <?php if ( have_rows( 'slide' ) ) : ?>
                <div class="slider">
                    <?php $counter=1;?>
                	<?php while ( have_rows( 'slide' ) ) : the_row(); ?>
                        <div class="slide column">
                            <span class="slide-inside">
                                <span class="slide-count">0<?php echo $counter;?></span>
                        		<h3 class="title"><?php echo get_sub_field( 'title' ); ?></h3>
                        		<span class="text"><?php echo get_sub_field( 'text' ); ?></span>
                            </span>
                        </div>
                        <?php $counter ++; ?>
                	<?php endwhile; ?>
                </div>
            <?php else : ?>
            	<?php // no rows found ?>
            <?php endif; ?>
            <?php $slideCount = $counter - 1; ?>
            <?php $slidePercent = 100 / $slideCount; ?>
            <div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="<?php echo esc_attr( $slidePercent );?>" style="background-size:<?php echo esc_attr( $slidePercent );?>%">
                <span class="slider__label sr-only">
            </div>
            <span class="pagingInfo"></span>
        </div>
    </div>
</section>
