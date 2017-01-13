#!/usr/bin/env bash
set -e # all commands must pass

SCRIPTPATH=$( cd $(dirname $0) ; pwd -P )

cd "$SCRIPTPATH/web"
if [ -f ../build/migrate_d2d_config.sql ] ; then
    rm ../build/migrate_d2d_config.sql
fi
touch ../build/migrate_d2d_config.sql

drush sqlq "SELECT name, title, HEX(arguments) FROM migrate_group WHERE title ='The Socialist Party of Great Britain'" | while IFS=$'\t' read name title arguments; do
  echo "INSERT INTO \`migrate_group\` (\`name\`, \`title\`, \`arguments\`) VALUES ('$name','$title',X'$arguments');" >> ../build/migrate_d2d_config.sql
  query="SELECT machine_name, class_name, group_name, status, HEX(arguments) FROM migrate_status WHERE machine_name LIKE '"
  query+=$name
  query+="%';"
  drush sqlq "$query" | while IFS=$'\t' read machine_name class_name group_name status arguments; do
    echo "INSERT INTO \`migrate_status\` (\`machine_name\`, \`class_name\`, \`group_name\`, \`status\`, \`arguments\`) VALUES ('$machine_name','$class_name','$group_name',$status,X'$arguments');" >> ../build/migrate_d2d_config.sql
  done
  query="drush sql-dump --tables-list=migrate_field_mapping,migrate_map_"
  query+=$name
  query+="*,migrate_message_"
  query+=$name
  query+="*"
  $query >> ../build/migrate_d2d_config.sql
done
