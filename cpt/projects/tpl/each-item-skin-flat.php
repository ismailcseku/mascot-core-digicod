<div <?php post_class( 'tm-project' ); ?>>
	<div class="project-skin-flat">
		<div class="thumb">
			<?php echo get_the_post_thumbnail( get_the_ID(), $feature_thumb_image_size, array( 'class' => 'img-fullwidth' ) );?>
		</div>
		<div class="details">
			<?php if ( $show_cat == 'yes' ) : ?>
			<ul class="cat-list">
				<?php include('term-list-each-post.php'); ?>
			</ul>
			<?php endif; ?>
			<?php if ( $show_title == 'yes' ) : ?>
			<<?php echo esc_attr( $title_tag );?> class="title"><a href="<?php the_permalink();?>"><?php the_title();?></a></<?php echo esc_attr( $title_tag );?>>
			<?php endif; ?>
		</div>
	</div>
</div>