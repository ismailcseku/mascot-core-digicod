<?php
namespace MascotCoreDigicod\Widgets\Blog\Skins;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Skin_Base as Elementor_Skin_Base;

use MASCOTCOREDIGICOD\Lib;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Style_Current_Theme2 extends Elementor_Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/tm-ele-blog/general/after_section_end', [ $this, 'register_layout_controls' ] );
	}

	public function get_id() {
		return 'skin-style-current-theme2';
	}


	public function get_title() {
		return __( 'Skin - Style Current Theme2', 'mascot-core-digicod' );
	}


	public function register_layout_controls( Widget_Base $widget ) {
		$this->parent = $widget;

		$this->start_controls_section(
			'content_wrapper_styling',
			[
				'label' => esc_html__( 'Content Wrapper Styling', 'mascot-core-digicod' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'content_wrapper_color_options',
			[
				'label' => esc_html__( 'BG Color Options', 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'content_wrapper_custom_bg_color',
			[
				'label' => esc_html__( "Custom Background Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .blog-item-current-style2:before' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->end_controls_section();

	}

	public function render() {
		$settings = $this->parent->get_settings_for_display();
		$class_instance =  '';

		if(isset($settings['post_meta_options']) && !empty($settings['post_meta_options'])) {
			$settings['post_meta_options'] = implode(",", $settings['post_meta_options']);
		}
		$settings['holder_id'] = digicod_get_isotope_holder_ID('blog');

		$this->render_output( $class_instance, $settings );
	}

	public function render_output( $class_instance, $settings ) {
		$settings['the_query'] = $this->parent->query_posts();

		//button classes
		$settings['btn_classes'] = mascot_core_prepare_button_classes_from_params( $settings );

		//classes
		$classes = array();
		$classes[] = $settings['custom_css_class'];
		$settings['classes'] = $classes;

		//Owl Carousel Data
		$settings['owl_carousel_data_info'] = mascot_core_prepare_owlcarousel_data_from_params( $settings );

		$settings['settings'] = $settings;

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = mascot_core_digicod_get_cpt_shortcode_template_part( 'blog', $settings['display_type'], 'blog/tpl/type', $settings, true );

		echo $html;
	}
}
