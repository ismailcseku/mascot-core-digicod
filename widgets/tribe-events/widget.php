<?php
namespace MascotCoreDigicod\Widgets\Events;

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
class TM_Elementor_Tribe_Events extends Widget_Base {
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		$direction_suffix = is_rtl() ? '.rtl' : '';

		wp_register_style( 'tm-tribe-events-loader-style', MASCOT_CORE_DIGICOD_URL_PATH . 'assets/css/extend-plugins/tribe-events/skins/tribe-events-loader' . $direction_suffix . '.css' );
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
		return 'tm-ele-tribe-events';
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
		return esc_html__( 'Tribe Events Grid/List', 'mascot-core-digicod' );
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

	
	/**
	 * Get style dependencies.
	 *
	 * Retrieve the list of style dependencies the element requires.
	 *
	 * @since 1.9.0
	 * @access public
	 *
	 * @return array Element styles dependencies.
	 */
	public function get_style_depends() {
		return [ 'tm-tribe-events-loader-style' ];
	}


	/**
	 * Skins
	 */
	protected function register_skins() {
		$this->add_skin( new Skins\Skin_Fullwidth_Style_Current_Theme1( $this ) );
		$this->add_skin( new Skins\Skin_Style_Current_Theme1( $this ) );
		
		$this->add_skin( new Skins\Skin_Style2( $this ) );
		$this->add_skin( new Skins\Skin_Style3( $this ) );
		$this->add_skin( new Skins\Skin_Style4( $this ) );
		$this->add_skin( new Skins\Skin_Style5( $this ) );
		$this->add_skin( new Skins\Skin_Style6( $this ) );
		$this->add_skin( new Skins\Skin_Style7( $this ) );
		
		$this->add_skin( new Skins\Skin_Fullwidth_Style1( $this ) );
		$this->add_skin( new Skins\Skin_Fullwidth_Style2( $this ) );

		$this->add_skin( new Skins\Skin_Vertical_list1( $this ) );
		$this->add_skin( new Skins\Skin_Vertical_List_Current_Theme( $this ) );
	}

	public function get_instance_value_skin( $key ) {
		$settings = $this->get_settings_for_display();

		if( !empty( $settings['_skin'] ) && isset( $settings[str_replace( '-', '_', $settings['_skin'] ) . '_' . $key] ) ) {
			 return $settings[str_replace( '-', '_', $settings['_skin'] ) . '_' . $key];
		}
		return $settings[$key];
	}

	protected function get_supported_ids() {
		$supported_ids = [];

		$wp_query = new \WP_Query( array(
			'post_type' => 'tribe_events',
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
			'taxonomy' => 'tribe_events_cat',
			'hide_empty' => false,
		) );
		if( ! empty( $categories )  && ! is_wp_error( $categories ) ) {
			foreach ( $categories as $category ) {
				$supported_taxonomies[$category->term_id] = $category->name;
			}
		}

		return $supported_taxonomies;
	}

	protected function get_supported_venue_taxonomies() {
		$supported_taxonomies = [];

		$args = array(
			'post_type' => 'tribe_venue',
			'post_status'    => 'publish',
		);

		$query = new \WP_Query( $args );
		if ( $query->have_posts() ) :
			while ( $query->have_posts() ) : $query->the_post();
			$supported_taxonomies[get_the_ID()] = get_the_title();
			endwhile;
	 		wp_reset_postdata();
	 	endif;

		return $supported_taxonomies;
	}

	protected function get_supported_organizer_taxonomies() {
		$supported_taxonomies = [];

		$args = array(
			'post_type' => 'tribe_organizer',
			'post_status'    => 'publish',
		);

		$query = new \WP_Query( $args );
		if ( $query->have_posts() ) :
			while ( $query->have_posts() ) : $query->the_post();
			$supported_taxonomies[get_the_ID()] = get_the_title();
			endwhile;
	 		wp_reset_postdata();
	 	endif;

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
		$categories_array = mascot_core_category_list_array( 'tribe_events_cat' );
		$orderby_parameters_list1 = mascot_core_orderby_parameters_list();
		$orderby_parameters_list2 = array(
		);
		$orderby_parameters_list = array_merge( $orderby_parameters_list2, $orderby_parameters_list1 );
		$this->start_controls_section(
			'general',
			[
				'label' => esc_html__( 'General', 'mascot-core-digicod' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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
				'condition' => [
					'_skin!'=> array('skin-vertical-list1', 'skin-vertical-list-current-theme', 'skin-fullwidth-style1', 'skin-fullwidth-style2'),
				],
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
				'condition' => [
					'_skin!'=> array('skin-vertical-list1', 'skin-vertical-list-current-theme', 'skin-fullwidth-style1', 'skin-fullwidth-style2'),
				],
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
					'_skin!'=> array('skin-vertical-list1', 'skin-vertical-list-current-theme', 'skin-fullwidth-style1', 'skin-fullwidth-style2'),
				],
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
			'venue',
			[
				'label' => __( 'Venue', 'mascot-core-digicod' ),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->get_supported_venue_taxonomies(),
				'label_block' => true,
				'multiple' => true,
			]
		);
		$this->add_control(
			'organizer',
			[
				'label' => __( 'Organizer', 'mascot-core-digicod' ),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->get_supported_organizer_taxonomies(),
				'label_block' => true,
				'multiple' => true,
			]
		);
		$this->add_control(
			'coming_soon',
			[
				'label' => __( 'Coming Soon', 'mascot-core-digicod' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'mascot-core-digicod' ),
				'label_off' => __( 'Off', 'mascot-core-digicod' ),
				'separator' => 'before',
			]
		);
		$this->add_control(
			'event_start_date',
			[
				'label' => __( 'Event Start Date', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DATE_TIME,
				'condition' => [
					'coming_soon' => '',
				],
			]
		);
		$this->add_control(
			'event_end_date',
			[
				'label' => __( 'Event End Date', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DATE_TIME,
				'condition' => [
					'coming_soon' => '',
				],
			]
		);
		$this->add_control(
			'order_by', [
				'label' => esc_html__( "Order By", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => $orderby_parameters_list,
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







		//Content Options
		$this->start_controls_section(
			'title_styling_options',
			[
				'label' => esc_html__( 'Title Styling', 'mascot-core-digicod' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Title Typography', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .tm-sc-tribe-events .event .event-content .event-title,{{WRAPPER}} .tm-sc-tribe-events .event .event-content .event-title a',
			]
		);
		$this->add_control(
			'title_text_color',
			[
				'label' => esc_html__( "Title Text Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-content .event-title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-content .event-title a' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'title_text_color_wrapper_hover',
			[
				'label' => esc_html__( "Title Text Color (Wrapper Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event:hover .event-content .event-title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tm-sc-tribe-events .event:hover .event-content .event-title a' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'title_text_color_hover',
			[
				'label' => esc_html__( "Title Text Color (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-content .event-title:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-content .event-title a:hover' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-content .event-title' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-content .event-title a' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'title_theme_colored_wrapper_hover',
			[
				'label' => esc_html__( "Title Theme Colored (Wrapper Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event:hover .event-content .event-title' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .tm-sc-tribe-events .event:hover .event-content .event-title a' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_control(
			'title_theme_colored_hover',
			[
				'label' => esc_html__( "Title Theme Colored (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-content .event-title:hover' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-content .event-title a:hover' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__( 'Title Margin', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-content .event-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();







		$this->start_controls_section(
			'date_single_meta_styling_options',
			[
				'label' => esc_html__( 'Single Date Block (Above Title or Over Thumb)', 'mascot-core-digicod' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'date_single_meta_orientation_options',
			[
				'label' => esc_html__( 'Orientation', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'date_single_meta_orientation_horizontal',
			[
				'label' => __( 'Horizontal Orientation', 'mascot-core-digicod' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => is_rtl() ? 'right' : 'left',
				'options' => [
					'left' => [
						'title' => __( 'Left', 'mascot-core-digicod' ),
						'icon' => 'eicon-h-align-left',
					],
					'right' => [
						'title' => __( 'Right', 'mascot-core-digicod' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'toggle' => false,
			]
		);
		$this->add_responsive_control(
			'date_single_meta_orientation_offset_x',
			[
				'label' => __( 'Offset', 'mascot-core-digicod' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-single-meta-date' =>
							'{{date_single_meta_orientation_horizontal.VALUE}}: {{SIZE}}%;',
				],
			]
		);
		$this->add_responsive_control(
			'date_single_meta_orientation_vertical',
			[
				'label' => __( 'Vertical Orientation', 'mascot-core-digicod' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'top' => [
						'title' => __( 'Top', 'mascot-core-digicod' ),
						'icon' => 'eicon-v-align-top',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'mascot-core-digicod' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'default' => 'top',
				'toggle' => false,
			]
		);
		$this->add_responsive_control(
			'date_single_meta_orientation_offset_y',
			[
				'label' => __( 'Offset', 'mascot-core-digicod' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-single-meta-date' =>
							'{{date_single_meta_orientation_vertical.VALUE}}: {{SIZE}}%;',
				],
			]
		);







		$this->start_controls_tabs('date_single_meta_typo_common_tabs');
		$this->start_controls_tab(
			'date_single_meta_all_typo_tab',
			[
				'label' => esc_html__('Common Typo', 'mascot-core-digicod'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'date_single_meta_common_typography',
				'label' => esc_html__( 'Date Meta Common Typography', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .tm-sc-tribe-events .event .event-single-meta-date, {{WRAPPER}} .tm-sc-tribe-events .event .event-single-meta-date > *',
			]
		);
		$this->add_control(
			'date_single_meta_common_text_color',
			[
				'label' => esc_html__( "Common Text Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-single-meta-date' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-single-meta-date > *' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'date_single_meta_common_text_color_hover',
			[
				'label' => esc_html__( "Common Text Color (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event:hover .event-single-meta-date' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tm-sc-tribe-events .event:hover .event-single-meta-date > *' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'date_single_meta_common_theme_colored',
			[
				'label' => esc_html__( "Common Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-single-meta-date' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-single-meta-date > *' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_control(
			'date_single_meta_common_theme_colored_hover',
			[
				'label' => esc_html__( "Common Theme Colored (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event:hover .event-single-meta-date' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .tm-sc-tribe-events .event:hover .event-single-meta-date > *' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();



		$this->start_controls_tabs('date_single_meta_typo_tabs');
		$this->start_controls_tab(
			'date_single_meta_day_typo_tab',
			[
				'label' => esc_html__('Day Typo', 'mascot-core-digicod'),
			]
		);
		$this->add_control(
			'date_single_meta_day_hide',
			[
				'label' => esc_html__( "Hide Day?", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-single-meta-date .day' => 'display: none;',
				]
			]
		);
		$this->add_control(
			'date_single_meta_day_block',
			[
				'label' => esc_html__( "Make it full width?", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-single-meta-date .day' => 'display: block;',
				]
			]
		);
		$this->add_control(
			'date_single_meta_date_format_day', [
				'label' => esc_html__( "Day Format", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_php_date_format('day'),
				'default' => 'd',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'date_single_meta_day_typography',
				'label' => esc_html__( 'Day Typography', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .tm-sc-tribe-events .event .event-single-meta-date .day',
			]
		);
		$this->add_control(
			'date_single_meta_day_text_color',
			[
				'label' => esc_html__( "Day Text Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-single-meta-date .day' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'date_single_meta_day_text_color_hover',
			[
				'label' => esc_html__( "Day Text Color (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event:hover .event-single-meta-date .day' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'date_single_meta_day_theme_colored',
			[
				'label' => esc_html__( "Day Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-single-meta-date .day' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_control(
			'date_single_meta_day_theme_colored_hover',
			[
				'label' => esc_html__( "Day Theme Colored (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event:hover .event-single-meta-date .day' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_responsive_control(
			'date_single_meta_day_margin',
			[
				'label' => esc_html__( 'Day Margin', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-single-meta-date .day' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'date_single_meta_month_typo_tab',
			[
				'label' => esc_html__('Month Typo', 'mascot-core-digicod'),
			]
		);
		$this->add_control(
			'date_single_meta_month_hide',
			[
				'label' => esc_html__( "Hide Month?", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-single-meta-date .month' => 'display: none;',
				]
			]
		);
		$this->add_control(
			'date_single_meta_month_block',
			[
				'label' => esc_html__( "Make it full width?", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-single-meta-date .month' => 'display: block;',
				]
			]
		);
		$this->add_control(
			'date_single_meta_date_format_month', [
				'label' => esc_html__( "Month Format", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_php_date_format('month'),
				'default' => 'M',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'date_single_meta_month_typography',
				'label' => esc_html__( 'Month Typography', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .tm-sc-tribe-events .event .event-single-meta-date .month',
			]
		);
		$this->add_control(
			'date_single_meta_month_text_color',
			[
				'label' => esc_html__( "Month Text Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-single-meta-date .month' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'date_single_meta_month_text_color_hover',
			[
				'label' => esc_html__( "Month Text Color (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event:hover .event-single-meta-date .month' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'date_single_meta_month_theme_colored',
			[
				'label' => esc_html__( "Month Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-single-meta-date .month' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_control(
			'date_single_meta_month_theme_colored_hover',
			[
				'label' => esc_html__( "Month Theme Colored (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event:hover .event-single-meta-date .month' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_responsive_control(
			'date_single_meta_month_margin',
			[
				'label' => esc_html__( 'Month Margin', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-single-meta-date .month' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'date_single_meta_year_typo_tab',
			[
				'label' => esc_html__('Year Typo', 'mascot-core-digicod'),
			]
		);
		$this->add_control(
			'date_single_meta_year_block',
			[
				'label' => esc_html__( "Make it full width?", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-single-meta-date .year' => 'display: block;',
				]
			]
		);
		$this->add_control(
			'date_single_meta_year_hide',
			[
				'label' => esc_html__( "Hide Year?", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-single-meta-date .year' => 'display: none;',
				]
			]
		);
		$this->add_control(
			'date_single_meta_date_format_year', [
				'label' => esc_html__( "Year Format", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_php_date_format('year'),
				'default' => 'y',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'date_single_meta_year_typography',
				'label' => esc_html__( 'Year Typography', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .tm-sc-tribe-events .event .event-single-meta-date .year',
			]
		);
		$this->add_control(
			'date_single_meta_year_text_color',
			[
				'label' => esc_html__( "Year Text Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-single-meta-date .year' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'date_single_meta_year_text_color_hover',
			[
				'label' => esc_html__( "Year Text Color (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event:hover .event-single-meta-date .year' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'date_single_meta_year_theme_colored',
			[
				'label' => esc_html__( "Year Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-single-meta-date .year' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_control(
			'date_single_meta_year_theme_colored_hover',
			[
				'label' => esc_html__( "Year Theme Colored (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event:hover .event-single-meta-date .year' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_responsive_control(
			'date_single_meta_year_margin',
			[
				'label' => esc_html__( 'Year Margin', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-single-meta-date .year' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();











		$this->start_controls_tabs('date_single_meta_settings_tabs');
		$this->start_controls_tab(
			'date_single_meta_padding_options_tab',
			[
				'label' => esc_html__('Spacing', 'mascot-core-digicod'),
			]
		);
		$this->add_responsive_control(
			'date_single_meta_padding',
			[
				'label' => esc_html__( 'Date Meta Padding', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-single-meta-date' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'date_single_meta_margin',
			[
				'label' => esc_html__( 'Date Meta Margin', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-single-meta-date' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'date_single_meta_border_options_tab',
			[
				'label' => esc_html__('Border', 'mascot-core-digicod'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'date_single_meta_border',
				'label' => esc_html__( 'Border', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .tm-sc-tribe-events .event .event-single-meta-date',
			]
		);
		$this->add_responsive_control(
			'date_single_meta_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-single-meta-date' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'date_single_meta_boxshadow',
				'label' => esc_html__( 'Box Shadow', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .tm-sc-tribe-events .event .event-single-meta-date',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'date_single_meta_boxshadow_hover',
				'label' => esc_html__( 'Box Shadow(Hover)', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .tm-sc-tribe-events .event:hover .event-single-meta-date',
			]
		);
		$this->end_controls_tab();



		$this->start_controls_tab(
			'date_single_meta_text_color_options_tab',
			[
				'label' => esc_html__('Color', 'mascot-core-digicod'),
			]
		);
		$this->add_control(
			'date_single_meta_text_color',
			[
				'label' => esc_html__( "Date Meta Text Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-single-meta-date' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'date_single_meta_text_color_wrapper_hover',
			[
				'label' => esc_html__( "Date Meta Text Color (Wrapper Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event:hover .event-single-meta-date' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'date_single_meta_text_color_hover',
			[
				'label' => esc_html__( "Date Meta Text Color (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-single-meta-date:hover' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'date_single_meta_theme_colored',
			[
				'label' => esc_html__( "Date Meta Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-single-meta-date' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'date_single_meta_theme_colored_wrapper_hover',
			[
				'label' => esc_html__( "Date Meta Theme Colored (Wrapper Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event:hover .event-single-meta-date' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_control(
			'date_single_meta_theme_colored_hover',
			[
				'label' => esc_html__( "Date Meta Theme Colored (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-single-meta-date:hover' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->end_controls_tab();



		$this->start_controls_tab(
			'date_single_meta_bg_color_options_tab',
			[
				'label' => esc_html__('Background', 'mascot-core-digicod'),
			]
		);
		$this->add_control(
			'date_single_meta_bg_color',
			[
				'label' => esc_html__( "Date Meta BG Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-single-meta-date' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'date_single_meta_bg_color_wrapper_hover',
			[
				'label' => esc_html__( "Meta BG Color (Wrapper Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event:hover .event-single-meta-date' => 'background-color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'date_single_meta_bg_color_hover',
			[
				'label' => esc_html__( "Date Meta BG Color (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-single-meta-date:hover' => 'background-color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'date_single_meta_bg_theme_colored',
			[
				'label' => esc_html__( "Date Meta BG Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-single-meta-date' => 'background-color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-single-meta-date:after' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'date_single_meta_bg_theme_colored_wrapper_hover',
			[
				'label' => esc_html__( "Date Meta BG Theme Colored (Wrapper Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event:hover .event-single-meta-date' => 'background-color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .tm-sc-tribe-events .event:hover .event-single-meta-date:after' => 'background-color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_control(
			'date_single_meta_bg_theme_colored_hover',
			[
				'label' => esc_html__( "Meta BG Theme Colored (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-single-meta-date:hover' => 'background-color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();












		$this->start_controls_section(
			'meta_styling_options',
			[
				'label' => esc_html__( 'Post Meta Styling', 'mascot-core-digicod' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'post_meta_placement', [
				'label' => esc_html__( "Post Meta Placement", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'top' => esc_html__( 'Over Title', 'mascot-core-digicod' ),
					'center' => esc_html__( 'Under Title', 'mascot-core-digicod' ),
					'bottom' => esc_html__( 'Under Excerpt', 'mascot-core-digicod' ),
				],
				'default' => 'center',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'meta_typography',
				'label' => esc_html__( 'Post Meta Typography', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .tm-sc-tribe-events .event .event-meta, {{WRAPPER}} .tm-sc-tribe-events .event .event-meta a',
			]
		);
		$this->add_control(
			'meta_text_color',
			[
				'label' => esc_html__( "Meta Text Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-meta, {{WRAPPER}} .tm-sc-tribe-events .event .event-meta a' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'meta_text_color_wrapper_hover',
			[
				'label' => esc_html__( "Meta Text Color (Wrapper Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event:hover .event-meta' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tm-sc-tribe-events .event:hover .event-meta a' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'meta_text_color_hover',
			[
				'label' => esc_html__( "Meta Text Color (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-meta:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-meta a:hover' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'meta_theme_colored',
			[
				'label' => esc_html__( "Meta Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-meta, {{WRAPPER}} .tm-sc-tribe-events .event .event-meta a' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'meta_theme_colored_wrapper_hover',
			[
				'label' => esc_html__( "Meta Theme Colored (Wrapper Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event:hover .event-meta' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .tm-sc-tribe-events .event:hover .event-meta a' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_control(
			'meta_theme_colored_hover',
			[
				'label' => esc_html__( "Meta Theme Colored (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-meta:hover' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-meta a:hover' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_responsive_control(
			'meta_margin',
			[
				'label' => esc_html__( 'Post Meta Margin', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-meta, {{WRAPPER}} .tm-sc-tribe-events .event .event-meta a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'meta_icon_options',
			[
				'label' => esc_html__( 'Post Meta Icon Options', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'meta_icon_typography',
				'label' => esc_html__( 'Post Meta Icon Typography', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .tm-sc-tribe-events .event .event-meta i, {{WRAPPER}} .tm-sc-tribe-events .event .event-meta a i',
			]
		);
		$this->add_control(
			'meta_icon_text_color',
			[
				'label' => esc_html__( "Meta Icon Text Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-meta i, {{WRAPPER}} .tm-sc-tribe-events .event .event-meta a i' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'meta_icon_text_color_wrapper_hover',
			[
				'label' => esc_html__( "Meta Icon Text Color (Wrapper Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event:hover .event-meta i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tm-sc-tribe-events .event:hover .event-meta a i' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'meta_icon_theme_colored',
			[
				'label' => esc_html__( "Meta Icon Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-meta i, {{WRAPPER}} .tm-sc-tribe-events .event .event-meta a i' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'meta_icon_theme_colored_wrapper_hover',
			[
				'label' => esc_html__( "Meta Icon Theme Colored (Wrapper Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event:hover .event-meta i' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .tm-sc-tribe-events .event:hover .event-meta a i' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->end_controls_section();





		$this->start_controls_section(
			'excerpt_styling_options',
			[
				'label' => esc_html__( 'Excerpt Styling', 'mascot-core-digicod' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'excerpt_typography',
				'label' => esc_html__( 'Excerpt Typography', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .tm-sc-tribe-events .event .event-content .event-excerpt',
			]
		);
		$this->add_control(
			'excerpt_text_color',
			[
				'label' => esc_html__( "Excerpt Text Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-content .event-excerpt' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'excerpt_text_color_wrapper_hover',
			[
				'label' => esc_html__( "Excerpt Text Color (Wrapper Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event:hover .event-content .event-excerpt' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'excerpt_text_color_hover',
			[
				'label' => esc_html__( "Excerpt Text Color (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-content .event-excerpt:hover' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'excerpt_theme_colored',
			[
				'label' => esc_html__( "Excerpt Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-content .event-excerpt' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'excerpt_theme_colored_wrapper_hover',
			[
				'label' => esc_html__( "Excerpt Theme Colored (Wrapper Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event:hover .event-content .event-excerpt' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_control(
			'excerpt_theme_colored_hover',
			[
				'label' => esc_html__( "Excerpt Theme Colored (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-content .event-excerpt:hover' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_responsive_control(
			'excerpt_margin',
			[
				'label' => esc_html__( 'Excerpt Margin', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-content .event-excerpt, {{WRAPPER}} .tm-sc-tribe-events .event .event-content .event-excerpt a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();





		$this->start_controls_section(
			'content_wrapper_styling_options',
			[
				'label' => esc_html__( 'Content Wrapper Styling', 'mascot-core-digicod' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'content_wrapper_padding',
			[
				'label' => esc_html__( 'Content Wrapper Padding', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'content_wrapper_alignment',
			[
				'label' => __( 'Alignment', 'mascot-core-digicod' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'mascot-core-digicod' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'mascot-core-digicod' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'mascot-core-digicod' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-content' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'content_wrapper_bg_color_options',
			[
				'label' => esc_html__( 'Background Color Options', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'content_wrapper_bg_color',
			[
				'label' => esc_html__( "Background Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-content' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'content_wrapper_bg_color_hover',
			[
				'label' => esc_html__( "Background Color (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event:hover .event-content' => 'background-color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'content_wrapper_bg_theme_colored',
			[
				'label' => esc_html__( "Background Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-content' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'content_wrapper_bg_theme_colored_hover',
			[
				'label' => esc_html__( "Background Colored (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event:hover .event-content' => 'background-color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->end_controls_section();





		$this->start_controls_section(
			'box_styling_options',
			[
				'label' => esc_html__( 'Box Styling', 'mascot-core-digicod' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'box_padding',
			[
				'label' => esc_html__( 'Box Padding', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'box_margin',
			[
				'label' => esc_html__( 'Box Margin', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'box_border_options',
			[
				'label' => esc_html__( 'Border Options', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'label' => esc_html__( 'Border', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .tm-sc-tribe-events .event',
			]
		);
		$this->add_responsive_control(
			'box_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_boxshadow',
				'label' => esc_html__( 'Box Shadow', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .tm-sc-tribe-events .event',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_boxshadow_hover',
				'label' => esc_html__( 'Box Shadow(Hover)', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .tm-sc-tribe-events .event:hover',
			]
		);
		$this->add_control(
			'box_bg_color_options',
			[
				'label' => esc_html__( 'Background Color Options', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'box_bg_color',
			[
				'label' => esc_html__( "Background Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'box_bg_color_hover',
			[
				'label' => esc_html__( "Background Color (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event:hover' => 'background-color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'box_bg_theme_colored',
			[
				'label' => esc_html__( "Background Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'box_bg_theme_colored_hover',
			[
				'label' => esc_html__( "Background Colored (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event:hover' => 'background-color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->end_controls_section();




		//Content Options
		$this->start_controls_section(
			'content',
			[
				'label' => esc_html__( 'Contents Show/Hide', 'mascot-core-digicod' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'show_thumb', [
				'label' => esc_html__( "Show Thumbnail", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'feature_thumb_image_size', [
				'label' => esc_html__( "Thumbnail Image Size", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_get_available_image_sizes(),
				'default' => 'post-thumbnail',
				'condition' => [
					'show_thumb' => array('yes'),
				]
			]
		);
		$this->add_control(
			'show_title',
			[
				'label' => esc_html__( "Show Title", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);
		$this->add_control(
			'title_tag',
			[
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
			'show_excerpt',
			[
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
			'show_meta',
			[
				'label' => esc_html__( "Show Post Meta", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);
		$this->add_control(
			'meta_options',
			[
				'label' => esc_html__( "Choose Meta", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'options' => [
					'show-date-over-image'	=>	esc_html__( 'Show Date Over Image', 'mascot-core-digicod' ),
					'show-full-date'	=>	esc_html__( 'Show Full Date & Time', 'mascot-core-digicod' ),
					'show-time'	=>	esc_html__( 'Show Only Time', 'mascot-core-digicod' ),
					'show-venue'	=>	esc_html__( 'Show Venue', 'mascot-core-digicod' ),
					'show-organizer'	=>	esc_html__( 'Show Organizer', 'mascot-core-digicod' ),
					'show-cat'	=>	esc_html__( 'Show Category', 'mascot-core-digicod' ),
				],
				'multiple' => true,
				'description' => esc_html__('Enable/Disabling this option will show/hide each Post Meta', 'mascot-core-digicod'),
				'default' => [ 'show-date-over-image', 'show-time' ],
				'condition' => [
					'show_meta' => array('yes')
				]
			]
		);
		$this->add_control(
			'show_single_date_meta',
			[
				'label' => esc_html__( "Show Single Date Block", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);
		$this->add_control(
			'show_single_date_meta_options',
			[
				'label' => esc_html__( "Choose Meta", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'options' => [
					'show-date'	=>	esc_html__( 'Show Only Date', 'mascot-core-digicod' ),
					'show-time'	=>	esc_html__( 'Show Only Time', 'mascot-core-digicod' ),
					'show-full-date'	=>	esc_html__( 'Show Full Date & Time', 'mascot-core-digicod' ),
				],
				'default' => 'show-date',
				'condition' => [
					'show_single_date_meta' => array('yes')
				]
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


		//add button controns
		mascot_core_get_button_control($this, true);

		//add Loadmore button controns
		//mascot_core_get_loadmore_button_control($this);
	}

	public function query_posts() {
		$settings = $this->get_settings_for_display();
		$paged = isset($settings['paged']) ? $settings['paged'] : '';

		//query args
		$args = array(
			'post_type' => 'tribe_events',
			'orderby' => $settings['order_by'],
			'order' => $settings['order'],
			'posts_per_page' => $settings['total_items'],
			'paged' => $paged,
		);

		$meta_query = array();

		$event_start_date = $settings['event_start_date'];
		$event_end_date = $settings['event_end_date'];

		if( '' !== $settings['coming_soon'] ) {
			$event_start_date = date('Y-m-d h:i:s');
			$event_end_date = '';
		}

		if( $event_start_date ) {
			$meta_query[] = array(
				'key' => '_EventStartDate',
				'value' => $event_start_date,
				'compare' => '>=',
			);
		}

		if( $event_end_date ) {
			$meta_query[] = array(
				'key' => '_EventEndDate',
				'value' => $event_end_date,
				'compare' => '<=',
			);
		}

		if( $settings['venue'] ) {
			$meta_query[] = array(
				'key' => '_EventVenueID',
				'value' => $settings['venue'],
				'operator'  => 'IN'
			);
		}

		if( $settings['organizer'] ) {
			$meta_query[] = array(
				'key' => '_EventOrganizerID',
				'value' => $settings['organizer'],
				'operator'  => 'IN'
			);
		}

		if( ! empty( $meta_query ) ) {
			$meta_query['relation'] = 'AND';
			$args['meta_query'] = $meta_query;
		}

		if( ! empty( $settings['ids'] ) ) {
			$args['post__in'] = $settings['ids'];
		}

		if( ! empty( $settings['category'] ) ) {
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'tribe_events_cat',
					'field'    => 'term_id',
					'terms'    => $settings['category'],
				),
			);
		}
		return $the_query = new \WP_Query( $args );
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
		$class_instance =  '';

		$settings['holder_id'] = mascot_core_get_isotope_holder_ID('events');

		$this->render_output( $class_instance, $settings );
	}

	public function render_output( $class_instance, $settings ) {
		$new_cpt_class = $class_instance;
		$settings['the_query'] = $this->query_posts();
		
		if ( !$settings['the_query']->have_posts() && isset( $settings['from_loadmore_ajax_handler'] ) && $settings['from_loadmore_ajax_handler'] === true ) {
			return;
		}


		//classes
		$classes = array();
		if( isset($settings['_skin']) ) {
			$classes[] = 'tribe-events-' . $settings['_skin'];
		}
		
		$settings['classes'] = $classes;

		//button classes
		$settings['btn_classes'] = mascot_core_prepare_button_classes_from_params( $settings );
		//$settings['loadmore_btn_classes'] = mascot_core_prepare_button_classes_from_params( $settings, 'loadmore_' );


		//event-date classes
		$event_left_classes = array();
		$settings['event_left_classes'] = $event_left_classes;
		
		//Owl Carousel Data
		$settings['owl_carousel_data_info'] = mascot_core_prepare_owlcarousel_data_from_params( $settings );

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = mascot_core_digicod_get_shortcode_template_part( 'tribe-events', $settings['display_type'], 'tribe-events/tpl', $settings, true );
		
		echo $html;
	}
}