<?php
get_header();
?>
		<div id="primary" class="site-content">
			<div id="content" role="main">
				<article <?php post_class(); ?>>
					<div id="twin-columns" class="grid">
						<?php
						if ( is_active_sidebar( 'sidebar-home-top' ) ) {
							?>
							<div class="grid__item  one-whole">
								<?php dynamic_sidebar('sidebar-home-top'); ?>
							</div>
							<?php
						}
						if ( is_active_sidebar( 'sidebar-home-left' ) || is_active_sidebar( 'sidebar-home-right' ) ) {
							?>
							<div class="grid__item  one-whole palm-one-whole lap-one-half  desk-one-half">
								<?php dynamic_sidebar('sidebar-home-left'); ?>
							</div>
							<div class="grid__item  one-whole palm-one-whole lap-one-half  desk-one-half">
								<?php dynamic_sidebar('sidebar-home-right'); ?>
							</div>
							<?php
						}
						?>
					</div>
				</article>
			</div>
		</div>
<?php
get_sidebar();
get_footer();
