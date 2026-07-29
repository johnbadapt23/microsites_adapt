<?php

// theme_setup
function theme_setup() {

	// date_default_timezone_set('Australia/Melbourne');

	add_editor_style();
	add_theme_support( 'menus' );
	add_theme_support( 'post-thumbnails' );
	// Lets WordPress core render the <title> tag itself (via wp_head), with
	// proper "Page Title – Site Name" formatting. header.php used to call
	// the legacy wp_title() directly instead, which by default outputs just
	// the page title with no site name - worse for branding/CTR in search
	// results. Also required so the manual <title> tag isn't duplicated.
	add_theme_support( 'title-tag' );

	if ( function_exists('acf_add_options_page') ) {
    	acf_add_options_page();
    }
}

?>
