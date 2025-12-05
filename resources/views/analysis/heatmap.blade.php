@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 to-pink-50 py-8 px-4">
    <div class="container mx-auto">
        
        <div class="mb-8 flex items-center gap-4">
            <a href="{{ route('dashboard') }}" class="text-purple-600 hover:text-purple-800">
                ← رجوع
            </a>
            <div>
                <h1 class="text-3xl font-black text-gray-800">🗺️ خريطة حرارية للمخاطر</h1>
                <p class="text-gray-600">تحليل شامل للمخاطر في المناطق المختلفة</p>
            </div>
        </div>
        
        <div class="grid md:grid-cols-3 gap-6 mb-6">
            <div class="bg-white rounded-2xl p-6 shadow-lg">
                <h3 class="font-bold text-gray-800 mb-4">🔴 مناطق عالية المخاطر</h3>
                <ul class="space-y-2 text-sm">
                    <li class="flex justify-between">
                        <span>حي النخيل</span>
                        <span class="font-bold text-red-600">85%</span>
                    </li>
                    <li class="flex justify-between">
                        <span>حي الملز</span>
                        <span class="font-bold text-red-600">78%</span>
                    </li>
                </ul>
            </div>
            
            <div class="bg-white rounded-2xl p-6 shadow-lg">
                <h3 class="font-bold text-gray-800 mb-4">🟡 مناطق متوسطة المخاطر</h3>
                <ul class="space-y-2 text-sm">
                    <li class="flex justify-between">
                        <span>حي العليا</span>
                        <span class="font-bold text-yellow-600">55%</span>
                    </li>
                    <li class="flex justify-between">
                        <span>حي السليمانية</span>
                        <span class="font-bold text-yellow-600">48%</span>
                    </li>
                </ul>
            </div>
            
            <div class="bg-white rounded-2xl p-6 shadow-lg">
                <h3 class="font-bold text-gray-800 mb-4">🟢 مناطق منخفضة المخاطر</h3>
                <ul class="space-y-2 text-sm">
                    <li class="flex justify-between">
                        <span>حي الياسمين</span>
                        <span class="font-bold text-green-600">15%</span>
                    </li>
                    <li class="flex justify-between">
                        <span>حي الورود</span>
                        <span class="font-bold text-green-600">12%</span>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="bg-white rounded-2xl p-6 shadow-lg">
            <div class="flex justify-center items-center h-96 text-gray-400">
                <div class="text-center">
                    <p class="text-6xl mb-4">🗺️</p>
                    <p class="text-xl font-bold">الخريطة الحرارية التفاعلية</p>
                    <p class="text-sm mt-2">قريباً...</p>
                    <a href="{{ route('map.index') }}" class="mt-4 inline-block px-6 py-3 bg-purple-500 text-white rounded-xl font-bold hover:bg-purple-600">
                        افتح الخريطة الرئيسية
                    </a>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection
