<?php
namespace MascotCoreDigicod\Widgets\Events\Skins;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Skin_Base as Elementor_Skin_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Style2 extends Elementor_Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/tm-ele-tribe-events/general/before_section_end', [ $this, 'register_layout_controls' ] );
	}

	public function get_id() {
		return 'skin-style2';
	}


	public function get_title() {
		return __( 'Skin Style2', 'mascot-core-digicod' );
	}


	public function register_layout_controls( Widget_Base $widget ) {
		$this->parent = $widget;

		/*$this->add_control(
			'show_thumbnail',
			[
				'label' => __( 'Thumbnail', 'mascot-core-digicod' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'mascot-core-digicod' ),
				'label_off' => __( 'Hide', 'mascot-core-digicod' ),
				'default' => 'yes',
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'default' => 'medium_large',
				'exclude' => [ 'custom' ],
				'condition' => [
					'skin_current_theme1_show_thumbnail!'=> '',
				],
			]
		);*/

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

		if ( !$settings['the_query']->have_posts() && isset( $settings['from_loadmore_ajax_handler'] ) && $settings['from_loadmore_ajax_handler'] === true ) {
			return;
		}


		//classes
		$classes = array();
		if( isset($settings['_skin']) ) {
			$classes[] = 'tribe-events-' . $settings['_skin'];
		}
		$settings['classes'] = $classes;

		//button classes
		$settings['btn_classes'] = mascot_core_prepare_button_classes_from_params( $settings );
		//$settings['loadmore_btn_classes'] = mascot_core_prepare_button_classes_from_params( $settings, 'loadmore_' );


		//event-date classes
		$event_left_classes = array();
		$settings['event_left_classes'] = $event_left_classes;

		//Owl Carousel Data
		$settings['owl_carousel_data_info'] = mascot_core_prepare_owlcarousel_data_from_params( $settings );

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = mascot_core_digicod_get_shortcode_template_part( 'tribe-events', $settings['display_type'], 'tribe-events/tpl', $settings, true );

		echo $html;
	}
}
