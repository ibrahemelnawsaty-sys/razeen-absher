@extends('layouts.app')

@section('content')
<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gradient-to-br from-gray-50 to-gray-100 overflow-hidden">
    
    <!-- Sidebar -->
    <aside x-show="sidebarOpen" 
           @click.away="sidebarOpen = false"
           class="w-72 bg-gradient-to-b from-blue-900 via-indigo-900 to-blue-900 text-white flex-shrink-0 overflow-y-auto relative">
        
        <!-- Logo -->
        <div class="p-6 border-b border-white/10">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-white/20 backdrop-blur-lg rounded-xl flex items-center justify-center">
                    <span class="text-2xl">🏛️</span>
                </div>
                <div>
                    <h1 class="text-lg font-black">لوحة الجهة الحكومية</h1>
                    <p class="text-xs text-blue-200">{{ auth()->user()->organization }}</p>
                </div>
            </div>
        </div>
        
        <!-- Navigation -->
        <nav class="p-4 space-y-2">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('dashboard') ? 'bg-white/20 backdrop-blur-lg' : '' }} rounded-xl hover:bg-white/10 transition-all">
                <span class="text-2xl">📊</span>
                <span class="font-bold">لوحة المعلومات</span>
            </a>
            
            <a href="{{ route('government.reports') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/10 transition-all">
                <span class="text-2xl">📋</span>
                <span class="font-bold">إدارة البلاغات</span>
            </a>
            
            <a href="{{ route('government.centers') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/10 transition-all">
                <span class="text-2xl">🏢</span>
                <span class="font-bold">المراكز التابعة</span>
            </a>
            
            <a href="{{ route('map.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/10 transition-all">
                <span class="text-2xl">🗺️</span>
                <span class="font-bold">الخريطة التفاعلية</span>
            </a>
            
            <a href="{{ route('government.analytics') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/10 transition-all">
                <span class="text-2xl">📈</span>
                <span class="font-bold">التقارير التحليلية</span>
            </a>
            
            <div class="pt-4 border-t border-white/10 mt-4">
                <p class="text-xs text-blue-300 px-4 mb-2 font-bold">الإعدادات</p>
                
                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/10 transition-all">
                    <span class="text-2xl">⚙️</span>
                    <span class="font-bold">إعدادات الحساب</span>
                </a>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-red-500/20 transition-all text-right">
                        <span class="text-2xl">🚪</span>
                        <span class="font-bold">تسجيل الخروج</span>
                    </button>
                </form>
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
                            class="w-10 h-10 bg-blue-500 hover:bg-blue-600 rounded-xl flex items-center justify-center transition-all">
                        <span class="text-white text-xl">☰</span>
                    </button>
                    <div>
                        <h2 class="text-2xl font-black text-gray-800">مرحباً، {{ auth()->user()->name }} 🏛️</h2>
                        <p class="text-sm text-gray-600">آخر تحديث: {{ now()->format('Y-m-d H:i') }}</p>
                    </div>
                </div>
                @include('components.user-profile-dropdown')
            </div>
        </header>
        
        <!-- Content -->
        <div class="p-8">
            
            <!-- Real-time KPIs -->
            <div class="grid md:grid-cols-4 gap-6 mb-8">
                
                <!-- KPI 1: Pending Reports -->
                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-red-500/10 to-transparent rounded-full -mr-16 -mt-16"></div>
                    <div class="relative">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-14 h-14 bg-gradient-to-br from-red-500 to-red-600 rounded-xl flex items-center justify-center text-white text-2xl shadow-lg">
                                📋
                            </div>
                            <span class="text-xs font-bold text-gray-500">البلاغات المفتوحة</span>
                        </div>
                        <p class="text-4xl font-black text-gray-800 mb-2">{{ $stats['pending_reports'] }}</p>
                        <div class="flex items-center gap-2 text-sm">
                            <span class="px-2 py-1 bg-red-100 text-red-700 rounded-lg font-bold">↑ 5</span>
                            <span class="text-gray-600">من أمس</span>
                        </div>
                        <div class="mt-4 h-2 bg-gray-100 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-red-500 to-red-600" style="width: 75%"></div>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">75% يحتاج متابعة عاجلة</p>
                    </div>
                </div>
                
                <!-- KPI 2: Active Centers -->
                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-green-500/10 to-transparent rounded-full -mr-16 -mt-16"></div>
                    <div class="relative">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-14 h-14 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center text-white text-2xl shadow-lg">
                                🏢
                            </div>
                            <span class="text-xs font-bold text-gray-500">المراكز النشطة</span>
                        </div>
                        <p class="text-4xl font-black text-gray-800 mb-2">{{ $stats['active_centers'] }}/{{ $stats['active_centers'] + 2 }}</p>
                        <div class="flex items-center gap-2 text-sm">
                            <span class="px-2 py-1 bg-green-100 text-green-700 rounded-lg font-bold">100%</span>
                            <span class="text-gray-600">تشغيلية</span>
                        </div>
                        <div class="mt-4 h-2 bg-gray-100 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-green-500 to-green-600" style="width: 100%"></div>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">جميع المراكز تعمل بكفاءة</p>
                    </div>
                </div>
                
                <!-- KPI 3: Response Time -->
                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-blue-500/10 to-transparent rounded-full -mr-16 -mt-16"></div>
                    <div class="relative">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center text-white text-2xl shadow-lg">
                                ⏱️
                            </div>
                            <span class="text-xs font-bold text-gray-500">متوسط الاستجابة</span>
                        </div>
                        <p class="text-4xl font-black text-gray-800 mb-2">{{ $stats['response_time'] }}</p>
                        <div class="flex items-center gap-2 text-sm">
                            <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded-lg font-bold">↓ 15%</span>
                            <span class="text-gray-600">تحسن</span>
                        </div>
                        <div class="mt-4 h-2 bg-gray-100 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-blue-500 to-blue-600" style="width: 85%"></div>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">الهدف: أقل من 10 دقائق</p>
                    </div>
                </div>
                
                <!-- KPI 4: Completed Today -->
                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-purple-500/10 to-transparent rounded-full -mr-16 -mt-16"></div>
                    <div class="relative">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center text-white text-2xl shadow-lg">
                                ✅
                            </div>
                            <span class="text-xs font-bold text-gray-500">المكتملة اليوم</span>
                        </div>
                        <p class="text-4xl font-black text-gray-800 mb-2">{{ $stats['completed_today'] }}</p>
                        <div class="flex items-center gap-2 text-sm">
                            <span class="px-2 py-1 bg-purple-100 text-purple-700 rounded-lg font-bold">↑ 8</span>
                            <span class="text-gray-600">من أمس</span>
                        </div>
                        <div class="mt-4 h-2 bg-gray-100 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-purple-500 to-purple-600" style="width: 92%"></div>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">معدل إنجاز ممتاز</p>
                    </div>
                </div>
                
            </div>
            
            <!-- Advanced Analytics -->
            <div class="grid md:grid-cols-3 gap-6 mb-8">
                
                <!-- Performance Metrics -->
                <div class="bg-white rounded-2xl p-6 shadow-lg">
                    <h3 class="text-xl font-black text-gray-800 mb-6 flex items-center gap-2">
                        <span class="text-2xl">📈</span>
                        مؤشرات الأداء
                    </h3>
                    
                    <div class="space-y-4">
                        <div>
                            <div class="flex justify-between mb-2">
                                <span class="text-sm font-bold text-gray-700">معدل الاستجابة</span>
                                <span class="text-sm font-bold text-green-600">92%</span>
                            </div>
                            <div class="h-3 bg-gray-100 rounded-full overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-green-500 to-green-600" style="width: 92%"></div>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Target: 90%</p>
                        </div>
                        
                        <div>
                            <div class="flex justify-between mb-2">
                                <span class="text-sm font-bold text-gray-700">رضا المستفيدين</span>
                                <span class="text-sm font-bold text-blue-600">88%</span>
                            </div>
                            <div class="h-3 bg-gray-100 rounded-full overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-blue-500 to-blue-600" style="width: 88%"></div>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Target: 85%</p>
                        </div>
                        
                        <div>
                            <div class="flex justify-between mb-2">
                                <span class="text-sm font-bold text-gray-700">تحديث البيانات</span>
                                <span class="text-sm font-bold text-purple-600">95%</span>
                            </div>
                            <div class="h-3 bg-gray-100 rounded-full overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-purple-500 to-purple-600" style="width: 95%"></div>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Real-time accuracy</p>
                        </div>
                        
                        <div>
                            <div class="flex justify-between mb-2">
                                <span class="text-sm font-bold text-gray-700">كفاءة الموارد</span>
                                <span class="text-sm font-bold text-orange-600">78%</span>
                            </div>
                            <div class="h-3 bg-gray-100 rounded-full overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-orange-500 to-orange-600" style="width: 78%"></div>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Resource utilization</p>
                        </div>
                    </div>
                </div>
                
                <!-- Reports by Priority -->
                <div class="bg-white rounded-2xl p-6 shadow-lg">
                    <h3 class="text-xl font-black text-gray-800 mb-6 flex items-center gap-2">
                        <span class="text-2xl">🎯</span>
                        البلاغات حسب الأولوية
                    </h3>
                    
                    <div class="space-y-4">
                        <div class="p-4 bg-gradient-to-r from-red-50 to-pink-50 rounded-xl border-r-4 border-red-500">
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="font-bold text-gray-800">عاجل</p>
                                    <p class="text-xs text-gray-600 mt-1">يحتاج استجابة فورية</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-3xl font-black text-red-600">8</p>
                                    <p class="text-xs text-gray-600">بلاغات</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-4 bg-gradient-to-r from-yellow-50 to-orange-50 rounded-xl border-r-4 border-yellow-500">
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="font-bold text-gray-800">مهم</p>
                                    <p class="text-xs text-gray-600 mt-1">خلال 24 ساعة</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-3xl font-black text-yellow-600">12</p>
                                    <p class="text-xs text-gray-600">بلاغات</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-4 bg-gradient-to-r from-blue-50 to-cyan-50 rounded-xl border-r-4 border-blue-500">
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="font-bold text-gray-800">عادي</p>
                                    <p class="text-xs text-gray-600 mt-1">خلال أسبوع</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-3xl font-black text-blue-600">18</p>
                                    <p class="text-xs text-gray-600">بلاغات</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Team Performance -->
                <div class="bg-white rounded-2xl p-6 shadow-lg">
                    <h3 class="text-xl font-black text-gray-800 mb-6 flex items-center gap-2">
                        <span class="text-2xl">👥</span>
                        أداء الفرق
                    </h3>
                    
                    <div class="space-y-4">
                        @foreach([
                            ['name' => 'فريق الصيانة', 'tasks' => 15, 'completed' => 12, 'rate' => 80],
                            ['name' => 'فريق الطوارئ', 'tasks' => 8, 'completed' => 8, 'rate' => 100],
                            ['name' => 'فريق المتابعة', 'tasks' => 20, 'completed' => 17, 'rate' => 85]
                        ] as $team)
                        <div class="p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-all">
                            <div class="flex justify-between items-center mb-2">
                                <p class="font-bold text-gray-800">{{ $team['name'] }}</p>
                                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold">
                                    {{ $team['rate'] }}%
                                </span>
                            </div>
                            <div class="flex items-center gap-2 text-sm text-gray-600 mb-2">
                                <span>{{ $team['completed'] }}/{{ $team['tasks'] }} مهمة</span>
                            </div>
                            <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-green-500 to-green-600" style="width: {{ $team['rate'] }}%"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                
            </div>
            
            <!-- Recent Reports & Centers Status -->
            <div class="grid md:grid-cols-2 gap-6">
                
                <!-- Recent Reports -->
                <div class="bg-white rounded-2xl p-6 shadow-lg">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-black text-gray-800 flex items-center gap-2">
                            <span class="text-2xl">📋</span>
                            آخر البلاغات
                        </h3>
                        <button class="px-4 py-2 bg-indigo-500 text-white rounded-lg text-sm font-bold hover:bg-indigo-600">
                            عرض الكل
                        </button>
                    </div>
                    
                    <div class="space-y-3">
                        @foreach([
                            ['type' => 'حادث مروري', 'location' => 'طريق الملك فهد', 'time' => '10 دقائق', 'priority' => 'عاجل', 'color' => 'red'],
                            ['type' => 'صيانة طريق', 'location' => 'شارع العليا', 'time' => '30 دقيقة', 'priority' => 'مهم', 'color' => 'yellow'],
                            ['type' => 'إنارة معطلة', 'location' => 'حي الورود', 'time' => '1 ساعة', 'priority' => 'عادي', 'color' => 'blue']
                        ] as $report)
                        <div class="p-4 bg-{{ $report['color'] }}-50 rounded-xl border-r-4 border-{{ $report['color'] }}-500 hover:shadow-md transition-all">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <p class="font-bold text-gray-800">{{ $report['type'] }}</p>
                                    <p class="text-sm text-gray-600 mt-1">📍 {{ $report['location'] }}</p>
                                </div>
                                <span class="px-3 py-1 bg-{{ $report['color'] }}-100 text-{{ $report['color'] }}-700 rounded-full text-xs font-bold">
                                    {{ $report['priority'] }}
                                </span>
                            </div>
                            <div class="flex items-center gap-2 text-xs text-gray-500">
                                <span>⏰ منذ {{ $report['time'] }}</span>
                            </div>
                            <div class="flex gap-2 mt-3">
                                <button class="flex-1 px-3 py-2 bg-green-500 text-white rounded-lg text-xs font-bold hover:bg-green-600">
                                    ✓ قبول
                                </button>
                                <button class="flex-1 px-3 py-2 bg-blue-500 text-white rounded-lg text-xs font-bold hover:bg-blue-600">
                                    👁️ تفاصيل
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                
                <!-- Centers Management -->
                <div class="bg-white rounded-2xl p-6 shadow-lg">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-black text-gray-800 flex items-center gap-2">
                            <span class="text-2xl">🏢</span>
                            حالة المراكز
                        </h3>
                        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-bold">
                            8/10 نشط
                        </span>
                    </div>
                    
                    <div class="space-y-3">
                        @foreach([
                            ['name' => 'المركز الرئيسي', 'queue' => 8, 'wait' => '15 دقيقة', 'status' => 'نشط', 'utilization' => 80],
                            ['name' => 'فرع الشمال', 'queue' => 12, 'wait' => '25 دقيقة', 'status' => 'مزدحم', 'utilization' => 95],
                            ['name' => 'فرع الجنوب', 'queue' => 5, 'wait' => '10 دقائق', 'status' => 'نشط', 'utilization' => 60]
                        ] as $center)
                        <div class="p-4 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl hover:shadow-md transition-all">
                            <div class="flex justify-between items-start mb-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center text-2xl">
                                        🏢
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-800">{{ $center['name'] }}</p>
                                        <p class="text-sm text-gray-600">⏱️ {{ $center['wait'] }}</p>
                                    </div>
                                </div>
                                <span class="px-3 py-1 bg-{{ $center['status'] === 'مزدحم' ? 'yellow' : 'green' }}-100 text-{{ $center['status'] === 'مزدحم' ? 'yellow' : 'green' }}-700 rounded-full text-xs font-bold">
                                    {{ $center['status'] }}
                                </span>
                            </div>
                            
                            <div class="grid grid-cols-2 gap-3 mb-3">
                                <div class="p-2 bg-white rounded-lg text-center">
                                    <p class="text-xs text-gray-600">المنتظرين</p>
                                    <p class="text-lg font-black text-gray-800">{{ $center['queue'] }}</p>
                                </div>
                                <div class="p-2 bg-white rounded-lg text-center">
                                    <p class="text-xs text-gray-600">الاستخدام</p>
                                    <p class="text-lg font-black text-gray-800">{{ $center['utilization'] }}%</p>
                                </div>
                            </div>
                            
                            <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-blue-500 to-blue-600" style="width: {{ $center['utilization'] }}%"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                
            </div>
            
        </div>
        
    </main>
    
</div>

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endsection
