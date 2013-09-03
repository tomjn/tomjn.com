<a href="<?php echo get_permalink(); ?>" class="project_listing_item grid__item one-whole palm-one-whole lap-one-half desk-one-half">
	<div class="grid">
		<div class="grid__item one-third palm-one-whole lap-one-whole desk-one-whole">
			<?php the_post_thumbnail( 'project-main' ); ?>
		</div>
		<div class="grid__item two-thirds palm-one-whole lap-one-whole desk-one-whole">
			<h2><?php the_title(); ?></h2>
			<?php the_excerpt(); ?>
		</div>
	</div>
</a>