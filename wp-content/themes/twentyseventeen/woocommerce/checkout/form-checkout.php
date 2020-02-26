<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}

?>

<script>
(function(){  // анонимная функция (function(){ })(), чтобы переменные "a" и "b" не стали глобальными
var a = document.querySelector('#order_review'), b = null;  // селектор блока, который нужно закрепить
window.addEventListener('scroll', Ascroll, false);
document.body.addEventListener('scroll', Ascroll, false);  // если у html и body высота равна 100%
function Ascroll() {
  if (b == null) {  // добавить потомка-обёртку, чтобы убрать зависимость с соседями
    var Sa = getComputedStyle(a, ''), s = '';
    for (var i = 0; i < Sa.length; i++) {  // перечислить стили CSS, которые нужно скопировать с родителя
      if (Sa[i].indexOf('overflow') == 0 || Sa[i].indexOf('padding') == 0 || Sa[i].indexOf('border') == 0 || Sa[i].indexOf('outline') == 0 || Sa[i].indexOf('box-shadow') == 0 || Sa[i].indexOf('background') == 0) {
        s += Sa[i] + ': ' +Sa.getPropertyValue(Sa[i]) + '; '
      }
    }
    b = document.createElement('div');  // создать потомка
    b.style.cssText = s + ' box-sizing: border-box; width: ' + a.offsetWidth + 'px;';
    a.insertBefore(b, a.firstChild);  // поместить потомка в цепляющийся блок первым
    var l = a.childNodes.length;
    for (var i = 1; i < l; i++) {  // переместить во вновь созданного потомка всех остальных потомков (итого: создан потомок-обёртка, внутри которого по прежнему работают скрипты)
      b.appendChild(a.childNodes[1]);
    }
    a.style.height = b.getBoundingClientRect().height + 'px';  // если под скользящим элементом есть другие блоки, можно своё значение
    a.style.padding = '0';
    a.style.border = '0';  // если элементу присвоен padding или border
  }
  if (a.getBoundingClientRect().top <= 0) { // elem.getBoundingClientRect() возвращает в px координаты элемента относительно верхнего левого угла области просмотра окна браузера
    b.className = 'sticky';
  } else {
    b.className = '';
  }
  window.addEventListener('resize', function() {
    a.children[0].style.width = getComputedStyle(a, '').width
  }, false);  // если изменить размер окна браузера, измениться ширина элемента
}
})()
</script>













<style>
ul.wc_payment_methods.payment_methods.methods {
    text-align: left;
}
@media (min-width:200px) and (max-width:1279px){div#order_review {margin-right: none;}}
@media (min-width:1800px) and (max-width:1920px){div#order_review {margin-right: 800px;}}
@media (min-width:1700px) and (max-width:1799px){div#order_review {margin-right: 700px;}}
@media (min-width:1600px) and (max-width:1699px){div#order_review {margin-right: 700px;}}
@media (min-width:1500px) and (max-width:1599px){div#order_review {margin-right: 700px;}}
@media (min-width:1400px) and (max-width:1499px){div#order_review {margin-right: 600px;}}
@media (min-width:1280px) and (max-width:1399px){div#order_review {margin-right: 300px;}}

@media (min-width:1300px) and (max-width:1920px){
    .wc_payment_method input.input-radio[name=payment_method]+label::before {

    width: 9px;
    height: 9px;}
#shipping_method li>label {
    text-align: left;
}
.payment_box.payment_method_bacs {
    display: none!important;
}

.wc_payment_method>label:first-of-type {
    margin: 1em 0;
    font-size: 12px;
}

#shipping_method li>label {
    text-align: left;
    font-size: 13px;
}
div#order_review {
    right: 0;
    position: fixed;
    top: 0px;
    z-index: 222;
    background: white;
    width: 341px;
    text-align: center;
    padding-left: 20px;
    padding-right: 20px;
    padding-top: 20px;
    padding-bottom: 20px;
    border: 1px solid #cccccc;

    margin-top: 205px;
}

.payment_box.payment_method_cod {
    display: none!important;
}

button#place_order {
    height: 50px;
    padding-top: 5px;
    padding-bottom: 5px;
    font-size: 12px;
    background: #2d2e83;
}

tr.cart_item {
    display: none;
}

table.shop_table.woocommerce-checkout-review-order-table>thead {
    display: none;
}

.woocommerce-privacy-policy-text {
    display: none;
}
}
p.form-row.form-row-last {
    float: left;
    width: 100%;
}
 </style>
 <style>
  @media screen and (min-width: 1300px){
    div#primary {

    width: 66%!important;
    border-right: 1px solid #2d2e83!important;
    padding-right: 6px;
}
.has-sidebar #secondary {
    width: 27%!important;
}


.site-content {padding-bottom: 0px!important;}





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
}
</style>
<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

	<?php if ( $checkout->get_checkout_fields() ) : ?>

		<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

		<div class="col2-set" id="customer_details">
			<div class="col-1">
				<?php do_action( 'woocommerce_checkout_billing' ); ?>
			</div>

			<div class="col-2">
				<?php do_action( 'woocommerce_checkout_shipping' ); ?>
			</div>
		</div>

		<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

	<?php endif; ?>

	<?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>

	<h3 id="order_review_heading"><?php esc_html_e( 'Your order', 'woocommerce' ); ?></h3>

	<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

	<div id="order_review" class="woocommerce-checkout-review-order">
		<?php do_action( 'woocommerce_checkout_order_review' ); ?>
	</div>

	<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>

</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
