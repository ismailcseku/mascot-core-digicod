<?php
	//link url
	$target = ( $features_link && $features_link['is_external'] ) ? ' target="_blank"' : '';
	$url = ( $features_link && $features_link['url'] ) ? $features_link['url'] : '';
?>

	<?php if( !empty( $title ) ) : ?>
	<<?php echo esc_attr( $title_tag );?> class="features-title">
		<?php if( !empty( $url ) ): ?>
		<a
			<?php echo $target;?>
			href="<?php echo esc_url( $url );?>">
			<?php echo $title;?>
		</a>
		<?php else: ?>
			<?php echo $title;?>
		<?php endif ?>
	</<?php echo esc_attr( $title_tag );?>>
	<?php endif; ?>