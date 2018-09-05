<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package _s
 * @since _s 1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php echo esc_attr( get_bloginfo( 'charset' ) ); ?>" />
	<meta name="viewport" content="width=device-width" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div id="page" class="hfeed site">
		<?php do_action( 'before' ); ?>
		<header id="masthead" class="site-header">
			<div class="header-contents">
				<hgroup>
					<h1 class="site-title">
						<a class="h-card" rel="me" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
							<?php echo esc_html( get_bloginfo( 'name', 'display' ) ); ?>
						</a>
					</h1>
					<?php
					$description = get_bloginfo( 'description' );
					if ( !empty( $description) ) {
						?>
						<h2 class="site-description"><?php echo esc_html( $description ); ?></h2>
						<?php
					}
					?>
				</hgroup>

				<nav class="site-navigation main-navigation">
					<h1 class="assistive-text"><?php esc_html_e( 'Menu', 'tomjn' ); ?></h1>
					<div class="assistive-text skip-link">
						<a href="#content" title="<?php esc_attr_e( 'Skip to content', 'tomjn' ); ?>">
							<?php esc_html_e( 'Skip to content', 'tomjn' ); ?>
						</a>
					</div>

					<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
				</nav>
			</div>
		</header>

		<div id="main">
