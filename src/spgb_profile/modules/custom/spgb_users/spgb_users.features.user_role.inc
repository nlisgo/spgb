<?php
/**
 * @file
 * spgb_users.features.user_role.inc
 */

/**
 * Implements hook_user_default_roles().
 */
function spgb_users_user_default_roles() {
  $roles = array();

  // Exported role: Event manager.
  $roles['Event manager'] = array(
    'name' => 'Event manager',
    'weight' => 7,
    'machine_name' => '',
  );

  // Exported role: Internet committee.
  $roles['Internet committee'] = array(
    'name' => 'Internet committee',
    'weight' => 2,
    'machine_name' => '',
  );

  // Exported role: Forum moderator.
  $roles['Forum moderator'] = array(
    'name' => 'Forum moderator',
    'weight' => 3,
    'machine_name' => '',
  );

  // Exported role: Shop keeper.
  $roles['Shop keeper'] = array(
    'name' => 'Shop keeper',
    'weight' => 4,
    'machine_name' => '',
  );

  return $roles;
}
