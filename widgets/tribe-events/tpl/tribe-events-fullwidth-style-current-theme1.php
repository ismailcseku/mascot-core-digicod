<?php if ( $the_query->have_posts() ) : ?>

  <div class="tm-sc-tribe-events events-fullwidth-current-theme1 <?php echo esc_attr(implode(' ', $classes)); ?>">
    <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
    <div class="event <?php tribe_events_event_classes() ?>">
      <div class="event-inner">
        <div class="event-left">
          <?php if ( $skin_fullwidth_style_current_theme1_show_left_date == 'yes' &&  $skin_fullwidth_style_current_theme1_left_date_placement == 'left' ) : ?>
          <div class="event-date">
            <span class="day"><?php echo tribe_get_start_date( get_the_ID(), false, $skin_fullwidth_style_current_theme1_date_single_meta_date_format_day ) ?></span>
            <span class="month"><?php echo tribe_get_start_date( get_the_ID(), false, $skin_fullwidth_style_current_theme1_date_single_meta_date_format_month ) ?></span>
            <span class="year"><?php echo tribe_get_start_date( get_the_ID(), false, $skin_fullwidth_style_current_theme1_date_single_meta_date_format_year ) ?></span>
          </div>
          <?php endif; ?>
          <?php if ( has_post_thumbnail() && $skin_fullwidth_style_current_theme1_show_left_thumb == 'yes' ) : ?>
          <div class="event-thumb">
            <?php echo tribe_event_featured_image( null, $feature_thumb_image_size ); ?>
          </div>
          <?php endif; ?>
        </div>
        <div class="event-content">
          <div class="event-text">
            <?php if ( $show_meta == 'yes' ) : ?>
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
            <?php endif; ?>

            <?php if ( $show_title == 'yes' ) : ?>
            <<?php echo esc_attr( $title_tag );?> class="event-title">
              <a href="<?php echo esc_url( tribe_get_event_link() ); ?>" title="<?php the_title_attribute(); ?>">
                <?php the_title() ?>
              </a>
            </<?php echo esc_attr( $title_tag );?>>
            <?php endif; ?>
          </div>

          <?php if ( in_array('show-venue', $meta_options) ) { ?>
          <?php $venue_details = tribe_get_venue_details(); if ( $venue_details ) { ?>
          <div class="event-venue">
            <?php echo esc_html( $venue_details['linked_name'] ); ?>
          </div>
          <?php } ?>
          <?php } ?>

          <?php if ( $show_view_details_button == 'yes' ) : ?>
          <div class="event-button">
            <?php mascot_core_digicod_get_shortcode_template_part( 'button', null, 'tribe-events/tpl', $params, false );?>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
    <?php endwhile; ?>
  </div>
  <?php wp_reset_postdata(); ?>
    

<?php else : ?>
  <?php mascot_core_no_posts_match_criteria_text(); ?>
<?php endif; ?>