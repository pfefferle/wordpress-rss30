<?php
/**
 * Plugin Name: RSS 3.0
 * Plugin URI: https://github.com/pfefferle/wordpress-rss30
 * Description: A satire!
 * Author: Matthias Pfefferle
 * Author URI: https://notiz.blog
 * Version: 1.0.0
 * License: MIT
 * License URI: https://opensource.org/licenses/MIT
 * Text Domain: rss30
 * Update URI: https://github.com/pfefferle/wordpress-rss30
 */

register_activation_hook( __FILE__, 'rss30_flush_rewrite_rules' );
register_deactivation_hook( __FILE__, 'rss30_flush_rewrite_rules' );

/**
 * Init function
 */
function rss30_init() {
	add_filter( 'feed_content_type', 'rss30_feed_content_type', 10, 2 );
	add_feed( 'rss3', 'do_feed_rss30' );
	add_action( 'do_feed_rss30', 'do_feed_rss30', 10, 1 );
}
add_action( 'init', 'rss30_init' );

/**
 * Adds "rss3" content-type
 *
 * @param string $content_type the default content-type
 * @param string $type the feed-type
 *
 * @return string the as1 content-type
 */
function rss30_feed_content_type( $content_type, $type ) {
	if ( 'rss3' === $type ) {
		return 'text/plain';
	}

	return $content_type;
}

/**
 * Adds an rss30 json feed
 */
function do_feed_rss30( $for_comments ) {
	if ( ! $for_comments ) {
		// load post template
		load_template( dirname( __FILE__ ) . '/templates/feed-rss30.php' );
	}
}

/**
 * Reset rewrite rules
 */
function rss30_flush_rewrite_rules() {
	global $wp_rewrite;
	$wp_rewrite->flush_rules();
}
