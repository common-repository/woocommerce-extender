<?php
/**
 * WooCommerce Extender admin options
 *
 * Admin options panel
 *
 * @package		WooCommerce-Extender/admin
 * @author 		PentagonPromotions
 */
if(!defined('ABSPATH'))
	exit;	// Exit if accessed directly





class WC_Regulation_settings {

    /**
     * Bootstraps the class and hooks required actions & filters.
     *
     */
    public static function init() {
        add_filter( 'woocommerce_settings_tabs_array', __CLASS__ . '::add_settings_tab', 50 );
        add_action( 'woocommerce_settings_tabs_regulation', __CLASS__ . '::settings_tab' );
        add_action( 'woocommerce_update_options_regulation', __CLASS__ . '::update_settings' );
    }
    
    
    /**
     * Add a new settings tab to the WooCommerce settings tabs array.
     *
     * @param array $settings_tabs Array of WooCommerce setting tabs & their labels, excluding the Subscription tab.
     * @return array $settings_tabs Array of WooCommerce setting tabs & their labels, including the Subscription tab.
     */
    public static function add_settings_tab( $settings_tabs ) {
        $settings_tabs['regulation'] = __( 'Regulation', 'woocommerce-extender' );
        return $settings_tabs;
    }


    /**
     * Uses the WooCommerce admin fields API to output settings via the @see woocommerce_admin_fields() function.
     *
     * @uses woocommerce_admin_fields()
     * @uses self::get_settings()
     */
    public static function settings_tab() {
        woocommerce_admin_fields( self::get_settings() );
    }


    /**
     * Uses the WooCommerce options API to save settings via the @see woocommerce_update_options() function.
     *
     * @uses woocommerce_update_options()
     * @uses self::get_settings()
     */
    public static function update_settings() {
        woocommerce_update_options( self::get_settings() );
    }


    /**
     * Get all the settings for this plugin for @see woocommerce_admin_fields() function.
     *
     * @return array Array of settings for @see woocommerce_admin_fields() function.
     */
    public static function get_settings() {

        $settings = array(
            'section_title' => array(
                'name'     => __( 'Checkout', 'woocommerce-extender' ),
                'type'     => 'title',
                'desc'     => '',
                'id'       => 'wc_regulation_section_title'
            ),
            'checkout_text' => array(
                'name' => __( 'Checkout text', 'woocommerce-extender' ),
                'type' => 'text',
                'desc' => __( 'The checkout button text, it should make it clear that there is an payment obligation.', 'woocommerce-extender' ),
                'id'   => 'wc_regulation_checkout_text'
            ),
            'checkout_notice' => array(
                'name' => __( 'Checkout notice', 'woocommerce-extender' ),
                'type' => 'textarea',
                'desc' => __( 'An additional text shown afther the checkout by the customer.', 'woocommerce-extender' ),
                'id'   => 'wc_regulation_checkout_notice'
            ),
            'section_end' => array(
                 'type' => 'sectionend',
                 'id' => 'wc_regulation_section_end'
            )
        );
		
        return apply_filters( 'wc_regulation_settings', $settings );
    }

}

WC_Regulation_settings::init();