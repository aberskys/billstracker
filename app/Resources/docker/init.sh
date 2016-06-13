#!/bin/bash

cd /var/www

echo "[info] copy default parameters.yml"
cp -n ./app/config/parameters.yml.dist ./app/config/parameters.yml

sed -i "s/\(^\s\+\)database_host:.*$/\1database_host: mysql/gm" ./app/config/parameters.yml
sed -i "s/\(^\s\+\)database_user:.*$/\1database_user: $MYSQL_ENV_MYSQL_USER/gm" ./app/config/parameters.yml
sed -i "s/\(^\s\+\)database_name:.*$/\1database_name: $MYSQL_ENV_MYSQL_DATABASE/gm" ./app/config/parameters.yml
sed -i "s/\(^\s\+\)database_password:.*$/\1database_password: $MYSQL_ENV_MYSQL_PASSWORD/gm" ./app/config/parameters.yml
sed -i "s/\(^\s\+\)database_port:.*$/\1database_port: 3306/gm" ./app/config/parameters.yml
sed -i "s/\(^\s\+\)redis_host:.*$/\1redis_host: redis/gm" ./app/config/parameters.yml
if [ ! -z "$DROPBOX_TOKEN" ] && [ ! -z "$DROPBOX_KEY" ] ; then
    sed -i "s/\(^\s\+\)fs_adapter:.*$/\1fs_adapter: dropbox/gm" ./app/config/parameters.yml
    sed -i "s/\(^\s\+\)dropbox_secret:.*$/\1dropbox_secret: $DROPBOX_KEY/gm" ./app/config/parameters.yml
    sed -i "s/\(^\s\+\)dropbox_token:.*$/\1dropbox_token: $DROPBOX_TOKEN/gm" ./app/config/parameters.yml
else
    sed -i "s/\(^\s\+\)fs_adapter:.*$/\1fs_adapter: \~/gm" ./app/config/parameters.yml
fi

echo "[info] Running composer"
composer install --optimize-autoloader --working-dir=/var/www

echo "[info] Changing permissions for storage/"
chmod -R 777 ./app/cache ./app/logs ./app/session ./web

echo "[info] Waiting for mysql"
sleep 10

echo "[info] Migrating database"
php ./app/console cache:clear
php ./app/console doctrine:migrations:migrate --no-interaction
php ./app/console app:fixtures --no-interaction

chown -R www:www ./app/cache ./app/logs ./app/session ./vendor ./web
