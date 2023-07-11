<?php if ( ! empty( $meta_options ) ) { ?>
<div class="form-meta">
	<?php if ( in_array('show-created-date', $meta_options) ) : ?>
	<div class="each-meta form-created-date">
		<i class="fa fa-clock-o"></i> <?php echo mascot_core_posted_on_date() ?>
	</div>
	<?php endif; ?>

	<?php if ( in_array('show-category', $meta_options) ) { ?>
	<?php $campaign_category = mascot_core_get_custom_post_type_terms_with_link('give_forms_category');?>
	<?php if ( ! empty( $campaign_category ) ) : ?>
	<div class="each-meta form-category">
		<i class="fa fa-folder-o"></i> <?php echo wp_kses( $campaign_category, 'link' );?>
	</div>
	<?php endif; ?>
	<?php } ?>

	<?php if ( in_array('show-tag', $meta_options) ) { ?>
	<?php $campaign_tag = mascot_core_get_custom_post_type_terms_with_link('give_forms_tag');?>
	<?php if ( ! empty( $campaign_tag ) ) : ?>
	<div class="each-meta form-tag">
		<i class="fa fa-tags"></i> <?php echo wp_kses( $campaign_tag, 'link' );?>
	</div>
	<?php endif; ?>
	<?php } ?>

	<?php if ( in_array('show-form-creator', $meta_options) ) : ?>
	<div class="each-meta form-creator">
		<i class="fa fa-user-circle"></i> <?php echo mascot_core_posted_by(); ?>
	</div>
	<?php endif; ?>
</div>
<?php } ?>