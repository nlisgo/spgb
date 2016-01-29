<?php

// Set up Drupal.
$conf['install_profile'] = 'spgb_profile';

// Don't use poormanscron.
$conf['cron_safe_threshold'] = 0;

// Uploaded files directories.
$conf['file_public_path'] = 'sites/default/files';
$conf['file_temporary_path'] = sys_get_temp_dir();

require __DIR__ . '/../local.settings.php';
