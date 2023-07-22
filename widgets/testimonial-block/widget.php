<?php
namespace MascotCoreDigicod\Widgets\TestimonialBlock;

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
class TM_Elementor_TestimonialBlock extends Widget_Base {
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		$direction_suffix = is_rtl() ? '.rtl' : '';
		wp_enqueue_style( 'tm-testimonial-block-loader', MASCOT_CORE_DIGICOD_URL_PATH . 'assets/css/shortcodes/testimonial-block/testimonial-block-loader' . $direction_suffix . '.css' );
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
		return 'tm-ele-testimonial-block';
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
		return esc_html__( 'Testimonial Block', 'mascot-core-digicod' );
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
			'testimonial_icons_options', [
				'label' => esc_html__( 'Testimonial Items', 'mascot-core-digicod' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'name',
			[
				'label' => esc_html__( "Author Name", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( "David Smith", 'mascot-core-digicod' ),
			]
		);
		$repeater->add_control(
			'name_tag',
			[
				'label' => esc_html__( "Name Tag", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_heading_tag_list(),
				'default' => 'h4'
			]
		);
		$repeater->add_control(
			'position',
			[
				'label' => esc_html__( "Author Position", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( "Designer", 'mascot-core-digicod' ),
			]
		);
		$repeater->add_control(
			'position_tag',
			[
				'label' => esc_html__( "Position Tag", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_heading_tag_list(),
				'default' => 'div'
			]
		);
		$repeater->add_control(
			'title',
			[
				'label' => esc_html__( "Reason/Title (Optional)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
		$repeater->add_control(
			'title_tag',
			[
				'label' => esc_html__( "Reason/Title Tag", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_heading_tag_list(),
				'default' => 'h5'
			]
		);
		$repeater->add_control(
			'rating',
			[
				'label' => esc_html__( 'Rating Value', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 5,
						'step' => 0.1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 4,
				],
			]
		);
		$repeater->add_control(
			'content',
			[
				'label' => esc_html__( "Testimonial Text", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( "Write a short description, that will describe the title or something informational and useful.", 'mascot-core-digicod' ),
			]
		);
		$repeater->add_control(
			'feature_image',
			[
				'label' => esc_html__( "Author Thumbnail Image", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
			]
		);
		$repeater->add_control(
			'feature_image_size',
			[
				'label' => esc_html__( "Choose Thumbnail Image Size", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_get_available_image_sizes(),
				'default' => 'full',
			]
		);
		$this->add_control(
			'testimonial_items_array',
			[
				'label' => esc_html__( "Testimonial Items", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'title' => esc_html__( 'Title #1', 'mascot-core-digicod' ),
						'position' => esc_html__( 'position #1', 'mascot-core-digicod' ),
						'featured_image' => Utils::get_placeholder_image_src(),
						'content' => esc_html__( 'Item content. Click the edit button to change this text.', 'mascot-core-digicod' ),
						'count' => esc_html__( '01', 'mascot-core-digicod' ),
					],
					[
						'title' => esc_html__( 'Title #2', 'mascot-core-digicod' ),
						'position' => esc_html__( 'Title #2', 'mascot-core-digicod' ),
						'featured_image' => Utils::get_placeholder_image_src(),
						'content' => esc_html__( 'Item content. Click the edit button to change this text.', 'mascot-core-digicod' ),
						'count' => esc_html__( '02', 'mascot-core-digicod' ),
					],
					[
						'title' => esc_html__( 'Title #3', 'mascot-core-digicod' ),
						'position' => esc_html__( 'Title #3', 'mascot-core-digicod' ),
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
			'icon',
			[
				'label' => __('Testimonial Icon', 'mascot-core-digicod'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'far fa-quote',
					'library' => 'font-awesome',
				],
			]
		);

		$this->add_control(
			'show_author_name', [
				'label' => esc_html__( "Show Author Name", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'show_author_position', [
				'label' => esc_html__( "Show Author Position", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);
		$this->add_control(
			'show_title', [
				'label' => esc_html__( "Show Reason/Title", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);
		$this->add_control(
			'show_rating', [
				'label' => esc_html__( "Show Rating", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);
		$this->end_controls_section();














		$this->start_controls_section(
			'icon_styling',
			[
				'label' => esc_html__( 'Icon Styling', 'mascot-core-digicod' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
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

		$this->end_controls_section();










		$this->start_controls_section(
			'author_name_options_styling',
			[
				'label' => esc_html__( 'Author Name Styling', 'mascot-core-digicod' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs('tabs_author_name_styling');
		$this->start_controls_tab(
			'tabs_author_name_styling_normal',
			[
				'label' => esc_html__('Normal', 'mascot-core-digicod'),
			]
		);
		$this->add_control(
			'author_name_text_color',
			[
				'label' => esc_html__( "Text Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-item .testimonial-name' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'author_name_theme_colored',
			[
				'label' => esc_html__( "Text Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .testimonial-item .testimonial-name' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'author_name_typography',
				'label' => esc_html__( 'Typography', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .testimonial-item .testimonial-name',
			]
		);
		$this->add_responsive_control(
			'author_name_margin',
			[
				'label' => esc_html__( 'Margin', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .testimonial-item .testimonial-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'author_name_padding',
			[
				'label' => esc_html__( 'Padding', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .testimonial-item .testimonial-name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_author_name_styling_wrapper_hover',
			[
				'label' => esc_html__('Wrapper Hover', 'mascot-core-digicod'),
			]
		);
		$this->add_control(
			'author_name_text_color_item_wrapper_hover',
			[
				'label' => esc_html__( "Text Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-item:hover .testimonial-name' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'author_name_theme_colored_item_wrapper_hover',
			[
				'label' => esc_html__( "Text Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .testimonial-item:hover .testimonial-name' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_author_name_styling_hover',
			[
				'label' => esc_html__('Hover', 'mascot-core-digicod'),
			]
		);
		$this->add_control(
			'author_name_text_color_hover',
			[
				'label' => esc_html__( "Text Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-item .testimonial-name:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .testimonial-item .testimonial-name a:hover' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'author_name_theme_colored_hover',
			[
				'label' => esc_html__( "Text Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .testimonial-item .testimonial-name:hover' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .testimonial-item .testimonial-name a:hover' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();







		$this->start_controls_section(
			'author_position_options_styling',
			[
				'label' => esc_html__( 'Author Position Styling', 'mascot-core-digicod' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs('tabs_author_position_styling');
		$this->start_controls_tab(
			'tabs_author_position_styling_normal',
			[
				'label' => esc_html__('Normal', 'mascot-core-digicod'),
			]
		);
		$this->add_control(
			'author_position_text_color',
			[
				'label' => esc_html__( "Text Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-item .testimonial-position' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'author_position_theme_colored',
			[
				'label' => esc_html__( "Text Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .testimonial-item .testimonial-position' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'author_position_typography',
				'label' => esc_html__( 'Typography', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .testimonial-item .testimonial-position',
			]
		);
		$this->add_responsive_control(
			'author_position_margin',
			[
				'label' => esc_html__( 'Margin', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .testimonial-item .testimonial-position' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'author_position_padding',
			[
				'label' => esc_html__( 'Padding', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .testimonial-item .testimonial-position' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_author_position_styling_wrapper_hover',
			[
				'label' => esc_html__('Wrapper Hover', 'mascot-core-digicod'),
			]
		);
		$this->add_control(
			'author_position_text_color_item_wrapper_hover',
			[
				'label' => esc_html__( "Text Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-item:hover .testimonial-position' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'author_position_theme_colored_item_wrapper_hover',
			[
				'label' => esc_html__( "Text Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .testimonial-item:hover .testimonial-position' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_author_position_styling_hover',
			[
				'label' => esc_html__('Hover', 'mascot-core-digicod'),
			]
		);
		$this->add_control(
			'author_position_text_color_hover',
			[
				'label' => esc_html__( "Text Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-item .testimonial-position:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .testimonial-item .testimonial-position a:hover' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'author_position_theme_colored_hover',
			[
				'label' => esc_html__( "Text Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .testimonial-item .testimonial-position:hover' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .testimonial-item .testimonial-position a:hover' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();








		$this->start_controls_section(
			'author_text_options_styling',
			[
				'label' => esc_html__( 'Author Text Styling', 'mascot-core-digicod' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs('tabs_author_text_styling');
		$this->start_controls_tab(
			'tabs_author_text_styling_normal',
			[
				'label' => esc_html__('Normal', 'mascot-core-digicod'),
			]
		);
		$this->add_control(
			'author_text_text_color',
			[
				'label' => esc_html__( "Text Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-item .author-text' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'author_text_theme_colored',
			[
				'label' => esc_html__( "Text Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .testimonial-item .author-text' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'author_text_typography',
				'label' => esc_html__( 'Typography', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .testimonial-item .author-text',
			]
		);
		$this->add_responsive_control(
			'author_text_margin',
			[
				'label' => esc_html__( 'Margin', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .testimonial-item .author-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'author_text_padding',
			[
				'label' => esc_html__( 'Padding', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .testimonial-item .author-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_author_text_styling_wrapper_hover',
			[
				'label' => esc_html__('Wrapper Hover', 'mascot-core-digicod'),
			]
		);
		$this->add_control(
			'author_text_text_color_item_wrapper_hover',
			[
				'label' => esc_html__( "Text Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-item:hover .author-text' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'author_text_theme_colored_item_wrapper_hover',
			[
				'label' => esc_html__( "Text Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .testimonial-item:hover .author-text' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_author_text_styling_hover',
			[
				'label' => esc_html__('Hover', 'mascot-core-digicod'),
			]
		);
		$this->add_control(
			'author_text_text_color_hover',
			[
				'label' => esc_html__( "Text Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-item .author-text:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .testimonial-item .author-text a:hover' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'author_text_theme_colored_hover',
			[
				'label' => esc_html__( "Text Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .testimonial-item .author-text:hover' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .testimonial-item .author-text a:hover' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();








		$this->start_controls_section(
			'testimonial_title_options_styling',
			[
				'label' => esc_html__( 'Reason/Title Styling', 'mascot-core-digicod' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs('tabs_testimonial_title_styling');
		$this->start_controls_tab(
			'tabs_testimonial_title_styling_normal',
			[
				'label' => esc_html__('Normal', 'mascot-core-digicod'),
			]
		);
		$this->add_control(
			'testimonial_title_text_color',
			[
				'label' => esc_html__( "Text Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-item .rating .testimonial-title' => 'color: {{VALUE}} !important;'
				]
			]
		);
		$this->add_control(
			'testimonial_title_theme_colored',
			[
				'label' => esc_html__( "Text Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .testimonial-item .rating .testimonial-title' => 'color: var(--theme-color{{VALUE}}) !important;'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'testimonial_title_typography',
				'label' => esc_html__( 'Typography', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .testimonial-item .testimonial-title',
			]
		);
		$this->add_responsive_control(
			'testimonial_title_margin',
			[
				'label' => esc_html__( 'Margin', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .testimonial-item .testimonial-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'testimonial_title_padding',
			[
				'label' => esc_html__( 'Padding', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .testimonial-item .testimonial-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_testimonial_title_styling_wrapper_hover',
			[
				'label' => esc_html__('Wrapper Hover', 'mascot-core-digicod'),
			]
		);
		$this->add_control(
			'testimonial_title_text_color_item_wrapper_hover',
			[
				'label' => esc_html__( "Text Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-item:hover .testimonial-title' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'testimonial_title_theme_colored_item_wrapper_hover',
			[
				'label' => esc_html__( "Text Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .testimonial-item:hover .testimonial-title' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_testimonial_title_styling_hover',
			[
				'label' => esc_html__('Hover', 'mascot-core-digicod'),
			]
		);
		$this->add_control(
			'testimonial_title_text_color_hover',
			[
				'label' => esc_html__( "Text Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-item .testimonial-title:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .testimonial-item .testimonial-title a:hover' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'testimonial_title_theme_colored_hover',
			[
				'label' => esc_html__( "Text Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .testimonial-item .testimonial-title:hover' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .testimonial-item .testimonial-title a:hover' => 'color: var(--theme-color{{VALUE}});'
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
		$settings['holder_id'] = digicod_get_isotope_holder_ID('testimonial-block');

		$settings['settings'] = $settings;


		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = mascot_core_digicod_get_shortcode_template_part( 'testimonial', $settings['display_type'], 'testimonial-block/tpl', $settings, true );

		echo $html;
	}
}
