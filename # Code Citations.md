# Code Citations

## الهدف من هذا الملف
هذا الملف يحتوي على قائمة بالمصادر التي تم الرجوع إليها أثناء تطوير المشروع. يتم توثيق الروابط إلى المستودعات التي تحتوي على الأكواد المستخدمة أو المستوحاة منها.

---

## License: unknown
### المصدر: [PavelSachenko/track](https://github.com/PavelSachenko/track/tree/e0c0caf693618edffd102201d0c775644344fe1b/backend/config/broadcasting.php)
#### وصف:
إعدادات البث (Broadcasting) باستخدام Pusher، بما في ذلك إعدادات المضيف (host) والمنفذ (port) والبروتوكول (scheme).

```php
'host' => env('PUSHER_HOST', '127.0.0.1'),
'port' => env('PUSHER_PORT', 6001),
'scheme' => env('PUSHER_SCHEME', 'http'),
],
```

---

## License: unknown
### المصدر: [Abdulhakimsg/RealtimeLaravel](https://github.com/Abdulhakimsg/RealtimeLaravel/tree/20332edf01bd6d58f1e10d2b28c39c2fcffe9d4b/README.md)
#### وصف:
إعدادات Pusher الأساسية المستخدمة في Laravel، بما في ذلك المفاتيح (key, secret, app_id).

```php
'pusher' => [
    'driver' => 'pusher',
    'key' => env('PUSHER_APP_KEY'),
    'secret' => env('PUSHER_APP_SECRET'),
    'app_id' => env('PUSHER_APP_ID'),
],
```

---

## License: unknown
### المصدر: [jonphipps/Metadata-Registry](https://github.com/jonphipps/Metadata-Registry/tree/8f75a41fd68302e5417a67515a7d3d0723483828/config/broadcasting.php)
#### وصف:
إعدادات Pusher مع خيارات إضافية مثل `cluster`.

```php
[
    'driver' => 'pusher',
    'key' => env('PUSHER_APP_KEY'),
    'secret' => env('PUSHER_APP_SECRET'),
    'app_id' => env('PUSHER_APP_ID'),
    'options' => [
        'cluster' => env('PUSHER_APP_CLUSTER'),
    ],
],
```

---

## License: unknown
### المصدر: [diegopacheco/Diego-Pacheco-Sandbox](https://github.com/diegopacheco/Diego-Pacheco-Sandbox/tree/168c5a9d01db8e5fbf20b92b5855e5183dc37132/scripts/php/composer-fun/hello-world-laravel/config/broadcasting.php)
#### وصف:
إعدادات Pusher مع التركيز على خيارات `cluster` و`encrypted`.

```php
'pusher' => [
    'key' => env('PUSHER_APP_KEY'),
    'secret' => env('PUSHER_APP_SECRET'),
    'app_id' => env('PUSHER_APP_ID'),
    'options' => [
        'cluster' => env('PUSHER_APP_CLUSTER'),
        'encrypted' => true,
    ],
],
```

---

## License: unknown
### المصدر: [caioleony/JustFans](https://github.com/caioleony/JustFans/tree/cc390821505e37d5a3403da85fcb6c7c3269ad66/config/broadcasting.php)
#### وصف:
إعدادات Pusher مع خيارات المضيف (host) والمنفذ (port) والبروتوكول (scheme).

```php
'host' => env('PUSHER_HOST', '127.0.0.1'),
'port' => env('PUSHER_PORT', 6001),
'scheme' => env('PUSHER_SCHEME', 'http'),
'encrypted' => false,
],
```

