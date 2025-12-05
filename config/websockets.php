<?php

return [
    /*
    |--------------------------------------------------------------------------
    | WebSockets apps
    |--------------------------------------------------------------------------
    |
    | Configure the "apps" that are allowed to connect to the websocket server.
    | These correspond to Pusher-like credentials.
    |
    */
    'apps' => [
        [
            'id' => env('PUSHER_APP_ID'),
            'name' => env('APP_NAME', 'Absher'),
            'key' => env('PUSHER_APP_KEY'),
            'secret' => env('PUSHER_APP_SECRET'),
            'path' => env('PUSHER_APP_PATH', ''),
            'capacity' => null,
            'enable_client_messages' => false,
            'enable_statistics' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | WebSocket server default settings
    |--------------------------------------------------------------------------
    */
    'default' => [
        'host' => env('PUSHER_HOST', '127.0.0.1'),
        'port' => env('PUSHER_PORT', 6001),
        'scheme' => env('PUSHER_SCHEME', 'http'),
    ],

    /*
    |--------------------------------------------------------------------------
    | SSL options
    |--------------------------------------------------------------------------
    |
    | For production you may want to enable TLS/SSL. Configure cert & passphrase
    | via env if needed.
    |
    */
    'ssl' => [
        'local_cert' => env('WEBSOCKETS_SSL_LOCAL_CERT', null),
        'local_pk' => env('WEBSOCKETS_SSL_LOCAL_PK', null),
        'passphrase' => env('WEBSOCKETS_SSL_PASSPHRASE', null),
    ],

    /*
    |--------------------------------------------------------------------------
    | Allowed origins for cross-origin requests (CORS)
    |--------------------------------------------------------------------------
    */
    'allowed_origins' => explode(',', env('WEBSOCKETS_ALLOWED_ORIGINS', '*')),

    'max_request_size_in_kb' => 250,
];
