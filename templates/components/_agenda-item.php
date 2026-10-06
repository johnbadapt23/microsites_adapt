<?php 
$agendaGallery = get_sub_field( 'agenda_id' ); 
$hidespeakersImages = get_sub_field('hide_speaker_images');
?>
<section class="agenda-item" id="<?php echo esc_attr( get_sub_field( 'agenda_id' ) ); ?>">
    <div class="container">
        <div class="speaker-image-container <?= $hidespeakersImages; ?>">
            <?php if ( have_rows( 'speakers' ) ) : ?>
                <span class="speakers-images">
                    <?php while ( have_rows( 'speakers' ) ) : the_row(); ?>
                        <?php $speaker = get_sub_field( 'speaker' ); ?>
                        <?php if ( $speaker ): ?>
                            <?php $counter=1; ?>
                            <?php foreach ( $speaker as $post ):  ?>
                                <?php setup_postdata ( $post ); ?>
                                <?php if( $hidespeakersImages != 'yes' ) : ?>
                                <a class="speaker-popup <?= $hidespeakersImages; ?>" <?php if( get_field('about') ) : ?>href="#<?php echo esc_attr( $agendaGallery ); ?>speakerPopup-<?php echo esc_attr( $counter );?>"<?php endif; ?>>
                                    <?php $speaker_image = get_field( 'speaker_image' ); ?>
                                    <span class="speaker-image">
                                        <span class="image-container">
                                            <span class="bg-container">
                                                <?php $speaker_image = get_field( 'speaker_image' ); ?>
                                                <?php if ( $speaker_image ) { ?>
                                                	<img src="<?php echo esc_attr( $speaker_image['url'] ); ?>" alt="<?php echo esc_attr( $speaker_image['alt'] ); ?>" loading="lazy"/>
                                                <?php } else { ?>
                                                    <?php $generic_headshot = get_field( 'generic_headshot', 'options' ); ?>
                                                    <?php if ( $generic_headshot ) { ?>
                                                    	<img src="<?php echo esc_attr( $generic_headshot['url'] ); ?>" alt="<?php echo esc_attr( $generic_headshot['alt'] ); ?>" loading="lazy"/>
                                                    <?php } ?>
                                                <?php } ?>
                                            </span>
                                            <span class="border-offset"></span>
                                        </span>
                                    </span>
                                </a>
                                <?php endif; ?>

                                <?php if( get_field('about') ) : ?>
                                <div style="display: none;">
                                    <div class="speaker-popup-container" id="<?php echo esc_attr( $agendaGallery ); ?>speakerPopup-<?php echo esc_attr( $counter );?>">
                                        <div class="column white-bg image-column">
                                            <?php $speaker_image = get_field( 'speaker_image' ); ?>
                                            <span class="image-container">
                                                <span class="bg-container">
                                                    <?php $speaker_image = get_field( 'speaker_image' ); ?>
                                                    <?php if ( $speaker_image ) { ?>
                                                    	<img src="<?php echo esc_attr( $speaker_image['url'] ); ?>" alt="<?php echo esc_attr( $speaker_image['alt'] ); ?>" loading="lazy"/>
                                                    <?php } else { ?>
                                                        <?php $generic_headshot = get_field( 'generic_headshot', 'options' ); ?>
                                                        <?php if ( $generic_headshot ) { ?>
                                                        	<img src="<?php echo esc_attr( $generic_headshot['url'] ); ?>" alt="<?php echo esc_attr( $generic_headshot['alt'] ); ?>" loading="lazy"/>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </span>
                                                <span class="border-offset"></span>
                                            </span>
                                            <h3 class="title">
                                                <?php the_title(); ?>
                                                <?php if ( get_field('linkedin')) { ?>
                                                    <a class="linkedin-link" href="<?php echo esc_attr( get_field( 'linkedin' ) );?>" target="_blank" aria-label="LinkedIn profile"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/round-linkedin.svg" width="20" alt="" loading="lazy"/></a>
                                                <?php } ?>
                                            </h3>
                                            <p class="job-title"><?php echo get_field( 'job_title' ); ?></p>
                                            <?php $company_logo = get_field( 'company_logo' ); ?>
                                            <?php if ( $company_logo ) { ?>
                                                <span class="company-logo">
                                        	       <img src="<?php echo esc_attr( $company_logo['url'] ); ?>" alt="<?php echo esc_attr( $company_logo['alt'] ); ?>" loading="lazy"/>
                                               </span>
                                            <?php } ?>
                                        </div>
                                        <div class="column dark-bg about-column">
                                            <?php if ( have_rows( 'agenda_items' ) ) : ?>
                                                <div class="agenda-items">
                                                    <span class="agenda-content-title">Speaking</span>
                                                	<?php while ( have_rows( 'agenda_items' ) ) : the_row(); ?>
                                                        <a class="agenda-item" href="<?php echo esc_url( home_url( '/' ) ); ?>agenda#<?php echo esc_attr( get_sub_field( 'agenda_link_id' ) ); ?>" targt="_self">
                                                    		<span class="time"><?php echo get_sub_field( 'time' ); ?></span>
                                                		    <span class="agenda-title"><?php echo get_sub_field( 'title' ); ?></span>
                                                        </a>
                                                	<?php endwhile; ?>
                                                </div>
                                            <?php else : ?>
                                            	<?php // no rows found ?>
                                            <?php endif; ?>
                                            <div class="about">
                                                <span class="about-title">About</span>
                                                <span class="about-text" id="aboutContainer"><?php echo get_field( 'about' ); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php $counter++; ?>
                            <?php endforeach; ?>
                        <?php wp_reset_postdata(); ?>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </span>
            <?php else : ?>
                <?php // no rows found ?>
            <?php endif; ?>
        </div>
        <div class="content-container">
            <span class="time"><?php echo get_sub_field( 'time' ); ?></span>
            <h3 class="agenda-title"><?php echo get_sub_field( 'title' ); ?></h3>
            <?php if ( have_rows( 'company' ) ) : ?>
                <span class="company-container">
                    <!-- <span class="company-with">with</span> -->
                    <?php while ( have_rows( 'company' ) ) : the_row(); ?>
                        <?php if (get_sub_field( 'link' )){ ?>
                            <a class="company" href="<?php echo esc_attr( get_sub_field( 'link' ) ); ?>" target="_blank"><?php echo get_sub_field( 'company_name' ); ?></a>
                        <?php } else { ?>
                            <span class="company"><?php echo get_sub_field( 'company_name' ); ?></span>
                        <?php } ?>
                    <?php endwhile; ?>
                </span>
            <?php else : ?>
                <?php // no rows found ?>
            <?php endif; ?>
            <?php if ( have_rows( 'speakers' ) ) : ?>
                <span class="speakers-title-container">
                    <?php while ( have_rows( 'speakers' ) ) : the_row(); ?>
                        <?php $speaker = get_sub_field( 'speaker' ); ?>
                        <?php if ( $speaker ): ?>
                            <?php $counterName=1; ?>
                            <?php foreach ( $speaker as $post ):  ?>
                                <a class="speaker-popup-text" <?php if( get_field('about') ) : ?> href="#<?php echo esc_attr( $agendaGallery ); ?>speakerPopup-<?php echo esc_attr( $counterName );?>"<?php endif; ?>>
                                    <span class="speaker">
                                        <?php setup_postdata ( $post ); ?>
                                        <span class="title-container"><?php the_title(); ?></span>
                                        <span class="job-title">- <?php echo get_field( 'job_title' ); ?></span>
                                    </span>
                                </a>
                                <?php $counterName++; ?>
                            <?php endforeach; ?>
                        <?php wp_reset_postdata(); ?>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </span>
            <?php else : ?>
                <?php // no rows found ?>
            <?php endif; ?>
            
            <?php if( get_sub_field('subtext') ) : ?>
            <div class="agenda-subtext"><?php echo get_sub_field( 'subtext' ); ?></div>
            <?php endif; ?>

            <?php if ( have_rows( 'speakers' ) ) : ?>
                <span class="speakers-images mobile">
                    <?php while ( have_rows( 'speakers' ) ) : the_row(); ?>
                        <?php $speaker = get_sub_field( 'speaker' ); ?>
                        <?php if ( $speaker ): ?>
                            <?php $counterImage=1; ?>
                            <?php foreach ( $speaker as $post ):  ?>
                                <?php setup_postdata ( $post ); ?>
                                <a class="speaker-popup-mobile" <?php if( get_field('about') ) : ?>href="#<?php echo esc_attr( $agendaGallery ); ?>speakerPopup-<?php echo esc_attr( $counterImage );?>"<?php endif; ?>>
                                    <?php $speaker_image = get_field( 'speaker_image' ); ?>
                                    <span class="speaker-image">
                                        <span class="image-container">
                                            <span class="bg-container">
                                                <?php $speaker_image = get_field( 'speaker_image' ); ?>
                                                <?php if ( $speaker_image ) { ?>
                                                	<img src="<?php echo esc_attr( $speaker_image['url'] ); ?>" alt="<?php echo esc_attr( $speaker_image['alt'] ); ?>" loading="lazy"/>
                                                <?php } else { ?>
                                                    <?php $generic_headshot = get_field( 'generic_headshot', 'options' ); ?>
                                                    <?php if ( $generic_headshot ) { ?>
                                                    	<img src="<?php echo esc_attr( $generic_headshot['url'] ); ?>" alt="<?php echo esc_attr( $generic_headshot['alt'] ); ?>" loading="lazy"/>
                                                    <?php } ?>
                                                <?php } ?>
                                            </span>
                                            <span class="border-offset"></span>
                                        </span>
                                    </span>
                                </a>
                                <?php $counterImage++; ?>
                            <?php endforeach; ?>
                        <?php wp_reset_postdata(); ?>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </span>
            <?php else : ?>
                <?php // no rows found ?>
            <?php endif; ?>

            <span class="agenda-description">
                <span class="read-more-overlay"><span class="read-more">Read More</span></span>
                <span class="text"><?php echo get_sub_field( 'text' ); ?></span>
            </span>
        </div>
    </div>
</section>
