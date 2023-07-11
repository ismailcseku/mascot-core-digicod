<?php if ( $the_query->have_posts() ) : ?>
  <div class="tm-sc-tribe-events events-fullwidth-style1 <?php echo esc_attr(implode(' ', $classes)); ?>">
    <!-- the loop -->
    <div id="<?php echo esc_attr( $holder_id ) ?>" class="clearfix">
      <div class="row">
        <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
        <div class="col-md-12">
          <div class="event <?php tribe_events_event_classes() ?>">
            <div class="event-wrapper">
              <?php if ( $skin_fullwidth_style1_show_left_date == 'yes' &&  $skin_fullwidth_style1_left_date_placement == 'left' ) : ?>
              <div class="event-date">
                <span class="day"><?php echo tribe_get_start_date( get_the_ID(), false, $skin_fullwidth_style1_date_single_meta_date_format_day ) ?></span>
                <span class="month"><?php echo tribe_get_start_date( get_the_ID(), false, $skin_fullwidth_style1_date_single_meta_date_format_month ) ?></span>
                <span class="year"><?php echo tribe_get_start_date( get_the_ID(), false, $skin_fullwidth_style1_date_single_meta_date_format_year ) ?></span>
              </div>
              <?php endif; ?>

              <?php if ( has_post_thumbnail() && $skin_fullwidth_style1_show_left_thumb == 'yes' ) : ?>
              <div class="event-thumb">
                <?php echo tribe_event_featured_image( null, $skin_fullwidth_style1_left_thumb_image_size ); ?>
              </div>
              <?php endif; ?>


              <div class="event-content">
                <?php if ( $show_meta == 'yes' &&  $post_meta_placement == 'top'  ) : ?>
                <?php mascot_core_digicod_get_shortcode_template_part( 'parts-event-meta', null, 'tribe-events/tpl', $params, false );?>
                <?php endif; ?>


                <?php if ( in_array('show-cat', $meta_options) ) : ?>
                <div class="event-cat-single">
                  <ul class="event-cat">
                  <?php
                  echo tribe_get_event_taxonomy();
                  ?>
                  </ul>
                </div>
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
              </div>

              
              <?php if ( $skin_fullwidth_style1_show_left_date == 'yes' &&  $skin_fullwidth_style1_left_date_placement == 'right' ) : ?>
              <div class="event-date">
                <span class="day"><?php echo tribe_get_start_date( get_the_ID(), false, $skin_fullwidth_style1_date_single_meta_date_format_day ) ?></span>
                <span class="month"><?php echo tribe_get_start_date( get_the_ID(), false, $skin_fullwidth_style1_date_single_meta_date_format_month ) ?></span>
                <span class="year"><?php echo tribe_get_start_date( get_the_ID(), false, $skin_fullwidth_style1_date_single_meta_date_format_year ) ?></span>
              </div>
              <?php endif; ?>


              <?php if ( $show_view_details_button == 'yes' ) : ?>
              <div class="event-button">
                <?php mascot_core_digicod_get_shortcode_template_part( 'button', null, 'tribe-events/tpl', $params, false );?>
              </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <?php endwhile; ?>
        <!-- end of the loop -->
      </div>
    </div>
  </div>
  <?php wp_reset_postdata(); ?>
    

<?php else : ?>
  <?php mascot_core_no_posts_match_criteria_text(); ?>
<?php endif; ?>