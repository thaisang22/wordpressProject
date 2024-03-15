<?php
/**
 * The premium page.
 *
 * @since      2.2.0
 * @package    Woo_Product_Slider
 * @subpackage Woo_Product_Slider/Admin/Helper
 * @author     ShapedPlugin <support@shapedplugin.com>
 */

namespace ShapedPlugin\WooProductSlider\Admin\Helper;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}  // if direct access.

/**
 * The premium page class.
 */
class Premium_Page {

	/**
	 * Single instance of the class
	 *
	 * @var null
	 * @since 2.2.0
	 */
	protected static $_instance = null;

	/**
	 * Main Instance
	 *
	 * @since 2.2.0
	 * @static
	 * @return self Main instance
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * Initialize the class
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'premium_admin_menu' ), 80 );
	}

	/**
	 * Add admin menu.
	 *
	 * @since 2.2.0
	 * @return void
	 */
	public function premium_admin_menu() {
		$landing_page = 'https://shapedplugin.com/woocommerce-product-slider/pricing/?ref=1';
		add_submenu_page(
			'edit.php?post_type=sp_wps_shortcodes',
			__( 'Product Slider Premium', 'woo-product-slider' ),
			'<span class="sp-go-pro-icon"></span>Go Pro',
			'manage_options',
			$landing_page
		);
	}
}
