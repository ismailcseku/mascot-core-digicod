<nav id="top-primary-nav-elementor-<?php echo esc_attr($holder_id)?>" class="menuzord-primary-nav menuzord menuzord-responsive">
<a href='javascript:void(0)' class='showhide'><em></em><em></em><em></em></a>
<?php
	$menu_class = 'menuzord-menu';


	if( $custom_primary_nav_menu != '' ) {
		wp_nav_menu(
			array(
				'menu'				=> $custom_primary_nav_menu,
				'menu_class'		=> $menu_class,
				'menu_id'			=> 'main-nav-' . esc_attr($holder_id), 
				'container'			=> '',
				'link_before'		=> '<span>',
				'link_after'		=> '</span>',
				'walker'			=> new Mascot_Theme_Nav_Walker
			)
		);
	} else if (has_nav_menu('primary'))  {
		wp_nav_menu(
			array(
				'theme_location'	=> 'primary',
				'menu_class'		=> $menu_class,
				'menu_id'			=> 'main-nav-' . esc_attr($holder_id), 
				'container'			=> '',
				'link_before'		=> '<span>',
				'link_after'		=> '</span>',
				'walker'			=> new Mascot_Theme_Nav_Walker
			)
		);
	}
?>
</nav>