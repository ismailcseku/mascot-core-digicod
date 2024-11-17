<div class="tm-sc-give-donation-stats icon-box <?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?>">
	<div class="donation-stats-inner">
		<div class="stats-icon icon <?php echo esc_attr(implode(' ', $icon_classes)); ?>">
			<?php if( $icon_type == 'image' ) { ?>
			<img src="<?php $image = wp_get_attachment_image_src( $image_icon, 'large'); echo esc_url( $image[0] );?>" alt="<?php esc_attr_e( 'Image', 'mascot-core-digicod'); ?>">
			<?php } else { ?>
			<i class="<?php echo esc_attr( ${$icon_pack} );?>"></i>
			<?php } ?>
		</div>
		<div class="stats-info">
			<<?php echo esc_attr( $stat_tag );?> class="stats-info"><?php echo esc_html( $title );?>
			<?php
				switch ( $stat_type ) {
					case 'campaign_count':
						$count_posts = wp_count_posts( 'give_forms' );
						$published_posts = $count_posts->publish;
						echo esc_html( $published_posts );
						# code...
						break;

					case 'campaign_donated_amount':
						$stats = new Give_Payment_Stats();
						switch ( $stat_time_duration ) {
							case 'all_time':
								echo give_currency_filter( give_format_amount( $stats->get_earnings( 0, null ), array( 'sanitize' => false ) ) );

							default:
								echo give_currency_filter( give_format_amount( $stats->get_earnings( 0, $stat_time_duration ), array( 'sanitize' => false ) ) );
								# code...
								break;
						}
						# code...
						break;

					case 'campaign_donor_count':
						$donors_count = count( Give()->donors->get_donors( array( 'number' => 0 ) ) );
						echo esc_html( $donors_count );
						# code...
						break;

					default:
						# code...
						break;
				}
			?>
			</<?php echo esc_attr( $stat_tag );?>>
		</div>
		<div class="stats-text">
			<?php echo wp_kses( $stat_bottomline_text, 'post' );?>
		</div>
	</div>
</div>