<!-- Testimonial Block Style7-->
<?php $testimonial_item['settings'] = $settings; ?>
<div class="testimonial-block testimonial-block-style7">
  <div class="testimonial-content">
    <div class="info-box">
      <div class="thumb">
        <?php mascot_core_digicod_get_shortcode_template_part( 'part-thumb', null, 'testimonial-block/tpl', $testimonial_item, false );?>
        <span class="icon fa fa-quote-right"></span>
      </div>
      <?php mascot_core_digicod_get_shortcode_template_part( 'part-name', null, 'testimonial-block/tpl', $testimonial_item, false );?>
      <?php mascot_core_digicod_get_shortcode_template_part( 'part-position', null, 'testimonial-block/tpl', $testimonial_item, false );?>
    </div>
    <div class="content-box">
      <?php mascot_core_digicod_get_shortcode_template_part( 'part-author-text', null, 'testimonial-block/tpl', $testimonial_item, false ); ?>
    </div>
  </div>
</div>