<?php

//current url
function current_url() {
	$url = 'http://'; //( 'on' == $_SERVER['HTTPS'] ) ? 'https://' : 'http://';
	$url .= $_SERVER['SERVER_NAME'];
	$url .= ( '80' == $_SERVER['SERVER_PORT'] ) ? '' : ':' . $_SERVER['SERVER_PORT'];
	$url .= $_SERVER['REQUEST_URI'];
	return trailingslashit( $url );
}


?>
