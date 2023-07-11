<?php mascot_core_wp_enqueue_script_owl_carousel(); ?>
<?php if ( $the_query->have_posts() ) : ?>
  <div class="tm-sc-give-forms tm-sc-give-forms-horizontal tm-sc-give-forms-horizontal-carousel <?php echo esc_attr(implode(' ', $classes)); ?> <?php echo esc_attr( $equal_height_class );?>">
    <div class="owl-carousel owl-theme tm-owl-carousel-1col" <?php echo html_entity_decode( esc_attr( implode(' ', $owl_carousel_data_info) ) ) ?>>
    <!-- the loop -->
    <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
      <?php $postid = get_the_ID(); ?>
      <div <?php post_class( 'give-form' ); ?>>
        <div class="form-inner">
          <div class="row">
            <?php if ( $show_thumb == 'yes' && has_post_thumbnail( $postid ) ) : ?>
            <div class="col-md-6">
              <div class="form-thumbnail">
                <a href="<?php the_permalink() ?>"><?php echo get_the_post_thumbnail( $postid, $feature_thumb_image_size, array( 'class' => 'img-fullwidth' ) ); ?></a>
              </div>
            </div>
            <div class="col-md-6">
            <?php else: ?>
            <div class="col-md-12">
            <?php endif; ?>
              <?php mascot_core_digicod_get_shortcode_template_part( 'common-content', null, 'give-forms/tpl', $params, false );?>
            </div>
          </div>
        </div>
      </div>

    <?php endwhile; ?>
    <!-- end of the loop -->
    </div>
  </div>
  <?php wp_reset_postdata(); ?>

<?php else : ?>
  <?php mascot_core_no_posts_match_criteria_text(); ?>
<?php endif; ?>