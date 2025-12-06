<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    @php
        $seo = \App\Models\SeoSetting::getCached();
        $pageSeo = isset($pageSlug) ? \App\Models\PageSeo::getForPage($pageSlug) : null;
    @endphp
    
    <!-- Primary Meta Tags -->
    <title>{{ $pageSeo->page_title ?? $seo->site_title ?? config('app.name') }}</title>
    <meta name="description" content="{{ $pageSeo->meta_description ?? $seo->meta_description ?? '' }}">
    <meta name="keywords" content="{{ $pageSeo->meta_keywords ?? $seo->meta_keywords ?? '' }}">
    <meta name="robots" content="{{ $pageSeo->robots_meta ?? $seo->robots_meta ?? 'index, follow' }}">
    
    @if($pageSeo && $pageSeo->canonical_url)
        <link rel="canonical" href="{{ $pageSeo->canonical_url }}">
    @endif
    
    <!-- Favicon -->
    @if($seo && $seo->favicon)
        <link rel="icon" type="image/x-icon" href="{{ Storage::url($seo->favicon) }}">
    @endif
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $pageSeo->og_title ?? $pageSeo->page_title ?? $seo->site_title ?? config('app.name') }}">
    <meta property="og:description" content="{{ $pageSeo->og_description ?? $pageSeo->meta_description ?? $seo->meta_description ?? '' }}">
    @if($pageSeo && $pageSeo->og_image)
        <meta property="og:image" content="{{ Storage::url($pageSeo->og_image) }}">
    @elseif($seo && $seo->og_image)
        <meta property="og:image" content="{{ Storage::url($seo->og_image) }}">
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
        <script type="application/ld+json">{!! $seo->structured_data_json !!}</script>
    @endif
    
    <!-- Custom Head Scripts -->
    @if($seo && $seo->custom_head_scripts)
        {!! $seo->custom_head_scripts !!}
    @endif
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        * { font-family: 'Cairo', sans-serif; }
    </style>
</head>
<body class="antialiased">
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
