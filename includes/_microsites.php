<?php

/**
 * Network microsites directory.
 *
 * This theme runs on a WordPress Multisite network - every "microsite"
 * (CIO Edge, Security Edge, People Edge, etc.) is a separate site in the
 * same network/database, not a standalone install. WordPress already knows
 * the full list via get_sites() - nothing here needed to talk to an
 * external source, it just wasn't being used on the front end yet.
 *
 * Result is cached in a transient so a plain footer render doesn't run a
 * network-wide site query (plus one get_blog_details() call per site) on
 * every single page load. The cache is cleared automatically whenever a
 * site is added, deleted, archived/unarchived, or its details change, so
 * editors don't have to wait out the cache lifetime to see updates.
 */

/**
 * All public, non-archived, non-spam, non-deleted sites in the network.
 *
 * @return array<int, array{id:int, name:string, url:string, is_current:bool}>
 */
function adapt_get_network_microsites() {
	if ( ! is_multisite() ) {
		return array();
	}

	$cached = get_transient( 'adapt_network_microsites' );
	if ( false !== $cached ) {
		return $cached;
	}

	$sites = get_sites( array(
		'public'   => 1,
		'archived' => 0,
		'deleted'  => 0,
		'spam'     => 0,
		'number'   => 0, // no limit - return every matching site
	) );

	$current_blog_id = get_current_blog_id();
	$microsites       = array();

	foreach ( $sites as $site ) {
		$details = get_blog_details( $site->blog_id );
		if ( ! $details || '' === trim( $details->blogname ) ) {
			continue;
		}

		$microsites[] = array(
			'id'         => (int) $site->blog_id,
			'name'       => $details->blogname,
			'url'        => $details->siteurl,
			'is_current' => ( (int) $site->blog_id === $current_blog_id ),
		);
	}

	// Alphabetical, so the list doesn't just reflect network creation order.
	usort( $microsites, function ( $a, $b ) {
		return strcasecmp( $a['name'], $b['name'] );
	} );

	set_transient( 'adapt_network_microsites', $microsites, 12 * HOUR_IN_SECONDS );

	return $microsites;
}

/**
 * Keep the cached list honest - clear it on anything that could change
 * network membership or a site's name/URL, rather than waiting 12 hours.
 */
function adapt_flush_network_microsites_cache() {
	// delete_transient() is a no-op (and safe) on a site where it wasn't
	// set, so this doesn't need an is_multisite() guard.
	delete_transient( 'adapt_network_microsites' );
}
add_action( 'wp_initialize_site', 'adapt_flush_network_microsites_cache' );
add_action( 'wp_delete_site', 'adapt_flush_network_microsites_cache' );
add_action( 'make_spam_blog', 'adapt_flush_network_microsites_cache' );
add_action( 'make_ham_blog', 'adapt_flush_network_microsites_cache' );
add_action( 'archive_blog', 'adapt_flush_network_microsites_cache' );
add_action( 'unarchive_blog', 'adapt_flush_network_microsites_cache' );
add_action( 'update_blog_details', 'adapt_flush_network_microsites_cache' );
