
<?php 
  wp_enqueue_script( 'jquery-bxslider' );
  wp_enqueue_style( 'jquery-bxslider' );
?>
<?php if ( $the_query->have_posts() ) : ?>
  <div id="<?php echo esc_attr( $holder_id ) ?>" class="tm-sc-tribe-events tm-sc-tribe-events-vertical-list1 tm-sc-tribe-events-list-vertical-slide <?php echo esc_attr(implode(' ', $classes)); ?>">
    <div class="bxslider" data-minslides="<?php echo esc_attr( $skin_vertical_list1_slide_minslides ); ?>" data-autoplay="<?php echo esc_attr( $skin_vertical_list1_slide_autoplay ); ?>">
      <!-- the loop -->
      <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
        <div class="event <?php tribe_events_event_classes() ?>">
          <div class="event-left <?php echo esc_attr(implode(' ', $event_left_classes)); ?>">
            <?php if ( has_post_thumbnail() && $skin_vertical_list1_show_left_thumb == 'yes' ) : ?>
            <div class="event-thumb">
              <?php echo tribe_event_featured_image( null, $skin_vertical_list1_left_thumb_image_size ); ?>
            </div>
            <?php endif; ?>
            
            <?php if ( $skin_vertical_list1_show_left_date == 'yes' &&  $skin_vertical_list1_left_date_placement == 'left'  ) : ?>
            <?php mascot_core_digicod_get_shortcode_template_part( 'left-date-block', null, 'tribe-events/tpl', $params, false );?>
            <?php endif; ?>
          </div>
          <div class="event-content">
            <?php if ( $show_single_date_meta == 'yes'  ) { ?>
            <div class="event-single-meta-date">
              <?php if ( $show_single_date_meta_options == 'show-date' || $show_single_date_meta_options == 'show-full-date' ) : ?>
              <span class="day"><?php echo tribe_get_start_date( get_the_ID(), false, $date_single_meta_date_format_day ) ?></span>
              <span class="month"><?php echo tribe_get_start_date( get_the_ID(), false, $date_single_meta_date_format_month ) ?></span>
              <span class="year"><?php echo tribe_get_start_date( get_the_ID(), false, $date_single_meta_date_format_year ) ?></span>
              <?php endif; ?>
              <?php if ( $show_single_date_meta_options == 'show-time' || $show_single_date_meta_options == 'show-full-date' ) : ?>
              <?php echo tribe_get_start_date(null, false, get_option( 'time_format' ) ) . tribe_get_option( 'timeRangeSeparator', ' - ' ) . tribe_get_end_date(null, false, get_option( 'time_format' ) ) ;?>
              <?php endif; ?>
            </div>
            <?php } ?>


            <?php if ( $show_meta == 'yes' &&  $post_meta_placement == 'top'  ) : ?>
            <?php mascot_core_digicod_get_shortcode_template_part( 'parts-event-meta', null, 'tribe-events/tpl', $params, false );?>
            <?php endif; ?>

            
            <?php if ( $show_title == 'yes' ) : ?>
            <<?php echo esc_attr( $title_tag );?> class="event-title">
              <a href="<?php echo esc_url( tribe_get_event_link() ); ?>" title="<?php the_title_attribute(); ?>">
              <?php the_title() ?>
              </a>
            </<?php echo esc_attr( $title_tag );?>>
            <?php endif; ?>

            <?php if ( $show_meta == 'yes' &&  $post_meta_placement == 'center'  ) : ?>
            <?php mascot_core_digicod_get_shortcode_template_part( 'parts-event-meta', null, 'tribe-events/tpl', $params, false );?>
            <?php endif; ?>

            <?php if ( $show_excerpt == 'yes' ) : ?>
            <div class="event-excerpt">
              <?php if ( empty($excerpt_length) ) { ?>
              <?php the_excerpt(); ?>
              <?php } else { ?>
              <?php $excerpt = get_the_excerpt(); echo esc_html( digicod_slice_excerpt_by_length( $excerpt, $excerpt_length ) ); ?>
              <?php } ?>
            </div>
            <?php endif; ?>

            <?php if ( $show_meta == 'yes' &&  $post_meta_placement == 'bottom'  ) : ?>
            <?php mascot_core_digicod_get_shortcode_template_part( 'parts-event-meta', null, 'tribe-events/tpl', $params, false );?>
            <?php endif; ?>

            <?php if ( $show_view_details_button == 'yes' ) : ?>
            <?php mascot_core_digicod_get_shortcode_template_part( 'button', null, 'tribe-events/tpl', $params, false );?>
            <?php endif; ?>
          </div>
          <?php if ( $skin_vertical_list1_show_left_date == 'yes' &&  $skin_vertical_list1_left_date_placement == 'right'  ) : ?>
          <div class="event-left event-right">
            <?php mascot_core_digicod_get_shortcode_template_part( 'left-date-block', null, 'tribe-events/tpl', $params, false );?>
          </div>
          <?php endif; ?>
        </div>
      <?php endwhile; ?>
      <!-- end of the loop -->
    </div>
  </div>
  <?php wp_reset_postdata(); ?>

<?php else : ?>
  <?php mascot_core_no_posts_match_criteria_text(); ?>
<?php endif; ?>