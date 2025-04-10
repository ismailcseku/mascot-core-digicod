<?php

/*
 * Adds Mascot_Core_Digicod_Widget_HorizontalRow widget.
 */
if( !class_exists( 'Mascot_Core_Digicod_Widget_HorizontalRow' ) ) {
class Mascot_Core_Digicod_Widget_HorizontalRow extends Mascot_Core_Digicod_Widget_Loader {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		$this->widgetOptions = array(
			'classname'		=> 'widget-horizontal-row clearfix',
			'description'	=> esc_html__( 'The Widget lets you easily add Horizontal Row on your site.', 'mascot-core-digicod' ),
		);
		parent::__construct( 'tm_widget_horizontal_row', esc_html__( '(TM) Horizontal Row', 'mascot-core-digicod' ), $this->widgetOptions );
		$this->getFormFields();
	}


	/**
	 * Get form fields of the widget.
	 */
	protected function getFormFields() {
		$this->formFields = array(
			array(
				'id'		=> 'desc',
				'type'		=> 'description',
				'title'		=> $this->widgetOptions['description'],
			),
			array(
				'id'		=> 'h_line',
				'type'		=> 'line',
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
		$html = mascot_core_digicod_get_widget_template_part( 'horizontal-row', null, 'horizontal-row/tpl', $instance, false );

		echo wp_kses_post($args['after_widget']);
	}
}
}