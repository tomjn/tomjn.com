<?php

/**
 * Enqueue scripts and styles
 */
function tomjnhttp2() {
	if (
		wp_doing_cron()
		|| defined( 'REST_REQUEST' )
		|| wp_doing_ajax()
		|| wp_is_xml_request()
		|| is_admin()
		|| is_feed()
	) {
		return;
	}
	$wordpress_version = get_bloginfo( 'version' );

	// hint to the browser to request a few extra things via http2
	header( 'Link: <https://www.googletagmanager.com/gtag/js?id=UA-6510359-3>; rel=preload; as=script', false );
	$icon_32  = get_site_icon_url( 32 );
	$icon_192 = get_site_icon_url( 192 );
	if ( ! empty( $icon_32 ) ) {
		header( 'Link: <' . esc_url( $icon_32 ) . '>; rel=preload; as=image', false );
	}
	if ( ! empty( $icon_192 ) ) {
		header( 'Link: <' . esc_url( $icon_192 ) . '>; rel=preload; as=image', false );
	}
	header( 'Link: <https://www.google-analytics.com/analytics.js>; rel=preload; as=script', false );
}
add_action( 'init','tomjnhttp2' );

function tomjn_font_preload() {
	$faces = [
		'700',
		'700italic',
		'italic',
		'regular',
	];
	foreach ( $faces  as $face ) {
		$font_url = get_template_directory_uri() . '/assets/merriweather/merriweather-v21-latin-' . $face . '.woff2';
		?>
		<link
			rel="preload"
			as="font"
			href="<?php echo esc_url( $font_url ); ?>"
			type="font/woff2"
			crossorigin="anonymous"
		/>
		<?php
	}
}
add_action( 'wp_head', 'tomjn_font_preload' );
