
		<div class="form-content">
			<?php if ( $show_title == 'yes' ) : ?>
			<<?php echo esc_attr( $title_tag );?> class="form-title">
				<a href="<?php the_permalink() ?>">
					<?php the_title() ?>
				</a>
			</<?php echo esc_attr( $title_tag );?>>
			<?php endif; ?>

			<?php if ( $show_meta == 'yes' ) : ?>
			<?php mascot_core_digicod_get_shortcode_template_part( 'campaigns-meta', null, 'give-forms/tpl', $params, false );?>
			<?php endif; ?>

			<?php if ( $show_excerpt == 'yes' ) : ?>
			<div class="form-description">  
				<?php if ( empty($excerpt_length) ) { ?>
				<?php $give_form_excerpt = get_the_excerpt(); echo wp_kses( $give_form_excerpt, 'post' ); ?>
				<?php } else { ?>
				<?php $give_form_excerpt = get_the_excerpt(); echo wp_kses( digicod_slice_excerpt_by_length( $give_form_excerpt, $excerpt_length ), 'post' ); ?>
				<?php } ?>
			</div>
			<?php endif; ?>

			<?php if ( $show_progress == 'yes' || $show_donation_stats == 'yes' ) : ?>
			<?php mascot_core_digicod_get_shortcode_template_part( 'progress-bar', null, 'give-forms/tpl', $params, false );?>
			<?php endif; ?>
			
			<?php if ( $show_donation_stats == 'yes' ) : ?>
			<?php //mascot_core_give_campaign_get_donation_summary( $campaign );?>
			<?php endif; ?>

			<?php mascot_core_digicod_get_shortcode_template_part( 'button', null, 'give-forms/tpl', $params, false );?>
		</div>