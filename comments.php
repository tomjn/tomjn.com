<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to _s_comment() which is
 * located in the functions.php file.
 *
 * @package tomjn.com
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}

?>
<div id="comments" class="comments-area">
<?php
if ( have_comments() ) {
	?>
	<h2 class="comments-title">
		<?php
		printf(
			wp_kses_post(
				_n(
					'%1$s thought on &ldquo;%2$s&rdquo;',
					'%1$s thoughts on &ldquo;%2$s&rdquo;',
					intval( get_comments_number() ),
					'_s'
				)
			),
			esc_html( number_format_i18n( get_comments_number() ) ),
			'<span>' . wp_kses_post( get_the_title() ) . '</span>'
		);
		?>
	</h2>

	<?php
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) {
		// are there comments to navigate through?
		?>
		<nav role="navigation" id="comment-nav-above" class="site-navigation comment-navigation">
			<h1 class="assistive-text">
				<?php esc_html_e( 'Comment navigation', '_s' ); ?>
			</h1>
			<div class="nav-previous">
				<?php previous_comments_link( __( '&larr; Older Comments', '_s' ) ); ?>
			</div>
			<div class="nav-next">
				<?php next_comments_link( __( 'Newer Comments &rarr;', '_s' ) ); ?>
			</div>
		</nav>
		<?php
	}
	?>

	<ol class="commentlist">
		<?php
		/*
		 * Loop through and list the comments. Tell wp_list_comments()
		 * to use _s_comment() to format the comments.
		 * If you want to overload this in a child theme then you can
		 * define _s_comment() and that will be used instead.
		 * See _s_comment() in functions.php for more.
		 */
		wp_list_comments( [ 'callback' => '_s_comment' ] );
		?>
	</ol>

	<?php
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) {
		// are there comments to navigate through.
		?>
		<nav role="navigation" id="comment-nav-below" class="site-navigation comment-navigation">
			<h1 class="assistive-text"><?php esc_html_e( 'Comment navigation', '_s' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', '_s' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', '_s' ) ); ?></div>
		</nav>
		<?php
	}
}

// If comments are closed and there are comments, let's leave a little note, shall we?
if ( ! comments_open() && have_comments() && post_type_supports( get_post_type(), 'comments' ) ) {
	?>
	<p class="nocomments"><?php esc_html_e( 'Comments are closed.', '_s' ); ?></p>
	<?php
}

comment_form();
?>

</div>
