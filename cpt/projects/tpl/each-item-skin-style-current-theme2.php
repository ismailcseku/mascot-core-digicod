<div class="type-projects projects-current-theme2">
	<div class="img-holder">
		<?php echo get_the_post_thumbnail( get_the_ID(), $feature_thumb_image_size, array( 'class' => 'img-fullwidth' ) );?>
		<div class="project-hover">
			<div class="hover-content">
				<?php if ( $show_cat == 'yes' ) : ?>
					<ul class="cat-list">
						<?php
							$terms = get_the_terms(get_the_ID(), $ptTaxKey);
							if ( ! is_wp_error( $terms ) && ! empty( $terms ) ) {
								foreach ($terms as $term) {
									echo '<li><a>'.$term->name.'</a></li>';
								}
							}
						?>
					</ul>
				<?php endif; ?>
				<?php if ( $show_title == 'yes' ) : ?>
					<<?php echo esc_attr( $title_tag );?> class="title"><a href="<?php the_permalink();?>"><?php the_title();?></a></<?php echo esc_attr( $title_tag );?>>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>