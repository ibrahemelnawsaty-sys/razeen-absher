@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-yellow-50 to-orange-50 py-8 px-4">
    <div class="container mx-auto max-w-6xl">
        
        <div class="mb-8 flex items-center gap-4">
            <a href="{{ route('dashboard') }}" class="text-orange-600 hover:text-orange-800 font-bold">
                ← رجوع
            </a>
            <div>
                <h1 class="text-3xl font-black text-gray-800">🛣️ جودة الطرق</h1>
                <p class="text-gray-600">تقييم حالة الطرق في منطقتك</p>
            </div>
        </div>
        
        <!-- Overall Quality -->
        <div class="bg-white rounded-2xl p-8 shadow-lg mb-6">
            <div class="text-center mb-6">
                <p class="text-6xl mb-4">🛣️</p>
                <p class="text-5xl font-black text-green-600 mb-2">88%</p>
                <p class="text-xl text-gray-600">جودة الطرق العامة في حيك</p>
            </div>
            <div class="h-6 bg-gray-200 rounded-full overflow-hidden">
                <div class="h-full bg-gradient-to-r from-green-500 to-emerald-500" style="width: 88%"></div>
            </div>
        </div>
        
        <!-- Roads Details -->
        <div class="grid md:grid-cols-2 gap-6">
            @foreach([
                ['name' => 'شارع الأمير محمد', 'quality' => 95, 'lighting' => 'ممتاز', 'maintenance' => 'حديثة', 'status' => 'ممتاز'],
                ['name' => 'طريق الملك فهد', 'quality' => 90, 'lighting' => 'جيد جداً', 'maintenance' => 'جيدة', 'status' => 'جيد جداً'],
                ['name' => 'شارع التخصصي', 'quality' => 75, 'lighting' => 'جيد', 'maintenance' => 'مقبولة', 'status' => 'جيد'],
                ['name' => 'طريق العليا', 'quality' => 85, 'lighting' => 'ممتاز', 'maintenance' => 'جيدة', 'status' => 'جيد جداً']
            ] as $road)
            <div class="bg-white rounded-2xl p-6 shadow-lg">
                <h3 class="text-lg font-bold text-gray-800 mb-4">{{ $road['name'] }}</h3>
                
                <div class="mb-4">
                    <div class="flex justify-between text-sm mb-2">
                        <span class="text-gray-600">جودة التعبيد</span>
                        <span class="font-bold text-green-600">{{ $road['quality'] }}%</span>
                    </div>
                    <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                        <div class="h-full bg-green-500" style="width: {{ $road['quality'] }}%"></div>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-3">
                    <div class="p-3 bg-blue-50 rounded-lg text-center">
                        <p class="text-xs text-gray-600 mb-1">الإنارة</p>
                        <p class="font-bold text-blue-700 text-sm">{{ $road['lighting'] }}</p>
                    </div>
                    <div class="p-3 bg-purple-50 rounded-lg text-center">
                        <p class="text-xs text-gray-600 mb-1">الصيانة</p>
                        <p class="font-bold text-purple-700 text-sm">{{ $road['maintenance'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
    </div>
</div>
@endsection
