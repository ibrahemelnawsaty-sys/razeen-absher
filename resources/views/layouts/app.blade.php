<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    @php
        $seo = \App\Models\SeoSetting::getCached();
    @endphp
    
    <!-- Primary Meta Tags -->
    <title>{{ $seo->site_title ?? config('app.name', 'رزين') }}</title>
    <meta name="description" content="{{ $seo->meta_description ?? '' }}">
    <meta name="keywords" content="{{ $seo->meta_keywords ?? '' }}">
    <meta name="robots" content="{{ $seo->robots_meta ?? 'index, follow' }}">
    
    <!-- Favicon -->
    @if($seo && $seo->favicon)
        <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $seo->favicon) }}">
    @endif
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $seo->site_title ?? config('app.name') }}">
    <meta property="og:description" content="{{ $seo->meta_description ?? '' }}">
    @if($seo && $seo->og_image)
        <meta property="og:image" content="{{ asset('storage/' . $seo->og_image) }}">
    @endif
    
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    @if($seo && $seo->twitter_handle)
        <meta property="twitter:site" content="@{{ $seo->twitter_handle }}">
    @endif
    
    <!-- Google Verification -->
    @if($seo && $seo->google_site_verification)
        <meta name="google-site-verification" content="{{ $seo->google_site_verification }}">
    @endif
    
    <!-- Google Analytics -->
    @if($seo && $seo->google_analytics_id)
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ $seo->google_analytics_id }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '{{ $seo->google_analytics_id }}');
        </script>
    @endif
    
    <!-- Google Tag Manager -->
    @if($seo && $seo->google_tag_manager_id)
        <script>
            (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','{{ $seo->google_tag_manager_id }}');
        </script>
    @endif
    
    <!-- Structured Data -->
    @if($seo)
        <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Organization",
            "name": "{{ $seo->business_name ?? $seo->site_title ?? config('app.name') }}",
            "url": "{{ config('app.url') }}",
            @if($seo->logo)
            "logo": "{{ asset('storage/' . $seo->logo) }}",
            @endif
            "description": "{{ $seo->meta_description ?? '' }}",
            "address": {
                "@type": "PostalAddress",
                "addressLocality": "{{ $seo->business_city ?? '' }}",
                "addressCountry": "{{ $seo->business_country ?? 'Saudi Arabia' }}",
                "streetAddress": "{{ $seo->business_address ?? '' }}"
            },
            "contactPoint": {
                "@type": "ContactPoint",
                "telephone": "{{ $seo->business_phone ?? '' }}",
                "email": "{{ $seo->business_email ?? '' }}",
                "contactType": "customer service"
            },
            "sameAs": [
                @if($seo->facebook_url)"{{ $seo->facebook_url }}"@endif
                @if($seo->facebook_url && $seo->twitter_handle),@endif
                @if($seo->twitter_handle)"https://twitter.com/{{ $seo->twitter_handle }}"@endif
                @if(($seo->facebook_url || $seo->twitter_handle) && $seo->instagram_url),@endif
                @if($seo->instagram_url)"{{ $seo->instagram_url }}"@endif
                @if(($seo->facebook_url || $seo->twitter_handle || $seo->instagram_url) && $seo->linkedin_url),@endif
                @if($seo->linkedin_url)"{{ $seo->linkedin_url }}"@endif
                @if(($seo->facebook_url || $seo->twitter_handle || $seo->instagram_url || $seo->linkedin_url) && $seo->youtube_url),@endif
                @if($seo->youtube_url)"{{ $seo->youtube_url }}"@endif
            ]
        }
        </script>
    @endif
    
    <!-- Custom Head Scripts -->
    @if($seo && $seo->custom_head_scripts)
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
        
        /* Custom scrollbar */
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>
<body class="antialiased bg-gray-100">
    @if($seo && $seo->google_tag_manager_id)
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ $seo->google_tag_manager_id }}"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    @endif

    @yield('content')
    
    <!-- Custom Body Scripts -->
    @if($seo && $seo->custom_body_scripts)
        {!! $seo->custom_body_scripts !!}
    @endif
</body>
</html>
