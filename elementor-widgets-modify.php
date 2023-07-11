<?php

class Mascot_Core_Digicod_Modify_Widgets {
	private static $instance;
	public $sections = array();

	public function __construct() {
		add_action( 'elementor/element/tm-ele-section-title/title_shadow_options_styling/after_section_end', array( $this, 'tm_elementor_column_options' ), 10, 2 );
	}

	public static function get_instance() {
		if ( self::$instance === null ) {
			return new self();
		}

		return self::$instance;
	}

	public function tm_elementor_column_options( $element ){

		$element->start_controls_section(
			'horizontal_line_styling',
			[
				'label' => esc_html__( 'Horizontal Line Styling', 'mascot-core-digicod' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$element->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'horizontal_line_background',
				'label' => esc_html__( 'Background', 'mascot-core' ),
				'types' => [ 'gradient' ],
				'selector' => '{{WRAPPER}} .subtitle:before, {{WRAPPER}} .subtitle:after',
				'fields_options' => [
					'position' => ['default' => 'bottom center'],
					'repeat' => ['default' => 'no-repeat'],
				],
			]
		);
		$element->end_controls_section();

	}
}

if ( ! function_exists( 'mascot_core_digicod_init_modify_widgets_handler' ) ) {
	function mascot_core_digicod_init_modify_widgets_handler() {
		Mascot_Core_Digicod_Modify_Widgets::get_instance();
	}

	add_action( 'init', 'mascot_core_digicod_init_modify_widgets_handler', 1 );
}