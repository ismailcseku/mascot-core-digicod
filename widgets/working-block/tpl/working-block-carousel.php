<?php digicod_enqueue_script_owl_carousel(); ?>
<?php $settings['settings'] = $settings; ?>
<?php if ( $working_block_items_array ) : ?>
	<div class="tm-sc-features tm-features-carousel">
		<!-- Isotope Gallery Grid -->
		<div id="<?php echo esc_attr( $holder_id ) ?>" class="owl-carousel owl-theme tm-owl-carousel-<?php echo esc_attr( $columns );?>col" <?php echo html_entity_decode( esc_attr( implode(' ', $owl_carousel_data_info) ) ) ?>>

			<!-- the loop -->
			<?php foreach (  $working_block_items_array as $working_item ) { ?>
				<?php $settings['working_item'] = $working_item; ?>
				<div class="slide-owl-wrap">
					<div class="tm-carousel-item working-block">
						<?php mascot_core_digicod_get_shortcode_template_part( 'working-block-item', $_skin, 'working-block/tpl', $settings, false ); ?>
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