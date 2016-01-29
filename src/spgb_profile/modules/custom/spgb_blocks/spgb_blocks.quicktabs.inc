<?php
/**
 * @file
 * spgb_blocks.quicktabs.inc
 */

/**
 * Implements hook_quicktabs_default_quicktabs().
 */
function spgb_blocks_quicktabs_default_quicktabs() {
  $export = array();

  $quicktabs = new stdClass();
  $quicktabs->disabled = FALSE; /* Edit this to true to make a default quicktabs disabled initially */
  $quicktabs->api_version = 1;
  $quicktabs->machine_name = 'sidebar_tabs';
  $quicktabs->ajax = 0;
  $quicktabs->hide_empty_tabs = FALSE;
  $quicktabs->default_tab = 0;
  $quicktabs->title = 'Sidebar tabs';
  $quicktabs->tabs = array(
    0 => array(
      'bid' => 'views_delta_mt_latest-block',
      'hide_title' => 1,
      'title' => 'Latest',
      'weight' => '-100',
      'type' => 'block',
    ),
    1 => array(
      'bid' => 'views_delta_mt_most_popular-block_1',
      'hide_title' => 1,
      'title' => 'Popular',
      'weight' => '-99',
      'type' => 'block',
    ),
    2 => array(
      'bid' => 'views_delta_archive-block',
      'hide_title' => 1,
      'title' => 'Archive',
      'weight' => '-98',
      'type' => 'block',
    ),
  );
  $quicktabs->renderer = 'quicktabs';
  $quicktabs->style = 'nostyle';
  $quicktabs->options = array();

  // Translatables
  // Included for use with string extractors like potx.
  t('Archive');
  t('Latest');
  t('Popular');
  t('Sidebar tabs');

  $export['sidebar_tabs'] = $quicktabs;

  return $export;
}
