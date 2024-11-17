<?php $settings['settings'] = $settings;?>
<div class="tm-sc-info-banner-advanced <?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?>">
	<div class="info-banner-inner">
		<div class="banner-background"></div>
		<div class="banner-background-overlay"></div>

  		<?php if( isset( $floating_banner_image['id'] ) && !empty( $floating_banner_image['id'] ) ): ?>
		<div class="banner-floating-image-wrapper">
			<img src="<?php $image = wp_get_attachment_image_src( $floating_banner_image['id'], $floating_banner_image_size); echo esc_url( $image[0] );?>" alt="<?php esc_attr_e( 'Image', 'mascot-core-digicod'); ?>">
			<?php if( !empty( $overlay_color ) ) { ?>
			<div class="banner-overlay" style="background-color: <?php echo esc_attr( $overlay_color );?>"></div>
			<?php } ?>
		</div>
		<?php endif; ?>


		<div class="info-banner-text-holder-wrapper">
			<div class="info-banner-text-holder">
				<div class="info-banner-text-holder-inner">
					<?php mascot_core_digicod_get_shortcode_shop_template_part( 'subtitle', null, 'info-banner/tpl', $settings, false );?>
					<?php mascot_core_digicod_get_shortcode_shop_template_part( 'title', null, 'info-banner/tpl', $settings, false );?>

					<div class="content-holder">
						<?php mascot_core_digicod_get_shortcode_shop_template_part( 'content', null, 'info-banner/tpl', $settings, false );?>
						<?php if ( $show_view_details_button == 'yes' ) : ?>
						<?php mascot_core_digicod_get_shortcode_shop_template_part( 'button', null, 'info-banner/tpl', $settings, false );?>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>