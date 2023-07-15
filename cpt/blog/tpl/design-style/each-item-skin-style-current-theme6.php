<!-- News Block Style3 -->
<div class="blog-item-current-style3">
  <?php if ( $show_featured_image == 'yes' ) : ?>
  <div class="entry-header">
    <?php digicod_get_post_thumbnail( $post_format, $featured_image_size ); ?>
  </div>
  <?php endif; ?>
  <div class="entry-content">
    <a href="<?php the_permalink();?>" class="icon-btn"><i class="fas fa-arrow-right"></i></a>
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
    <?php if ( $show_post_meta == 'yes' ) : ?>
			<?php digicod_post_shortcode_meta( $post_meta_options, array( $show_post_meta_over_featured_image ) ); ?>
		<?php endif; ?>
  </div>
  <div class="clearfix"></div>
</div>