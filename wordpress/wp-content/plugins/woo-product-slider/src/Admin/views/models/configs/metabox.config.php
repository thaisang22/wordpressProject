<?php
/**
 * Metabox page configuration.
 *
 * @since      2.2.0
 * @package    Woo_Product_Slider
 * @subpackage Woo_Product_Slider/Admin/view
 * @author     ShapedPlugin <support@shapedplugin.com>
 */

use ShapedPlugin\WooProductSlider\Admin\views\models\classes\SPF_WPSP;

if ( ! defined( 'ABSPATH' ) ) {
	die; }
// Cannot access pages directly.

/**
 * Product slider metabox prefix.
 */
$prefix = 'sp_wps_shortcode_options';

$smart_brand_plugin_link = 'smart-brands-for-woocommerce/smart-brands-for-woocommerce.php';
$smart_brand_plugin_data = SPF_WPSP::plugin_installation_activation(
	$smart_brand_plugin_link,
	'Install Now',
	'activate_plugin',
	array(
		'ShapedPlugin\SmartBrands\SmartBrands',
		'ShapedPlugin\SmartBrandsPro\SmartBrandsPro',
	),
	'smart-brands-for-woocommerce'
);

// Woo quick view Plugin.
$quick_view_plugin_link = 'woo-quickview/woo-quick-view.php';
$quick_view_plugin_data = SPF_WPSP::plugin_installation_activation(
	$quick_view_plugin_link,
	'Install Now',
	'activate_plugin',
	array(
		'SP_Woo_Quick_View',
		'SP_Woo_Quick_View_Pro',
	),
	'woo-quickview'
);

/**
 * Create a metabox for product slider.
 */
SPF_WPSP::createMetabox(
	$prefix,
	array(
		'title'     => __( 'Slider Options', 'woo-product-slider' ),
		'post_type' => 'sp_wps_shortcodes',
		'context'   => 'normal',
		'class'     => 'wpsp-shortcode-options',
		'nav'       => 'inline',
		'preview'   => true,
	)
);

/**
 * General Settings section.
 */
SPF_WPSP::createSection(
	$prefix,
	array(
		'title'  => __( 'General Settings', 'woo-product-slider' ),
		'icon'   => 'fa fa-cog',
		'fields' => array(
			array(
				'id'       => 'product_type',
				'type'     => 'select',
				'title'    => __( 'Filter Products', 'woo-product-slider' ),
				'subtitle' => __( 'Filter the products you want to show.', 'woo-product-slider' ),
				'options'  => array(
					'latest_products'                  => array(
						'name' => __( 'Latest', 'woo-product-slider' ),
					),
					'featured_products'                => array(
						'name' => __( 'Featured', 'woo-product-slider' ),
					),
					'products_from_categories'         => array(
						'name'     => __( 'Category (Pro)', 'woo-product-slider' ),
						'pro_only' => true,
					),
					'products_from_tags'               => array(
						'name'     => __( 'Tag (Pro)', 'woo-product-slider' ),
						'pro_only' => true,
					),
					'best_selling_products'            => array(
						'name'     => __( 'Best Selling (Pro)', 'woo-product-slider' ),
						'pro_only' => true,
					),
					'related_products'                 => array(
						'name'     => __( 'Related (Pro)', 'woo-product-slider' ),
						'pro_only' => true,
					),
					'up_sells'                         => array(
						'name'     => __( 'Upsells (Pro)', 'woo-product-slider' ),
						'pro_only' => true,
					),
					'cross_sells'                      => array(
						'name'     => __( 'Cross-sells (Pro)', 'woo-product-slider' ),
						'pro_only' => true,
					),
					'top_rated_products'               => array(
						'name'     => __( 'Top Rated (Pro)', 'woo-product-slider' ),
						'pro_only' => true,
					),
					'on_sell_products'                 => array(
						'name'     => __( 'On Sale (Pro)', 'woo-product-slider' ),
						'pro_only' => true,
					),
					'specific_products'                => array(
						'name'     => __( 'Specific (Pro)', 'woo-product-slider' ),
						'pro_only' => true,
					),
					'most_viewed_products'             => array(
						'name'     => __( 'Most Viewed (Pro)', 'woo-product-slider' ),
						'pro_only' => true,
					),
					'recently_viewed_products'         => array(
						'name'     => __( 'Recently Viewed (Pro)', 'woo-product-slider' ),
						'pro_only' => true,
					),
					'products_from_sku'                => array(
						'name'     => __( 'SKU (Pro)', 'woo-product-slider' ),
						'pro_only' => true,
					),
					'products_from_attribute'          => array(
						'name'     => __( 'Attribute (Pro)', 'woo-product-slider' ),
						'pro_only' => true,
					),
					'products_from_free'               => array(
						'name'     => __( 'Free (Pro)', 'woo-product-slider' ),
						'pro_only' => true,
					),
					'products_from_exclude_categories' => array(
						'name'     => __( 'Exclude Category (Pro)', 'woo-product-slider' ),
						'pro_only' => true,
					),
					'products_from_exclude_tags'       => array(
						'name'     => __( 'Exclude Tag (Pro)', 'woo-product-slider' ),
						'pro_only' => true,
					),

				),
				'default'  => 'latest_products',
			),
			array(
				'id'       => 'hide_out_of_stock_product',
				'type'     => 'checkbox',
				'title'    => __( 'Hide Out of Stock Products', 'woo-product-slider' ),
				'subtitle' => __( 'Check to hide out of stock products.', 'woo-product-slider' ),
				'default'  => false,
			),
			array(
				'id'         => 'hide_on_sale_product',
				'type'       => 'checkbox',
				'class'      => 'pro_only_field',
				'attributes' => array( 'disabled' => 'disabled' ),
				'title'      => __( 'Hide On Sale Products', 'woo-product-slider' ),
				'subtitle'   => __( 'Check to hide on sale products.', 'woo-product-slider' ),
				'default'    => false,
			),
			array(
				'id'       => 'product_order_by',
				'type'     => 'select',
				'title'    => __( 'Order by', 'woo-product-slider' ),
				'subtitle' => __( 'Set a order by option.', 'woo-product-slider' ),
				'options'  => array(
					'ID'       => array(
						'name' => __( 'ID', 'woo-product-slider' ),
					),
					'date'     => array(
						'name' => __( 'Date', 'woo-product-slider' ),
					),
					'rand'     => array(
						'name' => __( 'Random', 'woo-product-slider' ),
					),
					'title'    => array(
						'name' => __( 'Title', 'woo-product-slider' ),
					),
					'modified' => array(
						'name' => __( 'Modified', 'woo-product-slider' ),
					),
				),
				'default'  => 'date',
			),
			array(
				'id'       => 'product_order',
				'type'     => 'select',
				'title'    => __( 'Order', 'woo-product-slider' ),
				'subtitle' => __( 'Set product order.', 'woo-product-slider' ),
				'options'  => array(
					'ASC'  => array(
						'name' => __( 'Ascending', 'woo-product-slider' ),
					),
					'DESC' => array(
						'name' => __( 'Descending', 'woo-product-slider' ),
					),
				),
				'default'  => 'DESC',
			),
			array(
				'id'       => 'number_of_total_products',
				'type'     => 'spinner',
				'title'    => __( 'Limit', 'woo-product-slider' ),
				'subtitle' => __( 'Set number of total products to show.', 'woo-product-slider' ),
				'sanitize' => 'spwps_sanitize_number_field',
				'default'  => 16,
				'max'      => 60000,
				'min'      => -1,
			),
			array(
				'id'         => 'preloader',
				'type'       => 'switcher',
				'title'      => __( 'Preloader', 'woo-product-slider' ),
				'subtitle'   => __( 'Products showcase will be hidden until page load completed.', 'woo-product-slider' ),
				'text_on'    => __( 'Enabled', 'woo-product-slider' ),
				'text_off'   => __( 'Disabled', 'woo-product-slider' ),
				'text_width' => 96,
				'default'    => true,
			),
			array(
				'type'    => 'notice',
				'content' => __( 'To unlock <strong>16+ Advanced Products Filtering options</strong>, Replace Shop Pages layout, and <strong>50+ Amazing Features To Boost Sales</strong>, <a  href="https://shapedplugin.com/woocommerce-product-slider/pricing/?ref=1" target="_blank"><b>Upgrade To Pro!</b></a>', 'woo-product-slider' ),
			),
		),
	)
);
SPF_WPSP::createSection(
	$prefix,
	array(
		'title'  => __( 'Template Settings', 'woo-product-slider' ),
		'icon'   => 'wps-icon-swatchbook-solid',
		'fields' => array(
			array(
				'id'         => 'layout_preset',
				'class'      => 'layout_preset',
				'type'       => 'image_select',
				'title'      => __( 'Layout Preset', 'woo-product-slider' ),
				'subtitle'   => __( 'Choose a layout preset.', 'woo-product-slider' ),
				'desc'       => __( 'To unlock <strong> Masonry, Table</strong> layout, <a href="https://shapedplugin.com/woocommerce-product-slider/pricing/?ref=1" target="_blank"><b>Upgrade To Pro!</b></a>', 'woo-product-slider' ),
				'image_name' => true,
				'options'    => array(
					'slider'  => array(
						'img' => SPF_WPSP::include_plugin_url( 'assets/images/slider.svg' ),
					),
					'grid'    => array(
						'img' => SPF_WPSP::include_plugin_url( 'assets/images/grid.svg' ),
					),
					'masonry' => array(
						'img'      => SPF_WPSP::include_plugin_url( 'assets/images/masonry.svg' ),
						'pro_only' => true,
					),
					'table'   => array(
						'img'      => SPF_WPSP::include_plugin_url( 'assets/images/table.svg' ),
						'pro_only' => true,
					),
				),
				'default'    => 'slider',
			),
			array(
				'id'       => 'number_of_column',
				'type'     => 'column',
				'title'    => __( 'Column(s)', 'woo-product-slider' ),
				'subtitle' => __( 'Set products column(s) in different devices.', 'woo-product-slider' ),
				'sanitize' => 'spwps_sanitize_number_array_field',
				'default'  => array(
					'number1' => '4',
					'number2' => '3',
					'number3' => '2',
					'number4' => '1',
				),
			),
			array(
				'id'         => 'template_style',
				'class'      => 'template_style',
				'type'       => 'button_set',
				'title'      => __( 'Choose a Template Type', 'woo-product-slider' ),
				'subtitle'   => __( 'Choose a template whether custom or pre-made.', 'woo-product-slider' ),
				'options'    => array(
					'custom'   => array(
						'name' => __( 'Custom', 'woo-product-slider' ),
					),
					'pre-made' => array(
						'name' => __( 'Pre-made Templates', 'woo-product-slider' ),
					),
				),
				'default'    => 'pre-made',
				'dependency' => array( 'layout_preset', '!=', 'table', true ),
			),
			array(
				'id'         => 'theme_style',
				'class'      => 'theme_style',
				'type'       => 'select',
				'title'      => __( 'Select Your Pre-made Template', 'woo-product-slider' ),
				'subtitle'   => __( 'Select which template style you want to display. See  <a href="https://shapedplugin.com/woocommerce-product-slider/28-pre-made-product-templates/" target="_blank">templates</a> in action!', 'woo-product-slider' ),
				'desc'       => __( 'To unlock <strong>28+ Pre-made beautiful templates</strong>, <a href="https://shapedplugin.com/woocommerce-product-slider/pricing/?ref=1" target="_blank"><b>Upgrade To Pro!</b></a>', 'woo-product-slider' ),
				'options'    => array(
					'theme_one'   => array(
						'name' => __( 'Template One', 'woo-product-slider' ),
					),
					'theme_two'   => array(
						'name' => __( 'Template Two', 'woo-product-slider' ),
					),
					'theme_three' => array(
						'name' => __( 'Template Three', 'woo-product-slider' ),
					),
					'theme_four'  => array(
						'name'     => __( '28+ Templates (Pro)', 'woo-product-slider' ),
						'pro_only' => true,
					),
				),
				'default'    => 'theme_one',
				'preview'    => true,
				'dependency' => array( 'template_style|layout_preset', '==|!=', 'pre-made|table', true ),
			),

			array(
				'id'         => 'content_position',
				'type'       => 'image_select',
				'class'      => 'grid_style',
				'title'      => __( 'Product Content Position', 'woo-product-slider' ),
				'subtitle'   => __( 'Select a position for the product name, content, meta etc.', 'woo-product-slider' ),
				'image_name' => true,
				'options'    => array(
					'bottom'  => array(
						'img' => SPF_WPSP::include_plugin_url( 'assets/images/bottom.svg' ),
					),
					'top'     => array(
						'img'      => SPF_WPSP::include_plugin_url( 'assets/images/top.svg' ),
						'pro_only' => true,
					),
					'right'   => array(
						'img'      => SPF_WPSP::include_plugin_url( 'assets/images/right.svg' ),
						'pro_only' => true,
					),
					'left'    => array(
						'img'      => SPF_WPSP::include_plugin_url( 'assets/images/left.svg' ),
						'pro_only' => true,
					),
					'overlay' => array(
						'img'      => SPF_WPSP::include_plugin_url( 'assets/images/overlay.svg' ),
						'pro_only' => true,

					),
				),
				'default'    => 'bottom',
				'dependency' => array( 'template_style|layout_preset', '==|!=', 'custom|table', true ),
			),
			array(
				'id'         => 'product_content_padding',
				'type'       => 'spacing',
				'title'      => __( 'Content Padding', 'woo-product-slider' ),
				'subtitle'   => __( 'Set padding for the product content.', 'woo-product-slider' ),
				'style'      => false,
				'color'      => false,
				'all'        => false,
				'units'      => array( 'px' ),
				'default'    => array(
					'top'    => '18',
					'right'  => '20',
					'bottom' => '20',
					'left'   => '20',
				),
				'attributes' => array(
					'min' => 0,
				),
				'dependency' => array( 'template_style|layout_preset', '==|!=', 'custom|table', true ),
			),
			array(
				'id'          => 'product_border',
				'type'        => 'border',
				'title'       => __( 'Border', 'woo-product-slider' ),
				'subtitle'    => __( 'Set product border.', 'woo-product-slider' ),
				'all'         => true,
				'hover_color' => true,
				'default'     => array(
					'all'         => '1',
					'style'       => 'solid',
					'color'       => '#dddddd',
					'hover_color' => '#dddddd',
				),
				'dependency'  => array( 'template_style|layout_preset', '==|!=', 'custom|table', true ),
			),
			array(
				'id'         => 'carousel_same_height',
				'type'       => 'switcher',
				'class'      => 'pro_only_field ',
				'title'      => __( 'Equalize Products Height', 'woo-product-slider' ),
				'subtitle'   => __( 'Enable to equalize products same height.', 'woo-product-slider' ),
				'text_on'    => __( 'Enabled', 'woo-product-slider' ),
				'text_off'   => __( 'Disabled', 'woo-product-slider' ),
				'text_width' => 96,
				'default'    => false,
				'dependency' => array( 'layout_preset', 'any', 'grid,slider', true ),
			),
			array(
				'type'       => 'subheading',
				'content'    => __( 'Pagination', 'woo-product-slider' ),
				'dependency' => array( 'layout_preset', '==', 'grid', true ),
			),
			array(
				'id'         => 'grid_pagination',
				'type'       => 'switcher',
				'title'      => __( 'Pagination', 'woo-product-slider' ),
				'subtitle'   => __( 'Enable/Disable pagination.', 'woo-product-slider' ),
				'text_on'    => __( 'Enabled', 'woo-product-slider' ),
				'text_off'   => __( 'Disabled', 'woo-product-slider' ),
				'text_width' => 96,
				'default'    => true,
				'dependency' => array( 'layout_preset', '==', 'grid', true ),
			),
			array(
				'id'         => 'grid_pagination_type',
				'class'      => 'pagination_pro_field ',
				'type'       => 'radio',
				'title'      => __( 'Pagination Type', 'woo-product-slider' ),
				'subtitle'   => __( 'Choose a pagination type.', 'woo-product-slider' ),
				'desc'       => __( 'To unlock Ajax Number, Load More & Load More on Scroll, <a href="https://shapedplugin.com/woocommerce-product-slider/pricing/?ref=1" target="_blank"><b>Upgrade To Pro!</b></a>', 'woo-product-slider' ),
				'options'    => array(
					'normal'           => __( 'Normal', 'woo-product-slider' ),
					'ajax_number'      => __( 'Ajax Number (Pro)', 'woo-product-slider' ),
					'load_more_btn'    => __( 'Ajax Load More Button (Pro)', 'woo-product-slider' ),
					'load_more_scroll' => __( 'Ajax Load More on Scroll (Pro)', 'woo-product-slider' ),
				),
				'default'    => 'normal',
				'dependency' => array( 'grid_pagination|layout_preset', '==|==', 'true|grid' ),
			),
			array(
				'id'         => 'grid_pagination_alignment',
				'type'       => 'button_set',
				'title'      => __( 'Alignment', 'woo-product-slider' ),
				'subtitle'   => __( 'Select pagination alignment.', 'woo-product-slider' ),
				'options'    => array(
					'wpspro-align-left'   => array(
						'name' => '<i title="Left" class="fa fa-align-left"></i>',
					),
					'wpspro-align-center' => array(
						'name' => '<i title="Left" class="fa fa-align-center"></i>',
					),
					'wpspro-align-right'  => array(
						'name' => '<i title="Left" class="fa fa-align-right"></i>',
					),
				),
				'default'    => 'wpspro-align-center',
				'dependency' => array( 'grid_pagination|layout_preset', '==|==', 'true|grid' ),
			),

			array(
				'id'         => 'products_per_page',
				'type'       => 'spinner',
				'title'      => __( 'Product(s) To Show Per Page', 'woo-product-slider' ),
				'subtitle'   => __( 'Set number of product(s) to show in per page.', 'woo-product-slider' ),
				'default'    => 8,
				'dependency' => array( 'grid_pagination|layout_preset', '==|==', 'true|grid' ),
			),
			array(
				'id'         => 'grid_pagination_colors',
				'type'       => 'color_group',
				'title'      => __( 'Pagination Color', 'woo-product-slider' ),
				'subtitle'   => __( 'Set color for the pagination.', 'woo-product-slider' ),
				'options'    => array(
					'color'            => __( 'Color', 'woo-product-slider' ),
					'hover_color'      => __( 'Hover Color', 'woo-product-slider' ),
					'background'       => __( 'Background', 'woo-product-slider' ),
					'hover_background' => __( 'Hover Background', 'woo-product-slider' ),
					'border'           => __( 'Border', 'woo-product-slider' ),
					'hover_border'     => __( 'Hover Border', 'woo-product-slider' ),
				),
				'default'    => array(
					'color'            => '#5e5e5e',
					'hover_color'      => '#ffffff',
					'background'       => 'transparent',
					'hover_background' => '#5e5e5e',
					'border'           => '#dddddd',
					'hover_border'     => '#5e5e5e',
				),
				'dependency' => array( 'grid_pagination|layout_preset', '==|==', 'true|grid' ),
			),
		),
	)
);

/**
 * Display Options section.
 */
SPF_WPSP::createSection(
	$prefix,
	array(
		'title'  => __( 'Display Options', 'woo-product-slider' ),
		'icon'   => 'fa fa-th-large',
		'fields' => array(
			array(
				'id'         => 'slider_title',
				'type'       => 'switcher',
				'title'      => __( 'Product Showcase Section Title', 'woo-product-slider' ),
				'subtitle'   => __( 'Show/Hide product showcase section title.', 'woo-product-slider' ),
				'text_on'    => __( 'Show', 'woo-product-slider' ),
				'text_off'   => __( 'Hide', 'woo-product-slider' ),
				'text_width' => 77,
				'default'    => false,
			),
			array(
				'id'         => 'ajax_search',
				'type'       => 'switcher',
				'class'      => 'pro_only_field ',
				'title'      => __( 'Ajax Product Search', 'woo-product-slider' ),
				'subtitle'   => __( 'Enable/Disable ajax search for product.', 'woo-product-slider' ),
				'text_on'    => __( 'Enabled', 'woo-product-slider' ),
				'text_off'   => __( 'Disabled', 'woo-product-slider' ),
				'default'    => false,
				'text_width' => 96,

			),
			array(
				'type'    => 'subheading',
				'content' => __( 'Product Name', 'woo-product-slider' ),
			),
			array(
				'id'         => 'product_name',
				'type'       => 'switcher',
				'title'      => __( 'Name', 'woo-product-slider' ),
				'subtitle'   => __( 'Show/Hide product name.', 'woo-product-slider' ),
				'text_on'    => __( 'Show', 'woo-product-slider' ),
				'text_off'   => __( 'Hide', 'woo-product-slider' ),
				'text_width' => 77,
				'default'    => true,
			),
			array(
				'id'         => 'product_name_word_limit',
				'class'      => 'pro_only_field',
				'type'       => 'checkbox',
				'disabled'   => 'disabled',
				'title'      => __( 'Limit Word', 'woo-product-slider' ),
				'subtitle'   => __( 'Check to product name word limit.', 'woo-product-slider' ),
				'default'    => false,
				'dependency' => array(
					'product_name',
					'==',
					'true',
				),
			),
			/**
			 * Product Description Settings
			 */
			array(
				'type'    => 'subheading',
				'content' => __( 'Product Description', 'woo-product-slider' ),
			),

			array(
				'id'         => 'product_content',
				'class'      => 'pro_only_field pro_only_field_group',
				'type'       => 'switcher',
				'title'      => __( 'Description', 'woo-product-slider' ),
				'subtitle'   => __( 'Show/Hide product description.', 'woo-product-slider' ),
				'text_on'    => __( 'Show', 'woo-product-slider' ),
				'text_off'   => __( 'Hide', 'woo-product-slider' ),
				'text_width' => 77,
				'default'    => false,
			),
			array(
				'id'       => 'product_content_type',
				'class'    => 'pro_only_field pro_only_field_group',
				'type'     => 'button_set',
				'title'    => __( 'Description Display Type', 'woo-product-slider' ),
				'subtitle' => __( 'Select a product description display type.', 'woo-product-slider' ),
				'options'  => array(
					'short_description' => array(
						'name' => __( 'Short', 'woo-product-slider' ),
					),
					'full_description'  => array(
						'name'     => __( 'Full', 'woo-product-slider' ),
						'pro_only' => true,
					),
				),
				'default'  => 'short_description',
			),
			array(
				'id'       => 'product_content_word_limit',
				'class'    => 'pro_only_field pro_only_field_group',
				'type'     => 'spinner',
				'title'    => __( 'Word Length', 'woo-product-slider' ),
				'subtitle' => __( 'Set word limit Length for product description.', 'woo-product-slider' ),
				'sanitize' => 'spwps_sanitize_number_field',
				'default'  => 19,
				'min'      => 1,
				'max'      => 1000,
			),
			array(
				'id'         => 'product_content_more_button',
				'type'       => 'switcher',
				'class'      => 'pro_only_field pro_only_field_group',
				'title'      => __( 'Read More Button', 'woo-product-slider' ),
				'subtitle'   => __( 'Show/Hide product description read more button.', 'woo-product-slider' ),
				'text_on'    => __( 'Show', 'woo-product-slider' ),
				'text_off'   => __( 'Hide', 'woo-product-slider' ),
				'text_width' => 77,
				'default'    => false,
			),
			array(
				'type'    => 'subheading',
				'content' => __( 'Product Price', 'woo-product-slider' ),
			),
			array(
				'id'         => 'product_price',
				'type'       => 'switcher',
				'title'      => __( 'Price', 'woo-product-slider' ),
				'subtitle'   => __( 'Show/Hide product price.', 'woo-product-slider' ),
				'text_on'    => __( 'Show', 'woo-product-slider' ),
				'text_off'   => __( 'Hide', 'woo-product-slider' ),
				'text_width' => 77,
				'default'    => true,
			),
			array(
				'id'         => 'product_del_price_color',
				'type'       => 'color',
				'title'      => __( 'Discount Color', 'woo-product-slider' ),
				'subtitle'   => __( 'Set discount price color.', 'woo-product-slider' ),
				'default'    => '#888888',
				'dependency' => array( 'product_price', '==', 'true' ),
			),
			array(
				'type'    => 'subheading',
				'content' => __( 'Product Rating', 'woo-product-slider' ),
			),
			array(
				'id'         => 'product_rating',
				'type'       => 'switcher',
				'title'      => __( 'Rating', 'woo-product-slider' ),
				'subtitle'   => __( 'Show/Hide product rating.', 'woo-product-slider' ),
				'text_on'    => __( 'Show', 'woo-product-slider' ),
				'text_off'   => __( 'Hide', 'woo-product-slider' ),
				'text_width' => 77,
				'default'    => true,
			),
			array(
				'id'         => 'product_rating_colors',
				'type'       => 'color_group',
				'title'      => __( 'Color', 'woo-product-slider' ),
				'subtitle'   => __( 'Set rating star color.', 'woo-product-slider' ),
				'options'    => array(
					'color'       => __( 'Star Color', 'woo-product-slider' ),
					'empty_color' => __( 'Empty Star Color', 'woo-product-slider' ),
				),
				'default'    => array(
					'color'       => '#F4C100',
					'empty_color' => '#C8C8C8',
				),
				'dependency' => array( 'product_rating', '==', 'true' ),
			),
			array(
				'type'    => 'subheading',
				'content' => __( 'Add to Cart Button', 'woo-product-slider' ),
			),
			array(
				'id'         => 'add_to_cart_button',
				'type'       => 'switcher',
				'title'      => __( 'Add to Cart Button', 'woo-product-slider' ),
				'subtitle'   => __( 'Show/Hide product add to cart button.', 'woo-product-slider' ),
				'text_on'    => __( 'Show', 'woo-product-slider' ),
				'text_off'   => __( 'Hide', 'woo-product-slider' ),
				'text_width' => 77,
				'default'    => true,
			),
			array(
				'id'         => 'add_to_cart_button_colors',
				'type'       => 'color_group',
				'title'      => __( 'Color', 'woo-product-slider' ),
				'subtitle'   => __( 'Set product add to cart button color.', 'woo-product-slider' ),
				'options'    => array(
					'color'            => __( 'Text Color', 'woo-product-slider' ),
					'hover_color'      => __( 'Text Hover', 'woo-product-slider' ),
					'background'       => __( 'Background', 'woo-product-slider' ),
					'hover_background' => __( 'Hover BG', 'woo-product-slider' ),
				),
				'default'    => array(
					'color'            => '#444444',
					'hover_color'      => '#ffffff',
					'background'       => 'transparent',
					'hover_background' => '#222222',
				),
				'dependency' => array( 'add_to_cart_button', '==', 'true' ),
			),
			array(
				'id'          => 'add_to_cart_border',
				'type'        => 'border',
				'title'       => __( 'Border', 'woo-product-slider' ),
				'subtitle'    => __( 'Set add to cart button border.', 'woo-product-slider' ),
				'all'         => true,
				'hover_color' => true,
				'default'     => array(
					'all'         => '1',
					'style'       => 'solid',
					'color'       => '#222222',
					'hover_color' => '#222222',
				),
				'dependency'  => array( 'add_to_cart_button', '==', 'true' ),
			),
			array(
				'id'         => 'quantity_button',
				'type'       => 'switcher',
				'class'      => 'pro_only_field ',
				'title'      => __( 'Quantities', 'woo-product-slider' ),
				'subtitle'   => __( 'Show/hide quantities selector before the add to cart.', 'woo-product-slider' ),
				'text_on'    => __( 'Show', 'woo-product-slider' ),
				'text_off'   => __( 'Hide', 'woo-product-slider' ),
				'text_width' => 77,
				'default'    => false,
				'dependency' => array(
					'add_to_cart_button',
					'==',
					'true',
					true,
				),
			),

			array(
				'type'    => 'subheading',
				'content' => __( 'Product Brands', 'woo-product-slider' ),
			),
			array(
				'id'         => 'show_product_brands',
				'type'       => 'switcher',
				'title'      => __( 'Show Brands', 'woo-product-slider' ),
				'subtitle'   => __( 'Show/Hide product brands.', 'woo-product-slider' ),
				'text_on'    => __( 'Show', 'woo-product-slider' ),
				'text_off'   => __( 'Hide', 'woo-product-slider' ),
				'text_width' => 77,
				'default'    => false,
			),
			array(
				'type'       => 'submessage',
				'style'      => 'info',
				'content'    => __( 'To Enable Product Brands feature, you must Install and Activate the <a class="thickbox open-plugin-details-modal" href="' . esc_url( $smart_brand_plugin_data['plugin_link'] ) . '">Smart Brands for WooCommerce</a> plugin. <a href="#" class="brand-plugin-install' . $smart_brand_plugin_data['has_plugin'] . '" data-url="' . $smart_brand_plugin_data['activate_plugin_url'] . '" data-nonce="' . wp_create_nonce( 'updates' ) . '" > ' . $smart_brand_plugin_data['button_text'] . ' <i class="fa fa-angle-double-right"></i></a>', 'woo-product-slider' ),
				'dependency' => array( 'show_product_brands', '==', 'true', true ),
			),
			array(
				'type'    => 'subheading',
				'content' => __( 'Quick View Button', 'woo-product-slider' ),
			),
			array(
				'id'         => 'quick_view',
				'type'       => 'switcher',
				'title'      => __( 'Show Quick View Button', 'woo-product-slider' ),
				'subtitle'   => __( 'Show/Hide quick view button.', 'woo-product-slider' ),
				'text_on'    => __( 'Show', 'woo-product-slider' ),
				'text_off'   => __( 'Hide', 'woo-product-slider' ),
				'text_width' => 77,
				'default'    => false,
			),
			array(
				'type'       => 'submessage',
				'style'      => 'info',
				'content'    => __( 'To Enable Quick view feature, you must Install and Activate the <a class="thickbox open-plugin-details-modal" href="' . esc_url( $quick_view_plugin_data['plugin_link'] ) . '">Quick View for WooCommerce</a> plugin. <a href="#" class="quick-view-install' . $quick_view_plugin_data['has_plugin'] . '" data-url="' . $quick_view_plugin_data['activate_plugin_url'] . '" data-nonce="' . wp_create_nonce( 'updates' ) . '" > ' . $quick_view_plugin_data['button_text'] . ' <i class="fa fa-angle-double-right"></i></a> ', 'woo-product-slider' ),
				'dependency' => array( 'quick_view', '==', 'true', true ),
			),

		),
	)
);

	/**
	 * Image Settings section.
	 */
	SPF_WPSP::createSection(
		$prefix,
		array(
			'title'  => __( 'Image Settings', 'woo-product-slider' ),
			'icon'   => 'fa fa-image',
			'fields' => array(
				array(
					'id'         => 'product_image',
					'type'       => 'switcher',
					'title'      => __( 'Image', 'woo-product-slider' ),
					'subtitle'   => __( 'Show/Hide product image.', 'woo-product-slider' ),
					'text_on'    => __( 'Show', 'woo-product-slider' ),
					'text_off'   => __( 'Hide', 'woo-product-slider' ),
					'text_width' => 77,
					'default'    => true,
				),
				array(
					'id'          => 'product_image_border',
					'type'        => 'border',
					'title'       => __( 'Border', 'woo-product-slider' ),
					'subtitle'    => __( 'Set product image border.', 'woo-product-slider' ),
					'all'         => true,
					'hover_color' => true,
					'default'     => array(
						'all'         => '1',
						'style'       => 'solid',
						'color'       => '#dddddd',
						'hover_color' => '#dddddd',
					),
					'dependency'  => array( 'product_image|theme_style|template_style', '==|==|!=', 'true|theme_one|custom', true ),
				),
				array(
					'id'         => 'product_image_flip',
					'type'       => 'switcher',
					'class'      => 'pro_only_field',
					'title'      => __( 'Image Flip', 'woo-product-slider' ),
					'subtitle'   => __( 'Enable/Disable product image flipping. Flipping image will be the first image of product gallery.', 'woo-product-slider' ),
					'text_on'    => __( 'Enabled', 'woo-product-slider' ),
					'text_off'   => __( 'Disabled', 'woo-product-slider' ),
					'text_width' => 96,
					'default'    => false,
					'dependency' => array(
						'product_image',
						'==',
						'true',
						true,
					),
				),
				array(
					'id'         => 'image_sizes',
					'type'       => 'image_sizes',
					'title'      => __( 'Image Size', 'woo-product-slider' ),
					'subtitle'   => __( 'Select a size for product image.', 'woo-product-slider' ),
					'default'    => 'medium',
					'dependency' => array(
						'product_image',
						'==',
						'true',
					),
				),
				array(
					'id'         => 'custom_image_size',
					'class'      => 'spwps_custom_image_option',
					'type'       => 'fieldset',
					'title'      => __( 'Custom Size', 'woo-product-slider' ),
					'subtitle'   => __( 'Set a custom width and height of the product image.', 'woo-product-slider' ),
					'dependency' => array(
						'product_image|image_sizes',
						'==|==',
						'true|custom',
						true,
					),
					'fields'     => array(
						array(
							'id'       => 'image_custom_width',
							'type'     => 'spinner',
							'title'    => __( 'Width*', 'woo-product-slider' ),
							'default'  => 250,
							'unit'     => __( 'px', 'woo-product-slider' ),
							'max'      => 10000,
							'min'      => 1,
							'sanitize' => 'spwps_sanitize_number_field',

						),
						array(
							'id'       => 'image_custom_height',
							'type'     => 'spinner',
							'title'    => __( 'Height*', 'woo-product-slider' ),
							'default'  => 300,
							'unit'     => __( 'px', 'woo-product-slider' ),
							'max'      => 10000,
							'min'      => 1,
							'sanitize' => 'spwps_sanitize_number_field',

						),
						array(
							'id'       => 'image_custom_crop',
							'type'     => 'switcher',
							'class'    => 'pro_only_field',
							'title'    => __( 'Hard Crop', 'woo-product-slider' ),
							'text_on'  => __( 'Yes', 'woo-product-slider' ),
							'text_off' => __( 'No', 'woo-product-slider' ),
							'default'  => false,
						),
					),
				),
				array(
					'id'         => 'load_2x_image',
					'type'       => 'switcher',
					'class'      => 'pro_only_field',
					'title'      => __( 'Load 2x Resolution Image in Retina Display', 'woo-product-slider' ),
					'subtitle'   => __( 'You should upload 2x sized images to show in retina display.', 'woo-product-slider' ),
					'text_on'    => __( 'Enabled', 'woo-product-slider' ),
					'text_off'   => __( 'Disabled', 'woo-product-slider' ),
					'text_width' => 94,
					'default'    => false,
					'dependency' => array( 'product_image|image_sizes', '==|==', 'true|custom', true ),
				),
				array(
					'id'         => 'image_lightbox',
					'type'       => 'switcher',
					'class'      => 'pro_only_field',
					'title'      => __( 'Lightbox', 'woo-product-slider' ),
					'subtitle'   => __( 'Enable/Disable lightbox gallery for product image.', 'woo-product-slider' ),
					'text_on'    => __( 'Enabled', 'woo-product-slider' ),
					'text_off'   => __( 'Disabled', 'woo-product-slider' ),
					'text_width' => 96,
					'default'    => false,
					'dependency' => array(
						'product_image',
						'==',
						'true',
						true,
					),
				),
				array(
					'id'         => 'zoom_effect_types',
					'type'       => 'select',
					'title'      => __( 'Zoom', 'woo-product-slider' ),
					'subtitle'   => __( 'Select a zoom effect for the product image.', 'woo-product-slider' ),
					'options'    => array(
						'off'      => __( 'None', 'woo-product-slider' ),
						'zoom_in'  => __( 'Zoom In', 'woo-product-slider' ),
						'zoom_out' => __( 'Zoom Out', 'woo-product-slider' ),
					),
					'default'    => 'off',
					'dependency' => array(
						'product_image|template_style',
						'==|==',
						'true|custom',
						true,
					),
				),
				array(
					'id'         => 'image_gray_scale',
					'type'       => 'select',
					'title'      => __( 'Image mode', 'woo-product-slider' ),
					'subtitle'   => __( 'Set a mode for image.', 'woo-product-slider' ),
					'options'    => array(
						''                      => array(
							'name' => __( 'Normal', 'woo-product-slider' ),
						),
						'sp-wpsp-gray-with-normal-on-hover' => array(
							'name'     => __( 'Grayscale with normal on hover(Pro)', 'woo-product-slider' ),
							'pro_only' => true,
						),
						'sp-wpsp-gray-on-hover' => array(
							'name'     => __( 'Grayscale on hover(Pro)', 'woo-product-slider' ),
							'pro_only' => true,
						),
						'sp-wpsp-always-gray'   => array(
							'name'     => __( 'Always grayscale(Pro)', 'woo-product-slider' ),
							'pro_only' => true,
						),
					),
					'default'    => '',
					'dependency' => array(
						'product_image',
						'==',
						'true',
					),
				),

				array(
					'type'    => 'notice',
					'content' => __( 'To unlock Product Image flip, Lightbox, & Grayscale effects, <a  href="https://shapedplugin.com/woocommerce-product-slider/pricing/?ref=1" target="_blank"><b>Upgrade To Pro!</b></a>', 'woo-product-slider' ),
				),

			),
		)
	);
	/**
 * Slider Controls section.
 */
	SPF_WPSP::createSection(
		$prefix,
		array(
			'title'  => __( 'Slider Controls', 'woo-product-slider' ),
			'icon'   => 'fa fa-sliders',
			'fields' => array(
				array(
					'id'       => 'carousel_ticker_mode',
					'type'     => 'button_set',
					'title'    => __( 'Slider Mode', 'woo-product-slider' ),
					'subtitle' => __( 'Set slider mode.', 'woo-product-slider' ),
					'options'  => array(
						false => array(
							'name' => __( 'Standard', 'woo-product-slider' ),
						),
						true  => array(
							'name'     => __( 'Ticker', 'woo-product-slider' ),
							'pro_only' => true,
						),
					),
					'default'  => false,
				),

				array(
					'id'         => 'carousel_auto_play',
					'type'       => 'switcher',
					'title'      => __( 'AutoPlay', 'woo-product-slider' ),
					'subtitle'   => __( 'Enable/Disable auto play.', 'woo-product-slider' ),
					'text_on'    => __( 'Enabled', 'woo-product-slider' ),
					'text_off'   => __( 'Disabled', 'woo-product-slider' ),
					'text_width' => 96,
					'default'    => true,
				),
				array(
					'id'         => 'carousel_auto_play_speed',
					'type'       => 'spinner',
					'title'      => __( 'AutoPlay Speed', 'woo-product-slider' ),
					'subtitle'   => __( 'Set auto play speed. Default value is 3000 milliseconds.', 'woo-product-slider' ),
					'sanitize'   => 'spwps_sanitize_number_field',
					'unit'       => __( 'ms', 'woo-product-slider' ),
					'max'        => 30000,
					'min'        => 1,
					'default'    => 3000,
					'dependency' => array( 'carousel_auto_play', '==', 'true' ),
				),
				array(
					'id'       => 'carousel_scroll_speed',
					'type'     => 'spinner',
					'title'    => __( 'Slider Speed', 'woo-product-slider' ),
					'subtitle' => __( 'Set slider scroll speed. Default value is 600 milliseconds.', 'woo-product-slider' ),
					'sanitize' => 'spwps_sanitize_number_field',
					'unit'     => __( 'ms', 'woo-product-slider' ),
					'default'  => 600,
					'min'      => 1,
					'max'      => 30000,
				),
				array(
					'id'       => 'slides_to_scroll',
					'type'     => 'column',
					'class'    => 'ps_pro_only_field',
					'title'    => __( 'Slide To Scroll', 'woo-product-slider' ),
					'subtitle' => __( 'Number of product(s) to scroll at a time.', 'woo-product-slider' ),
					'sanitize' => 'spwps_sanitize_number_array_field',
					'default'  => array(
						'number1' => '1',
						'number2' => '1',
						'number3' => '1',
						'number4' => '1',
					),
				),
				array(
					'id'         => 'carousel_pause_on_hover',
					'type'       => 'switcher',
					'title'      => __( 'Pause on Hover', 'woo-product-slider' ),
					'subtitle'   => __( 'Enable/Disable pause on hover.', 'woo-product-slider' ),
					'text_on'    => __( 'Enabled', 'woo-product-slider' ),
					'text_off'   => __( 'Disabled', 'woo-product-slider' ),
					'text_width' => 96,
					'default'    => true,
					'dependency' => array( 'carousel_auto_play', '==', 'true' ),
				),
				array(
					'id'         => 'carousel_infinite',
					'type'       => 'switcher',
					'title'      => __( 'Infinite Loop', 'woo-product-slider' ),
					'subtitle'   => __( 'Enable/Disable infinite loop mode.', 'woo-product-slider' ),
					'text_on'    => __( 'Enabled', 'woo-product-slider' ),
					'text_off'   => __( 'Disabled', 'woo-product-slider' ),
					'text_width' => 96,
					'default'    => true,
				),
				array(
					'id'       => 'rtl_mode',
					'type'     => 'button_set',
					'title'    => __( 'Slider Direction', 'woo-product-slider' ),
					'subtitle' => __( 'Set slider direction as you need.', 'woo-product-slider' ),
					'options'  => array(
						false => array(
							'name' => __( 'Right to Left', 'woo-product-slider' ),
						),
						true  => array(
							'name' => __( 'Left to Right', 'woo-product-slider' ),
						),
					),
					'default'  => false,
				),
				array(
					'id'       => 'slider_row',
					'class'    => 'ps_pro_only_field',
					'type'     => 'column',
					'title'    => __( 'Row', 'woo-product-slider' ),
					'subtitle' => __( 'Number of row(s) to scroll at a time.', 'woo-product-slider' ),
					'sanitize' => 'spwps_sanitize_number_array_field',
					'default'  => array(
						'number1' => '1',
						'number2' => '1',
						'number3' => '1',
						'number4' => '1',
					),
				),
				array(
					'type'    => 'subheading',
					'content' => __( 'Navigation', 'woo-product-slider' ),
				),
				array(
					'id'       => 'navigation_arrow',
					'type'     => 'button_set',
					'title'    => __( 'Navigation', 'woo-product-slider' ),
					'subtitle' => __( 'Show/Hide navigation arrow.', 'woo-product-slider' ),
					'options'  => array(
						'true'           => array(
							'name' => __( 'Show', 'woo-product-slider' ),
						),
						'false'          => array(
							'name' => __( 'Hide', 'woo-product-slider' ),
						),
						'hide_on_mobile' => array(
							'name' => __( 'Hide on Mobile', 'woo-product-slider' ),
						),
					),
					'default'  => 'true',
				),
				array(
					'id'         => 'navigation_arrow_colors',
					'type'       => 'color_group',
					'title'      => __( 'Color', 'woo-product-slider' ),
					'subtitle'   => __( 'Set color for the slider navigation.', 'woo-product-slider' ),
					'options'    => array(
						'color'            => __( 'Color', 'woo-product-slider' ),
						'hover_color'      => __( 'Hover Color', 'woo-product-slider' ),
						'background'       => __( 'Background', 'woo-product-slider' ),
						'hover_background' => __( 'Hover Background', 'woo-product-slider' ),
						'border'           => __( 'Border', 'woo-product-slider' ),
						'hover_border'     => __( 'Hover Border', 'woo-product-slider' ),
					),
					'default'    => array(
						'color'            => '#444444',
						'hover_color'      => '#ffffff',
						'background'       => 'transparent',
						'hover_background' => '#444444',
						'border'           => '#aaaaaa',
						'hover_border'     => '#444444',
					),
					'dependency' => array( 'navigation_arrow', 'any', 'true,hide_on_mobile' ),
				),
				array(
					'type'    => 'subheading',
					'content' => __( 'Pagination', 'woo-product-slider' ),
				),
				array(
					'id'       => 'pagination',
					'type'     => 'button_set',
					'title'    => __( 'Pagination', 'woo-product-slider' ),
					'subtitle' => __( 'Show/Hide pagination.', 'woo-product-slider' ),
					'options'  => array(
						'true'           => array(
							'name' => __( 'Show', 'woo-product-slider' ),
						),
						'false'          => array(
							'name' => __( 'Hide', 'woo-product-slider' ),
						),
						'hide_on_mobile' => array(
							'name' => __( 'Hide on Mobile', 'woo-product-slider' ),
						),
					),
					'default'  => 'true',
				),
				array(
					'id'         => 'pagination_dots_color',
					'type'       => 'color_group',
					'title'      => __( 'Color', 'woo-product-slider' ),
					'subtitle'   => __( 'Set color for the slider pagination dots.', 'woo-product-slider' ),
					'options'    => array(
						'color'        => __( 'Color', 'woo-product-slider' ),
						'active_color' => __( 'Active Color', 'woo-product-slider' ),
					),
					'default'    => array(
						'color'        => '#cccccc',
						'active_color' => '#333333',
					),
					'dependency' => array( 'pagination', 'any', 'true,hide_on_mobile' ),
				),
				array(
					'type'    => 'subheading',
					'content' => __( 'Miscellaneous', 'woo-product-slider' ),
				),
				array(
					'id'         => 'carousel_swipe',
					'type'       => 'switcher',
					'title'      => __( 'Swipe', 'woo-product-slider' ),
					'subtitle'   => __( 'Enable/Disable swipe mode.', 'woo-product-slider' ),
					'text_on'    => __( 'Enabled', 'woo-product-slider' ),
					'text_off'   => __( 'Disabled', 'woo-product-slider' ),
					'text_width' => 96,
					'default'    => true,
				),
				array(
					'id'         => 'carousel_draggable',
					'type'       => 'switcher',
					'title'      => __( 'Mouse Draggable', 'woo-product-slider' ),
					'subtitle'   => __( 'Enable/Disable mouse draggable mode.', 'woo-product-slider' ),
					'text_on'    => __( 'Enabled', 'woo-product-slider' ),
					'text_off'   => __( 'Disabled', 'woo-product-slider' ),
					'text_width' => 96,
					'default'    => true,
					'dependency' => array( 'carousel_swipe', '==', 'true' ),
				),
				array(
					'id'         => 'carousel_free_mode',
					'type'       => 'switcher',
					'title'      => __( 'Free Mode', 'woo-product-slider' ),
					'subtitle'   => __( 'Enable/Disable slider free mode.', 'woo-product-slider' ),
					'text_on'    => __( 'Enabled', 'woo-product-slider' ),
					'text_off'   => __( 'Disabled', 'woo-product-slider' ),
					'text_width' => 96,
					'default'    => false,
					'dependency' => array( 'carousel_swipe|carousel_draggable', '==|==', 'true|true' ),
				),

			),
		)
	);

	/**
	 * Typography section.
	 */
	SPF_WPSP::createSection(
		$prefix,
		array(
			'title'  => __( 'Typography', 'woo-product-slider' ),
			'icon'   => 'fa fa-font',
			'fields' => array(
				array(
					'type'    => 'notice',
					'style'   => 'warning',
					'content' => __( 'The Following Typography (900+ Google Fonts) options are available in the <a href="https://shapedplugin.com/woocommerce-product-slider/pricing/?ref=1"><b>Pro Version</b></a> only except the <b>Slider Section Title, Product Name, Product Price</b> Font size and color fields.', 'woo-product-slider' ),
				),
				array(
					'id'           => 'slider_title_typography',
					'type'         => 'typography',
					'title'        => __( 'Slider Section Title Font', 'woo-product-slider' ),
					'subtitle'     => __( 'Set slider section title font properties.', 'woo-product-slider' ),
					'default'      => array(
						'font-family'    => 'Open Sans',
						'font-weight'    => '600',
						'type'           => 'google',
						'font-size'      => '22',
						'line-height'    => '23',
						'text-align'     => 'left',
						'text-transform' => 'none',
						'letter-spacing' => '',
						'color'          => '#444444',
					),
					'preview_text' => 'Slider Section Title', // Replace preview text with any text you like.
				),
				array(
					'id'           => 'product_name_typography',
					'type'         => 'typography',
					'title'        => __( 'Product Name Font', 'woo-product-slider' ),
					'subtitle'     => __( 'Set product name font properties.', 'woo-product-slider' ),
					'default'      => array(
						'font-family'    => 'Open Sans',
						'font-weight'    => '600',
						'type'           => 'google',
						'font-size'      => '15',
						'line-height'    => '20',
						'text-align'     => 'center',
						'text-transform' => 'none',
						'letter-spacing' => '',
						'color'          => '#444444',
						'hover_color'    => '#955b89',
					),
					'hover_color'  => true,
					'preview_text' => 'Product Name', // Replace preview text with any text you like.
				),
				array(
					'id'       => 'product_description_typography',
					'type'     => 'typography',
					'title'    => __( 'Product Description Font', 'woo-product-slider' ),
					'subtitle' => __( 'Set product description font properties.', 'woo-product-slider' ),
					'class'    => 'product-description-typography',
					'default'  => array(
						'font-family'    => 'Open Sans',
						'font-weight'    => 'regular',
						'type'           => 'google',
						'font-size'      => '14',
						'line-height'    => '20',
						'text-align'     => 'center',
						'text-transform' => 'none',
						'letter-spacing' => '',
						'color'          => '#333333',
					),
				),
				array(
					'id'       => 'product_price_typography',
					'type'     => 'typography',
					'title'    => __( 'Product Price Font', 'woo-product-slider' ),
					'subtitle' => __( 'Set product price font properties.', 'woo-product-slider' ),
					'class'    => 'product-price-typography',
					'default'  => array(
						'font-family'    => 'Open Sans',
						'font-weight'    => '700',
						'type'           => 'google',
						'font-size'      => '14',
						'line-height'    => '19',
						'text-align'     => 'center',
						'text-transform' => 'none',
						'letter-spacing' => '',
						'color'          => '#222222',
					),
				),
				array(
					'id'       => 'sale_ribbon_typography',
					'type'     => 'typography',
					'title'    => __( 'Sale Ribbon Font', 'woo-product-slider' ),
					'subtitle' => __( 'Set product sale ribbon font properties.', 'woo-product-slider' ),
					'class'    => 'sale-ribbon-typography',
					'default'  => array(
						'font-family'    => 'Open Sans',
						'font-weight'    => 'regular',
						'type'           => 'google',
						'font-size'      => '10',
						'line-height'    => '10',
						'text-align'     => 'center',
						'text-transform' => 'uppercase',
						'letter-spacing' => '1',
						'color'          => '#ffffff',
					),
				),
				array(
					'id'       => 'out_of_stock_ribbon_typography',
					'type'     => 'typography',
					'title'    => __( 'Out of Stock Ribbon Font', 'woo-product-slider' ),
					'subtitle' => __( 'Set product out of stock ribbon font properties.', 'woo-product-slider' ),
					'class'    => 'out-of-stock-ribbon-typography',
					'default'  => array(
						'font-family'    => 'Open Sans',
						'font-weight'    => 'regular',
						'type'           => 'google',
						'font-size'      => '10',
						'line-height'    => '10',
						'text-align'     => 'center',
						'text-transform' => 'uppercase',
						'letter-spacing' => '1',
						'color'          => '#ffffff',
					),
				),
				array(
					'id'          => 'product_category_typography',
					'type'        => 'typography',
					'title'       => __( 'Product Category Font', 'woo-product-slider' ),
					'subtitle'    => __( 'Set product category font properties.', 'woo-product-slider' ),
					'class'       => 'product-category-typography',
					'default'     => array(
						'font-family'    => 'Open Sans',
						'font-weight'    => 'regular',
						'type'           => 'google',
						'font-size'      => '14',
						'line-height'    => '19',
						'text-align'     => 'center',
						'text-transform' => 'none',
						'letter-spacing' => '',
						'color'          => '#444444',
						'hover_color'    => '#955b89',
					),
					'hover_color' => true,
				),
				array(
					'id'       => 'compare_wishlist_typography',
					'type'     => 'typography',
					'title'    => __( 'Compare & Wishlist Font', 'woo-product-slider' ),
					'subtitle' => __( 'Set compare and wishlist font properties.', 'woo-product-slider' ),
					'class'    => 'compare-wishlist-typography',
					'default'  => array(
						'font-family'    => 'Open Sans',
						'font-weight'    => 'regular',
						'type'           => 'google',
						'font-size'      => '14',
						'line-height'    => '19',
						'text-align'     => 'center',
						'text-transform' => 'none',
						'letter-spacing' => '',
					),
					'color'    => false,
				),
				array(
					'id'       => 'add_to_cart_typography',
					'type'     => 'typography',
					'title'    => __( 'Add to Cart & View Details Font', 'woo-product-slider' ),
					'subtitle' => __( 'Set add to cart and view details font properties.', 'woo-product-slider' ),
					'class'    => 'add-to-cart-typography',
					'default'  => array(
						'font-family'    => 'Open Sans',
						'font-weight'    => '600',
						'type'           => 'google',
						'font-size'      => '14',
						'line-height'    => '19',
						'text-align'     => 'center',
						'text-transform' => 'none',
						'letter-spacing' => '',
					),
					'color'    => false,
				),

			),
		)
	);
