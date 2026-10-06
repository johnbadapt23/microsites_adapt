<section class="video-introduction-partners background-black">
    <div class="container">
        <div class="text-container-inner">
            <span class="labelMedium text-red uppercase"><?php echo get_sub_field( 'pre_title' ); ?></span>
            <h2 class="white-text"><?php echo get_sub_field( 'title' ); ?></h2>
            <span class="text p-large white-text"><?php echo get_sub_field( 'pre_video_text' ); ?></span>
        </div>
        <div class="video-container">
            <?php $poster_image = get_sub_field( 'poster_image' ); ?>
            <?php if ( $poster_image ) { ?>
                <img class="video-poster" src="<?php echo esc_attr( $poster_image['url'] ); ?>" alt="<?php echo esc_attr( $poster_image['alt'] ); ?>" loading="lazy"/>
            <?php } ?>
           <iframe 
                src="https://player.vimeo.com/video/<?php echo esc_attr( get_sub_field('vimeo_code') ); ?>?autoplay=1&muted=1&controls=0&loop=1"
                frameborder="0"
                allow="autoplay; fullscreen"
                allowfullscreen
                class="vimeo-iframe"                
            ></iframe>
            <div class="video-overlay">
                <a class="video-play-btn"></a>
            </div>                       
        </div>
        <div class="text-container-inner">
            <span class="text p-small white-text"><?php echo get_sub_field( 'post_video_text' ); ?></span>
        </div>
    </div>
</section>
<script src="https://player.vimeo.com/api/player.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const overlay = document.querySelector(".video-overlay");
    const poster = document.querySelector(".video-poster");
    const iframe = document.querySelector(".vimeo-iframe");

    overlay.addEventListener("click", () => {
        // Hide overlay and poster
        overlay.style.display = "none";
        if (poster) poster.style.display = "none";

        // Reload iframe with unmuted and controls visible
        const vimeoID = "<?php echo get_sub_field('vimeo_code'); ?>";
        iframe.src = `https://player.vimeo.com/video/${vimeoID}?autoplay=1&muted=0&controls=1&loop=0`;
    });
});
</script>








