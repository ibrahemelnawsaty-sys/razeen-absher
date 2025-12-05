# دليل التشغيل السريع ⚡

## 1. التثبيت الأولي
\`\`\`bash
# تثبيت Composer dependencies
composer install

# تثبيت NPM packages
npm install
\`\`\`

## 2. قاعدة البيانات
\`\`\`bash
# إنشاء قاعدة البيانات (إن لم تكن موجودة)
mysql -u root -p -e "CREATE DATABASE absher CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

# تنفيذ المهاجرات
php artisan migrate

# تعبئة البيانات التجريبية
php artisan db:seed
\`\`\`

## 3. التشغيل
\`\`\`bash
# Terminal 1: Laravel Server
php artisan serve

# Terminal 2: Vite (Frontend)
npm run dev

# Terminal 3: Queue Worker (اختياري)
php artisan queue:work
\`\`\`

## 4. الوصول للتطبيق
- الصفحة الرئيسية: http://localhost:8000
- API Incidents: http://localhost:8000/api/incidents
- API Roads: http://localhost:8000/api/layers/roads
- API Traffic: http://localhost:8000/api/layers/traffic

## استكشاف الأخطاء

### مشكلة: "SQLSTATE[HY000] [2002]"
**الحل**: تأكد من تشغيل MySQL
\`\`\`bash
# Windows: تحقق من Services
# Linux/Mac: sudo service mysql start
\`\`\`

### مشكلة: "Class 'Redis' not found"
**الحل**: الإعدادات في .env تستخدم database/file بدلاً من Redis

### مشكلة: الخريطة لا تظهر
**الحل**: تحقق من console.log في المتصفح وتأكد من:
- npm run dev يعمل
- ملفات Vue مُحمّلة

## الخطوات التالية
1. زيارة الصفحة الرئيسية
2. اختبار البحث عن "حادث"
3. تفعيل/تعطيل الطبقات من الشريط الجانبي
\`\`\`
