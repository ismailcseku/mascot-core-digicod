<?php $settings['settings'] = $settings; ?>
<?php if ( $team_items_array ) : ?>
	<div class="tm-sc-team tm-team-masonry">
		<!-- Isotope Gallery Grid -->
		<div id="<?php echo esc_attr( $holder_id ) ?>" class="isotope-layout masonry grid-<?php echo esc_attr( $columns ); ?> <?php echo esc_attr( $gutter );?> clearfix">
			<div class="isotope-layout-inner">
        		<div class="isotope-item isotope-item-sizer"></div>
				<!-- the loop -->
				<?php foreach (  $team_items_array as $team_item ) { ?>
				<?php $settings['team_item'] = $team_item; ?>
				<div class="isotope-item team-item <?php echo esc_attr( $term_slugs_list_string );?>">
					<?php mascot_core_digicod_get_shortcode_template_part( 'team-item', $_skin, 'team-block/tpl', $settings, false ); ?>
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