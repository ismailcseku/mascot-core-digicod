<div class="type-projects projects-current-theme5">
  <div class="inner-box">
    <a href="<?php the_permalink();?>" class="image-box">
      <?php echo get_the_post_thumbnail( get_the_ID(), $feature_thumb_image_size, array( 'class' => 'img-fullwidth' ) );?>
    </a>
    <div class="info-box">
      <?php if ( $show_title == 'yes' ) : ?>
        <<?php echo esc_attr( $title_tag );?> class="title"><a href="<?php the_permalink();?>"><?php the_title();?></a></<?php echo esc_attr( $title_tag );?>>
      <?php endif; ?>

      <?php mascot_core_digicod_get_cpt_shortcode_template_part( 'part-excerpt', null, 'projects/tpl', $settings, false );?>

      <?php if ( $show_cat == 'yes' ) : ?>
        <ul class="cat-list">
          <?php include('term-list-each-post.php'); ?>
        </ul>
      <?php endif; ?>
    </div>
  </div>
</div>
