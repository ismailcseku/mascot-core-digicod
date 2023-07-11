<div class="type-projects projects-current-theme6">
    <div class="inner-box">
        <div class="image-box">
            <div class="image">
              <a href="<?php the_permalink();?>">

                <?php echo get_the_post_thumbnail( get_the_ID(), $feature_thumb_image_size, array( 'class' => 'img-fullwidth' ) );?>
              </a>
            </div>
            <a href="<?php the_permalink();?>" class="read-more"><i class="fa fa-arrow-right"></i></a>
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
</div>
