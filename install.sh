#!/usr/bin/env bash
set -e # all commands must pass

SCRIPTPATH=$( cd $(dirname $0) ; pwd -P )

cd "$SCRIPTPATH/web/spgb"

if [ -f sites/default/settings.php ] ; then
    chmod 755 sites/default/settings.php
fi

/usr/bin/env PHP_OPTIONS="-d sendmail_path=`which true`" drush site-install spgb_profile --site-name="SPGB" --yes

cd "$SCRIPTPATH/web/spgb"
if [ -f ../../build/migrate_d2d_config.sql ] ; then
    drush sql-cli < ../../build/migrate_d2d_config.sql
fi
