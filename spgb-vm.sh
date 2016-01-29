#!/usr/bin/env bash
set -e # all commands must pass

SCRIPTPATH=$( cd $(dirname $0) ; pwd -P )

cd "$SCRIPTPATH"
if [ ! -d ./web ]; then
  mkdir ./web
fi

cd "$SCRIPTPATH"
if [ ! -f ./local.settings.php ]; then
  cp ./build/spgb-drupal-vm.settings.php ./local.settings.php
fi

cd "$SCRIPTPATH"
if [ ! -d ../spgb-drupal-vm ]; then
  echo "Cloning git@github.com:geerlingguy/drupal-vm.git to ../spgb-drupal-vm"
  git clone git@github.com:geerlingguy/drupal-vm.git ../spgb-drupal-vm
  cd ../spgb-drupal-vm
  git checkout tags/2.2.1
fi

cd "$SCRIPTPATH"
echo "Transferring config to ../spgb-drupal-vm/config.yml"
cp ./build/spgb-drupal-vm.config.yml ../spgb-drupal-vm/config.yml
sed -e "s?%SPGB_PWD%?$(pwd)?g" --in-place ../spgb-drupal-vm/config.yml
