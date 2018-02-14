<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "wrapper" div and all content after.
 *
 * @package Hestia
 * @since Hestia 1.0
 */
?>

<div class="each-con con-7 wordsearch-wrapper">
	<div class="title-wrapper">
		<h1>
			キーワード
		</h1>
		<p class="title-bottom-border"></p>
		<div class="con-type-box">
			<?php
			$terms = get_terms('con_type');
			foreach ( $terms as $term ) {
				echo '<p><a href="'.get_term_link($term).'">'.$term->name.'</a></p>';
			}
			?>
		</div>
	</div>
</div>

<div class="footer-con">
	<p>Copy right reserved by Reb</p>
</div>

		</div>
	</div>
<?php wp_footer(); ?>
</body>
</html>
