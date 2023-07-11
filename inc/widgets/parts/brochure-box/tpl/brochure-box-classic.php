<a class="tm-widget tm-widget-brochure-box tm-widget-brochure-box-classic brochure-box <?php echo esc_attr( $visual_style );?> <?php if($brochure_box_dark_version && empty($brochure_box_theme_colored)) echo 'brochure-box-dark-version';?> <?php if( !empty($brochure_box_theme_colored) ) { echo esc_attr( 'brochure-box-theme-colored' . $brochure_box_theme_colored ); }?> <?php echo esc_attr( $custom_css_class );?>" <?php if($target) echo 'target="_blank"';?> href="<?php echo esc_url( $file_url );?>">
  <h5 class="text"><?php echo esc_html( $text );?></h5>
  <i class="brochure-icon <?php echo esc_attr( $icon );?>"></i>
</a>