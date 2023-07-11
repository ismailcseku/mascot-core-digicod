<?php
	$term_slugs_list_string = '';
	if( taxonomy_exists('give_forms_category') ) {
		$term_slugs_list = wp_get_post_terms( get_the_ID(), 'give_forms_category', array("fields" => "slugs") );
		$term_slugs_list_string = implode( ' ', $term_slugs_list );
	}
?>