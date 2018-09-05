<?php
/**
 * tomjn functions and definitions
 *
 * @package tomjn
 * @since tomjn 1.0
 */

require_once( 'inc/attr.php' );
/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since tomjn 1.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'tomjnsetup' ) ) {
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

		$attr = editor_attr::instance();

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
		 * Enable support for Post Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );

		add_image_size( 'project-main', 512, 512, true );

		/**
		 * This theme uses wp_nav_menu() in one location.
		 */
		register_nav_menus(
			array(
				'primary' => __( 'Primary Menu', 'tomjn' ),
			)
		);

		/**
		 * Add support for the Aside Post Formats
		 */
		add_theme_support( 'post-formats', array( 'aside' ) );
	}
}
add_action( 'after_setup_theme', 'tomjnsetup' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since tomjn 1.0
 */
function tomjnwidgets_init() {
	register_sidebar(
		array(
			'name' => __( 'Sidebar', 'tomjn' ),
			'id' => 'sidebar-1',
			'before_widget' => '<aside id="%1$s" class="grid__item  one-whole  lap-one-half  desk-one-third widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h1 class="widget-title">',
			'after_title' => '</h1>',
		)
	);

	register_sidebar(
		array(
			'name' => __( 'Top Home', 'tomjn' ),
			'description' => __( 'A full width area at the top of the homepage', 'tomjn' ),
			'id' => 'sidebar-home-top',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h1 class="widget-title">',
			'after_title' => '</h1>',
		)
	);

	register_sidebar(
		array(
			'name' => __( 'Left Home', 'tomjn' ),
			'description' => __( 'A half width area on the left of the homepage, appears above the right hand on mobiles', 'tomjn' ),
			'id' => 'sidebar-home-left',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h1 class="widget-title">',
			'after_title' => '</h1>',
		)
	);

	register_sidebar(
		array(
			'name' => __( 'Right Home', 'tomjn' ),
			'description' => __( 'A half width area on the right of the homepage, appears below the left hand on mobiles', 'tomjn' ),
			'id' => 'sidebar-home-right',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h1 class="widget-title">',
			'after_title' => '</h1>',
		)
	);
}
add_action( 'widgets_init', 'tomjnwidgets_init' );

/**
 * Enqueue scripts and styles
 */
function tomjnscripts() {
	// hint to the browser to request a few extra things via http2
	header("Link: <".get_stylesheet_uri()."?ver=4>; rel=preload; as=style", false);
	header("Link: </wp-content/plugins/gutenberg/blocks/build/style.css>; rel=preload; as=style", false);
	header("Link: </wp-includes/js/jquery/jquery.js?ver=1.12.4>; rel=preload; as=script", false);
	header("Link: </wp-includes/js/jquery/jquery-migrate.min.js?ver=1.4.1>; rel=preload; as=script", false);
	header("Link: <https://use.typekit.net/wtc2mfi.js>; rel=preload; as=script", false);
	header("Link: <https://www.googletagmanager.com/gtag/js?id=UA-6510359-3>; rel=preload; as=script", false);
	header("Link: <https://tomjn.com/wp-content/uploads/2016/11/favicon.png>; rel=preload; as=image", false);
	header("Link: </wp-includes/js/wp-emoji-release.min.js?ver=4.9.8>; rel=preload; as=script", false);
	header("Link: </wp-includes/css/dashicons.min.css?ver=4.9.8>; rel=preload; as=style", false);
	header("Link: <https://stats.wp.com/e-201832.js>; rel=preload; as=script",false);
	header("Link: <https://www.google-analytics.com/analytics.js>; rel=preload; as=script",false);
	header("Link: <https://tomjn.com/wp-includes/js/wp-embed.min.js?ver=4.9.8>; rel=preload; as=script", false);

	// enqueue our styles
	wp_enqueue_style( 'style', get_stylesheet_uri(), array(), '4' );
	wp_enqueue_style( 'dashicons' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'tomjnscripts' );

function filter_ptags_on_images( $content ) {
	$content = preg_replace( '/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content );
	// and iframe tags too
	$content = preg_replace( '/<p>\s*(<a .*>)?\s*(<iframe .*><\/iframe>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content );
	return $content;
}
add_filter( 'the_content', 'filter_ptags_on_images' );


add_action( 'admin_head-upload.php', 'wpse_59182_bigger_media_thumbs' );
function wpse_59182_bigger_media_thumbs() {
	?>
	<script type="text/javascript">
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

if ( ! function_exists( 'tomjn_typekit_code' ) ) {
	function tomjn_typekit_code() {
		?>
		<script src="https://use.typekit.net/wtc2mfi.js"></script>
		<script >try{Typekit.load();}catch(e){}</script>
		<?php
	}
}
add_action( 'wp_head', 'tomjn_typekit_code' );

add_filter( 'mce_external_plugins', 'tomjn_mce_external_plugins' );
function tomjn_mce_external_plugins( $plugin_array ) {
	$plugin_array['typekit'] = get_template_directory_uri().'/typekit.tinymce.js';
	return $plugin_array;
}

add_editor_style( 'editor-style.css' );

// Add Slideshare oEmbed
function add_oembed_slideshare() {
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

function title_format() {
	return '%s';
}
add_filter( 'private_title_format', 'title_format' );
add_filter( 'protected_title_format', 'title_format' );



add_filter( 'wp_title', 'tomjn_hack_wp_title_for_home' );
function tomjn_hack_wp_title_for_home( $title ) {
	if ( empty( $title ) && ( is_home() || is_front_page() ) ) {
		return  get_bloginfo( 'name' );
	}
	return $title;
}


add_action( 'tomjn_footer_notes', 'tomjn_footer_notes' );
function tomjn_footer_notes() {
	?>
	<p>Content licensed as <a href="https://creativecommons.org/licenses/by-sa/3.0/" rel="license">cc-by-sa-3</a> with attribution required, <a href="https://twitter.com/tarendai" rel="me">twitter</a></p>
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

function tomjn_get_the_term_list( $id, $taxonomy, $before, $sep, $after ) {
	return get_the_term_list( $id, $taxonomy, $before, $sep, $after );
	$result = get_transient( 'tomjn_get_the_term_list_'.$id.'_'.$taxonomy );
	if ( false === $result ) {
		$result = get_the_term_list( $id, $taxonomy, $before, $sep, $after );
		if ( $result ) {
			set_transient( 'tomjn_get_the_term_list_'.$id.'_'.$taxonomy , $result, 60 * 60 * 24 );
		}
	}
	return $result;
}
