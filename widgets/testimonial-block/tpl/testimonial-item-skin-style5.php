<!-- Testimonial Block Style5-->
<?php $testimonial_item['settings'] = $settings; ?>
<div class="testimonial-block testimonial-block-style5">
  <div class="testimonial-content">
    <?php mascot_core_digicod_get_shortcode_template_part( 'part-author-text', null, 'testimonial-block/tpl', $testimonial_item, false ); ?>
    <div class="info-box">
      <div class="thumb">
        <?php mascot_core_digicod_get_shortcode_template_part( 'part-thumb', null, 'testimonial-block/tpl', $testimonial_item, false );?>
      </div>
      <div class="rating">
        <?php mascot_core_digicod_get_shortcode_template_part( 'part-star-rating', null, 'testimonial-block/tpl', $testimonial_item, false );?>
      </div>
      <div class="name-box">
				<?php mascot_core_digicod_get_shortcode_template_part( 'part-name', null, 'testimonial-block/tpl', $testimonial_item, false );?>
        <?php mascot_core_digicod_get_shortcode_template_part( 'part-position', null, 'testimonial-block/tpl', $testimonial_item, false );?>
      </div>
    </div>
  </div>
</div>