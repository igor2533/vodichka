<?php

/** Add theme support */
require get_template_directory() . '/includes/theme-support.php';
/** Enqueue scripts */
require get_template_directory() . '/includes/enqueue-scripts-style.php';
/** Various clean up functions */
require get_template_directory() . '/includes/cleanup.php';
/** Return entry meta information for posts */
require get_template_directory() . '/includes/meta-data.php';
/** Create widget areas in sidebar and footer */
require get_template_directory() . '/includes/widget-areas.php';
/** Add register nav menu */
require get_template_directory() . '/includes/navigation.php';


/** Add Woocommerce files */
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	require get_template_directory() . '/woocommerce/includes/wc-cart-functions.php';
	require get_template_directory() . '/woocommerce/includes/wc-checkout-functions.php';
	require get_template_directory() . '/woocommerce/includes/wc-custom-fields.php';
	require get_template_directory() . '/woocommerce/includes/wc-function.php';
	require get_template_directory() . '/woocommerce/includes/wc-remove-functions.php';
}

$args = array(

	'page_title' => 'Options',

	'menu_title' => '',

	'menu_slug' => '',

	'capability' => 'edit_posts',


	'position' => false,

	/* (string) The slug of another WP admin page. if set, this will become a child page. */
	'parent_slug' => '',

	/* (string) The icon class for this menu. Defaults to default WordPress gear.
	Read more about dashicons here: https://developer.wordpress.org/resource/dashicons/ */
	'icon_url' => false,

	/* (boolean) If set to true, this options page will redirect to the first child page (if a child page exists).
	If set to false, this parent page will appear alongside any child pages. Defaults to true */
	'redirect' => true,

	/* (int|string) The '$post_id' to save/load data to/from. Can be set to a numeric post ID (123), or a string ('user_2').
	Defaults to 'options'. Added in v5.2.7 */
	'post_id' => 'options',

	/* (boolean)  Whether to load the option (values saved from this options page) when WordPress starts up.
	Defaults to false. Added in v5.2.8. */
	'autoload' => false,

	/* (string) The update button text. Added in v5.3.7. */
	'update_button'		=> __('Update', 'acf'),

	/* (string) The message shown above the form on submit. Added in v5.6.0. */
	'updated_message'	=> __("Options Updated", 'acf'),

);
acf_add_options_page( $args );




 add_filter( 'woocommerce_checkout_fields' , 'customize_checkout_fields' );
  
function customize_checkout_fields( $fields ) {
 
 /*
 unset($fields['billing']['billing_first_name']);
unset($fields['billing']['billing_last_name']);
unset($fields['billing']['billing_company']);
unset($fields['billing']['billing_address_1']);
unset($fields['billing']['billing_address_2']);
unset($fields['billing']['billing_city']);
unset($fields['billing']['billing_postcode']);
unset($fields['billing']['billing_country']);
unset($fields['billing']['billing_state']);
unset($fields['billing']['billing_phone']);
unset($fields['order']['order_comments']);
unset($fields['billing']['billing_email']);
unset($fields['account']['account_username']);
unset($fields['account']['account_password']);
unset($fields['account']['account_password-2']);*/
 
 
 
 
    return $fields;}
	
	
	
	
	
	
	 function woocommerce_form_field_radio( $key, $args, $value = '' ) {
                global $woocommerce;
                    $defaults = array(
                                    'type' => 'radio',
                                    'label' => '',
                                    'placeholder' => '',
                                    'required' => false,
                                    'class' => array( ),
                                    'label_class' => array( ),
                                    'return' => false,
                                    'options' => array( )
                    );
                    $args     = wp_parse_args( $args, $defaults );
                    if ( ( isset( $args[ 'clear' ] ) && $args[ 'clear' ] ) )
                                    $after = '<div class="clear"></div>';
                    else
                                    $after = '';
                    $required = ( $args[ 'required' ] ) ? ' <abbr class="required" title="' . esc_attr__( 'required', 'woocommerce' ) . '">*</abbr>' : '';
                    switch ( $args[ 'type' ] ) {
                                    case "select":
                                                    $options = '';
                                                    if ( !empty( $args[ 'options' ] ) )
                                                                    foreach ( $args[ 'options' ] as $option_key => $option_text )
                                                                                    $options .= '<input type="radio" name="' . $key . '" id="' . $key . '" value="' . $option_key . '" ' . selected( $value, $option_key, false ) . 'class="select">' . $option_text . '' . "\r\n";
                                                    $field = '<p class="form-row ' . implode( ' ', $args[ 'class' ] ) . '" id="' . $key . '_field">
    <label for="' . $key . '" class="' . implode( ' ', $args[ 'label_class' ] ) . '">' . $args[ 'label' ] . $required . '</label>
    ' . $options . '
    </p>' . $after;
                                                    break;
                    } //$args[ 'type' ]
                    if ( $args[ 'return' ] )
                                    return $field;
                    else
                                    echo $field;
    }
    /**
     * Add the field to the checkout - Добавляем поле в оплату
     **/
    add_action( 'woocommerce_after_checkout_billing_form', 'shipping_type_field', 10 );
    function shipping_type_field( $checkout ) {
                    echo '<div id="shipping_type_field" >'  . '';
                    woocommerce_form_field_radio( 'shipping_type', array(
                                     'type' => 'select',
                                    'class' => array(
                                                     'shipping_type form-row-wide'
                                    ),
                                    'label' => __( 'Способ доставки' ),
                                    'placeholder' => __( '' ),
                                    'required' => true,
                                    'options' => array(
                                                    'Самовывоз' => 'Самовывоз<br/>',
                                                    'Новая почта склад' => 'Новая Почта, доставка до склада<br/>',
                                                    'Новая почта двери' => 'Новая Почта, доставка до адреса<br/>',
                                                    'Гюнсел' => 'Гюнсел'
                                                  )
                    ), $checkout->get_value( 'shipping_type' ) );
                    echo '</div>';
    }
    /**
     * Process the checkout - проверка на обязательность поля
     **/
    add_action( 'woocommerce_checkout_process', 'my_custom_checkout_field_process' );
    function my_custom_checkout_field_process( ) {
                    global $woocommerce;
                    // Check if set, if its not set add an error.
                    if ( !$_POST[ 'shipping_type' ] )
                                    $woocommerce->add_error( __( 'Пожалуйста, выберите способ доставки' ) );
    }
    /**
     * Update the order meta with field value - обновление данных заказа с учетом нового поля
     **/
    add_action( 'woocommerce_checkout_update_order_meta', 'shipping_type_field_update_order_meta' );
    function shipping_type_field_update_order_meta( $order_id ) {
                    if ( $_POST[ 'shipping_type' ] )
                                    update_post_meta( $order_id, 'Shipping type', esc_attr( $_POST[ 'shipping_type' ] ) );
    }
/**
* Display field value on the order edition page - отображение нового поля в админке
**/
add_action( 'woocommerce_admin_order_data_after_billing_address', 'shipping_type_field_display_admin_order_meta', 10, 1 );
function shipping_type_field_display_admin_order_meta($order){
echo '<p><strong>'.__('Способ доставки').':</strong> ' . $order->order_custom_fields['Shipping type'][0] . '</p>';
}
/**
* Add the field to order emails - добавить новое поле в e-mail-сообщение
**/
add_filter('woocommerce_email_order_meta_keys', 'my_woocommerce_email_order_meta_keys');
function my_woocommerce_email_order_meta_keys( $keys ) {
$keys['Способ доставки'] = 'shipping_type';
return $keys;
}
	
	
	
	
	
	
	





