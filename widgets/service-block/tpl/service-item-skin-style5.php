<!-- Service Block Style4-->
<?php $service_item['settings'] = $settings; ?>
<div class="service-block-style5">
  <div class="inner-box">
    <div class="icon-box">
      <?php mascot_core_digicod_get_shortcode_template_part( 'icon-type', $service_item['icon_type'], 'service-block/tpl', $service_item, false );?>
    </div>
    <?php mascot_core_digicod_get_shortcode_template_part( 'part-title', null, 'service-block/tpl', $service_item, false );?>
    <?php mascot_core_digicod_get_shortcode_template_part( 'part-content', null, 'service-block/tpl', $service_item, false );?>
    <?php if ( $show_view_details_button == 'yes' ) : ?>
      <?php mascot_core_digicod_get_shortcode_template_part( 'button', null, 'service-block/tpl', $service_item, false );?>
    <?php endif; ?>
  </div>
</div>