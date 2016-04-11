<?php
/*
 Plugin Name: Blockquote attribute style
 Plugin URI: http://www.interconnectit.com
 Description: Plugin Description
 Version: 1.0
 Author: Tom J Nowell
 Author URI: http://www.interconnectit.com
*/

if ( ! class_exists( 'editor_attr' ) ) {
	class editor_attr {
		/**
		 * @var object self
		 */
		protected static $instance = null;

		public function __construct() {
			add_filter( 'mce_buttons_2', array( $this, 'my_mce_buttons_2' ) );
			add_filter( 'tiny_mce_before_init', array( $this, 'my_mce_before_init' ) );
		}

		/*
		 * Custom styles for tiny mce
		 * HT: http://alisothegeek.com/2011/05/tinymce-styles-dropdown-wordpress-visual-editor/
		 */
		function my_mce_buttons_2( $buttons ) {
			array_unshift( $buttons, 'styleselect' );
			return $buttons;
		}

		function my_mce_before_init( $settings ) {
		    $style_formats = array(
				array(
					'title' => 'Blockquote Attribution',
					'selector' => 'blockquote p',
					'classes' => 'attribute'
				),
				array(
					'title' => 'Pull Blockquote',
					'selector' => 'blockquote',
					'classes' => 'pullquote'
				)
			);
			$settings[ 'style_formats' ] = wp_json_encode( $style_formats );
			return $settings;
		}

		public static function instance( ) {
			null === self::$instance && self::$instance = new self;
			return self::$instance;
		}
	}
}
