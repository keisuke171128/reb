<?php
/**
 * Template Name:メンバー
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
					<h1 class="hestia-title">Member</h1>
				</div>
			</div>
		</div>
		
		<div data-parallax="active" class="header-filter header-filter-gradient"></div>	</div>
<div class="whole-wrapper">
	<div class="member-wrapper">
		<?php $users = get_users( array('orderby'=>ID,'order'=>ASC) ); ?>
		<div class="authors">
			<?php foreach($users as $user) { $uid = $user->ID; ?>
			<a href="<?php echo get_bloginfo("url") . '/?author=' . $uid ?>">
				<div class="author-profile author-content">
					<div class="author-thumbanil"><?php echo get_avatar( $uid ,300 ); ?></div>
					<div class="author-text">
						<div class="author-name"><h3><?php echo $user->display_name ; ?></h3></div>
						<div class="author-description"><?php echo $user->user_description ; ?></div>
					</div>
				</div>
			</a>
			<?php } ?>
		</div>
	</div>
</div>	

<?php // get_sidebar(); ?>
<?php get_footer(); ?>

<style type="text/css">
h3 {
	margin: 0;
	padding: 0;
}
</style>