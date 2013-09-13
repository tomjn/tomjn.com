<?php
/**
 * tomjn functions and definitions
 *
 * @package tomjn
 * @since tomjn 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since tomjn 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

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

		/**
		 * This theme uses wp_nav_menu() in one location.
		 */
		register_nav_menus(
			array(
				'primary' => __( 'Primary Menu', 'tomjn' )
			)
		);

		/**
		 * Add support for the Aside Post Formats
		 */
		add_theme_support( 'post-formats', array( 'aside' ) );

		if ( function_exists( 'register_template' ) ) {
			register_template( 'panelcat', array( 'post_types' => array(), 'taxonomies' => array( 'category' ) ) );
			register_template( 'twin-column-pages', array( 'post_types' => array( 'page', 'post' ) ) );

			register_template_sidebar(
				'Top Sidebar',
				'panelcat',
				array(
					'description' => 'Just a test',
					'before_widget' => '<aside id="%1$s" class="widget %2$s">',
					'after_widget' => "</aside>\n",
					'before_title' => '<h3 class="widgettitle">',
					'after_title' => "</h3>\n"
				)
			);
			register_template_sidebar(
				'Top Sidebar',
				'twin-column-pages',
				array(
					'description' => 'Just a test',
					'before_widget' => '<aside id="%1$s" class="widget %2$s">',
					'after_widget' => "</aside>\n",
					'before_title' => '<h3 class="widgettitle">',
					'after_title' => "</h3>\n"
				)
			);
			register_template_sidebar(
				'Left Sidebar',
				'twin-column-pages',
				array(
					'description' => 'Just a test',
					'before_widget' => '<aside id="%1$s" class="widget %2$s">',
					'after_widget' => "</aside>\n",
					'before_title' => '<h3 class="widgettitle">',
					'after_title' => "</h3>\n"
				)
			);

			register_template_sidebar(
				'Right Sidebar',
				'twin-column-pages',
				array(
					'description' => 'This is another sidebar',
					'before_widget' => '<aside id="%1$s" class="widget %2$s">',
					'after_widget' => "</aside>\n",
					'before_title' => '<h3 class="widgettitle">',
					'after_title' => "</h3>\n"
				)
			);
		}
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
}
add_action( 'widgets_init', 'tomjnwidgets_init' );

/**
 * Enqueue scripts and styles
 */
function tomjnscripts() {
	global $post;

	wp_enqueue_style( 'style', get_stylesheet_uri(), array(), '2' );
	wp_enqueue_style( 'lessstyle', get_template_directory_uri().'/style.less',array(),'5' );

	wp_enqueue_script( 'small-menu', get_template_directory_uri() . '/js/small-menu.js', array( 'jquery' ), '20120206', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'tomjnscripts' );

function filter_ptags_on_images( $content ) {
	return preg_replace( '/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content );
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


function tomjn_typekit_code() {
	?>
	<script type="text/javascript">
	(function() {
		var config = {
			kitId: 'wtc2mfi',
			scriptTimeout: 3000
		};
		var h=document.getElementsByTagName("html")[0];h.className+=" wf-loading";var t=setTimeout(function(){h.className=h.className.replace(/(\s|^)wf-loading(\s|$)/g," ");h.className+=" wf-inactive"},config.scriptTimeout);var tk=document.createElement("script"),d=false;tk.src='//use.typekit.net/'+config.kitId+'.js';tk.type="text/javascript";tk.async="true";tk.onload=tk.onreadystatechange=function(){var a=this.readyState;if(d||a&&a!="complete"&&a!="loaded")return;d=true;clearTimeout(t);try{Typekit.load(config)}catch(b){}};var s=document.getElementsByTagName("script")[0];s.parentNode.insertBefore(tk,s)
	})();
	</script>
	<?php
}

add_action( 'wp_head', 'tomjn_typekit_code' );

add_filter( 'mce_external_plugins', 'tomjn_mce_external_plugins' );
function tomjn_mce_external_plugins( $plugin_array ) {
	$plugin_array['typekit'] = get_template_directory_uri().'/typekit.tinymce.js';
	return $plugin_array;
}

add_editor_style( 'editor-style.less' );


function add_favicon(){
	?><link rel="shortcut icon" type="image/png" href="<?php echo home_url(); ?>/favicon.png" /><?php
}
add_action( 'wp_head', 'add_favicon' );
add_action( 'admin_head', 'add_favicon' );


// Add Slideshare oEmbed
function add_oembed_slideshare(){
	wp_oembed_add_provider( 'http://www.slideshare.net/*', 'http://api.embed.ly/v1/api/oembed' );
}
add_action( 'init', 'add_oembed_slideshare' );

// Create a new filtering function that will add our where clause to the query
function password_post_filter( $where = '' ) {
	// Make sure this only applies to loops / feeds on the frontend
	if ( !is_single() && !is_page() && !is_admin() ) {
		// exclude password protected
		$where .= " AND post_password = ''";
	}
	return $where;
}
add_filter( 'posts_where', 'password_post_filter' );

if ( ! function_exists( 'shortcode_exists' ) ) {
	/**
	 * Check if a shortcode is registered in WordPress.
	 *
	 * Examples: shortcode_exists( 'caption' ) - will return true.
	 *           shortcode_exists( 'blah' )    - will return false.
	 */
	function shortcode_exists( $shortcode = false ) {
		global $shortcode_tags;

		if ( ! $shortcode )
			return false;

		if ( array_key_exists( $shortcode, $shortcode_tags ) )
			return true;

		return false;
	}
}

if ( function_exists( 'add_taxonomy_templating_support' ) ) {
	add_taxonomy_templating_support( 'category' );
}

function title_format() {
	return '%s';
}
add_filter( 'private_title_format', 'title_format' );
add_filter( 'protected_title_format', 'title_format' );


add_image_size( 'project-main', 512, 512, true );

