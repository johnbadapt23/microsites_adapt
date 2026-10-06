<?php


// custom
function shortcode_custom( $atts, $content = '' ) {
	$class = isset( $atts['class'] ) ? esc_attr( $atts['class'] ) : '';
	return "<p class='{$class}'>{$content}</p>";
}
// add_shortcode( 'custom', 'shortcode_custom' );

?>
