<div class="blog-skin-style6">
	<?php if ( $show_featured_image == 'yes' ) : ?>
		<div class="entry-header">
			<?php digicod_get_post_thumbnail( $post_format, $featured_image_size ); ?>
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
		</div>
	<?php endif; ?>
	<div class="entry-content">

		<?php if ( $show_post_meta == 'yes' ) : ?>
			<?php digicod_post_shortcode_meta( $post_meta_options, array( $show_post_meta_over_featured_image ) ); ?>
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
			<div class="post-btn-readmore"> <a href="<?php echo esc_url( get_permalink() )?>" class="btn-plain-text-with-arrow-current-style"><i class="fas fa-long-arrow-alt-right"></i></a></div>
		<?php endif; ?>

		<div class="clearfix"></div>
	</div>
</div>