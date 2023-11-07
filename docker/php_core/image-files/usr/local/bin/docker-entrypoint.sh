#!/bin/bash

# This script is run within the php containers on start

# Fail on any error
set -o errexit

# Set permissions based on ENV variable (debian only)
if [ -x "usermod" ] ; then
    usermod -u 33 www-data
fi

chown -R www-data:www-data ./core/runtime
chown -R www-data:www-data ./core/web/assets
chown -R www-data:www-data ./console/data
chown -R www-data:www-data ./static/storage
chmod -R 777 ./console/data
chmod -R 777 ./static/storage

for f in $(find ./common/config/local/_docker -regex '.*\.php'); do envsubst < $f > "./common/config/local/$(basename $f)"; done
for f in $(find ./console/config/local/_docker -regex '.*\.php'); do envsubst < $f > "./console/config/local/$(basename $f)"; done
for f in $(find ./core/config/local/_docker -regex '.*\.php'); do envsubst < $f > "./core/config/local/$(basename $f)"; done

# Execute CMD
exec "$@"
