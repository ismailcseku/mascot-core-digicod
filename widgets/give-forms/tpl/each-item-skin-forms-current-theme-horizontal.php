
				<?php $postid = get_the_ID(); ?>
				<div <?php post_class( 'tm-give-forms-current-theme-horizontal' ); ?>>
					<div class="form-inner">
						<?php if ( $show_thumb == 'yes' && has_post_thumbnail( $postid ) ) : ?>
						<div class="form-thumbnail">
							<a href="<?php the_permalink() ?>"><?php echo get_the_post_thumbnail( $postid, $feature_thumb_image_size, array( 'class' => 'img-fullwidth' ) ); ?></a>
						</div>
						<?php endif; ?>
						<div class="form-content">
							<?php if ( $show_donation_stats == 'yes' ) : ?>
							<?php mascot_core_digicod_get_shortcode_template_part( 'progress-stats', null, 'give-forms/tpl', $params, false );?>
							<?php endif; ?>

							<?php if ( $show_meta == 'yes' ) : ?>
							<?php mascot_core_digicod_get_shortcode_template_part( 'campaigns-meta', null, 'give-forms/tpl', $params, false );?>
							<?php endif; ?>

							<?php if ( $show_title == 'yes' ) : ?>
							<<?php echo esc_attr( $title_tag );?> class="form-title">
								<a href="<?php the_permalink() ?>">
									<?php the_title() ?>
								</a>
							</<?php echo esc_attr( $title_tag );?>>
							<?php endif; ?>

							<?php if ( $show_excerpt == 'yes' ) : ?>
							<div class="form-description">
								<?php if ( empty($excerpt_length) ) { ?>
								<?php $give_form_excerpt = get_the_excerpt(); echo wp_kses( $give_form_excerpt, 'post' ); ?>
								<?php } else { ?>
								<?php $give_form_excerpt = get_the_excerpt(); echo wp_kses( digicod_slice_excerpt_by_length( $give_form_excerpt, $excerpt_length ), 'post' ); ?>
								<?php } ?>
							</div>
							<?php endif; ?>
							<?php mascot_core_digicod_get_shortcode_template_part( 'button', null, 'give-forms/tpl', $params, false );?>
						</div>


						<?php
							//total earning calculation
							$custom_raised = $thisobj->calculate_total_earnings($settings, $postid);
						?>
						<div class="form-chart">
							<div class="tm-sc-pie-chart">
								<div class="pie-chart"
									data-bar-color="<?php echo esc_attr( $thisparent->get_instance_value_skin( 'barcolor' ) ); ?>"
									data-track-color="<?php echo esc_attr( $thisparent->get_instance_value_skin( 'trackcolor' ) ); ?>"
									data-scale-color="<?php echo esc_attr( $thisparent->get_instance_value_skin( 'scalecolor' ) ); ?>"

									data-scale-length="<?php echo esc_attr( $thisparent->get_instance_value_skin( 'scalelength' ) ); ?>"
									data-line-cap="<?php echo esc_attr( $thisparent->get_instance_value_skin( 'linecap' ) ); ?>"
									data-line-width="<?php echo esc_attr( $thisparent->get_instance_value_skin( 'linewidth' ) ); ?>"
									data-size="<?php echo esc_attr( $thisparent->get_instance_value_skin( 'size' ) ); ?>"

									data-percent="<?php echo esc_attr( $custom_raised ); ?>"
									<?php echo wp_kses_post( $box_inline_css );?>
									>
									<span class="percent"></span>
								</div>
							</div>
						</div>
					</div>
				</div>