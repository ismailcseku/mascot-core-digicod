<?php
namespace MascotCoreDigicod\Widgets\GiveForms;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TM_Elementor_Give_Forms extends Widget_Base {
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		$direction_suffix = is_rtl() ? '.rtl' : '';

		wp_register_style( 'tm-give-forms-loader-style', MASCOT_CORE_DIGICOD_URL_PATH . 'assets/css/extend-plugins/give/skins-forms-grid/give-forms-loader' . $direction_suffix . '.css' );
	}

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'tm-ele-give-forms';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Give Forms Grid/Carousel', 'mascot-core-digicod' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'tm-elementor-widget-icon';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'tm' ];
	}

	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'mascot-core-hellojs' ];
	}
	public function get_style_depends() {
		return [ 'tm-give-forms-loader-style' ];
	}

	/**
	 * Skins
	 */
	protected function register_skins() {
		$this->add_skin( new Skins\Skin_Forms_Style2( $this ) );
		$this->add_skin( new Skins\Skin_Forms_Style3( $this ) );
		$this->add_skin( new Skins\Skin_Forms_Style4( $this ) );
		$this->add_skin( new Skins\Skin_Forms_Horizontal1( $this ) );
		$this->add_skin( new Skins\Skin_Forms_Horizontal2( $this ) );
		$this->add_skin( new Skins\Skin_Forms_Style_Current_Theme1( $this ) );
		$this->add_skin( new Skins\Skin_Forms_CurrentTheme_Horizontal( $this ) );
	}

	protected function get_supported_ids() {
		$supported_ids = [];

		$wp_query = new \WP_Query( array(
			'post_type' => 'give_forms',
			'post_status' => 'publish'
		) );

		if ( $wp_query->have_posts() ) {
			while ( $wp_query->have_posts() ) {
				$wp_query->the_post();
				$supported_ids[get_the_ID()] = get_the_title();
			}
		}

		return $supported_ids;
	}

	public function get_supported_taxonomies() {
		$supported_taxonomies = [];

		$categories = get_terms( array(
			'taxonomy' => 'give_forms_category',
			'hide_empty' => false,
		) );
		if( ! empty( $categories )  && ! is_wp_error( $categories ) ) {
			foreach ( $categories as $category ) {
				$supported_taxonomies[$category->term_id] = $category->name;
			}
		}

		return $supported_taxonomies;
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function register_controls() {
		$categories_array = mascot_core_category_list_array( 'give_forms_category' );
		$tag_array = mascot_core_category_list_array( 'give_forms_tag' );

		$post_meta_array = array(
			'show-post-by-author' =>  esc_html__( 'Show Author', 'mascot-core-digicod' ),
			'show-post-date'  =>  esc_html__( 'Show Date', 'mascot-core-digicod' ),
			'show-post-category'  =>  esc_html__( 'Show Category', 'mascot-core-digicod' ),
			'show-post-comments-count'  =>  esc_html__( 'Show Comments Count', 'mascot-core-digicod' ),
			'show-post-tag' =>  esc_html__( 'Show Tag', 'mascot-core-digicod' ),
			'show-post-like-button'  =>  esc_html__( 'Show Like Button', 'mascot-core-digicod' )
		);

		$this->start_controls_section(
			'general', [
				'label' => esc_html__( 'General', 'mascot-core-digicod' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'custom_css_class', [
				'label' => esc_html__( "Custom CSS class", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
		$this->add_control(
			'display_type', [
				'label' => esc_html__( "Display Type", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'grid'	=>	esc_html__( 'Grid', 'mascot-core-digicod' ),
					'masonry'	=>	esc_html__( 'Masonry', 'mascot-core-digicod' ),
					'carousel'	=>	esc_html__( 'Carousel', 'mascot-core-digicod' ),
				],
				'default' => 'grid',
			]
		);
		$this->add_control(
			'columns', [
				'label' => esc_html__( "Columns Layout", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'1'  =>  '1',
					'2'  =>  '2',
					'3'  =>  '3',
					'4'  =>  '4',
					'5'  =>  '5',
					'6'  =>  '6',
				],
				'default' => '3',
			]
		);

		//responsive grid layout
		mascot_core_digicod_elementor_grid_responsive_columns($this);

		$this->add_control(
			'gutter',
			[
				'label' => esc_html__( "Gutter", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_isotope_gutter_list_elementor(),
				'default' => 'gutter-15',
				'condition' => [
					'display_type' => array('grid', 'masonry', 'masonry-tiles')
				]
			]
		);

		$this->end_controls_section();





		//Carousel Options
		$this->start_controls_section(
			'carousel_options', [
				'label' => esc_html__( 'Carousel Options', 'mascot-core-digicod' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'display_type' => array('carousel')
				]
			]
		);
		mascot_core_get_owl_carousel_arraylist( $this, 1, '', array('display_type' => array('carousel') ) );
		mascot_core_get_owl_carousel_arraylist( $this, 2, '', array('display_type' => array('carousel') ) );
		mascot_core_get_owl_carousel_arraylist( $this, 3, '', array('display_type' => array('carousel') ) );
		mascot_core_get_owl_carousel_arraylist( $this, 4, '', array('display_type' => array('carousel') ) );
		mascot_core_get_owl_carousel_arraylist( $this, 5, '', array('display_type' => array('carousel') ) );
		mascot_core_get_owl_carousel_arraylist( $this, 6, '', array('display_type' => array('carousel') ) );
		mascot_core_get_owl_carousel_arraylist( $this, 7, '', array('display_type' => array('carousel') ) );
		mascot_core_get_owl_carousel_arraylist( $this, 8, '', array('display_type' => array('carousel') ) );
		mascot_core_get_owl_carousel_arraylist( $this, 9, '', array('display_type' => array('carousel') ) );
		mascot_core_get_owl_carousel_arraylist( $this, 10, '', array('display_type' => array('carousel') ) );
		mascot_core_get_owl_carousel_arraylist( $this, 11, '', array('display_type' => array('carousel') ) );
		mascot_core_get_owl_carousel_arraylist( $this, 12, '', array('display_type' => array('carousel') ) );
		mascot_core_get_owl_carousel_arraylist( $this, 13, '', array('display_type' => array('carousel') ) );
		mascot_core_get_owl_carousel_arraylist( $this, 14, '', array('display_type' => array('carousel') ) );
		$this->end_controls_section();

		//Carousel Arrow Navigation Options
		$this->start_controls_section(
			'carousel_arrow_nav_options', [
				'label' => esc_html__( 'Carousel Arrow Navigation Options', 'mascot-core-digicod' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'display_type' => array('carousel')
				]
			]
		);
		mascot_core_get_owl_carousel_nav_arraylist( $this, 1, '', array('display_type' => array('carousel') ) );
		mascot_core_get_owl_carousel_nav_arraylist( $this, 2, '');
		mascot_core_get_owl_carousel_nav_arraylist( $this, 3, '');
		mascot_core_get_owl_carousel_nav_arraylist( $this, 4, '');
		mascot_core_get_owl_carousel_nav_arraylist( $this, 5, '');
		mascot_core_get_owl_carousel_nav_arraylist( $this, 6, '');
		mascot_core_get_owl_carousel_nav_arraylist( $this, 7, '');
		mascot_core_get_owl_carousel_nav_arraylist( $this, 8, '');
		mascot_core_get_owl_carousel_nav_arraylist( $this, 9, '');
		mascot_core_get_owl_carousel_nav_arraylist( $this, 10, '');
		mascot_core_get_owl_carousel_nav_arraylist( $this, 11, '');
		mascot_core_get_owl_carousel_nav_arraylist( $this, 12, '');
		mascot_core_get_owl_carousel_nav_arraylist( $this, 13, '');
		mascot_core_get_owl_carousel_nav_arraylist( $this, 14, '');
		mascot_core_get_owl_carousel_nav_arraylist( $this, 15, '');
		mascot_core_get_owl_carousel_nav_arraylist( $this, 16, '');
		mascot_core_get_owl_carousel_nav_arraylist( $this, 17, '');
		mascot_core_get_owl_carousel_nav_arraylist( $this, 18, '');
		mascot_core_get_owl_carousel_nav_arraylist( $this, 19, '');
		mascot_core_get_owl_carousel_nav_arraylist( $this, 20, '');
		mascot_core_get_owl_carousel_nav_arraylist( $this, 21, '');
		mascot_core_get_owl_carousel_nav_arraylist( $this, 22, '');
		mascot_core_get_owl_carousel_nav_arraylist( $this, 23, '');
		mascot_core_get_owl_carousel_nav_arraylist( $this, 24, '');
		mascot_core_get_owl_carousel_nav_arraylist( $this, 25, '');
		mascot_core_get_owl_carousel_nav_arraylist( $this, 26, '');
		mascot_core_get_owl_carousel_nav_arraylist( $this, 27, '');
		mascot_core_get_owl_carousel_nav_arraylist( $this, 28, '');
		mascot_core_get_owl_carousel_nav_arraylist( $this, 29, '');
		$this->end_controls_section();






		//Carousel Arrow Navigation Options
		$this->start_controls_section(
			'carousel_arrow_nav_bs5_breakpoints_options', [
				'label' => esc_html__( 'Carousel Arrow Nav Bootstrap5 Breakpoints', 'mascot-core-digicod' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'display_type' => array('carousel')
				]
			]
		);
		mascot_core_get_owl_carousel_nav_bs5_breakpoints_arraylist( $this, 1, '');
		mascot_core_get_owl_carousel_nav_bs5_breakpoints_arraylist( $this, 2, '');
		mascot_core_get_owl_carousel_nav_bs5_breakpoints_arraylist( $this, 3, '');
		mascot_core_get_owl_carousel_nav_bs5_breakpoints_arraylist( $this, 4, '');
		mascot_core_get_owl_carousel_nav_bs5_breakpoints_arraylist( $this, 5, '');

		mascot_core_get_owl_carousel_nav_bs5_breakpoints_arraylist( $this, 6, '');
		mascot_core_get_owl_carousel_nav_bs5_breakpoints_arraylist( $this, 7, '');
		mascot_core_get_owl_carousel_nav_bs5_breakpoints_arraylist( $this, 8, '');
		mascot_core_get_owl_carousel_nav_bs5_breakpoints_arraylist( $this, 9, '');
		mascot_core_get_owl_carousel_nav_bs5_breakpoints_arraylist( $this, 10, '');
		$this->end_controls_section();






		//Carousel Bullets/Dots Options
		$this->start_controls_section(
			'carousel_arrow_dots_options', [
				'label' => esc_html__( 'Carousel Bullets/Dots Options', 'mascot-core-digicod' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'display_type' => array('carousel')
				]
			]
		);
		mascot_core_get_owl_carousel_dots_arraylist( $this, 1, '', array('display_type' => array('carousel') ) );
		mascot_core_get_owl_carousel_dots_arraylist( $this, 2, '');
		mascot_core_get_owl_carousel_dots_arraylist( $this, 3, '');
		mascot_core_get_owl_carousel_dots_arraylist( $this, 4, '');
		mascot_core_get_owl_carousel_dots_arraylist( $this, 5, '');
		mascot_core_get_owl_carousel_dots_arraylist( $this, 6, '');
		mascot_core_get_owl_carousel_dots_arraylist( $this, 7, '');
		mascot_core_get_owl_carousel_dots_arraylist( $this, 8, '');
		mascot_core_get_owl_carousel_dots_arraylist( $this, 9, '');
		mascot_core_get_owl_carousel_dots_arraylist( $this, 10, '');
		mascot_core_get_owl_carousel_dots_arraylist( $this, 11, '');
		mascot_core_get_owl_carousel_dots_arraylist( $this, 12, '');
		mascot_core_get_owl_carousel_dots_arraylist( $this, 13, '');
		mascot_core_get_owl_carousel_dots_arraylist( $this, 14, '');
		mascot_core_get_owl_carousel_dots_arraylist( $this, 15, '');
		mascot_core_get_owl_carousel_dots_arraylist( $this, 16, '');
		mascot_core_get_owl_carousel_dots_arraylist( $this, 17, '');
		$this->end_controls_section();






		$this->start_controls_section(
			'query', [
				'label' => esc_html__( 'Query', 'mascot-core-digicod' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'total_items', [
				'label' => esc_html__( "Number of Items to Query from Database", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				"description" => esc_html__( "How many items do you wish to show? Put -1 to show all. Default 3", 'mascot-core-digicod' ),
				'default' => '3'
			]
		);
		$this->add_control(
			'tag', [
				'label' => esc_html__( "Tag", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => $tag_array,
			]
		);
		$this->add_control(
			'ids',
			[
				'label' => __( 'Ids', 'mascot-core-digicod' ),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->get_supported_ids(),
				'label_block' => true,
				'multiple' => true,
			]
		);
		$this->add_control(
			'category',
			[
				'label' => __( 'Category', 'mascot-core-digicod' ),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->get_supported_taxonomies(),
				'label_block' => true,
				'multiple' => true,
			]
		);
		
		$this->add_control(
			'order_by', [
				'label' => esc_html__( "Order By", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'date'	=>	esc_html__( 'Date', 'mascot-core-digicod' ),
					'title'	=>	esc_html__( 'Title', 'mascot-core-digicod' ),
					'popular'	=>	esc_html__( 'Popular', 'mascot-core-digicod' ),
					'ending'	=>	esc_html__( 'Ending', 'mascot-core-digicod' ),
				],
			]
		);
		$this->add_control(
			'order', [
				'label' => esc_html__( "Order", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'DESC' => esc_html__( 'Descending', 'mascot-core-digicod' ),
					'ASC' => esc_html__( 'Ascending', 'mascot-core-digicod' ),
				],
			]
		);

		$this->end_controls_section();







		//Category Filter
		$this->start_controls_section(
			'cat_filter_section', [
				'label' => esc_html__( 'Category Filter', 'mascot-core-digicod' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		mascot_core_get_cat_filter_arraylist( $this, 1, array('display_type' => array('grid', 'masonry', 'carousel') ) );
		mascot_core_get_cat_filter_arraylist( $this, 2 );
		mascot_core_get_cat_filter_arraylist( $this, 3 );
		mascot_core_get_cat_filter_arraylist( $this, 4 );

		$this->end_controls_section();




		$this->start_controls_section(
			'content_section', [
				'label' => esc_html__( 'Content', 'mascot-core-digicod' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'show_thumb', [
				'label' => esc_html__( "Show Thumbnail", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);
		$this->add_control(
			'feature_thumb_image_size', [
				'label' => esc_html__( "Thumbnail Image Size", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_get_available_image_sizes(),
				'default' => 'post-thumbnail',
				'condition' => [
						'show_thumb' => array('yes')
				]
			]
		);
		$this->add_control(
			'show_title', [
				'label' => esc_html__( "Show Title", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);
		$this->add_control(
			'title_tag', [
				'label' => esc_html__( "Title Tag", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_heading_tag_list(),
				'default' => 'h4',
				'condition' => [
					'show_title' => array('yes')
				]
			]
		);
		$this->add_control(
			'show_excerpt', [
				'label' => esc_html__( "Show Excerpt", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);
		$this->add_control(
			'excerpt_length', [
				'label' => esc_html__( "Excerpt Length", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				"description" => esc_html__( "Number of words to display. Example: 25. Default all", 'mascot-core-digicod' ),
				'condition' => [
					'show_excerpt' => array('yes')
				]
			]
		);
		$this->add_control(
			'show_meta', [
				'label' => esc_html__( "Show Meta", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'no'
			]
		);
		$this->add_control(
			'meta_options',
			[
				'label' => esc_html__( "Choose Meta", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'options' => [
					'show-created-date'	=>	esc_html__( 'Show Created Date', 'mascot-core-digicod' ),
					'show-category'	=>	esc_html__( 'Show Category', 'mascot-core-digicod' ),
					'show-tag'	=>	esc_html__( 'Show Tag', 'mascot-core-digicod' ),
					'show-form-creator'	=>	esc_html__( 'Show Campaign Creator', 'mascot-core-digicod' )
				],
				'multiple' => true,
				'description' => esc_html__('Enable/Disabling this option will show/hide each Post Meta', 'mascot-core-digicod'),
				'default' => [ 'show-created-date' ],
				'condition' => [
					'show_meta' => array('yes')
				]
			]
		);
		$this->add_control(
			'show_progress', [
				'label' => esc_html__( "Show Progress", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);
		$this->add_control(
			'show_donation_stats', [
				'label' => esc_html__( "Show Donation Stats", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);

		$this->end_controls_section();






		$this->start_controls_section(
			'button_options', [
				'label' => esc_html__( 'Donate Button Options', 'mascot-core-digicod' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		mascot_core_get_viewdetails_button_arraylist($this, 1);
		mascot_core_get_viewdetails_button_arraylist($this, 2);
		mascot_core_get_button_arraylist($this, 1);
		mascot_core_get_button_arraylist($this, 2);
		mascot_core_get_button_arraylist($this, 3);
		mascot_core_get_button_arraylist($this, 4);
		mascot_core_get_button_arraylist($this, 5);
		mascot_core_get_button_arraylist($this, 6);
		mascot_core_get_button_arraylist($this, 7);
		mascot_core_get_button_arraylist($this, 8);
		mascot_core_get_button_arraylist($this, 9);
		mascot_core_get_button_arraylist($this, 10);
		mascot_core_get_button_arraylist($this, 11);
		mascot_core_get_button_arraylist($this, 12);
		$this->end_controls_section();



		$this->start_controls_section(
			'button_color_typo_options', [
				'label' => esc_html__( 'Button Color/Typography', 'mascot-core-digicod' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		mascot_core_get_button_text_color_typo_arraylist($this, 1);
		mascot_core_get_button_text_color_typo_arraylist($this, 2);
		mascot_core_get_button_text_color_typo_arraylist($this, 3);
		mascot_core_get_button_text_color_typo_arraylist($this, 4);
		mascot_core_get_button_text_color_typo_arraylist($this, 5);
		mascot_core_get_button_text_color_typo_arraylist($this, 6);
		mascot_core_get_button_text_color_typo_arraylist($this, 7);
		mascot_core_get_button_text_color_typo_arraylist($this, 8);
		mascot_core_get_button_text_color_typo_arraylist($this, 9);
		$this->end_controls_section();





		$this->start_controls_section(
			'title_options_styling',
			[
				'label' => esc_html__( 'Title Styling', 'mascot-core-digicod' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'title_text_color',
			[
				'label' => esc_html__( "Text Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .type-give_forms .form-title' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'title_text_color_hover',
			[
				'label' => esc_html__( "Text Color (Title Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .type-give_forms .form-title:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .type-give_forms .form-title a:hover' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'title_text_color_item_hover',
			[
				'label' => esc_html__( "Text Color (Item Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .type-give_forms:hover .form-title' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'title_theme_colored',
			[
				'label' => esc_html__( "Title Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .type-give_forms .form-title' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'title_theme_colored_hover',
			[
				'label' => esc_html__( "Title Theme Colored (Title Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .type-give_forms .form-title:hover' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .type-give_forms .form-title a:hover' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'title_theme_colored_item_hover',
			[
				'label' => esc_html__( "Title Theme Colored (Item Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .type-give_forms:hover .form-title' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Typography', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .type-give_forms .form-title',
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__( 'Title Margin', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .type-give_forms .form-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_padding',
			[
				'label' => esc_html__( 'Title Padding', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .type-give_forms .form-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();










		$this->start_controls_section(
			'excerpt_options_styling',
			[
				'label' => esc_html__( 'Excerpt Styling', 'mascot-core-digicod' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'excerpt_text_color',
			[
				'label' => esc_html__( "Text Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .type-give_forms .form-description' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'excerpt_text_color_hover',
			[
				'label' => esc_html__( "Text Color (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .type-give_forms:hover .form-description' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'excerpt_theme_colored',
			[
				'label' => esc_html__( "Text Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .type-give_forms .form-description' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'excerpt_theme_colored_hover',
			[
				'label' => esc_html__( "Text Theme Colored (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .type-give_forms:hover .form-description' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'excerpt_typography',
				'label' => esc_html__( 'Typography', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .type-give_forms .form-description',
			]
		);
		$this->add_responsive_control(
			'excerpt_margin',
			[
				'label' => esc_html__( 'Text Margin', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .type-give_forms .form-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'excerpt_padding',
			[
				'label' => esc_html__( 'Text Padding', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .type-give_forms .form-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();










		$this->start_controls_section(
			'give_progress_goal_options_styling',
			[
				'label' => esc_html__( 'Goal/Progress Styling', 'mascot-core-digicod' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'give_progress_goal_margin',
			[
				'label' => esc_html__( 'Text Margin', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .type-give_forms .give-goal-progress' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'give_progress_goal_padding',
			[
				'label' => esc_html__( 'Text Padding', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .type-give_forms .give-goal-progress' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->start_controls_tabs('tabs_give_progress_goal_style');
		$this->start_controls_tab(
			'tabs_give_progress_goal_style_amount',
			[
				'label' => esc_html__('Amount', 'mascot-core-digicod'),
			]
		);
		$this->add_control(
			'give_progress_goal_amount_color',
			[
				'label' => esc_html__( "Text Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .type-give_forms .give-goal-progress span' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'give_progress_goal_amount_color_hover',
			[
				'label' => esc_html__( "Text Color (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .type-give_forms:hover .give-goal-progress span' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'give_progress_goal_amount_theme_colored',
			[
				'label' => esc_html__( "Text Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .type-give_forms .give-goal-progress span' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'give_progress_goal_amount_theme_colored_hover',
			[
				'label' => esc_html__( "Text Theme Colored (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .type-give_forms:hover .give-goal-progress span' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'give_progress_goal_amount_typography',
				'label' => esc_html__( 'Typography', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .type-give_forms .give-goal-progress span',
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_give_progress_goal_style_text',
			[
				'label' => esc_html__('Text', 'mascot-core-digicod'),
			]
		);
		$this->add_control(
			'give_progress_goal_text_color',
			[
				'label' => esc_html__( "Text Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .type-give_forms .give-goal-progress' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'give_progress_goal_text_color_hover',
			[
				'label' => esc_html__( "Text Color (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .type-give_forms:hover .give-goal-progress' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'give_progress_goal_text_theme_colored',
			[
				'label' => esc_html__( "Text Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .type-give_forms .give-goal-progress' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'give_progress_goal_text_theme_colored_hover',
			[
				'label' => esc_html__( "Text Theme Colored (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .type-give_forms:hover .give-goal-progress' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'give_progress_goal_text_typography',
				'label' => esc_html__( 'Typography', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .type-give_forms .give-goal-progress',
			]
		);
		$this->end_controls_tabs();
		$this->end_controls_section();

	}

	public function query_posts() {
		$settings = $this->get_settings_for_display();
		$paged = isset($settings['paged']) ? $settings['paged'] : '';

		//query args
		$args = array(
			'post_type' => 'give_forms',
			'orderby' => $settings['order_by'],
			'order' => $settings['order'],
			'posts_per_page' => $settings['total_items'],
			'paged' => $paged,
		);

		//if order by client_author_name selected
		if( $settings['order_by'] == 'end-date' ) {
			$args['meta_key'] = '_campaign_end_date';
			$args['orderby']  = 'meta_value';
		}

		/* Specific campaign IDs */
		if( ! empty( $settings['ids'] ) ) {
			$args['post__in'] = $settings['ids'];
		}

		if( ! empty( $settings['category'] ) ) {
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'give_forms_category',
					'field'    => 'term_id',
					'terms'    => $settings['category'],
				),
			);
		}

		/* Set tag constraint */
		if ( ! empty( $settings['tag'] ) ) {
			if ( ! array_key_exists( 'tax_query', $args ) ) {
				$args['tax_query'] = array();
			}

			$args['tax_query'][] = array(
				'taxonomy' => 'give_forms_tag',
				'field'    => 'slug',
				'terms'    => explode( ',', $settings['tag'] ),
			);
		}

		return $the_query = new \WP_Query( $args );
	}

	public function get_instance_value_skin( $key ) {
		$settings = $this->get_settings_for_display();

		if( !empty( $settings['_skin'] ) && isset( $settings[str_replace( '-', '_', $settings['_skin'] ) . '_' . $key] ) ) {
			 return $settings[str_replace( '-', '_', $settings['_skin'] ) . '_' . $key];
		}
		return $settings[$key];
	}

	

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		
		$class_instance =  array();

		$settings['holder_id'] = mascot_core_get_isotope_holder_ID('give-forms');

		$this->render_output( $class_instance, $settings );
	}

	public function render_output( $class_instance, $settings ) {
		$new_cpt_class = $class_instance;

		if( $settings['display_type'] != 'masonry' ) {
			$settings['use_masonry_tiles_featured_image_size'] = 'false';
		}
		
		$settings['the_query'] = $this->query_posts();
		
		//classes
		$classes = array();
		if( isset($settings['_skin']) ) {
			$classes[] = 'give-forms-' . $settings['_skin'];
		}
		$classes[] = $settings['custom_css_class'];
		$settings['classes'] = $classes;

		//button classes
		$settings['btn_classes'] = mascot_core_prepare_button_classes_from_params( $settings );

		//meta options
		if(!empty($settings['meta_options'])) {
			$settings['meta_options'] = implode(",", $settings['meta_options']);
			$settings['meta_options'] = explode(',', $settings['meta_options']);
		}
		
		//Owl Carousel Data
		$settings['owl_carousel_data_info'] = mascot_core_prepare_owlcarousel_data_from_params( $settings );

		$settings['settings'] = $settings;

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = mascot_core_digicod_get_shortcode_template_part( 'forms', $settings['display_type'], 'give-forms/tpl', $settings, true );
		
		echo $html;
	}
}