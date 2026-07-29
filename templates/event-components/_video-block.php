<section class="video-module <?php if (get_sub_field( 'background_colour' )){ ?><?php echo get_sub_field( 'background_colour' ); ?><?php } else { ?>background-black<?php } ?>">
	<div class="container">
		<div class="image-video-container">
            <div class="video-image-inner">
                <?php if (get_sub_field( 'auto_play_video' )) { ?>
                    <div class="video-container">
                        <div class="bg-container">
                            <?php $image = get_sub_field('poster_image'); ?>
                            <video width="100%" autoplay loop muted playsinline poster="<?php echo $image['url']; ?>">
                                <source type="video/mp4" src="<?php echo get_sub_field( 'auto_play_video' ); ?>" />
                            </video>
                            <?php if( get_sub_field( 'vimeo_code' )) { ?>
                                <span class="opacity-overlay"></span>
                                <a class="popup-vimeo" href="https://vimeo.com/<?php echo get_sub_field('vimeo_code'); ?>"></a>
                            <?php } ?>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="image-container">
                        <div class="bg-container">
                            <?php $image = get_sub_field('poster_image'); ?>
                            <img class="desktop" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
                            <?php if( get_sub_field( 'vimeo_code' )) { ?>
                                <span class="opacity-overlay"></span>
                                <a class="popup-vimeo" href="https://vimeo.com/<?php echo get_sub_field('vimeo_code'); ?>"></a>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
	</div>
</section>
