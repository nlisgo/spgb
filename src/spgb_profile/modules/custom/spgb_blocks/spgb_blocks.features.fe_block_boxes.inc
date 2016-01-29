<?php
/**
 * @file
 * spgb_blocks.features.fe_block_boxes.inc
 */

/**
 * Implements hook_default_fe_block_boxes().
 */
function spgb_blocks_default_fe_block_boxes() {
  $export = array();

  $fe_block_boxes = new stdClass();
  $fe_block_boxes->info = 'About';
  $fe_block_boxes->format = 'php_code';
  $fe_block_boxes->machine_name = 'about';
  $fe_block_boxes->body = '<p>The Socialist Party is like no other political party in Britain. It is made up of people who have joined together because we want to get rid of the profit system and establish real socialism.</p><p>Our aim is to persuade others to become socialist and act for themselves, organizing democratically and without leaders, to bring about the kind of society that we advocate.</p><p>We are solely concerned with building a movement of socialists for socialism. We are not a reformist party with a programme of policies to patch up capitalism.</p>
<div class="more-link"><?php print l(t(\'More \'), \'who-we-are\'); ?></div>
<br>
<div id="footer-logo" class="logo">
<img src="<?php print base_path() . drupal_get_path(\'theme\', \'newsplus\') ;?>/images/footer-logo.png" alt="" />
</div>
<div id="footer-site-name" class="site-name">
NEWS+
</div>
<div id="footer-site-slogan" class="site-slogan">
A news theme for Drupal
</div>';

  $export['about'] = $fe_block_boxes;

  return $export;
}
