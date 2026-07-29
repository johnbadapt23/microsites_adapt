<section class="ticketing-three-column-number-text background-light-grey">
    <div class="container">
        <span class="title-container centre-text"><h2><?php echo get_sub_field( 'title' ); ?></h2></span>
        <?php if ( have_rows( 'column' ) ) : ?>
            <div class="column-container">
                <?php $counter = 1; ?>
                <?php while ( have_rows( 'column' ) ) : the_row(); ?>
                    <div class="column one-third">
                        <span class="number-container">
                            <span class="number"><?php echo $counter; ?></span>
                        </span>
                        <span class="text-container">
                        </span>               
                        <h3><?php echo get_sub_field( 'title' ); ?></h3>
                        <span class="text"><?php echo get_sub_field( 'text' ); ?></span>                        
                    </div>
                    <?php $counter++; ?>
                <?php endwhile; ?>
            </div>
        <?php else : ?>
            <?php // no rows found ?>
        <?php endif; ?>
    </div>
</section>