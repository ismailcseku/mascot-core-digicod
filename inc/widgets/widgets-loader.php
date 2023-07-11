<?php

//load lib
require_once MASCOT_CORE_DIGICOD_ABS_PATH . '/inc/widgets/lib/abstract-widgets.php';

/* Loads all widgets located in widgets folder
================================================== */
if( !function_exists('mascot_core_digicod_load_all_widgets') ) {
	function mascot_core_digicod_load_all_widgets() {
		foreach( glob(MASCOT_CORE_DIGICOD_ABS_PATH.'/inc/widgets/parts/*/loader.php') as $each_sc_loader ) {
			require_once $each_sc_loader;
		}
		require_once MASCOT_CORE_DIGICOD_ABS_PATH . '/inc/widgets/parts/reg-widgets.php';
	}
	add_action('widgets_init', 'mascot_core_digicod_load_all_widgets');
}
remove_filter('widget_text_content', 'wpautop');