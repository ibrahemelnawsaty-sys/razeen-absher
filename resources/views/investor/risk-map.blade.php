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
                    <h2 class="text-2xl font-black text-gray-800">🗺️ خريطة المخاطر</h2>
                    <p class="text-sm text-gray-600">تحليل المخاطر في المناطق المختلفة</p>
                </div>
            </div>
        </header>
        
        <div class="p-8">
            
            <!-- Risk Legend -->
            <div class="bg-white rounded-2xl p-6 shadow-lg mb-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4">مستويات المخاطر</h3>
                <div class="grid md:grid-cols-4 gap-4">
                    <div class="p-4 bg-green-50 rounded-xl border-2 border-green-200 text-center">
                        <p class="text-3xl mb-2">🟢</p>
                        <p class="font-bold text-green-700">مخاطر منخفضة</p>
                        <p class="text-sm text-gray-600 mt-1">0-25%</p>
                    </div>
                    <div class="p-4 bg-yellow-50 rounded-xl border-2 border-yellow-200 text-center">
                        <p class="text-3xl mb-2">🟡</p>
                        <p class="font-bold text-yellow-700">مخاطر متوسطة</p>
                        <p class="text-sm text-gray-600 mt-1">26-50%</p>
                    </div>
                    <div class="p-4 bg-orange-50 rounded-xl border-2 border-orange-200 text-center">
                        <p class="text-3xl mb-2">🟠</p>
                        <p class="font-bold text-orange-700">مخاطر عالية</p>
                        <p class="text-sm text-gray-600 mt-1">51-75%</p>
                    </div>
                    <div class="p-4 bg-red-50 rounded-xl border-2 border-red-200 text-center">
                        <p class="text-3xl mb-2">🔴</p>
                        <p class="font-bold text-red-700">مخاطر عالية جداً</p>
                        <p class="text-sm text-gray-600 mt-1">76-100%</p>
                    </div>
                </div>
            </div>
            
            <!-- Risk Areas -->
            <div class="grid md:grid-cols-2 gap-6">
                @foreach([
                    ['name' => 'حي الياسمين', 'risk' => 15, 'level' => 'منخفض', 'color' => 'green', 'factors' => ['خدمات ممتازة', 'بنية تحتية قوية', 'مستوى أمان عالي']],
                    ['name' => 'حي النخيل', 'risk' => 35, 'level' => 'متوسط', 'color' => 'yellow', 'factors' => ['نقص في الخدمات', 'مشاريع قيد التنفيذ', 'ازدحام مروري']],
                    ['name' => 'حي الصحراء', 'risk' => 65, 'level' => 'عالي', 'color' => 'orange', 'factors' => ['بعد عن المركز', 'بنية تحتية ضعيفة', 'نقص أمني']],
                    ['name' => 'حي المستقبل', 'risk' => 85, 'level' => 'عالي جداً', 'color' => 'red', 'factors' => ['غير مطور', 'لا توجد خدمات', 'مخاطر طبيعية']]
                ] as $area)
                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-bold text-gray-800">{{ $area['name'] }}</h3>
                        <span class="px-4 py-2 bg-{{ $area['color'] }}-100 text-{{ $area['color'] }}-700 rounded-full font-bold">
                            {{ $area['level'] }}
                        </span>
                    </div>
                    
                    <div class="mb-4">
                        <div class="flex justify-between text-sm mb-2">
                            <span class="text-gray-700 font-bold">مستوى المخاطر</span>
                            <span class="text-{{ $area['color'] }}-600 font-bold">{{ $area['risk'] }}%</span>
                        </div>
                        <div class="h-4 bg-gray-200 rounded-full overflow-hidden">
                            <div class="h-full bg-{{ $area['color'] }}-500" style="width: {{ $area['risk'] }}%"></div>
                        </div>
                    </div>
                    
                    <div class="space-y-2">
                        <p class="text-sm font-bold text-gray-700">عوامل المخاطر:</p>
                        @foreach($area['factors'] as $factor)
                        <div class="flex items-center gap-2 text-sm text-gray-600">
                            <span class="text-{{ $area['color'] }}-500">•</span>
                            <span>{{ $factor }}</span>
                        </div>
                        @endforeach
                    </div>
                    
                    <a href="{{ route('map.index') }}" class="block mt-4 w-full px-4 py-3 bg-{{ $area['color'] }}-500 text-white rounded-xl font-bold text-center hover:bg-{{ $area['color'] }}-600">
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
