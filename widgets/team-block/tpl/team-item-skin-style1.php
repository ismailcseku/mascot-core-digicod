<!-- Team Block Style1-->
<?php $team_item['settings'] = $settings; ?>
<div class="team-current-theme1 team-item">
  <div class="img-holder">
    <?php mascot_core_digicod_get_shortcode_template_part( 'part-thumb', null, 'team-block/tpl', $team_item, false );?>
    <div class="team-hover">
      <?php mascot_core_digicod_get_shortcode_template_part( 'part-social-links', null, 'team-block/tpl', $team_item, false );?>
    </div>
  </div>
  <div class="text">
    <?php mascot_core_digicod_get_shortcode_template_part( 'part-title', null, 'team-block/tpl', $team_item, false );?>
    <?php mascot_core_digicod_get_shortcode_template_part( 'part-subtitle', null, 'team-block/tpl', $team_item, false );?>
    <?php mascot_core_digicod_get_shortcode_template_part( 'part-short-bio', null, 'team-block/tpl', $team_item, false );?>
  </div>
</div>