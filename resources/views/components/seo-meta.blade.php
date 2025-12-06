@php
    $seo = $seo ?? \App\Models\SeoSetting::first();
@endphp

@if($seo)
    <!-- Primary Meta Tags -->
    <title>{{ $seo->site_title ?? config('app.name', 'رزين') }}</title>
    <meta name="description" content="{{ $seo->meta_description ?? '' }}">
    <meta name="keywords" content="{{ $seo->meta_keywords ?? '' }}">
    <meta name="author" content="{{ $seo->business_name ?? 'رزين' }}">
    <meta name="robots" content="{{ $seo->indexing_enabled ? 'index' : 'noindex' }}, {{ $seo->follow_links ? 'follow' : 'nofollow' }}">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">
    
    <!-- Favicon -->
    @if($seo->favicon)
        <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $seo->favicon) }}">
        <link rel="shortcut icon" href="{{ asset('storage/' . $seo->favicon) }}">
    @endif
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $seo->site_title ?? config('app.name') }}">
    <meta property="og:description" content="{{ $seo->meta_description ?? '' }}">
    <meta property="og:site_name" content="{{ $seo->business_name ?? config('app.name') }}">
    <meta property="og:locale" content="ar_SA">
    @if($seo->og_image)
        <meta property="og:image" content="{{ asset('storage/' . $seo->og_image) }}">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="630">
    @endif
    
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="{{ $seo->site_title ?? config('app.name') }}">
    <meta name="twitter:description" content="{{ $seo->meta_description ?? '' }}">
    @if($seo->twitter_handle)
        <meta name="twitter:site" content="{{ '@' . $seo->twitter_handle }}">
        <meta name="twitter:creator" content="{{ '@' . $seo->twitter_handle }}">
    @endif
    @if($seo->og_image)
        <meta name="twitter:image" content="{{ asset('storage/' . $seo->og_image) }}">
    @endif
    
    <!-- Google Verification -->
    @if($seo->google_site_verification)
        <meta name="google-site-verification" content="{{ $seo->google_site_verification }}">
    @endif
    
    <!-- Google Analytics -->
    @if($seo->google_analytics_id)
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ $seo->google_analytics_id }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '{{ $seo->google_analytics_id }}');
        </script>
    @endif
    
    <!-- Google Tag Manager -->
    @if($seo->google_tag_manager_id)
        <script>
            (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','{{ $seo->google_tag_manager_id }}');
        </script>
    @endif
    
    <!-- Structured Data JSON-LD -->
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
    
    <!-- Custom Head Scripts -->
    @if($seo->custom_head_scripts)
        {!! $seo->custom_head_scripts !!}
    @endif
@endif
