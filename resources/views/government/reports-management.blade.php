@extends('layouts.app')

@section('content')
<div class="flex h-screen bg-gray-100">
    
    <!-- Sidebar -->
    @include('government.partials.sidebar')
    
    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto">
        
        <!-- Header -->
        <header class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-10">
            <div class="px-8 py-4">
                <h2 class="text-2xl font-black text-gray-800">📋 إدارة البلاغات</h2>
                <p class="text-sm text-gray-600">إدارة ومتابعة جميع البلاغات الواردة</p>
            </div>
        </header>
        
        <!-- Content -->
        <div class="p-8">
            
            <!-- Filters & Stats -->
            <div class="grid md:grid-cols-5 gap-6 mb-8">
                <button class="p-4 bg-white rounded-xl shadow-lg hover:shadow-xl transition-all border-r-4 border-red-500">
                    <p class="text-3xl font-black text-red-600">8</p>
                    <p class="text-sm text-gray-600 mt-1">عاجل</p>
                </button>
                
                <button class="p-4 bg-white rounded-xl shadow-lg hover:shadow-xl transition-all border-r-4 border-yellow-500">
                    <p class="text-3xl font-black text-yellow-600">12</p>
                    <p class="text-sm text-gray-600 mt-1">مهم</p>
                </button>
                
                <button class="p-4 bg-white rounded-xl shadow-lg hover:shadow-xl transition-all border-r-4 border-blue-500">
                    <p class="text-3xl font-black text-blue-600">18</p>
                    <p class="text-sm text-gray-600 mt-1">عادي</p>
                </button>
                
                <button class="p-4 bg-white rounded-xl shadow-lg hover:shadow-xl transition-all border-r-4 border-green-500">
                    <p class="text-3xl font-black text-green-600">23</p>
                    <p class="text-sm text-gray-600 mt-1">مكتمل</p>
                </button>
                
                <button class="p-4 bg-white rounded-xl shadow-lg hover:shadow-xl transition-all border-r-4 border-gray-500">
                    <p class="text-3xl font-black text-gray-600">61</p>
                    <p class="text-sm text-gray-600 mt-1">الإجمالي</p>
                </button>
            </div>
            
            <!-- Search & Filter Bar -->
            <div class="bg-white rounded-2xl p-6 shadow-lg mb-6">
                <div class="grid md:grid-cols-5 gap-4">
                    <input type="text" placeholder="🔍 بحث عن بلاغ..." class="px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500">
                    
                    <select class="px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500">
                        <option>جميع الأولويات</option>
                        <option>عاجل</option>
                        <option>مهم</option>
                        <option>عادي</option>
                    </select>
                    
                    <select class="px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500">
                        <option>جميع الحالات</option>
                        <option>جديد</option>
                        <option>قيد المعالجة</option>
                        <option>مكتمل</option>
                    </select>
                    
                    <input type="date" class="px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500">
                    
                    <button class="px-6 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-xl font-bold hover:shadow-xl transition-all">
                        بحث
                    </button>
                </div>
            </div>
            
            <!-- Reports List -->
            <div class="space-y-4">
                @foreach([
                    ['id' => '#2401', 'type' => 'حادث مروري', 'location' => 'طريق الملك فهد - تقاطع العليا', 'time' => '10 دقائق', 'priority' => 'عاجل', 'status' => 'جديد', 'reporter' => 'مواطن', 'color' => 'red'],
                    ['id' => '#2402', 'type' => 'صيانة طريق', 'location' => 'شارع العليا - أمام مجمع الفيصلية', 'time' => '30 دقيقة', 'priority' => 'مهم', 'status' => 'قيد المعالجة', 'reporter' => 'مستخدم التطبيق', 'color' => 'yellow'],
                    ['id' => '#2403', 'type' => 'إنارة معطلة', 'location' => 'حي الورود - شارع الربيع', 'time' => '1 ساعة', 'priority' => 'عادي', 'status' => 'قيد المعالجة', 'reporter' => 'جهة حكومية', 'color' => 'blue'],
                    ['id' => '#2404', 'type' => 'تسرب مياه', 'location' => 'حي النخيل - شارع الأمير', 'time' => '2 ساعة', 'priority' => 'مهم', 'status' => 'جديد', 'reporter' => 'مواطن', 'color' => 'yellow'],
                    ['id' => '#2405', 'type' => 'حفرة في الطريق', 'location' => 'طريق الخرج - بعد محطة البنزين', 'time' => '3 ساعات', 'priority' => 'عاجل', 'status' => 'جديد', 'reporter' => 'مستخدم التطبيق', 'color' => 'red']
                ] as $report)
                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all border-r-4 border-{{ $report['color'] }}-500">
                    <div class="flex justify-between items-start mb-4">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-3">
                                <span class="px-4 py-1 bg-gray-100 text-gray-700 rounded-full text-sm font-bold">{{ $report['id'] }}</span>
                                <span class="px-4 py-1 bg-{{ $report['color'] }}-100 text-{{ $report['color'] }}-700 rounded-full text-sm font-bold">
                                    {{ $report['priority'] }}
                                </span>
                                <span class="px-4 py-1 bg-blue-100 text-blue-700 rounded-full text-sm font-bold">
                                    {{ $report['status'] }}
                                </span>
                            </div>
                            
                            <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $report['type'] }}</h3>
                            
                            <div class="grid md:grid-cols-3 gap-3 text-sm text-gray-600">
                                <div class="flex items-center gap-2">
                                    <span class="text-lg">📍</span>
                                    <span>{{ $report['location'] }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="text-lg">⏰</span>
                                    <span>منذ {{ $report['time'] }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="text-lg">👤</span>
                                    <span>{{ $report['reporter'] }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex gap-2">
                            <button class="px-6 py-3 bg-green-500 text-white rounded-xl font-bold hover:bg-green-600 transition-colors">
                                ✓ قبول
                            </button>
                            <button class="px-6 py-3 bg-blue-500 text-white rounded-xl font-bold hover:bg-blue-600 transition-colors">
                                👁️ تفاصيل
                            </button>
                            <button class="px-6 py-3 bg-purple-500 text-white rounded-xl font-bold hover:bg-purple-600 transition-colors">
                                👥 تعيين
                            </button>
                        </div>
                    </div>
                    
                    <!-- Timeline -->
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <div class="flex items-center gap-3">
                            <div class="flex-1 flex items-center gap-2">
                                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center text-green-600 text-sm font-bold">1</div>
                                <span class="text-xs text-gray-600">تم الاستلام</span>
                            </div>
                            <div class="flex-1 flex items-center gap-2 opacity-50">
                                <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center text-gray-600 text-sm font-bold">2</div>
                                <span class="text-xs text-gray-600">قيد المعالجة</span>
                            </div>
                            <div class="flex-1 flex items-center gap-2 opacity-30">
                                <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center text-gray-600 text-sm font-bold">3</div>
                                <span class="text-xs text-gray-600">مكتمل</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
        </div>
        
    </main>
    
</div>
@endsection
