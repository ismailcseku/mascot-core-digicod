<?php

/*
 * Adds Mascot_Core_Digicod_Widget_SocialListCustom widget.
 */
if( !class_exists( 'Mascot_Core_Digicod_Widget_SocialListCustom' ) ) {
class Mascot_Core_Digicod_Widget_SocialListCustom extends Mascot_Core_Digicod_Widget_Loader {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		$this->widgetOptions = array( 
			'classname'		=> 'widget-social-list-custom clearfix',
			'description'	=> esc_html__( 'The widget lets you easily display social icons.', 'mascot-core-digicod' ),
		);
		parent::__construct( 'tm_widget_social_list_custom', esc_html__( '(TM) Social List (Custom)', 'mascot-core-digicod' ), $this->widgetOptions );
		$this->getFormFields();
	}

	
	/**
	 * Get form fields of the widget.
	 */
	protected function getFormFields() {
		$social_array = array(
			'fa-dribbble'  => esc_html__( 'Dribble', 'mascot-core-digicod' ),
			'fa-facebook'  => esc_html__( 'Facebook', 'mascot-core-digicod' ),
			'fa-flickr'  => esc_html__( 'Flickr', 'mascot-core-digicod' ),
			'fa-instagram'  => esc_html__( 'Instagram', 'mascot-core-digicod' ),

			'fa-linkedin'  => esc_html__( 'Linkedin', 'mascot-core-digicod' ),
			'fa-pinterest'  => esc_html__( 'Pinterest', 'mascot-core-digicod' ),
			'fa-rss'  => esc_html__( 'RSS', 'mascot-core-digicod' ),
			'fa-skype'  => esc_html__( 'Skype', 'mascot-core-digicod' ),
			'fa-tumblr'  => esc_html__( 'Tumblr', 'mascot-core-digicod' ),
			
			'fa-twitter'  => esc_html__( 'Twitter', 'mascot-core-digicod' ),
			'fa-vimeo-square'  => esc_html__( 'Vimeo', 'mascot-core-digicod' ),
			'fa-vine'  => esc_html__( 'Vine', 'mascot-core-digicod' ),
			'fa-wordpress'  => esc_html__( 'Wordpress', 'mascot-core-digicod' ),
			'fa-youtube'  => esc_html__( 'Youtube', 'mascot-core-digicod' ),
		);

		$this->formFields = array(
			array(
				'id'		=> 'title',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Widget Title:', 'mascot-core-digicod' ),
				'desc'		=> '',
				'default'	=> esc_html__( 'Social List', 'mascot-core-digicod' ),
			),
			array(
				'id'		=> 'custom_css_class',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Custom CSS Class:', 'mascot-core-digicod' ),
				'desc'		=> esc_html__( 'To style particular content element', 'mascot-core-digicod' ),
			),


			array(
				'id'		=> 'icon_size',
				'type'		=> 'dropdown',
				'title'		=> esc_html__( 'Icon Size:', 'mascot-core-digicod' ),
				'desc'		=> '',
				'options'	=> array(
					''		  => esc_html__( 'Default', 'mascot-core-digicod' ),
					'icon-xs' => esc_html__( 'Extra Small', 'mascot-core-digicod' ),
					'icon-sm' => esc_html__( 'Small', 'mascot-core-digicod' ),
					'icon-md' => esc_html__( 'Medium', 'mascot-core-digicod' ),
					'icon-lg' => esc_html__( 'Large', 'mascot-core-digicod' ),
					'icon-xl' => esc_html__( 'Extra Large', 'mascot-core-digicod' ),
				)
			),
			array(
				'id'		=> 'icon_color',
				'type'		=> 'dropdown',
				'title'		=> esc_html__( 'Icon Color:', 'mascot-core-digicod' ),
				'desc'		=> '',
				'options'	=> array(
					'icon-dark' => esc_html__( 'Dark', 'mascot-core-digicod' ),
					''			=> esc_html__( 'Default', 'mascot-core-digicod' ),
					'icon-gray' => esc_html__( 'Gray', 'mascot-core-digicod' ),
				)
			),

			array(
				'id'		=> 'icon_style',
				'type'		=> 'dropdown',
				'title'		=> esc_html__( 'Icon Style:', 'mascot-core-digicod' ),
				'desc'		=> '',
				'options'	=> array(
					'icon-rounded' => esc_html__( 'Rounded', 'mascot-core-digicod' ),
					'icon-default' => esc_html__( 'Default', 'mascot-core-digicod' ),
					'icon-circled' => esc_html__( 'Circled', 'mascot-core-digicod' ),
				)
			),

			
			array(
				'id'		=> 'icon_border_style',
				'type'		=> 'checkbox',
				'title'		=> esc_html__( 'Make Icon Area Bordered?', 'mascot-core-digicod' ),
				'desc'		=> '',
				'value'	=> 'on',
			),
			array(
				'id'		=> 'icon_theme_colored',
				'type'		=> 'dropdown',
				'title'		=> esc_html__( 'Make Icon Theme Colored?', 'mascot-core-digicod' ),
				'desc'		=> '',
				'options'	=> mascot_core_digicod_theme_color_list()
			),
			array(
				'id'		=> 'target',
				'type'		=> 'checkbox',
				'title'		=> esc_html__( 'Open Link in New Tab', 'mascot-core-digicod' ),
				'desc'		=> '',
				'value'	=> 'on',
			),

			

			//link 1
			array(
				'id'		=> 'link_1',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Link 1:', 'mascot-core-digicod' ),
				'desc'	=> '',
			),
			array(
				'id'		=> 'link_1_network',
				'type'		=> 'dropdown',
				'title'		=> esc_html__( 'Choose Social Network:', 'mascot-core-digicod' ),
				'desc'		=> '',
				'width'		=> 'auto',
				'options'	=> $social_array
			),
			array(
				'id'		=> 'link_1_line',
				'type'		=> 'line',
			),

			

			//link 2
			array(
				'id'		=> 'link_2',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Link 2:', 'mascot-core-digicod' ),
				'desc'	=> '',
			),
			array(
				'id'		=> 'link_2_network',
				'type'		=> 'dropdown',
				'title'		=> esc_html__( 'Choose Social Network:', 'mascot-core-digicod' ),
				'desc'		=> '',
				'width'		=> 'auto',
				'options'	=> $social_array
			),
			array(
				'id'		=> 'link_2_line',
				'type'		=> 'line',
			),

			

			//link 3
			array(
				'id'		=> 'link_3',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Link 3:', 'mascot-core-digicod' ),
				'desc'	=> '',
			),
			array(
				'id'		=> 'link_3_network',
				'type'		=> 'dropdown',
				'title'		=> esc_html__( 'Choose Social Network:', 'mascot-core-digicod' ),
				'desc'		=> '',
				'width'		=> 'auto',
				'options'	=> $social_array
			),
			array(
				'id'		=> 'link_3_line',
				'type'		=> 'line',
			),

			

			//link 4
			array(
				'id'		=> 'link_4',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Link 4:', 'mascot-core-digicod' ),
				'desc'	=> '',
			),
			array(
				'id'		=> 'link_4_network',
				'type'		=> 'dropdown',
				'title'		=> esc_html__( 'Choose Social Network:', 'mascot-core-digicod' ),
				'desc'		=> '',
				'width'		=> 'auto',
				'options'	=> $social_array
			),
			array(
				'id'		=> 'link_4_line',
				'type'		=> 'line',
			),

			

			//link 5
			array(
				'id'		=> 'link_5',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Link 5:', 'mascot-core-digicod' ),
				'desc'	=> '',
			),
			array(
				'id'		=> 'link_5_network',
				'type'		=> 'dropdown',
				'title'		=> esc_html__( 'Choose Social Network:', 'mascot-core-digicod' ),
				'desc'		=> '',
				'width'		=> 'auto',
				'options'	=> $social_array
			),
			array(
				'id'		=> 'link_5_line',
				'type'		=> 'line',
			),

			

			//link 6
			array(
				'id'		=> 'link_6',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Link 6:', 'mascot-core-digicod' ),
				'desc'	=> '',
			),
			array(
				'id'		=> 'link_6_network',
				'type'		=> 'dropdown',
				'title'		=> esc_html__( 'Choose Social Network:', 'mascot-core-digicod' ),
				'desc'		=> '',
				'width'		=> 'auto',
				'options'	=> $social_array
			),
			array(
				'id'		=> 'link_6_line',
				'type'		=> 'line',
			),

			

			//link 7
			array(
				'id'		=> 'link_7',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Link 7:', 'mascot-core-digicod' ),
				'desc'	=> '',
			),
			array(
				'id'		=> 'link_7_network',
				'type'		=> 'dropdown',
				'title'		=> esc_html__( 'Choose Social Network:', 'mascot-core-digicod' ),
				'desc'		=> '',
				'width'		=> 'auto',
				'options'	=> $social_array
			),
			array(
				'id'		=> 'link_7_line',
				'type'		=> 'line',
			),

			

			//link 8
			array(
				'id'		=> 'link_8',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Link 8:', 'mascot-core-digicod' ),
				'desc'	=> '',
			),
			array(
				'id'		=> 'link_8_network',
				'type'		=> 'dropdown',
				'title'		=> esc_html__( 'Choose Social Network:', 'mascot-core-digicod' ),
				'desc'		=> '',
				'width'		=> 'auto',
				'options'	=> $social_array
			),
			array(
				'id'		=> 'link_8_line',
				'type'		=> 'line',
			),

			

			//link 9
			array(
				'id'		=> 'link_9',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Link 9:', 'mascot-core-digicod' ),
				'desc'	=> '',
			),
			array(
				'id'		=> 'link_9_network',
				'type'		=> 'dropdown',
				'title'		=> esc_html__( 'Choose Social Network:', 'mascot-core-digicod' ),
				'desc'		=> '',
				'width'		=> 'auto',
				'options'	=> $social_array
			),
			array(
				'id'		=> 'link_9_line',
				'type'		=> 'line',
			),

			

			//link 10
			array(
				'id'		=> 'link_10',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Link 10:', 'mascot-core-digicod' ),
				'desc'	=> '',
			),
			array(
				'id'		=> 'link_10_network',
				'type'		=> 'dropdown',
				'title'		=> esc_html__( 'Choose Social Network:', 'mascot-core-digicod' ),
				'desc'		=> '',
				'width'		=> 'auto',
				'options'	=> $social_array
			),
			array(
				'id'		=> 'link_10_line',
				'type'		=> 'line',
			),

			

			//link 11
			array(
				'id'		=> 'link_11',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Link 11:', 'mascot-core-digicod' ),
				'desc'	=> '',
			),
			array(
				'id'		=> 'link_11_network',
				'type'		=> 'dropdown',
				'title'		=> esc_html__( 'Choose Social Network:', 'mascot-core-digicod' ),
				'desc'		=> '',
				'width'		=> 'auto',
				'options'	=> $social_array
			),
			array(
				'id'		=> 'link_11_line',
				'type'		=> 'line',
			),

			

			//link 12
			array(
				'id'		=> 'link_12',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Link 12:', 'mascot-core-digicod' ),
				'desc'	=> '',
			),
			array(
				'id'		=> 'link_12_network',
				'type'		=> 'dropdown',
				'title'		=> esc_html__( 'Choose Social Network:', 'mascot-core-digicod' ),
				'desc'		=> '',
				'width'		=> 'auto',
				'options'	=> $social_array
			),
			array(
				'id'		=> 'link_12_line',
				'type'		=> 'line',
			),

			

			//link 13
			array(
				'id'		=> 'link_13',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Link 13:', 'mascot-core-digicod' ),
				'desc'	=> '',
			),
			array(
				'id'		=> 'link_13_network',
				'type'		=> 'dropdown',
				'title'		=> esc_html__( 'Choose Social Network:', 'mascot-core-digicod' ),
				'desc'		=> '',
				'width'		=> 'auto',
				'options'	=> $social_array
			),
			array(
				'id'		=> 'link_13_line',
				'type'		=> 'line',
			),

			

			//link 14
			array(
				'id'		=> 'link_14',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Link 14:', 'mascot-core-digicod' ),
				'desc'	=> '',
			),
			array(
				'id'		=> 'link_14_network',
				'type'		=> 'dropdown',
				'title'		=> esc_html__( 'Choose Social Network:', 'mascot-core-digicod' ),
				'desc'		=> '',
				'width'		=> 'auto',
				'options'	=> $social_array
			),
			array(
				'id'		=> 'link_14_line',
				'type'		=> 'line',
			),

			

			//link 15
			array(
				'id'		=> 'link_15',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Link 15:', 'mascot-core-digicod' ),
				'desc'	=> '',
			),
			array(
				'id'		=> 'link_15_network',
				'type'		=> 'dropdown',
				'title'		=> esc_html__( 'Choose Social Network:', 'mascot-core-digicod' ),
				'desc'		=> '',
				'width'		=> 'auto',
				'options'	=> $social_array
			),
			array(
				'id'		=> 'link_15_line',
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
		$html = mascot_core_digicod_get_widget_template_part( 'social-list-custom', null, 'social-list-custom/tpl', $instance, false );

		echo wp_kses_post($args['after_widget']);
	}
}
}