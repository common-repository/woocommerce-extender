<?php
/**
 * WooCommerce Extender Checkout hooks
 *
 * Add custom text to checkout page
 *
 * @package		WooCommerce-Extender/Hooks
 * @author 		PentagonPromotions
 */
if(!defined('ABSPATH'))
	exit;	// Exit if accessed directly


/**
 * Change the checkout button text
 */
add_action('woocommerce_after_checkout_form', 'wc_extend_checkout_notice',10,0);

function wc_extend_checkout_notice()
{
	$string = get_option('wc_regulation_checkout_notice', false);
	
	if($string != false)
	{
		echo $string;
	}
}