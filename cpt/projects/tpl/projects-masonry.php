<?php $settings['settings'] = $settings; $real_featured_img_size = $settings['feature_thumb_image_size'];?>
<?php if ( $the_query->have_posts() ) : ?>
	<div class="tm-sc-projects tm-sc-projects-masonry <?php echo esc_attr(implode(' ', $classes)); ?>">
		<?php include('filter.php'); ?>

		<!-- Isotope Gallery Grid -->
		<div id="<?php echo esc_attr( $holder_id ) ?>" class="isotope-layout masonry grid-<?php echo esc_attr( $columns ); ?> <?php echo esc_attr( $gutter );?> clearfix">
			<div class="isotope-layout-inner">
				<div class="isotope-item isotope-item-sizer"></div>
	
				<!-- the loop -->
				<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
				<?php include('filter-term-list-each-post.php'); ?>
				<?php
					//masonry image sizes
					$image_size = '';
					if ( isset($project_image_size_array_new[get_the_ID()]) && !empty($project_image_size_array_new[get_the_ID()])) {
						$settings['feature_thumb_image_size'] = $image_size = $project_image_size_array_new[get_the_ID()];

						if($image_size == 'digicod_landscape') {
							$image_size = 'tm-masonry-large-wide';
						} else if($image_size == 'digicod_huge_square') {
							$image_size = 'tm-masonry-large-width-height';
						}
					} else {
						$settings['feature_thumb_image_size'] = $real_featured_img_size;
					}
				?>
				<div class="isotope-item <?php echo esc_attr( $term_slugs_list_string );?> <?php echo esc_attr( $image_size );?>">
					<?php mascot_core_digicod_get_cpt_shortcode_template_part( 'each-item', $_skin, 'projects/tpl', $settings, false ); ?>
				</div>
				<?php endwhile; ?>
				<!-- end of the loop -->
			</div>
		</div>
		<?php wp_reset_postdata(); ?>
	</div>
		

<?php else : ?>
	<?php mascot_core_no_posts_match_criteria_text(); ?>
<?php endif; ?>