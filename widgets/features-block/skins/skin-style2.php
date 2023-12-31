<?php
namespace MascotCoreDigicod\Widgets\FeaturesBlock\Skins;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Skin_Base as Elementor_Skin_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Style2 extends Elementor_Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/tm-ele-features-block/general/after_section_end', [ $this, 'register_layout_controls' ] );
	}

	public function get_id() {
		return 'skin-style2';
	}


	public function get_title() {
		return __( 'Skin Style2', 'mascot-core-digicod' );
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
					'{{WRAPPER}} .features-block-style2' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'content_wrapper_theme_colored_hover',
			[
				'label' => esc_html__( "Make Content BG Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .features-block-style2' => 'background-color: var(--theme-color{{VALUE}});'
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
		$settings['holder_id'] = digicod_get_isotope_holder_ID('features-block');

		$settings['settings'] = $settings;

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = mascot_core_digicod_get_shortcode_template_part( 'features', $settings['display_type'], 'features-block/tpl', $settings, true );

		echo $html;
	}
}