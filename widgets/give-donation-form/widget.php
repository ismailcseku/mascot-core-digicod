<?php
namespace MascotCoreDigicod\Widgets\GiveSingleForm;

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
class TM_Elementor_Give_Single_Form extends Widget_Base {
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		$direction_suffix = is_rtl() ? '.rtl' : '';

		wp_register_style( 'tm-donation-form-loader-style', MASCOT_CORE_DIGICOD_URL_PATH . 'assets/css/extend-plugins/give/skins-donation-form/donation-form-loader' . $direction_suffix . '.css' );
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
		return 'tm-ele-give-single-form';
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
		return esc_html__( 'Give Donation Form', 'mascot-core-digicod' );
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
		return [ 'tm-donation-form-loader-style' ];
	}


	/**
	 * Skins
	 */
	protected function register_skins() {
		$this->add_skin( new Skins\Skin_Form_Style2( $this ) );
		$this->add_skin( new Skins\Skin_Form_Style3( $this ) );
		$this->add_skin( new Skins\Skin_Form_Style4( $this ) );
		$this->add_skin( new Skins\Skin_Form_Only_Goal_Btn( $this ) );
		$this->add_skin( new Skins\Skin_Form_White( $this ) );
		$this->add_skin( new Skins\Skin_Form_Black( $this ) );
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
			'general', [
				'label' => esc_html__( 'General', 'mascot-core-digicod' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'hr01',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
		$this->add_control(
			'giveform_options',
			[
				'label' => esc_html__( 'Give Form', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'form_id', [
				'label' => esc_html__( "Form ID", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_get_post_list_array_by_post_type( 'give_forms', false )
			]
		);
		$this->add_control(
			'hr02',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
		$this->add_control(
			'heading_text_options',
			[
				'label' => esc_html__( 'Progress Goal Heading Text', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'heading_sub_title',
			[
				'label' => esc_html__( "Sub Title", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( "Sub Title.", 'mascot-core-digicod' ),
			]
		);
		$this->add_control(
			'heading_subtitle_tag',
			[
				'label' => esc_html__( "Sub Title Tag", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_heading_tag_list(),
				'default' => 'h6'
			]
		);
		$this->add_control(
			'heading_title',
			[
				'label' => __( 'Title', 'mascot-core-digicod' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Progress Title', 'mascot-core-digicod' ),
			]
		);
		$this->add_control(
			'take_heading_title_from_form_ID',
			[
				'label' => __( 'Or Take Title from Form ID', 'mascot-core-digicod' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'mascot-core-digicod' ),
				'label_off' => __( 'No', 'mascot-core-digicod' ),
				'default' => 'no',
			]
		);
		$this->add_control(
			'heading_title_tag',
			[
				'label' => esc_html__( "Title Tag", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_heading_tag_list(),
				'default' => 'h3'
			]
		);

		$this->add_control(
			'heading_description',
			[
				'label' => __( 'Description', 'mascot-core-digicod' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Write a short description, that will describe something useful.', 'mascot-core-digicod' ),
			]
		);



		$this->add_control(
			'hr03',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
		$this->add_control(
			'custom_goal_raised_options',
			[
				'label' => esc_html__( 'Custom Goal/Raised', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'custom_goal',
			[
				'label' => esc_html__( "Total Goal", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( "7000", 'mascot-core-digicod' ),
			]
		);
		$this->add_control(
			'custom_total_raised',
			[
				'label' => __( 'Custom Total Raised', 'mascot-core-digicod' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'mascot-core-digicod' ),
				'label_off' => __( 'Hide', 'mascot-core-digicod' ),
				'default' => 'yes',
			]
		);
		$this->add_control(
			'custom_raised',
			[
				'label' => esc_html__( "Total Raised", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( "1900", 'mascot-core-digicod' ),
				'condition' => [
					'custom_total_raised!' => '',
				],
			]
		);


		$this->add_control(
			'hr033',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
		$this->add_control(
			'show_donate_btn_in_progress_goal_block',
			[
				'label' => __( 'Show Donate Button - At Progress/Goal Block', 'mascot-core-digicod' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'mascot-core-digicod' ),
				'label_off' => __( 'Hide', 'mascot-core-digicod' ),
				'default' => 'no',
			]
		);



		$this->add_control(
			'hr04',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
		$this->add_control(
			'form_heading_text_options',
			[
				'label' => esc_html__( 'Form Heading Text', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'form_heading_sub_title',
			[
				'label' => esc_html__( "Sub Title", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( "Form Sub Title.", 'mascot-core-digicod' ),
			]
		);
		$this->add_control(
			'form_heading_subtitle_tag',
			[
				'label' => esc_html__( "Sub Title Tag", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_heading_tag_list(),
				'default' => 'h6'
			]
		);
		$this->add_control(
			'form_heading_title',
			[
				'label' => __( 'Title', 'mascot-core-digicod' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Form Title', 'mascot-core-digicod' ),
			]
		);
		$this->add_control(
			'take_form_heading_title_from_form_ID',
			[
				'label' => __( 'Or Take Title from Form ID', 'mascot-core-digicod' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'mascot-core-digicod' ),
				'label_off' => __( 'No', 'mascot-core-digicod' ),
				'default' => 'yes',
			]
		);
		$this->add_control(
			'form_heading_title_tag',
			[
				'label' => esc_html__( "Title Tag", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_heading_tag_list(),
				'default' => 'h3'
			]
		);

		$this->add_control(
			'form_heading_description',
			[
				'label' => __( 'Description', 'mascot-core-digicod' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Write a short description, that will describe something useful.', 'mascot-core-digicod' ),
			]
		);
		$this->end_controls_section();




















		$this->start_controls_section(
			'form_progress_goal_block_styling',
			[
				'label' => esc_html__( 'Progress Goal Block -> Wrapper Style', 'mascot-core-digicod' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'hide_form_progress_goal_block',
			[
				'label' => esc_html__( 'Hide Progress Goal Block', 'mascot-core-digicod' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Hide', 'mascot-core-digicod' ),
				'label_off' => __( 'Show', 'mascot-core-digicod' ),
				'return_value'	=> 'none',
				'default'	=> 'block',
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .form-progress-goal-block' => 'display: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'form_progress_goal_block_text_alignment',
			[
				'label' => esc_html__( "Text Alignment", 'mascot-core-digicod' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => mascot_core_text_align_choose(),
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .form-progress-goal-block' => 'text-align: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'form_progress_goal_block_vertical_align',
			[
				'label' => esc_html__( "Content Display Flex + Vertical Center?", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .form-progress-goal-block' => 'display: flex; align-items: center;',
				]
			]
		);
		$this->add_responsive_control(
			'form_progress_goal_block_width',
			[
				'label' => esc_html__( "Width", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'default' => [
					'unit' => '%',
				],
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 2000,
						'step' => 1,
					],
					'%' => [
						'min' => 2,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .form-progress-goal-block' => 'width: {{SIZE}}{{UNIT}};'
				]
			]
		);
		$this->add_responsive_control(
			'form_progress_goal_block_min_height',
			[
				'label' => esc_html__( "Minimum Height", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .form-progress-goal-block' => 'min-height: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'form_progress_goal_block_padding',
			[
				'label' => esc_html__( 'Padding', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .form-progress-goal-block' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'form_progress_goal_block_border_options',
			[
				'label' => esc_html__( 'Border Options', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'form_progress_goal_block_border',
				'label' => esc_html__( 'Border', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .tm-give-donation-form .form-progress-goal-block',
			]
		);
		$this->add_responsive_control(
			'form_progress_goal_block_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .form-progress-goal-block' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'form_progress_goal_block_boxshadow',
				'label' => esc_html__( 'Box Shadow', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .tm-give-donation-form .form-progress-goal-block',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'form_progress_goal_block_boxshadow_hover',
				'label' => esc_html__( 'Box Shadow(Hover)', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}}:hover .tm-give-donation-form .form-progress-goal-block',
			]
		);
		$this->add_control(
			'form_progress_goal_block_color_options',
			[
				'label' => esc_html__( 'BG Color Options', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'form_progress_goal_block_custom_bg_color',
			[
				'label' => esc_html__( "Custom Background Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .form-progress-goal-block' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'form_progress_goal_block_custom_bg_color_hover',
			[
				'label' => esc_html__( "Custom Background Color (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .tm-give-donation-form .form-progress-goal-block' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'form_progress_goal_block_theme_colored',
			[
				'label' => esc_html__( "Background Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .form-progress-goal-block' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_responsive_control(
			'form_progress_goal_block_theme_colored_hover',
			[
				'label' => esc_html__( "Background Theme Colored (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .tm-give-donation-form .form-progress-goal-block' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_section();








		$this->start_controls_section(
			'text_block_progress_goal_section',
			[
				'label' => esc_html__( 'Progress Goal Block -> Text Styling', 'mascot-core-digicod' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs('tabs_text_block_progress_goal_style');
		$this->start_controls_tab(
			'tab_text_block_progress_goal_title',
			[
				'label' => esc_html__('Title', 'mascot-core-digicod'),
			]
		);
		$this->add_responsive_control(
			'hide_text_block_progress_goal_title',
			[
				'label' => esc_html__( 'Hide Title', 'mascot-core-digicod' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Hide', 'mascot-core-digicod' ),
				'label_off' => __( 'Show', 'mascot-core-digicod' ),
				'return_value'	=> 'none',
				'default'	=> 'block',
				'selectors' => [
					'{{WRAPPER}} .form-progress-goal-block .form-progress-goal-header-text .title' => 'display: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'text_block_progress_goal_title_typography',
				'label' => esc_html__( 'Typography', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .form-progress-goal-block .form-progress-goal-header-text .title',
			]
		);
		$this->add_responsive_control(
			'text_block_progress_goal_title_margin',
			[
				'label' => esc_html__( 'Margin', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .form-progress-goal-block .form-progress-goal-header-text .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'text_block_progress_goal_title_padding',
			[
				'label' => esc_html__( 'Padding', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .form-progress-goal-block .form-progress-goal-header-text .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'text_block_progress_goal_title_color_options',
			[
				'label' => esc_html__( 'Color Options', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'text_block_progress_goal_title_text_color',
			[
				'label' => esc_html__( "Text Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .form-progress-goal-block .form-progress-goal-header-text .title' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'text_block_progress_goal_title_text_color_hover',
			[
				'label' => esc_html__( "Text Color (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .form-progress-goal-block .form-progress-goal-header-text .title' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'text_block_progress_goal_title_theme_colored',
			[
				'label' => esc_html__( "Text Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .form-progress-goal-block .form-progress-goal-header-text .title' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_control(
			'text_block_progress_goal_title_theme_colored_hover',
			[
				'label' => esc_html__( "Text Theme Colored (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .form-progress-goal-block .form-progress-goal-header-text .title' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_text_block_progress_goal_subtitle',
			[
				'label' => esc_html__('Sub Title', 'mascot-core-digicod'),
			]
		);
		$this->add_responsive_control(
			'hide_text_block_progress_goal_subtitle',
			[
				'label' => esc_html__( 'Hide Sub Title', 'mascot-core-digicod' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Hide', 'mascot-core-digicod' ),
				'label_off' => __( 'Show', 'mascot-core-digicod' ),
				'return_value'	=> 'none',
				'default'	=> 'block',
				'selectors' => [
					'{{WRAPPER}} .form-progress-goal-block .form-progress-goal-header-text .subtitle' => 'display: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'text_block_progress_goal_subtitle_typography',
				'label' => esc_html__( 'Typography', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .form-progress-goal-block .form-progress-goal-header-text .subtitle',
			]
		);
		$this->add_responsive_control(
			'text_block_progress_goal_subtitle_margin',
			[
				'label' => esc_html__( 'Margin', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .form-progress-goal-block .form-progress-goal-header-text .subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'text_block_progress_goal_subtitle_padding',
			[
				'label' => esc_html__( 'Padding', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .form-progress-goal-block .form-progress-goal-header-text .subtitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'text_block_progress_goal_subtitle_color_options',
			[
				'label' => esc_html__( 'Color Options', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'text_block_progress_goal_subtitle_text_color',
			[
				'label' => esc_html__( "Text Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .form-progress-goal-block .form-progress-goal-header-text .subtitle' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'text_block_progress_goal_subtitle_text_color_hover',
			[
				'label' => esc_html__( "Text Color (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .form-progress-goal-block .form-progress-goal-header-text .subtitle' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'text_block_progress_goal_subtitle_theme_colored',
			[
				'label' => esc_html__( "Text Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .form-progress-goal-block .form-progress-goal-header-text .subtitle' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_control(
			'text_block_progress_goal_subtitle_theme_colored_hover',
			[
				'label' => esc_html__( "Text Theme Colored (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .form-progress-goal-block .form-progress-goal-header-text .subtitle' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_text_block_progress_goal_description',
			[
				'label' => esc_html__('Description', 'mascot-core-digicod'),
			]
		);
		$this->add_responsive_control(
			'hide_text_block_progress_goal_description',
			[
				'label' => esc_html__( 'Hide Description', 'mascot-core-digicod' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Hide', 'mascot-core-digicod' ),
				'label_off' => __( 'Show', 'mascot-core-digicod' ),
				'return_value'	=> 'none',
				'default'	=> 'block',
				'selectors' => [
					'{{WRAPPER}} .form-progress-goal-block .form-progress-goal-header-text .description' => 'display: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'text_block_progress_goal_description_typography',
				'label' => esc_html__( 'Typography', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .form-progress-goal-block .form-progress-goal-header-text .description',
			]
		);
		$this->add_responsive_control(
			'text_block_progress_goal_description_margin',
			[
				'label' => esc_html__( 'Margin', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .form-progress-goal-block .form-progress-goal-header-text .description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'text_block_progress_goal_description_padding',
			[
				'label' => esc_html__( 'Padding', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .form-progress-goal-block .form-progress-goal-header-text .description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'text_block_progress_goal_description_color_options',
			[
				'label' => esc_html__( 'Color Options', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'text_block_progress_goal_description_text_color',
			[
				'label' => esc_html__( "Text Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .form-progress-goal-block .form-progress-goal-header-text .description' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'text_block_progress_goal_description_text_color_hover',
			[
				'label' => esc_html__( "Text Color (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .form-progress-goal-block .form-progress-goal-header-text .description' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'text_block_progress_goal_description_theme_colored',
			[
				'label' => esc_html__( "Text Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .form-progress-goal-block .form-progress-goal-header-text .description' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_control(
			'text_block_progress_goal_description_theme_colored_hover',
			[
				'label' => esc_html__( "Text Theme Colored (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .form-progress-goal-block .form-progress-goal-header-text .description' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();






		$this->start_controls_section(
			'goal_raised_text_styling',
			[
				'label' => esc_html__( 'Progress Goal Block -> Goal & Raised Value', 'mascot-core-digicod' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'hide_goal_raised_goal',
			[
				'label' => esc_html__( 'Hide Goal', 'mascot-core-digicod' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Hide', 'mascot-core-digicod' ),
				'label_off' => __( 'Show', 'mascot-core-digicod' ),
				'return_value'	=> 'none',
				'default'	=> 'block',
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .give-goal-raised .goal-raised-inner .goal' => 'display: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'hide_goal_raised_raised',
			[
				'label' => esc_html__( 'Hide Raised', 'mascot-core-digicod' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Hide', 'mascot-core-digicod' ),
				'label_off' => __( 'Show', 'mascot-core-digicod' ),
				'return_value'	=> 'none',
				'default'	=> 'block',
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .give-goal-raised .goal-raised-inner .raised' => 'display: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'goal_raised_vertical_flex_options',
			[
				'label' => esc_html__( 'Flex Options', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'goal_raised_flex_vertical',
			[
				'label' => esc_html__( "Flex Vertical Alignment", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_disply_flex_vertical_align_elementor(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .give-goal-raised .goal-raised-inner .goal' => 'display:flex; align-items: {{VALUE}};',
					'{{WRAPPER}} .tm-give-donation-form .give-goal-raised .goal-raised-inner .raised' => 'display:flex; align-items: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'goal_raised_flex_horizontal',
			[
				'label' => esc_html__( "Flex Horizontal Alignment", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_disply_flex_horizontal_align_elementor(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .give-goal-raised .goal-raised-inner .goal' => 'display:flex; justify-content: {{VALUE}};',
					'{{WRAPPER}} .tm-give-donation-form .give-goal-raised .goal-raised-inner .raised' => 'display:flex; justify-content: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'goal_raised_flex_direction',
			[
				'label' => esc_html__( "Flex Direction", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_disply_flex_direction_elementor(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .give-goal-raised .goal-raised-inner .goal' => 'display:flex; flex-direction: {{VALUE}};',
					'{{WRAPPER}} .tm-give-donation-form .give-goal-raised .goal-raised-inner .raised' => 'display:flex; flex-direction: {{VALUE}};',
				],
			]
		);


		$this->start_controls_tabs('tabs_goal_raised_goal_tab_style');
		$this->start_controls_tab(
			'tab_goal_raised_goal_label',
			[
				'label' => esc_html__('Goal Label', 'mascot-core-digicod'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'goal_raised_goal_label_typography',
				'label' => esc_html__( 'Typography', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .tm-give-donation-form .give-goal-raised .goal-raised-inner .goal .label',
			]
		);
		$this->add_responsive_control(
			'goal_raised_goal_label_margin',
			[
				'label' => esc_html__( 'Margin', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .give-goal-raised .goal-raised-inner .goal .label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'goal_raised_goal_label_color_options',
			[
				'label' => esc_html__( 'Color Options', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'goal_raised_goal_label_color',
			[
				'label' => esc_html__( "Text Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .give-goal-raised .goal-raised-inner .goal .label' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'goal_raised_goal_label_color_hover',
			[
				'label' => esc_html__( "Text Color (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .tm-give-donation-form .give-goal-raised .goal-raised-inner .goal .label' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'goal_raised_goal_label_theme_colored',
			[
				'label' => esc_html__( "Text Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .give-goal-raised .goal-raised-inner .goal .label' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_control(
			'goal_raised_goal_label_theme_colored_hover',
			[
				'label' => esc_html__( "Text Theme Colored (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .tm-give-donation-form .give-goal-raised .goal-raised-inner .goal .label' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_goal_raised_goal_value',
			[
				'label' => esc_html__('Goal Value', 'mascot-core-digicod'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'goal_raised_goal_value_typography',
				'label' => esc_html__( 'Typography', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .tm-give-donation-form .give-goal-raised .goal-raised-inner .goal .value',
			]
		);
		$this->add_responsive_control(
			'goal_raised_goal_value_margin',
			[
				'label' => esc_html__( 'Margin', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .give-goal-raised .goal-raised-inner .goal .value' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'goal_raised_goal_value_color_options',
			[
				'label' => esc_html__( 'Color Options', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'goal_raised_goal_value_color',
			[
				'label' => esc_html__( "Text Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .give-goal-raised .goal-raised-inner .goal .value' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'goal_raised_goal_value_color_hover',
			[
				'label' => esc_html__( "Text Color (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .tm-give-donation-form .give-goal-raised .goal-raised-inner .goal .value' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'goal_raised_goal_value_theme_colored',
			[
				'label' => esc_html__( "Text Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .give-goal-raised .goal-raised-inner .goal .value' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_control(
			'goal_raised_goal_value_theme_colored_hover',
			[
				'label' => esc_html__( "Text Theme Colored (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .tm-give-donation-form .give-goal-raised .goal-raised-inner .goal .value' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();



		$this->start_controls_tabs('tabs_goal_raised_raised_tab_style');
		$this->start_controls_tab(
			'tab_goal_raised_raised_label',
			[
				'label' => esc_html__('Raised Label', 'mascot-core-digicod'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'goal_raised_raised_label_typography',
				'label' => esc_html__( 'Typography', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .tm-give-donation-form .give-goal-raised .goal-raised-inner .raised .label',
			]
		);
		$this->add_responsive_control(
			'goal_raised_raised_label_margin',
			[
				'label' => esc_html__( 'Margin', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .give-goal-raised .goal-raised-inner .raised .label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'goal_raised_raised_label_color_options',
			[
				'label' => esc_html__( 'Color Options', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'goal_raised_raised_label_color',
			[
				'label' => esc_html__( "Text Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .give-goal-raised .goal-raised-inner .raised .label' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'goal_raised_raised_label_color_hover',
			[
				'label' => esc_html__( "Text Color (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .tm-give-donation-form .give-goal-raised .goal-raised-inner .raised .label' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'goal_raised_raised_label_theme_colored',
			[
				'label' => esc_html__( "Text Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .give-goal-raised .goal-raised-inner .raised .label' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_control(
			'goal_raised_raised_label_theme_colored_hover',
			[
				'label' => esc_html__( "Text Theme Colored (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .tm-give-donation-form .give-goal-raised .goal-raised-inner .raised .label' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_goal_raised_raised_value',
			[
				'label' => esc_html__('Raised Value', 'mascot-core-digicod'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'goal_raised_raised_value_typography',
				'label' => esc_html__( 'Typography', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .tm-give-donation-form .give-goal-raised .goal-raised-inner .raised .value',
			]
		);
		$this->add_responsive_control(
			'goal_raised_raised_value_margin',
			[
				'label' => esc_html__( 'Margin', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .give-goal-raised .goal-raised-inner .raised .value' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'goal_raised_raised_value_color_options',
			[
				'label' => esc_html__( 'Color Options', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'goal_raised_raised_value_color',
			[
				'label' => esc_html__( "Text Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .give-goal-raised .goal-raised-inner .raised .value' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'goal_raised_raised_value_color_hover',
			[
				'label' => esc_html__( "Text Color (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .tm-give-donation-form .give-goal-raised .goal-raised-inner .raised .value' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'goal_raised_raised_value_theme_colored',
			[
				'label' => esc_html__( "Text Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .give-goal-raised .goal-raised-inner .raised .value' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_control(
			'goal_raised_raised_value_theme_colored_hover',
			[
				'label' => esc_html__( "Text Theme Colored (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .tm-give-donation-form .give-goal-raised .goal-raised-inner .raised .value' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();




		$this->start_controls_section(
			'progress_goal_donate_btn_color_typo_options', [
				'label' => esc_html__( 'Progress Goal Block -> Donate Button', 'mascot-core-digicod' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'progress_goal_donate_btn_width',
			[
				'label' => esc_html__( "Button Width", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'default' => [
					'unit' => '%',
				],
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 2000,
						'step' => 1,
					],
					'%' => [
						'min' => 2,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .form-progress-goal-block [id*=give-form] .give-btn-modal' => 'width: {{SIZE}}{{UNIT}};'
				]
			]
		);
		$this->add_control(
			'progress_goal_donate_btn_bg_custom_color_options',
			[
				'label' => esc_html__( 'Background Options', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'progress_goal_donate_btn_bg_custom_color', [
				'label' => esc_html__( "Background Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .form-progress-goal-block [id*=give-form] .give-btn-modal' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'progress_goal_donate_btn_bg_color_hover', [
				'label' => esc_html__( "Background Color (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .form-progress-goal-block [id*=give-form] .give-btn-modal:hover,{{WRAPPER}} .tm-give-donation-form .form-progress-goal-block [id*=give-form] .give-btn-modal:focus' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'progress_goal_donate_btn_bg_theme_colored', [
				'label' => esc_html__( "Background Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .form-progress-goal-block [id*=give-form] .give-btn-modal' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_responsive_control(
			'progress_goal_donate_btn_bg_theme_colored_hover', [
				'label' => esc_html__( "Background Theme Colored (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .form-progress-goal-block [id*=give-form] .give-btn-modal:hover, {{WRAPPER}} .tm-give-donation-form .form-progress-goal-block [id*=give-form] .give-btn-modal:hover' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'progress_goal_donate_btn_text_color_options',
			[
				'label' => esc_html__( 'Text Options', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'progress_goal_donate_btn_text_color', [
				'label' => esc_html__( "Button Text Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .form-progress-goal-block [id*=give-form] .give-btn-modal' => 'color: {{VALUE}} !important;'
				]
			]
		);
		$this->add_responsive_control(
			'progress_goal_donate_btn_text_color_hover', [
				'label' => esc_html__( "Button Text Color (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .form-progress-goal-block [id*=give-form] .give-btn-modal:hover' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .tm-give-donation-form .form-progress-goal-block [id*=give-form] .give-btn-modal:focus' => 'color: {{VALUE}} !important;',
				]
			]
		);
		$this->add_responsive_control(
			'progress_goal_donate_btn_text_theme_colored', [
				'label' => esc_html__( "Button Text Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .form-progress-goal-block [id*=give-form] .give-btn-modal' => 'color: var(--theme-color{{VALUE}}) !important;'
				],
			]
		);
		$this->add_responsive_control(
			'progress_goal_donate_btn_text_theme_colored_hover', [
				'label' => esc_html__( "Button Text Theme Colored (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .form-progress-goal-block [id*=give-form] .give-btn-modal:hover' => 'color: var(--theme-color{{VALUE}}) !important;',
					'{{WRAPPER}} .tm-give-donation-form .form-progress-goal-block [id*=give-form] .give-btn-modal:focus' => 'color: var(--theme-color{{VALUE}}) !important;'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(), [
				'name' => 'progress_goal_donate_btn_text_typography',
				'label' => esc_html__( 'Button Text Typography', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .tm-give-donation-form .form-progress-goal-block [id*=give-form] .give-btn-modal',
			]
		);
		$this->add_control(
			'progress_goal_donate_btn_border_options',
			[
				'label' => esc_html__( 'Border Options', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'progress_goal_donate_btn_border',
				'label' => esc_html__( 'Border', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .tm-give-donation-form .form-progress-goal-block [id*=give-form] .give-btn-modal',
			]
		);
		$this->add_responsive_control(
			'progress_goal_donate_btn_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .form-progress-goal-block [id*=give-form] .give-btn-modal' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_responsive_control(
			'progress_goal_donate_btn_border_custom_color', [
				'label' => esc_html__( "Border Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .form-progress-goal-block [id*=give-form] .give-btn-modal' => 'border-color: {{VALUE}} !important;'
				]
			]
		);
		$this->add_responsive_control(
			'progress_goal_donate_btn_border_custom_color_hover', [
				'label' => esc_html__( "Border Color (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .form-progress-goal-block [id*=give-form] .give-btn-modal:hover' => 'border-color: {{VALUE}} !important;',
					'{{WRAPPER}} .tm-give-donation-form .form-progress-goal-block [id*=give-form] .give-btn-modal:focus' => 'border-color: {{VALUE}} !important;',
				]
			]
		);
		$this->add_responsive_control(
			'progress_goal_donate_btn_border_theme_colored', [
				'label' => esc_html__( "Border Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .form-progress-goal-block [id*=give-form] .give-btn-modal' => 'border-color: var(--theme-color{{VALUE}}) !important;'
				],
			]
		);
		$this->add_responsive_control(
			'progress_goal_donate_btn_border_theme_colored_hover', [
				'label' => esc_html__( "Border Theme Colored (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .form-progress-goal-block [id*=give-form] .give-btn-modal:hover' => 'border-color: var(--theme-color{{VALUE}}) !important;',
					'{{WRAPPER}} .tm-give-donation-form .form-progress-goal-block [id*=give-form] .give-btn-modal:focus' => 'border-color: var(--theme-color{{VALUE}}) !important;'
				],
			]
		);
		$this->add_control(
			'progress_goal_donate_btn_boxshadow_options',
			[
				'label' => esc_html__( 'Box Shadow Options', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'progress_goal_donate_btn_boxshadow',
				'label' => esc_html__( 'Box Shadow', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .tm-give-donation-form .form-progress-goal-block [id*=give-form] .give-btn-modal',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'progress_goal_donate_btn_boxshadow_hover',
				'label' => esc_html__( 'Box Shadow(Hover)', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .tm-give-donation-form .form-progress-goal-block [id*=give-form] .give-btn-modal:hover',
			]
		);
		$this->add_control(
			'progress_goal_donate_btn_padding_options',
			[
				'label' => esc_html__( 'Padding Options', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'progress_goal_donate_btn_padding',
			[
				'label' => esc_html__( 'Button Padding', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .form-progress-goal-block [id*=give-form] .give-btn-modal' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'progress_goal_donate_btn_margin',
			[
				'label' => esc_html__( 'Button Margin', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .form-progress-goal-block [id*=give-form] .give-btn-modal' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();








		$this->start_controls_section(
			'progress_bar_styling',
			[
				'label' => esc_html__( 'Progress Goal Block -> Progress Bar', 'mascot-core-digicod' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'hide_progress_bar',
			[
				'label' => esc_html__( 'Hide Progress Bar', 'mascot-core-digicod' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Hide', 'mascot-core-digicod' ),
				'label_off' => __( 'Show', 'mascot-core-digicod' ),
				'return_value'	=> 'none',
				'default'	=> 'block',
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .give-goal-progress-bar' => 'display: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'progress_bar_height',
			[
				'label' => esc_html__( "Progress Bar Height", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 2,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .give-goal-progress-bar .tm-sc-progress-bar .progress-holder' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .tm-give-donation-form .give-goal-progress-bar .tm-sc-progress-bar .progress-holder .progress-content' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'hr2-progress',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
		$this->add_control(
			'progress_color',
			[
				'label' => esc_html__( "Progress Custom Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .give-goal-progress-bar .tm-sc-progress-bar .progress-holder .progress-content' => 'background-color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'progress_theme_colored',
			[
				'label' => esc_html__( "Progress Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .give-goal-progress-bar .tm-sc-progress-bar .progress-holder .progress-content' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'hr2-progress-bar',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
		$this->add_control(
			'progress_bar_background_color',
			[
				'label' => esc_html__( "Progress Bar Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .give-goal-progress-bar .tm-sc-progress-bar .progress-holder' => 'background-color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'progress_bar_theme_colored',
			[
				'label' => esc_html__( "Progress Bar Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .give-goal-progress-bar .tm-sc-progress-bar .progress-holder' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_responsive_control(
			'progress_bar_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .give-goal-progress-bar .tm-sc-progress-bar .progress-holder' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->end_controls_section();




		$this->start_controls_section(
			'form_block_styling',
			[
				'label' => esc_html__( 'Form Block => Wrapper Style', 'mascot-core-digicod' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'hide_form_block',
			[
				'label' => esc_html__( 'Hide Form Block', 'mascot-core-digicod' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Hide', 'mascot-core-digicod' ),
				'label_off' => __( 'Show', 'mascot-core-digicod' ),
				'return_value'	=> 'none',
				'default'	=> 'block',
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .form-block' => 'display: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'form_block_text_alignment',
			[
				'label' => esc_html__( "Text Alignment", 'mascot-core-digicod' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => mascot_core_text_align_choose(),
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .form-block' => 'text-align: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'form_block_vertical_align',
			[
				'label' => esc_html__( "Content Display Flex + Vertical Center?", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .form-block' => 'display: flex; align-items: center;',
				]
			]
		);
		$this->add_responsive_control(
			'form_block_width',
			[
				'label' => esc_html__( "Width", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'default' => [
					'unit' => '%',
				],
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 2000,
						'step' => 1,
					],
					'%' => [
						'min' => 2,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .form-block' => 'width: {{SIZE}}{{UNIT}};'
				]
			]
		);
		$this->add_responsive_control(
			'form_block_min_height',
			[
				'label' => esc_html__( "Minimum Height", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .form-block' => 'min-height: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'form_block_padding',
			[
				'label' => esc_html__( 'Padding', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .form-block' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'form_block_border_options',
			[
				'label' => esc_html__( 'Border Options', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'form_block_border',
				'label' => esc_html__( 'Border', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .tm-give-donation-form .form-block',
			]
		);
		$this->add_responsive_control(
			'form_block_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .form-block' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'form_block_boxshadow',
				'label' => esc_html__( 'Box Shadow', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .tm-give-donation-form .form-block',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'form_block_boxshadow_hover',
				'label' => esc_html__( 'Box Shadow(Hover)', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}}:hover .tm-give-donation-form .form-block',
			]
		);
		$this->add_control(
			'form_block_color_options',
			[
				'label' => esc_html__( 'BG Color Options', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'form_block_custom_bg_color',
			[
				'label' => esc_html__( "Custom Background Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .form-block' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'form_block_custom_bg_color_hover',
			[
				'label' => esc_html__( "Custom Background Color (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .tm-give-donation-form .form-block' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'form_block_theme_colored',
			[
				'label' => esc_html__( "Background Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .form-block' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_responsive_control(
			'form_block_theme_colored_hover',
			[
				'label' => esc_html__( "Background Theme Colored (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .tm-give-donation-form .form-block' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_section();






		$this->start_controls_section(
			'text_block_form_block_section',
			[
				'label' => esc_html__( 'Form Block => Text Styling', 'mascot-core-digicod' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs('tabs_text_block_form_block_style');
		$this->start_controls_tab(
			'tab_text_block_form_block_title',
			[
				'label' => esc_html__('Title', 'mascot-core-digicod'),
			]
		);
		$this->add_responsive_control(
			'hide_text_block_form_block_title',
			[
				'label' => esc_html__( 'Hide Title', 'mascot-core-digicod' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Hide', 'mascot-core-digicod' ),
				'label_off' => __( 'Show', 'mascot-core-digicod' ),
				'return_value'	=> 'none',
				'default'	=> 'block',
				'selectors' => [
					'{{WRAPPER}} .form-block .form-header-text .title' => 'display: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'text_block_form_block_title_typography',
				'label' => esc_html__( 'Typography', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .form-block .form-header-text .title',
			]
		);
		$this->add_responsive_control(
			'text_block_form_block_title_margin',
			[
				'label' => esc_html__( 'Margin', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .form-block .form-header-text .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'text_block_form_block_title_padding',
			[
				'label' => esc_html__( 'Padding', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .form-block .form-header-text .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'text_block_form_block_title_color_options',
			[
				'label' => esc_html__( 'Color Options', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'text_block_form_block_title_text_color',
			[
				'label' => esc_html__( "Text Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .form-block .form-header-text .title' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'text_block_form_block_title_text_color_hover',
			[
				'label' => esc_html__( "Text Color (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .form-block .form-header-text .title' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'text_block_form_block_title_theme_colored',
			[
				'label' => esc_html__( "Text Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .form-block .form-header-text .title' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_control(
			'text_block_form_block_title_theme_colored_hover',
			[
				'label' => esc_html__( "Text Theme Colored (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .form-block .form-header-text .title' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_text_block_form_block_subtitle',
			[
				'label' => esc_html__('Sub Title', 'mascot-core-digicod'),
			]
		);
		$this->add_responsive_control(
			'hide_text_block_form_block_subtitle',
			[
				'label' => esc_html__( 'Hide Sub Title', 'mascot-core-digicod' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Hide', 'mascot-core-digicod' ),
				'label_off' => __( 'Show', 'mascot-core-digicod' ),
				'return_value'	=> 'none',
				'default'	=> 'block',
				'selectors' => [
					'{{WRAPPER}} .form-block .form-header-text .subtitle' => 'display: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'text_block_form_block_subtitle_typography',
				'label' => esc_html__( 'Typography', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .form-block .form-header-text .subtitle',
			]
		);
		$this->add_responsive_control(
			'text_block_form_block_subtitle_margin',
			[
				'label' => esc_html__( 'Margin', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .form-block .form-header-text .subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'text_block_form_block_subtitle_padding',
			[
				'label' => esc_html__( 'Padding', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .form-block .form-header-text .subtitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'text_block_form_block_subtitle_color_options',
			[
				'label' => esc_html__( 'Color Options', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'text_block_form_block_subtitle_text_color',
			[
				'label' => esc_html__( "Text Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .form-block .form-header-text .subtitle' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'text_block_form_block_subtitle_text_color_hover',
			[
				'label' => esc_html__( "Text Color (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .form-block .form-header-text .subtitle' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'text_block_form_block_subtitle_theme_colored',
			[
				'label' => esc_html__( "Text Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .form-block .form-header-text .subtitle' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_control(
			'text_block_form_block_subtitle_theme_colored_hover',
			[
				'label' => esc_html__( "Text Theme Colored (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .form-block .form-header-text .subtitle' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_text_block_form_block_description',
			[
				'label' => esc_html__('Description', 'mascot-core-digicod'),
			]
		);
		$this->add_responsive_control(
			'hide_text_block_form_block_description',
			[
				'label' => esc_html__( 'Hide Description', 'mascot-core-digicod' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Hide', 'mascot-core-digicod' ),
				'label_off' => __( 'Show', 'mascot-core-digicod' ),
				'return_value'	=> 'none',
				'default'	=> 'block',
				'selectors' => [
					'{{WRAPPER}} .form-block .form-header-text .description' => 'display: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'text_block_form_block_description_typography',
				'label' => esc_html__( 'Typography', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .form-block .form-header-text .description',
			]
		);
		$this->add_responsive_control(
			'text_block_form_block_description_margin',
			[
				'label' => esc_html__( 'Margin', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .form-block .form-header-text .description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'text_block_form_block_description_padding',
			[
				'label' => esc_html__( 'Padding', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .form-block .form-header-text .description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'text_block_form_block_description_color_options',
			[
				'label' => esc_html__( 'Color Options', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'text_block_form_block_description_text_color',
			[
				'label' => esc_html__( "Text Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .form-block .form-header-text .description' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'text_block_form_block_description_text_color_hover',
			[
				'label' => esc_html__( "Text Color (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .form-block .form-header-text .description' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'text_block_form_block_description_theme_colored',
			[
				'label' => esc_html__( "Text Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .form-block .form-header-text .description' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_control(
			'text_block_form_block_description_theme_colored_hover',
			[
				'label' => esc_html__( "Text Theme Colored (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .form-block .form-header-text .description' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();




		$this->start_controls_section(
			'form_block_donate_btn_color_typo_options', [
				'label' => esc_html__( 'Form Block => Donate Button', 'mascot-core-digicod' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'form_block_donate_btn_width',
			[
				'label' => esc_html__( "Button Width", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'default' => [
					'unit' => '%',
				],
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 2000,
						'step' => 1,
					],
					'%' => [
						'min' => 2,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .form-block [id*=give-form] .give-btn-modal' => 'width: {{SIZE}}{{UNIT}};'
				]
			]
		);
		$this->add_control(
			'form_block_donate_btn_bg_custom_color_options',
			[
				'label' => esc_html__( 'Background Options', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'form_block_donate_btn_bg_custom_color', [
				'label' => esc_html__( "Background Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .form-block [id*=give-form] .give-btn-modal' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'form_block_donate_btn_bg_color_hover', [
				'label' => esc_html__( "Background Color (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .form-block [id*=give-form] .give-btn-modal:hover,{{WRAPPER}} .tm-give-donation-form .form-block [id*=give-form] .give-btn-modal:focus' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'form_block_donate_btn_bg_theme_colored', [
				'label' => esc_html__( "Background Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .form-block [id*=give-form] .give-btn-modal' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_responsive_control(
			'form_block_donate_btn_bg_theme_colored_hover', [
				'label' => esc_html__( "Background Theme Colored (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .form-block [id*=give-form] .give-btn-modal:hover, {{WRAPPER}} .tm-give-donation-form .form-block [id*=give-form] .give-btn-modal:hover' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'form_block_donate_btn_text_color_options',
			[
				'label' => esc_html__( 'Text Options', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'form_block_donate_btn_text_color', [
				'label' => esc_html__( "Button Text Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .form-block [id*=give-form] .give-btn-modal' => 'color: {{VALUE}} !important;'
				]
			]
		);
		$this->add_responsive_control(
			'form_block_donate_btn_text_color_hover', [
				'label' => esc_html__( "Button Text Color (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .form-block [id*=give-form] .give-btn-modal:hover' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .tm-give-donation-form .form-block [id*=give-form] .give-btn-modal:focus' => 'color: {{VALUE}} !important;',
				]
			]
		);
		$this->add_responsive_control(
			'form_block_donate_btn_text_theme_colored', [
				'label' => esc_html__( "Button Text Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .form-block [id*=give-form] .give-btn-modal' => 'color: var(--theme-color{{VALUE}}) !important;'
				],
			]
		);
		$this->add_responsive_control(
			'form_block_donate_btn_text_theme_colored_hover', [
				'label' => esc_html__( "Button Text Theme Colored (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .form-block [id*=give-form] .give-btn-modal:hover' => 'color: var(--theme-color{{VALUE}}) !important;',
					'{{WRAPPER}} .tm-give-donation-form .form-block [id*=give-form] .give-btn-modal:focus' => 'color: var(--theme-color{{VALUE}}) !important;'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(), [
				'name' => 'form_block_donate_btn_text_typography',
				'label' => esc_html__( 'Button Text Typography', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .tm-give-donation-form .form-block [id*=give-form] .give-btn-modal',
			]
		);
		$this->add_control(
			'form_block_donate_btn_border_options',
			[
				'label' => esc_html__( 'Border Options', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'form_block_donate_btn_border',
				'label' => esc_html__( 'Border', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .tm-give-donation-form .form-block [id*=give-form] .give-btn-modal',
			]
		);
		$this->add_responsive_control(
			'form_block_donate_btn_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .form-block [id*=give-form] .give-btn-modal' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_responsive_control(
			'form_block_donate_btn_border_custom_color', [
				'label' => esc_html__( "Border Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .form-block [id*=give-form] .give-btn-modal' => 'border-color: {{VALUE}} !important;'
				]
			]
		);
		$this->add_responsive_control(
			'form_block_donate_btn_border_custom_color_hover', [
				'label' => esc_html__( "Border Color (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .form-block [id*=give-form] .give-btn-modal:hover' => 'border-color: {{VALUE}} !important;',
					'{{WRAPPER}} .tm-give-donation-form .form-block [id*=give-form] .give-btn-modal:focus' => 'border-color: {{VALUE}} !important;',
				]
			]
		);
		$this->add_responsive_control(
			'form_block_donate_btn_border_theme_colored', [
				'label' => esc_html__( "Border Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .form-block [id*=give-form] .give-btn-modal' => 'border-color: var(--theme-color{{VALUE}}) !important;'
				],
			]
		);
		$this->add_responsive_control(
			'form_block_donate_btn_border_theme_colored_hover', [
				'label' => esc_html__( "Border Theme Colored (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .form-block [id*=give-form] .give-btn-modal:hover' => 'border-color: var(--theme-color{{VALUE}}) !important;',
					'{{WRAPPER}} .tm-give-donation-form .form-block [id*=give-form] .give-btn-modal:focus' => 'border-color: var(--theme-color{{VALUE}}) !important;'
				],
			]
		);
		$this->add_control(
			'form_block_donate_btn_boxshadow_options',
			[
				'label' => esc_html__( 'Box Shadow Options', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'form_block_donate_btn_boxshadow',
				'label' => esc_html__( 'Box Shadow', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .tm-give-donation-form .form-block [id*=give-form] .give-btn-modal',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'form_block_donate_btn_boxshadow_hover',
				'label' => esc_html__( 'Box Shadow(Hover)', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .tm-give-donation-form .form-block [id*=give-form] .give-btn-modal:hover',
			]
		);
		$this->add_control(
			'form_block_donate_btn_padding_options',
			[
				'label' => esc_html__( 'Padding Options', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'form_block_donate_btn_padding',
			[
				'label' => esc_html__( 'Button Padding', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .form-block [id*=give-form] .give-btn-modal' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'form_block_donate_btn_margin',
			[
				'label' => esc_html__( 'Button Margin', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .form-block [id*=give-form] .give-btn-modal' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();









		$this->start_controls_section(
			'form_block_btn_level_fields_color_typo_options', [
				'label' => esc_html__( 'Form Block => Amount Level Fields', 'mascot-core-digicod' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'form_block_btn_level_fields_bg_custom_color', [
				'label' => esc_html__( "Background Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form form[id*=give-form] #give-donation-level-button-wrap .give-btn' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .tm-give-donation-form form[id*=give-form] #give-donation-level-button-wrap .give-btn.give-btn-level-custom' => 'background-color: {{VALUE}};',
				]
			]
		);
		$this->add_responsive_control(
			'form_block_btn_level_fields_bg_color_hover', [
				'label' => esc_html__( "Background Color (Active)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form form[id*=give-form] #give-donation-level-button-wrap .give-btn.give-default-level' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .tm-give-donation-form form[id*=give-form] #give-donation-level-button-wrap .give-btn.give-btn-level-custom.give-default-level' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'form_block_btn_level_fields_bg_theme_colored', [
				'label' => esc_html__( "Background Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form form[id*=give-form] #give-donation-level-button-wrap .give-btn' => 'background-color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .tm-give-donation-form form[id*=give-form] #give-donation-level-button-wrap .give-btn.give-btn-level-custom' => 'background-color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_responsive_control(
			'form_block_btn_level_fields_bg_theme_colored_hover', [
				'label' => esc_html__( "Background Theme Colored (Active)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form form[id*=give-form] #give-donation-level-button-wrap .give-btn.give-default-level' => 'background-color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .tm-give-donation-form form[id*=give-form] #give-donation-level-button-wrap .give-btn.give-btn-level-custom.give-default-level' => 'background-color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_control(
			'form_block_btn_level_fields_text_color_options',
			[
				'label' => esc_html__( 'Text Options', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'form_block_btn_level_fields_text_color', [
				'label' => esc_html__( "Button Text Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form form[id*=give-form] #give-donation-level-button-wrap .give-btn' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .tm-give-donation-form form[id*=give-form] #give-donation-level-button-wrap .give-btn.give-btn-level-custom' => 'color: {{VALUE}} !important;',
				]
			]
		);
		$this->add_responsive_control(
			'form_block_btn_level_fields_text_color_hover', [
				'label' => esc_html__( "Button Text Color (Active)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form form[id*=give-form] #give-donation-level-button-wrap .give-btn.give-default-level' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .tm-give-donation-form form[id*=give-form] #give-donation-level-button-wrap .give-btn.give-btn-level-custom.give-default-level' => 'color: {{VALUE}} !important;',
				]
			]
		);
		$this->add_responsive_control(
			'form_block_btn_level_fields_text_theme_colored', [
				'label' => esc_html__( "Button Text Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form form[id*=give-form] #give-donation-level-button-wrap .give-btn' => 'color: var(--theme-color{{VALUE}}) !important;',
					'{{WRAPPER}} .tm-give-donation-form form[id*=give-form] #give-donation-level-button-wrap .give-btn.give-btn-level-custom' => 'color: var(--theme-color{{VALUE}}) !important;',
				],
			]
		);
		$this->add_responsive_control(
			'form_block_btn_level_fields_text_theme_colored_hover', [
				'label' => esc_html__( "Button Text Theme Colored (Active)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form form[id*=give-form] #give-donation-level-button-wrap .give-btn.give-default-level' => 'color: var(--theme-color{{VALUE}}) !important;',
					'{{WRAPPER}} .tm-give-donation-form form[id*=give-form] #give-donation-level-button-wrap .give-btn.give-btn-level-custom.give-default-level' => 'color: var(--theme-color{{VALUE}}) !important;',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(), [
				'name' => 'form_block_btn_level_fields_text_typography',
				'label' => esc_html__( 'Text Typography', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .tm-give-donation-form form[id*=give-form] #give-donation-level-button-wrap .give-btn,{{WRAPPER}} .tm-give-donation-form form[id*=give-form] #give-donation-level-button-wrap .give-btn.give-btn-level-custom',
			]
		);
		$this->add_control(
			'form_block_btn_level_fields_border_options',
			[
				'label' => esc_html__( 'Border Options', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'form_block_btn_level_fields_border',
				'label' => esc_html__( 'Border', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .tm-give-donation-form form[id*=give-form] #give-donation-level-button-wrap .give-btn,{{WRAPPER}} .tm-give-donation-form form[id*=give-form] #give-donation-level-button-wrap .give-btn.give-btn-level-custom',
			]
		);
		$this->add_responsive_control(
			'form_block_btn_level_fields_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form form[id*=give-form] #give-donation-level-button-wrap .give-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .tm-give-donation-form form[id*=give-form] #give-donation-level-button-wrap .give-btn.give-btn-level-custom' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'form_block_btn_level_fields_border_custom_color', [
				'label' => esc_html__( "Border Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form form[id*=give-form] #give-donation-level-button-wrap .give-btn' => 'border-color: {{VALUE}} !important;',
					'{{WRAPPER}} .tm-give-donation-form form[id*=give-form] #give-donation-level-button-wrap .give-btn.give-btn-level-custom' => 'border-color: {{VALUE}} !important;',
				]
			]
		);
		$this->add_responsive_control(
			'form_block_btn_level_fields_border_custom_color_hover', [
				'label' => esc_html__( "Border Color (Active)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form form[id*=give-form] #give-donation-level-button-wrap .give-btn.give-default-level' => 'border-color: {{VALUE}} !important;',
					'{{WRAPPER}} .tm-give-donation-form form[id*=give-form] #give-donation-level-button-wrap .give-btn.give-btn-level-custom.give-default-level' => 'border-color: {{VALUE}} !important;',
				]
			]
		);
		$this->add_responsive_control(
			'form_block_btn_level_fields_border_theme_colored', [
				'label' => esc_html__( "Border Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form form[id*=give-form] #give-donation-level-button-wrap .give-btn' => 'border-color: var(--theme-color{{VALUE}}) !important;',
					'{{WRAPPER}} .tm-give-donation-form form[id*=give-form] #give-donation-level-button-wrap .give-btn.give-btn-level-custom' => 'border-color: var(--theme-color{{VALUE}}) !important;',
				],
			]
		);
		$this->add_responsive_control(
			'form_block_btn_level_fields_border_theme_colored_hover', [
				'label' => esc_html__( "Border Theme Colored (Active)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form form[id*=give-form] #give-donation-level-button-wrap .give-btn.give-default-level' => 'border-color: var(--theme-color{{VALUE}}) !important;',
					'{{WRAPPER}} .tm-give-donation-form form[id*=give-form] #give-donation-level-button-wrap .give-btn.give-btn-level-custom.give-default-level' => 'border-color: var(--theme-color{{VALUE}}) !important;',
				],
			]
		);
		$this->add_control(
			'form_block_btn_level_fields_border_left_options',
			[
				'label' => esc_html__( 'Border Left Options', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'form_block_btn_level_fields_border_left_custom_color', [
				'label' => esc_html__( "Border Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form form[id*=give-form] #give-donation-level-button-wrap .give-btn:before' => 'background-color: {{VALUE}} !important;',
					'{{WRAPPER}} .tm-give-donation-form form[id*=give-form] #give-donation-level-button-wrap .give-btn.give-btn-level-custom:before' => 'background-color: {{VALUE}} !important;',
				]
			]
		);
		$this->add_responsive_control(
			'form_block_btn_level_fields_border_left_custom_color_hover', [
				'label' => esc_html__( "Border Color (Active)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form form[id*=give-form] #give-donation-level-button-wrap .give-btn.give-default-level:before' => 'background-color: {{VALUE}} !important;',
					'{{WRAPPER}} .tm-give-donation-form form[id*=give-form] #give-donation-level-button-wrap .give-btn.give-btn-level-custom.give-default-level:before' => 'background-color: {{VALUE}} !important;',
				]
			]
		);
		$this->add_responsive_control(
			'form_block_btn_level_fields_border_left_theme_colored', [
				'label' => esc_html__( "Border Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form form[id*=give-form] #give-donation-level-button-wrap .give-btn:before' => 'background-color: var(--theme-color{{VALUE}}) !important;',
					'{{WRAPPER}} .tm-give-donation-form form[id*=give-form] #give-donation-level-button-wrap .give-btn.give-btn-level-custom:before' => 'background-color: var(--theme-color{{VALUE}}) !important;',
				],
			]
		);
		$this->add_responsive_control(
			'form_block_btn_level_fields_border_left_theme_colored_hover', [
				'label' => esc_html__( "Border Theme Colored (Active)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form form[id*=give-form] #give-donation-level-button-wrap .give-btn.give-default-level:before' => 'background-color: var(--theme-color{{VALUE}}) !important;',
					'{{WRAPPER}} .tm-give-donation-form form[id*=give-form] #give-donation-level-button-wrap .give-btn.give-btn-level-custom.give-default-level:before' => 'background-color: var(--theme-color{{VALUE}}) !important;',
				],
			]
		);
		$this->add_control(
			'form_block_btn_level_fields_padding_options',
			[
				'label' => esc_html__( 'Padding Options', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'form_block_btn_level_fields_padding',
			[
				'label' => esc_html__( 'Button Padding', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form form[id*=give-form] #give-donation-level-button-wrap .give-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .tm-give-donation-form form[id*=give-form] #give-donation-level-button-wrap .give-btn.give-btn-level-custom' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();







		$this->start_controls_section(
			'form_block_amount_input_fields_color_typo_options', [
				'label' => esc_html__( 'Form Block => Amount Input Field', 'mascot-core-digicod' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'form_block_currency-symbol_text_color_options',
			[
				'label' => esc_html__( 'Currency Symbol', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'form_block_currency-symbol_bg_custom_color', [
				'label' => esc_html__( "Background Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form form[id*=give-form] .give-total-wrap .give-currency-symbol' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'form_block_currency-symbol_bg_theme_colored', [
				'label' => esc_html__( "Background Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form form[id*=give-form] .give-total-wrap .give-currency-symbol' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_responsive_control(
			'form_block_currency-symbol_text_color', [
				'label' => esc_html__( "Text Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form form[id*=give-form] .give-total-wrap .give-currency-symbol' => 'color: {{VALUE}} !important;'
				]
			]
		);
		$this->add_responsive_control(
			'form_block_currency-symbol_text_theme_colored', [
				'label' => esc_html__( "Text Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form form[id*=give-form] .give-total-wrap .give-currency-symbol' => 'color: var(--theme-color{{VALUE}}) !important;'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(), [
				'name' => 'form_block_currency-symbol_text_typography',
				'label' => esc_html__( 'Text Typography', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .tm-give-donation-form form[id*=give-form] .give-total-wrap .give-currency-symbol',
			]
		);
		$this->add_responsive_control(
			'form_block_currency-symbol_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form form[id*=give-form] .give-total-wrap .give-currency-symbol' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_control(
			'hr0111',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);





		$this->add_control(
			'form_block_amount_input_fields_text_color_options',
			[
				'label' => esc_html__( 'Amount Input Field Options', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'form_block_amount_input_fields_bg_custom_color', [
				'label' => esc_html__( "Background Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form form[id*=give-form] .give-total-wrap #give-amount' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'form_block_amount_input_fields_bg_theme_colored', [
				'label' => esc_html__( "Background Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form form[id*=give-form] .give-total-wrap #give-amount' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_responsive_control(
			'form_block_amount_input_fields_text_color', [
				'label' => esc_html__( "Text Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form form[id*=give-form] .give-total-wrap #give-amount' => 'color: {{VALUE}} !important;'
				]
			]
		);
		$this->add_responsive_control(
			'form_block_amount_input_fields_text_theme_colored', [
				'label' => esc_html__( "Text Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form form[id*=give-form] .give-total-wrap #give-amount' => 'color: var(--theme-color{{VALUE}}) !important;'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(), [
				'name' => 'form_block_amount_input_fields_text_typography',
				'label' => esc_html__( 'Text Typography', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .tm-give-donation-form form[id*=give-form] .give-total-wrap #give-amount',
			]
		);
		$this->add_control(
			'form_block_amount_input_fields_border_options',
			[
				'label' => esc_html__( 'Border Options', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'form_block_amount_input_fields_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form form[id*=give-form] .give-total-wrap #give-amount' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'form_block_amount_input_fields_border',
				'label' => esc_html__( 'Border', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .tm-give-donation-form form[id*=give-form] .give-total-wrap #give-amount',
			]
		);
		$this->end_controls_section();








		$this->start_controls_section(
			'box_styling',
			[
				'label' => esc_html__( 'Parent Box Wrapper Style', 'mascot-core-digicod' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'form_wrapper_width',
			[
				'label' => esc_html__( "Width", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'unit' => '%',
				],
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 2000,
						'step' => 1,
					],
					'%' => [
						'min' => 2,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form' => 'width: {{SIZE}}{{UNIT}};'
				]
			]
		);
		$this->add_responsive_control(
			'form_wrapper_flex_direction',
			[
				'label' => esc_html__( "Flex Direction", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_disply_flex_direction_elementor(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form .give-donation-form-inner' => 'display:flex; flex-direction: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'form_wrapper_padding',
			[
				'label' => esc_html__( 'Wrapper Padding', 'mascot-core-digicod' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'form_wrapper_border_options',
			[
				'label' => esc_html__( 'Border Options', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'form_wrapper_border',
				'label' => esc_html__( 'Border', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .tm-give-donation-form',
			]
		);
		$this->add_responsive_control(
			'form_wrapper_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'form_wrapper_boxshadow',
				'label' => esc_html__( 'Box Shadow', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .tm-give-donation-form',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'form_wrapper_boxshadow_hover',
				'label' => esc_html__( 'Box Shadow(Hover)', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}}:hover .tm-give-donation-form',
			]
		);
		$this->add_control(
			'form_wrapper_color_options',
			[
				'label' => esc_html__( 'BG Color Options', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'form_wrapper_custom_bg_color',
			[
				'label' => esc_html__( "Custom Background Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'form_wrapper_custom_bg_color_hover',
			[
				'label' => esc_html__( "Custom Background Color (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .tm-give-donation-form' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'form_wrapper_theme_colored',
			[
				'label' => esc_html__( "Background Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-give-donation-form' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_responsive_control(
			'form_wrapper_theme_colored_hover',
			[
				'label' => esc_html__( "Background Theme Colored (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .tm-give-donation-form' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_section();
	}



	public function calculate_total_earnings($settings) {
		$total_earnings = 0;
		if( '' !== $settings['custom_total_raised'] ) {
			$total_earnings = $settings['custom_raised'];
		} else if(isset($settings['form_id']) && !empty($settings['form_id'])) {
			//get income from form id
			$form = new \Give_Donate_Form( $settings['form_id'] );
			$goal_progress_stats = give_goal_progress_stats( $form );
			$total_earnings = $goal_progress_stats['raw_actual'];
		}
		return $total_earnings;
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

		//total earning calculation
		$settings['custom_raised'] = $this->calculate_total_earnings($settings);


		$class_instance =  array();
		$settings['holder_id'] = mascot_core_get_isotope_holder_ID('give-donation-form');
		$settings['form_heading_title'] = $this->get_form_title($settings);
		$settings['heading_title'] = $this->get_heading_title($settings);

		$this->render_output( $class_instance, $settings );
	}

	public function render_output( $class_instance, $settings ) {
		//classes
		$classes = array();
		if( isset($settings['_skin']) ) {
			$classes[] = 'give-donation-form-' . $settings['_skin'];
		}
		$settings['classes'] = $classes;

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = mascot_core_digicod_get_shortcode_template_part( 'each-form', $settings['_skin'], 'give-donation-form/tpl', $settings, true );

		echo $html;
	}

	public function get_form_title( $settings ) {
		$form_heading_title = '';
		if ( $settings['take_form_heading_title_from_form_ID'] == 'yes' && !empty($settings['form_id'])) {
			$form_heading_title = get_the_title($settings['form_id']);
		} else {
			$form_heading_title = $settings['form_heading_title'];
		}
		return $form_heading_title;
	}

	public function get_heading_title( $settings ) {
		$heading_title = '';
		if ( $settings['take_heading_title_from_form_ID'] == 'yes' && !empty($settings['form_id']) ) {
			$heading_title = get_the_title($settings['form_id']);
		} else {
			$heading_title = $settings['heading_title'];
		}
		return $heading_title;
	}
}