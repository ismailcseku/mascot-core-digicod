<?php
namespace MascotCoreDigicod\Widgets\ServiceBlock;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TM_Elementor_ServiceBlock extends Widget_Base {
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		$direction_suffix = is_rtl() ? '.rtl' : '';
		wp_enqueue_style( 'tm-service-block-loader', MASCOT_CORE_DIGICOD_URL_PATH . 'assets/css/shortcodes/service-block/service-block-loader' . $direction_suffix . '.css' );
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
		return 'tm-ele-service-block';
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
		return esc_html__( 'Service Block', 'mascot-core-digicod' );
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
	 * Skins
	 */
	protected function register_skins() {
		$this->add_skin( new Skins\Skin_Style1( $this ) );
		$this->add_skin( new Skins\Skin_Style2( $this ) );
		$this->add_skin( new Skins\Skin_Style3( $this ) );
		$this->add_skin( new Skins\Skin_Style4( $this ) );
		$this->add_skin( new Skins\Skin_Style5( $this ) );
		$this->add_skin( new Skins\Skin_Style6( $this ) );
		$this->add_skin( new Skins\Skin_Style7( $this ) );
		$this->add_skin( new Skins\Skin_Style8( $this ) );
		$this->add_skin( new Skins\Skin_Style9( $this ) );
		$this->add_skin( new Skins\Skin_Style10( $this ) );
		$this->add_skin( new Skins\Skin_Style11( $this ) );
		$this->add_skin( new Skins\Skin_Style12( $this ) );
		$this->add_skin( new Skins\Skin_Style13( $this ) );
		$this->add_skin( new Skins\Skin_Style14( $this ) );
		$this->add_skin( new Skins\Skin_Style15( $this ) );
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
		$this->start_controls_section(
			'service_icons_options', [
				'label' => esc_html__( 'Service Items', 'mascot-core-digicod' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'custom_css_class',
			[
				'label' => esc_html__( "Custom CSS class", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
		$repeater->add_control(
			'title',
			[
				'label' => esc_html__( "Title", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( "This is a section title", 'mascot-core-digicod' ),
			]
		);
		$repeater->add_control(
			'title_tag',
			[
				'label' => esc_html__( "Title Tag", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_heading_tag_list(),
				'default' => 'h4'
			]
		);
		$repeater->add_control(
			'subtitle',
			[
				'label' => esc_html__( "Subtitle", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( "This is a section subtitle", 'mascot-core-digicod' ),
			]
		);
		$repeater->add_control(
			'subtitle_tag',
			[
				'label' => esc_html__( "Subtitle Tag", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_heading_tag_list(),
				'default' => 'h5'
			]
		);
		$repeater->add_control(
			'count',
			[
				'label' => esc_html__( "Count", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( "01", 'mascot-core-digicod' ),
			]
		);
		$repeater->add_control(
			'feature_link',
			[
				'label' => esc_html__( "Link URL", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::URL,
				'show_external' => true,
				'default' => [
					'url' => '',
				]
			]
		);
		$repeater->add_control(
			'featured_image_section',
			[
				'label' => esc_html__( 'Featured Image Section', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$repeater->add_control(
			'featured_image',
			[
				'label' => esc_html__( "Featured Image", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
			]
		);
		$repeater->add_control(
			'featured_image_size',
			[
				'label' => esc_html__( "Featured Image Size", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_get_available_image_sizes(),
				'default' => 'medium',
			]
		);
		$repeater->add_control(
			'service_icon_image_section',
			[
				'label' => esc_html__( 'Service Icon Section', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$repeater->add_control(
			'icon_type',
			[
				'label' => esc_html__( "Service Icon Type", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'font-icon' => esc_html__( 'Font/Flat Icon', 'mascot-core-digicod' ),
					'image' => esc_html__( 'JPG/PNG Image', 'mascot-core-digicod' ),
				],
				'default' => 'font-icon',
			]
		);
		$repeater->add_control(
			'service_icon_image',
			[
				'label' => esc_html__( "Icon Type - Image", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'description' => esc_html__( "This image will be shown on the top of the pricing table", 'mascot-core-digicod' ),
				'condition' => [
					'icon_type' => array('image')
				]
			]
		);
		$repeater->add_control(
			'service_icon_image_hover',
			[
				'label' => esc_html__( "Icon Type - Image (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'description' => esc_html__( "This image will be shown on the top of the pricing table", 'mascot-core-digicod' ),
				'condition' => [
					'icon_type' => array('image')
				]
			]
		);
		$repeater->add_control(
			'service_icon_image_size',
			[
				'label' => esc_html__( "Icon Type - Image Size", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_get_available_image_sizes(),
				'default' => 'full',
				'condition' => [
					'icon_type' => array('image')
				]
			]
		);
		$repeater->add_responsive_control(
			'service_icon_image_width',
			[
				'label' => esc_html__( "Icon Image Custom Width", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'separator' => 'before',
				'size_units' => [ 'px', '%' ],
				'default' => [
					'unit' => '%',
				],
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 400,
						'step' => 1,
					],
					'%' => [
						'min' => 5,
						'max' => 100,
						'step' => 1,
					],
				],
				'condition' => [
					'icon_type' => array('image')
				],
				'selectors' => [
					'{{WRAPPER}} .service-icon img' => 'width: {{SIZE}}{{UNIT}};'
				]
			]
		);
		$repeater->add_control(
			'service_icon',
			[
				'label' => __('Icon', 'mascot-core-digicod'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'far fa-chart-bar',
					'library' => 'font-awesome',
				],
				'condition' => [
					'icon_type' => array('font-icon')
				]
			]
		);
		$repeater->add_control(
			'content',
			[
				'label' => esc_html__( "Paragraph", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( "Write a short description, that will describe the title or something informational and useful.", 'mascot-core-digicod' ),
				'separator' => 'before',
			]
		);
		$this->add_control(
			'service_items_array',
			[
				'label' => esc_html__( "Service Items", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'title' => esc_html__( 'Title #1', 'mascot-core-digicod' ),
						'subtitle' => esc_html__( 'subtitle #1', 'mascot-core-digicod' ),
						'featured_image' => Utils::get_placeholder_image_src(),
						'content' => esc_html__( 'Item content. Click the edit button to change this text.', 'mascot-core-digicod' ),
						'count' => esc_html__( '01', 'mascot-core-digicod' ),
					],
					[
						'title' => esc_html__( 'Title #2', 'mascot-core-digicod' ),
						'subtitle' => esc_html__( 'Title #2', 'mascot-core-digicod' ),
						'featured_image' => Utils::get_placeholder_image_src(),
						'content' => esc_html__( 'Item content. Click the edit button to change this text.', 'mascot-core-digicod' ),
						'count' => esc_html__( '02', 'mascot-core-digicod' ),
					],
					[
						'title' => esc_html__( 'Title #3', 'mascot-core-digicod' ),
						'subtitle' => esc_html__( 'Title #3', 'mascot-core-digicod' ),
						'featured_image' => Utils::get_placeholder_image_src(),
						'content' => esc_html__( 'Item content. Click the edit button to change this text.', 'mascot-core-digicod' ),
						'count' => esc_html__( '03', 'mascot-core-digicod' ),
					],
				],
			]
		);
		$this->end_controls_section();







		$this->start_controls_section(
			'general',
			[
				'label' => esc_html__( 'General Settings', 'mascot-core-digicod' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_responsive_control(
			'text_alignment',
			[
				'label' => esc_html__( "Text Alignment", 'mascot-core-digicod' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => mascot_core_text_align_choose(),
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'display_type', [
				'label' => esc_html__( "Display Type", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'grid'  =>  esc_html__( 'Grid', 'mascot-core-digicod' ),
					'masonry' =>  esc_html__( 'Masonry', 'mascot-core-digicod' ),
					'carousel'  =>  esc_html__( 'Carousel', 'mascot-core-digicod' )
				],
				'default' => 'grid'
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
				'default' => '4'
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
		$this->add_control(
			'show_paragraph', [
				'label' => esc_html__( "Show Paragraph", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);
		$this->end_controls_section();









		$this->start_controls_section(
			'title_options_styling',
			[
				'label' => esc_html__( 'Title Styling', 'mascot-core-digicod' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs('tabs_title_styling');
		$this->start_controls_tab(
			'tabs_title_styling_normal',
			[
				'label' => esc_html__('Normal', 'mascot-core-digicod'),
			]
		);
		$this->add_control(
			'title_text_color',
			[
				'label' => esc_html__( "Text Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .service-item .service-title' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'title_theme_colored',
			[
				'label' => esc_html__( "Text Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .service-item .service-title' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Typography', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .service-item .service-title',
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__( 'Margin', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .service-item .service-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_padding',
			[
				'label' => esc_html__( 'Padding', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .service-item .service-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_title_styling_wrapper_hover',
			[
				'label' => esc_html__('Wrapper Hover', 'mascot-core-digicod'),
			]
		);
		$this->add_control(
			'title_text_color_item_wrapper_hover',
			[
				'label' => esc_html__( "Text Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .service-item:hover .service-title' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'title_theme_colored_item_wrapper_hover',
			[
				'label' => esc_html__( "Text Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .service-item:hover .service-title' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_title_styling_hover',
			[
				'label' => esc_html__('Hover', 'mascot-core-digicod'),
			]
		);
		$this->add_control(
			'title_text_color_hover',
			[
				'label' => esc_html__( "Text Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .service-item .service-title:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .service-item .service-title a:hover' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'title_theme_colored_hover',
			[
				'label' => esc_html__( "Text Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .service-item .service-title:hover' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .service-item .service-title a:hover' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();




		$this->start_controls_section(
			'subtitle_options_styling',
			[
				'label' => esc_html__( 'Subtitle Styling', 'mascot-core-digicod' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs('tabs_subtitle_styling');
		$this->start_controls_tab(
			'tabs_subtitle_styling_normal',
			[
				'label' => esc_html__('Normal', 'mascot-core-digicod'),
			]
		);
		$this->add_control(
			'subtitle_text_color',
			[
				'label' => esc_html__( "Text Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .service-item .service-subtitle' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'subtitle_theme_colored',
			[
				'label' => esc_html__( "Text Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .service-item .service-subtitle' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'subtitle_typography',
				'label' => esc_html__( 'Typography', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .service-item .service-subtitle',
			]
		);
		$this->add_responsive_control(
			'subtitle_margin',
			[
				'label' => esc_html__( 'Margin', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .service-item .service-subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'subtitle_padding',
			[
				'label' => esc_html__( 'Padding', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .service-item .service-subtitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_subtitle_styling_wrapper_hover',
			[
				'label' => esc_html__('Wrapper Hover', 'mascot-core-digicod'),
			]
		);
		$this->add_control(
			'subtitle_text_color_item_wrapper_hover',
			[
				'label' => esc_html__( "Text Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .service-item:hover .service-subtitle' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'subtitle_theme_colored_item_wrapper_hover',
			[
				'label' => esc_html__( "Text Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .service-item:hover .service-subtitle' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();






		$this->start_controls_section(
			'excerpt_options_styling',
			[
				'label' => esc_html__( 'Excerpt Styling', 'mascot-core-digicod' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs('tabs_excerpt_styling');
		$this->start_controls_tab(
			'tabs_excerpt_styling_normal',
			[
				'label' => esc_html__('Normal', 'mascot-core-digicod'),
			]
		);
		$this->add_control(
			'excerpt_text_color',
			[
				'label' => esc_html__( "Text Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .service-item .service-details' => 'color: {{VALUE}};'
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
					'{{WRAPPER}} .service-item .service-details' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'excerpt_typography',
				'label' => esc_html__( 'Typography', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .service-item .service-details',
			]
		);
		$this->add_responsive_control(
			'excerpt_margin',
			[
				'label' => esc_html__( 'Margin', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .service-item .service-details' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'excerpt_padding',
			[
				'label' => esc_html__( 'Padding', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .service-item .service-details' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_excerpt_styling_wrapper_hover',
			[
				'label' => esc_html__('Wrapper Hover', 'mascot-core-digicod'),
			]
		);
		$this->add_control(
			'excerpt_text_color_item_wrapper_hover',
			[
				'label' => esc_html__( "Text Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .service-item:hover .service-details' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'excerpt_theme_colored_item_wrapper_hover',
			[
				'label' => esc_html__( "Text Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .service-item:hover .service-details' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();






		$this->start_controls_section(
			'icon_custom_styling',
			[
				'label' => esc_html__( 'Icon Custom Styling', 'mascot-core-digicod' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'animate_icon_on_hover',
			[
				'label' => esc_html__( "Animate Icon on Hover", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'' => esc_html__( 'None', 'mascot-core-digicod' ),
					'rotate' => esc_html__( 'Rotate', 'mascot-core-digicod' ),
					'rotate-x' => esc_html__( 'Rotate X', 'mascot-core-digicod' ),
					'rotate-y' => esc_html__( 'Rotate Y', 'mascot-core-digicod' ),
					'translate'  => esc_html__( 'Translate', 'mascot-core-digicod' ),
					'translate-x'  => esc_html__( 'Translate X', 'mascot-core-digicod' ),
					'translate-y'  => esc_html__( 'Translate Y', 'mascot-core-digicod' ),
					'scale'  => esc_html__( 'Scale', 'mascot-core-digicod' ),
				],
				'default' => '',
			]
		);
		$this->start_controls_tabs('tabs_current_theme_styling');
		$this->start_controls_tab(
			'tabs_current_theme_styling_normal',
			[
				'label' => esc_html__('Normal', 'mascot-core-digicod'),
			]
		);
		$this->add_control(
			'animate_icon_on_hover',
			[
				'label' => esc_html__( "Animate Icon on Hover", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'' => esc_html__( 'None', 'mascot-core-digicod' ),
					'rotate' => esc_html__( 'Rotate', 'mascot-core-digicod' ),
					'rotate-x' => esc_html__( 'Rotate X', 'mascot-core-digicod' ),
					'rotate-y' => esc_html__( 'Rotate Y', 'mascot-core-digicod' ),
					'translate'  => esc_html__( 'Translate', 'mascot-core-digicod' ),
					'translate-x'  => esc_html__( 'Translate X', 'mascot-core-digicod' ),
					'translate-y'  => esc_html__( 'Translate Y', 'mascot-core-digicod' ),
					'scale'  => esc_html__( 'Scale', 'mascot-core-digicod' ),
				],
				'default' => '',
			]
		);

		$this->add_control(
			'hr01-pos',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
		$this->add_control(
			'icon_color_options',
			[
				'label' => esc_html__( 'Icon Color Options', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'icon_custom_color',
			[
				'label' => esc_html__( "Icon Custom Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .icon-box .service-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .service-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .service-icon svg' => 'fill: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'icon_theme_colored',
			[
				'label' => esc_html__( "Make Icon Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon-box .service-icon' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .service-icon' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .service-icon svg' => 'fill: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'icon_typography',
				'label' => esc_html__( 'Typography', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .service-icon i, {{WRAPPER}} .service-icon svg',
			]
		);
		$this->add_control(
			'hr1-funfact',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
		$this->add_control(
			'icon_bgcolor_options',
			[
				'label' => esc_html__( 'Icon Background Color Options', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'icon_area_custom_bg_color',
			[
				'label' => esc_html__( "Icon Area Custom BG Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .icon-box .service-icon' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .service-icon' => 'background-color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'icon_area_bg_theme_colored',
			[
				'label' => esc_html__( "Icon Area BG Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon-box .service-icon' => 'background-color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .service-icon' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_responsive_control(
			'icon-line-height',
			[
				'label' => esc_html__( "Icon Line Height", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .icon-box .service-icon' => 'line-height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .service-icon' => 'line-height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .service-icon i' => 'line-height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .service-icon svg' => 'line-height: {{SIZE}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'icon_margin',
			[
				'label' => esc_html__( 'Icon Margin', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .service-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_padding',
			[
				'label' => esc_html__( 'Icon Padding', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .service-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'icon_area_border_options',
			[
				'label' => esc_html__( 'Border Options', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'icon_area_border',
				'label' => esc_html__( 'Border', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .service-icon',
			]
		);
		$this->add_responsive_control(
			'icon_area_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .service-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_area_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .service-icon',
			]
		);
		$this->add_control(
			'icon_area_dimension_options',
			[
				'label' => esc_html__( 'Dimension Options', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'icon_area_width',
			[
				'label' => esc_html__( "Width", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .icon-box .service-icon' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .service-icon' => 'width: {{SIZE}}{{UNIT}};',
				]
			]
		);
		$this->add_control(
			'icon_area_width_auto',
			[
				'label' => esc_html__( "Make Icon Width to Auto?", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} .icon-box .service-icon' => 'width: auto;',
					'{{WRAPPER}} .service-icon' => 'width: auto;',
				]
			]
		);
		$this->add_responsive_control(
			'icon_area_height',
			[
				'label' => esc_html__( "Height", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .icon-box .service-icon' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .service-icon' => 'height: {{SIZE}}{{UNIT}};',
				]
			]
		);
		$this->add_control(
			'icon_area_height_auto',
			[
				'label' => esc_html__( "Make Icon Height to Auto?", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} .icon-box .service-icon' => 'height: auto;',
					'{{WRAPPER}} .service-icon' => 'height: auto;',
				]
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_current_theme_styling_hover',
			[
				'label' => esc_html__('Hover', 'mascot-core-digicod'),
			]
		);
		$this->add_control(
			'icon_color_options_hover',
			[
				'label' => esc_html__( 'Icon Color Options', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'icon_custom_color_hover',
			[
				'label' => esc_html__( "Icon Custom Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .icon-box .service-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}}:hover .service-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}}:hover .service-icon svg' => 'fill: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'icon_theme_colored_hover',
			[
				'label' => esc_html__( "Make Icon Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .icon-box .service-icon' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}}:hover .service-icon' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}}:hover .service-icon svg' => 'fill: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_control(
			'hr1-funfact_hover',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
		$this->add_control(
			'icon_bgcolor_options_hover',
			[
				'label' => esc_html__( 'Icon Background Color Options', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'icon_area_custom_bg_color_hover',
			[
				'label' => esc_html__( "Icon Area Custom BG Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .icon-box .service-icon' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}:hover .service-icon' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'icon_area_bg_theme_colored_hover',
			[
				'label' => esc_html__( "Icon Area BG Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .icon-box .service-icon' => 'background-color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}}:hover .service-icon' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();






		//other settings
		$this->start_controls_section(
			'other_options',
			[
				'label' => esc_html__( 'Other Options', 'mascot-core-digicod' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'box_animation',
			[
				'label' => esc_html__( "Box Animation Style", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					''  =>  esc_html__( 'No Animation', 'mascot-core-digicod' ),
					'iconbox-style1-current-theme-animation'  =>  esc_html__( 'Style 1 - Current Theme Animation', 'mascot-core-digicod' ),
					'iconbox-style2-border-bottom'  =>  esc_html__( 'Style 2 - Border Bottom', 'mascot-core-digicod' ),
					'iconbox-style3-moving-border-bottom' =>  esc_html__( 'Style 3 - Moving Border Bottom', 'mascot-core-digicod' ),
					'iconbox-style4-bgcolor'  =>  esc_html__( 'Style 4 - Hover BG Color', 'mascot-core-digicod' ),
					'iconbox-style5-moving-bgcolor' =>  esc_html__( 'Style 5 - Hover Moving BG Color', 'mascot-core-digicod' ),
					'iconbox-style6-moving-double-bgcolor'  =>  esc_html__( 'Style 6 - Hover Moving Double BG Color', 'mascot-core-digicod' ),
					'iconbox-style7-hover-moving-border'  =>  esc_html__( 'Style 7 - Hover Moving Border Around Box', 'mascot-core-digicod' ),
				],
				'default' => '',
			]
		);
		$this->add_control(
			'box_shadow',
			[
				'label' => esc_html__( "Box Shadow?", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
			]
		);
		$this->add_control(
			'box_shadow_on_hover',
			[
				'label' => esc_html__( "Box Shadow only on Hover?", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
			]
		);
		$this->end_controls_section();



		$this->start_controls_section(
			'button_options',
			[
				'label' => esc_html__( 'Button Options', 'mascot-core-digicod' ),
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

		//enqueue css
		$direction_suffix = is_rtl() ? '.rtl' : '';
		wp_enqueue_style( 'tm-service-block-style1', MASCOT_CORE_DIGICOD_URL_PATH . 'assets/css/shortcodes/service-block/service-block-style1' . $direction_suffix . '.css' );

		if( $settings['animate_icon_on_hover'] ) {
			$classes[] = 'animate-icon-on-hover animate-icon-'.$settings['animate_icon_on_hover'];
		}

		//icon classes
		$icon_classes = array();
		$settings['icon_classes'] = $icon_classes;

		//button classes
		$settings['btn_classes'] = mascot_core_prepare_button_classes_from_params( $settings );


		//icon classes
		$icon_classes = array();
		$settings['icon_classes'] = $icon_classes;

		//Owl Carousel Data
		$settings['owl_carousel_data_info'] = mascot_core_prepare_owlcarousel_data_from_params( $settings );
		$settings['holder_id'] = digicod_get_isotope_holder_ID('service-block');

		$settings['settings'] = $settings;


		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = mascot_core_digicod_get_shortcode_template_part( 'service', $settings['display_type'], 'service-block/tpl', $settings, true );

		echo $html;
	}
}
