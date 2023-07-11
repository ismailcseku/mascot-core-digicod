<?php
namespace MascotCoreDigicod\Widgets\GiveSingleForm\Skins;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Skin_Base as Elementor_Skin_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Form_Only_Goal_Btn extends Elementor_Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/tm-ele-give-single-form/general/before_section_end', [ $this, 'register_layout_controls' ] );
	}

	public function get_id() {
		return 'skin-form-only-btn-goal';
	}


	public function get_title() {
		return __( 'Skin Form Only Goal & Btn', 'mascot-core-digicod' );
	}


	public function register_layout_controls( Widget_Base $widget ) {
		$this->parent = $widget;
	}
	
	public function render() {
		$settings = $this->parent->get_settings_for_display();

		$class_instance =  array();
		$settings['holder_id'] = mascot_core_get_isotope_holder_ID('give-donation-form');
		$settings['form_heading_title'] = $this->parent->get_form_title($settings);

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
}