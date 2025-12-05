@extends('layouts.app')

@section('content')
<div x-data="{ sidebarOpen: true }" class="flex h-screen bg-gray-100">
    
    <!-- Sidebar -->
    @include('investor.partials.sidebar')
    
    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto">
        
        <header class="bg-white shadow-sm border-b border-gray-200">
            <div class="px-8 py-4 flex items-center gap-4">
                <button @click="sidebarOpen = !sidebarOpen" 
                        x-show="!sidebarOpen"
                        class="w-10 h-10 bg-purple-500 hover:bg-purple-600 rounded-xl flex items-center justify-center transition-all">
                    <span class="text-white text-xl">☰</span>
                </button>
                <div>
                    <h2 class="text-2xl font-black text-gray-800">🎯 تحليل المناطق</h2>
                    <p class="text-sm text-gray-600">تقييم شامل للمناطق الاستثمارية</p>
                </div>
            </div>
        </header>
        
        <div class="p-8">
            <div class="grid md:grid-cols-2 gap-6">
                @foreach($areas as $area)
                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-black text-gray-800">{{ $area['name'] }}</h3>
                        <span class="px-4 py-2 bg-green-100 text-green-700 rounded-full font-bold">
                            {{ $area['score'] }}/100
                        </span>
                    </div>
                    
                    @foreach([
                        ['label' => 'الخدمات', 'value' => $area['services'], 'color' => 'blue'],
                        ['label' => 'البنية التحتية', 'value' => $area['infrastructure'], 'color' => 'green'],
                        ['label' => 'السلامة', 'value' => $area['safety'], 'color' => 'purple'],
                        ['label' => 'المشاريع', 'value' => $area['projects'], 'color' => 'orange']
                    ] as $metric)
                    <div class="mb-4">
                        <div class="flex justify-between text-sm mb-2">
                            <span class="text-gray-700 font-bold">{{ $metric['label'] }}</span>
                            <span class="text-{{ $metric['color'] }}-600 font-bold">{{ $metric['value'] }}%</span>
                        </div>
                        <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                            <div class="h-full bg-{{ $metric['color'] }}-500" style="width: {{ $metric['value'] }}%"></div>
                        </div>
                    </div>
                    @endforeach
                    
                    <a href="{{ route('map.index') }}" class="block mt-4 w-full px-4 py-3 bg-purple-500 text-white rounded-xl font-bold text-center hover:bg-purple-600">
                        عرض على الخريطة
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        
    </main>
    
</div>

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endsection
