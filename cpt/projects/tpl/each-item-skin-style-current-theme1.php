<!-- Project Block -->
<div class="type-projects projects-current-theme1">
	<div class="img-holder">
		<?php echo get_the_post_thumbnail( get_the_ID(), $feature_thumb_image_size, array( 'class' => 'img-fullwidth' ) );?>
		<a href="<?php the_permalink();?>" class="project-hover lightbox-image">
			<div class="hover-content">
				<i class="fas fa-plus"></i>
			</div>
		</a>
	</div>
	<div class="text">
		<?php if ( $show_title == 'yes' ) : ?>
			<<?php echo esc_attr( $title_tag );?> class="title"><a href="<?php the_permalink();?>"><?php the_title();?></a></<?php echo esc_attr( $title_tag );?>>
		<?php endif; ?>
	</div>

	<?php if ( $show_cat == 'yes' ) : ?>
	<ul class="cat-list">
		<?php include('term-list-each-post.php'); ?>
	</ul>
	<?php endif; ?>

	<?php mascot_core_digicod_get_cpt_shortcode_template_part( 'part-excerpt', null, 'projects/tpl', $settings, false );?>
</div>