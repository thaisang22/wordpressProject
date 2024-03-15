<?php

namespace ShopEngine;

defined('ABSPATH') || exit;

use ShopEngine\Compatibility\Conflicts\Manifest as Conflict_Manifest;
use ShopEngine\Core\Builders\Base;
use ShopEngine\Compatibility\Migrations\LangMigration;
use ShopEngine\Core\Query_Modifier;
use ShopEngine\Core\Wc_Customizer\Register_Settings;
use ShopEngine\Core\Template_Cpt;
use ShopEngine\Libs\License\License_Route;
use ShopEngine\Libs\Rating\Rating;
use ShopEngine\Libs\Updater\Init as Updater;
use ShopEngine\Modules\Manifest as Module_Manifest;
use ShopEngine\Widgets\Manifest;


/**
 * Plugin final Class.
 * Handles dynamically loading classes only when needed. Check Elementor Plugin, Woocomerce Plugin Loaded or Install.
 *
 * @since 1.0.0
 */
final class Plugin {

	private static $instance;

	/**
	 * __construct function
	 * @since 1.0.0
	 */
	public function __construct() {
		// load autoload method
		Autoloader::run();
        add_action( 'wp_ajax_shopengine_admin_action', [\ShopEngine\Utils\Util::class, 'shopengine_admin_action'] );
	}

	public function utils_url()
    {
        return $this->plugin_url() . 'utils/';
    }
	/**
	 * Public function init.
	 * call function for all
	 *
	 * @since 1.0.0
	 */
	public function init() {

		$error = false;

		// check woocommerce plugin
		if(!did_action('woocommerce_loaded')) {
			add_action('admin_notices', [$this, 'missing_woocommerce']);

			$error = true;
		}

		$check_elementor_version = false;

		// Check if Elementor installed and activated.
		 if(!did_action('elementor/loaded')) {

			 if(!did_action('shopengine-gutenberg-addon/before_loaded')) {

				 add_action('admin_notices', [$this, 'missing_elementor']);

				 $error = true;
			 }
		 }

		// Check for required Elementor version.
		 if(did_action('elementor/loaded') && defined('ELEMENTOR_VERSION') && !version_compare(ELEMENTOR_VERSION, '3.0.0', '>=')) {

			 add_action('admin_notices', [$this, 'failed_elementor_version']);

		 	$error = true;
		 }

		if($error) {
			return;
		}
		
		add_filter("plugin_action_links_shopengine/shopengine.php", function ($links) {
		$free = esc_html__("Go To Shopengine","shopengine");
		$pro = esc_html__("Go To ShopenginePro","shopengine");

            $custom_links[] = '<a title="' . $free . '" href="'.admin_url('edit.php?post_type=shopengine-template#getting-started').'" target="_blank">' . esc_html__('Settings', 'shopengine') . '</a>';

            foreach ($custom_links as $custom_link):
                array_unshift($links, $custom_link);
            endforeach;

            if (!is_plugin_active('shopengine-pro/shopengine-pro.php')) {
                $links[] = '<a title="' . $pro . '" href="https://wpmet.com/plugin/shopengine/pricing/" style="color:#FCB214;font-weight:700" target="_blank" rel="noopener">' . esc_html__('Go Pro', 'shopengine') . '</a>';
            }
            return $links;
        });


		/**
		 * Routes initialization
		 *
		 */
		new License_Route();

		/**
		 * Run pro plugin updater here....
		 *
		 */
		add_action('admin_init', function () {
			if(class_exists('ShopEngine_Pro')) {
				new Updater();
			}
			new \ShopEngine\Compatibility\Migrations\Direct_Checkout;
		});


		add_action('wp_loaded', function () {
			/**
			 * migrate data
			*/
			LangMigration::instance()->init();
		});

		// avoid themes for  loading woocommerce functions
		$avoid_themes = ['avada', 'avada child', 'woodmart', 'woodmart child'];
		if(!in_array(strtolower(wp_get_theme()), $avoid_themes)) {
			/**
			 * Ensuring woocommerce functions are loaded before theme is modifying those
			 *
			 */
			require_once WC_ABSPATH . '/includes/wc-template-functions.php';
		}


        if(did_action('elementor/loaded')) {
            // Load custom elementor controls
            new \ShopEngine\Core\Elementor_Controls\Init();

            //Loading the scripts and styles
            add_action('elementor/editor/after_enqueue_styles', [$this, 'js_css_elementor']);
        }


		//Loading public scripts and styles
		add_action('wp_enqueue_scripts', [$this, 'js_css_public']);

		//woocommece theme support
		if(!current_theme_supports('woocommerce')) {
			add_theme_support('woocommerce');
			add_theme_support('wc-product-gallery-zoom');
			add_theme_support('wc-product-gallery-lightbox');
			add_theme_support('wc-product-gallery-slider');
		}

		
        $filter_string = ''; // elementskit,metform-pro
        $filter_string .= ((!in_array('elementskit/elementskit.php', apply_filters('active_plugins', get_option('active_plugins')))) ? '' : ',elementskit');
        $filter_string .= (!class_exists('\MetForm\Plugin') ? '' : ',metform');
        $filter_string .= (!class_exists('\MetForm_Pro\Plugin') ? '' : ',metform-pro');
		
		#Registering new post-type & etc
		Base::instance()->init();
		

		Rating::instance('shopengine')
		->set_plugin( 'ShopEngine', 'https://wpmet.com/wordpress.org/rating/shopengine' )
		->set_plugin_logo( 'https://ps.w.org/shopengine/assets/icon-256x256.gif?rev=2505061', 'width:150px !important' )
		->set_priority( 10 )
		->set_first_appear_day( 7 )
		->set_condition( true )
		->call();
		
		if ( is_admin() && \ShopEngine\Utils\Util::get_settings( 'shopengine_user_consent_for_banner', 'true' ) == 'true' ) {

		 /**
         * Show WPMET stories widget in dashboard
         */
		
		 \Wpmet\Libs\Stories::instance('shopengine')

		 ->set_filter($filter_string)
		 ->set_plugin('ShopEngine', 'https://wpmet.com/plugin/shopengine/')
		 ->set_api_url('https://api.wpmet.com/public/stories/')
		 ->call();

		 // banner
		 \Wpmet\Libs\Banner::instance('shopengine')
		 ->set_filter(ltrim($filter_string, ','))
		 ->set_api_url('https://api.wpmet.com/public/jhanda')
		 ->set_plugin_screens('edit-shopengine-template')
		 ->set_plugin_screens('edit-shopengine-template')
		 ->call();
		}

		\ShopEngine\Core\MultiLanguage\Language::instance()->init();

		\ShopEngine\Core\Settings\Base::instance()->init();


		new Libs\Select_Api\Base();

		(new Module_Manifest())->init();

		// working get instance of elementor widget
		(new Manifest())->init();

		Query_Modifier::instance()->init();

		(new Conflict_Manifest())->init();

		// view count
		add_action('get_header', [$this, 'shopengine_track_product_views']);

		// database migrations
		// (new \ShopEngine\Compatibility\Migrations\Migration())->init();
		// (new \ShopEngine\Compatibility\Migrations\Temp_Migration())->init();


		// call service providers

		$service_providers = include \ShopEngine::plugin_dir().'core/service-provider-manager.php';
		$method = 'init';
		foreach( $service_providers as $service_provider ){

		  if(class_exists($service_provider) && method_exists($service_provider, $method)) {
            $instance = new $service_provider();
            $instance->$method();
		  }

		}

		add_filter('script_loader_tag', [$this, 'filter_load_type'], 99, 3);

		//it will register an option in customizer for woocommerce products catelog. It's related with our Arcive Products widget.
		Register_Settings::instance()->init();
	}


	// add async and defer attributes to enqueued scripts
	public function filter_load_type($tag, $handle, $src) {

		if(strpos($handle, '-async') !== false) {
			$tag = str_replace(' src', ' async="async" src', $tag);
		}

		if(strpos($handle, '-defer') !== false) {
			$tag = str_replace('<script ', '<script defer ', $tag);
		}

		return $tag;
	}

	/**
	 * Public function shopengine_track_product_views
	 * Adding Product Views Count Meta
	 */
	public function shopengine_track_product_views() {

		if(class_exists('WooCommerce') && !is_product()) {
			return;
		}

		$product_id = get_the_id();

		$cookie_name = "shopengine_recent_viewed_product";

		if(isset($_COOKIE[$cookie_name])) {

			$cookie_ids  = sanitize_text_field(wp_unslash($_COOKIE[$cookie_name]));
			$product_ids = explode(',', $cookie_ids);

			if(!is_array($product_ids)) {
				$product_ids = [$product_ids];
			}

			$product_ids = array_combine($product_ids, $product_ids);
			unset($product_ids[$product_id]);
			$product_ids[] = $product_id;

			$cookie_value = implode(',', $product_ids);

		} else {
			$cookie_value = $product_id;
		}

		setcookie($cookie_name, $cookie_value, strtotime('+30 days'), '/' );

		$count_key = 'shopengine_product_views_count';
		$count     = get_post_meta($product_id, $count_key, true);

		if($count == '') {
			$count = 1;
			delete_post_meta($product_id, $count_key);
			add_post_meta($product_id, $count_key, '1');
		} else {
			$count++;
			update_post_meta($product_id, $count_key, $count);
		}
	}

	/**
	 * Public function js_css_public .
	 * Include public function
	 *
	 * @since 1.0.0
	 */
	public function js_css_public() {		
		wp_register_style('shopengine-public', \ShopEngine::plugin_url() . 'assets/css/shopengine-public.css', false, \ShopEngine::version());

		// Modal Stylesheet
		wp_register_style('shopengine-modal-styles', \ShopEngine::plugin_url() . 'assets/css/shopengine-modal.css', false, \ShopEngine::version());

		// Modal Script
		wp_register_script('shopengine-modal-script', \ShopEngine::plugin_url() . 'assets/js/shopengine-modal.js', ['jquery'], \ShopEngine::version(), true);

		wp_enqueue_script('shopengine-simple-scrollbar.js-js', \ShopEngine::plugin_url() . 'assets/js/simple-scrollbar.js', [], \ShopEngine::version(), true);
		wp_enqueue_script('shopengine-filter-js', \ShopEngine::plugin_url() . 'assets/js/filter.js', [], \ShopEngine::version(), true);
		wp_enqueue_script('shopengine-js', \ShopEngine::plugin_url() . 'assets/js/public.js', [], \ShopEngine::version(), true);


		wp_localize_script('shopengine-js', 'shopEngineApiSettings', [
			'resturl'    => get_rest_url(),
			'rest_nonce' => wp_create_nonce('wp_rest'),
		]);


		/**
		 * Registering libs css/js
		 *
		 */

		wp_register_style(
			'lib-sqv-css',
			\ShopEngine::plugin_url() . '/assets/sqv/smart-quick-view.css',
			[],
			\ShopEngine::version()
		);

		wp_register_script(
			'lib-sqv-js',
			\ShopEngine::plugin_url() . 'assets/sqv/smart-quick-view.js',
			['jquery', 'wc-single-product'],
			\ShopEngine::version(),
			true
		);
	}

	public function js_css_elementor() {
		wp_enqueue_style('shopnegine-panel-icon', \ShopEngine::plugin_url() . 'assets/css/shopengine-icon.css', false, \ShopEngine::version());

		if('shopengine-template' === get_post_type()):
			wp_enqueue_style('shopnegine-editor-css', \ShopEngine::plugin_url() . 'assets/css/editor.css', false, \ShopEngine::version());
		endif;
	}


	public function missing_woocommerce() {

		if(!current_user_can('manage_options')) {
			return;
		}	

		if(file_exists(WP_PLUGIN_DIR . '/woocommerce/woocommerce.php')) {

			$btn['label'] = esc_html__('Activate WooCommerce', 'shopengine');
			$btn['url']   = wp_nonce_url('plugins.php?action=activate&plugin=woocommerce/woocommerce.php&plugin_status=all&paged=1', 'activate-plugin_woocommerce/woocommerce.php');

		} else {

			$btn['label'] = esc_html__('Install WooCommerce', 'shopengine');
			$btn['url']   = wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=woocommerce'), 'install-plugin_woocommerce');
		}

		Utils\Notice::push(
			[
				'id'          => 'missing-woo',
				'type'        => 'error',
				'dismissible' => true,
				'is_required' => true,
				'btn'         => $btn,
				'message'     => sprintf(esc_html__('ShopEngine requires woocommerce Plugin, which is currently NOT RUNNING.', 'shopengine'), '4.1.0'),
			]
		);
	}


	public function missing_elementor() {

		if(!current_user_can('manage_options')) {
			return;
		}	

		if(file_exists(WP_PLUGIN_DIR . '/elementor/elementor.php')) {

			$btn['label'] = esc_html__('Activate Elementor', 'shopengine');
			$btn['url']   = wp_nonce_url('plugins.php?action=activate&plugin=elementor/elementor.php&plugin_status=all&paged=1', 'activate-plugin_elementor/elementor.php');

		} else {

			$btn['label'] = esc_html__('Install Elementor', 'shopengine');
			$btn['url']   = wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=elementor'), 'install-plugin_elementor');
		}

		Utils\Notice::push(
			[
				'id'          => 'missing-elementor',
				'type'        => 'error',
				'is_required' => true,
				'dismissible' => true,
				'btn'         => $btn,
				'message'     => sprintf(esc_html__('ShopEngine requires Elementor version %1$s+, which is currently NOT RUNNING.', 'shopengine'), '3.0.0'),
			]
		);
	}


	public function failed_elementor_version() {

		if(!current_user_can('manage_options')) {
			return;
		}	

		$btn['label'] = esc_html__('Update Elementor', 'shopengine');
		$btn['url']   = wp_nonce_url(self_admin_url('update.php?action=upgrade-plugin&plugin=elementor'), 'upgrade-plugin_elementor');

		Utils\Notice::push(
			[
				'id'          => 'unsupported-elementor-version',
				'type'        => 'error',
				'dismissible' => true,
				'btn'         => $btn,
				'message'     => sprintf(esc_html__('ShopEngine requires Elementor version %1$s+, which is currently NOT RUNNING.', 'shopengine'), '3.0.0'),
			]
		);
	}


	public function flush_rewrites() {
		$form_cpt = new Core\Builders\Cpt();
		$form_cpt->flush_rewrites();
	}


	public static function instance() {
		if(!self::$instance) {
			self::$instance = new self();
		}

		return self::$instance;
	}
}
