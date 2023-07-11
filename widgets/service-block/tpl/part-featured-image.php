<div class="service-featured-img">
	<img src="<?php $image = wp_get_attachment_image_src( $featured_image['id'], $featured_image_size); echo esc_url( $image[0] );?>" alt="<?php esc_attr_e( 'Image', 'mascot-core-digicod'); ?>">
</div>