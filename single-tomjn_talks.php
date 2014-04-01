<?php
get_header();
?>
		<div id="primary" class="site-content">
			<div id="content" role="main">
			<?php
			while ( have_posts() ) {
				the_post();
				_s_content_nav_projects( 'nav-above' );
				get_template_part( 'content', 'project' );
				_s_content_nav( 'nav-below' );

				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() )
					comments_template( '', true );
			}
			?>

			</div>
		</div>

<?php
get_sidebar();
get_footer();
