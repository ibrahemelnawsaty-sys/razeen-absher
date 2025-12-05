@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 to-pink-50 py-8 px-4">
    <div class="container mx-auto max-w-6xl">
        
        <div class="mb-8 flex justify-between items-center">
            <div class="flex items-center gap-4">
                <a href="{{ route('dashboard') }}" class="text-purple-600 hover:text-purple-800 font-bold">
                    ← رجوع
                </a>
                <div>
                    <h1 class="text-3xl font-black text-gray-800">🏠 عقاراتي</h1>
                    <p class="text-gray-600">إدارة ومتابعة عقاراتك</p>
                </div>
            </div>
            <button class="px-6 py-3 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-xl font-bold hover:shadow-xl transition-all">
                ➕ إضافة عقار
            </button>
        </div>
        
        <!-- Properties Grid -->
        <div class="grid md:grid-cols-2 gap-6">
            @foreach([
                ['name' => 'فيلا سكنية - حي الياسمين', 'type' => 'فيلا', 'area' => '350 م²', 'status' => 'مملوك', 'value' => '1,200,000 ريال', 'safety' => 95, 'projects' => 2],
                ['name' => 'شقة - حي العليا', 'type' => 'شقة', 'area' => '180 م²', 'status' => 'مملوك', 'value' => '650,000 ريال', 'safety' => 88, 'projects' => 1]
            ] as $property)
            <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">{{ $property['name'] }}</h3>
                        <p class="text-sm text-gray-600 mt-1">{{ $property['type'] }} - {{ $property['area'] }}</p>
                    </div>
                    <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold">
                        {{ $property['status'] }}
                    </span>
                </div>
                
                <div class="grid grid-cols-2 gap-3 mb-4">
                    <div class="p-3 bg-purple-50 rounded-lg">
                        <p class="text-xs text-gray-600 mb-1">القيمة التقديرية</p>
                        <p class="font-bold text-purple-700">{{ $property['value'] }}</p>
                    </div>
                    <div class="p-3 bg-blue-50 rounded-lg">
                        <p class="text-xs text-gray-600 mb-1">مستوى السلامة</p>
                        <p class="font-bold text-blue-700">{{ $property['safety'] }}%</p>
                    </div>
                </div>
                
                <div class="mb-4 p-3 bg-yellow-50 rounded-lg">
                    <p class="text-sm font-bold text-gray-700 mb-1">🏗️ المشاريع القريبة:</p>
                    <p class="text-xs text-gray-600">{{ $property['projects'] }} مشروع تطوير نشط في المنطقة</p>
                </div>
                
                <div class="flex gap-2">
                    <a href="{{ route('map.index') }}" class="flex-1 px-4 py-2 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-lg font-bold text-center hover:shadow-lg transition-all">
                        🗺️ عرض على الخريطة
                    </a>
                    <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg font-bold hover:bg-gray-200">
                        تفاصيل
                    </button>
                </div>
            </div>
            @endforeach
        </div>
        
    </div>
</div>
@endsection
