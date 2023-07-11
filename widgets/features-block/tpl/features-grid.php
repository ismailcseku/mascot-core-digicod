<?php $settings['settings'] = $settings; ?>
<?php if ( $features_items_array ) : ?>
	<div class="tm-sc-features tm-features-grid">
		<!-- Isotope Gallery Grid -->
		<div id="<?php echo esc_attr( $holder_id ) ?>" class="isotope-layout grid-<?php echo esc_attr( $columns ); ?> <?php echo esc_attr( $gutter );?> clearfix">
			<div class="isotope-layout-inner">
				<!-- the loop -->
				<?php foreach (  $features_items_array as $features_item ) { ?>
				<?php $settings['features_item'] = $features_item; ?>
				<div class="isotope-item features-item">
					<?php mascot_core_digicod_get_shortcode_template_part( 'features-item', $_skin, 'features-block/tpl', $settings, false ); ?>
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