<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * e.g., it puts together the home page when no home.php file exists.
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package Hestia
 * @since Hestia 1.0
 * @modified 1.1.30
 */

$hestia_alternative_blog_layout = get_theme_mod( 'hestia_alternative_blog_layout', 'blog_normal_layout' );
$hestia_remove_sidebar_on_index = get_theme_mod( 'hestia_sidebar_on_index', false );

$default_blog_layout        = hestia_sidebar_on_single_post_get_default();
$hestia_blog_sidebar_layout = get_theme_mod( 'hestia_blog_sidebar_layout', $default_blog_layout );

$args = array(
	'sidebar-right' => 'col-md-8 blog-posts-wrap',
	'sidebar-left'  => 'col-md-8 blog-posts-wrap',
	'full-width'    => 'col-md-10 col-md-offset-1 blog-posts-wrap',
);

$hestia_sidebar_width = get_theme_mod( 'hestia_sidebar_width', 25 );
if ( $hestia_sidebar_width > 3 && $hestia_sidebar_width < 80 ) {
	$args['sidebar-left'] .= ' col-md-offset-1';
}
$class_to_add = hestia_get_content_classes( $hestia_blog_sidebar_layout, 'sidebar-1', $args );

get_header();
?>
<div id="primary" class="<?php echo hestia_boxed_layout_header(); ?> page-header header-small">
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1 text-center">
				<h1 class="hestia-title">
					<?php is_front_page() ? bloginfo( 'description' ) : single_post_title(); ?>
				</h1>
			</div>
		</div>
	</div>
	<?php hestia_output_wrapper_header_background( false ); ?>
</div>
</header>

<div class="index-wrapper">
	<div class="each-con con-2 aboutus-wrapper">
		<h1>
			Rebとは
		</h1>
		<p class="title-bottom-border"></p>
		<p>
			Rebは現役の大学編入生集団が運営するオンライン学習サイトです。<br>
			未知の部分が多い”大学編入”に関して<br>
			学校では教えてくれない<br>
			ネットにも存在しない<br>
			そんな生きた情報をお届けします。<br>
			<div class="aboutus-more">
				<a href="http://reb.wp.xdomain.jp/about-us">
					More
				</a>
			</div>	
		</p>
	</div>

	<div class="each-con con-3 department-wrapper">
		<div class="title-wrapper">
			<h1>
				学部で探す
			</h1>
			<p class="title-bottom-border"></p>
		</div>
		<div class="index-logo logo-depar"></div>
		<div class="searchbox-content">
			<ul>
				<?php wp_list_categories('orderby=ID&title_li='); ?>
			</ul>
		</div>
	</div>

	<div class="each-con con-4 univ-wrapper">
		<div class="title-wrapper">
			<h1>
				大学で探す
			</h1>
			<p class="title-bottom-border"></p>
		</div>
		<div class="index-logo logo-univ"></div>
		<div class="searchbox-content univ-list">
			<ul>
				<?php
				$posttags = get_tags();
				if ($posttags) {
					foreach($posttags as $tag) {
						echo '<li><a href="'. get_tag_link($tag->term_id) .'">' . $tag->name . '</a></li>';
					}
				}
				?>
			</ul>
		</div>
	</div>

	<div class="each-con con-5 searchbox-wrapper">
		<div class="title-wrapper">
			<h1>
				コンテンツを探す
			</h1>
			<p class="title-bottom-border"></p>
		</div>
		<div class="searchbox-content">
			<div id="search">
				<form method="get" action="<?php bloginfo( 'url' ); ?>">
					<?php wp_dropdown_categories('depth=0&orderby=name&hide_empty=1&show_option_all=学部選択'); ?>
					<?php $tags = get_tags(); if ( $tags ) : ?>
					<select name='tag' id='tag'>
						<option value="" selected="selected">大学選択</option>
						<?php foreach ( $tags as $tag ): ?>
							<option value="<?php echo esc_html( $tag->slug);  ?>"><?php echo esc_html( $tag->name ); ?></option>
						<?php endforeach; ?>
					</select>
				<?php endif; ?>
				<input id="submit" type="submit" value="Search" />
			</form>
		</div>
	</div>
</div>

<div class="each-con con-6 newcontents-wrapper">
	<div class="title-wrapper">
		<h1>
			What's NEW!
		</h1>
		<p class="title-bottom-border"></p>
	</div>
	<div class="<?php echo hestia_layout(); ?>">
		<div class="hestia-blogs">
			<div class="container">
				<div class="row">
					<?php
					if ( $hestia_blog_sidebar_layout === 'sidebar-left' ) {
						get_sidebar();
					}
					?>
					<div class="<?php echo esc_attr( $class_to_add ); ?>">
						<?php
						if ( have_posts() ) :
							while ( have_posts() ) :
								the_post();
								if ( ( $hestia_alternative_blog_layout === 'blog_alternative_layout' ) && ( $wp_query->current_post % 2 == 0 ) ) {
									get_template_part( 'template-parts/content', 'alternative' );
								} else {
									get_template_part( 'template-parts/content' );
								}
							endwhile;
							the_posts_pagination();
						else :
							get_template_part( 'template-parts/content', 'none' );
						endif;
						?>
					</div>
					<?php
					if ( $hestia_blog_sidebar_layout === 'sidebar-right' ) {
						get_sidebar();
					}
					?>
				</div>
			</div>
		</div>
		<?php do_action( 'hestia_after_archive_content' ); ?>
	</div>
</div>

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

<div class="index-recruit">
	<a href="http://reb.wp.xdomain.jp/recruit">
		Rebのメンバーになる
	</a>
</div>	
</div>
</div>


<?php get_footer(); ?>

<style type="text/css">
.searchbox-content,.univ-list {¥
	text-align: center;
}
.univ-list ul {
	display: grid;
	grid-template-columns: 50% 50%;
	grid-template-rows: auto;
}
.searchbox-content ul,.univ-list ul {
	padding: 0;
	margin: 0;
	text-align: center;
}
.univ-list ul li {
	width: 90% !important;
}
.searchbox-content ul li,.univ-list ul li {
	border: 3px solid gray;
	list-style-type: none;
	margin: 10px auto;
	width: 70%;
	padding: 10px 0;
}
.searchbox-content ul li a,.univ-list ul li a {
	padding: 10px;
	font-size: 18px;
	color: #4e4c4c;
}
@media (max-width: 768px) {
	.container .row div h1 {
		text-align: center;
		font-size: 60px !important;
		letter-spacing: 10px;
		/*background-image: url(http://reb.wp.xdomain.jp/wp-content/uploads/2018/02/smoke-659466_640.jpg);*/
		background-image: url(http://reb.wp.xdomain.jp/wp-content/uploads/2018/02/colour-1885352_640.jpg);
		background-position: center;
		-webkit-background-clip: text;
		-webkit-text-fill-color: transparent;
	}
}
</style>