<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package tomjn.com
 */

/**
 * Display navigation to next/previous pages when applicable
 *
 * @param integer $nav_id nav ID
 * @since _s 1.0
 */
function _s_content_nav( $nav_id ) : void {
	global $wp_query;

	$nav_class = 'site-navigation paging-navigation columns is-multiline is-gapless';
	if ( is_singular() ) {
		$nav_class = 'site-navigation post-navigation columns is-multiline is-gapless';
	}

	?>
	<nav role="navigation" id="<?php echo esc_attr( $nav_id ); ?>" class="<?php echo esc_attr( $nav_class ); ?>">
		<h1 class="assistive-text"><?php esc_html_e( 'Post navigation', '_s' ); ?></h1>
	<?php

	// navigation links for single posts.
	if ( is_singular() ) {
		previous_post_link(
			'<div class="nav-previous column is-half">%link</div>',
			'<span class="meta-nav">' . _x( '&larr;', 'Previous post link', '_s' ) . '</span> %title'
		);
		next_post_link( '<div class="nav-next column is-half">%link</div>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', '_s' ) . '</span>' );

	} elseif (
		$wp_query->max_num_pages > 1
		&& ( is_home() || is_archive() || is_search() )
	) {
		// navigation links for home, archive, and search pages.
		if ( get_next_posts_link() ) {
			?>
		<div class="nav-previous column is-half"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', '_s' ) ); ?></div>
			<?php
		}
		if ( get_previous_posts_link() ) {
			?>
		<div class="nav-next column is-half"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', '_s' ) ); ?></div>
			<?php
		}
	}
	if ( is_single() && ! is_singular( [ 'post', 'page', 'attachment' ] ) ) {
		$post_type = get_post_type();
		?>
		<div class="column is-full">
			<a href="<?php echo esc_url( get_post_type_archive_link( $post_type ) ); ?>">
				&larr; View All
			</a>
		</div>
		<?php
	}
	?>

	</nav>
	<?php
}

/**
 * Display navigation to next/previous pages when applicable
 *
 * @param integer $nav_id ID of nav
 *
 * @since _s 1.0
 */
function _s_content_nav_projects( $nav_id ) : void {
	global $wp_query;

	$nav_class = 'site-navigation paging-navigation columns is-multiline is-gapless';
	if ( is_single() ) {
		$nav_class = 'site-navigation post-navigation columns is-multiline is-gapless';
	}

	?>
	<nav role="navigation" id="<?php echo esc_attr( $nav_id ); ?>" class="<?php echo esc_attr( $nav_class ); ?>">
		<h1 class="assistive-text"><?php esc_html_e( 'Post navigation', '_s' ); ?></h1>
		<?php
		if ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) {
			// navigation links for home, archive, and search pages
			if ( get_next_posts_link() ) {
				?>
				<div class="nav-previous column is-half"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', '_s' ) ); ?></div>
				<?php
			}
			if ( get_previous_posts_link() ) :
				?>
				<div class="nav-next column is-half"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', '_s' ) ); ?></div>
				<?php
			endif;

			if ( is_single() && ! is_singular( [ 'post', 'page', 'attachment' ] ) ) {
				$post_type = get_post_type();
				?>
				<div class="column is-full"><a href="<?php echo esc_url( get_post_type_archive_link( $post_type ) ); ?>">&larr; View All</a></div>
				<?php
			}
		}
		?>
	</nav>
	<?php
}

/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since _s 1.0
 */
function _s_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback':
		case 'trackback':
			?>
	<li class="post pingback">
		<p><?php esc_html_e( 'Pingback:', '_s' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( esc_html__( '(Edit)', '_s' ), ' ' ); ?></p>
			<?php
			break;
		default:
			?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment comment-type-<?php echo esc_attr( $comment->comment_type ) ?>">
			<footer>
				<div class="comment-author vcard">
					<?php
					echo wp_kses_post( get_avatar( $comment, 40 ) );
					$comment_author = get_comment_author_link();
					if ( empty( $comment_author ) ) {
						$comment_author = 'Unknown';
					}
					printf( wp_kses_post( __( '%s <span class="says">says:</span>', '_s' ) ), '<cite class="fn">' . wp_kses_post( $comment_author ) . '</cite>' );
					?>
				</div>
				<?php
				if ( $comment->comment_approved === '0' ) :
					?>
					<em><?php esc_html_e( 'Your comment is awaiting moderation.', '_s' ); ?></em>
					<br />
					<?php
				endif;
				?>

				<div class="comment-meta commentmetadata">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time pubdate datetime="<?php comment_time( 'c' ); ?>">
					<?php
					/* translators: 1: date, 2: time */
					printf( wp_kses_post( __( '%1$s at %2$s', '_s' ) ), esc_html( get_comment_date() ), esc_html( get_comment_time() ) );
					?>
					</time></a>
					<?php
					edit_comment_link( __( '(Edit)', '_s' ), ' ' );
					?>
				</div>
			</footer>

			<div class="comment-content">
				<?php
				comment_text();
				?>
			</div>

			<div class="reply">
				<?php
				comment_reply_link(
					array_merge(
						$args,
						[
							'depth'     => $depth,
							'max_depth' => $args['max_depth'],
						]
					)
				);
				?>
			</div>
		</article>

			<?php
			break;
	endswitch;
}

/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @since _s 1.0
 */
function _s_posted_on() : void {
	printf(
		wp_kses_post(
			__( 'Posted on <a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="byline"> by <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', '_s' )
		),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', '_s' ), get_the_author() ) ),
		esc_html( get_the_author() )
	);
}
