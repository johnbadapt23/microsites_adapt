<?php

/**
 * Theme stylesheets and scripts, loaded the WordPress way (wp_enqueue_*)
 * instead of hard-coded tags in header.php / footer.php.
 *
 * Load order is deliberately the same as the old hard-coded tags:
 * - Styles are enqueued at priority 1, so they print before any plugin
 *   stylesheet, exactly as when they sat above wp_head(). style.css is still
 *   enqueued afterwards (priority 100, functions.php), so the cascade is
 *   unchanged.
 * - main.min.js is enqueued from wp_footer at priority 19, just before
 *   WordPress prints footer scripts (priority 20), so it remains the last
 *   deferred script on the page, as it was when it sat after wp_footer().
 *
 * The 'strategy' => 'defer' argument needs WordPress 6.3 or later.
 */

// theme_styles
function theme_styles() {
	$theme_uri = get_template_directory_uri();

	wp_enqueue_style( 'adapt-main', $theme_uri . '/assets/css/main.min.css', array(), '1.17' );
	wp_enqueue_style( 'adapt-skelet-icons', $theme_uri . '/assets/fonts/skelet-icons-master/style.css', array(), null );
	wp_enqueue_style( 'adapt-google-fonts', 'https://fonts.googleapis.com/css2?family=PT+Sans+Caption&display=swap', array(), null );

	// lottie-interactivity depends on lottie-player being defined first; defer
	// keeps that execution order without blocking HTML parsing.
	wp_enqueue_script( 'lottie-player', 'https://unpkg.com/@lottiefiles/lottie-player@2.0.12/dist/lottie-player.js', array(), null, array( 'strategy' => 'defer', 'in_footer' => false ) );
	wp_enqueue_script( 'lottie-interactivity', 'https://unpkg.com/@lottiefiles/lottie-interactivity@1.6.2/dist/lottie-interactivity.min.js', array( 'lottie-player' ), null, array( 'strategy' => 'defer', 'in_footer' => false ) );
}

// theme_scripts
function theme_scripts() {
	// jQuery is bundled into main.min.js (see source/gulp/paths.js).
	wp_enqueue_script( 'adapt-main', get_template_directory_uri() . '/assets/js/main.min.js', array(), '1.7', array( 'strategy' => 'defer', 'in_footer' => true ) );
}
