<section class="two-column-services landing-form-intro background-white">
    <div class="container">
        <div class="landing-form-intro-columns">
            <div class="column one-half text-column">
                <div class="text-content-inner">
                    <span class="pre-title inter-semi-bold text-red"><?php echo get_sub_field( 'sub_title' ); ?></span>
                    <h2 class="title"><?php echo get_sub_field( 'title' ); ?></h2>
                    <span class="text p-large"><?php echo get_sub_field( 'text' ); ?></span>
                    <span class="links-container desktop">
                        <?php if ( have_rows( 'button' ) ) : ?>
                            <?php while ( have_rows( 'button' ) ) : the_row(); ?>
                                <?php if(get_sub_field( 'link_type' ) == 'scrollto') { ?>
                                    <a class="scroll-to-button std-button  red-button" href="#<?php echo get_sub_field( 'scroll_to_id' ); ?>"><?php echo get_sub_field( 'link_text' ); ?></a>
                                <?php } else if(get_sub_field('link_type') == 'hubspot-popup') { ?>
                                    <a class="formPopupHubspot std-button red-button" href="#formPopup"><?php echo get_sub_field( 'link_text' ); ?></a>
                                    <div style="display: none;">         
                                        <div class="preview-cta-form login-form-container" id="formPopup">
                                            <div class="form-container"><?php echo get_sub_field( 'form_embed_code' ); ?></div>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <a class="link std-button red-button" href="<?php echo get_sub_field( 'link' ); ?>" target="<?php echo get_sub_field( 'link_target' ); ?>"><?php echo get_sub_field( 'link_text' ); ?></a>
                                <?php } ?>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <?php // no rows found ?>
                        <?php endif; ?>
                        <?php if (get_sub_field( 'text_link_type' ) == 'scroll-to') { ?> 
                            <?php if ( have_rows( 'text_link' ) ) : ?>
                                <?php while ( have_rows( 'text_link' ) ) : the_row(); ?>
                                    <a class="text-link scroll-to-button red-text red-underline-link" href="#<?php echo get_sub_field( 'scroll_to_id' ); ?>"><?php echo get_sub_field( 'link_text' ); ?></a>                                 
                                <?php endwhile; ?>
                            <?php else : ?>
                                <?php // no rows found ?>
                            <?php endif; ?>
                        <?php } else if (get_sub_field( 'text_link_type' ) == 'link') { ?> 
                            <?php if ( have_rows( 'text_link' ) ) : ?>
                                <?php while ( have_rows( 'text_link' ) ) : the_row(); ?>
                                    <a class="text-link red-text red-underline-link" href="<?php echo get_sub_field( 'link' ); ?>" target="<?php echo get_sub_field( 'link_target' ); ?>"><?php echo get_sub_field( 'link_text' ); ?></a>                                 
                                <?php endwhile; ?>
                            <?php else : ?>
                                <?php // no rows found ?>
                            <?php endif; ?>                        
                        <?php } ?>
                    </span>
                </div>
            </div>
            <div class="column one-half form-column">
                <div class="form-container">
                    <?php echo get_sub_field( 'form_embed' ); ?>
                </div>           
            </div>
        </div>
    </div>
</section>
