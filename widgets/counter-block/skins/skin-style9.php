<?php
namespace MascotCoreDigicod\Widgets\CounterBlock\Skins;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Skin_Base as Elementor_Skin_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Style9 extends Elementor_Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/tm-ele-counter-block/general/after_section_end', [ $this, 'register_layout_controls' ] );
	}

	public function get_id() {
		return 'skin-style9';
	}


	public function get_title() {
		return __( 'Skin Style9', 'mascot-core-digicod' );
	}


	public function register_layout_controls( Widget_Base $widget ) {
		$this->parent = $widget;

		$this->start_controls_section(
			'current_skin_bg_styling',
			[
				'label' => esc_html__( 'Current Skin Styling', 'mascot-core-digicod' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'current_skin_bg_color_options',
			[
				'label' => esc_html__( 'BG Color Options', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->start_controls_tabs('tabs_current_theme_styling');
		$this->start_controls_tab(
			'tabs_current_theme_styling_normal',
			[
				'label' => esc_html__('Normal', 'mascot-core-digicod'),
			]
		);
		$this->add_responsive_control(
			'current_skin_bg_custom_bg_color',
			[
				'label' => esc_html__( "Custom Background Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mascot-counter .inner' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'current_skin_bg_theme_colored',
			[
				'label' => esc_html__( "Make BG Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .mascot-counter .inner' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_current_theme_styling_hover',
			[
				'label' => esc_html__('Hover', 'mascot-core-digicod'),
			]
		);
		$this->add_responsive_control(
			'current_skin_bg_custom_bg_color_hover',
			[
				'label' => esc_html__( "Custom Background Color (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mascot-counter:hover .inner' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'current_skin_bg_theme_colored_hover',
			[
				'label' => esc_html__( "Make BG Theme Colored (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .mascot-counter:hover .inner' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();



		$this->add_control(
			'current_skin_border_options',
			[
				'label' => esc_html__( 'Border Options', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'current_skin_border',
				'label' => esc_html__( 'Border', 'mascot-core-digicod' ),
				'selector' => '{{WRAPPER}} .mascot-counter .inner',
			]
		);
		$this->add_responsive_control(
			'current_skin_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .mascot-counter .inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->end_controls_section();
	}

	public function render() {
		$settings = $this->parent->get_settings_for_display();

		//classes
		$classes = array();
		if ( $settings['animate_icon_on_hover'] ) {
			$classes[] = 'tm-animate-icon-on-hover animate-icon-' . $settings['animate_icon_on_hover'];
		}
		if ( $settings['everything_centered_in_responsive_tablet'] === 'yes' ) {
			$classes[] = 'counter-centered-in-responsive-tablet';
		}
		if ( $settings['everything_centered_in_responsive_mobile'] === 'yes' ) {
			$classes[] = 'counter-centered-in-responsive-mobile';
		}
		$settings['classes'] = $classes;

		$settings['animation_duration'] = mascot_core_get_inline_attributes( $settings['counter_duration'], 'data-animation-duration' );

		//counter classes
		$counter_classes = array();
		$counter_classes[] = $settings['counter_custom_css_class'];
		$settings['counter_classes'] = $counter_classes;

		//title classes
		$title_classes = array();
		$title_classes[] = $settings['title_custom_css_class'];
		$settings['title_classes'] = $title_classes;

		wp_register_script( 'jquery-animatenumbers', MASCOT_CORE_ELEMENTOR_ASSETS_URI . '/js/plugins/jquery.animatenumbers.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'jquery-animatenumbers' );
		$settings['settings'] = $settings;

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = mascot_core_digicod_get_shortcode_template_part( 'counter-skin-style9', null, 'counter-block/tpl', $settings, true );

		echo $html;
	}
}