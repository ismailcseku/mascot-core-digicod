<!-- News Block Style2 -->
<?php $full_image_url = get_the_post_thumbnail_url( get_the_ID(), 'medium' ); ?>
<div class="blog-item-current-style2" style="--blog-current-style2-bg-background-image: url('<?php echo esc_url($full_image_url);?>');">
  <div class="entry-content">
    <?php if ( $show_post_meta == 'yes' ) : ?>
      <?php
      $post_meta_options_array = explode(',', $post_meta_options);
      if ( in_array( $show_post_meta_over_featured_image, $post_meta_options_array ) ) {
        ?>
        <div class="post-single-meta">
          <?php digicod_post_shortcode_single_meta( $show_post_meta_over_featured_image ); ?>
        </div>
        <?php
      }
      ?>
    <?php endif; ?>
    <?php if ( $show_title == 'yes' ) : ?>
      <div class="title-holder">
        <?php the_title( '<'.esc_attr( $title_tag ).' class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></'.esc_attr( $title_tag ).'>' ); ?>
      </div>
    <?php endif; ?>
    <?php if ( $show_excerpt == 'yes' ) : ?>
      <div class="post-excerpt">
        <?php if ( empty($excerpt_length) ) { ?>
          <?php digicod_get_excerpt(); ?>
        <?php } else { ?>
          <?php digicod_get_excerpt($excerpt_length); ?>
        <?php } ?>
      </div>
    <?php endif; ?>
    <?php if ( $show_view_details_button == 'yes' ) : ?>
			<?php mascot_core_digicod_get_cpt_shortcode_template_part( 'button', null, 'blog/tpl/post-format', $settings, false );?>
    <?php endif; ?>
  </div>
  <div class="clearfix"></div>
</div>