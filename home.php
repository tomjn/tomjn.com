<?php

get_header();
?>
		<div id="primary" class="site-content">
			<div id="content" role="main">
				<?php
				while ( have_posts() ) {
					the_post();
					get_template_part( 'content', 'home' );
					if ( have_comments() || comments_open() ) {
						comments_template( '', true );
					}
				}
				?>
			</div>
		</div>
<?php
get_sidebar();
get_footer();
