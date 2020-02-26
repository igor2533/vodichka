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
<style>
div#content {
    padding-bottom: 0px!important;
}

	@media (min-width:378px) and (max-width: 767px){
		.odo {
    margin-top: 96px;
}


.single-product .woocommerce-variation-add-to-cart .button {

    float: left;
    position: relative;
    top: 7px;}
	}

.others {

    float: left;}


div#masss2 {float: left!important;}

@media (min-width: 1450px){




aside .sidebar {width: 480px;}


}


@media (min-width: 1510px) and (max-width: 1660px){

aside .sidebar {width: 400px;}
}


@media (min-width: 1301px) and (max-width: 1509px){

aside .sidebar {width: 310px;}
}



@media (min-width: 1300px) and (max-width: 1449px){
	.sidebar .actions {
    position: absolute;
    top: 1px;
    right: calc((100vw - 1380px) / 2);
}


div#primary {
    width: 66%!important;
    border-right: 1px solid #2d2e83!important;
}





aside {width: 30%;}



}



.odo {float: left;
    width: 50%;}

@media (max-width: 1300px){

.sidebar .banner {
    margin-bottom: 22px;
    display: inline-flex;
}


.sidebar{width: 100%;}
aside#secondary {
    width: 100%!important;
    text-align: center;
}

div#masss2 {float: left!important;}
}

 </style>
<aside id="secondary" class="widget-area" role="complementary" aria-label="<?php esc_attr_e( 'Blog Sidebar', 'twentyseventeen' ); ?>">
	<?php //dynamic_sidebar( 'sidebar-1' ); ?>

	<div class="mobile-only sidebar-title">
						для тех, кто хочет знать больше...
					</div>

					<div class="sidebar">
						<div class="actions">
							<div class="action"><a href="#" onclick="down();return false;"><img src="http://vodichka/files/images/down.png" alt title></a></div>
							<div class="action"><a href="#" onclick="share();return false;"><img src="http://vodichka/files/images/share.png" alt title></a></div>
							<div class="action social"><a href="#"><img src="http://vodichka/files/images/facebook.png" alt title></a></div>
							<div class="action social"><a href="#"><img src="http://vodichka/files/images/vk.png" alt title></a></div>
							<div class="action social"><a href="#"><img src="http://vodichka/files/images/twitter.png" alt title></a></div>
							<div class="action social"><a href="#"><img src="http://vodichka/files/images/youtube.png" alt title></a></div>
							<div class="action social"><a href="#"><img src="http://vodichka/files/images/callback.png" alt title></a></div>
							<div class="action social"><a href="#"><img src="http://vodichka/files/images/inst.png" alt title></a></div>
							<div class="action social"><a href="#"><img src="http://vodichka/files/images/mail.png" alt title></a></div>
							<div class="action"><a href="#" onclick="up();return false;"><img src="http://vodichka/files/images/up.png" alt title></a></div>
						</div>
                        <div class="banner"><a href="#"><img src="http://vodichka/files/images/banner.jpg" alt title></a></div>




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
