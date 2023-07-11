<?php digicod_enqueue_script_owl_carousel(); ?>
<?php $settings['settings'] = $settings; ?>
<?php if ( $service_items_array ) : ?>
	<div class="tm-sc-service tm-service-carousel">
		<!-- Isotope Gallery Grid -->
		<div id="<?php echo esc_attr( $holder_id ) ?>" class="owl-carousel owl-theme tm-owl-carousel-<?php echo esc_attr( $columns );?>col" <?php echo html_entity_decode( esc_attr( implode(' ', $owl_carousel_data_info) ) ) ?>>

			<!-- the loop -->
			<?php foreach (  $service_items_array as $service_item ) { ?>
				<?php $settings['service_item'] = $service_item; ?>
				<div class="slide-owl-wrap">
					<div class="tm-carousel-item service-item">
						<?php mascot_core_digicod_get_shortcode_template_part( 'service-item', $_skin, 'service-block/tpl', $settings, false ); ?>
					</div>
				</div>
				<?php } ?>
			<!-- end of the loop -->
		</div>
		<?php wp_reset_postdata(); ?>
	</div>

<?php else : ?>
	<?php mascot_core_no_posts_match_criteria_text(); ?>
<?php endif; ?>