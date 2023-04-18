#!/bin/sh

cd /var/www


# npm install
# npm run build
# php artisan migrate:fresh --seed
php artisan cache:clear
php artisan route:cache
php artisan key:generate

/usr/bin/supervisord -c /etc/supervisord.conf