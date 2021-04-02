<?php
/**
 * tomjn functions and definitions
 *
 * @package tomjn
 * @since tomjn 1.0
 */

require_once 'inc/http2.php';
require_once 'inc/remove-emoji.php';

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since tomjn 1.0
 */
if ( ! isset( $content_width ) ) {
	// this is the max width of a paragraph tag
	$content_width = 800; /* pixels */
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since tomjn 1.0
 */
function tomjnsetup() {

	/**
	 * Custom template tags for this theme.
	 */
	require_once( get_template_directory() . '/inc/template-tags.php' );

	remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds
	remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // prev link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // start link
	remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); // Display relational links for the posts adjacent to the current post.
	remove_action( 'wp_head', 'wp_generator' ); // Display the XHTML generator that is generated on the wp_head hook, WP version

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on tomjn, use a find and replace
	 * to change 'tomjn' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'tomjn', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Let WP handle the title tag
	 **/
	add_theme_support( 'title-tag' );

	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'project-main', 512, 512, true );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( [
		'primary' => __( 'Primary Menu', 'tomjn' ),
	] );

	/**
	 * Add support for the Aside Post Formats
	 */
	add_theme_support( 'post-formats', [ 'aside' ] );
}
add_action( 'after_setup_theme', 'tomjnsetup' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since tomjn 1.0
 */
function tomjnwidgets_init() {
	register_sidebar( [
		'name'          => __( 'Sidebar', 'tomjn' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="column is-third widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	] );

	register_sidebar( [
		'name'          => __( 'Top Home', 'tomjn' ),
		'description'   => __( 'A full width area at the top of the homepage', 'tomjn' ),
		'id'            => 'sidebar-home-top',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	] );

	register_sidebar( [
		'name'          => __( 'Left Home', 'tomjn' ),
		'description'   => __( 'A half width area on the left of the homepage, appears above the right hand on mobiles', 'tomjn' ),
		'id'            => 'sidebar-home-left',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	] );

	register_sidebar( [
		'name'          => __( 'Right Home', 'tomjn' ),
		'description'   => __( 'A half width area on the right of the homepage, appears below the left hand on mobiles', 'tomjn' ),
		'id'            => 'sidebar-home-right',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	] );
}
add_action( 'widgets_init', 'tomjnwidgets_init' );

function tomjn_deregister_scripts() {
	wp_dequeue_script( 'wp-embed' );
}
add_action( 'wp_footer', 'tomjn_deregister_scripts' );

function tomjnscripts() : void {

	// Enqueue our styles.
	wp_enqueue_style( 'tomjn-scss', get_template_directory_uri() . '/assets/dist/frontend.css', [], '8' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'tomjnscripts' );

function filter_ptags_on_images( string $content ) : string {
	$content = preg_replace( '/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content );
	// and iframe tags too
	$content = preg_replace( '/<p>\s*(<a .*>)?\s*(<iframe .*><\/iframe>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content );
	return $content;
}
add_filter( 'the_content', 'filter_ptags_on_images' );

add_action( 'admin_head-upload.php', 'wpse_59182_bigger_media_thumbs' );

function wpse_59182_bigger_media_thumbs() : void {
	?>
	<script>
		jQuery(document).ready( function($) {
			$('img').each(function(){
				$(this).removeAttr('width').css('max-width','100%');
				$(this).removeAttr('height').css('max-height','100%');
			});
			$('.column-icon').css('width', '130px');
		});
	</script>
	<?php
}

add_editor_style( 'editor-style.css' );

function site_block_editor_styles() : void {
	wp_enqueue_style( 'site-block-editor-styles-scss', get_theme_file_uri( '/assets/dist/editor.css' ), false, '1.0', 'all' );
}
//add_action( 'enqueue_block_editor_assets', 'site_block_editor_styles' );

// Add Slideshare oEmbed
function add_oembed_slideshare() : void {
	wp_oembed_add_provider( 'http://www.slideshare.net/*', 'http://api.embed.ly/v1/api/oembed' );
	wp_oembed_add_provider( 'https://www.slideshare.net/*', 'http://api.embed.ly/v1/api/oembed' );
}
add_action( 'init', 'add_oembed_slideshare' );

// Create a new filtering function that will add our where clause to the query
function password_post_filter( $where = '' ) {
	// Make sure this only applies to loops / feeds on the frontend
	if ( ! is_single() && ! is_page() && ! is_admin() ) {
		// exclude password protected
		$where .= " AND post_password = ''";
	}
	return $where;
}
add_filter( 'posts_where', 'password_post_filter' );

function title_format() : string {
	return '%s';
}

add_filter( 'private_title_format', 'title_format' );
add_filter( 'protected_title_format', 'title_format' );

add_filter( 'wp_title', 'tomjn_hack_wp_title_for_home' );

function tomjn_hack_wp_title_for_home( $title ) : string {
	if ( empty( $title ) && ( is_home() || is_front_page() ) ) {
		return  get_bloginfo( 'name' );
	}
	return $title;
}

add_action( 'tomjn_footer_notes', 'tomjn_footer_notes' );
function tomjn_footer_notes() : void {
	?>
	<p>Content licensed as <a href="https://creativecommons.org/licenses/by-sa/3.0/" rel="licensei noreferrer noopener">cc-by-sa-3</a> with attribution required, <a href="https://twitter.com/tarendai" rel="me noreferrer noopener">twitter</a></p>
	<?php
}

function _tomjn_home_cancel_query( $query, \WP_Query $q ) {
	if ( ! $q->is_admin() && ! $q->is_feed() && $q->is_home() && $q->is_main_query() ) {
		$query = false;
		$q->set( 'fields', 'ids' );
	}
	return $query;
}
add_filter( 'posts_request', '_tomjn_home_cancel_query', 100, 2 );
