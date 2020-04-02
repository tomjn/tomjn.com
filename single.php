<?php
get_header();
?>
		<section id="content" class="site-content" role="main">
			<?php
			while ( have_posts() ) {
				the_post();
				_s_content_nav( 'nav-above' );
				get_template_part( 'content', 'single' );
				_s_content_nav( 'nav-below' );

				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || have_comments() ) {
					comments_template( '', true );
				}
			}
			?>
		</section>

<?php
get_sidebar();
get_footer();