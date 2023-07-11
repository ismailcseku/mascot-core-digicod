<div class="tm-give-donation-form tm-give-donation-form-only-btn-goal">
	<div class="give-donation-form-inner">
		<div class="give-goal-raised">
			<div class="goal-raised-inner">
				<span class="goal">
					<span class="label"><?php esc_html_e( 'Goal', 'mascot-core-digicod' ); ?></span>
					<span class="value"><?php echo esc_html( mascot_core_give_amount_formatted( $custom_goal ) ); ?></span>
				</span>
				<span class="raised">
					<span class="label"><?php esc_html_e( 'Raised', 'mascot-core-digicod' ); ?></span>
					<span class="value"><?php echo esc_html( mascot_core_give_amount_formatted( $custom_raised ) ); ?></span>
				</span>
			</div>
		</div>
		<div class="form-block-inner">
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
		</div>
	</div>
</div>