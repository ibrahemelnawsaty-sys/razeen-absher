# API Requests — Quick Examples

1) جلب كل الحوادث (GeoJSON)
curl:
```
curl http://127.0.0.1:8000/api/incidents
```

2) إنشاء حادثة جديدة (POST) — body يتضمن geometry (GeoJSON Point)
curl:
```
curl -X POST http://127.0.0.1:8000/api/incidents \
  -H "Content-Type: application/json" \
  -d '{
    "title": "New test incident",
    "status": "active",
    "severity": "medium",
    "geometry": { "type": "Point", "coordinates": [46.68, 24.72] },
    "properties": { "source": "curl" }
  }'
```

3) اختبار بث تجريبي (يولد حدثًا عشوائيًا)
زيارة المتصفّح أو curl:
```
curl http://127.0.0.1:8000/map/broadcast/test
```

ملاحظات:
- إذا استعملت BROADCAST_DRIVER=log ستُسجّل الأحداث في storage/logs/laravel.log بدل WebSocket.
- لتشغيل realtime حقيقي فعّل Pusher أو laravel-websockets واملأ قيم PUSHER_* في `.env`.
