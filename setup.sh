#!/usr/bin/env bash
set -e # all commands must pass

SCRIPTPATH=$( cd $(dirname $0) ; pwd -P )

cd "$SCRIPTPATH"
mkdir -p ./build/files
if [ -d ./web/ ]; then
  chmod -R 777 ./web/
  rm -rf ./web
fi
drush make ./src/drupal.make.yml ./web/spgb
ln -s "../../../src/spgb_profile" "$SCRIPTPATH/web/spgb/profiles/"
ln -s "../../../../src/settings.php" "$SCRIPTPATH/web/spgb/sites/default/"
ln -s "../../../../build/files" "$SCRIPTPATH/web/spgb/sites/default/"
chmod 755 ./web/spgb/sites/default/settings.php
./remake.sh
