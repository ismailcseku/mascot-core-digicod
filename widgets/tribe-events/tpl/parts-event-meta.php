        <?php if ( ! empty( $meta_options ) ) { ?>
        <div class="event-meta">
          <?php if ( in_array('show-full-date', $meta_options) ) : ?>
          <div class="each-meta event-schedule-details">
            <i class="fa fa-clock-o"></i> <?php echo tribe_events_event_schedule_details() ?>
          </div>
          <?php endif; ?>

          <?php if ( in_array('show-time', $meta_options) ) : ?>
          <div class="each-meta event-schedule-details">
            <i class="fa fa-clock-o"></i> <?php echo tribe_get_start_date(null, false, get_option( 'time_format' ) ) . tribe_get_option( 'timeRangeSeparator', ' - ' ) . tribe_get_end_date(null, false, get_option( 'time_format' ) ) ;?>
          </div>
          <?php endif; ?>

          <?php if ( in_array('show-venue', $meta_options) ) : ?>
          <?php $venue_details = tribe_get_venue_details(); if ( $venue_details ) : ?>
          <div class="each-meta event-venue">
            <i class="fa fa-map-marker"></i> <?php echo esc_html( $venue_details['linked_name'] ); ?>
          </div>
          <?php endif; ?>
          <?php endif; ?>

          <?php if ( in_array('show-organizer', $meta_options) ) : ?>
          <div class="each-meta event-organizer">
            <i class="fa fa-id-card-o"></i> <?php echo tribe_get_organizer() ?>
          </div>
          <?php endif; ?>

          <?php if ( in_array('show-cat', $meta_options) ) : ?>
          <div class="each-meta event-cat">
            <ul class="event-cat-list">
            <?php
            echo tribe_get_event_taxonomy();
            ?>
            </ul>
          </div>
          <?php endif; ?>
        </div>
        <?php } ?>