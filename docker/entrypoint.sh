#!/bin/bash
set -e

export PORT="${PORT:-8080}"

mkdir -p /var/www/html/database
if [ ! -f /var/www/html/database/database.sqlite ]; then
    touch /var/www/html/database/database.sqlite
fi

chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database
chmod 664 /var/www/html/database/database.sqlite

php artisan migrate --force --no-interaction || true
php artisan db:seed --force --no-interaction || true

php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

echo "Starting Apache on port $PORT..."
exec apache2-foreground
