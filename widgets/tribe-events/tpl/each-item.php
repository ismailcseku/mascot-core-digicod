
    <div class="event event-skin-style1 <?php tribe_events_event_classes() ?>">
      <?php if ( has_post_thumbnail() && $show_thumb == 'yes' ) : ?>
      <div class="event-thumb">
        <?php echo tribe_event_featured_image( null, $feature_thumb_image_size ); ?>
        <?php if ( ! empty( $meta_options ) ) { ?>
        <?php if ( in_array('show-date-over-image', $meta_options) ) : ?>
        <div class="event-single-meta-date">
          <span class="day"><?php echo tribe_get_start_date( get_the_ID(), false, $date_single_meta_date_format_day ) ?></span>
          <span class="month"><?php echo tribe_get_start_date( get_the_ID(), false, $date_single_meta_date_format_month ) ?></span>
          <span class="year"><?php echo tribe_get_start_date( get_the_ID(), false, $date_single_meta_date_format_year ) ?></span>
        </div>
        <?php endif; ?>
        <?php } ?>
      </div>
      <?php endif; ?>
      <div class="event-content">
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
    </div>
