#!/bin/sh
set -e

# Run migrations if database is ready
if [ "$RUN_MIGRATIONS" = "true" ]; then
    echo "Running database migrations and seeders..."
    php artisan migrate --force --seed || true
fi

# Cache configuration & routes for production speed
if [ "$APP_ENV" = "production" ]; then
    echo "Optimizing application for production..."
    php artisan config:cache || true
    php artisan route:cache || true
fi

# Fallback PORT to 8000 if not specified by cloud host
PORT=${PORT:-8000}
echo "Starting Laravel 12 API server on port $PORT..."

exec php artisan serve --host=0.0.0.0 --port=$PORT
