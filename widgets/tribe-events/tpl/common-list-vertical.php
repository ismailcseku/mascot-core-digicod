
    <div class="event <?php tribe_events_event_classes() ?>">
      <div class="event-left <?php echo esc_attr(implode(' ', $event_left_classes)); ?>">
        <?php if ( has_post_thumbnail() && $skin_vertical_list_show_left_thumb == 'yes' ) : ?>
        <div class="event-thumb">
          <?php echo tribe_event_featured_image( null, $skin_vertical_list_left_thumb_image_size ); ?>
        </div>
        <?php endif; ?>
        
        <?php if ( $skin_vertical_list_show_left_date == 'yes' &&  $skin_vertical_list_left_date_placement == 'left'  ) : ?>
        <?php mascot_core_digicod_get_shortcode_template_part( 'left-date-block', null, 'tribe-events/tpl', $params, false );?>
        <?php endif; ?>
      </div>
      <div class="event-content media-body">
        <?php mascot_core_digicod_get_shortcode_template_part( 'parts-event-content', null, 'tribe-events/tpl', $params, false );?>
      </div>
      <?php if ( $skin_vertical_list_show_left_date == 'yes' &&  $skin_vertical_list_left_date_placement == 'right'  ) : ?>
      <div class="event-left event-right">
        <?php mascot_core_digicod_get_shortcode_template_part( 'left-date-block', null, 'tribe-events/tpl', $params, false );?>
      </div>
      <?php endif; ?>
    </div>