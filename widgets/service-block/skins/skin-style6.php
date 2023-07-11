<?php
namespace MascotCoreDigicod\Widgets\ServiceBlock\Skins;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Skin_Base as Elementor_Skin_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Style6 extends Elementor_Skin_Base {

	protected function _register_controls_actions() {
		//enqueue css
		$direction_suffix = is_rtl() ? '.rtl' : '';
		wp_enqueue_style( 'tm-service-block-style6', MASCOT_CORE_DIGICOD_URL_PATH . 'assets/css/shortcodes/service-block/service-block-style6' . $direction_suffix . '.css' );

		add_action( 'elementor/element/tm-ele-service-block/general/after_section_end', [ $this, 'register_layout_controls' ] );
	}

	public function get_id() {
		return 'skin-style6';
	}


	public function get_title() {
		return __( 'Skin Style6', 'mascot-core-digicod' );
	}


	public function register_layout_controls( Widget_Base $widget ) {
		$this->parent = $widget;

		//Current Background Styling
		$this->start_controls_section(
			'current_background_styling',
			[
				'label' => esc_html__( 'Current Skin Styling', 'mascot-core-digicod' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'content_wrapper_custom_bg_color_hover',
			[
				'label' => esc_html__( "Custom Content BG Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .service-block-style6 .inner-box' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'wrapper_bg_before_background_opacity',
			[
				'label' => esc_html__( 'Custom Content Shadow Color Opacity', 'mascot-core-digicod' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => .9,
				],
				'range' => [
					'px' => [
						'max' => 1,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .service-block-style6 .inner-box:before' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->end_controls_section();

	}

	public function render() {
		$settings = $this->parent->get_settings_for_display();

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