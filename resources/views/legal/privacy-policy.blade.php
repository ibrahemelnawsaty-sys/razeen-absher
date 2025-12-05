<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>سياسة الخصوصية - {{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;800&display=swap');
        * { font-family: 'Cairo', sans-serif; }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100">
    
    <!-- Header -->
    <nav class="bg-white shadow-lg">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <a href="{{ route('landing') }}" class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center">
                        <span class="text-2xl">🏛️</span>
                    </div>
                    <h1 class="text-xl font-bold text-gray-800">{{ config('app.name') }}</h1>
                </a>
                <a href="{{ route('landing') }}" class="text-indigo-600 hover:text-indigo-800 font-bold">
                    ← العودة للرئيسية
                </a>
            </div>
        </div>
    </nav>
    
    <!-- Content -->
    <div class="container mx-auto px-6 py-12 max-w-4xl">
        
        <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12">
            
            <!-- Title -->
            <div class="text-center mb-12">
                <div class="text-6xl mb-4">🔒</div>
                <h1 class="text-4xl font-black text-gray-800 mb-4">سياسة الخصوصية</h1>
                <p class="text-gray-600">آخر تحديث: {{ now()->format('Y-m-d') }}</p>
            </div>
            
            <!-- Introduction -->
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">مقدمة</h2>
                <p class="text-gray-600 leading-relaxed">
                    نحن في {{ config('app.name') }} نلتزم بحماية خصوصيتك وبياناتك الشخصية. توضح هذه السياسة كيفية جمعنا واستخدامنا وحماية معلوماتك عند استخدام نظامنا.
                </p>
            </div>
            
            <!-- Section 1 -->
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">1. المعلومات التي نجمعها</h2>
                <div class="space-y-4 text-gray-600">
                    <div class="p-4 bg-blue-50 rounded-xl">
                        <h3 class="font-bold text-blue-900 mb-2">معلومات الحساب</h3>
                        <p>الاسم، البريد الإلكتروني، رقم الجوال، وبيانات التسجيل الأساسية.</p>
                    </div>
                    
                    <div class="p-4 bg-green-50 rounded-xl">
                        <h3 class="font-bold text-green-900 mb-2">بيانات الموقع</h3>
                        <p>نستخدم بيانات الموقع لتوفير خدمات الخرائط والطوارئ بدقة.</p>
                    </div>
                    
                    <div class="p-4 bg-purple-50 rounded-xl">
                        <h3 class="font-bold text-purple-900 mb-2">بيانات الاستخدام</h3>
                        <p>معلومات حول كيفية استخدامك للنظام وتفاعلك مع الخدمات.</p>
                    </div>
                </div>
            </div>
            
            <!-- Section 2 -->
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">2. كيف نستخدم معلوماتك</h2>
                <ul class="space-y-3 text-gray-600">
                    <li class="flex items-start gap-3">
                        <span class="text-indigo-600 text-xl">✓</span>
                        <span>توفير وتحسين خدماتنا</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="text-indigo-600 text-xl">✓</span>
                        <span>إرسال تنبيهات وإشعارات مهمة</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="text-indigo-600 text-xl">✓</span>
                        <span>تحليل وتطوير النظام</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="text-indigo-600 text-xl">✓</span>
                        <span>ضمان أمان وسلامة النظام</span>
                    </li>
                </ul>
            </div>
            
            <!-- Section 3 -->
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">3. حماية البيانات</h2>
                <p class="text-gray-600 leading-relaxed mb-4">
                    نستخدم أحدث تقنيات التشفير والأمان لحماية بياناتك:
                </p>
                <div class="grid md:grid-cols-2 gap-4">
                    <div class="p-4 bg-gradient-to-br from-red-50 to-pink-50 rounded-xl">
                        <p class="font-bold text-red-900 mb-2">🔐 تشفير SSL/TLS</p>
                        <p class="text-sm text-gray-600">جميع البيانات محمية بتشفير قوي</p>
                    </div>
                    <div class="p-4 bg-gradient-to-br from-orange-50 to-yellow-50 rounded-xl">
                        <p class="font-bold text-orange-900 mb-2">🛡️ حماية متقدمة</p>
                        <p class="text-sm text-gray-600">أنظمة أمان متعددة المستويات</p>
                    </div>
                </div>
            </div>
            
            <!-- Section 4 -->
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">4. حقوقك</h2>
                <div class="space-y-3 text-gray-600">
                    <p class="flex items-center gap-2">
                        <span class="text-2xl">📋</span>
                        <span>الوصول إلى بياناتك الشخصية</span>
                    </p>
                    <p class="flex items-center gap-2">
                        <span class="text-2xl">✏️</span>
                        <span>تصحيح أو تحديث معلوماتك</span>
                    </p>
                    <p class="flex items-center gap-2">
                        <span class="text-2xl">🗑️</span>
                        <span>حذف حسابك وبياناتك</span>
                    </p>
                    <p class="flex items-center gap-2">
                        <span class="text-2xl">🚫</span>
                        <span>الاعتراض على معالجة بياناتك</span>
                    </p>
                </div>
            </div>
            
            <!-- Section 5 -->
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">5. الكوكيز (Cookies)</h2>
                <p class="text-gray-600 leading-relaxed">
                    نستخدم الكوكيز لتحسين تجربتك وتخصيص المحتوى. يمكنك التحكم في إعدادات الكوكيز من خلال متصفحك.
                </p>
            </div>
            
            <!-- Contact -->
            <div class="mt-12 p-6 bg-gradient-to-r from-indigo-50 to-purple-50 rounded-xl border-2 border-indigo-200">
                <h3 class="text-xl font-bold text-gray-800 mb-4">تواصل معنا</h3>
                <p class="text-gray-600 mb-4">لأي استفسارات حول سياسة الخصوصية:</p>
                <div class="space-y-2 text-gray-700">
                    <p>📧 البريد الإلكتروني: privacy@razeen.sa</p>
                    <p>📞 الهاتف: 920000000</p>
                </div>
            </div>
            
        </div>
        
    </div>
    
</body>
</html>
