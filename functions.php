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

if ( ! function_exists( 'tomjnsetup' ) ):
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
	require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * Custom functions that act independently of the theme templates
	 */
	//require( get_template_directory() . '/inc/tweaks.php' );

	/**
	 * Custom Theme Options
	 */
	//require( get_template_directory() . '/inc/theme-options/theme-options.php' );

	/**
	 * WordPress.com-specific functions and definitions
	 */
	//require( get_template_directory() . '/inc/wpcom.php' );

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
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'tomjn' ),
	) );

	/**
	 * Add support for the Aside Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', ) );

	if(function_exists('register_template')){

		register_template( 'twin-column-pages', array( 'post_types' => array( 'page' ) ) );

		register_template_sidebar( 'Left Sidebar', 'twin-column-pages', array(
														'description' => 'Just a test',
														'before_widget' => '<aside id="%1$s" class="widget %2$s">',
														'after_widget' => "</aside>\n",
														'before_title' => '<h3 class="widgettitle">',
														'after_title' => "</h3>\n"
													) );

		register_template_sidebar( 'Right Sidebar', 'twin-column-pages', array(
														'description' => 'This is another sidebar',
														'before_widget' => '<aside id="%1$s" class="widget %2$s">',
														'after_widget' => "</aside>\n",
														'before_title' => '<h3 class="widgettitle">',
														'after_title' => "</h3>\n"
													) );
	}
}
endif; // tomjnsetup
add_action( 'after_setup_theme', 'tomjnsetup' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since tomjn 1.0
 */
function tomjnwidgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar', 'tomjn' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
}
add_action( 'widgets_init', 'tomjnwidgets_init' );

/**
 * Enqueue scripts and styles
 */
function tomjnscripts() {
	global $post;

	wp_enqueue_style( 'style', get_stylesheet_uri() );
	wp_enqueue_style( 'lessstyle', get_template_directory_uri().'/style.less',array(),'4.21' );

	wp_enqueue_script( 'small-menu', get_template_directory_uri() . '/js/small-menu.js', array( 'jquery' ), '20120206', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image( $post->ID ) ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'tomjnscripts' );

/**
 * Implement the Custom Header feature
 */
//require( get_template_directory() . '/inc/custom-header.php' );

function filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

add_filter('the_content', 'filter_ptags_on_images');


add_action( 'admin_head-upload.php', 'wpse_59182_bigger_media_thumbs' );

function wpse_59182_bigger_media_thumbs() 
{
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


function tomjn_typekit_code(){
?>
<script type="text/javascript" src="//use.typekit.net/wtc2mfi.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
<?php /*
<script type="text/javascript" id="typekit_embed_code">
  (function() {
    var config = {
      kitId: 'wtc2mfi',
      scriptTimeout: 3000
    };
    var h=document.getElementsByTagName("html")[0];h.className+=" wf-loading";var t=setTimeout(function(){h.className=h.className.replace(/( |^)wf-loading( |$)/g,"");h.className+=" wf-inactive"},config.scriptTimeout);var tk=document.createElement("script");tk.src='//use.typekit.net/'+config.kitId+'.js';tk.type="text/javascript";tk.async="true";tk.onload=tk.onreadystatechange=function(){var a=this.readyState;if(a&&a!="complete"&&a!="loaded")return;clearTimeout(t);try{Typekit.load(config)}catch(b){}};var s=document.getElementsByTagName("script")[0];s.parentNode.insertBefore(tk,s)
  })();
</script>
<?php*/
}
//add_action('admin_head','tomjn_typekit_code');
add_action('wp_head','tomjn_typekit_code');

add_filter("mce_external_plugins", "tomjn_mce_external_plugins");
function tomjn_mce_external_plugins($plugin_array){
	$plugin_array['typekit']  =  get_template_directory_uri().'/typekit.tinymce.js';//('/ilc-syntax-buttons/ilcsyntax.js');
    return $plugin_array;
}


function ex_rewrite( $wp_rewrite ) {

    add_rewrite_rule('preview/([0-9]{1,})/?$','index.php?preview=true&page_id=$matches[1]','top');

/*    $feed_rules = array(
        'preview/([0-9]{1,})/?$'    =>  'index.php?page_id=$1&preview=true'
    );*/

//    $wp_rewrite->rules = $feed_rules + $wp_rewrite->rules;
    return $wp_rewrite;
}
// refresh/flush permalinks in the dashboard if this is changed in any way
add_filter( 'generate_rewrite_rules', 'ex_rewrite' );

add_editor_style( 'editor-style.less' );


function add_favicon(){
	?><link rel="icon" type="image/png" href="<?php echo home_url(); ?>/favicon.png" /><?php
}
add_action('wp_head','add_favicon');
add_action('admin_head','add_favicon');