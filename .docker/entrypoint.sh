#!/bin/bash
set -eu pipefail

if [ "$APP_ENV" = "development" ]; then
    su-exec nginx:nginx composer install

    ENV_FILE=".env"
    if [ ! -f $ENV_FILE ]; then
        su-exec nginx:nginx cp .env.example .env
        su-exec nginx:nginx php artisan key:generate

        MYSQL_HOST=$(cat $ENV_FILE | grep "DB_HOST" | cut -d"=" -f2)
        MYSQL_PORT=$(cat $ENV_FILE | grep "DB_PORT" | cut -d"=" -f2)

        echo "Waiting for MySQL to be ready"
        /sbin/wait-for.sh $MYSQL_HOST:$MYSQL_PORT -- echo "MySQL is ready!"
    fi

    php artisan config:clear && \
    php artisan view:clear && \
    php artisan storage:link && \
    php artisan route:clear

    MIGRATE_NOT_MIGRATED_STATUS=$(php artisan migrate:status | grep "not found" | wc -l)
    if [ $MIGRATE_NOT_MIGRATED_STATUS = "1" ]; then
        su-exec nginx:nginx php artisan migrate --seed
    fi
else
    su-exec nginx:nginx php artisan config:cache && php artisan view:clear && php artisan route:cache && php artisan storage:link
fi

/usr/bin/supervisord -n -c /etc/supervisor/supervisord.conf
