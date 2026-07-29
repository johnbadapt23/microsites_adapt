<section class="why-become background-white">
	<div class="container">
		<div class="title-container">
            <h2 class="black-text red-bold">
                <?php echo get_sub_field( 'title' ); ?>
            </h2>			
		</div>
		<div class="why-become-container">
			<div class="why-become-image-container">
				<div class="why-become-image-inner">
					<?php if ( have_rows( 'switch_content' ) ) : ?>
						<?php $imagecounter=1;?>
						<?php while ( have_rows( 'switch_content' ) ) : the_row(); ?>
							<span class="why-become-image<?php if($imagecounter == 1){ ?> active<?php } ?>">
								<?php $image = get_sub_field( 'image' ); ?>
								<?php $vimeo = get_sub_field( 'vimeo_code' ); ?>
								<?php $vimeoPopup = get_sub_field( 'vimeo_popup' ); ?>	
								<span class="image-container">
									<span class="bg-container">
										 <?php if ( $vimeo ) : ?>
											<video 
												class="why-become-video" 
												poster="<?php echo esc_url( $image['url'] ); ?>" 
												autoplay 
												muted 
												loop 
												playsinline
											>
												<source src="<?php echo esc_url( $vimeo ); ?>" type="video/mp4">												
											</video>
											<span class="video-overlay"></span>
											<span class="video-controls">
												<a class="popup-vimeo" href="https://vimeo.com/<?php echo $vimeoPopup; ?>"><img class="mute" src="<?php echo get_template_directory_uri(); ?>/assets/images/expand.svg" width="64"/></a>
												<a href="#" class="video-toggle-sound" aria-label="Toggle sound">
													<span class="icon-sound-off">
														<img class="mute" src="<?php echo get_template_directory_uri(); ?>/assets/images/Muted.svg" width="64"/>
													</span>
													<span class="icon-sound-on" style="display:none;">
														<img class="unmute" src="<?php echo get_template_directory_uri(); ?>/assets/images/Unmuted.svg" width="64"/>
													</span>
												</a>
											</span>
										<?php elseif ( $image ) : ?>
											<img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" />
										<?php endif; ?>
									</span>
								</span>
							</span>
							<?php $imagecounter++;?>
						<?php endwhile; ?>
					<?php else : ?>
						<?php // no rows found ?>
					<?php endif; ?>
				</div>
			</div>
			<div class="why-become-text-column">
				<?php if ( have_rows( 'switch_content' ) ) : ?>
					<?php $counter=1;?>
					<?php while ( have_rows( 'switch_content' ) ) : the_row(); ?>
						<span class="why-become-text-container <?php if($counter == 1){ ?> active<?php } ?>">
							<span class="title"><?php echo get_sub_field( 'title' ); ?></span>
                            <span class="switch-content">
                                <?php $image = get_sub_field( 'image' ); ?>
                                <span class="image-container mobile">
                                    <span class="bg-container">
                                        <?php $vimeo = get_sub_field( 'vimeo_code' ); ?>
										<?php $vimeoPopup = get_sub_field( 'vimeo_popup' ); ?>										
										 <?php if ( $vimeo ) : ?>
											<video 
												class="why-become-video-mobile" 
												poster="<?php echo esc_url( $image['url'] ); ?>" 
												autoplay 
												muted 
												loop 
												playsinline
											>
												<source src="<?php echo esc_url( $vimeo ); ?>" type="video/mp4">												
											</video>
											<span class="video-overlay"></span>
											<span class="video-controls">
												<a class="popup-vimeo" href="https://vimeo.com/<?php echo $vimeoPopup; ?>"><img class="mute" src="<?php echo get_template_directory_uri(); ?>/assets/images/expand.svg" width="64"/></a>
												<a href="#" class="video-toggle-sound-mobile" aria-label="Toggle sound">
													<span class="icon-sound-off">
														<img class="mute" src="<?php echo get_template_directory_uri(); ?>/assets/images/Muted.svg" width="64"/>
													</span>
													<span class="icon-sound-on" style="display:none;">
														<img class="unmute" src="<?php echo get_template_directory_uri(); ?>/assets/images/Unmuted.svg" width="64"/>
													</span>
												</a>
											</span>
										<?php elseif ( $image ) : ?>
											<img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" />
										<?php endif; ?>
                                    </span>
                                </span>
                                <span class="text"><?php echo get_sub_field( 'text' ); ?></span>
                            </span>
						</span>
						<?php $counter++;?>
					<?php endwhile; ?>
				<?php else : ?>
					<?php // no rows found ?>
				<?php endif; ?>
			</div>

		</div>
	</div>
</section>