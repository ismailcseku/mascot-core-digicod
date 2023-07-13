<!-- Project Block -->
<div class="type-projects projects-current-theme6">
	<div class="inner-box">
		<div class="image">
			<?php echo get_the_post_thumbnail( get_the_ID(), $feature_thumb_image_size, array( 'class' => 'img-fullwidth' ) );?>
		</div>
		<div class="info-box">
			<?php if ( $show_title == 'yes' ) : ?>
				<<?php echo esc_attr( $title_tag );?> class="title"><a href="<?php the_permalink();?>"><?php the_title();?></a></<?php echo esc_attr( $title_tag );?>>
			<?php endif; ?>

			<?php if ( $show_excerpt == 'yes' ) : ?>
				<?php if ( empty($excerpt_length) ) { ?>
					<?php $excerpt = get_the_excerpt(); ?>
					<?php if ( !empty($excerpt) ) { ?>
						<div class="excerpt">
							<?php echo esc_html( strip_shortcodes( get_the_excerpt() ) )?>
						</div>
					<?php } ?>
				<?php } else { ?>
					<?php $excerpt = get_the_excerpt(); ?>
					<?php if ( !empty($excerpt) ) { ?>
						<div class="excerpt">
							<?php echo esc_html( digicod_slice_excerpt_by_length( $excerpt, $excerpt_length ) ); ?>
						</div>
					<?php } ?>
				<?php } ?>
			<?php endif; ?>

      <a href="<?php the_permalink();?>" class="read-more"><i class="fas fa-angle-double-right"></i></a>
		</div>
		<?php if ( $show_cat == 'yes' ) : ?>
		<ul class="cat-list">
			<?php include('term-list-each-post.php'); ?>
		</ul>
		<?php endif; ?>
	</div>
</div>
