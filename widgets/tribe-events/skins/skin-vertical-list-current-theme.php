<?php
namespace MascotCoreDigicod\Widgets\Events\Skins;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Skin_Base as Elementor_Skin_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Vertical_List_Current_Theme extends Elementor_Skin_Base {
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		wp_enqueue_script( 'jquery-bxslider' );
		wp_enqueue_style( 'jquery-bxslider' );
	}

	protected function _register_controls_actions() {
		add_action( 'elementor/element/tm-ele-tribe-events/general/before_section_end', [ $this, 'register_layout_controls_list_slide' ] );
		add_action( 'elementor/element/tm-ele-tribe-events/general/after_section_end', [ $this, 'register_layout_controls' ] );
	}

	public function get_id() {
		return 'skin-vertical-list-current-theme';
	}


	public function get_title() {
		return __( 'Skin Vertical List Current Theme', 'mascot-core-digicod' );
	}

	public function register_layout_controls_list_slide( Widget_Base $widget ) {
		$this->parent = $widget;
		$this->add_control(
			'display_type', [
				'label' => esc_html__( "Display Type", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'list'		=>	esc_html__( 'List', 'mascot-core-digicod' ),
					'slide'	=>	esc_html__( 'Vertical Slide', 'mascot-core-digicod' ),
				],
				'default' => 'list',
			]
		);
	}



	public function register_layout_controls( Widget_Base $widget ) {
		$this->parent = $widget;



		//List - Vertical Options
		$this->start_controls_section(
			'thumb_options', [
				'label' => esc_html__( 'List Vertical - Thumb Options', 'mascot-core-digicod' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'show_left_thumb', [
				'label' => esc_html__( "Show Left Thumbnail Block", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);
		$this->add_control(
			'left_thumb_image_size', [
				'label' => esc_html__( "Thumb Image Size", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_get_available_image_sizes(),
				'default' => 'thumbnail',
			]
		);
		$this->add_responsive_control(
			'thumb_custom_width',
			[
				'label' => esc_html__( "Custom Thumb Width", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px','%' ],
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 300,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-left .event-thumb' => 'width: {{SIZE}}{{UNIT}};max-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-left .event-thumb img' => 'width: {{SIZE}}{{UNIT}};max-width: {{SIZE}}{{UNIT}};'
				],
			]
		);
		$this->add_responsive_control(
			'thumb_margin',
			[
				'label' => esc_html__( 'Thumb Margin', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-left .event-thumb' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'thumb_padding',
			[
				'label' => esc_html__( 'Thumb Padding', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-left .event-thumb' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'thumb_border_options',
			[
				'label' => esc_html__( 'Border Options', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'thumb_border_radius',
			[
				'label' => esc_html__( 'Thumb Border Radius', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-left .event-thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'thumb_boxshadow',
				'label' => esc_html__( 'Box Shadow', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .tm-sc-tribe-events .event .event-left .event-thumb',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'thumb_border',
				'label' => esc_html__( 'Border', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .tm-sc-tribe-events .event .event-left .event-thumb',
			]
		);
		$this->end_controls_section();






		//List - Vertical Options
		$this->start_controls_section(
			'date_options', [
				'label' => esc_html__( 'List Vertical - Date Options', 'mascot-core-digicod' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'show_left_date', [
				'label' => esc_html__( "Show Left Date Block", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);
		$this->add_control(
			'left_date_placement', [
				'label' => esc_html__( "Date Block Placement", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'left' => esc_html__( 'Left', 'mascot-core-digicod' ),
					'right' => esc_html__( 'Right', 'mascot-core-digicod' ),
				],
				'default' => 'left',
			]
		);
		$this->add_responsive_control(
			'left_date_custom_width',
			[
				'label' => esc_html__( "Custom Date Block Width", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px','%' ],
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 300,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-left .event-date' => 'width: {{SIZE}}{{UNIT}};max-width: {{SIZE}}{{UNIT}};'
				],
			]
		);
		$this->start_controls_tabs('left_date_typo_tabs');
		$this->start_controls_tab(
			'left_date_day_typo_tab',
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
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-left .event-date .day' => 'display: none;',
				]
			]
		);
		$this->add_control(
			'date_single_meta_day_block',
			[
				'label' => esc_html__( "Make it full width?", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-left .event-date .day' => 'display: block;',
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
				'name' => 'left_date_day_typography',
				'label' => esc_html__( 'Day Typography', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .tm-sc-tribe-events .event .event-left .event-date .day',
			]
		);
		$this->add_control(
			'left_date_day_text_color',
			[
				'label' => esc_html__( "Day Text Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-left .event-date .day' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'left_date_day_text_color_hover',
			[
				'label' => esc_html__( "Day Text Color (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event:hover .event-left .event-date .day' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'left_date_day_theme_colored',
			[
				'label' => esc_html__( "Day Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-left .event-date .day' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_control(
			'left_date_day_theme_colored_hover',
			[
				'label' => esc_html__( "Day Theme Colored (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event:hover .event-left .event-date .day' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_responsive_control(
			'left_date_day_margin',
			[
				'label' => esc_html__( 'Day Margin', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-left .event-date .day' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'left_date_month_typo_tab',
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
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-left .event-date .month' => 'display: none;',
				]
			]
		);
		$this->add_control(
			'date_single_meta_month_block',
			[
				'label' => esc_html__( "Make it full width?", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-left .event-date .month' => 'display: block;',
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
				'name' => 'left_date_month_typography',
				'label' => esc_html__( 'Month Typography', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .tm-sc-tribe-events .event .event-left .event-date .month',
			]
		);
		$this->add_control(
			'left_date_month_text_color',
			[
				'label' => esc_html__( "Month Text Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-left .event-date .month' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'left_date_month_text_color_hover',
			[
				'label' => esc_html__( "Month Text Color (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event:hover .event-left .event-date .month' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'left_date_month_theme_colored',
			[
				'label' => esc_html__( "Month Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-left .event-date .month' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_control(
			'left_date_month_theme_colored_hover',
			[
				'label' => esc_html__( "Month Theme Colored (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event:hover .event-left .event-date .month' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_responsive_control(
			'left_date_month_margin',
			[
				'label' => esc_html__( 'Month Margin', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-left .event-date .month' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'left_date_year_typo_tab',
			[
				'label' => esc_html__('Year Typo', 'mascot-core-digicod'),
			]
		);
		$this->add_control(
			'date_single_meta_year_hide',
			[
				'label' => esc_html__( "Hide Year?", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-left .event-date .year' => 'display: none;',
				]
			]
		);
		$this->add_control(
			'date_single_meta_year_block',
			[
				'label' => esc_html__( "Make it full width?", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-left .event-date .year' => 'display: block;',
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
				'name' => 'left_date_year_typography',
				'label' => esc_html__( 'Year Typography', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .tm-sc-tribe-events .event .event-left .event-date .year',
			]
		);
		$this->add_control(
			'left_date_year_text_color',
			[
				'label' => esc_html__( "Year Text Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-left .event-date .year' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'left_date_year_text_color_hover',
			[
				'label' => esc_html__( "Year Text Color (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event:hover .event-left .event-date .year' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'left_date_year_theme_colored',
			[
				'label' => esc_html__( "Year Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-left .event-date .year' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_control(
			'left_date_year_theme_colored_hover',
			[
				'label' => esc_html__( "Year Theme Colored (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event:hover .event-left .event-date .year' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_responsive_control(
			'left_date_year_margin',
			[
				'label' => esc_html__( 'Year Margin', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-left .event-date .year' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->start_controls_tabs('left_date_bg_tabs');
		$this->start_controls_tab(
			'left_date_bg_tab',
			[
				'label' => esc_html__('Background Options', 'mascot-core-digicod'),
			]
		);
		$this->add_control(
			'left_date_theme_colored',
			[
				'label' => esc_html__( "Date Block BG Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-left .event-date' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'left_date_theme_colored_hover',
			[
				'label' => esc_html__( "Date Block BG Theme Colored (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event:hover .event-left .event-date' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'left_date_custom_bg_color',
			[
				'label' => esc_html__( "Date Block BG Custom Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-left .event-date' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'left_date_custom_bg_color_hover',
			[
				'label' => esc_html__( "Date Block BG Custom Color (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event:hover .event-left .event-date' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();


		$this->add_control(
			'left_date_margin_padding_options',
			[
				'label' => esc_html__( 'Margin/Padding Options', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'left_date_padding',
			[
				'label' => esc_html__( 'Date Block Padding', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-left .event-date' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'left_date_margin',
			[
				'label' => esc_html__( 'Date Block Margin', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-left .event-date' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'left_date_border_options',
			[
				'label' => esc_html__( 'Border Options', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'left_date_border_radius',
			[
				'label' => esc_html__( 'Date Block Border Radius', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event .event-left .event-date' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'left_date_boxshadow',
				'label' => esc_html__( 'Date Block Box Shadow', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .tm-sc-tribe-events .event .event-left .event-date',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'left_date_border',
				'label' => esc_html__( 'Date Block Border', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .tm-sc-tribe-events .event .event-left .event-date',
			]
		);
		$this->end_controls_section();





		//List - Vertical Options
		$this->start_controls_section(
			'wrapper_options', [
				'label' => esc_html__( 'List - Vertical Wrapper Options', 'mascot-core-digicod' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->start_controls_tabs('tabs_vertical_list_wrapper_styles');
		$this->start_controls_tab(
			'normal',
			[
				'label' => esc_html__('Normal', 'mascot-core-digicod'),
			]
		);
		$this->add_control(
			'flex_options',
			[
				'label' => esc_html__( 'Vertical Placement Option', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'flex_vertical',
			[
				'label' => esc_html__( "Vertical Alignment", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_disply_flex_vertical_align_elementor(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event' => 'align-items: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'margin_options',
			[
				'label' => esc_html__( 'Padding/Margin Options', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'padding',
			[
				'label' => esc_html__( 'List Padding', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'margin',
			[
				'label' => esc_html__( 'List Margin', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'bg_options',
			[
				'label' => esc_html__( 'Background Options', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'bg_color',
			[
				'label' => esc_html__( "Background Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event' => 'background-color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'bg_theme_colored',
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
		$this->add_responsive_control(
			'bg_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'boxshadow',
				'label' => esc_html__( 'Box Shadow', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .tm-sc-tribe-events .event',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'label' => esc_html__( 'Border', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .tm-sc-tribe-events .event',
			]
		);
		$this->end_controls_tab();



		$this->start_controls_tab(
			'hover',
			[
				'label' => esc_html__('Hover', 'mascot-core-digicod'),
			]
		);
		$this->add_control(
			'hover_bg_options',
			[
				'label' => esc_html__( 'Background Options', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'hover_bg_color',
			[
				'label' => esc_html__( "Background Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event:hover' => 'background-color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'hover_bg_theme_colored',
			[
				'label' => esc_html__( "Background Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event:hover' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'hover_boxshadow',
				'label' => esc_html__( 'Box Shadow', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .tm-sc-tribe-events .event:hover',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'hover_border',
				'label' => esc_html__( 'Border', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .tm-sc-tribe-events .event:hover',
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'last_item_list_last_item',
			[
				'label' => esc_html__('Last Item', 'mascot-core-digicod'),
			]
		);
		$this->add_responsive_control(
			'last_item_padding',
			[
				'label' => esc_html__( 'Last Item Padding', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event:last-child' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'last_item_margin',
			[
				'label' => esc_html__( 'Last Item Margin', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-tribe-events .event:last-child' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'last_item_border',
				'label' => esc_html__( 'Last Item Border', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .tm-sc-tribe-events .event:last-child',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();



		//List - Vertical Slide Options
		$this->start_controls_section(
			'slide_options', [
				'label' => esc_html__( 'List - Vertical Slide Options', 'mascot-core-digicod' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'slide_minslides', [
				'label' => esc_html__( "Number of Minimum Sliding Items", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '3'
			]
		);
		$this->add_control(
			'slide_autoplay', [
				'label' => esc_html__( "Autoplay", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);
		$this->add_control(
			'slide_show_navigation', [
				'label' => esc_html__( "Show Navigation Arrow", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);
		$this->add_control(
			'slide_navigation_arrow_position', [
				'label' => esc_html__( "Navigation Arrow Position", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'bottom'	=>	esc_html__( 'Bottom', 'mascot-core-digicod' ),
					'top'	=>	esc_html__( 'Top', 'mascot-core-digicod' )
				],
				'default' => 'top',
				'condition' => [
					'skin_vertical_list1_slide_show_navigation' => array('yes')
				]
			]
		);
		$this->end_controls_section();
	}

	public function render() {
		$settings = $this->parent->get_settings();
		$class_instance =  '';

		$settings['holder_id'] = mascot_core_get_isotope_holder_ID('events');

		$this->render_output( $class_instance, $settings );
	}

	public function render_output( $class_instance, $settings ) {
		$new_cpt_class = $class_instance;
		$settings['the_query'] = $this->parent->query_posts();

		//classes
		$classes = array();
		if( isset($settings['_skin']) ) {
			$classes[] = 'tribe-events-' . $settings['_skin'];
		}

		if( $this->parent->get_instance_value_skin('display_type') == 'slide' && $this->parent->get_instance_value_skin('slide_show_navigation') == 'yes' ) {
			$classes[] = 'has-nav-arrow nav-arrow-position-' . $this->parent->get_instance_value_skin('slide_navigation_arrow_position');
		}
		$settings['classes'] = $classes;

		//button classes
		$settings['btn_classes'] = mascot_core_prepare_button_classes_from_params( $settings );


		//event-date classes
		$event_left_classes = array();
		$settings['event_left_classes'] = $event_left_classes;

		//Owl Carousel Data
		$settings['owl_carousel_data_info'] = mascot_core_prepare_owlcarousel_data_from_params( $settings );

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = mascot_core_digicod_get_shortcode_template_part( 'tribe-events-vertical-current-theme', null, 'tribe-events/tpl', $settings, true );

		echo $html;
	}
}
