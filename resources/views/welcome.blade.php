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
    
    <style>
        * { font-family: 'Cairo', sans-serif; }
    </style>
</head>
<body class="antialiased bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 min-h-screen">
    
    @if($seo?->google_tag_manager_id)
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ $seo->google_tag_manager_id }}"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    @endif
    
    <!-- Navigation -->
    <nav class="bg-white/80 backdrop-blur-lg shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-3">
                    @if($seo?->logo)
                        <img src="{{ asset('storage/' . $seo->logo) }}" alt="{{ $seo->business_name }}" class="h-10">
                    @else
                        <span class="text-3xl">🏛️</span>
                    @endif
                    <span class="text-xl font-black text-gray-800">{{ $seo?->business_name ?? 'رزين' }}</span>
                </div>
                
                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="px-6 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold rounded-xl hover:from-indigo-700 hover:to-purple-700 transition-all">
                            لوحة التحكم
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-6 py-2 text-gray-700 font-bold hover:text-indigo-600 transition-all">
                            تسجيل الدخول
                        </a>
                        <a href="{{ route('register') }}" class="px-6 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold rounded-xl hover:from-indigo-700 hover:to-purple-700 transition-all">
                            إنشاء حساب
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Hero Section -->
    <section class="py-20">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-5xl md:text-6xl font-black text-gray-800 mb-6">
                {{ $seo?->site_title ?? 'منصة رزين للخدمات الذكية' }}
            </h1>
            <p class="text-xl text-gray-600 mb-8 max-w-3xl mx-auto">
                {{ $seo?->meta_description ?? 'منصة متكاملة للخدمات الحكومية الذكية' }}
            </p>
            
            <div class="flex justify-center gap-4 flex-wrap">
                <a href="{{ route('login') }}" class="px-8 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold rounded-2xl hover:from-indigo-700 hover:to-purple-700 transition-all shadow-lg hover:shadow-xl text-lg">
                    🚀 ابدأ الآن
                </a>
                <a href="#features" class="px-8 py-4 bg-white text-gray-700 font-bold rounded-2xl hover:bg-gray-50 transition-all shadow-lg text-lg">
                    📖 اعرف المزيد
                </a>
            </div>
        </div>
    </section>
    
    <!-- Features Section -->
    <section id="features" class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-black text-gray-800 text-center mb-12">🌟 مميزات المنصة</h2>
            
            <div class="grid md:grid-cols-3 gap-8">
                <div class="p-8 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl text-center hover:shadow-xl transition-all">
                    <div class="text-5xl mb-4">🗺️</div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">خرائط تفاعلية</h3>
                    <p class="text-gray-600">خرائط ذكية تعرض جميع الخدمات والمرافق القريبة منك</p>
                </div>
                
                <div class="p-8 bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl text-center hover:shadow-xl transition-all">
                    <div class="text-5xl mb-4">🚨</div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">خدمات الطوارئ</h3>
                    <p class="text-gray-600">الوصول السريع لأقرب مستشفى أو مركز إسعاف</p>
                </div>
                
                <div class="p-8 bg-gradient-to-br from-purple-50 to-pink-50 rounded-2xl text-center hover:shadow-xl transition-all">
                    <div class="text-5xl mb-4">📊</div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">تحليلات ذكية</h3>
                    <p class="text-gray-600">تقارير وإحصائيات شاملة لدعم اتخاذ القرار</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Contact Section -->
    @if($seo && ($seo->business_email || $seo->business_phone || $seo->business_address))
    <section class="py-20 bg-gradient-to-br from-indigo-600 to-purple-600 text-white">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-4xl font-black mb-8">📞 تواصل معنا</h2>
            
            <div class="flex justify-center gap-8 flex-wrap">
                @if($seo->business_email)
                <div class="flex items-center gap-2">
                    <span class="text-2xl">📧</span>
                    <span>{{ $seo->business_email }}</span>
                </div>
                @endif
                
                @if($seo->business_phone)
                <div class="flex items-center gap-2">
                    <span class="text-2xl">📱</span>
                    <span>{{ $seo->business_phone }}</span>
                </div>
                @endif
                
                @if($seo->business_city)
                <div class="flex items-center gap-2">
                    <span class="text-2xl">📍</span>
                    <span>{{ $seo->business_city }}</span>
                </div>
                @endif
            </div>
        </div>
    </section>
    @endif
    
    <!-- Footer -->
    <footer class="py-8 bg-gray-900 text-white text-center">
        <p>© {{ date('Y') }} {{ $seo?->business_name ?? 'رزين' }}. جميع الحقوق محفوظة.</p>
    </footer>
    
    <!-- Custom Body Scripts -->
    @if($seo?->custom_body_scripts)
        {!! $seo->custom_body_scripts !!}
    @endif
    
</body>
</html>
