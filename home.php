<?php
get_header();
?>
		<div id="primary" class="site-content">
			<div id="content" role="main">
				<article <?php post_class( 'columns' ); ?>>
						<?php
						if ( is_active_sidebar( 'sidebar-home-left' ) || is_active_sidebar( 'sidebar-home-right' ) ) {
							?>
							<div class="column is-half">
								<?php dynamic_sidebar('sidebar-home-left'); ?>
							</div>
							<div class="column is-half">
								<?php dynamic_sidebar('sidebar-home-right'); ?>
							</div>
							<?php
						} else {
							?>
							<p>You need to add widgets to the main sidebars</p>
							<?php
						}
						?>
				</article>
			</div>
		</div>
<?php
get_sidebar();
get_footer();
