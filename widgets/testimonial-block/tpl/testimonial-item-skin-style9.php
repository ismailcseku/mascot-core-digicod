<!-- Testimonial Block Style9-->
<?php $testimonial_item['settings'] = $settings; ?>
<div class="testimonial-block testimonial-block-style9">
  <div class="inner-box">
    <div class="info-box">
      <div class="thumb">
        <?php mascot_core_digicod_get_shortcode_template_part( 'part-thumb', null, 'testimonial-block/tpl', $testimonial_item, false );?>
      </div>
      <?php mascot_core_digicod_get_shortcode_template_part( 'part-name', null, 'testimonial-block/tpl', $testimonial_item, false );?>
      <?php mascot_core_digicod_get_shortcode_template_part( 'part-position', null, 'testimonial-block/tpl', $testimonial_item, false );?>
      <div class="rating">
        <?php mascot_core_digicod_get_shortcode_template_part( 'part-star-rating', null, 'testimonial-block/tpl', $testimonial_item, false );?>
        <span class="rating-count"><?php echo esc_html($testimonial_item['rating']['size']);?></span>
      </div>
    </div>
    <div class="content-box">
      <div class="text">
        <?php mascot_core_digicod_get_shortcode_template_part( 'part-author-text', null, 'testimonial-block/tpl', $testimonial_item, false ); ?>
      </div>
    </div>
  </div>
</div>