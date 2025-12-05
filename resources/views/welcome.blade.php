<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - نظام إدارة الخدمات البلدية الذكي</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;800;900&display=swap');
        * { font-family: 'Cairo', sans-serif; }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        .float-animation { animation: float 3s ease-in-out infinite; }
        
        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 via-blue-50 to-purple-50">
    
    <!-- Navigation -->
    <nav class="fixed w-full z-50 bg-white/80 backdrop-blur-lg shadow-lg">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                        <span class="text-2xl">🏛️</span>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-gray-800">{{ config('app.name') }}</h1>
                        <p class="text-xs text-gray-600">نظام الخدمات البلدية الذكي</p>
                    </div>
                </div>
                
                <!-- Menu -->
                <div class="hidden md:flex items-center gap-8">
                    <a href="#features" class="text-gray-700 hover:text-indigo-600 font-bold transition-colors">المميزات</a>
                    <a href="#services" class="text-gray-700 hover:text-indigo-600 font-bold transition-colors">الخدمات</a>
                    <a href="#about" class="text-gray-700 hover:text-indigo-600 font-bold transition-colors">عن النظام</a>
                    <a href="#contact" class="text-gray-700 hover:text-indigo-600 font-bold transition-colors">تواصل معنا</a>
                </div>
                
                <!-- Auth Buttons -->
                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ route('home') }}" class="px-6 py-2.5 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-xl font-bold hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                            🏠 الرئيسية
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-6 py-2.5 text-indigo-600 font-bold hover:text-indigo-800 transition-all">
                            تسجيل الدخول
                        </a>
                        <a href="{{ route('register') }}" class="px-6 py-2.5 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-xl font-bold hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                            إنشاء حساب
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Hero Section -->
    <section class="pt-32 pb-20 px-6">
        <div class="container mx-auto">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <!-- Text Content -->
                <div class="space-y-6">
                    <div class="inline-block px-4 py-2 bg-indigo-100 text-indigo-600 rounded-full text-sm font-bold">
                        🚀 أحدث التقنيات في إدارة المدن الذكية
                    </div>
                    
                    <h1 class="text-5xl md:text-6xl font-black leading-tight">
                        نظام <span class="gradient-text">ذكي متكامل</span> لإدارة الخدمات البلدية
                    </h1>
                    
                    <p class="text-xl text-gray-600 leading-relaxed">
                        منصة شاملة تجمع خدمات الطوارئ، خرائط تفاعلية، تتبع المشاريع البلدية، وتحليلات حركة المرور في مكان واحد
                    </p>
                    
                    <div class="flex gap-4">
                        @guest
                            <a href="{{ route('register') }}" class="px-8 py-4 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-2xl font-bold text-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                                🎯 ابدأ الآن مجاناً
                            </a>
                            <a href="#features" class="px-8 py-4 bg-white text-indigo-600 rounded-2xl font-bold text-lg border-2 border-indigo-200 hover:border-indigo-400 transition-all duration-300">
                                📖 اكتشف المزيد
                            </a>
                        @else
                            <a href="{{ route('map.index') }}" class="px-8 py-4 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-2xl font-bold text-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                                🗺️ افتح الخريطة
                            </a>
                        @endguest
                    </div>
                    
                    <!-- Stats -->
                    <div class="grid grid-cols-3 gap-6 pt-8">
                        <div class="text-center">
                            <div class="text-3xl font-black text-indigo-600">10+</div>
                            <div class="text-sm text-gray-600">خدمات طوارئ</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-black text-purple-600">5+</div>
                            <div class="text-sm text-gray-600">مشاريع بلدية</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-black text-pink-600">24/7</div>
                            <div class="text-sm text-gray-600">مراقبة حية</div>
                        </div>
                    </div>
                </div>
                
                <!-- Hero Image -->
                <div class="relative float-animation">
                    <div class="aspect-square bg-gradient-to-br from-indigo-200 to-purple-300 rounded-3xl shadow-2xl overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1524661135-423995f22d0b?w=800" 
                             alt="Smart City" 
                             class="w-full h-full object-cover mix-blend-multiply">
                    </div>
                    <!-- Floating Cards -->
                    <div class="absolute -top-6 -left-6 bg-white/90 backdrop-blur-lg p-4 rounded-2xl shadow-xl">
                        <div class="text-4xl mb-2">🚑</div>
                        <div class="text-sm font-bold text-indigo-600">خدمات الطوارئ</div>
                    </div>
                    <div class="absolute -bottom-6 -right-6 bg-white/90 backdrop-blur-lg p-4 rounded-2xl shadow-xl">
                        <div class="text-4xl mb-2">🗺️</div>
                        <div class="text-sm font-bold text-purple-600">خرائط تفاعلية</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Features Section -->
    <section id="features" class="py-20 px-6 bg-white">
        <div class="container mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-black mb-4">✨ مميزات النظام</h2>
                <p class="text-xl text-gray-600">كل ما تحتاجه في منصة واحدة</p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Feature Cards with gradient backgrounds -->
                <div class="group p-8 bg-gradient-to-br from-indigo-50 to-purple-50 rounded-3xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                    <div class="text-6xl mb-4 group-hover:scale-110 transition-transform">🚨</div>
                    <h3 class="text-2xl font-bold mb-3 text-indigo-900">خدمات الطوارئ</h3>
                    <p class="text-gray-600 leading-relaxed">
                        الوصول السريع لأقرب مستشفى، إسعاف، دفاع مدني، أو شرطة مع تحديد المسافة والوقت المتوقع
                    </p>
                </div>
                
                <div class="group p-8 bg-gradient-to-br from-purple-50 to-pink-50 rounded-3xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                    <div class="text-6xl mb-4 group-hover:scale-110 transition-transform">🗺️</div>
                    <h3 class="text-2xl font-bold mb-3 text-purple-900">خرائط تفاعلية</h3>
                    <p class="text-gray-600 leading-relaxed">
                        خرائط حرارية للحوادث، الازدحام، والصيانة مع تحليل ذكي لحالة الطرق والمسارات
                    </p>
                </div>
                
                <div class="group p-8 bg-gradient-to-br from-pink-50 to-red-50 rounded-3xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                    <div class="text-6xl mb-4 group-hover:scale-110 transition-transform">🏗️</div>
                    <h3 class="text-2xl font-bold mb-3 text-pink-900">المشاريع البلدية</h3>
                    <p class="text-gray-600 leading-relaxed">
                        متابعة المشاريع البلدية قيد التنفيذ مع نسب الإنجاز والجهات المنفذة
                    </p>
                </div>
                
                <div class="group p-8 bg-gradient-to-br from-blue-50 to-cyan-50 rounded-3xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                    <div class="text-6xl mb-4 group-hover:scale-110 transition-transform">📊</div>
                    <h3 class="text-2xl font-bold mb-3 text-blue-900">تحليلات متقدمة</h3>
                    <p class="text-gray-600 leading-relaxed">
                        إحصائيات شاملة وتقارير مفصلة عن جميع الخدمات والمشاريع
                    </p>
                </div>
                
                <div class="group p-8 bg-gradient-to-br from-green-50 to-emerald-50 rounded-3xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                    <div class="text-6xl mb-4 group-hover:scale-110 transition-transform">🔔</div>
                    <h3 class="text-2xl font-bold mb-3 text-green-900">إشعارات لحظية</h3>
                    <p class="text-gray-600 leading-relaxed">
                        تنبيهات فورية عن حالة الطرق، الحوادث، والتحديثات المهمة
                    </p>
                </div>
                
                <div class="group p-8 bg-gradient-to-br from-yellow-50 to-orange-50 rounded-3xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                    <div class="text-6xl mb-4 group-hover:scale-110 transition-transform">🔍</div>
                    <h3 class="text-2xl font-bold mb-3 text-yellow-900">بحث ذكي</h3>
                    <p class="text-gray-600 leading-relaxed">
                        ابحث عن أي خدمة أو مشروع بسرعة وسهولة مع نتائج فورية
                    </p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- CTA Section -->
    <section class="py-20 px-6 bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600">
        <div class="container mx-auto text-center">
            <h2 class="text-4xl md:text-5xl font-black text-white mb-6">
                🚀 هل أنت مستعد للبدء؟
            </h2>
            <p class="text-xl text-indigo-100 mb-8 max-w-2xl mx-auto">
                انضم إلى آلاف المستخدمين واستمتع بتجربة إدارة المدن الذكية
            </p>
            @guest
                <a href="{{ route('register') }}" class="inline-block px-12 py-5 bg-white text-indigo-600 rounded-2xl font-bold text-xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                    ✨ ابدأ مجاناً الآن
                </a>
            @else
                <a href="{{ route('map.index') }}" class="inline-block px-12 py-5 bg-white text-indigo-600 rounded-2xl font-bold text-xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                    🗺️ افتح الخريطة الذكية
                </a>
            @endguest
        </div>
    </section>
    
    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12 px-6">
        <div class="container mx-auto">
            <div class="grid md:grid-cols-4 gap-8 mb-8">
                <!-- About -->
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center">
                            <span class="text-2xl">🏛️</span>
                        </div>
                        <h3 class="text-xl font-bold">{{ config('app.name') }}</h3>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        نظام متكامل لإدارة الخدمات البلدية الذكية
                    </p>
                </div>
                
                <!-- Quick Links -->
                <div>
                    <h4 class="text-lg font-bold mb-4">روابط سريعة</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#features" class="hover:text-white transition-colors">المميزات</a></li>
                        <li><a href="#services" class="hover:text-white transition-colors">الخدمات</a></li>
                        <li><a href="#about" class="hover:text-white transition-colors">عن النظام</a></li>
                        <li><a href="#contact" class="hover:text-white transition-colors">تواصل معنا</a></li>
                    </ul>
                </div>
                
                <!-- Services -->
                <div>
                    <h4 class="text-lg font-bold mb-4">خدماتنا</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors">خدمات الطوارئ</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">الخرائط التفاعلية</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">المشاريع البلدية</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">التقارير والإحصائيات</a></li>
                    </ul>
                </div>
                
                <!-- Contact -->
                <div>
                    <h4 class="text-lg font-bold mb-4">تواصل معنا</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li class="flex items-center gap-2">
                            <span>📧</span>
                            <span>info@absher.sa</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <span>📞</span>
                            <span>920000000</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <span>📍</span>
                            <span>الرياض، المملكة العربية السعودية</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Bottom Bar -->
            <div class="border-t border-gray-800 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <p class="text-sm text-gray-400">
                        © {{ date('Y') }} {{ config('app.name') }}. جميع الحقوق محفوظة.
                    </p>
                    <div class="flex gap-4">
                        <a href="{{ route('privacy-policy') }}" class="text-gray-400 hover:text-white transition-colors">سياسة الخصوصية</a>
                        <a href="{{ route('terms-conditions') }}" class="text-gray-400 hover:text-white transition-colors">الشروط والأحكام</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
</body>
</html>
