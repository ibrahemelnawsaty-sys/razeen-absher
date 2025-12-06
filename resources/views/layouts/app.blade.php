<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    @php
        // جلب بيانات SEO فقط للصفحات العامة (وليس صفحات الأدمن)
        $seo = null;
        $isAdminPage = request()->is('admin*') || request()->is('filament*');
        
        if (!$isAdminPage) {
            try {
                $seo = \App\Models\SeoSetting::first();
                // للتشخيص - احذف هذا السطر بعد التأكد من عمل الكود
                // \Log::info('SEO Data:', ['seo' => $seo ? $seo->toArray() : 'null']);
            } catch (\Exception $e) {
                \Log::error('SEO Error: ' . $e->getMessage());
            }
        }
    @endphp
    
    <!-- Primary Meta Tags -->
    <title>{{ $seo?->site_title ?? config('app.name', 'رزين') }}</title>
    
    @if(!$isAdminPage)
        <meta name="description" content="{{ $seo?->meta_description ?? 'منصة رزين للخدمات الذكية' }}">
        <meta name="keywords" content="{{ $seo?->meta_keywords ?? '' }}">
        <meta name="author" content="{{ $seo?->business_name ?? 'رزين' }}">
        
        @if($seo)
            <meta name="robots" content="{{ ($seo->indexing_enabled ?? true) ? 'index' : 'noindex' }}, {{ ($seo->follow_links ?? true) ? 'follow' : 'nofollow' }}">
        @else
            <meta name="robots" content="index, follow">
        @endif
        
        <!-- Canonical URL -->
        <link rel="canonical" href="{{ url()->current() }}">
        
        <!-- Favicon -->
        @if($seo?->favicon)
            <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $seo->favicon) }}">
            <link rel="shortcut icon" href="{{ asset('storage/' . $seo->favicon) }}">
        @endif
        
        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ url()->current() }}">
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
        <meta name="twitter:url" content="{{ url()->current() }}">
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
                @if($seo->logo)
                ,"logo": "{{ asset('storage/' . $seo->logo) }}"
                @endif
                @if($seo->business_phone)
                ,"telephone": "{{ $seo->business_phone }}"
                @endif
                @if($seo->business_email)
                ,"email": "{{ $seo->business_email }}"
                @endif
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
        
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
    
    @stack('styles')
</head>
<body class="antialiased bg-gray-100">
    @if(!$isAdminPage && $seo && $seo->google_tag_manager_id)
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ $seo->google_tag_manager_id }}"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    @endif

    @yield('content')
    
    <!-- Custom Body Scripts -->
    @if(!$isAdminPage && $seo && $seo->custom_body_scripts)
        {!! $seo->custom_body_scripts !!}
    @endif
    
    @stack('scripts')
</body>
</html>
