<?php
/**
 * The template for displaying Maintenance Mode Page
 *
 * This is the template that displays Maintenance Mode0 page by default.
 *
 */
add_filter( 'digicod_filter_show_header', 'digicod_return_false' );
add_filter( 'digicod_filter_show_footer', 'digicod_return_false' );

//change the page title
if( digicod_get_redux_option( 'maintenance-mode-settings-title' ) != '' ) {
	add_filter('pre_get_document_title', 'digicod_change_the_title');
	function digicod_change_the_title() {
		return digicod_get_redux_option( 'maintenance-mode-settings-title' );
	}
}

get_header();
?>

<?php
if ( mascot_core_digicod_plugin_installed() ) {
	mascot_core_digicod_get_maintenance_mode_parts();
}
?>

<?php get_footer();
