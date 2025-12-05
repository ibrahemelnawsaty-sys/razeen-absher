# دليل التثبيت - Absher Spatial Intelligence

## 1. تثبيت Dependencies
\`\`\`bash
composer install
npm install
\`\`\`

## 2. إعداد قاعدة البيانات
\`\`\`bash
# إنشاء قاعدة البيانات
mysql -u root -p -e "CREATE DATABASE absher CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

# تنفيذ المهاجرات
php artisan migrate

# تعبئة البيانات
php artisan db:seed --class=IncidentSeeder
php artisan db:seed --class=ProjectSeeder
php artisan db:seed --class=CenterSeeder
php artisan db:seed --class=LayerSeeder
php artisan db:seed --class=RoadSeeder
\`\`\`

## 3. إعداد Redis (اختياري)
\`\`\`bash
# على Windows باستخدام WSL:
sudo apt install redis-server
sudo service redis-server start

# أو استخدم database/file في .env:
QUEUE_CONNECTION=database
CACHE_DRIVER=file
\`\`\`

## 4. تشغيل التطبيق
\`\`\`bash
# Terminal 1: Laravel
php artisan serve

# Terminal 2: Vite
npm run dev

# Terminal 3: Queue Worker
php artisan queue:work
\`\`\`

## 5. الوصول للتطبيق
- Frontend: http://localhost:8000
- API Docs: http://localhost:8000/api/incidents
\`\`\`
