#!/usr/bin/env bash
set -euo pipefail

# filepath: d:\laravel\absher\scripts\docker-up.sh
# Build and run docker-compose, then run migrations + seeders inside app container.

echo "Building and starting containers..."
docker-compose up -d --build

echo "Waiting for DB to be ready (sleep 5s)..."
sleep 5

echo "Running migrations inside app container..."
docker-compose exec -T app php artisan migrate --force

echo "Seeding data..."
docker-compose exec -T app php artisan db:seed --class=IncidentSeeder --force || true
docker-compose exec -T app php artisan db:seed --class=AdminUserSeeder --force || true

echo "Create storage link"
docker-compose exec -T app php artisan storage:link || true

echo "Done. Access app at http://localhost (or check docker-compose logs -f)"
