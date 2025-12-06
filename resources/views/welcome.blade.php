<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    @php
        $seo = \App\Models\SeoSetting::first();
    @endphp
    
    <!-- Primary Meta Tags -->
    <title>{{ $seo?->site_title ?? config('app.name', 'رزين') }}</title>
    <meta name="description" content="{{ $seo?->meta_description ?? 'منصة رزين للخدمات الذكية' }}">
    <meta name="keywords" content="{{ $seo?->meta_keywords ?? '' }}">
    <meta name="author" content="{{ $seo?->business_name ?? 'رزين' }}">
    
    @if($seo)
        <meta name="robots" content="{{ $seo->indexing_enabled ? 'index' : 'noindex' }}, {{ $seo->follow_links ? 'follow' : 'nofollow' }}">
    @else
        <meta name="robots" content="index, follow">
    @endif
    
    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url('/') }}">
    
    <!-- Favicon -->
    @if($seo?->favicon)
        <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $seo->favicon) }}">
        <link rel="shortcut icon" href="{{ asset('storage/' . $seo->favicon) }}">
    @endif
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:title" content="{{ $seo?->site_title ?? config('app.name') }}">
    <meta property="og:description" content="{{ $seo?->meta_description ?? '' }}">
    <meta property="og:site_name" content="{{ $seo?->business_name ?? config('app.name') }}">
    <meta property="og:locale" content="ar_SA">
    @if($seo?->og_image)
        <meta property="og:image" content="{{ asset('storage/' . $seo->og_image) }}">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="630">
    @endif
    
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url('/') }}">
    <meta name="twitter:title" content="{{ $seo?->site_title ?? config('app.name') }}">
    <meta name="twitter:description" content="{{ $seo?->meta_description ?? '' }}">
    @if($seo?->twitter_handle)
        <meta name="twitter:site" content="{{ '@' . $seo->twitter_handle }}">
        <meta name="twitter:creator" content="{{ '@' . $seo->twitter_handle }}">
    @endif
    @if($seo?->og_image)
        <meta name="twitter:image" content="{{ asset('storage/' . $seo->og_image) }}">
    @endif
    
    <!-- Google Verification -->
    @if($seo?->google_site_verification)
        <meta name="google-site-verification" content="{{ $seo->google_site_verification }}">
    @endif
    
    <!-- Google Analytics -->
    @if($seo?->google_analytics_id)
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ $seo->google_analytics_id }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '{{ $seo->google_analytics_id }}');
        </script>
    @endif
    
    <!-- Google Tag Manager -->
    @if($seo?->google_tag_manager_id)
        <script>
            (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','{{ $seo->google_tag_manager_id }}');
        </script>
    @endif
    
    <!-- Structured Data JSON-LD -->
    @if($seo)
        <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Organization",
            "name": "{{ $seo->business_name ?? $seo->site_title ?? config('app.name') }}",
            "url": "{{ config('app.url') }}",
            "description": "{{ $seo->meta_description ?? '' }}"
            @if($seo->logo),"logo": "{{ asset('storage/' . $seo->logo) }}"@endif
            @if($seo->business_phone),"telephone": "{{ $seo->business_phone }}"@endif
            @if($seo->business_email),"email": "{{ $seo->business_email }}"@endif
            @if($seo->business_address || $seo->business_city)
            ,"address": {
                "@type": "PostalAddress",
                "streetAddress": "{{ $seo->business_address ?? '' }}",
                "addressLocality": "{{ $seo->business_city ?? '' }}",
                "addressCountry": "{{ $seo->business_country ?? 'SA' }}"
            }
            @endif
        }
        </script>
    @endif
    
    <!-- Custom Head Scripts -->
    @if($seo?->custom_head_scripts)
        {!! $seo->custom_head_scripts !!}
    @endif
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        * { font-family: 'Cairo', sans-serif; }
        [x-cloak] { display: none !important; }
        
        /* Animations */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 20px rgba(99, 102, 241, 0.4); }
            50% { box-shadow: 0 0 40px rgba(99, 102, 241, 0.8); }
        }
        @keyframes slide-up {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-float { animation: float 6s ease-in-out infinite; }
        .animate-pulse-glow { animation: pulse-glow 2s ease-in-out infinite; }
        .animate-slide-up { animation: slide-up 0.8s ease-out forwards; }
        
        /* Gradient Text */
        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        /* Glass Effect */
        .glass {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        /* Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>
<body class="antialiased bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 min-h-screen">
    
    @if($seo?->google_tag_manager_id)
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ $seo->google_tag_manager_id }}"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    @endif
    
    <!-- Navigation -->
    <nav x-data="{ mobileMenu: false, scrolled: false }" 
         @scroll.window="scrolled = window.scrollY > 50"
         :class="scrolled ? 'bg-white/95 shadow-lg' : 'bg-white/80'"
         class="backdrop-blur-lg sticky top-0 z-50 transition-all duration-300">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <a href="{{ url('/') }}" class="flex items-center gap-3 group">
                    @if($seo?->logo)
                        <img src="{{ asset('storage/' . $seo->logo) }}" alt="{{ $seo->business_name }}" class="h-12 transition-transform group-hover:scale-110">
                    @else
                        <div class="w-12 h-12 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-xl flex items-center justify-center text-white text-2xl shadow-lg group-hover:shadow-xl transition-all">
                            🏛️
                        </div>
                    @endif
                    <div>
                        <span class="text-xl font-black text-gray-800">{{ $seo?->business_name ?? 'رزين' }}</span>
                        @if($seo?->site_tagline)
                            <p class="text-xs text-gray-500">{{ Str::limit($seo->site_tagline, 30) }}</p>
                        @endif
                    </div>
                </a>
                
                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center gap-6">
                    <a href="#features" class="text-gray-600 hover:text-indigo-600 font-bold transition-colors">المميزات</a>
                    <a href="#services" class="text-gray-600 hover:text-indigo-600 font-bold transition-colors">الخدمات</a>
                    <a href="#statistics" class="text-gray-600 hover:text-indigo-600 font-bold transition-colors">الإحصائيات</a>
                    <a href="#contact" class="text-gray-600 hover:text-indigo-600 font-bold transition-colors">تواصل معنا</a>
                </div>
                
                <!-- Auth Buttons -->
                <div class="flex items-center gap-3">
                    @auth
                        <a href="{{ route('dashboard') }}" class="px-6 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold rounded-xl hover:from-indigo-700 hover:to-purple-700 transition-all shadow-lg hover:shadow-xl hover:scale-105">
                            🎛️ لوحة التحكم
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="hidden sm:inline-flex px-5 py-2.5 text-gray-700 font-bold hover:text-indigo-600 transition-all">
                            تسجيل الدخول
                        </a>
                        <a href="{{ route('register') }}" class="px-6 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold rounded-xl hover:from-indigo-700 hover:to-purple-700 transition-all shadow-lg hover:shadow-xl hover:scale-105">
                            🚀 ابدأ مجاناً
                        </a>
                    @endauth
                    
                    <!-- Mobile Menu Button -->
                    <button @click="mobileMenu = !mobileMenu" class="md:hidden p-2 text-gray-600 hover:text-indigo-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path x-show="!mobileMenu" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            <path x-show="mobileMenu" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
            
            <!-- Mobile Menu -->
            <div x-show="mobileMenu" x-cloak x-transition class="md:hidden mt-4 pb-4 border-t border-gray-200">
                <div class="flex flex-col gap-3 pt-4">
                    <a href="#features" class="px-4 py-2 text-gray-600 hover:bg-indigo-50 rounded-lg font-bold">المميزات</a>
                    <a href="#services" class="px-4 py-2 text-gray-600 hover:bg-indigo-50 rounded-lg font-bold">الخدمات</a>
                    <a href="#statistics" class="px-4 py-2 text-gray-600 hover:bg-indigo-50 rounded-lg font-bold">الإحصائيات</a>
                    <a href="#contact" class="px-4 py-2 text-gray-600 hover:bg-indigo-50 rounded-lg font-bold">تواصل معنا</a>
                    @guest
                        <a href="{{ route('login') }}" class="px-4 py-2 text-indigo-600 hover:bg-indigo-50 rounded-lg font-bold">تسجيل الدخول</a>
                    @endguest
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Hero Section -->
    <section class="relative py-20 lg:py-32 overflow-hidden">
        <!-- Background Decorations -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-gradient-to-br from-indigo-400/30 to-purple-400/30 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-gradient-to-br from-blue-400/30 to-cyan-400/30 rounded-full blur-3xl"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-gradient-to-br from-purple-400/20 to-pink-400/20 rounded-full blur-3xl"></div>
        </div>
        
        <div class="container mx-auto px-6 relative z-10">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Text Content -->
                <div class="text-center lg:text-right animate-slide-up">
                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-100 text-indigo-700 rounded-full text-sm font-bold mb-6">
                        <span class="w-2 h-2 bg-indigo-500 rounded-full animate-pulse"></span>
                        خدمة معتمدة من أبشر
                    </div>
                    
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-gray-800 mb-6 leading-tight">
                        <span class="gradient-text">{{ $seo?->site_title ?? 'منصة رزين' }}</span>
                        <br>للخدمات الحكومية الذكية
                    </h1>
                    
                    <p class="text-lg md:text-xl text-gray-600 mb-8 max-w-2xl mx-auto lg:mx-0 leading-relaxed">
                        {{ $seo?->meta_description ?? 'منصة متكاملة توفر خدمات حكومية ذكية تشمل الخرائط التفاعلية، بيانات المراكز، حالة الطرق، والمزيد لتسهيل تنقل وخدمة المواطن.' }}
                    </p>
                    
                    <div class="flex flex-col sm:flex-row justify-center lg:justify-start gap-4 mb-8">
                        <a href="{{ route('register') }}" class="px-8 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold rounded-2xl hover:from-indigo-700 hover:to-purple-700 transition-all shadow-xl hover:shadow-2xl text-lg flex items-center justify-center gap-2 hover:scale-105 animate-pulse-glow">
                            <span>🚀</span>
                            <span>ابدأ الآن مجاناً</span>
                        </a>
                        <a href="#features" class="px-8 py-4 bg-white text-gray-700 font-bold rounded-2xl hover:bg-gray-50 transition-all shadow-lg text-lg flex items-center justify-center gap-2 hover:scale-105 border-2 border-gray-200">
                            <span>📖</span>
                            <span>اكتشف المزيد</span>
                        </a>
                    </div>
                    
                    <!-- Trust Badges -->
                    <div class="flex flex-wrap justify-center lg:justify-start gap-6 text-sm text-gray-500">
                        <div class="flex items-center gap-2">
                            <span class="text-green-500">✓</span>
                            <span>مجاني بالكامل</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-green-500">✓</span>
                            <span>آمن وموثوق</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-green-500">✓</span>
                            <span>دعم على مدار الساعة</span>
                        </div>
                    </div>
                </div>
                
                <!-- Hero Image/Illustration -->
                <div class="relative animate-float hidden lg:block">
                    <div class="relative w-full max-w-lg mx-auto">
                        <!-- Main Card -->
                        <div class="glass rounded-3xl p-8 shadow-2xl">
                            <div class="flex items-center gap-4 mb-6">
                                <div class="w-14 h-14 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-2xl flex items-center justify-center text-white text-2xl shadow-lg">
                                    🗺️
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-800">الخريطة التفاعلية</h3>
                                    <p class="text-sm text-gray-500">عرض جميع الخدمات</p>
                                </div>
                            </div>
                            
                            <!-- Mini Map Preview -->
                            <div class="bg-gradient-to-br from-blue-100 to-indigo-100 rounded-2xl h-48 flex items-center justify-center mb-6 relative overflow-hidden">
                                <div class="absolute inset-0 opacity-30">
                                    <div class="absolute top-4 right-4 w-3 h-3 bg-red-500 rounded-full animate-ping"></div>
                                    <div class="absolute top-12 right-12 w-3 h-3 bg-green-500 rounded-full"></div>
                                    <div class="absolute bottom-8 right-8 w-3 h-3 bg-blue-500 rounded-full"></div>
                                    <div class="absolute top-8 left-8 w-3 h-3 bg-yellow-500 rounded-full"></div>
                                    <div class="absolute bottom-12 left-12 w-3 h-3 bg-purple-500 rounded-full"></div>
                                </div>
                                <span class="text-6xl">🌍</span>
                            </div>
                            
                            <!-- Stats -->
                            <div class="grid grid-cols-3 gap-4">
                                <div class="text-center p-3 bg-blue-50 rounded-xl">
                                    <p class="text-2xl font-black text-blue-600">+500</p>
                                    <p class="text-xs text-gray-500">مركز خدمة</p>
                                </div>
                                <div class="text-center p-3 bg-green-50 rounded-xl">
                                    <p class="text-2xl font-black text-green-600">+50</p>
                                    <p class="text-xs text-gray-500">مستشفى</p>
                                </div>
                                <div class="text-center p-3 bg-purple-50 rounded-xl">
                                    <p class="text-2xl font-black text-purple-600">24/7</p>
                                    <p class="text-xs text-gray-500">متاح دائماً</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Floating Cards -->
                        <div class="absolute -top-4 -right-4 glass rounded-2xl p-4 shadow-xl animate-bounce" style="animation-duration: 3s;">
                            <div class="flex items-center gap-3">
                                <span class="text-3xl">🚨</span>
                                <div>
                                    <p class="font-bold text-gray-800 text-sm">طوارئ</p>
                                    <p class="text-xs text-green-600">متاح الآن</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="absolute -bottom-4 -left-4 glass rounded-2xl p-4 shadow-xl" style="animation: float 4s ease-in-out infinite reverse;">
                            <div class="flex items-center gap-3">
                                <span class="text-3xl">🛣️</span>
                                <div>
                                    <p class="font-bold text-gray-800 text-sm">حالة الطرق</p>
                                    <p class="text-xs text-blue-600">تحديث مباشر</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Features Section -->
    <section id="features" class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-2 bg-indigo-100 text-indigo-700 rounded-full text-sm font-bold mb-4">🌟 المميزات</span>
                <h2 class="text-3xl md:text-4xl font-black text-gray-800 mb-4">كل ما تحتاجه في مكان واحد</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">منصة متكاملة توفر لك جميع الخدمات الحكومية الذكية بطريقة سهلة وسريعة</p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="group p-8 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-3xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border border-blue-100">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-500 rounded-2xl flex items-center justify-center text-white text-3xl mb-6 shadow-lg group-hover:scale-110 transition-transform">
                        🗺️
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">خرائط تفاعلية متقدمة</h3>
                    <p class="text-gray-600 leading-relaxed">خرائط ذكية تعرض جميع المراكز الحكومية والخدمات القريبة منك مع إمكانية التصفية والبحث المتقدم.</p>
                    <div class="mt-4 flex flex-wrap gap-2">
                        <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-bold">GPS</span>
                        <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-bold">بحث ذكي</span>
                        <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-bold">تصفية</span>
                    </div>
                </div>
                
                <!-- Feature 2 -->
                <div class="group p-8 bg-gradient-to-br from-red-50 to-orange-50 rounded-3xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border border-red-100">
                    <div class="w-16 h-16 bg-gradient-to-br from-red-500 to-orange-500 rounded-2xl flex items-center justify-center text-white text-3xl mb-6 shadow-lg group-hover:scale-110 transition-transform">
                        🚨
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">خدمات الطوارئ</h3>
                    <p class="text-gray-600 leading-relaxed">الوصول السريع لأقرب مستشفى أو مركز إسعاف أو محطة إطفاء مع عرض أوقات الوصول المتوقعة.</p>
                    <div class="mt-4 flex flex-wrap gap-2">
                        <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs font-bold">إسعاف</span>
                        <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs font-bold">إطفاء</span>
                        <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs font-bold">شرطة</span>
                    </div>
                </div>
                
                <!-- Feature 3 -->
                <div class="group p-8 bg-gradient-to-br from-green-50 to-emerald-50 rounded-3xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border border-green-100">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-500 rounded-2xl flex items-center justify-center text-white text-3xl mb-6 shadow-lg group-hover:scale-110 transition-transform">
                        🛣️
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">حالة الطرق المباشرة</h3>
                    <p class="text-gray-600 leading-relaxed">متابعة حية لحالة الطرق والازدحامات المرورية وأعمال الصيانة لتخطيط رحلتك بشكل أفضل.</p>
                    <div class="mt-4 flex flex-wrap gap-2">
                        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold">مباشر</span>
                        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold">ازدحام</span>
                        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold">صيانة</span>
                    </div>
                </div>
                
                <!-- Feature 4 -->
                <div class="group p-8 bg-gradient-to-br from-purple-50 to-pink-50 rounded-3xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border border-purple-100">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center text-white text-3xl mb-6 shadow-lg group-hover:scale-110 transition-transform">
                        📊
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">تحليلات وإحصائيات</h3>
                    <p class="text-gray-600 leading-relaxed">تقارير تفصيلية وإحصائيات شاملة تساعد في اتخاذ القرارات وتحليل البيانات بشكل احترافي.</p>
                    <div class="mt-4 flex flex-wrap gap-2">
                        <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-xs font-bold">تقارير</span>
                        <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-xs font-bold">رسوم بيانية</span>
                    </div>
                </div>
                
                <!-- Feature 5 -->
                <div class="group p-8 bg-gradient-to-br from-yellow-50 to-amber-50 rounded-3xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border border-yellow-100">
                    <div class="w-16 h-16 bg-gradient-to-br from-yellow-500 to-amber-500 rounded-2xl flex items-center justify-center text-white text-3xl mb-6 shadow-lg group-hover:scale-110 transition-transform">
                        🏗️
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">المشاريع البلدية</h3>
                    <p class="text-gray-600 leading-relaxed">متابعة جميع المشاريع البلدية الجارية والمخطط لها مع نسب الإنجاز والتفاصيل الكاملة.</p>
                    <div class="mt-4 flex flex-wrap gap-2">
                        <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-bold">إنشاءات</span>
                        <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-bold">تطوير</span>
                    </div>
                </div>
                
                <!-- Feature 6 -->
                <div class="group p-8 bg-gradient-to-br from-cyan-50 to-teal-50 rounded-3xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border border-cyan-100">
                    <div class="w-16 h-16 bg-gradient-to-br from-cyan-500 to-teal-500 rounded-2xl flex items-center justify-center text-white text-3xl mb-6 shadow-lg group-hover:scale-110 transition-transform">
                        🔥
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">خرائط حرارية</h3>
                    <p class="text-gray-600 leading-relaxed">عرض البيانات بشكل بصري من خلال خرائط حرارية توضح مناطق الازدحام والحوادث والخدمات.</p>
                    <div class="mt-4 flex flex-wrap gap-2">
                        <span class="px-3 py-1 bg-cyan-100 text-cyan-700 rounded-full text-xs font-bold">حوادث</span>
                        <span class="px-3 py-1 bg-cyan-100 text-cyan-700 rounded-full text-xs font-bold">ازدحام</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Services Section -->
    <section id="services" class="py-20 bg-gradient-to-br from-indigo-900 via-purple-900 to-indigo-900 text-white relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-full h-full bg-[url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%23ffffff\" fill-opacity=\"0.4\"%3E%3Cpath d=\"M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')]"></div>
        </div>
        
        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-2 bg-white/20 text-white rounded-full text-sm font-bold mb-4">🎯 الخدمات</span>
                <h2 class="text-3xl md:text-4xl font-black mb-4">خدمات متنوعة لكل فئة</h2>
                <p class="text-indigo-200 max-w-2xl mx-auto">نوفر خدمات مخصصة للمواطنين والجهات الحكومية والمستثمرين</p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <!-- For Citizens -->
                <div class="bg-white/10 backdrop-blur-lg rounded-3xl p-8 border border-white/20 hover:bg-white/20 transition-all hover:-translate-y-2">
                    <div class="w-20 h-20 bg-gradient-to-br from-blue-400 to-cyan-400 rounded-2xl flex items-center justify-center text-4xl mb-6 shadow-xl mx-auto">
                        👤
                    </div>
                    <h3 class="text-2xl font-bold text-center mb-4">للمواطنين</h3>
                    <ul class="space-y-3 text-indigo-100">
                        <li class="flex items-center gap-3">
                            <span class="text-green-400">✓</span>
                            <span>البحث عن أقرب المرافق</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-green-400">✓</span>
                            <span>متابعة حالة الطرق</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-green-400">✓</span>
                            <span>خدمات الطوارئ السريعة</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-green-400">✓</span>
                            <span>معلومات الأحياء</span>
                        </li>
                    </ul>
                    <a href="{{ route('register') }}" class="mt-6 w-full py-3 bg-white/20 hover:bg-white/30 rounded-xl font-bold block text-center transition-all">
                        سجل كمواطن →
                    </a>
                </div>
                
                <!-- For Government -->
                <div class="bg-white/10 backdrop-blur-lg rounded-3xl p-8 border border-white/20 hover:bg-white/20 transition-all hover:-translate-y-2 md:scale-105 shadow-2xl">
                    <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 px-4 py-1 bg-gradient-to-r from-yellow-400 to-orange-400 text-gray-900 rounded-full text-sm font-bold">
                        ⭐ الأكثر طلباً
                    </div>
                    <div class="w-20 h-20 bg-gradient-to-br from-green-400 to-emerald-400 rounded-2xl flex items-center justify-center text-4xl mb-6 shadow-xl mx-auto">
                        🏛️
                    </div>
                    <h3 class="text-2xl font-bold text-center mb-4">للجهات الحكومية</h3>
                    <ul class="space-y-3 text-indigo-100">
                        <li class="flex items-center gap-3">
                            <span class="text-green-400">✓</span>
                            <span>إدارة المراكز والبلاغات</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-green-400">✓</span>
                            <span>تحليلات متقدمة</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-green-400">✓</span>
                            <span>تقارير الأداء</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-green-400">✓</span>
                            <span>لوحة تحكم شاملة</span>
                        </li>
                    </ul>
                    <a href="{{ route('register') }}" class="mt-6 w-full py-3 bg-gradient-to-r from-green-400 to-emerald-400 text-gray-900 rounded-xl font-bold block text-center hover:from-green-500 hover:to-emerald-500 transition-all">
                        سجل كجهة حكومية →
                    </a>
                </div>
                
                <!-- For Investors -->
                <div class="bg-white/10 backdrop-blur-lg rounded-3xl p-8 border border-white/20 hover:bg-white/20 transition-all hover:-translate-y-2">
                    <div class="w-20 h-20 bg-gradient-to-br from-purple-400 to-pink-400 rounded-2xl flex items-center justify-center text-4xl mb-6 shadow-xl mx-auto">
                        💼
                    </div>
                    <h3 class="text-2xl font-bold text-center mb-4">للمستثمرين</h3>
                    <ul class="space-y-3 text-indigo-100">
                        <li class="flex items-center gap-3">
                            <span class="text-green-400">✓</span>
                            <span>تحليل المناطق الاستثمارية</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-green-400">✓</span>
                            <span>خرائط المخاطر</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-green-400">✓</span>
                            <span>توقعات العائد</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-green-400">✓</span>
                            <span>بيانات السوق</span>
                        </li>
                    </ul>
                    <a href="{{ route('register') }}" class="mt-6 w-full py-3 bg-white/20 hover:bg-white/30 rounded-xl font-bold block text-center transition-all">
                        سجل كمستثمر →
                    </a>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Statistics Section -->
    <section id="statistics" class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-2 bg-indigo-100 text-indigo-700 rounded-full text-sm font-bold mb-4">📈 الإحصائيات</span>
                <h2 class="text-3xl md:text-4xl font-black text-gray-800 mb-4">أرقام تتحدث عن نجاحنا</h2>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="text-center p-6 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-3xl border border-blue-100">
                    <p class="text-5xl font-black text-indigo-600 mb-2">+500</p>
                    <p class="text-gray-600 font-bold">مركز خدمة</p>
                </div>
                <div class="text-center p-6 bg-gradient-to-br from-green-50 to-emerald-50 rounded-3xl border border-green-100">
                    <p class="text-5xl font-black text-green-600 mb-2">+10K</p>
                    <p class="text-gray-600 font-bold">مستخدم نشط</p>
                </div>
                <div class="text-center p-6 bg-gradient-to-br from-purple-50 to-pink-50 rounded-3xl border border-purple-100">
                    <p class="text-5xl font-black text-purple-600 mb-2">+50</p>
                    <p class="text-gray-600 font-bold">جهة حكومية</p>
                </div>
                <div class="text-center p-6 bg-gradient-to-br from-orange-50 to-amber-50 rounded-3xl border border-orange-100">
                    <p class="text-5xl font-black text-orange-600 mb-2">99%</p>
                    <p class="text-gray-600 font-bold">رضا العملاء</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-indigo-600 to-purple-600 text-white">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl md:text-4xl font-black mb-6">جاهز للبدء؟</h2>
            <p class="text-xl text-indigo-100 mb-8 max-w-2xl mx-auto">انضم إلى آلاف المستخدمين واستفد من خدماتنا الذكية مجاناً</p>
            <a href="{{ route('register') }}" class="inline-flex items-center gap-3 px-10 py-5 bg-white text-indigo-600 font-bold rounded-2xl hover:bg-gray-100 transition-all shadow-xl text-lg hover:scale-105">
                <span>🚀</span>
                <span>أنشئ حسابك الآن</span>
            </a>
        </div>
    </section>
    
    <!-- Contact Section -->
    @if($seo && ($seo->business_email || $seo->business_phone || $seo->business_address))
    <section id="contact" class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-2 bg-indigo-100 text-indigo-700 rounded-full text-sm font-bold mb-4">📞 تواصل معنا</span>
                <h2 class="text-3xl md:text-4xl font-black text-gray-800 mb-4">نحن هنا لمساعدتك</h2>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8 max-w-4xl mx-auto">
                @if($seo->business_email)
                <div class="text-center p-8 bg-white rounded-3xl shadow-lg hover:shadow-xl transition-all">
                    <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center text-3xl mx-auto mb-4">📧</div>
                    <h3 class="font-bold text-gray-800 mb-2">البريد الإلكتروني</h3>
                    <a href="mailto:{{ $seo->business_email }}" class="text-indigo-600 hover:underline">{{ $seo->business_email }}</a>
                </div>
                @endif
                
                @if($seo->business_phone)
                <div class="text-center p-8 bg-white rounded-3xl shadow-lg hover:shadow-xl transition-all">
                    <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center text-3xl mx-auto mb-4">📱</div>
                    <h3 class="font-bold text-gray-800 mb-2">رقم الهاتف</h3>
                    <a href="tel:{{ $seo->business_phone }}" class="text-indigo-600 hover:underline" dir="ltr">{{ $seo->business_phone }}</a>
                </div>
                @endif
                
                @if($seo->business_city || $seo->business_address)
                <div class="text-center p-8 bg-white rounded-3xl shadow-lg hover:shadow-xl transition-all">
                    <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center text-3xl mx-auto mb-4">📍</div>
                    <h3 class="font-bold text-gray-800 mb-2">العنوان</h3>
                    <p class="text-gray-600">{{ $seo->business_city }}</p>
                    @if($seo->business_address)
                        <p class="text-gray-500 text-sm mt-1">{{ Str::limit($seo->business_address, 50) }}</p>
                    @endif
                </div>
                @endif
            </div>
            
            <!-- Social Links -->
            @if($seo->facebook_url || $seo->twitter_handle || $seo->instagram_url || $seo->linkedin_url)
            <div class="flex justify-center gap-4 mt-12">
                @if($seo->twitter_handle)
                <a href="https://twitter.com/{{ $seo->twitter_handle }}" target="_blank" class="w-12 h-12 bg-gray-200 hover:bg-blue-500 hover:text-white rounded-xl flex items-center justify-center text-xl transition-all">𝕏</a>
                @endif
                @if($seo->facebook_url)
                <a href="{{ $seo->facebook_url }}" target="_blank" class="w-12 h-12 bg-gray-200 hover:bg-blue-600 hover:text-white rounded-xl flex items-center justify-center text-xl transition-all">f</a>
                @endif
                @if($seo->instagram_url)
                <a href="{{ $seo->instagram_url }}" target="_blank" class="w-12 h-12 bg-gray-200 hover:bg-pink-500 hover:text-white rounded-xl flex items-center justify-center text-xl transition-all">📷</a>
                @endif
                @if($seo->linkedin_url)
                <a href="{{ $seo->linkedin_url }}" target="_blank" class="w-12 h-12 bg-gray-200 hover:bg-blue-700 hover:text-white rounded-xl flex items-center justify-center text-xl transition-all">in</a>
                @endif
            </div>
            @endif
        </div>
    </section>
    @endif
    
    <!-- Footer -->
    <footer class="py-12 bg-gray-900 text-white">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-4 gap-8 mb-8">
                <!-- About -->
                <div class="md:col-span-2">
                    <div class="flex items-center gap-3 mb-4">
                        @if($seo?->logo)
                            <img src="{{ asset('storage/' . $seo->logo) }}" alt="{{ $seo->business_name }}" class="h-10 brightness-0 invert">
                        @else
                            <span class="text-3xl">🏛️</span>
                        @endif
                        <span class="text-xl font-black">{{ $seo?->business_name ?? 'رزين' }}</span>
                    </div>
                    <p class="text-gray-400 max-w-md">{{ $seo?->site_tagline ?? 'منصة متكاملة للخدمات الحكومية الذكية' }}</p>
                </div>
                
                <!-- Quick Links -->
                <div>
                    <h4 class="font-bold text-lg mb-4">روابط سريعة</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#features" class="hover:text-white transition-colors">المميزات</a></li>
                        <li><a href="#services" class="hover:text-white transition-colors">الخدمات</a></li>
                        <li><a href="#contact" class="hover:text-white transition-colors">تواصل معنا</a></li>
                        <li><a href="{{ route('login') }}" class="hover:text-white transition-colors">تسجيل الدخول</a></li>
                    </ul>
                </div>
                
                <!-- Legal -->
                <div>
                    <h4 class="font-bold text-lg mb-4">قانوني</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="{{ route('privacy-policy') }}" class="hover:text-white transition-colors">سياسة الخصوصية</a></li>
                        <li><a href="{{ route('terms-conditions') }}" class="hover:text-white transition-colors">الشروط والأحكام</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-800 pt-8 text-center text-gray-500">
                <p>© {{ date('Y') }} {{ $seo?->business_name ?? 'رزين' }}. جميع الحقوق محفوظة.</p>
            </div>
        </div>
    </footer>
    
    <!-- Custom Body Scripts -->
    @if($seo?->custom_body_scripts)
        {!! $seo->custom_body_scripts !!}
    @endif
    
    <!-- Scroll to Top Button -->
    <button x-data="{ show: false }" 
            @scroll.window="show = window.scrollY > 500"
            x-show="show"
            x-cloak
            @click="window.scrollTo({top: 0, behavior: 'smooth'})"
            class="fixed bottom-8 left-8 w-12 h-12 bg-indigo-600 text-white rounded-full shadow-xl hover:bg-indigo-700 transition-all hover:scale-110 flex items-center justify-center z-50">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
        </svg>
    </button>
    
</body>
</html>
