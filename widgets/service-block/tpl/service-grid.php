<?php $settings['settings'] = $settings; ?>
<?php if ( $service_items_array ) : ?>
	<div class="tm-sc-service tm-service-grid">
		<!-- Isotope Gallery Grid -->
		<div id="<?php echo esc_attr( $holder_id ) ?>" class="isotope-layout grid-<?php echo esc_attr( $columns ); ?> <?php echo esc_attr( $gutter );?> clearfix">
			<div class="isotope-layout-inner">
				<!-- the loop -->
				<?php foreach (  $service_items_array as $service_item ) { ?>
				<?php $settings['service_item'] = $service_item; ?>
				<div class="isotope-item service-item">
					<?php mascot_core_digicod_get_shortcode_template_part( 'service-item', $_skin, 'service-block/tpl', $settings, false ); ?>
				</div>
				<?php } ?>
				<!-- end of the loop -->
			</div>
		</div>
		<?php wp_reset_postdata(); ?>
	</div>

<?php else : ?>
	<?php mascot_core_no_posts_match_criteria_text(); ?>
<?php endif; ?>