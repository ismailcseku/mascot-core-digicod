<?php
namespace MascotCoreDigicod\Widgets\GiveForms\Skins;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Skin_Base as Elementor_Skin_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Forms_Style_Current_Theme1 extends Elementor_Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/tm-ele-give-forms/general/after_section_end', [ $this, 'register_layout_controls' ] );
	}

	public function get_id() {
		return 'skin-forms-style-current-theme1';
	}


	public function get_title() {
		return __( 'Give Forms Style Current Theme1', 'mascot-core-digicod' );
	}


	public function register_layout_controls( Widget_Base $widget ) {
		$this->parent = $widget;

		$this->start_controls_section(
			'pie_chart_options',
			[
				'label' => esc_html__( 'Pie Chart Options', 'mascot-core-digicod' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'custom_total_raised',
			[
				'label' => __( 'Custom Total Raised Percentage', 'mascot-core-digicod' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'mascot-core-digicod' ),
				'label_off' => __( 'Hide', 'mascot-core-digicod' ),
				'default' => 'no',
			]
		);
		$this->add_control(
			'percent',
			[
				'label' => esc_html__( "Custom Percentage Value", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( "Add a Custom Percentage Value. Maximum 100. Default: 85", 'mascot-core-digicod' ),
				'default' => '85',
				'condition' => [
					'skin_forms_current_theme_horizontal_custom_total_raised' => 'yes',
				],
			]
		);
		$this->add_control(
			'barcolor',
			[
				'label' => esc_html__( "Bar Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'description' => esc_html__( "The color of the curcular bar. Leave empty for default value", 'mascot-core-digicod' ),
				'default' => '#232226'
			]
		);
		$this->add_control(
			'trackcolor',
			[
				'label' => esc_html__( "Track Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'description' => esc_html__( "The color of the track, or false to disable rendering. Leave empty for default value", 'mascot-core-digicod' ),
				'default' => '#f2f2f2'
			]
		);
		$this->add_control(
			'linewidth',
			[
				'label' => esc_html__( "Line Width", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( "Width of the chart line in px. Default: 3", 'mascot-core-digicod' ),
				'default' => '3'
			]
		);
		$this->add_control(
			'linecap',
			[
				'label' => esc_html__( "Line Cap", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
				'square' => esc_html__( 'Square', 'mascot-core-digicod' ),
				'butt' => esc_html__( 'Butt', 'mascot-core-digicod' ),
				'round' => esc_html__( 'Round', 'mascot-core-digicod' ),
				],
				'default' => 'square'
			]
		);
		$this->add_control(
			'size',
			[
				'label' => esc_html__( "Size", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( "Size of the pie chart in px. It will always be a square. Default: 190", 'mascot-core-digicod' ),
				'default' => '190'
			]
		);
		$this->add_control(
			'scalecolor',
			[
				'label' => esc_html__( "Scale  Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'description' => esc_html__( "The color of the scale lines, false to disable rendering. Leave empty for default value", 'mascot-core-digicod' ),
				'default' => '#f2f2f2'
			]
		);
		$this->add_control(
			'scalelength',
			[
				'label' => esc_html__( "Scale Length", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( "Length of the scale lines (reduces the radius of the chart). Default: 5", 'mascot-core-digicod' ),
				'default' => '5'
			]
		);

		$this->end_controls_section();






		$this->start_controls_section(
			'percent_options',
			[
				'label' => esc_html__( 'Percent Value Options', 'mascot-core-digicod' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'percent_color',
			[
				'label' => esc_html__( "Percent Value Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .percent' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'percent_color_hover',
			[
				'label' => esc_html__( "Percent Value Color (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .give_forms:hover .percent' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'percent_theme_colored',
			[
				'label' => esc_html__( "Percent Value Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .percent' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'percent_theme_colored_hover',
			[
				'label' => esc_html__( "Percent Value Theme Colored (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .give_forms:hover .percent' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'percent_typography',
				'label' => esc_html__( 'Typography', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .percent',
			]
		);
		$this->end_controls_section();
	}

	public function calculate_total_earnings($settings, $form_id) {
		$total_earnings = 0;
		if( 'yes' === $this->parent->get_instance_value_skin( 'custom_total_raised' ) ) {
			$total_earnings = $this->parent->get_instance_value_skin( 'percent' );
		} else if(isset($form_id) && !empty($form_id)) {
			//get income from form id
			$form = new \Give_Donate_Form( $form_id );
			$goal_progress_stats = give_goal_progress_stats( $form );
			$total_earnings = $goal_progress_stats['progress'];
		}
		return $total_earnings;
	}

	public function pie_chart_box_css( $settings ) {
		$css_array = array();

		if( $this->parent->get_instance_value_skin( 'size' ) != '' ) {
			$css_array[] = 'width: '.mascot_core_if_numeric_add_suffix($this->parent->get_instance_value_skin( 'size' ), 'px');
			$css_array[] = 'height: '.mascot_core_if_numeric_add_suffix($this->parent->get_instance_value_skin( 'size' ), 'px');
			$css_array[] = 'line-height: '.mascot_core_if_numeric_add_suffix($this->parent->get_instance_value_skin( 'size' ), 'px');
		}
		return implode( '; ', $css_array );
	}
	
	public function render() {
		$settings = $this->parent->get_settings_for_display();
		$settings['thisobj'] = $this;
		$settings['thisparent'] = $this->parent;
		
		$class_instance =  array();

		$settings['holder_id'] = mascot_core_get_isotope_holder_ID('give-forms');

		$this->render_output( $class_instance, $settings );
	}

	public function render_output( $class_instance, $settings ) {
		$new_cpt_class = $class_instance;

		if( $settings['display_type'] != 'masonry' ) {
			$settings['use_masonry_tiles_featured_image_size'] = 'false';
		}
		
		
		$settings['the_query'] = $this->parent->query_posts();
		
		if ( !$settings['the_query']->have_posts() && isset( $settings['from_loadmore_ajax_handler'] ) && $settings['from_loadmore_ajax_handler'] === true ) {
			return;
		}
		
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

		
		$settings['box_inline_css'] = mascot_core_get_inline_css( $this->pie_chart_box_css( $settings ) );

		$settings['settings'] = $settings;

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = mascot_core_digicod_get_shortcode_template_part( 'forms', $settings['display_type'], 'give-forms/tpl', $settings, true );
		
		echo $html;
	}
}
