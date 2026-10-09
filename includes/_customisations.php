<?php

// custom_excerpt_link
function custom_excerpt_link($more){
    return '...';
}

// custom_excerpt_length
function custom_excerpt_length( $length ) {
	return 34;
}

// remove_style_type
function custom_remove_style_type($tag) {
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// remove_thumbnail_dimensions
function custom_remove_thumbnail_dimensions( $html ) {
    return preg_replace('/(width|height)=\"\d*\"\s/', '', $html);
}


// clean navigation
function custom_wp_nav_menu($var) {
  return is_array($var) ? array_intersect($var, array(
		'current_page_item',
		'current_page_parent',
		'current_page_ancestor',
		'menu-item-has-children',
		'first',
		'last',
		'vertical',
		'horizontal'
		)
	) : '';
}

function custom_nav_id_filter( $id, $item ) {
	//return strtolower( str_replace( ' ','-',$item->title ) );
}

function custom_add_parent_url_menu_class( $classes = array(), $item = false ) {
	$current_url = current_url();

	if( is_front_page() ) {
		return $classes;
	}

	if ( get_post_type() != 'post' &&  get_post_type() != 'page' ){
		//unset($classes[array_search('current_page_parent',$classes)]);
		if ( isset($item->url) )
			if ( strstr( $current_url, $item->url) )
				$classes[] = 'active';
	}

	return $classes;
}

// body classes
function custom_body_classs($classes) {
    global $post;
	$classes = array();

    if (is_home()) {
		array_push($classes, 'page');
		array_push($classes, 'blog');
		//array_push($classes, 'index-post');
    } else if ( is_singular( 'post' ) ) {
		array_push($classes, $post->post_type);
		array_push($classes, sanitize_html_class($post->post_name));
		//array_push($classes, 'single-post');
    } else {
		if($post) {
			array_push($classes, $post->post_type);
			array_push($classes, sanitize_html_class($post->post_name));
			if ( strstr(get_post_meta( $post->ID, '_wp_page_template', true ), '/') && !is_singular( 'post' ) ) {

				$value = explode('/', str_replace('.php', '', get_post_meta( $post->ID, '_wp_page_template', true )));
				if(isset($value)) {
					array_push($classes, $value[1]);
				}
			} else {
				array_push($classes, str_replace('.php', '', get_post_meta( $post->ID, '_wp_page_template', true )));
			}
		}
    }

    return $classes;
}

// querystring vars
function custom_add_query_vars_filter( $vars ){
	$vars[] = "type";
	$vars[] = "select";
	$vars[] = "id";
	return $vars;
}

// disable emojicons
function custom_disable_wp_emojicons() {
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

  //add_filter( 'tiny_mce_plugins', 'custom_disable_wp_emojicons' );
}

// disable wp embeds
function custom_disable_embeds() {

    // Remove the REST API endpoint.
    remove_action('rest_api_init', 'wp_oembed_register_route');
    remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
    remove_action('wp_head', 'wp_oembed_add_discovery_links');
    remove_action('wp_head', 'wp_oembed_add_host_js');
}

// remove admin menu items
function custom_remove_menus(){
  //remove_menu_page( 'index.php' );                  //Dashboard
  //remove_menu_page( 'edit.php' );                   //Posts
  //remove_menu_page( 'upload.php' );                 //Media
  //remove_menu_page( 'edit.php?post_type=page' );    //Pages
  remove_menu_page( 'edit-comments.php' );          //Comments
  //remove_menu_page( 'themes.php' );                 //Appearance
  //remove_menu_page( 'plugins.php' );                //Plugins
  //remove_menu_page( 'users.php' );                  //Users
  //remove_menu_page( 'tools.php' );                  //Tools
  //remove_menu_page( 'options-general.php' );        //Setting
}


// change logo on wp login
function custom_wp_login_logo() {
    echo '<style  type="text/css"> h1 a { display:block !important; width: 100% !important; height: 108px !important; background-size: 90% !important; background-image:url(' . esc_url( get_template_directory_uri() ) . '/assets/images/logo-admin.png)  !important; } </style>';
}

// change url on wp login
function custom_wp_login_url() {
    return get_option('siteurl');
}

 // change title on wp login
function custom_wp_login_title() {
    return get_option('blogname');
}

// change wp admin footer
function custom_footer_admin() {
    // echo '<span id="footer-thankyou">Developed by <a href="https://dotdev.com.au" target="_blank">DotDev</a></span>';
}

// remove wp version footer
function custom_remove_footer() {
    remove_filter( 'update_footer', 'core_update_footer' );
}

// disable json api
function custom_disable_json_api () {

  // 'json_enabled' / 'json_jsonp_enabled' (WP-API v1 plugin) and 'rest_enabled'
  // (ignored by core since WP 4.7) were removed: none of them had any effect.
  // JSONP support is still disabled:
  add_filter('rest_jsonp_enabled', '__return_false');

}

// remove rest api
function custom_remove_json_api () {
    // Remove the REST API lines from the HTML Header
    remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );

    // Remove the REST API endpoint.
    remove_action( 'rest_api_init', 'wp_oembed_register_route' );

    // Turn off oEmbed auto discovery.
    add_filter( 'embed_oembed_discover', '__return_false' );

    // Don't filter oEmbed results.
    remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );

    // Remove oEmbed discovery links.
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );

    // Remove oEmbed-specific JavaScript from the front-end and back-end.
    remove_action( 'wp_head', 'wp_oembed_add_host_js' );

	// Remove all embeds rewrite rules.
	//add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );

}
add_action('after_setup_theme', 	'custom_disable_json_api');
add_action('after_setup_theme', 	'custom_remove_json_api');

// acf google maps
function custom_acf_init() {
   acf_update_setting('google_api_key', 'AIzaSyCLcDOYGHRZ4Z09tMisM0g8lSSCAywnMPc');
}

add_action('acf/init', 'custom_acf_init');
