#!/usr/bin/env bash
set -e # all commands must pass

SCRIPTPATH=$( cd $(dirname $0) ; pwd -P )

cd "$SCRIPTPATH"
rm -rf ./src/spgb_profile/libraries/
rm -rf ./src/spgb_profile/modules/contrib/
rm -rf ./src/spgb_profile/themes/contrib/
drush make --no-core --concurrency=3 --no-recursion --contrib-destination=. ./src/spgb_profile/spgb_profile.make.yml ./src/spgb_profile
