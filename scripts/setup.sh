#!/usr/bin/env bash
set -euo pipefail

# filepath: d:\laravel\absher\scripts\setup.sh

echo "1/6 — Check tools"
command -v php >/dev/null 2>&1 || { echo "php not found"; exit 1; }
command -v composer >/dev/null 2>&1 || { echo "composer not found"; exit 1; }
command -v npm >/dev/null 2>&1 || { echo "npm not found"; exit 1; }

echo "2/6 — Install PHP dependencies (composer)"
composer install --prefer-dist --no-interaction

echo "3/6 — Install JS dependencies (npm)"
npm ci

echo "4/6 — Generate APP_KEY (if empty)"
php artisan key:generate --ansi || true

echo "5/6 — Run migrations and seeders"
# if using production DB be careful; --force for non-interactive
php artisan migrate --force
php artisan db:seed --class=IncidentSeeder --force || true
php artisan db:seed --class=AdminUserSeeder --force || true

echo "6/6 — Storage link"
php artisan storage:link || true

echo "Setup complete. Next: ./scripts/start-local.sh or use docker-up.sh"