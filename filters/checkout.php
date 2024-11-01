<?php
/**
 * WooCommerce Extender Checkout filters
 *
 * Change checkout button text
 *
 * @package		WooCommerce-Extender/Filters
 * @author 		PentagonPromotions
 */
if(!defined('ABSPATH'))
	exit;	// Exit if accessed directly

/**
 * Change the checkout button text
 */
add_filter('woocommerce_order_button_text', 'wc_extend_checkout_button',10,1);

function wc_extend_checkout_button($text)
{
	$string = get_option('wc_regulation_checkout_text', false);
	
	if($string != false)
	{
		return $string;
	}
}