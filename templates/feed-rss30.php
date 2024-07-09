<?php
/**
 * RSS2 Feed Template for displaying RSS2 Posts feed.
 *
 * @package WordPress
 */

header( 'Content-Type: ' . feed_content_type( 'rss3' ) . '; charset=' . get_option( 'blog_charset' ), true );

do_action( 'rss_tag_pre', 'rss3' );
?>
title: <?php wp_title_rss(); ?><?php echo PHP_EOL; ?>
description: <?php wp_specialchars_decode( wp_strip_all_tags( bloginfo_rss( 'description' ) ) ); ?><?php echo PHP_EOL; ?>
link: <?php echo site_url( '/' ); ?><?php echo PHP_EOL; ?>
language: <?php bloginfo_rss( 'language' ); ?><?php echo PHP_EOL; ?>
creator: <?php echo site_url( '/' ); ?><?php echo PHP_EOL; ?>
guid: <?php echo site_url( '/' ); ?><?php echo PHP_EOL; ?>
generator: <?php echo esc_url_raw( 'https://wordpress.org/?v=' . get_bloginfo_rss( 'version' ) ); ?><?php echo PHP_EOL; ?>

<?php
/**
 * Fires at the end of the RSS3 Feed Header.
 */
do_action( 'rss3_head' );

while ( have_posts() ) :
	the_post();
	?>
title: <?php wp_specialchars_decode( the_title_rss() ); ?><?php echo PHP_EOL; ?>
link: <?php the_permalink_rss(); ?><?php echo PHP_EOL; ?>
description: <?php wp_specialchars_decode( wp_strip_all_tags( the_excerpt_rss() ) ); ?><?php echo PHP_EOL; ?>
date: <?php echo mysql2date( 'c', get_post_time( 'Y-m-d H:i:s', true ), false ); ?><?php echo PHP_EOL; ?>
creator: <?php the_author(); ?><?php echo PHP_EOL; ?>
<?php echo PHP_EOL; ?>
<?php
endwhile;
