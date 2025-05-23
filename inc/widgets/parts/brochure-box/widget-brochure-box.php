<?php

/*
 * Adds Mascot_Core_Digicod_Widget_BrochureBox widget.
 */
if( !class_exists( 'Mascot_Core_Digicod_Widget_BrochureBox' ) ) {
class Mascot_Core_Digicod_Widget_BrochureBox extends Mascot_Core_Digicod_Widget_Loader {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		$this->widgetOptions = array(
			'classname'		=> 'widget-brochure-box clearfix',
			'description'	=> esc_html__( 'A widget that displays Brochure Box with download link.', 'mascot-core-digicod' ),
		);
		parent::__construct( 'tm_widget_brochure_box', esc_html__( '(TM) Brochure Box', 'mascot-core-digicod' ), $this->widgetOptions );
		$this->getFormFields();

		add_action('admin_enqueue_scripts', 'mascot_core_digicod_widget_brochure_enque_media_library_for_admin' );
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
				'default'	=> esc_html__( 'Brochure Box', 'mascot-core-digicod' ),
			),
			array(
				'id'		=> 'custom_css_class',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Custom CSS Class:', 'mascot-core-digicod' ),
				'desc'		=> esc_html__( 'To style particular content element', 'mascot-core-digicod' ),
			),
			array(
				'id'		=> 'visual_style',
				'type'		=> 'dropdown',
				'title'		=> esc_html__( 'Visual Style', 'mascot-core-digicod' ),
				'desc'		=> esc_html__( 'Please choose one from different predefined styles.', 'mascot-core-digicod' ),
				'options'	=> array(
					'brochure-box-default'			=> esc_html__( 'Default - Icon Left', 'mascot-core-digicod' ),
					'brochure-box-classic'			=> esc_html__( 'Classic - Icon Right', 'mascot-core-digicod' ),
				)
			),
			array(
				'id'		=> 'brochure_box_theme_colored',
				'type'		=> 'dropdown',
				'title'		=> esc_html__( 'Make Theme Colored?', 'mascot-core-digicod' ),
				'desc'		=> '',
				'options'	=> mascot_core_digicod_theme_color_list()
			),
			array(
				'id'		=> 'brochure_box_dark_version',
				'type'		=> 'checkbox',
				'title'		=> esc_html__( 'Make Dark Brochure Box?', 'mascot-core-digicod' ),
				'desc'		=> '',
				'value'	=> 'on',
			),
			array(
				'id'		=> 'file_url',
				'type'		=> 'media_upload',
				'title'		=> esc_html__( 'Brochure URL:', 'mascot-core-digicod' ),
			),
			array(
				'id'		=> 'text',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Brochure Text:', 'mascot-core-digicod' ),
			),
			array(
				'id'		=> 'icon',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Brochure Icon:', 'mascot-core-digicod' ),
				'desc'		=> sprintf( esc_html__( 'Example: fa fa-download. Collect your own icon from %1$sFontAwesome%2$s.', 'mascot-core-digicod' ), '<a target="_blank" href="' . esc_url( 'https://fontawesome.com/v4.7.0/icons/' ) . '">', '</a>' ),
			),
			array(
				'id'		=> 'icon_list',
				'type'		=> 'icon_list',
				'title'		=> esc_html__( 'Or select any icon from here:', 'mascot-core-digicod' ),
				'desc'		=> '',
				'class'	=> 'fa-lg',
				'target'   => 'icon', //targeted text field
				'options'	=> mascot_core_digicod_icon_font_packs( 'font_awesome' )
			),
			array(
				'id'		=> 'target',
				'type'		=> 'checkbox',
				'title'		=> esc_html__( 'Open Link in New Tab', 'mascot-core-digicod' ),
				'desc'		=> '',
				'value'	=> 'on',
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

		$instance['brochure_box_dark_version'] = isset($instance['brochure_box_dark_version']) ? $instance['brochure_box_dark_version'] : '';
		$instance['target'] = isset($instance['target']) ? $instance['target'] : '';

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, widget_ob_start)
		$html = mascot_core_digicod_get_widget_template_part( $instance['visual_style'], null, 'brochure-box/tpl', $instance, false );

		echo wp_kses_post($args['after_widget']);
	}
}
}


function mascot_core_digicod_widget_brochure_enque_media_library_for_admin( $hook ) {
	if ( $hook == 'widgets.php' ) {
		wp_enqueue_media();
	}
}