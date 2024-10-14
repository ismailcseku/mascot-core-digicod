<?php

$days = array(
	'monday' 	=> esc_html__('Monday', 'mascot-core-digicod'),
	'tuesday' 	=> esc_html__('Tuesday', 'mascot-core-digicod'),
	'wednesday' => esc_html__('Wednesday', 'mascot-core-digicod'),
	'thursday' 	=> esc_html__('Thursday', 'mascot-core-digicod'),
	'friday' 	=> esc_html__('Friday', 'mascot-core-digicod'),
	'saturday' 	=> esc_html__('Saturday', 'mascot-core-digicod'),
	'sunday' 	=> esc_html__('Sunday', 'mascot-core-digicod'),
);
?>
<ul class="tm-widget tm-widget-opening-hours opening-hours <?php echo esc_attr( $border_color )?>">
<?php
  // set date variables
  $current_day = strtolower(date('l'));

  foreach( $days as $key => $day ) {
	$day_time = 'day_'.$key;
?>
  <li class="clearfix <?php if( $current_day == $key ) echo "active"; ?>">
	<span><?php echo esc_html( $day ); ?></span>
	<div class="value"><?php echo esc_html( $$day_time ) ?></div>
  </li>
<?php
  }
?>
</ul>