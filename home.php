<?php
get_header();
?>
		<div id="primary" class="site-content">
			<div id="content" role="main">
				<?php
				get_template_part( 'content', 'home' );
				?>
			</div>
		</div>
<?php
get_sidebar();
get_footer();
