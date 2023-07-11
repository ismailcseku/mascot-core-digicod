<?php
namespace MascotCoreDigicod;

/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.2.0
 */
class Plugin {

	/**
	 * Instance
	 *
	 * @since 1.2.0
	 * @access private
	 * @static
	 *
	 * @var Plugin The single instance of the class.
	 */
	private static $_instance = null;
	public $widgets = array();
	public $widgets_shop = array();
	public $wpcf_status = array();
	public $give_status = false;
	public $events_status = false;
	public $woocommerce_status = false;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * widget_scripts
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function widget_scripts() {
		wp_register_script( 'mascot-core-hellojs', plugins_url( '/assets/js/elementor-mascot.js', __FILE__ ), [ 'jquery' ], false, true );
		wp_enqueue_script( 'mascot-core-rangeSlider', plugins_url( '/assets/js/ion.rangeSlider/js/ion.rangeSlider.min.js', __FILE__ ), [ 'jquery' ], false, true );
	}

	public function widget_styles() {
		wp_enqueue_style( 'mascot-core-elementor-css', plugins_url( '/assets/css/elementor-mascot.css', __FILE__ ) );
	}

	public function widget_styles_frontend() {
		wp_enqueue_style( 'mascot-core-rangeSlider-css', plugins_url( '/assets/js/ion.rangeSlider/css/ion.rangeSlider.min.css', __FILE__ ) );
		$direction_suffix = is_rtl() ? '.rtl' : '';
		wp_enqueue_style( 'tm-header-search', MASCOT_CORE_DIGICOD_URL_PATH . 'assets/css/shortcodes/header-search' . $direction_suffix . '.css' );
	}

	public function give_status() {

		if ( class_exists( 'Give' ) ) {
			$this->give_status = true;
		}

		return $this->give_status;
	}

	public function wpcf_status() {

		if ( class_exists( 'WPCF\Crowdfunding' ) ) {
			$this->wpcf_status = true;
		}

		return $this->wpcf_status;
	}

	public function events_status() {

		if ( class_exists( 'Tribe__Events__Main' ) ) {
			$this->events_status = true;
		}

		return $this->events_status;
	}

	public function woocommerce_status() {

		if ( class_exists( 'WooCommerce' ) ) {
			$this->woocommerce_status = true;
		}

		return $this->woocommerce_status;
	}

	public function widgets_list() {
		$this->widgets = array(
			'blog-list',
			'award-block',
			'features-block',
			'service-block',
			'team-block',
			'testimonial-block',
			'counter-block',
			'countdown-timer',
			'header-primary-nav',
			'header-nav-side-icons',
			'page-title',
			'pricing-plan',
			'pricing-plan-switcher',
			'site-logo',
			'app-button',
			'spin-text-around-logo',
			'moving-text',
			'interactive-list',
			'interactive-tabs-title',
			'interactive-tabs-content'
		);

		// Give
		if ( $this->give_status() ) {
			//require_once( __DIR__ . '/widgets/gives-function.php' );
			$this->widgets = array_merge(
				$this->widgets, array(
					'give-forms',
					'give-donation-form',
				)
			);
		}

		// WP Crowdfunding
		if ( $this->wpcf_status() ) {
			//require_once( __DIR__ . '/widgets/gives-function.php' );
			$this->widgets = array_merge(
				$this->widgets, array(
					'wpcf-listing',
					'wpcf-category',
					'wpcf-donate-btn',
					'wpcf-creator',
					'wpcf-info',
					'wpcf-media',
					'wpcf-post-title',
					'wpcf-progress',
					'wpcf-short-story',
					'wpcf-tabs'
				)
			);
		}

		// Tribe Events.
		if ( $this->events_status() ) {
			//require_once( __DIR__ . '/widgets/events-function.php' );
			$this->widgets = array_merge(
				$this->widgets, array(
					'tribe-events',
				)
			);
		}
		return $this->widgets;
	}


	/**
	 * Include Widgets files
	 *
	 * Load widgets files
	 *
	 * @since 1.2.0
	 * @access private
	 */
	private function include_widgets_files() {
		foreach( $this->widgets_list() as $widget ) {
			require_once( __DIR__ . '/widgets/'. $widget .'/widget.php' );

			foreach( glob( __DIR__ . '/widgets/'. $widget .'/skins/*.php') as $filepath ) {
				include $filepath;
			}
		}
	}
	private function include_widgets_files_cpt() {
		//cpt
		require_once( __DIR__ . '/cpt/projects/loader.php' );
		require_once( __DIR__ . '/cpt/blog/widget.php' );

		$cpt_list = array(
			'projects',
			'blog',
		);

		foreach( $cpt_list as $cpt ) {
			foreach( glob( __DIR__ . '/cpt/'. $cpt .'/skins/*.php') as $filepath ) {
				include $filepath;
			}
		}
	}
	private function include_widgets_files_current_theme() {
	}


	//shop
	public function widgets_list_shop() {
		// Tribe Events.
		if ( $this->woocommerce_status() ) {
			$this->widgets_shop = array_merge(
				$this->widgets_shop, array(
					'header-cart',
					'header-search',
					'info-banner',
					'wc-products',
					'product-category',
					'product-list',
					'vertical-menu',
					'wishlist',
					'product-tabs'
				)
			);
		}
		return $this->widgets_shop;
	}
	private function include_widgets_files_shop() {
		foreach( $this->widgets_list_shop() as $widget ) {
			require_once( __DIR__ . '/widgets-shop/'. $widget .'/widget.php' );

			foreach( glob( __DIR__ . '/widgets-shop/'. $widget .'/skins/*.php') as $filepath ) {
				include $filepath;
			}
		}
	}

	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function register_widgets() {
		// Its is now safe to include Widgets files
		$this->include_widgets_files();
		$this->include_widgets_files_cpt();
		$this->include_widgets_files_current_theme();

		// WooCommerce.
		$this->include_widgets_files_shop();

		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_Blog_List() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\AwardBlock\TM_Elementor_AwardBlock() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\FeaturesBlock\TM_Elementor_FeaturesBlock() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\ServiceBlock\TM_Elementor_ServiceBlock() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TeamBlock\TM_Elementor_TeamBlock() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TestimonialBlock\TM_Elementor_TestimonialBlock() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\CounterBlock\TM_Elementor_CounterBlock() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_Countdown_Timer() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_Page_Title() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_Site_Logo() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_Top_Primary_Nav() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_Header_Nav_Side_Icons() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_App_Button() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\InteractiveList\TM_Elementor_InteractiveList() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\MovingText\TM_Elementor_MovingText() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_Spin_Text_Around_Logo() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\InteractiveTabs\TM_Elementor_InteractiveTabsTitle() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\InteractiveTabs\TM_Elementor_InteractiveTabsContent() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\PricingPlan\TM_Elementor_Pricing_Plan() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\PricingPlanSwitcher\TM_Elementor_Pricing_Plan_Switcher() );

		//cpt
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Projects\TM_Elementor_Projects() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Blog\TM_Elementor_Blog() );

		//Give Campaign
		if ( $this->give_status() ) {
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\GiveForms\TM_Elementor_Give_Forms() );
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\GiveSingleForm\TM_Elementor_Give_Single_Form() );
		}

		if ( $this->events_status() ) {
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Events\TM_Elementor_Tribe_Events() );
		}

		//Shop Widgets
		if ( $this->woocommerce_status() ) {
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_Header_Cart() );
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_Header_Search() );
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Products\TM_Elementor_WC_Products() );
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_InfoBanner() );
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Products_Category\TM_Elementor_Products_Category() );
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Product_List\TM_Elementor_Product_List() );
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_Product_Tabs() );
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_Vertical_Menu() );
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\TM_Elementor_Wishlist() );
		}

		//Give Campaign
		if ( $this->wpcf_status() ) {
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\WPCF\TM_Elementor_WPCF_Listing() );
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\WPCF\TM_Elementor_WPCF_Category() );
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\WPCF\TM_Elementor_WPCF_Creator() );
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\WPCF\TM_Elementor_WPCF_Donate_Button() );
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\WPCF\TM_Elementor_WPCF_Item_Info() );
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\WPCF\TM_Elementor_WPCF_Media() );
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\WPCF\TM_Elementor_WPCF_Post_Title() );
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\WPCF\TM_Elementor_WPCF_Progress_Bar() );
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\WPCF\TM_Elementor_WPCF_Short_Story() );
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\WPCF\TM_Elementor_WPCF_Tabs() );
		}
	}

	/**
	 *  Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function __construct() {

		// Register widget scripts
		add_action( 'elementor/frontend/before_register_scripts', [ $this, 'widget_scripts' ] );
		add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'widget_styles' ] );

		add_action( 'elementor/frontend/before_register_scripts', [ $this, 'widget_styles_frontend' ] );
		add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'widget_styles_frontend' ] );

		// Register widgets
		add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );
	}
}

// Instantiate Plugin Class
Plugin::instance();

//elementor elements
require_once( __DIR__ . '/elementor-widgets-modify.php' );