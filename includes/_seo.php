<?php

/**
 * SEO fundamentals: meta description, Open Graph / Twitter Card tags, and
 * base site-wide structured data (Organization + WebSite JSON-LD).
 *
 * This theme has no SEO plugin (no Yoast/RankMath hooks anywhere in it) -
 * these are the basics that were entirely missing before: no meta
 * description, no OG/Twitter tags, and canonical URLs were actively
 * disabled (see includes/_hooks.php). The one-off manual schema field
 * (get_field('site_schema_code', 'options')) already in header.php still
 * works alongside this - this just adds the defaults that should always be
 * present regardless of whether that field is filled in.
 */

/**
 * Build a plain-text meta description for the current request.
 */
function adapt_seo_meta_description() {
	$description = '';

	if ( is_singular() ) {
		global $post;
		if ( $post && has_excerpt( $post ) ) {
			$description = get_the_excerpt( $post );
		} elseif ( $post ) {
			$description = wp_strip_all_tags( strip_shortcodes( $post->post_content ) );
		}
	} elseif ( is_category() || is_tag() || is_tax() ) {
		$description = term_description();
	}

	if ( empty( $description ) ) {
		$description = get_bloginfo( 'description' );
	}

	$description = wp_strip_all_tags( $description );
	$description = trim( preg_replace( '/\s+/', ' ', $description ) );

	if ( '' === $description ) {
		return '';
	}

	// Keep it close to the ~155-160 char length search engines actually show.
	if ( mb_strlen( $description ) > 160 ) {
		$description = mb_substr( $description, 0, 157 ) . '...';
	}

	return $description;
}

/**
 * Best available image for OG/Twitter cards: featured image if the current
 * page has one, otherwise null (better to omit the tag than send a
 * semantically wrong image - there's no purpose-built social share image in
 * assets/images/ to fall back to yet).
 */
function adapt_seo_social_image() {
	if ( is_singular() && has_post_thumbnail() ) {
		$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
		if ( $image ) {
			return $image[0];
		}
	}

	// Site-wide fallback: set an "Options > Default social share image" ACF
	// field if you add one later; this just no-ops until it exists.
	if ( function_exists( 'get_field' ) ) {
		$default = get_field( 'default_social_image', 'options' );
		if ( $default ) {
			return is_array( $default ) ? ( $default['url'] ?? null ) : $default;
		}
	}

	return null;
}

function adapt_seo_current_url() {
	global $wp;
	return home_url( add_query_arg( array(), $wp->request ) );
}

function adapt_seo_head_tags() {
	$description = adapt_seo_meta_description();
	$site_name   = get_bloginfo( 'name' );
	$title       = wp_get_document_title();
	$url         = adapt_seo_current_url();
	$image       = adapt_seo_social_image();

	if ( $description ) {
		printf( '<meta name="description" content="%s">' . "\n", esc_attr( $description ) );
	}

	echo '<meta property="og:type" content="' . ( is_singular( 'post' ) ? 'article' : 'website' ) . '">' . "\n";
	printf( '<meta property="og:title" content="%s">' . "\n", esc_attr( $title ) );
	printf( '<meta property="og:site_name" content="%s">' . "\n", esc_attr( $site_name ) );
	printf( '<meta property="og:url" content="%s">' . "\n", esc_url( $url ) );
	if ( $description ) {
		printf( '<meta property="og:description" content="%s">' . "\n", esc_attr( $description ) );
	}
	if ( $image ) {
		printf( '<meta property="og:image" content="%s">' . "\n", esc_url( $image ) );
	}

	echo '<meta name="twitter:card" content="' . ( $image ? 'summary_large_image' : 'summary' ) . '">' . "\n";
	printf( '<meta name="twitter:title" content="%s">' . "\n", esc_attr( $title ) );
	if ( $description ) {
		printf( '<meta name="twitter:description" content="%s">' . "\n", esc_attr( $description ) );
	}
	if ( $image ) {
		printf( '<meta name="twitter:image" content="%s">' . "\n", esc_url( $image ) );
	}
}

/**
 * Base Organization + WebSite JSON-LD, output once site-wide. Page-specific
 * schema (events, articles, etc.) should still use the existing
 * site_schema_code / per-template ACF fields - this only covers the
 * defaults every page should have regardless.
 */
function adapt_seo_json_ld() {
	$schema = array(
		'@context' => 'https://schema.org',
		'@graph'   => array(
			array(
				'@type' => 'Organization',
				'name'  => get_bloginfo( 'name' ),
				'url'   => home_url( '/' ),
				'logo'  => get_template_directory_uri() . '/assets/images/logo.svg',
			),
			array(
				'@type' => 'WebSite',
				'name'  => get_bloginfo( 'name' ),
				'url'   => home_url( '/' ),
			),
		),
	);

	echo '<script type="application/ld+json">' . wp_json_encode( $schema ) . '</script>' . "\n";
}
