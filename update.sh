#!/usr/bin/env bash
set -e # all commands must pass

SCRIPTPATH=$( cd $(dirname $0) ; pwd -P )

cd "$SCRIPTPATH/web"
drush cim --yes
drush cr
