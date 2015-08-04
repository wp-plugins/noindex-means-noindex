<?php
/**
 * Plugin Name: Noindex Means Noindex
 * Description: Detects noindexed Posts and Pages (via Yoast SEO or Genesis SEO) and removes them from search results and archives on your website.
 * Author: Carlo Manf
 * Author URI: http://carlomanf.id.au
 * Version: 1.0.0
 */

// Exclude noindex posts from all non-singular loops
add_filter( 'pre_get_posts', function( $query ) {

	if ( !$query->is_singular() && !is_admin() )
		$query->set( 'meta_query', array(
			array( 'key' => '_yoast_wpseo_meta-robots-noindex', 'compare' => 'NOT EXISTS' ),
			array( 'key' => '_genesis_noindex', 'compare' => 'NOT EXISTS' )
		) );

	return $query;

} );
