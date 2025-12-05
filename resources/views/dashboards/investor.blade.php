@extends('layouts.app')

@section('content')
<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gradient-to-br from-gray-50 to-gray-100 overflow-hidden">
    
    <!-- Sidebar -->
    <aside x-show="sidebarOpen" 
           @click.away="sidebarOpen = false"
           class="w-72 bg-gradient-to-b from-purple-900 via-indigo-900 to-purple-900 text-white flex-shrink-0 overflow-y-auto relative">
        
        <!-- Close Button -->
        <button @click="sidebarOpen = false" 
                class="absolute top-4 left-4 w-8 h-8 bg-white/10 hover:bg-white/20 rounded-lg flex items-center justify-center transition-all z-50">
            <span class="text-white text-xl">✕</span>
        </button>
        
        <!-- Logo -->
        <div class="p-6 border-b border-white/10">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-white/20 backdrop-blur-lg rounded-xl flex items-center justify-center">
                    <span class="text-2xl">💼</span>
                </div>
                <div>
                    <h1 class="text-lg font-black">لوحة المستثمر</h1>
                    <p class="text-xs text-purple-200">{{ auth()->user()->organization }}</p>
                </div>
            </div>
        </div>
        
        <!-- Navigation -->
        <nav class="p-4 space-y-2">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('dashboard') ? 'bg-white/20 backdrop-blur-lg' : '' }} rounded-xl hover:bg-white/10 transition-all">
                <span class="text-2xl">📊</span>
                <span class="font-bold">لوحة المعلومات</span>
            </a>
            
            <a href="{{ route('investor.area-analysis') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/10 transition-all">
                <span class="text-2xl">🎯</span>
                <span class="font-bold">تحليل المناطق</span>
            </a>
            
            <a href="{{ route('investor.risk-map') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/10 transition-all">
                <span class="text-2xl">🗺️</span>
                <span class="font-bold">خريطة المخاطر</span>
            </a>
            
            <a href="{{ route('map.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/10 transition-all">
                <span class="text-2xl">🌍</span>
                <span class="font-bold">الخريطة التفاعلية</span>
            </a>
            
            <a href="{{ route('investor.investment-reports') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/10 transition-all">
                <span class="text-2xl">📈</span>
                <span class="font-bold">تقارير الاستثمار</span>
            </a>
            
            <div class="pt-4 border-t border-white/10 mt-4">
                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/10 transition-all">
                    <span class="text-2xl">⚙️</span>
                    <span class="font-bold">الإعدادات</span>
                </a>
            </div>
        </nav>
        
    </aside>
    
    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto">
        
        <!-- Header -->
        <header class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-10">
            <div class="px-8 py-4 flex justify-between items-center">
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = !sidebarOpen" 
                            class="w-10 h-10 bg-purple-500 hover:bg-purple-600 rounded-xl flex items-center justify-center transition-all">
                        <span class="text-white text-xl">☰</span>
                    </button>
                    <div>
                        <h2 class="text-2xl font-black text-gray-800">مرحباً، {{ auth()->user()->name }} 💼</h2>
                        <p class="text-sm text-gray-600">تحليل شامل للفرص الاستثمارية</p>
                    </div>
                </div>
                @include('components.user-profile-dropdown')
            </div>
        </header>
        
        <!-- Content -->
        <div class="p-8">
            
            <!-- Investment KPIs -->
            <div class="grid md:grid-cols-4 gap-6 mb-8">
                
                <!-- Analyzed Areas -->
                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-blue-500/10 to-transparent rounded-full -mr-16 -mt-16"></div>
                    <div class="relative">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center text-white text-2xl shadow-lg">
                                🎯
                            </div>
                            <span class="text-xs font-bold text-gray-500">المناطق المحللة</span>
                        </div>
                        <p class="text-4xl font-black text-gray-800 mb-2">{{ $stats['analyzed_areas'] }}</p>
                        <div class="flex items-center gap-2 text-sm">
                            <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded-lg font-bold">+3</span>
                            <span class="text-gray-600">هذا الشهر</span>
                        </div>
                    </div>
                </div>
                
                <!-- Active Projects -->
                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-purple-500/10 to-transparent rounded-full -mr-16 -mt-16"></div>
                    <div class="relative">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center text-white text-2xl shadow-lg">
                                🏗️
                            </div>
                            <span class="text-xs font-bold text-gray-500">مشاريع نشطة</span>
                        </div>
                        <p class="text-4xl font-black text-gray-800 mb-2">{{ $stats['active_projects'] }}</p>
                        <div class="flex items-center gap-2 text-sm">
                            <span class="px-2 py-1 bg-purple-100 text-purple-700 rounded-lg font-bold">جاري التنفيذ</span>
                        </div>
                    </div>
                </div>
                
                <!-- ROI Prediction -->
                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-green-500/10 to-transparent rounded-full -mr-16 -mt-16"></div>
                    <div class="relative">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-14 h-14 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center text-white text-2xl shadow-lg">
                                📈
                            </div>
                            <span class="text-xs font-bold text-gray-500">العائد المتوقع</span>
                        </div>
                        <p class="text-4xl font-black text-gray-800 mb-2">{{ $stats['roi_prediction'] }}</p>
                        <div class="flex items-center gap-2 text-sm">
                            <span class="px-2 py-1 bg-green-100 text-green-700 rounded-lg font-bold">سنوياً</span>
                        </div>
                    </div>
                </div>
                
                <!-- Risk Level -->
                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-orange-500/10 to-transparent rounded-full -mr-16 -mt-16"></div>
                    <div class="relative">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-14 h-14 bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl flex items-center justify-center text-white text-2xl shadow-lg">
                                ⚠️
                            </div>
                            <span class="text-xs font-bold text-gray-500">مستوى المخاطر</span>
                        </div>
                        <p class="text-4xl font-black text-gray-800 mb-2">{{ $stats['risk_level'] }}</p>
                        <div class="flex items-center gap-2 text-sm">
                            <span class="px-2 py-1 bg-orange-100 text-orange-700 rounded-lg font-bold">مقبول</span>
                        </div>
                    </div>
                </div>
                
            </div>
            
            <!-- Market Insights -->
            <div class="grid md:grid-cols-3 gap-6 mb-8">
                
                <!-- Top Investment Areas -->
                <div class="bg-white rounded-2xl p-6 shadow-lg">
                    <h3 class="text-xl font-black text-gray-800 mb-6 flex items-center gap-2">
                        <span class="text-2xl">🏆</span>
                        أفضل المناطق الاستثمارية
                    </h3>
                    
                    <div class="space-y-4">
                        @foreach([
                            ['name' => 'حي الياسمين', 'score' => 95, 'roi' => '22%', 'risk' => 'منخفض', 'growth' => '+15%'],
                            ['name' => 'حي النرجس', 'score' => 88, 'roi' => '18%', 'risk' => 'منخفض', 'growth' => '+12%'],
                            ['name' => 'حي الورود', 'score' => 82, 'roi' => '16%', 'risk' => 'متوسط', 'growth' => '+10%']
                        ] as $area)
                        <div class="p-4 bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl border-2 border-green-200 hover:border-green-400 transition-all hover:shadow-lg cursor-pointer">
                            <div class="flex justify-between items-start mb-3">
                                <div>
                                    <p class="font-bold text-gray-800 text-lg">{{ $area['name'] }}</p>
                                    <p class="text-xs text-gray-600 mt-1">تقييم الفرصة: <span class="font-bold text-green-600">{{ $area['score'] }}/100</span></p>
                                </div>
                                <span class="px-3 py-1 bg-green-500 text-white rounded-full text-xs font-bold">
                                    A+
                                </span>
                            </div>
                            
                            <div class="grid grid-cols-3 gap-2 mb-3">
                                <div class="text-center p-2 bg-white rounded-lg">
                                    <p class="text-xs text-gray-600">العائد</p>
                                    <p class="font-bold text-green-600">{{ $area['roi'] }}</p>
                                </div>
                                <div class="text-center p-2 bg-white rounded-lg">
                                    <p class="text-xs text-gray-600">المخاطر</p>
                                    <p class="font-bold text-blue-600 text-xs">{{ $area['risk'] }}</p>
                                </div>
                                <div class="text-center p-2 bg-white rounded-lg">
                                    <p class="text-xs text-gray-600">النمو</p>
                                    <p class="font-bold text-purple-600">{{ $area['growth'] }}</p>
                                </div>
                            </div>
                            
                            <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-green-500 to-emerald-500" style="width: {{ $area['score'] }}%"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                
                <!-- Market Trends -->
                <div class="bg-white rounded-2xl p-6 shadow-lg">
                    <h3 class="text-xl font-black text-gray-800 mb-6 flex items-center gap-2">
                        <span class="text-2xl">📊</span>
                        اتجاهات السوق
                    </h3>
                    
                    <div class="space-y-4">
                        @foreach([
                            ['category' => 'عقارات سكنية', 'trend' => '+12%', 'status' => 'صعودي', 'color' => 'green'],
                            ['category' => 'عقارات تجارية', 'trend' => '+8%', 'status' => 'صعودي', 'color' => 'green'],
                            ['category' => 'أراضي', 'trend' => '+3%', 'status' => 'مستقر', 'color' => 'blue'],
                            ['category' => 'مشاريع مختلطة', 'trend' => '+15%', 'status' => 'صعودي', 'color' => 'green']
                        ] as $trend)
                        <div class="p-4 bg-{{ $trend['color'] }}-50 rounded-xl border border-{{ $trend['color'] }}-200">
                            <div class="flex justify-between items-center mb-2">
                                <span class="font-bold text-gray-800">{{ $trend['category'] }}</span>
                                <span class="px-3 py-1 bg-{{ $trend['color'] }}-100 text-{{ $trend['color'] }}-700 rounded-full text-xs font-bold">
                                    {{ $trend['status'] }}
                                </span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-2xl font-black text-{{ $trend['color'] }}-600">{{ $trend['trend'] }}</span>
                                <span class="text-sm text-gray-600">نمو سنوي</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                
                <!-- Investment Opportunities -->
                <div class="bg-white rounded-2xl p-6 shadow-lg">
                    <h3 class="text-xl font-black text-gray-800 mb-6 flex items-center gap-2">
                        <span class="text-2xl">💡</span>
                        فرص ساخنة
                    </h3>
                    
                    <div class="space-y-4">
                        @foreach([
                            ['title' => 'مجمع سكني', 'location' => 'حي الياسمين', 'roi' => '22%', 'duration' => '3 سنوات', 'risk' => 'منخفض'],
                            ['title' => 'مول تجاري', 'location' => 'حي النرجس', 'roi' => '18%', 'duration' => '5 سنوات', 'risk' => 'متوسط']
                        ] as $opportunity)
                        <div class="p-4 bg-gradient-to-r from-purple-50 to-pink-50 rounded-xl border-2 border-purple-200 hover:border-purple-400 transition-all cursor-pointer hover:shadow-lg">
                            <div class="flex items-start gap-3 mb-3">
                                <div class="w-10 h-10 bg-purple-500 rounded-lg flex items-center justify-center text-white text-xl">
                                    🏗️
                                </div>
                                <div class="flex-1">
                                    <p class="font-bold text-gray-800">{{ $opportunity['title'] }}</p>
                                    <p class="text-xs text-gray-600">📍 {{ $opportunity['location'] }}</p>
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-2 gap-2 mb-3">
                                <div class="p-2 bg-white rounded-lg text-center">
                                    <p class="text-xs text-gray-600 mb-1">العائد المتوقع</p>
                                    <p class="font-bold text-purple-600">{{ $opportunity['roi'] }}</p>
                                </div>
                                <div class="p-2 bg-white rounded-lg text-center">
                                    <p class="text-xs text-gray-600 mb-1">المدة</p>
                                    <p class="font-bold text-gray-700">{{ $opportunity['duration'] }}</p>
                                </div>
                            </div>
                            
                            <button class="w-full px-4 py-2 bg-purple-500 text-white rounded-lg text-sm font-bold hover:bg-purple-600 transition-colors">
                                عرض التفاصيل
                            </button>
                        </div>
                        @endforeach
                    </div>
                </div>
                
            </div>
            
            <!-- Detailed Analysis -->
            <div class="grid md:grid-cols-2 gap-6">
                
                <!-- Area Comparison -->
                <div class="bg-white rounded-2xl p-6 shadow-lg">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-black text-gray-800 flex items-center gap-2">
                            <span class="text-2xl">🔍</span>
                            مقارنة تفصيلية
                        </h3>
                        <button class="px-4 py-2 bg-indigo-500 text-white rounded-lg text-sm font-bold hover:bg-indigo-600">
                            إضافة منطقة
                        </button>
                    </div>
                    
                    <div class="space-y-6">
                        @foreach([
                            ['name' => 'حي الياسمين', 'services' => 95, 'infrastructure' => 92, 'safety' => 98, 'projects' => 88],
                            ['name' => 'حي النخيل', 'services' => 88, 'infrastructure' => 85, 'safety' => 90, 'projects' => 82]
                        ] as $comparison)
                        <div class="p-4 bg-gray-50 rounded-xl">
                            <p class="font-bold text-gray-800 mb-4">{{ $comparison['name'] }}</p>
                            
                            @foreach([
                                ['label' => 'الخدمات', 'value' => $comparison['services'], 'color' => 'blue'],
                                ['label' => 'البنية التحتية', 'value' => $comparison['infrastructure'], 'color' => 'green'],
                                ['label' => 'السلامة', 'value' => $comparison['safety'], 'color' => 'purple'],
                                ['label' => 'المشاريع المستقبلية', 'value' => $comparison['projects'], 'color' => 'orange']
                            ] as $metric)
                            <div class="mb-3">
                                <div class="flex justify-between text-sm mb-1">
                                    <span class="text-gray-600">{{ $metric['label'] }}</span>
                                    <span class="font-bold text-{{ $metric['color'] }}-600">{{ $metric['value'] }}%</span>
                                </div>
                                <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                                    <div class="h-full bg-{{ $metric['color'] }}-500" style="width: {{ $metric['value'] }}%"></div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endforeach
                    </div>
                </div>
                
                <!-- Financial Projections -->
                <div class="bg-white rounded-2xl p-6 shadow-lg">
                    <h3 class="text-xl font-black text-gray-800 mb-6 flex items-center gap-2">
                        <span class="text-2xl">💰</span>
                        التوقعات المالية
                    </h3>
                    
                    <div class="space-y-6">
                        <!-- Investment Value Growth -->
                        <div class="p-4 bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl border-2 border-green-200">
                            <p class="text-sm font-bold text-gray-700 mb-3">نمو القيمة الاستثمارية (5 سنوات)</p>
                            <div class="grid grid-cols-5 gap-2">
                                @foreach([
                                    ['year' => 'السنة 1', 'value' => '1.12 مليون', 'growth' => '+12%'],
                                    ['year' => 'السنة 2', 'value' => '1.26 مليون', 'growth' => '+26%'],
                                    ['year' => 'السنة 3', 'value' => '1.42 مليون', 'growth' => '+42%'],
                                    ['year' => 'السنة 4', 'value' => '1.60 مليون', 'growth' => '+60%'],
                                    ['year' => 'السنة 5', 'value' => '1.82 مليون', 'growth' => '+82%']
                                ] as $projection)
                                <div class="text-center p-3 bg-white rounded-lg">
                                    <p class="text-xs text-gray-600 mb-1">{{ $projection['year'] }}</p>
                                    <p class="font-bold text-green-600 text-sm mb-1">{{ $projection['value'] }}</p>
                                    <span class="text-xs px-2 py-1 bg-green-100 text-green-700 rounded-full">{{ $projection['growth'] }}</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        
                        <!-- Risk Analysis -->
                        <div class="p-4 bg-gradient-to-r from-blue-50 to-cyan-50 rounded-xl border-2 border-blue-200">
                            <p class="text-sm font-bold text-gray-700 mb-3">تحليل المخاطر</p>
                            
                            <div class="space-y-3">
                                @foreach([
                                    ['type' => 'مخاطر السوق', 'level' => 'منخفض', 'percentage' => 15, 'color' => 'green'],
                                    ['type' => 'مخاطر التشريعات', 'level' => 'متوسط', 'percentage' => 35, 'color' => 'yellow'],
                                    ['type' => 'مخاطر التنفيذ', 'level' => 'منخفض', 'percentage' => 20, 'color' => 'green']
                                ] as $risk)
                                <div>
                                    <div class="flex justify-between text-xs mb-1">
                                        <span class="text-gray-600">{{ $risk['type'] }}</span>
                                        <span class="px-2 py-0.5 bg-{{ $risk['color'] }}-100 text-{{ $risk['color'] }}-700 rounded-full font-bold">{{ $risk['level'] }}</span>
                                    </div>
                                    <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                                        <div class="h-full bg-{{ $risk['color'] }}-500" style="width: {{ $risk['percentage'] }}%"></div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        
                        <!-- ROI Calculator -->
                        <div class="p-4 bg-gradient-to-r from-purple-50 to-pink-50 rounded-xl border-2 border-purple-200">
                            <p class="text-sm font-bold text-gray-700 mb-3">حاسبة العائد على الاستثمار</p>
                            
                            <div class="grid grid-cols-2 gap-3">
                                <div class="p-3 bg-white rounded-lg text-center">
                                    <p class="text-xs text-gray-600 mb-1">استثمار أولي</p>
                                    <p class="font-bold text-purple-600">1 مليون ريال</p>
                                </div>
                                <div class="p-3 bg-white rounded-lg text-center">
                                    <p class="text-xs text-gray-600 mb-1">العائد بعد 5 سنوات</p>
                                    <p class="font-bold text-green-600">1.82 مليون</p>
                                </div>
                            </div>
                            
                            <div class="mt-3 p-3 bg-purple-500 text-white rounded-lg text-center">
                                <p class="text-xs mb-1">صافي الربح المتوقع</p>
                                <p class="text-2xl font-black">820,000 ريال</p>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            
        </div>
        
    </main>
    
</div>

<!-- Alpine.js -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endsection
