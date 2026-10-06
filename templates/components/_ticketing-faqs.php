<section class="customer-events-faqs background-black">
    <div class="container">
        <div class="faq-container">
            <?php if ( have_rows( 'faq_group' ) ) : ?>
				<?php while ( have_rows( 'faq_group' ) ) : the_row(); ?>                
                    <div class="faq-column">
                        <h2 class="white-text"><?php echo get_sub_field( 'title' ); ?></h2>
                        <div class="faq-column-inner">                            
                            <?php if ( have_rows( 'faq_item' ) ) : ?>
                                <?php while ( have_rows( 'faq_item' ) ) : the_row(); ?>
                                    <span class="faq-item">
                                        <span class="question accordion-title labelLarge">
                                            <?php echo get_sub_field( 'item_title' ); ?>
                                        </span>
                                        <span class="answer accordion-content p-small" style="display: none;">
                                            <?php echo get_sub_field( 'text' ); ?>
                                        </span>
                                    </span>
                                <?php endwhile; ?>
                            <?php else : ?>
                                <?php // no rows found ?>
                            <?php endif; ?>
                            <?php if ( have_rows( 'bottom_link' ) ) : ?>
                                <?php while ( have_rows( 'bottom_link' ) ) : the_row(); ?>
                                    <a class="text-link red-text red-underline-link large-text-link  scroll-to external-link" href="#<?php echo esc_attr( get_sub_field( 'scroll_to_id' ) ); ?>"><?php echo get_sub_field( 'link_text' ); ?></a>                                    
                                <?php endwhile; ?>
                            <?php else : ?>
                                <?php // no rows found ?>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else : ?>
                <?php // no rows found ?>
            <?php endif; ?>
        </div>
    </div>
</section>