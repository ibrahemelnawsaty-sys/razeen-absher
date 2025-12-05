<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Absher') }} - الخريطة الذكية</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Leaflet CSS & JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" 
          integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" 
          crossorigin="anonymous" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" 
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" 
            crossorigin="anonymous"></script>
    
    <!-- Leaflet Heatmap -->
    <script src="https://unpkg.com/leaflet.heat@0.2.0/dist/leaflet-heat.js" 
            crossorigin="anonymous"></script>
    
    <!-- Leaflet Routing Machine -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css" 
          crossorigin="anonymous" />
    <script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js" 
            crossorigin="anonymous"></script>
    
    <!-- Vue 3 -->
    <script src="https://unpkg.com/vue@3/dist/vue.global.prod.js" 
            crossorigin="anonymous"></script>
    
    <!-- Custom Styles -->
    @include('map.styles')
</head>
<body class="antialiased bg-gradient-to-br from-gray-50 via-blue-50 to-purple-50">
    <div id="mapApp" class="h-screen flex flex-col" dir="rtl">
        
        <!-- Header Component -->
        @include('map.header')

        <!-- Main Content -->
        <div class="flex-1 flex overflow-hidden relative">
            
            <!-- Map Container -->
            <div class="flex-1 relative" style="z-index: 1;">
                <div id="map" class="w-full h-full" style="z-index: 1 !important;"></div>
                
                <!-- Heatmap Controls - أولاً -->
                @include('map.heatmap-controls')
                
                <!-- Municipal Projects - ثالثاً (مع زر التبديل) -->
                @include('map.municipal-projects')
                
                <!-- Emergency Services Panel - رابعاً -->
                @include('map.emergency-services')
                
                <!-- Service Details Modal - أخيراً (أعلى z-index) -->
                @include('map.service-details')
            </div>
        </div>
        
        <!-- Notifications -->
        @include('map.notifications')
    </div>
    
    <!-- Custom Scripts -->
    @include('map.scripts')
</body>
</html>