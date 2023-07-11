<!-- Team Block Style7-->
<?php $team_item['settings'] = $settings; ?>
<div class="team-current-theme7 team-item">
  <div class="inner-box">
    <div class="image-box">
      <div class="image">
        <?php mascot_core_digicod_get_shortcode_template_part( 'part-thumb', null, 'team-block/tpl', $team_item, false );?>
      </div>
      <span class="share-icon fa fa-share-alt"></span>
      <?php mascot_core_digicod_get_shortcode_template_part( 'part-social-links', null, 'team-block/tpl', $team_item, false );?>
    </div>
    <div class="info-box">
      <?php mascot_core_digicod_get_shortcode_template_part( 'part-title', null, 'team-block/tpl', $team_item, false );?>
      <?php mascot_core_digicod_get_shortcode_template_part( 'part-subtitle', null, 'team-block/tpl', $team_item, false );?>
      <?php mascot_core_digicod_get_shortcode_template_part( 'part-short-bio', null, 'team-block/tpl', $team_item, false );?>
    </div>
  </div>
</div>