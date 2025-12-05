# Run & Dev Quick Steps

1) Install dependencies
- composer install
- npm install

2) Environment
- copy `.env.example` → `.env` وتأكد من إعداد DB_* وQUEUE_CONNECTION وBROADCAST_DRIVER.
- (اختياري للتطوير السريع) في `.env`:
  - BROADCAST_DRIVER=log
  - QUEUE_CONNECTION=database
  - CACHE_STORE=file

3) Database & seed
- php artisan migrate
- php artisan db:seed --class=IncidentSeeder

4) Storage link
- php artisan storage:link

5) Frontend build & run
- npm run dev

6) Run Laravel server
- php artisan serve --host=127.0.0.1 --port=8000

7) Queue worker (إن استخدمت queues)
- php artisan queue:work --tries=3

8) Optional: Enable real-time WebSockets (Pusher-compatible)
- composer require beyondcode/laravel-websockets
- php artisan vendor:publish --provider="BeyondCode\LaravelWebSockets\WebSocketsServiceProvider" --tag="config"
- ensure .env has PUSHER_APP_KEY / PUSHER_APP_SECRET / PUSHER_APP_ID and:
  - BROADCAST_DRIVER=pusher
- run websocket server:
  - php artisan websockets:serve

9) Quick tests
- Open map: http://127.0.0.1:8000/ or /map
- Get incidents: curl http://127.0.0.1:8000/api/incidents
- Create incident (POST): see docs/requests.md
- Test broadcast: curl http://127.0.0.1:8000/map/broadcast/test

Notes:
- Fill production secrets in a secure secret store; do not commit .env with secrets.
- If using websocket server behind a proxy, ensure host/port/scheme set in .env (PUSHER_HOST, PUSHER_PORT, PUSHER_SCHEME).
