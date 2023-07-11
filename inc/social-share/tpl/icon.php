
	<ul class="styled-icons <?php echo esc_attr( $social_links_animation_effect );?> <?php echo esc_attr( $social_links_icon_color );?> <?php if( $social_links_icon_border_style ) { echo 'icon-bordered'; }?> <?php echo esc_attr( $social_links_icon_style );?> <?php if( !empty($social_links_icon_theme_colored) ) { echo esc_attr( 'icon-theme-colored' . $social_links_icon_theme_colored ); }?> <?php echo esc_attr( $social_links_icon_size );?>">
		<?php foreach ( $enabled_social_networks as $key => $value ) { if ( $key != "placebo" ) { ?>
		<li><a target="_blank" <?php if ( $tooltip_directions != 'none' ) { ?> data-toggle="tooltip" data-placement="<?php echo esc_attr( $tooltip_directions );?>"<?php } ?> title="<?php echo esc_attr( $social_network_list[$key]['text'] );?>" class="<?php echo esc_attr( $key );?> styled-icons-item" href="<?php echo esc_url( $social_network_list[$key]['href'] );?>"><i class="fa fa-<?php echo esc_attr( $social_network_list[$key]['icon'] );?>"></i><?php if( $social_links_animation_effect == 'styled-icons-effect-rollover' ) { ?><i class="fa fa-<?php echo esc_attr( $social_network_list[$key]['icon'] );?>"></i><?php } ?></a></li>
	<?php } } ?>
	</ul>