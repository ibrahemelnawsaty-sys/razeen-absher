@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-cyan-50 py-8 px-4">
    <div class="container mx-auto max-w-6xl">
        
        <div class="mb-8 flex items-center gap-4">
            <a href="{{ route('dashboard') }}" class="text-blue-600 hover:text-blue-800 font-bold">
                ← رجوع
            </a>
            <div>
                <h1 class="text-3xl font-black text-gray-800">🏢 المراكز الحكومية</h1>
                <p class="text-gray-600">جميع المراكز والخدمات الحكومية القريبة</p>
            </div>
        </div>
        
        <!-- Centers Grid -->
        <div class="grid md:grid-cols-2 gap-6">
            @foreach([
                ['name' => 'مركز الأحوال المدنية', 'icon' => '🆔', 'wait' => '15 دقيقة', 'queue' => '8 أشخاص', 'hours' => '8:00 ص - 4:00 م', 'services' => ['إصدار هوية', 'تجديد', 'تحديث بيانات']],
                ['name' => 'مركز الجوازات', 'icon' => '🛂', 'wait' => '25 دقيقة', 'queue' => '12 شخص', 'hours' => '8:00 ص - 3:00 م', 'services' => ['جواز سفر', 'تجديد', 'تأشيرات']],
                ['name' => 'مكتب العمل', 'icon' => '💼', 'wait' => '20 دقيقة', 'queue' => '10 أشخاص', 'hours' => '8:00 ص - 4:00 م', 'services' => ['عقود عمل', 'نقل كفالة', 'شكاوى']],
                ['name' => 'مركز المرور', 'icon' => '🚗', 'wait' => '30 دقيقة', 'queue' => '15 شخص', 'hours' => '8:00 ص - 9:00 م', 'services' => ['رخصة قيادة', 'مخالفات', 'فحص دوري']]
            ] as $center)
            <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-100 to-cyan-100 rounded-xl flex items-center justify-center text-4xl">
                        {{ $center['icon'] }}
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-bold text-gray-800">{{ $center['name'] }}</h3>
                        <p class="text-sm text-gray-600">⏰ {{ $center['hours'] }}</p>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-3 mb-4">
                    <div class="p-3 bg-yellow-50 rounded-lg text-center">
                        <p class="text-xs text-gray-600 mb-1">وقت الانتظار</p>
                        <p class="font-bold text-yellow-700">{{ $center['wait'] }}</p>
                    </div>
                    <div class="p-3 bg-blue-50 rounded-lg text-center">
                        <p class="text-xs text-gray-600 mb-1">عدد المنتظرين</p>
                        <p class="font-bold text-blue-700">{{ $center['queue'] }}</p>
                    </div>
                </div>
                
                <div class="mb-4">
                    <p class="text-sm font-bold text-gray-700 mb-2">الخدمات المتاحة:</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach($center['services'] as $service)
                        <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-bold">{{ $service }}</span>
                        @endforeach
                    </div>
                </div>
                
                <a href="{{ route('map.index') }}" class="block w-full px-4 py-3 bg-gradient-to-r from-blue-500 to-cyan-500 text-white rounded-xl font-bold text-center hover:shadow-lg transition-all">
                    📍 عرض على الخريطة
                </a>
            </div>
            @endforeach
        </div>
        
    </div>
</div>
@endsection
