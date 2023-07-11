<!-- Testimonial Block Style2-->
<?php $testimonial_item['settings'] = $settings; ?>
<div class="testimonial-block testimonial-block-style1">
  <div class="testimonial-content">
    <div class="quote-rating d-flex justify-content-between align-items-center">
      <div class="quote">
        <?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' , 'class' => 'icon' ] ); ?>
      </div>
      <div class="rating">
      <?php mascot_core_digicod_get_shortcode_template_part( 'part-title', null, 'testimonial-block/tpl', $testimonial_item, false );?>
      <?php mascot_core_digicod_get_shortcode_template_part( 'part-star-rating', null, 'testimonial-block/tpl', $testimonial_item, false );?>
      </div>
    </div>
    <?php mascot_core_digicod_get_shortcode_template_part( 'part-author-text', null, 'testimonial-block/tpl', $testimonial_item, false ); ?>
    <div class="author-details">
      <?php mascot_core_digicod_get_shortcode_template_part( 'part-name', null, 'testimonial-block/tpl', $testimonial_item, false );?>
      <?php mascot_core_digicod_get_shortcode_template_part( 'part-position', null, 'testimonial-block/tpl', $testimonial_item, false );?>
    </div>
  </div>
</div>