<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package tomjn.com
 */

get_header();
?>
	<div id="primary" class="site-content">
		<div id="content" role="main">

			<article id="post-0" class="post error404 not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', '_s' ); ?></h1>
				</header>
				<div class="entry-content">
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', '_s' ); ?></p>

					<?php
					get_search_form();
					the_widget( 'WP_Widget_Recent_Posts' ); ?>

					<div class="widget">
						<h2 class="widgettitle"><?php esc_html_e( 'Most Used Categories', '_s' ); ?></h2>
						<ul>
						<?php wp_list_categories( array( 'orderby' => 'count', 'order' => 'DESC', 'show_count' => 1, 'title_li' => '', 'number' => 10 ) ); ?>
						</ul>
					</div>

					<?php
					/* translators: %1$s: smilie */
					$archive_content = '<p>' . sprintf( __( 'Try looking in the monthly archives. %1$s', '_s' ), convert_smilies( ':)' ) ) . '</p>';
					the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>".wp_kses_post($archive_content) );
					the_widget( 'WP_Widget_Tag_Cloud' );
					?>
				</div>
			</article>

		</div>
	</div>

<?php
get_footer();
