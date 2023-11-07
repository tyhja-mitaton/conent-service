#!/bin/bash

# This script is run within the php containers on start
composer install

php yii migrate --interactive=0
php yii cache/flush cache --interactive=0
php yii clickhouse/dictionaries > ./docker/clickhouse/image-files/etc/clickhouse-server/dictionaries/configured.xml

service cron start
service supervisor start

php yii crontab/index | crontab -
php yii supervisor/index > /etc/supervisor/conf.d/project.conf
supervisorctl update

php yii geo/load

# Execute CMD
echo "Container common_php completed"
exec "$@"
