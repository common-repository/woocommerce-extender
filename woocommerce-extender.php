<?php
/**
 * Plugin Name: WooCommerce Extender
 * Description: Customize your WooCommerce shop with options like custom order button text and more
 * Plugin URI: http://wordpress.org/plugins/woocommerce-extender/
 * Version: 0.3.1
 * Author: PentagonPromotions
 * Author URI: http://www.pentagonpromotions.nl/
 * Developer: Henk Giesbers
 * Requires at least: 3.8
 * Tested up to: 4.7
 *
 * Text Domain: woocommerce-extender
 * Domain Path: /languages
 *
 * @package WooCommerce-Extender
 * @author PentagonPromotions
 */
if(!defined('ABSPATH'))
	exit;	// Exit if accessed directly
	
	
	define( 'WC_EXTEND_PLUGIN_FILE', __FILE__ );
	define( 'WC_EXTEND_VERSION', '0.3.1' );
	
	
	// Load filters
	include_once('filters/checkout.php');	// Checkout filters
	
	// Load hooks
	include_once('hooks/checkout.php');		// Checkout hooks


/**
 * Plugin initialize
 *
 * Load textdomain
 * Check if WooCommerce is active and load hooks
*/
add_action('plugins_loaded', 'wc_extend_init');
function wc_extend_init() {
	
	// Load plugin textdomain
	load_plugin_textdomain('woocommerce-extender', false, dirname(plugin_basename(__FILE__)) . '/languages/');
	
	// Check if WooCommerce is active
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) )
	{
		// Add admin option panel
		include_once('admin/options.php');
	}
	else
	{
		// Show WooCommerce inactive message
		add_action( 'admin_notices', 'wc_extend_wc_inactive' );
	}
	
}

/** 
 * Admin message for missing WooCommerce
*/
function wc_extend_wc_inactive() {
?>
    <div class="notice notice-success is-dismissible">
        <p><?php _e( 'Please install and activate WooCommerce before using WooCommerce Extender.', 'woocommerce-extender' ); ?></p>
    </div>
<?php
}


/** 
 * Add settings link to plugin page
*/
add_filter('plugin_action_links', 'wc_extend_plugin_action_links', 10, 2);
function wc_extend_plugin_action_links($links, $file) {

    if ($file == plugin_basename( WC_EXTEND_PLUGIN_FILE )) {
		// Add support button
		$settings_link = '<a href="http://wordpress.org/support/plugin/woocommerce-extender/" target="_blank">'.__('Support', 'woocommerce-extender').'</a>';
        array_unshift($links, $settings_link);
		
		// Add settings page button
        $settings_link = '<a href="' . admin_url('admin.php?page=wc-settings&tab=regulation') . '">'.__('Settings', 'woocommerce-extender').'</a>';
        array_unshift($links, $settings_link);
    }

    return $links;
}

