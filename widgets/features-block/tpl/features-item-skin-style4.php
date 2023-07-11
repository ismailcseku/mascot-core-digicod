<!-- Features Block Style4-->
<?php $features_item['settings'] = $settings; ?>
<div class="features-block-style4">
  <div class="icon">
    <?php mascot_core_digicod_get_shortcode_template_part( 'icon-type', $features_item['icon_type'], 'features-block/tpl', $features_item, false );?>
  </div>
  <div class="details">
    <?php mascot_core_digicod_get_shortcode_template_part( 'part-title', null, 'features-block/tpl', $features_item, false );?>
    <?php mascot_core_digicod_get_shortcode_template_part( 'part-content', null, 'features-block/tpl', $features_item, false );?>
  </div>
</div>