<!-- Features Block Style2-->
<?php $features_item['settings'] = $settings; ?>
<div class="features-block-style3">
  <div class="inner-box">
    <div class="icon-box">
        <?php mascot_core_digicod_get_shortcode_template_part( 'icon-type', $features_item['icon_type'], 'features-block/tpl', $features_item, false );?>
    </div>
    <?php mascot_core_digicod_get_shortcode_template_part( 'part-title', null, 'features-block/tpl', $features_item, false );?>
    <?php mascot_core_digicod_get_shortcode_template_part( 'part-content', null, 'features-block/tpl', $features_item, false );?>
    <?php if ( $show_view_details_button == 'yes' ) : ?>
      <?php mascot_core_digicod_get_shortcode_template_part( 'button', null, 'features-block/tpl', $features_item, false );?>
    <?php endif; ?>
  </div>
</div>