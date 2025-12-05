<?php

return [
    // مزود الخرائط: mapbox | maplibre | osm
    'provider' => env('MAP_PROVIDER', 'maplibre'),

    // Mapbox token (إذا استعملت mapbox)
    'mapbox_token' => env('MAPBOX_TOKEN', ''),

    // URL لملفات الـ vector tiles أو tileserver (يمكن أن يحتوي {z}/{x}/{y})
    'tiles_url' => env('TILES_URL', ''),

    // إعدادات افتراضية للعرض (يمكن تعديلها عند الطلب)
    'defaults' => [
        'center' => [24.7136, 46.6753], // Riyadh lng, lat (افتراضي)
        'zoom' => 10,
        'min_zoom' => 4,
        'max_zoom' => 20,
    ],

    // خيارات للـ frontend لاستهلاكها عبر endpoint أو blade (يمكن إنشاء route يخرج هذا config)
    'frontend' => [
        'primary_color' => env('VITE_PRIMARY_COLOR', '#003366'),
        'secondary_bg' => env('VITE_SECONDARY_BG', '#FFFFFF'),
        'muted_bg' => env('VITE_MUTED_BG', '#F5F5F5'),
        'text_color' => env('VITE_TEXT_COLOR', '#000000'),
        'success_color' => env('VITE_SUCCESS_COLOR', '#28a745'),
        'danger_color' => env('VITE_DANGER_COLOR', '#dc3545'),
        'provider' => env('MAP_PROVIDER', 'maplibre'),
        'tiles_url' => env('TILES_URL', ''),
        'mapbox_token' => env('MAPBOX_TOKEN', ''),
        'enable_rtl' => env('VITE_ENABLE_RTL', 'false') === 'true',
    ],
];
