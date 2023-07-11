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
					'{{WRAPPER}} .counter-block-nine .count-box' => 'background-color: {{VALUE}};'
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
					'{{WRAPPER}} .counter-block-nine .count-box' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_section();
	}

	public function render() {
		$settings = $this->parent->get_settings_for_display();

		//enqueue css
		$direction_suffix = is_rtl() ? '.rtl' : '';
		wp_enqueue_style( 'tm-counter-block-style9', MASCOT_CORE_DIGICOD_URL_PATH . 'assets/css/shortcodes/counter-block/counter-block-style9' . $direction_suffix . '.css' );

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