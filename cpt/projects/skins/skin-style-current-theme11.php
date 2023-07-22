<?php
namespace MascotCoreDigicod\Widgets\Projects\Skins;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Skin_Base as Elementor_Skin_Base;

use MASCOTCOREDIGICOD\Lib;
use MASCOTCOREDIGICOD\CPT\Projects\CPT_Projects;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Style_Current_Theme11 extends Elementor_Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/tm-ele-cpt-projects/general/after_section_end', [ $this, 'register_layout_controls' ] );
	}

	public function get_id() {
		return 'skin-style-current-theme11';
	}


	public function get_title() {
		return __( 'Skin - Style Current Theme11', 'mascot-core-digicod' );
	}


	public function register_layout_controls( Widget_Base $widget ) {
		$this->parent = $widget;

		//Current Background Styling
		$this->start_controls_section(
			'current_background_styling',
			[
				'label' => esc_html__( 'Current Background Styling', 'mascot-core-digicod' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs('tabs_current_style');
		$this->start_controls_tab(
			'tabs_current_style_normal',
			[
				'label' => esc_html__('Normal', 'mascot-core-digicod'),
			]
		);
		$this->add_responsive_control(
			'content_wrapper_custom_bg_color',
			[
				'label' => esc_html__( "Custom Background Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .projects-current-theme11 .content-box' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'content_wrapper_icon_theme_colored',
			[
				'label' => esc_html__( "Make BG Theme Colored", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .projects-current-theme11 .content-box' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_tab();


		$this->start_controls_tab(
			'tabs_current_style_hover',
			[
				'label' => esc_html__('Hover', 'mascot-core-digicod'),
			]
		);
		$this->add_responsive_control(
			'content_wrapper_custom_bg_color_hover',
			[
				'label' => esc_html__( "Custom Background Color (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .projects-current-theme11 .inner-box:hover .content-box' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'content_wrapper_theme_colored_hover',
			[
				'label' => esc_html__( "Make BG Theme Colored (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => mascot_core_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .projects-current-theme11 .inner-box:hover .content-box' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();


		//Current Button Styling
		$this->start_controls_section(
			'current_button_styling',
			[
				'label' => esc_html__( 'Current Skin Button Styling', 'mascot-core-digicod' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs('tabs_button_current_style');
		$this->start_controls_tab(
			'tabs_current_button_style_normal',
			[
				'label' => esc_html__('Normal', 'mascot-core-digicod'),
			]
		);
		$this->add_responsive_control(
			'custom_button_bg_color',
			[
				'label' => esc_html__( "Custom Button BG Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .projects-current-theme11 .read-more' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'custom_button_icon_color',
			[
				'label' => esc_html__( "Custom Button Icon Color", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .projects-current-theme11 .read-more' => 'color: {{VALUE}};'
				],
			]
		);
		$this->end_controls_tab();


		$this->start_controls_tab(
			'custom_button_bg_color_hover',
			[
				'label' => esc_html__('Hover', 'mascot-core-digicod'),
			]
		);
		$this->add_responsive_control(
			'custom_button_icon_color_hover',
			[
				'label' => esc_html__( "Custom Background Color (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .projects-current-theme11 .read-more:hover' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'custom_button_icon_theme_color_hover',
			[
				'label' => esc_html__( "Custom Button Icon Color (Hover)", 'mascot-core-digicod' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .projects-current-theme11 .read-more:hover' => 'color: {{VALUE}};'
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	public function render() {
		$settings = $this->parent->get_settings_for_display();

		$new_cpt_class = CPT_Projects::Instance();
		$class_instance =  (array) $new_cpt_class;
		$settings['holder_id'] = digicod_get_isotope_holder_ID('projects');

		$project_image_size_array_new = array();
		if ( $settings['project_image_size_array'] ) :
			foreach (  $settings['project_image_size_array'] as $each_item ) {
				$project_image_size_array_new[$each_item['image_for_project']] = $each_item['image_size'];
			}
		endif;
		$settings['project_image_size_array_new'] = $project_image_size_array_new;

		$this->render_output( $class_instance, $settings );
	}

	public function render_output( $class_instance, $settings ) {
		$new_cpt_class = $class_instance;

		$settings['the_query'] = $this->parent->query_posts($new_cpt_class);

		//classes
		$classes = array();
		if( $settings['add_border_radius'] ) {
			$classes[] = 'border-radius-around-box';
		}
		$settings['classes'] = $classes;

		//button classes
		$settings['btn_classes'] = mascot_core_prepare_button_classes_from_params( $settings );

		//ptTaxKey
		$settings['ptTaxKey'] = $new_cpt_class['ptTaxKey'];
		//Owl Carousel Data
		$settings['owl_carousel_data_info'] = mascot_core_prepare_owlcarousel_data_from_params( $settings );
		
		$settings['settings'] = $settings;

		$html = mascot_core_digicod_get_cpt_shortcode_template_part( 'projects', $settings['display_type'], 'projects/tpl', $settings, true );

		echo $html;
	}
}
