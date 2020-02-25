<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area" role="complementary" aria-label="<?php esc_attr_e( 'Blog Sidebar', 'twentyseventeen' ); ?>">
	<?php //dynamic_sidebar( 'sidebar-1' ); ?>

	<div class="mobile-only sidebar-title">
						для тех, кто хочет знать больше...
					</div>
					<div class="sidebar">

						<div class="article"><img src="http://vodichka/files/images/banner.jpg" alt title></div>



<?php $query = new WP_Query( array( 'p' => 77, 'post_type' => 'page' ) );  ?>


<?php while ( $query->have_posts() ) {
	$query->the_post();


   ?>



						<div class="article">
							<div class="article_head"><?php the_title(); ?></div>
							<div class="article_body">
						<?php the_content(); ?>
							</div>
						</div>
					<?php  } ?>
                        <div class="video">
							<iframe width="408" height="251" src="https://www.youtube.com/embed/eJnQBXmZ7Ek" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						</div>



<?php $query = new WP_Query( array( 'category_name' => 'sidebar' ) );  ?>


<?php while ( $query->have_posts() ) {
	$query->the_post();


   ?>


						<div class="article">
							<div class="article_head"><?php  the_title(); // выведем заголовок поста  ?></div>
							<div class="article_body">
						<?php the_content();  ?>
							</div>
						</div>

<?php }  ?>


					</div>

</aside><!-- #secondary -->
