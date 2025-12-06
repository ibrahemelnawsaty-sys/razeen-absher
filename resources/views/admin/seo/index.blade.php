@extends('layouts.app')

@section('content')
<div class="flex h-screen bg-gray-100">
    
    @include('admin.partials.sidebar')
    
    <main class="flex-1 overflow-y-auto">
        
        <header class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-10">
            <div class="px-8 py-4">
                <h2 class="text-2xl font-black text-gray-800">🔍 إعدادات SEO</h2>
                <p class="text-sm text-gray-600">تحسين ظهور الموقع في محركات البحث</p>
            </div>
        </header>
        
        <div class="p-8">
            
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-green-700">
                    ✅ {{ session('success') }}
                </div>
            @endif
            
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-red-700">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <div x-data="{ activeTab: 'general' }" class="space-y-6">
                
                <!-- Tab Navigation -->
                <div class="bg-white rounded-2xl p-2 shadow-lg flex flex-wrap gap-2">
                    @foreach([
                        ['id' => 'general', 'icon' => '⚙️', 'name' => 'الإعدادات الأساسية'],
                        ['id' => 'images', 'icon' => '🖼️', 'name' => 'الصور والشعارات'],
                        ['id' => 'social', 'icon' => '📱', 'name' => 'السوشيال ميديا'],
                        ['id' => 'google', 'icon' => '🔗', 'name' => 'ربط Google'],
                        ['id' => 'advanced', 'icon' => '🛠️', 'name' => 'متقدم'],
                        ['id' => 'pages', 'icon' => '📄', 'name' => 'الصفحات'],
                    ] as $tab)
                    <button @click="activeTab = '{{ $tab['id'] }}'" 
                            :class="activeTab === '{{ $tab['id'] }}' ? 'bg-indigo-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                            class="px-6 py-3 rounded-xl font-bold transition-all flex items-center gap-2">
                        <span class="text-xl">{{ $tab['icon'] }}</span>
                        <span>{{ $tab['name'] }}</span>
                    </button>
                    @endforeach
                </div>
                
                <!-- General Settings Tab -->
                <div x-show="activeTab === 'general'" x-cloak class="bg-white rounded-2xl p-6 shadow-lg">
                    @include('admin.seo.partials.general', ['seo' => $seo])
                </div>
                
                <!-- Images Tab -->
                <div x-show="activeTab === 'images'" x-cloak class="bg-white rounded-2xl p-6 shadow-lg">
                    @include('admin.seo.partials.images', ['seo' => $seo])
                </div>
                
                <!-- Social Media Tab -->
                <div x-show="activeTab === 'social'" x-cloak class="bg-white rounded-2xl p-6 shadow-lg">
                    @include('admin.seo.partials.social', ['seo' => $seo])
                </div>
                
                <!-- Google Integration Tab -->
                <div x-show="activeTab === 'google'" x-cloak class="bg-white rounded-2xl p-6 shadow-lg">
                    @include('admin.seo.partials.google', ['seo' => $seo])
                </div>
                
                <!-- Advanced Tab -->
                <div x-show="activeTab === 'advanced'" x-cloak class="bg-white rounded-2xl p-6 shadow-lg">
                    @include('admin.seo.partials.advanced', ['seo' => $seo])
                </div>
                
                <!-- Pages SEO Tab -->
                <div x-show="activeTab === 'pages'" x-cloak class="space-y-6">
                    @include('admin.seo.partials.pages', ['pages' => $pages])
                </div>
                
            </div>
        </div>
    </main>
</div>

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<style>[x-cloak] { display: none !important; }</style>
@endsection
