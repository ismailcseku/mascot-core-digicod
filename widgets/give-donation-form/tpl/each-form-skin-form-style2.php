<div class="tm-give-donation-form tm-give-donation-form2">
	<div class="give-donation-form-inner">
		<?php if( $hide_form_progress_goal_block !== 'none' ) { ?>
		<div class="form-progress-goal-block">
			<div class="form-progress-goal-block-inner">
				<div class="form-progress-goal-header-text">
					<?php if ( $heading_sub_title ) { ?>
					<<?php echo esc_attr( $heading_subtitle_tag );?> class="subtitle">
						<?php echo esc_html( $heading_sub_title );?>
					</<?php echo esc_attr( $heading_subtitle_tag );?>>
					<?php } ?>

					<?php if ( $heading_title ) { ?>
					<<?php echo esc_attr( $heading_title_tag );?> class="title">
						<?php echo esc_html( $heading_title );?>
					</<?php echo esc_attr( $heading_title_tag );?>>
					<?php } ?>
					<?php if ( $heading_description ) { ?>
					<div class="description">
						<?php echo esc_html( $heading_description ); ?>
					</div>
					<?php } ?>
				</div>

				<?php
					mascot_core_give_progress_bar($custom_raised, $custom_goal);
				?>

				<div class="give-goal-raised">
					<div class="goal-raised-inner">
						<span class="goal">
							<span class="value"><?php echo esc_html( mascot_core_give_amount_formatted( $custom_goal ) ); ?></span>
							<span class="label"><?php esc_html_e( 'Goal', 'mascot-core-digicod' ); ?></span>
						</span>
						<span class="raised">
							<span class="value"><?php echo esc_html( mascot_core_give_amount_formatted( $custom_raised ) ); ?></span>
							<span class="label"><?php esc_html_e( 'Raised', 'mascot-core-digicod' ); ?></span>
						</span>
					</div>
				</div>

				<?php if ( $show_donate_btn_in_progress_goal_block == 'yes' ) { ?>
				<?php
					$atts = array(
						'id' => $form_id,  // integer.
						'show_title' => false, // boolean.
						'show_goal' => false, // boolean.
						'show_content' => 'none', //above, below, or none
						'display_style' => 'button', //modal, button, and reveal
						'continue_button_title' => '' //string

					);
					echo give_get_donation_form( $atts );
				?>
				<?php } ?>
			</div>
		</div>
		<?php } ?>

		<?php if( $hide_form_block !== 'none' ) { ?>
		<div class="form-block">
			<div class="form-block-inner">
				<div class="form-header-text">
					<?php if ( $form_heading_sub_title ) { ?>
					<<?php echo esc_attr( $form_heading_subtitle_tag );?> class="subtitle">
						<?php echo esc_html( $form_heading_sub_title );?>
					</<?php echo esc_attr( $form_heading_subtitle_tag );?>>
					<?php } ?>
					<?php if ( $form_heading_title ) { ?>
					<<?php echo esc_attr( $form_heading_title_tag );?> class="title">
						<?php echo esc_html( $form_heading_title );?>
					</<?php echo esc_attr( $form_heading_title_tag );?>>
					<?php } ?>
					<?php if ( $form_heading_description ) { ?>
					<div class="description">
						<?php echo esc_html( $form_heading_description ); ?>
					</div>
					<?php } ?>
				</div>
				<?php
					$atts = array(
						'id' => $form_id,  // integer.
						'show_title' => false, // boolean.
						'show_goal' => false, // boolean.
						'show_content' => 'none', //above, below, or none
						'display_style' => 'modal', //modal, button, and reveal
						'continue_button_title' => '' //string

					);
					echo give_get_donation_form( $atts );
				?>
			</div>
		</div>
		<?php } ?>
	</div>
</div>