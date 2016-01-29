<?php
/**
 * @file
 * spgb_blocks.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function spgb_blocks_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "quicktabs" && $api == "quicktabs") {
    return array("version" => "1");
  }
}
