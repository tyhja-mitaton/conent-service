#!/bin/bash

# This script is run within the php containers on start

# Fail on any error
set -o errexit

# Set permissions based on ENV variable (debian only)
if [ -x "usermod" ] ; then
    usermod -u ${PHP_USER_ID} www-data
fi

mkdir -p ./runtime

mkdir -p ./web/storage

chown -R www-data:www-data ./web/storage
chown -R www-data:www-data ./web/assets
chown -R www-data:www-data ./runtime

for f in $(find ./config/local/_docker -regex '.*\.php'); do envsubst < $f > "./config/local/$(basename $f)"; done

composer install

php yii migrate --interactive=0
php yii cache/flush cache --interactive=0

# Execute CMD
exec "$@"

