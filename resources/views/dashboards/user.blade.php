@extends('layouts.app')

@section('content')
<div x-data="{ sidebarOpen: false }" class="min-h-screen bg-gradient-to-br from-gray-50 via-blue-50 to-purple-50 py-8 px-4">
    
    <!-- Floating Toggle Button -->
    <button @click="sidebarOpen = !sidebarOpen" 
            class="fixed top-4 right-4 z-50 w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 text-white rounded-xl shadow-2xl hover:shadow-xl transition-all hover:scale-110 flex items-center justify-center">
        <span x-show="!sidebarOpen" class="text-2xl">☰</span>
        <span x-show="sidebarOpen" class="text-2xl">✕</span>
    </button>
    
    <!-- Sidebar -->
    <div x-show="sidebarOpen" 
         @click.away="sidebarOpen = false"
         x-transition:enter="transform transition ease-out duration-300"
         x-transition:enter-start="translate-x-full opacity-0"
         x-transition:enter-end="translate-x-0 opacity-100"
         x-transition:leave="transform transition ease-in duration-200"
         x-transition:leave-start="translate-x-0 opacity-100"
         x-transition:leave-end="translate-x-full opacity-0"
         class="fixed top-0 right-0 h-screen w-80 bg-white shadow-2xl z-40 overflow-y-auto">
        
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center text-white text-2xl">
                    👤
                </div>
                <div>
                    <h2 class="text-lg font-black text-gray-800">{{ auth()->user()->name }}</h2>
                    <p class="text-xs text-gray-600">مستخدم</p>
                </div>
            </div>
        </div>
        
        <nav class="p-4 space-y-2">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 bg-indigo-50 text-indigo-600 rounded-xl font-bold">
                <span class="text-xl">📊</span>
                <span>الرئيسية</span>
            </a>
            
            <a href="{{ route('map.index') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-gray-50 rounded-xl font-bold text-gray-700">
                <span class="text-xl">🗺️</span>
                <span>الخريطة</span>
            </a>
            
            <a href="{{ route('user.emergency-services') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-gray-50 rounded-xl font-bold text-gray-700">
                <span class="text-xl">🚑</span>
                <span>خدمات الطوارئ</span>
            </a>
            
            <a href="{{ route('user.government-centers') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-gray-50 rounded-xl font-bold text-gray-700">
                <span class="text-xl">🏢</span>
                <span>المراكز الحكومية</span>
            </a>
            
            <a href="{{ route('user.neighborhood-info') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-gray-50 rounded-xl font-bold text-gray-700">
                <span class="text-xl">🏘️</span>
                <span>معلومات الحي</span>
            </a>
            
            <a href="{{ route('user.my-properties') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-gray-50 rounded-xl font-bold text-gray-700">
                <span class="text-xl">🏠</span>
                <span>عقاراتي</span>
            </a>
            
            <div class="pt-4 border-t border-gray-200 mt-4">
                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-gray-50 rounded-xl font-bold text-gray-700">
                    <span class="text-xl">⚙️</span>
                    <span>الإعدادات</span>
                </a>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 hover:bg-red-50 rounded-xl font-bold text-red-600 text-right">
                        <span class="text-xl">🚪</span>
                        <span>تسجيل الخروج</span>
                    </button>
                </form>
            </div>
        </nav>
        
    </div>
    
    <div class="container mx-auto">
        
        <!-- Header with Profile -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-black text-gray-800">مرحباً، {{ auth()->user()->name }} 👋</h1>
                <p class="text-gray-600">لوحة التحكم الشخصية</p>
            </div>
            @include('components.user-profile-dropdown')
        </div>
        
        <!-- Quick Stats -->
        <div class="grid md:grid-cols-4 gap-6 mb-8">
            <!-- Stat Card 1 -->
            <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all hover:-translate-y-1">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center text-white text-2xl">
                        🏥
                    </div>
                    <span class="text-sm text-gray-500">الخدمات القريبة</span>
                </div>
                <p class="text-3xl font-black text-gray-800">{{ $stats['nearby_services'] }}</p>
                <p class="text-sm text-gray-600 mt-2">خدمة متاحة</p>
            </div>
            
            <!-- Stat Card 2 -->
            <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all hover:-translate-y-1">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center text-white text-2xl">
                        🚗
                    </div>
                    <span class="text-sm text-gray-500">حالة المرور</span>
                </div>
                <p class="text-3xl font-black text-gray-800">{{ $stats['traffic_status'] }}</p>
                <p class="text-sm text-gray-600 mt-2">الوضع الحالي</p>
            </div>
            
            <!-- Stat Card 3 -->
            <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all hover:-translate-y-1">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center text-white text-2xl">
                        📍
                    </div>
                    <span class="text-sm text-gray-500">أقرب مستشفى</span>
                </div>
                <p class="text-3xl font-black text-gray-800">{{ $stats['nearest_hospital'] }}</p>
                <p class="text-sm text-gray-600 mt-2">المسافة</p>
            </div>
            
            <!-- Stat Card 4 -->
            <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all hover:-translate-y-1">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl flex items-center justify-center text-white text-2xl">
                        ⏱️
                    </div>
                    <span class="text-sm text-gray-500">وقت الانتظار</span>
                </div>
                <p class="text-3xl font-black text-gray-800">{{ $stats['average_wait_time'] }}</p>
                <p class="text-sm text-gray-600 mt-2">متوسط</p>
            </div>
        </div>
        
        <!-- Main Content Grid -->
        <div class="grid md:grid-cols-3 gap-6">
            
            <!-- Left Column -->
            <div class="md:col-span-2 space-y-6">
                
                <!-- Quick Actions -->
                <div class="bg-white rounded-2xl p-6 shadow-lg">
                    <h2 class="text-xl font-black text-gray-800 mb-6 flex items-center gap-2">
                        <span class="text-2xl">⚡</span>
                        إجراءات سريعة
                    </h2>
                    
                    <div class="grid md:grid-cols-3 gap-4">
                        <a href="{{ route('map.index') }}" class="p-4 bg-gradient-to-br from-indigo-50 to-purple-50 rounded-xl hover:shadow-lg transition-all hover:-translate-y-1 text-center">
                            <div class="text-4xl mb-2">🗺️</div>
                            <p class="font-bold text-gray-800">الخريطة التفاعلية</p>
                        </a>
                        
                        <a href="{{ route('user.emergency-services') }}" class="p-4 bg-gradient-to-br from-red-50 to-pink-50 rounded-xl hover:shadow-lg transition-all hover:-translate-y-1 text-center">
                            <div class="text-4xl mb-2">🚑</div>
                            <p class="font-bold text-gray-800">خدمات الطوارئ</p>
                        </a>
                        
                        <a href="{{ route('user.government-centers') }}" class="p-4 bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl hover:shadow-lg transition-all hover:-translate-y-1 text-center">
                            <div class="text-4xl mb-2">🏢</div>
                            <p class="font-bold text-gray-800">المراكز الحكومية</p>
                        </a>
                        
                        <a href="{{ route('user.neighborhood-info') }}" class="p-4 bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl hover:shadow-lg transition-all hover:-translate-y-1 text-center">
                            <div class="text-4xl mb-2">🏘️</div>
                            <p class="font-bold text-gray-800">معلومات الحي</p>
                        </a>
                        
                        <a href="{{ route('user.my-properties') }}" class="p-4 bg-gradient-to-br from-yellow-50 to-orange-50 rounded-xl hover:shadow-lg transition-all hover:-translate-y-1 text-center">
                            <div class="text-4xl mb-2">🏠</div>
                            <p class="font-bold text-gray-800">عقاراتي</p>
                        </a>
                        
                        <a href="{{ route('user.road-quality') }}" class="p-4 bg-gradient-to-br from-purple-50 to-pink-50 rounded-xl hover:shadow-lg transition-all hover:-translate-y-1 text-center">
                            <div class="text-4xl mb-2">🛣️</div>
                            <p class="font-bold text-gray-800">جودة الطرق</p>
                        </a>
                    </div>
                </div>
                
                <!-- Neighborhood Information -->
                <div class="bg-white rounded-2xl p-6 shadow-lg">
                    <h2 class="text-xl font-black text-gray-800 mb-6 flex items-center gap-2">
                        <span class="text-2xl">🏘️</span>
                        معلومات حيك
                    </h2>
                    
                    <div class="grid md:grid-cols-2 gap-4 mb-6">
                        <a href="{{ route('user.neighborhood-info') }}#projects-section" class="p-4 bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl hover:shadow-lg transition-all hover:-translate-y-1">
                            <div class="flex items-center gap-3 mb-3">
                                <span class="text-3xl">🏗️</span>
                                <div>
                                    <p class="text-sm text-gray-600">المشاريع النشطة</p>
                                    <p class="text-2xl font-black text-gray-800">3</p>
                                </div>
                            </div>
                            <div class="w-full px-4 py-2 bg-blue-500 text-white rounded-lg text-sm font-bold text-center hover:bg-blue-600 transition-colors">
                                عرض المشاريع
                            </div>
                        </a>
                        
                        <a href="{{ route('user.neighborhood-info') }}#services-section" class="p-4 bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl hover:shadow-lg transition-all hover:-translate-y-1">
                            <div class="flex items-center gap-3 mb-3">
                                <span class="text-3xl">🏥</span>
                                <div>
                                    <p class="text-sm text-gray-600">الخدمات العامة</p>
                                    <p class="text-2xl font-black text-gray-800">12</p>
                                </div>
                            </div>
                            <div class="w-full px-4 py-2 bg-green-500 text-white rounded-lg text-sm font-bold text-center hover:bg-green-600 transition-colors">
                                عرض الخدمات
                            </div>
                        </a>
                    </div>
                    
                    <!-- Safety Level -->
                    <div class="p-4 bg-gradient-to-br from-purple-50 to-pink-50 rounded-xl">
                        <div class="flex justify-between items-center mb-3">
                            <div class="flex items-center gap-2">
                                <span class="text-2xl">🛡️</span>
                                <span class="font-bold text-gray-800">مستوى السلامة</span>
                            </div>
                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-bold">
                                ممتاز
                            </span>
                        </div>
                        <div class="h-3 bg-gray-200 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-green-500 to-emerald-500" style="width: 92%"></div>
                        </div>
                        <p class="text-xs text-gray-600 mt-2">92% - منطقة آمنة مع خدمات متكاملة</p>
                    </div>
                </div>
                
                <!-- Recent Activity -->
                <div class="bg-white rounded-2xl p-6 shadow-lg">
                    <h2 class="text-xl font-black text-gray-800 mb-6 flex items-center gap-2">
                        <span class="text-2xl">📊</span>
                        النشاطات الأخيرة
                    </h2>
                    
                    <div class="space-y-4">
                        <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl">
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center text-green-600">
                                ✓
                            </div>
                            <div class="flex-1">
                                <p class="font-bold text-gray-800">تم البحث عن مستشفى الملك فهد</p>
                                <p class="text-sm text-gray-500">منذ 5 دقائق</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl">
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-600">
                                📍
                            </div>
                            <div class="flex-1">
                                <p class="font-bold text-gray-800">تم تحديد موقعك</p>
                                <p class="text-sm text-gray-500">منذ 15 دقيقة</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl">
                            <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center text-purple-600">
                                🏠
                            </div>
                            <div class="flex-1">
                                <p class="font-bold text-gray-800">تم إضافة عقار جديد</p>
                                <p class="text-sm text-gray-500">منذ ساعة</p>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            
            <!-- Right Column - Alerts & Notifications -->
            <div class="space-y-6">
                
                <!-- Alerts -->
                <div class="bg-white rounded-2xl p-6 shadow-lg">
                    <h2 class="text-xl font-black text-gray-800 mb-6 flex items-center gap-2">
                        <span class="text-2xl">🔔</span>
                        التنبيهات
                    </h2>
                    
                    <div class="space-y-3">
                        <div class="p-4 bg-gradient-to-r from-yellow-50 to-orange-50 border-r-4 border-yellow-500 rounded-lg">
                            <p class="font-bold text-yellow-800 mb-1">🚧 صيانة طريق</p>
                            <p class="text-sm text-gray-600">صيانة على طريق الملك فهد</p>
                        </div>
                        
                        <div class="p-4 bg-gradient-to-r from-blue-50 to-cyan-50 border-r-4 border-blue-500 rounded-lg">
                            <p class="font-bold text-blue-800 mb-1">🏫 مدرسة قريبة</p>
                            <p class="text-sm text-gray-600">قلل السرعة في المنطقة</p>
                        </div>
                        
                        <div class="p-4 bg-gradient-to-r from-green-50 to-emerald-50 border-r-4 border-green-500 rounded-lg">
                            <p class="font-bold text-green-800 mb-1">🏗️ مشروع جديد</p>
                            <p class="text-sm text-gray-600">بدء مشروع تطوير في حيك</p>
                        </div>
                    </div>
                </div>
                
                <!-- Building Permits -->
                <div class="bg-white rounded-2xl p-6 shadow-lg">
                    <h2 class="text-xl font-black text-gray-800 mb-6 flex items-center gap-2">
                        <span class="text-2xl">📋</span>
                        تصاريح البناء القريبة
                    </h2>
                    
                    <div class="space-y-3">
                        <div class="p-3 bg-blue-50 rounded-lg">
                            <p class="font-bold text-gray-800 text-sm">مبنى سكني - شارع الأمير</p>
                            <p class="text-xs text-gray-600 mt-1">تصريح نشط - 200م</p>
                        </div>
                        
                        <div class="p-3 bg-green-50 rounded-lg">
                            <p class="font-bold text-gray-800 text-sm">محل تجاري - طريق الملك</p>
                            <p class="text-xs text-gray-600 mt-1">قيد الإنشاء - 500م</p>
                        </div>
                    </div>
                    
                    <a href="{{ route('user.neighborhood-info') }}#permits-section" class="block w-full mt-4 px-4 py-2 bg-indigo-500 text-white rounded-lg text-sm font-bold text-center hover:bg-indigo-600 transition-colors">
                        عرض جميع التصاريح
                    </a>
                </div>
                
                <!-- Weather Widget -->
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 shadow-lg text-white">
                    <h2 class="text-lg font-bold mb-4">🌤️ حالة الطقس</h2>
                    <div class="text-center">
                        <p class="text-5xl font-black">28°</p>
                        <p class="mt-2">صافٍ</p>
                        <div class="mt-4 grid grid-cols-2 gap-2 text-sm">
                            <div class="bg-white/20 rounded-lg p-2">
                                <p class="opacity-75">الرطوبة</p>
                                <p class="font-bold">45%</p>
                            </div>
                            <div class="bg-white/20 rounded-lg p-2">
                                <p class="opacity-75">الرياح</p>
                                <p class="font-bold">12 كم/س</p>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            
        </div>
        
    </div>
</div>

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endsection
