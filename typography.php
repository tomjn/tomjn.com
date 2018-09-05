<?php
/**
 * Template Name: Typography
 *
 * @package tomjn.com
 */
get_header();
?>
<style>
	.typo {
		padding-left: 25%;
		margin-bottom: 40px;
		position: relative;
	}
	.typo .note {
		bottom: 10px;
		color: #c0c1c2;
		display: block;
		font-weight: 400;
		font-size: 13px;
		line-height: 13px;
		left: 0;
		margin-left: 20px;
		position: absolute;
		width: 260px;
	}
</style>
<div id="primary" class="site-content">
	<div id="content" role="main">
		<article id="typography-post" class="">
			<header class="entry-header">
				<h1 class="entry-title">Typography Tests</h1>
			</header>

			<div class="entry-content">
			<?php
			for ( $i = 1; $i < 5; $i++ ) {
				?>
				<div class="typo">
					<h<?php echo intval( $i ); ?>><span class="note">Heading <?php echo intval( $i ); ?></span>The Quick Brown Fox Jumped Over The Lazy Dog</h<?php echo intval( $i ); ?>>
				</div>
				<?php
			}
			?>
			<div class="typo">
				<p><span class="note">Paragraph</span>I will be the leader of a company that ends up being worth billions of dollars, because I got the answers. I understand culture. I am the nucleus. I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at.</p>
				<p>I will be the leader of a company that ends up being worth billions of dollars, because I got the answers. I understand culture. I am the nucleus. I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at.</p>
			</div>
			<div class="typo">
				<span class="note">Quote</span>
				<blockquote>
					<p>
						I will be the leader of a company that ends up being worth billions of dollars, because I got the answers. I understand culture. I am the nucleus. I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at.
					</p>
					<small>
						Kanye West, Musician
					</small>
				</blockquote>
			</div>
			<h3>Forms</h3>
			<form method="get" action="/">
				<div class="typo">
					<span class="note"></span>
				</div>
				<div class="typo">
					<span class="note">Password</span>
					<label for="password-input">Password</label>
						<input id="password-input" type="password" value="">
				</div>
				<div class="typo">
					<span class="note">Placeholder</span>
					<label for="placeholder-input">Placeholder</label>
						<input id="placeholder-input" type="text" placeholder="placeholder">
				</div>
				<div class="typo">
					<span class="note">Disabled</span>
					<label for="disabled-input">Disabled</label>
						<input id="disabled-input" type="text" disabled="" placeholder="Disabled input here...">
				</div>
				<div class="typo">
					<span class="note">Checkboxes and Radios</span>
					<div>
						<label>
							<input type="checkbox" name="optionsCheckboxes"><span class="checkbox-material"><span class="check"></span></span> First Checkbox
						</label>
					</div>
					<div>
						<label>
							<input type="checkbox" name="optionsCheckboxes"><span class="checkbox-material"><span class="check"></span></span> Second Checkbox
						</label>
					</div>
					<div>
						<label>
							<input type="radio" name="optionsRadios" checked="true"><span class="circle"></span><span class="check"></span> First Radio
						</label>
					</div>
					<div>
						<label>
							<input type="radio" name="optionsRadios"><span class="circle"></span><span class="check"></span> Second Radio
						</label>
					</div>
				</div>
			</form>
		</article>
	</div>
</div>
<?php
get_sidebar();
get_footer();
