#!/bin/sh
set -e

# Setup SQLite if database file doesn't exist or DB_HOST is empty
if [ "$DB_CONNECTION" = "sqlite" ] || [ -z "$DB_HOST" ]; then
    echo "==> Setting up SQLite database..."
    export DB_CONNECTION=sqlite
    touch /var/www/html/database/database.sqlite
    chmod 666 /var/www/html/database/database.sqlite || true
fi

# Run database migrations and seeds automatically
echo "==> Running database migrations and seeders..."
php artisan migrate --force --seed || true

# Cache configuration & routes for production speed
if [ "$APP_ENV" = "production" ]; then
    echo "==> Optimizing application for production..."
    php artisan config:cache || true
    php artisan route:cache || true
fi

# Fallback PORT to 8000 if not specified by cloud host
PORT=${PORT:-8000}
echo "==> Starting Luxury Watch API server on port $PORT..."

exec php artisan serve --host=0.0.0.0 --port=$PORT
