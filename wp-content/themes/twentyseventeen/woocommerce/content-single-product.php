<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<?php  if(!is_front_page()) { ?>
<style>


	.sub-header.fixed .sub-header_wrapper {

    height: 40px;
}
	@media screen and (min-width: 1300px){
		div#primary {

    width: 66%!important;
    border-right: 1px solid #2d2e83;

}
.has-sidebar #secondary {
    width: 27%!important;
}








}

@media screen and (min-width: 48em){
.has-sidebar.woocommerce-page:not(.error404) #primary {
    width: 74%;
    padding-right: 20px;
}
}
@media screen and (max-width: 480px){
aside#secondary {
    padding-left: 0px;
}
}
@media screen and (max-width: 1200px){
.sidebar>div.article {
    width: 100%;
    float: left;
    margin: 0 auto;
}
.sidebar {
    text-align: center;
}
.article>img {
    float: none;
}
}

.entry-content a, .entry-summary a, .comment-content a, .widget a, .site-footer .widget-area a, .posts-navigation a, .widget_authors a strong
{

	-webkit-box-shadow:none; box-shadow: none;
}


.entry-content a img, .comment-content a img, .widget a img {
  
    box-shadow: none;-webkit-box-shadow:none;
}

</style>
<?php } ?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>













	<?php
	/**
	 * Hook: woocommerce_before_single_product_summary.
	 *
	 * @hooked woocommerce_show_product_sale_flash - 10
	 * @hooked woocommerce_show_product_images - 20
	 */
	do_action( 'woocommerce_before_single_product_summary' );
	?>

	<div class="summary entry-summary">
		<?php
		/**
		 * Hook: woocommerce_single_product_summary.
		 *
		 * @hooked woocommerce_template_single_title - 5
		 * @hooked woocommerce_template_single_rating - 10
		 * @hooked woocommerce_template_single_price - 10
		 * @hooked woocommerce_template_single_excerpt - 20
		 * @hooked woocommerce_template_single_add_to_cart - 30
		 * @hooked woocommerce_template_single_meta - 40
		 * @hooked woocommerce_template_single_sharing - 50
		 * @hooked WC_Structured_Data::generate_product_data() - 60
		 */
		do_action( 'woocommerce_single_product_summary' );
		?>
	</div>

	<?php
	/**
	 * Hook: woocommerce_after_single_product_summary.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
	 * @hooked woocommerce_output_related_products - 20
	 */
	do_action( 'woocommerce_after_single_product_summary' );
	?>







</div>












<?php do_action( 'woocommerce_after_single_product' ); ?>
