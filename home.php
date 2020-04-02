<?php
get_header( 'empty' );
?>
<div class="columns half-mast-spacing">
	<header id="masthead" class="half-mast site-header column is-half">
		<div class="header-contents">
			<hgroup>
				<h1 class="site-title">
					<a class="h-card" rel="me" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
						<?php echo esc_html( get_bloginfo( 'name', 'display' ) ); ?>
					</a>
				</h1>
				<?php
				$description = get_bloginfo( 'description' );
				if ( ! empty( $description ) ) {
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

				<?php
				wp_nav_menu( [
					'theme_location' => 'primary',
				] );
				?>
			</nav>
		</div>
	</header>
	<section id="content" class="site-content column is-half" role="main">
		<article>
			<div class="entry-content">
				<?php dynamic_sidebar( 'sidebar-home-right' ); ?>
			</div>
		</article>
	</section>
</div>
<?php
get_sidebar();
get_footer();
