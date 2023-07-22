<div class="service-icon icon-img">
	<img src="<?php $image = wp_get_attachment_image_src( $service_icon_image['id'], $service_icon_image_size); echo esc_url( $image[0] );?>" width="<?php echo esc_attr( $image[1] );?>" height="<?php echo esc_attr( $image[2] );?>" alt="<?php esc_attr_e( 'Image', 'mascot-core-digicod'); ?>">
</div>