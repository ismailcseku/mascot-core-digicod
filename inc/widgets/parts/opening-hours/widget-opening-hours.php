<?php

/*
 * Adds Mascot_Core_Digicod_Widget_OpeningHours widget.
 */
if( !class_exists( 'Mascot_Core_Digicod_Widget_OpeningHours' ) ) {
class Mascot_Core_Digicod_Widget_OpeningHours extends Mascot_Core_Digicod_Widget_Loader {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		$this->widgetOptions = array(
			'classname'		=> 'widget-opening-hours clearfix',
			'description'	=> esc_html__( 'The widget lets you easily display Opening Hours.', 'mascot-core-digicod' ),
		);
		parent::__construct( 'tm_widget_opening_hours', esc_html__( '(TM) Opening Hours', 'mascot-core-digicod' ), $this->widgetOptions );
		$this->getFormFields();
	}


	/**
	 * Get form fields of the widget.
	 */
	protected function getFormFields() {

		$this->formFields = array(
			array(
				'id'		=> 'title',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Widget Title:', 'mascot-core-digicod' ),
				'desc'		=> '',
				'default'	=> esc_html__( 'Opening Hours', 'mascot-core-digicod' ),
			),
			array(
				'id'		=> 'custom_css_class',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Custom CSS Class:', 'mascot-core-digicod' ),
				'desc'		=> esc_html__( 'To style particular content element', 'mascot-core-digicod' ),
			),
			array(
				'id'		=> 'border_color',
				'type'		=> 'dropdown',
				'title'		=> esc_html__( 'Border Color:', 'mascot-core-digicod' ),
				'desc'		=> '',
				'options'	=> array(
					'border-light'  => 'Border Light',
					'border-dark'   => 'Border Dark',
				)
			),


			//Monday
			array(
				'id'		=> 'day_monday',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Monday:', 'mascot-core-digicod' ),
				'default'	=> esc_html__( '9:00 - 17:00', 'mascot-core-digicod' ),
			),


			//Tuesday
			array(
				'id'		=> 'day_tuesday',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Tuesday:', 'mascot-core-digicod' ),
				'default'	=> esc_html__( '9:00 - 17:00', 'mascot-core-digicod' ),
			),


			//Wednesday
			array(
				'id'		=> 'day_wednesday',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Wednesday:', 'mascot-core-digicod' ),
				'default'	=> esc_html__( '9:00 - 17:00', 'mascot-core-digicod' ),
			),


			//Thursday
			array(
				'id'		=> 'day_thursday',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Thursday:', 'mascot-core-digicod' ),
				'default'	=> esc_html__( '9:00 - 17:00', 'mascot-core-digicod' ),
			),


			//Friday
			array(
				'id'		=> 'day_friday',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Friday:', 'mascot-core-digicod' ),
				'default'	=> esc_html__( '9:30 - 16:00', 'mascot-core-digicod' ),
			),


			//Saturday
			array(
				'id'		=> 'day_saturday',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Saturday:', 'mascot-core-digicod' ),
				'default'	=> esc_html__( '10:00 - 15:00', 'mascot-core-digicod' ),
			),


			//Sunday
			array(
				'id'		=> 'day_sunday',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Sunday:', 'mascot-core-digicod' ),
				'default'	=> esc_html__( 'Closed', 'mascot-core-digicod' ),
			),
		);
	}



	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args	 Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo wp_kses_post($args['before_widget']);

		if ( ! empty( $instance['title'] ) ) {
			echo wp_kses_post( $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'] );
		}

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, widget_ob_start)
		$html = mascot_core_digicod_get_widget_template_part( 'opening-hours', null, 'opening-hours/tpl', $instance, false );

		echo wp_kses_post($args['after_widget']);
	}
}
}