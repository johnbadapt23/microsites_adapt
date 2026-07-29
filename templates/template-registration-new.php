<?php
/**
 * Template Name: New Registration Template
 */

get_header();

?>

<main class="page flexible registration form-page new-registration" id="main">
    <?php

    // Load field value.
    $date_string = get_field('event_date');

    // Create DateTime object from value (formats must match).
    $date = DateTime::createFromFormat('Ymd', $date_string);

    ?>
    <?php if ( get_field( 'hide_header' ) == 1 ) { ?>
        <style>
            main {
                margin-top: 0px;
            }
        </style>
        <div class="event-registration-header">
            <div class="container">
                <div class="container-inner">
                    <span class="logo-container">
                        <a href="/">
                            <?php $header_logo = get_field( 'header_logo' ); ?>
                            <?php if ( $header_logo ) { ?>
                                <img src="<?php echo $header_logo['url']; ?>" alt="<?php echo $header_logo['alt']; ?>" />
                            <?php } ?>            
                        </a>
                    </span>                    
                </div>
            </div>
        </div>
    <?php } ?>
    <section class="topicBanner webinarBanner">
        <div class="imageSizeContainer">
            <div class="bgContainer">
                <?php $banner_image = get_field( 'banner_background_image' ); ?>
                <img class="desktop" src="<?php echo $banner_image['url']; ?>" alt="<?php echo $banner_image['alt']; ?>"/>
                <?php if( get_field('banner_opacity_overlay') == 'no-overlay'){ ?>
                <?php } else { ?>
                    <span class="opacity-overlay"></span>
                <?php }?>
            </div>
            <div class="container">
                <div class="column webinar-column first-column">
                    <?php if(get_field( 'banner_logo' )) { ?>
                        <?php $bannerLogo = get_field('banner_logo'); ?>
                        <span class="banner-icon" <?php if( get_field( 'banner_logo_height' )){ ?>style="height: <?php echo get_field( 'banner_logo_height' ); ?>px;"<?php } ?>>
                            <img src="<?php echo $bannerLogo['url']; ?>"/>
                        </span>
                    <?php } ?>
                    <h1 class="text-white"><?php echo get_field( 'banner_title' ); ?></h1>
                    <p class="text-white"><?php echo $date->format('l, j F, Y'); ?> @<?php echo get_field( 'event_location' ); ?></p>
                </div>
            </div>
        </div>
    </section>
    <?php if ( have_rows( 'takeaways' ) ) : ?>
        <?php while ( have_rows( 'takeaways' ) ) : the_row(); ?>
            <?php $extraPadding = 'no-extra-padding';?>
        <?php endwhile; ?>
    <?php else : ?>
        <?php $extraPadding = 'no-padding-bottom'; ?>
    <?php endif; ?>
    <section class="webinar-article bg-white <?php echo $extraPadding; ?>">
        <div class="container">
            <div class="column webinar-column second-column right-column">
                <span class="register-container">
                    <span class="sticky-container">
                        <span class="upper-container">
                            <img class="calendar-icon" src="<?php echo get_template_directory_uri(); ?>/assets/images/calendar.svg"/ width="26">
                            <span class="date-title small-text-grey">Date</span>
                            <span class="date text-black"><?php echo $date->format('l, j F, Y'); ?></span>
                            <span class="time-title small-text-grey">Time</span>
                            <span class="time text-black"><?php echo get_field( 'event_start_time' ); ?> - <?php echo get_field( 'event_end_time' ); ?></span>
                            <?php if (get_field( 'time_text' )) { ?>
                                <span class="time text-black"><?php echo get_field( 'time_text' ); ?></span>
                            <?php } ?>
                            <span class="location-title small-text-grey">Location</span>
                            <?php if (get_field( 'location_text' )) { ?>
                                <span class="location text-black"><?php echo get_field( 'location_text' ); ?></span>
                            <?php } ?>
                            <span class="upper-bar"></span>
                        </span>
                        <span class="bottom-container">
                            <span class="bottom-bar"></span>
                            <?php if(get_field('pre_button_text')){ ?>
                                <?php $preText =  get_field('pre_button_text'); ?>
                            <?php } ?>
                            <?php if(get_field('button_text')){ ?>
                                <?php $buttonText =  get_field('button_text'); ?>
                            <?php } ?>
                            <?php if( get_field( 'button' ) =='register' ) { ?>
                                <span class="title"><?php if($preText){ ?><?php echo $preText; ?><?php } else { ?>Register to Attend<?php } ?></span>
                                <a class="registerButton register-scroll-button background-red" href="#registerForm"><?php if($buttonText){ ?><?php echo $buttonText; ?><?php } else { ?>Register<?php } ?></a>
                            <?php } else { ?>
                                <?php if($preText){ ?><span class="title"><?php echo $preText; ?></span><?php } ?>
                                <span class="registerButton upcoming background-grey"><?php if($buttonText){ ?><?php echo $buttonText; ?><?php } else { ?>Upcoming<?php } ?></span>
                            <?php } ?>
                        </span>
                    </span>
                </span>
            </div>
            <div class="column webinar-column first-column">
                <h2 class="webinar-subtitle"><?php echo get_field( 'sub_title' ); ?></h2>
                <span class="webinar-content content">
                    <?php echo get_field( 'content' ); ?>
                </span>
			
            </div>
        </div>
    </section>

    <?php if(get_field( 'registration_form_embed' )) { ?>
        <div style="display: none;">
            <div class="hidden-fields" style="display: none;">
                <span class="hidden-name"><?php echo get_field( 'registration_form_event_name_sf' ); ?></span>
                <span class="hidden-event"><?php the_title(); ?></span>
                <span class="hidden-date"><?php echo $date->format('l, j F, Y'); ?></span>
                <span class="hidden-id"><?php echo get_field( 'registration_form_sf_id' ); ?></span>
            </div>
            <div class="webinar-register-form" id="registerForm">
                <div class="container">
                    <?php $registration_form_logo = get_field( 'registration_form_logo' ); ?>
                    <?php if ( $registration_form_logo ) { ?>
                        <span class="registration-form-logo">
                            <img src="<?php echo $registration_form_logo['url']; ?>" alt="<?php echo $registration_form_logo['alt']; ?>" />
                        </span>
                    <?php } ?>
                    <span class="webinar-subtitle"><?php echo get_field( 'registration_form_title' ); ?></span>
                    <span class="event-date-location"><?php echo $date->format('l, j F, Y'); ?> @<?php echo get_field( 'event_location' ); ?></span>
                    <span class="form-container"><?php echo get_field( 'registration_form_embed' ); ?></span>
                </div>
            </div>
            <?php if ( have_rows( 'registration_form_fields' ) ) : ?>
                <?php while ( have_rows( 'registration_form_fields' ) ) : the_row(); ?>
                    <?php if ( get_sub_field( 'country' ) == 1 ) {
                    // echo 'true';
                    } else { ?>
                        <style>
                            .hs_country {
                                display: none;
                            }
                        </style>
                    <?php } ?>
                    <?php if ( get_sub_field( 'client_communication_method' ) == 1 ) { ?>
                        <span class="client-communication-title"><?php echo get_sub_field( 'client_communication_label' ); ?></span>
                        <span class="client-communication-text"><?php echo get_sub_field( 'client_communication_text' ); ?></span>
                    <?php } else { ?>
                        <style>
                            .hs_client_communication_method {
                                display: none;
                            }
                        </style>
                    <?php } ?>
                    <?php if ( get_sub_field( 'attendance_preference' ) == 1 ) {

                    // echo 'true';
                    } else { ?>
                        <style>
                            .hs_attendance_preference {
                                display: none;
                            }
                        </style>
                    <?php } ?>
                    <?php if ( get_sub_field( 'beverage_choice' ) == 1 ) {
                    // echo 'true';
                    } else { ?>
                        <style>
                            .hs_wine_choice {
                                display: none;
                            }
                        </style>
                    <?php } ?>
                    <?php if ( get_sub_field( 'gift_opt_in_to_the_session' ) == 1 ) { ?>
                        <span class="gift-opt-in-text"><?php echo get_sub_field( 'gift_opt_in_text' ); ?></span>
                    <?php } else { ?>
                        <style>
                            .hs_gift_opt_in {
                                display: none;
                            }
                        </style>
                    <?php } ?>
                    <?php if ( get_sub_field( 'homeoffice_delivery_address' ) == 1 ) {
                    // echo 'true';
                    } else { ?>
                        <style>
                            .hs_home_office_delivery_address {
                                display: none;
                            }
                        </style>
                    <?php } ?>
                    <?php if ( get_sub_field( 'dietary_requirements' ) == 1 ) {
                    // echo 'true';
                    } else { ?>
                        <style>
                            .hs_dietary_requirements_,
                            .hs_dietary_requirements {
                                display: none;
                            }
                        </style>
                    <?php } ?>
                    <?php if ( get_sub_field( 'critical_issue' ) == 1 ) { ?>
                        <span class="critical-text"><?php echo get_sub_field( 'critical_issue_label' ); ?></span>
                        <span class="critical-help-text"><?php echo get_sub_field('critical_issue_help_text'); ?></span>
                    <?php } else { ?>
                        <style>
                            .hs_what_is_your_most_critical_issue_to_discuss_with_your_peers_at_this_roundtable_,
                            .hs_what_is_your_most_critical_issue_to_discuss_with_your_peers_at_this_roundtable {
                                display: none;
                            }
                        </style>
                    <?php } ?>
                    <?php if ( get_sub_field( 'marketing' ) == 1 ) { ?>
                        <span class="marketing-text"><?php echo get_sub_field( 'marketing_text' ); ?></span>
                    <?php } else { ?>
                        <style>
                            .hs_single_client_opt_in {
                                display: none;
                            }
                        </style>
                    <?php } ?>
                    <?php if ( get_sub_field( 'umbrella_opt_in' ) == 1 ) {
                        ?>
                            <span class="umbrella-text"><?php echo get_sub_field( 'umbrella_opt_in_text' ); ?></span>
                            <span class="umbrella-help-text"><?php echo get_sub_field( 'help_text' ); ?></span>
                        <?php
                    } else { ?>
                        <style>
                            .hs_client_communication_opt_in {
                                display: none;
                            }
                        </style>
                    <?php } ?>
                    <?php if ( get_sub_field( 'newsletter_opt_in' ) == 1 ) {
                        ?>
                        <?php if ( get_sub_field( 'newsletter_help_text' )) { ?>
                            <span class="newsletter-help-text"><?php echo get_sub_field( 'newsletter_help_text' ); ?></span>
                        <?php } ?>
                        <?php
                    } else { ?>
                        <style>
                            .hs_newsletter_opt_in {
                                display: none;
                            }
                        </style>
                    <?php } ?>
                    <?php if ( get_sub_field( 'remove_lunch_option' ) == 1 ) {
                    // echo 'true';
                    } else { ?>
                        <style>
                            .hs_would_you_like_to_remove_lunch_ {
                                display: none;
                            }
                        </style>
                    <?php } ?>
                    <?php if ( get_sub_field( 'invoiced_for_lunch_option' ) == 1 ) {
                    // echo 'true';
                    } else { ?>
                        <style>
                            .hs_would_you_like_to_be_invoiced_for_lunch_ {
                                display: none;
                            }
                        </style>
                    <?php } ?>
                <?php endwhile; ?>
            <?php else : ?>
                <?php // no rows found ?>
            <?php endif; ?>
        </div>
    <?php } ?>


    <?php if ( have_rows( 'content_blocks' ) ): ?>
        <?php while ( have_rows( 'content_blocks' ) ) : the_row(); ?>
            <?php if ( get_row_layout() == 'speaker_block' ) : ?>
                <section class="webinar-speaker-block bg-white background-white speakers-block speakers-block-module">
                    <div class="container">
                        <h3 class="webinar-subtitle"><?php echo get_sub_field( 'title' ); ?></h3>
                        <?php $count = count(get_sub_field('speaker')); ?>
                        <?php if ( have_rows( 'speaker' ) ) : ?>
                            <div class="speaker-container<?php if ($count > 1){ ?> multiple-speakers<?php } ?>">
                                <?php while ( have_rows( 'speaker' ) ) : the_row(); ?>                                
                                    <?php $post_object = get_sub_field( 'speaker' ); ?>
                                    <?php if ( $post_object ): ?>
                                        <?php $post = $post_object; ?>
                                        <?php setup_postdata( $post ); ?>
                                            <a class="speaker-popup" href="#speakerPopup-<?php echo $counter;?>">
                                                <span class="speaker one-quarter">
                                                    <span class="image-container">
                                                        <?php $speaker_image = get_field( 'speaker_image' ); ?>
                                                        <span class="bg-container<?php if ( $speaker_image ) { ?><?php } else { ?> no-background<?php } ?>">
                                                            <?php if ( $speaker_image ) { ?>
                                                                <img src="<?php echo $speaker_image['url']; ?>" alt="<?php echo $speaker_image['alt']; ?>" />
                                                                <span class="speaker-opacity"></span>
                                                            <?php } else { ?>
                                                                <?php $generic_headshot = get_field( 'generic_headshot', 'options' ); ?>
                                                                <?php if ( $generic_headshot ) { ?>
                                                                    <img src="<?php echo $generic_headshot['url']; ?>" alt="<?php echo $generic_headshot['alt']; ?>" />
                                                                <?php } ?>
                                                            <?php } ?>
                                                        </span>
                                                        <span class="border-offset"></span>
                                                        <?php
                                                            $title = get_the_title();
                                                            $titleWords = explode(" ", $title);
                                                        ?>
                                                        <span class="title-container"><?php echo $titleWords[0];?></br><?php echo $titleWords[1];?> <?php echo $titleWords[2];?><?php if( $titleWords[3]){ ?> <?php echo $titleWords[3];?><?php } ?> <?php if( $titleWords[4]){ ?> <?php echo $titleWords[4];?><?php } ?></span>
                                                    </span>
                                                    <span class="job-title"><?php echo get_field( 'job_title' ); ?></span>
                                                </span>
                                            </a>
                                            <div style="display: none;">
                                                <div class="speaker-popup-container" id="speakerPopup-<?php echo $counter;?>">
                                                    <div class="column white-bg image-column">
                                                        <?php $speaker_image = get_field( 'speaker_image' ); ?>
                                                        <span class="image-container">
                                                            <span class="bg-container">
                                                                <?php $speaker_image = get_field( 'speaker_image' ); ?>
                                                                <?php if ( $speaker_image ) { ?>
                                                                    <img src="<?php echo $speaker_image['url']; ?>" alt="<?php echo $speaker_image['alt']; ?>" />
                                                                <?php } else { ?>
                                                                    <?php $generic_headshot = get_field( 'generic_headshot', 'options' ); ?>
                                                                    <?php if ( $generic_headshot ) { ?>
                                                                        <img src="<?php echo $generic_headshot['url']; ?>" alt="<?php echo $generic_headshot['alt']; ?>" />
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            </span>
                                                            <span class="border-offset"></span>
                                                        </span>
                                                        <h3 class="title">
                                                            <?php the_title(); ?>
                                                            <?php if ( get_field('linkedin')) { ?>
                                                                <a class="linkedin-link" href="<?php the_field('linkedin');?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/round-linkedin.svg" width="20"/></a>
                                                            <?php } ?>
                                                        </h3>
                                                        <p class="job-title"><?php echo get_field( 'job_title' ); ?></p>
                                                        <?php $company_logo = get_field( 'company_logo' ); ?>
                                                        <?php if ( $company_logo ) { ?>
                                                            <span class="company-logo">
                                                            <img src="<?php echo $company_logo['url']; ?>" alt="<?php echo $company_logo['alt']; ?>" />
                                                        </span>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="column dark-bg about-column">
                                                        <?php if ( have_rows( 'agenda_items' ) ) : ?>
                                                            <div class="agenda-items">
                                                                <span class="agenda-content-title">Speaking</span>
                                                                <?php while ( have_rows( 'agenda_items' ) ) : the_row(); ?>
                                                                    <a class="agenda-item" href="<?php echo esc_url( home_url( '/' ) ); ?>agenda#<?php echo get_sub_field( 'agenda_link_id' ); ?>" targt="_self">
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
                                        <?php $counter++; ?>
                                        <?php wp_reset_postdata(); ?>
                                    <?php endif; ?>
                                <?php endwhile; ?>
                            </div>
                        <?php else : ?>
                            <?php // no rows found ?>
                        <?php endif; ?>
                        <div class="button-container">
                            <a class="std-button red-outline-button" href="<?php echo esc_url( home_url( '/' ) ); ?>speakers" target="_blank">View all Speakers</a>
                        </div>
                    </div>
                </section>
            <?php elseif ( get_row_layout() == 'centred_text' ) : ?>
                <section class="centred-text-module">
                    <div class="container">
                        <div class="inner">
                            <div class="content"><?php echo get_sub_field( 'text' ); ?></div>
                        </div>
                    </div>
                </section>			    
		    <?php endif; ?>
        <?php endwhile; ?>
    <?php else: ?>
        <?php // no layouts found ?>
    <?php endif; ?>
    <div class="webinar-mobile-sticky-footer">
        <span class="title">Register to Attend</span>
        <a class="registerButton register-scroll-button background-red" href="#registerForm">Register</a>
    </div>

</main>
<?php get_footer(); ?>
