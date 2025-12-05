<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الشروط والأحكام - {{ config('app.name') }}</title>
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
                <div class="text-6xl mb-4">📜</div>
                <h1 class="text-4xl font-black text-gray-800 mb-4">الشروط والأحكام</h1>
                <p class="text-gray-600">ساري المفعول من: {{ now()->format('Y-m-d') }}</p>
            </div>
            
            <!-- Introduction -->
            <div class="mb-8 p-6 bg-blue-50 rounded-xl border-2 border-blue-200">
                <h2 class="text-xl font-bold text-blue-900 mb-3">مقدمة</h2>
                <p class="text-gray-700 leading-relaxed">
                    مرحباً بك في {{ config('app.name') }}. باستخدامك لهذا النظام، فإنك توافق على الالتزام بهذه الشروط والأحكام. يُرجى قراءتها بعناية.
                </p>
            </div>
            
            <!-- Section 1 -->
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">1. قبول الشروط</h2>
                <p class="text-gray-600 leading-relaxed mb-4">
                    بالوصول إلى واستخدام نظام {{ config('app.name') }}، فإنك توافق على:
                </p>
                <ul class="space-y-2 text-gray-600">
                    <li class="flex items-start gap-3">
                        <span class="text-indigo-600 text-xl">•</span>
                        <span>الالتزام بجميع القوانين واللوائح المحلية</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="text-indigo-600 text-xl">•</span>
                        <span>استخدام النظام للأغراض المشروعة فقط</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="text-indigo-600 text-xl">•</span>
                        <span>عدم إساءة استخدام الخدمات المقدمة</span>
                    </li>
                </ul>
            </div>
            
            <!-- Section 2 -->
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">2. الحساب والتسجيل</h2>
                <div class="space-y-4">
                    <div class="p-4 bg-green-50 rounded-xl">
                        <h3 class="font-bold text-green-900 mb-2">✓ مسؤولية المستخدم</h3>
                        <p class="text-gray-600">أنت مسؤول عن الحفاظ على سرية معلومات حسابك</p>
                    </div>
                    <div class="p-4 bg-yellow-50 rounded-xl">
                        <h3 class="font-bold text-yellow-900 mb-2">⚠️ دقة المعلومات</h3>
                        <p class="text-gray-600">يجب تقديم معلومات صحيحة ودقيقة عند التسجيل</p>
                    </div>
                    <div class="p-4 bg-red-50 rounded-xl">
                        <h3 class="font-bold text-red-900 mb-2">✕ الاستخدام غير المصرح</h3>
                        <p class="text-gray-600">يُحظر مشاركة حسابك مع أطراف أخرى</p>
                    </div>
                </div>
            </div>
            
            <!-- Section 3 -->
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">3. الاستخدام المقبول</h2>
                <div class="grid md:grid-cols-2 gap-4">
                    <div class="p-4 bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl">
                        <h3 class="font-bold text-green-900 mb-3">✅ مسموح</h3>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li>• استخدام الخدمات للأغراض المشروعة</li>
                            <li>• البحث عن خدمات الطوارئ</li>
                            <li>• الإبلاغ عن المشاكل</li>
                        </ul>
                    </div>
                    <div class="p-4 bg-gradient-to-br from-red-50 to-pink-50 rounded-xl">
                        <h3 class="font-bold text-red-900 mb-3">❌ محظور</h3>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li>• نشر محتوى مسيء أو غير قانوني</li>
                            <li>• محاولة اختراق النظام</li>
                            <li>• إساءة استخدام الخدمات</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <!-- Section 4 -->
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">4. الملكية الفكرية</h2>
                <p class="text-gray-600 leading-relaxed mb-4">
                    جميع المحتويات والبرمجيات والتصاميم الموجودة في {{ config('app.name') }} محمية بحقوق الملكية الفكرية.
                </p>
                <div class="p-4 bg-purple-50 rounded-xl border-2 border-purple-200">
                    <p class="text-purple-900 font-bold">
                        © {{ date('Y') }} {{ config('app.name') }}. جميع الحقوق محفوظة.
                    </p>
                </div>
            </div>
            
            <!-- Section 5 -->
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">5. المسؤولية وإخلاء المسؤولية</h2>
                <p class="text-gray-600 leading-relaxed mb-4">
                    نسعى لتوفير أفضل خدمة ممكنة، لكن:
                </p>
                <ul class="space-y-3 text-gray-600">
                    <li class="flex items-start gap-3">
                        <span class="text-xl">⚠️</span>
                        <span>لا نضمن توفر الخدمة بشكل متواصل</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="text-xl">⚠️</span>
                        <span>لا نتحمل مسؤولية الأضرار غير المباشرة</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="text-xl">⚠️</span>
                        <span>المعلومات المقدمة للإرشاد فقط</span>
                    </li>
                </ul>
            </div>
            
            <!-- Section 6 -->
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">6. التعديلات</h2>
                <p class="text-gray-600 leading-relaxed">
                    نحتفظ بالحق في تعديل هذه الشروط في أي وقت. سيتم إشعارك بأي تغييرات مهمة.
                </p>
            </div>
            
            <!-- Section 7 -->
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">7. إنهاء الحساب</h2>
                <div class="p-4 bg-orange-50 rounded-xl border-2 border-orange-200">
                    <p class="text-gray-700">
                        نحتفظ بالحق في تعليق أو إنهاء حسابك في حالة انتهاك هذه الشروط.
                    </p>
                </div>
            </div>
            
            <!-- Contact -->
            <div class="mt-12 p-6 bg-gradient-to-r from-indigo-50 to-purple-50 rounded-xl border-2 border-indigo-200">
                <h3 class="text-xl font-bold text-gray-800 mb-4">تواصل معنا</h3>
                <p class="text-gray-600 mb-4">لأي استفسارات حول الشروط والأحكام:</p>
                <div class="space-y-2 text-gray-700">
                    <p>📧 البريد الإلكتروني: legal@razeen.sa</p>
                    <p>📞 الهاتف: 920000000</p>
                    <p>📍 العنوان: الرياض، المملكة العربية السعودية</p>
                </div>
            </div>
            
        </div>
        
    </div>
    
</body>
</html>
