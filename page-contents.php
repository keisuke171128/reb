<?php
/**
 * Template Name:コンテンツ
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>
<div id="primary" class="boxed-layout-header page-header header-small">
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1 text-center">
				<h1 class="hestia-title">Contents</h1>
			</div>
		</div>
	</div>
	<div data-parallax="active" class="header-filter header-filter-gradient">
	</div>
</div>
<div class="whole-wrapper">
	<div class="contents-wrapper">
		<!-- １ページ表示数指定 but　若干失敗-->
		<?php query_posts('post_type=post&paged=&posts_per_page=5'.$paged); ?>
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content', 'alternative' );
			endwhile;
			the_posts_pagination();
		else :
			get_template_part( 'template-parts/content', 'none' );
		endif;
		?>
		<?php wp_reset_query(); ?>
	</div>
</div>	
</div>

<?php // get_sidebar(); ?>
<?php get_footer(); ?>


<style type="text/css">
</style>