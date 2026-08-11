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
 * Each site's display name comes straight from its own Site Title
 * (Settings > General > Site Title, the 'blogname' option) via
 * switch_to_blog(), not get_blog_details()'s cached copy - so renaming a
 * site's title is reflected here without any extra step.
 *
 * The (name, url) list is cached ONCE for the whole network via a site
 * transient, not per-site - every site's footer reads the same shared
 * cache. This matters: renaming Site A's title only fires WordPress hooks
 * in Site A's own request context, so a per-site cache on Site B would
 * never get told to refresh and would keep serving Site A's old name
 * indefinitely. A single shared cache means one flush (from wherever the
 * change happened) fixes it everywhere. "Which one is the current site"
 * is deliberately NOT part of the cached data - it's computed fresh on
 * every call from get_current_blog_id(), which is free and always
 * correct regardless of cache age.
 *
 * The network's main site (the Network Admin site) is excluded entirely -
 * it's not a public-facing microsite, so it shouldn't be reachable from a
 * footer link.
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

	$microsites = get_site_transient( 'adapt_network_microsites' );

	if ( false === $microsites ) {
		$sites = get_sites( array(
			'public'   => 1,
			'archived' => 0,
			'deleted'  => 0,
			'spam'     => 0,
			'number'   => 0, // no limit - return every matching site
		) );

		$microsites = array();

		foreach ( $sites as $site ) {
			// Skip the network's main site - that's the Network Admin
			// site, not a public-facing microsite, and visitors shouldn't
			// be able to land on it from a footer link.
			if ( is_main_site( $site->blog_id ) ) {
				continue;
			}

			// Explicitly switch and read the 'blogname' option (Settings >
			// General > Site Title for that site) rather than trusting
			// get_blog_details()'s cache, which can lag behind if a
			// persistent object cache is in play - this always reflects
			// the live title.
			switch_to_blog( $site->blog_id );
			$site_title = get_option( 'blogname' );
			$site_url   = get_option( 'siteurl' );
			restore_current_blog();

			if ( '' === trim( (string) $site_title ) ) {
				continue;
			}

			$microsites[] = array(
				'id'   => (int) $site->blog_id,
				'name' => $site_title,
				'url'  => $site_url,
			);
		}

		// Alphabetical, so the list doesn't just reflect network creation order.
		usort( $microsites, function ( $a, $b ) {
			return strcasecmp( $a['name'], $b['name'] );
		} );

		set_site_transient( 'adapt_network_microsites', $microsites, 12 * HOUR_IN_SECONDS );
	}

	// Computed per-request, not cached: correct regardless of which site
	// built (or last refreshed) the shared cache above.
	$current_blog_id = get_current_blog_id();
	foreach ( $microsites as &$site ) {
		$site['is_current'] = ( $site['id'] === $current_blog_id );
	}
	unset( $site );

	return $microsites;
}

/**
 * Keep the cached list honest - clear it on anything that could change
 * network membership or a site's name/URL, rather than waiting 12 hours.
 * Uses delete_site_transient() (network-wide) to match the network-wide
 * cache above - a change on any one site correctly busts the single
 * shared cache every site's footer reads from.
 */
function adapt_flush_network_microsites_cache() {
	delete_site_transient( 'adapt_network_microsites' );
}
add_action( 'wp_initialize_site', 'adapt_flush_network_microsites_cache' );
add_action( 'wp_delete_site', 'adapt_flush_network_microsites_cache' );
add_action( 'make_spam_blog', 'adapt_flush_network_microsites_cache' );
add_action( 'make_ham_blog', 'adapt_flush_network_microsites_cache' );
add_action( 'archive_blog', 'adapt_flush_network_microsites_cache' );
add_action( 'unarchive_blog', 'adapt_flush_network_microsites_cache' );
add_action( 'update_blog_details', 'adapt_flush_network_microsites_cache' );
// update_blog_details() covers the wp_blogs row itself (domain/path/etc.)
// but not a site's own 'blogname' option - that's a per-site option update,
// so it needs its own hook, fired on whichever site the rename happens on.
add_action( 'update_option_blogname', 'adapt_flush_network_microsites_cache' );
