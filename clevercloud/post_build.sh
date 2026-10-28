#!/bin/bash
set -e

echo "==> [Clever Cloud] Running post-build tasks for Luxury Watch API..."

# Generate application key if not set
if [ -z "$APP_KEY" ]; then
    echo "Generating APP_KEY..."
    php artisan key:generate --force || true
fi

# Run database migrations and seeders
echo "Running database migrations..."
php artisan migrate --force --seed || true

# Optimize cache for production
echo "Caching configuration and routes..."
php artisan config:cache || true
php artisan route:cache || true

echo "==> [Clever Cloud] Build completed successfully!"
