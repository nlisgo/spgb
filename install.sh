#!/usr/bin/env bash
set -e # all commands must pass

SCRIPTPATH=$( cd $(dirname $0) ; pwd -P )

cd "$SCRIPTPATH/web"

if [ -f sites/default/settings.php ] ; then
    chmod 755 sites/default/settings.php
fi

/usr/bin/env PHP_OPTIONS="-d sendmail_path=`which true`" drush site-install spgb_profile --account-name=admin --account-pass=admin --site-name="SPGB" --yes

if [ -f ../build/migrate_d2d_config.sql ] ; then
    cd "$SCRIPTPATH/web"
    drush sql-cli < ../build/migrate_d2d_config.sql
fi
