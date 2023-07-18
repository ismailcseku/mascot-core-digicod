<!-- Counter block Five -->
<?php $settings['settings'] = $settings;?>
<div class="counter-block-five mascot-counter">
	<div class="inner">
		<?php if ( $show_icon_image == 'yes' ): ?>
			<?php mascot_core_digicod_get_shortcode_template_part( 'icon-type', $icon_type, 'counter-block/tpl', $settings, false );?>
		<?php endif;?>
	    <div class="count-box">
				<?php if ( $show_counter == 'yes' ): ?>
					<?php mascot_core_digicod_get_shortcode_template_part( 'counter', null, 'counter-block/tpl', $settings, false );?>
				<?php endif;?>
				<?php if ( $show_title == 'yes' ): ?>
					<?php mascot_core_digicod_get_shortcode_template_part( 'title', null, 'counter-block/tpl', $settings, false );?>
				<?php endif;?>
	    </div>
	</div>
</div>
