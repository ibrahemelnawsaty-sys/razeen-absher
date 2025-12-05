@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-red-50 to-pink-50 py-8 px-4">
    <div class="container mx-auto max-w-6xl">
        
        <div class="mb-8 flex items-center gap-4">
            <a href="{{ route('dashboard') }}" class="text-red-600 hover:text-red-800 font-bold">
                ← رجوع
            </a>
            <div>
                <h1 class="text-3xl font-black text-gray-800">🚑 خدمات الطوارئ</h1>
                <p class="text-gray-600">الوصول السريع لأقرب خدمات الطوارئ</p>
            </div>
        </div>
        
        <!-- Emergency Numbers -->
        <div class="grid md:grid-cols-4 gap-6 mb-8">
            <a href="tel:997" class="bg-gradient-to-br from-red-500 to-red-600 rounded-2xl p-6 text-white shadow-xl hover:shadow-2xl transition-all hover:-translate-y-1">
                <div class="text-5xl mb-3 text-center">🚑</div>
                <p class="text-center font-bold text-xl mb-2">الإسعاف</p>
                <p class="text-center text-3xl font-black">997</p>
            </a>
            
            <a href="tel:998" class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl p-6 text-white shadow-xl hover:shadow-2xl transition-all hover:-translate-y-1">
                <div class="text-5xl mb-3 text-center">🚒</div>
                <p class="text-center font-bold text-xl mb-2">الدفاع المدني</p>
                <p class="text-center text-3xl font-black">998</p>
            </a>
            
            <a href="tel:911" class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 text-white shadow-xl hover:shadow-2xl transition-all hover:-translate-y-1">
                <div class="text-5xl mb-3 text-center">👮</div>
                <p class="text-center font-bold text-xl mb-2">الشرطة</p>
                <p class="text-center text-3xl font-black">911</p>
            </a>
            
            <a href="tel:937" class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl p-6 text-white shadow-xl hover:shadow-2xl transition-all hover:-translate-y-1">
                <div class="text-5xl mb-3 text-center">💊</div>
                <p class="text-center font-bold text-xl mb-2">الصيدلية</p>
                <p class="text-center text-3xl font-black">937</p>
            </a>
        </div>
        
        <!-- Nearby Services -->
        <div class="bg-white rounded-2xl p-6 shadow-lg mb-6">
            <h2 class="text-2xl font-black text-gray-800 mb-6">🏥 أقرب الخدمات</h2>
            
            <div class="space-y-4">
                @foreach([
                    ['name' => 'مستشفى الملك فهد', 'type' => 'hospital', 'distance' => '2.5 كم', 'time' => '5 دقائق', 'icon' => '🏥', 'status' => 'مفتوح', 'color' => 'green'],
                    ['name' => 'مركز الإسعاف الرئيسي', 'type' => 'ambulance', 'distance' => '1.8 كم', 'time' => '3 دقائق', 'icon' => '🚑', 'status' => 'متاح', 'color' => 'green'],
                    ['name' => 'الدفاع المدني', 'type' => 'fire', 'distance' => '3.2 كم', 'time' => '7 دقائق', 'icon' => '🚒', 'status' => 'جاهز', 'color' => 'green']
                ] as $service)
                <div class="p-6 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl hover:shadow-lg transition-all">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 bg-white rounded-xl flex items-center justify-center text-4xl shadow-md">
                                {{ $service['icon'] }}
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-800">{{ $service['name'] }}</h3>
                                <p class="text-sm text-gray-600 mt-1">📍 {{ $service['distance'] }} - ⏱️ {{ $service['time'] }}</p>
                                <span class="inline-block mt-2 px-3 py-1 bg-{{ $service['color'] }}-100 text-{{ $service['color'] }}-700 rounded-full text-xs font-bold">
                                    {{ $service['status'] }}
                                </span>
                            </div>
                        </div>
                        <a href="{{ route('map.index') }}" class="px-6 py-3 bg-indigo-500 text-white rounded-xl font-bold hover:bg-indigo-600 transition-colors">
                            🗺️ عرض على الخريطة
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        
    </div>
</div>
@endsection
