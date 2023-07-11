<?php
/**
 * This template is used to display the goal with [give_goal]
 */

$form_id = get_the_ID();
$form        = new Give_Donate_Form( $form_id );
$goal_option = give_get_meta( $form->ID, '_give_goal_option', true );

// Sanity check - ensure form has pass all condition to show goal.
if ( ( isset( $args['show_goal'] ) && ! filter_var( $args['show_goal'], FILTER_VALIDATE_BOOLEAN ) )
     || empty( $form->ID )
     || ( is_singular( 'give_forms' ) && ! give_is_setting_enabled( $goal_option ) )
     || ! give_is_setting_enabled( $goal_option ) || 0 === $form->goal ) {
	return false;
}

$goal_format         = give_get_form_goal_format( $form_id );
$price               = give_get_meta( $form_id, '_give_set_price', true );
$color               = give_get_meta( $form_id, '_give_goal_color', true );
$show_text           = isset( $args['show_text'] ) ? filter_var( $args['show_text'], FILTER_VALIDATE_BOOLEAN ) : true;
$show_bar            = isset( $args['show_bar'] ) ? filter_var( $args['show_bar'], FILTER_VALIDATE_BOOLEAN ) : true;
$goal_progress_stats = give_goal_progress_stats( $form );

$income = $goal_progress_stats['raw_actual'];
$goal   = $goal_progress_stats['raw_goal'];

switch ( $goal_format ) {

	case 'donation':
		$progress           = $goal ? round( ( $income / $goal ) * 100, 2 ) : 0;
		$progress_bar_value = $income >= $goal ? 100 : $progress;
		break;

	case 'donors':
		$progress_bar_value = $goal ? round( ( $income / $goal ) * 100, 2 ) : 0;
		$progress           = $progress_bar_value;
		break;

	case 'percentage':
		$progress           = $goal ? round( ( $income / $goal ) * 100, 2 ) : 0;
		$progress_bar_value = $income >= $goal ? 100 : $progress;
		break;

	default:
		$progress           = $goal ? round( ( $income / $goal ) * 100, 2 ) : 0;
		$progress_bar_value = $income >= $goal ? 100 : $progress;
		break;

}

/**
 * Filter the goal progress output
 *
 * @since 1.8.8
 */
$progress = apply_filters( 'give_goal_amount_funded_percentage_output', $progress, $form_id, $form );
?>
<div class="give-goal-progress-bar">
	<span class="label"><?php esc_html_e( 'Raised', 'mascot-core-digicod' ); ?></span>
	<?php if ( ! empty( $show_bar ) ) : ?>
		<div class="tm-sc-progress-bar" data-percent="<?php echo esc_attr( $progress_bar_value );?>" data-unit-right="%">
			<div class="progress-holder">
				<div class="progress-content"><span class="value"><?php echo esc_html( $progress_bar_value );?>%</span></div>
			</div>
		</div>
	<?php endif; ?>
	<span class="value"><?php echo esc_html( $progress_bar_value );?>%</span>
</div>
