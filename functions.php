<?php

// Includes
require('includes/_hooks.php');
require('includes/_setup.php');
require('includes/_head.php');
require('includes/_menu.php');
require('includes/_widgets.php');
require('includes/_shortcodes.php');
require('includes/_functions.php');
require('includes/_customisations.php');
require('includes/_instagram.php');


function cc_mime_types($mimes) {
$mimes['json'] = 'text/plain';
$mimes['svg'] = 'image/svg+xml';
return $mimes;
}


add_filter('upload_mimes', 'cc_mime_types');

function my_acf_init() {
	acf_update_setting('google_api_key', 'AIzaSyCLcDOYGHRZ4Z09tMisM0g8lSSCAywnMPc');
}

add_action('acf/init', 'my_acf_init');

/**
 * Join posts and postmeta tables
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_join
 */
function cf_search_join( $join ) {
    global $wpdb;

    if ( is_search() ) {
        $join .=' LEFT JOIN '.$wpdb->postmeta. ' ON '. $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
    }

    return $join;
}
add_filter('posts_join', 'cf_search_join' );

/**
 * Modify the search query with posts_where
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_where
 */
function cf_search_where( $where ) {
    global $pagenow, $wpdb;

    if ( is_search() ) {
        $where = preg_replace(
            "/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
            "(".$wpdb->posts.".post_title LIKE $1) OR (".$wpdb->postmeta.".meta_value LIKE $1)", $where );
    }

    return $where;
}
add_filter( 'posts_where', 'cf_search_where' );

/**
 * Prevent duplicates
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_distinct
 */
function cf_search_distinct( $where ) {
    global $wpdb;

    if ( is_search() ) {
        return "DISTINCT";
    }

    return $where;
}
add_filter( 'posts_distinct', 'cf_search_distinct' );

//Remove Gutenberg Block Library CSS from loading on the frontend
function smartwp_remove_wp_block_library_css(){
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'wc-blocks-style' ); // Remove WooCommerce block CSS



    wp_enqueue_style('child-style-file', get_stylesheet_directory_uri() . '/style.css');
} 
add_action( 'wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 100 );
add_filter('intermediate_image_sizes_advanced', function($sizes) {
    unset($sizes['thumbnail']);       // Removes 150x150
    unset($sizes['medium']);          // Removes 300x300
    unset($sizes['medium_large']);    // Removes 768x0
    unset($sizes['large']);           // Removes 1024x1024
    unset($sizes['1536x1536']);       // Removes 1536x1536
    unset($sizes['2048x2048']);       // Removes 2048x2048
    return $sizes;
});





add_filter('mce_external_plugins', function ($plugins) {
    $plugins['agenda_speaker_links'] = get_stylesheet_directory_uri() . '/assets/js/acf-agenda-links.js';
    return $plugins;
});

add_filter('acf/fields/wysiwyg/toolbars', function ($toolbars) {
    foreach ($toolbars as &$toolbar) {
        foreach ($toolbar as &$row) {
            if (!in_array('agenda_speaker_links', $row, true)) {
                $row[] = 'agenda_speaker_links';
            }
        }
    }

    return $toolbars;
});



