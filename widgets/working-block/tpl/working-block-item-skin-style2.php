<!-- Working Block Style2-->
<?php $working_item['settings'] = $settings; ?>
<div class="working-block working-block-style2">
  <div class="inner-box">
    <div class="icon-box">
      <?php mascot_core_digicod_get_shortcode_template_part( 'icon-type', $working_item['icon_type'], 'working-block/tpl', $working_item, false );?>
      <span class="count"><?php echo $working_item['count']; ?></span>
    </div>
    <?php mascot_core_digicod_get_shortcode_template_part( 'part-title', null, 'working-block/tpl', $working_item, false );?>
    <?php mascot_core_digicod_get_shortcode_template_part( 'part-content', null, 'working-block/tpl', $working_item, false );?>
    <?php if ( $show_view_details_button == 'yes' ) : ?>
      <?php mascot_core_digicod_get_shortcode_template_part( 'button', null, 'working-block/tpl', $working_item, false );?>
    <?php endif; ?>
  </div>
</div>