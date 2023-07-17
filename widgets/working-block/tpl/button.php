<div class="btn-view-details <?php echo esc_attr( $settings['button_alignment'] );?>">
    <a
      <?php echo $target = $working_block_link['is_external'] ? ' target="_blank"' : '';?>
      href="<?php echo esc_url( $working_block_link['url'] );?>"
      class="<?php echo esc_attr(implode(' ', $settings['btn_classes'])); ?>">
      <?php echo esc_html( $settings['view_details_button_text']  ); ?>
    </a>
</div>