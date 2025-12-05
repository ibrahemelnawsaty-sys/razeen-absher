@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 to-emerald-50 py-8 px-4">
    <div class="container mx-auto max-w-6xl">
        
        <div class="mb-8 flex items-center gap-4">
            <a href="{{ route('dashboard') }}" class="text-green-600 hover:text-green-800 font-bold">
                ← رجوع
            </a>
            <div>
                <h1 class="text-3xl font-black text-gray-800">🏘️ معلومات حي الياسمين</h1>
                <p class="text-gray-600">كل ما تحتاج معرفته عن حيك</p>
            </div>
        </div>
        
        <!-- Overview Stats -->
        <div class="grid md:grid-cols-4 gap-6 mb-8">
            <a href="#projects-section" class="bg-white rounded-2xl p-6 shadow-lg text-center hover:shadow-xl transition-all hover:-translate-y-1 cursor-pointer">
                <div class="text-4xl mb-3">🏗️</div>
                <p class="text-3xl font-black text-gray-800">3</p>
                <p class="text-sm text-gray-600 mt-2">مشاريع نشطة</p>
            </a>
            
            <a href="#services-section" class="bg-white rounded-2xl p-6 shadow-lg text-center hover:shadow-xl transition-all hover:-translate-y-1 cursor-pointer">
                <div class="text-4xl mb-3">🏥</div>
                <p class="text-3xl font-black text-gray-800">12</p>
                <p class="text-sm text-gray-600 mt-2">خدمات عامة</p>
            </a>
            
            <a href="#permits-section" class="bg-white rounded-2xl p-6 shadow-lg text-center hover:shadow-xl transition-all hover:-translate-y-1 cursor-pointer">
                <div class="text-4xl mb-3">📋</div>
                <p class="text-3xl font-black text-gray-800">5</p>
                <p class="text-sm text-gray-600 mt-2">تصاريح بناء</p>
            </a>
            
            <div class="bg-white rounded-2xl p-6 shadow-lg text-center">
                <div class="text-4xl mb-3">🛡️</div>
                <p class="text-3xl font-black text-gray-800">92%</p>
                <p class="text-sm text-gray-600 mt-2">مستوى السلامة</p>
            </div>
        </div>
        
        <!-- Active Projects Section -->
        <div id="projects-section" class="bg-white rounded-2xl p-6 shadow-lg mb-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-black text-gray-800">🏗️ المشاريع النشطة</h2>
                <span class="px-4 py-2 bg-blue-100 text-blue-700 rounded-lg font-bold">3 مشاريع</span>
            </div>
            
            <div class="space-y-4">
                @foreach([
                    ['name' => 'مشروع تطوير الحديقة المركزية', 'contractor' => 'شركة العمران', 'budget' => '2.5 مليون ريال', 'progress' => 65, 'status' => 'قيد التنفيذ', 'completion' => '3 أشهر متبقية', 'start' => '2024-01-15'],
                    ['name' => 'تحسين الإنارة في الشوارع', 'contractor' => 'الشركة السعودية للكهرباء', 'budget' => '1.2 مليون ريال', 'progress' => 85, 'status' => 'شبه مكتمل', 'completion' => 'شهر واحد متبقي', 'start' => '2023-10-01'],
                    ['name' => 'إنشاء ممرات مشاة', 'contractor' => 'شركة بن لادن', 'budget' => '3.8 مليون ريال', 'progress' => 40, 'status' => 'بداية التنفيذ', 'completion' => '6 أشهر متبقية', 'start' => '2024-03-01']
                ] as $project)
                <div class="p-6 bg-gradient-to-r from-blue-50 to-cyan-50 rounded-xl border-2 border-blue-100 hover:border-blue-300 transition-all">
                    <div class="flex justify-between items-start mb-4">
                        <div class="flex-1">
                            <h3 class="font-bold text-gray-800 text-lg">{{ $project['name'] }}</h3>
                            <div class="grid grid-cols-2 gap-2 mt-3">
                                <p class="text-sm text-gray-600">👷 المقاول: {{ $project['contractor'] }}</p>
                                <p class="text-sm text-gray-600">💰 الميزانية: {{ $project['budget'] }}</p>
                                <p class="text-sm text-gray-600">📅 البداية: {{ $project['start'] }}</p>
                                <p class="text-sm text-gray-600">⏱️ {{ $project['completion'] }}</p>
                            </div>
                        </div>
                        <span class="px-4 py-2 bg-blue-100 text-blue-700 rounded-full text-xs font-bold whitespace-nowrap">
                            {{ $project['status'] }}
                        </span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="flex-1 h-4 bg-gray-200 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-blue-500 to-cyan-500 rounded-full" style="width: {{ $project['progress'] }}%"></div>
                        </div>
                        <span class="text-sm font-bold text-blue-600">{{ $project['progress'] }}%</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        
        <!-- Public Services Section -->
        <div id="services-section" class="bg-white rounded-2xl p-6 shadow-lg mb-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-black text-gray-800">🏥 الخدمات العامة القريبة</h2>
                <span class="px-4 py-2 bg-green-100 text-green-700 rounded-lg font-bold">12 خدمة</span>
            </div>
            
            <div class="grid md:grid-cols-2 gap-4">
                @foreach([
                    ['name' => 'مدرسة الياسمين الابتدائية', 'type' => 'مدرسة', 'distance' => '500م', 'icon' => '🏫', 'rating' => '4.5', 'hours' => '7:00 ص - 2:00 م'],
                    ['name' => 'مستوصف الحي', 'type' => 'صحة', 'distance' => '800م', 'icon' => '🏥', 'rating' => '4.2', 'hours' => '8:00 ص - 10:00 م'],
                    ['name' => 'مسجد النور', 'type' => 'مسجد', 'distance' => '200م', 'icon' => '🕌', 'rating' => '4.8', 'hours' => 'مفتوح دائماً'],
                    ['name' => 'حديقة الأطفال', 'type' => 'ترفيه', 'distance' => '300م', 'icon' => '🌳', 'rating' => '4.6', 'hours' => '24 ساعة'],
                    ['name' => 'صيدلية النهدي', 'type' => 'صيدلية', 'distance' => '400م', 'icon' => '💊', 'rating' => '4.4', 'hours' => '8:00 ص - 12:00 ص'],
                    ['name' => 'سوق الحي', 'type' => 'تسوق', 'distance' => '600م', 'icon' => '🛒', 'rating' => '4.3', 'hours' => '9:00 ص - 11:00 م'],
                    ['name' => 'مكتبة عامة', 'type' => 'ثقافة', 'distance' => '700م', 'icon' => '📚', 'rating' => '4.5', 'hours' => '8:00 ص - 8:00 م'],
                    ['name' => 'نادي رياضي', 'type' => 'رياضة', 'distance' => '900م', 'icon' => '⚽', 'rating' => '4.7', 'hours' => '6:00 ص - 11:00 م'],
                    ['name' => 'مطعم الياسمين', 'type' => 'مطعم', 'distance' => '350م', 'icon' => '🍽️', 'rating' => '4.6', 'hours' => '12:00 م - 12:00 ص'],
                    ['name' => 'بنك الراجحي', 'type' => 'بنك', 'distance' => '550م', 'icon' => '🏦', 'rating' => '4.4', 'hours' => '9:00 ص - 5:00 م'],
                    ['name' => 'مركز بريد', 'type' => 'خدمات', 'distance' => '650م', 'icon' => '📮', 'rating' => '4.1', 'hours' => '8:00 ص - 4:00 م'],
                    ['name' => 'محطة وقود', 'type' => 'وقود', 'distance' => '1.2 كم', 'icon' => '⛽', 'rating' => '4.3', 'hours' => '24 ساعة']
                ] as $service)
                <div class="p-4 bg-gray-50 rounded-xl flex items-center gap-3 hover:bg-gray-100 transition-all border-2 border-transparent hover:border-green-200">
                    <div class="text-3xl">{{ $service['icon'] }}</div>
                    <div class="flex-1">
                        <p class="font-bold text-gray-800">{{ $service['name'] }}</p>
                        <div class="flex items-center gap-2 mt-1">
                            <span class="text-xs text-gray-600">{{ $service['type'] }}</span>
                            <span class="text-xs text-gray-400">•</span>
                            <span class="text-xs text-gray-600">📍 {{ $service['distance'] }}</span>
                            <span class="text-xs text-gray-400">•</span>
                            <span class="text-xs text-yellow-600">⭐ {{ $service['rating'] }}</span>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">⏰ {{ $service['hours'] }}</p>
                    </div>
                    <a href="{{ route('map.index') }}" class="px-3 py-2 bg-green-500 text-white rounded-lg text-xs font-bold hover:bg-green-600 transition-colors">
                        خريطة
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        
        <!-- Building Permits Section -->
        <div id="permits-section" class="bg-white rounded-2xl p-6 shadow-lg mb-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-black text-gray-800">📋 تصاريح البناء القريبة</h2>
                <span class="px-4 py-2 bg-yellow-100 text-yellow-700 rounded-lg font-bold">5 تصاريح</span>
            </div>
            
            <div class="space-y-4">
                @foreach([
                    ['type' => 'مبنى سكني', 'location' => 'شارع الأمير محمد', 'owner' => 'شركة الأمل للتطوير', 'distance' => '200م', 'status' => 'قيد الإنشاء', 'floors' => '5 طوابق', 'completion' => '2024-12-01', 'statusColor' => 'blue'],
                    ['type' => 'محل تجاري', 'location' => 'طريق الملك فهد', 'owner' => 'مؤسسة النخيل', 'distance' => '500م', 'status' => 'مكتمل', 'floors' => 'طابقين', 'completion' => '2024-06-15', 'statusColor' => 'green'],
                    ['type' => 'فيلا خاصة', 'location' => 'حي الورود', 'owner' => 'مالك خاص', 'distance' => '350م', 'status' => 'بدء البناء', 'floors' => '3 طوابق', 'completion' => '2025-03-01', 'statusColor' => 'yellow'],
                    ['type' => 'عمارة سكنية', 'location' => 'شارع التخصصي', 'owner' => 'مجموعة الراجحي', 'distance' => '750م', 'status' => 'قيد الإنشاء', 'floors' => '8 طوابق', 'completion' => '2025-01-15', 'statusColor' => 'blue'],
                    ['type' => 'مركز تجاري', 'location' => 'طريق العليا', 'owner' => 'شركة السلام', 'distance' => '1 كم', 'status' => 'التخطيط', 'floors' => '4 طوابق', 'completion' => '2025-06-01', 'statusColor' => 'orange']
                ] as $permit)
                <div class="p-5 bg-gradient-to-r from-{{ $permit['statusColor'] }}-50 to-gray-50 rounded-xl border-2 border-{{ $permit['statusColor'] }}-100 hover:border-{{ $permit['statusColor'] }}-300 transition-all">
                    <div class="flex justify-between items-start mb-3">
                        <div class="flex-1">
                            <h3 class="font-bold text-gray-800 text-lg">{{ $permit['type'] }}</h3>
                            <div class="grid grid-cols-2 gap-2 mt-2">
                                <p class="text-sm text-gray-600">📍 الموقع: {{ $permit['location'] }}</p>
                                <p class="text-sm text-gray-600">👷 المالك: {{ $permit['owner'] }}</p>
                                <p class="text-sm text-gray-600">📏 المسافة: {{ $permit['distance'] }}</p>
                                <p class="text-sm text-gray-600">🏢 {{ $permit['floors'] }}</p>
                                <p class="text-sm text-gray-600">📅 الإنجاز: {{ $permit['completion'] }}</p>
                            </div>
                        </div>
                        <span class="px-4 py-2 bg-{{ $permit['statusColor'] }}-100 text-{{ $permit['statusColor'] }}-700 rounded-full text-xs font-bold whitespace-nowrap">
                            {{ $permit['status'] }}
                        </span>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('map.index') }}" class="flex-1 px-4 py-2 bg-{{ $permit['statusColor'] }}-500 text-white rounded-lg text-sm font-bold text-center hover:bg-{{ $permit['statusColor'] }}-600 transition-colors">
                            📍 عرض على الخريطة
                        </a>
                        <button class="px-4 py-2 bg-white text-gray-700 rounded-lg text-sm font-bold hover:bg-gray-100 transition-colors border-2 border-gray-200">
                            📄 التفاصيل
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        
        <!-- Safety & Road Quality -->
        <div class="grid md:grid-cols-2 gap-6">
            <div class="bg-white rounded-2xl p-6 shadow-lg">
                <h2 class="text-xl font-black text-gray-800 mb-4 flex items-center gap-2">
                    <span class="text-2xl">🛡️</span>
                    مستوى السلامة
                </h2>
                <div class="h-4 bg-gray-200 rounded-full overflow-hidden mb-3">
                    <div class="h-full bg-gradient-to-r from-green-500 to-emerald-500" style="width: 92%"></div>
                </div>
                <p class="text-3xl font-black text-green-600 mb-2">92%</p>
                <p class="text-sm text-gray-600">منطقة آمنة مع خدمات طوارئ متكاملة</p>
            </div>
            
            <div class="bg-white rounded-2xl p-6 shadow-lg">
                <h2 class="text-xl font-black text-gray-800 mb-4 flex items-center gap-2">
                    <span class="text-2xl">🛣️</span>
                    جودة الطرق
                </h2>
                <div class="h-4 bg-gray-200 rounded-full overflow-hidden mb-3">
                    <div class="h-full bg-gradient-to-r from-blue-500 to-cyan-500" style="width: 88%"></div>
                </div>
                <p class="text-3xl font-black text-blue-600 mb-2">88%</p>
                <p class="text-sm text-gray-600">طرق معبدة وآمنة مع إنارة ممتازة</p>
            </div>
        </div>
        
    </div>
</div>
@endsection
