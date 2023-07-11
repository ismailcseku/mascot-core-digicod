<?php
namespace MascotCoreDigicod\Widgets\GiveForms\Skins;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Skin_Base as Elementor_Skin_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Forms_Style4 extends Elementor_Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/tm-ele-give-forms/general/before_section_end', [ $this, 'register_layout_controls' ] );
	}

	public function get_id() {
		return 'skin-forms-style4';
	}


	public function get_title() {
		return __( 'Give Forms Style4', 'mascot-core-digicod' );
	}


	public function register_layout_controls( Widget_Base $widget ) {
		$this->parent = $widget;
	}
	
	public function render() {
		$settings = $this->parent->get_settings_for_display();
		
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

		$settings['settings'] = $settings;

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = mascot_core_digicod_get_shortcode_template_part( 'forms', $settings['display_type'], 'give-forms/tpl', $settings, true );
		
		echo $html;
	}
}
