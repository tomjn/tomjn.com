<?php
/**
 * The template for displaying image attachments.
 *
 * @package _s
 * @since _s 1.0
 */

get_header();
?>
		<div id="primary" class="site-content audio-attachment">
			<div id="content" role="main">

			<?php
			while ( have_posts() ) {
				the_post();
				?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<h1 class="entry-title"><?php the_title(); ?></h1>

						<div class="entry-meta">
							<?php
								$metadata = wp_get_attachment_metadata();
								printf( __( 'Published <span class="entry-date"><time class="entry-date" datetime="%1$s" pubdate>%2$s</time></span>, <a href="%3$s" title="Direct link">direct link</a>, posted in <a href="%4$s" title="Return to %5$s">%5$s</a>', '_s' ),
									esc_attr( get_the_date( 'c' ) ),
									esc_html( get_the_date() ),
									wp_get_attachment_url(),
									get_permalink( $post->post_parent ),
									get_the_title( $post->post_parent )
								);
							?>
							<?php edit_post_link( __( 'Edit', '_s' ), '<span class="sep"> | </span> <span class="edit-link">', '</span>' ); ?>
						</div>

					</header>

					<div class="entry-content">
						<div class="entry-attachment">
							<div class="attachment">
								<audio controls>
									<source src="<?php echo wp_get_attachment_url(); ?>" type="<?php echo get_post_mime_type(); ?>">
									Your browser does not support the audio tag.
								</audio>
							</div>
							<?php
							if ( ! empty( $post->post_excerpt ) ) {
								?>
								<div class="entry-caption">
									<?php the_excerpt(); ?>
								</div>
								<?php
							}
							?>
						</div>
						<?php
						the_content();
						wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', '_s' ), 'after' => '</div>' ) );
						?>
					</div>

					<footer class="entry-meta">
						<?php
						if ( comments_open() && pings_open() ) {
							printf( __( '<a class="comment-link" href="#respond" title="Post a comment">Post a comment</a> or leave a trackback: <a class="trackback-link" href="%s" title="Trackback URL for your post" rel="trackback">Trackback URL</a>.', '_s' ), get_trackback_url() );
						} elseif ( ! comments_open() && pings_open() ) {
							printf( __( 'Comments are closed, but you can leave a trackback: <a class="trackback-link" href="%s" title="Trackback URL for your post" rel="trackback">Trackback URL</a>.', '_s' ), get_trackback_url() );
						} elseif ( comments_open() && ! pings_open() ) {
							_e( 'Trackbacks are closed, but you can <a class="comment-link" href="#respond" title="Post a comment">post a comment</a>.', '_s' );
						} elseif ( ! comments_open() && ! pings_open() ) {
							_e( 'Both comments and trackbacks are currently closed.', '_s' );
						}
						edit_post_link( __( 'Edit', '_s' ), ' <span class="edit-link">', '</span>' );
						?>
					</footer>
				</article>

				<?php
				comments_template();
			}
			?>
			</div>
		</div>

<?php
get_footer();
