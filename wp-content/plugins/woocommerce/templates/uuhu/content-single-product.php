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
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $product;

?>



<div class="chleb">
	<div class="wrap">
		<a href="<?=get_site_url();?>">Главная</a>
		<a href="<?=get_site_url();?>/shop">Магазин</a>
		<span><?=the_title();?></span>
	</div>
</div>
<div class="wrap">
	<div class="cart">
		<div class="cart-slider">

			<div class="activeBlock">
		  <?php
		  $i = 0;
		  if (have_rows('galereya', get_the_ID())):
			  while (have_rows('galereya', get_the_ID())) : the_row();
			$i++;
				  if($i == 1){
					  ?>
					  <img src="<?= the_sub_field("kartinka", get_the_ID()); ?>"
					       alt="">
				  <?           }

			  endwhile;
		  else :
		  endif;
		  ?>

			</div>
			<div class="cart-prevArrow"><img
					src="<?=get_template_directory_uri();?>/static/imgs/up.png"
			                                 alt=""></div>
			<div class="cart-nextArrow"><img
					src="<?=get_template_directory_uri();?>/static/imgs/down.png"
			                                 alt=""></div>
			<div class="itemsVideo">

		  <?php
		  $i = 0;
		  if (have_rows('galereya', get_the_ID())):
			  while (have_rows('galereya', get_the_ID())) : the_row();
			$i++;

			if($i == 1){
				  ?>
					 <div class="item active" data-image = "<?= the_sub_field("kartinka", get_the_ID()); ?>">
						 <img src="<?= the_sub_field("kartinka", get_the_ID()); ?>"
						      alt="">
					 </div>
			  <?           }
				 else{
				 	?>
					 <div class="item" data-image = "<?= the_sub_field("kartinka", get_the_ID()); ?>">
						 <img src="<?= the_sub_field("kartinka", get_the_ID()); ?>"
						      alt="">
					 </div>
				<?
				 }
			  endwhile;
		  else :
		  endif;
		  ?>


			</div>
		</div>
		<?
	echo "<pre>";
//	print_r($product);
	echo "</pre>";
		?>
		<div class="cart-content">
				<?
		if (get_post_meta(get_the_ID(), '_stock_status', true) == 'outofstock') {
			echo '<div class="cart-status">Нет в наличии</div>';
		} else {
			echo '<div class="cart-status">В наличии</div>';
		}
				?>
			<div class="cart-ttl">

			<?=wc_get_product_category_list( $product->get_id()); ?> <?	do_action( 'woocommerce_shop_loop_item_title' );?>
			</div>
			<div class="cart-pris">
		 <span><?php

		  echo $product->get_price();?>        </span>
				рублей
				</div>

			<div class="cart-btns">
				<div class="cart-counter">
					<div class="minus">-</div>
					<div class="cart-counter-line"></div>
					<input type="text" value="1" disabled>
					<div class="cart-counter-line"></div>
					<div class="plus">+</div>
				</div>


<?php
if($product->product_type == "variable"){
woocommerce_variable_add_to_cart();
} else {
woocommerce_template_loop_add_to_cart();
}

?>

<style>
	a.button.product_type_variable.add_to_cart_button {
    display: none;
}
table.variations select {
    border: solid 1px #fac811;
    font-size: 17px;
    padding: 3px;
    border-radius: 5px;
    margin-left: 12px;
    margin-right: 14px;font-weight: bold;
}

p.stock.in-stock {
    display: none;
}

a.reset_variations {
    display: none!important;
}

table.variations label {
    display: none;
}


.woocommerce-variation.single_variation {
    float: left;
}

.woocommerce-variation-add-to-cart.variations_button.woocommerce-variation-add-to-cart-enabled {
    float: left;
}


.woocommerce-variation-add-to-cart.variations_button.woocommerce-variation-add-to-cart-enabled>div input {
    border: solid 1px black;
    border-radius: 5px;
    padding: 5px;
    width: 52px;
    float: left;    margin-left: 10px;
    margin-right: 15px;


}

.woocommerce-variation-add-to-cart.variations_button.woocommerce-variation-add-to-cart-enabled>div.quantity {
    float: left;
}


span.woocommerce-Price-amount.amount {
    vertical-align: middle;
    font-size: 22px;
    font-weight: bold;
    color: #3b3b3b;
}


button.single_add_to_cart_button.button.alt {

	border-radius: 30px;
    background-color: #fac811;
    padding: 15px 50px;
    color: #222222;
    font-size: 14px;
    font-weight: 700;
    line-height: 22px;
    cursor: pointer;
    text-transform: uppercase;
    display: flex;
    align-items: center;
    -webkit-transition: all 0.3s;
    -moz-transition: all 0.3s;
    -ms-transition: all 0.3s;
    -o-transition: all 0.3s;
    transition: all 0.3s;position: relative;
    bottom: 12px;
}

.woocommerce-variation-add-to-cart.variations_button.woocommerce-variation-add-to-cart-disabled>div.quantity{float: left;

}

.woocommerce-variation-add-to-cart.variations_button.woocommerce-variation-add-to-cart-disabled>div.quantity>input {
    vertical-align: middle;
    border: solid 1px #fac811;
    border-radius: 6px;
    padding: 6px;
    margin-right: 13px;
    font-weight: bold;
}

</style>



			<?php 	do_action( 'woocommerce_after_shop_loop_item' );?>
				<?php ?>
<!--				<div class="standart-btn standart-btn-white">-->
<!--					Купить в 1 клик-->
<!--				</div>-->
			</div>

<!--			<div class="cart-promo">-->
<!--				<b>Введите промокод на скидку</b>-->
<!--				<div class="cart-promo-input">-->
<!--					<input type="text" placeholder="Введите промокод на скидку">-->
<!--					<button>Применить</button>-->
<!--				</div>-->
<!--			</div>-->
			<div class="cart-options">

		  <?php
		  if (have_rows('opczii', get_the_ID())):
			  while (have_rows('opczii', get_the_ID())) : the_row();
				  ?>
				  <div class="cart-option">
					  <b>	<?= the_sub_field("nazvanie", get_the_ID()); ?></b>
					  <p>
				<?= the_sub_field("tekst", get_the_ID()); ?>
					  </p>
				  </div>
			  <?
			  endwhile;
		  else :
		  endif;
		  ?>

			</div>


		</div>
	</div>
	<div class="cart-flex">
		<div class="cart-descr">
			<div class="cart-descr-ttl">Описание</div>
			<div class="cart-descr-body">
		  <?php the_content(); ?>
			</div>
		</div>
		<div class="cart-descr">
		<?php
		$vn = 0;
		if (have_rows('otzyvy', get_the_ID())):
			while (have_rows('otzyvy', get_the_ID())) : the_row();
				$vn++;
			endwhile;
		else :
		endif;
		?>
			<div class="cart-descr-ttl cart-descr-black">Отзывы (<?=$vn;?>)</div>
			<div class="cart-rews owl-carousel">


		  <?php
		  if (have_rows('otzyvy', get_the_ID())):
			  while (have_rows('otzyvy', get_the_ID())) : the_row();
					  ?>
					  <div class="cart-rew cart-descr-body">
							<?= the_sub_field("tekst", get_the_ID()); ?>
					  </div>
					  <?
			  endwhile;
		  else :
		  endif;
		  ?>

			</div>

		</div>
	</div>
</div>


<div class="d2" style="margin-top: 0px">
	<div class="wrap">
		<div class="d2-head">
			<div class="standart-ttl">С этим товаром часто покупают</div>
		</div>
		<div class="d2-flex owl-carousel">
		<?php


		$posts = get_posts(array(
			"post_type" => "product",
			"numberposts" => "12",
			'post_status' => 'publish',
			'orderby' => 'rand',
		));
		foreach ($posts as $post){
			global $product;

			setup_postdata($post);

			?>

			<div class="d2-item" >
				<img src="<?= get_field('prevyu', get_the_ID()); ?>" alt="" class="d2-img">
				<div class="d2-body"><img src="<?=get_template_directory_uri();?>/static/imgs/volna.png"
				                          alt="">
					<div class="d2-item-ttl"><span>

			<?=wc_get_product_category_list( $product->get_id()); ?></span><a
							href="<?=get_permalink();?>"><?	do_action( 'woocommerce_shop_loop_item_title' );?><a/>
					</div>
					<!--		<div class="d2-item-options">-->
					<!--		-->
					<!--			<div class="d2-item-option active">Упаковка 75гр</div>-->
					<!--			<div class="d2-item-option">Коробка 0,9кг</div>-->
					<!--		</div>-->
					<div class="d2-footer">
						<div class="d2-pris"><? do_action( 'woocommerce_after_shop_loop_item_title' );?></div>



						<div class="d2-basket">
							<img src="<?=get_template_directory_uri();?>/static/imgs/d2-bas.png" alt=""> <?php 	do_action( 'woocommerce_after_shop_loop_item' );?>
						</div>
					</div>
				</div>
			</div>


			<?php
		}
		wp_reset_postdata();
		?>


		</div>
	</div>
</div>


