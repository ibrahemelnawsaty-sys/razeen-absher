#!/usr/bin/env bash
set -euo pipefail

# filepath: d:\laravel\absher\scripts\start-local.sh
# Start Vite, Laravel dev server, and queue worker (background).
# Requires GNU nohup & disown or compatible shell (bash).

LOG_DIR="storage/logs"
mkdir -p "${LOG_DIR}"

echo "Starting Vite (dev server)..."
nohup npm run dev > "${LOG_DIR}/vite.log" 2>&1 & disown || true

echo "Starting Laravel dev server (php artisan serve)..."
nohup php artisan serve --host=127.0.0.1 --port=8000 > "${LOG_DIR}/laravel-serve.log" 2>&1 & disown || true

echo "Starting queue worker..."
# switch redis/database according to QUEUE_CONNECTION
nohup php artisan queue:work --tries=3 > "${LOG_DIR}/queue-worker.log" 2>&1 & disown || true

echo "All services started. Logs:"
echo " - Vite: ${LOG_DIR}/vite.log"
echo " - Laravel: ${LOG_DIR}/laravel-serve.log"
echo " - Queue: ${LOG_DIR}/queue-worker.log"
echo "Tail a log (example): tail -f ${LOG_DIR}/laravel-serve.log"
