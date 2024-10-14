<?php $postid = get_the_ID(); ?>
<?php
	//total earning calculation
	$custom_raised = $thisobj->calculate_total_earnings($settings, $postid);
?>
<?php
	$form_id = get_the_ID();
	$form  = new Give_Donate_Form( $form_id );
	$goal_progress_stats = give_goal_progress_stats( $form );
	$income = $goal_progress_stats['raw_actual'];
	$goal   = $goal_progress_stats['raw_goal'];
	$form_currency = apply_filters( 'give_goal_form_currency', give_get_currency( $form_id ), $form_id );

	$goal_format_args = apply_filters( 'give_goal_amount_format_args', array(
		'sanitize' => false,
		'currency' => $form_currency,
		'decimal'  => false,
	), $form_id );

	$goal   = give_human_format_large_amount( give_format_amount( $goal, $goal_format_args ), array( 'currency' => $form_currency ) );
	$formatted_goal = give_currency_filter(
		$goal,
		array(
			'form_id' => $form_id,
		)
	);


	$income_format_args = apply_filters( 'give_goal_income_format_args', array(
		'sanitize' => false,
		'currency' => $form_currency,
		'decimal'  => false,
	), $form_id );
	$income = give_human_format_large_amount( give_format_amount( $income, $income_format_args ), array( 'currency' => $form_currency ) );
	$formatted_income = give_currency_filter(
		$income,
		array(
			'form_id' => $form_id,
		)
	);
?>
<div <?php post_class( 'tm-give-forms-style-current-theme1' ); ?>>
	<div class="form-inner">
		<?php if ( $show_thumb == 'yes' && has_post_thumbnail( $postid ) ) : ?>
		<div class="form-thumbnail">
			<a href="<?php the_permalink() ?>"><?php echo get_the_post_thumbnail( $postid, $feature_thumb_image_size, array( 'class' => 'img-fullwidth' ) ); ?></a>
		</div>
		<?php endif; ?>

		<div class="form-content">
			<?php if ( $show_meta == 'yes' ) : ?>
			<?php mascot_core_digicod_get_shortcode_template_part( 'campaigns-meta', null, 'give-forms/tpl', $params, false );?>
			<?php endif; ?>

			<?php if ( $show_title == 'yes' ) : ?>
			<<?php echo esc_attr( $title_tag );?> class="form-title">
				<a href="<?php the_permalink() ?>">
					<?php the_title() ?>
				</a>
			</<?php echo esc_attr( $title_tag );?>>
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
			<?php if ( $show_progress == 'yes' ) : ?>
			<?php mascot_core_digicod_get_shortcode_template_part( 'progress-bar', null, 'give-forms/tpl', $params, false );?>
			<?php endif; ?>
			<div class="donation-info">
				<div class="donation-raised">
					<span class="text"><?php esc_html_e('Raised', 'mascot-core-digicod'); ?></span>
					<span class="value"><?php echo esc_html( $formatted_income ) ?></span>
				</div>
				<div class="donation-goal">
					<span class="text"><?php esc_html_e('Goal', 'mascot-core-digicod'); ?></span>
					<span class="value"><?php echo esc_html( $formatted_goal ) ?></span>
				</div>
			</div>
			<?php mascot_core_digicod_get_shortcode_template_part( 'button', null, 'give-forms/tpl', $params, false );?>
		</div>
	</div>
</div>