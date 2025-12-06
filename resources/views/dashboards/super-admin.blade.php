@extends('layouts.app')

@section('content')
<div class="flex h-screen bg-gray-100 overflow-hidden">
    
    <!-- Sidebar -->
    <aside class="w-72 bg-gradient-to-b from-indigo-900 via-purple-900 to-indigo-900 text-white flex-shrink-0 overflow-y-auto">
        
        <!-- Logo -->
        <div class="p-6 border-b border-white/10">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-white/20 backdrop-blur-lg rounded-xl flex items-center justify-center">
                    <span class="text-2xl">⚙️</span>
                </div>
                <div>
                    <h1 class="text-lg font-black">لوحة السوبر أدمن</h1>
                    <p class="text-xs text-indigo-200">{{ auth()->user()->name }}</p>
                </div>
            </div>
        </div>
        
        <!-- Navigation -->
        <nav class="p-4 space-y-2">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 bg-white/20 backdrop-blur-lg rounded-xl">
                <span class="text-2xl">📊</span>
                <span class="font-bold">الرئيسية</span>
            </a>
            
            <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/10 transition-all">
                <span class="text-2xl">👥</span>
                <span class="font-bold">إدارة المستخدمين</span>
            </a>
            
            <a href="{{ route('admin.entities.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/10 transition-all">
                <span class="text-2xl">🏛️</span>
                <span class="font-bold">الجهات الحكومية</span>
            </a>
            
            <a href="{{ route('map.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/10 transition-all">
                <span class="text-2xl">🗺️</span>
                <span class="font-bold">الخريطة</span>
            </a>
            
            <a href="{{ route('admin.reports.advanced') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/10 transition-all">
                <span class="text-2xl">📈</span>
                <span class="font-bold">التقارير</span>
            </a>
            
            <a href="{{ route('admin.seo.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/10 transition-all">
                <span class="text-2xl">🔍</span>
                <span class="font-bold">إعدادات SEO</span>
            </a>
            
            <div class="pt-4 border-t border-white/10 mt-4">
                <p class="text-xs text-indigo-300 px-4 mb-2 font-bold">الإعدادات</p>
                
                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/10 transition-all">
                    <span class="text-2xl">👤</span>
                    <span class="font-bold">الملف الشخصي</span>
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
                <div>
                    <h2 class="text-2xl font-black text-gray-800">مرحباً، {{ auth()->user()->name }} 👋</h2>
                    <p class="text-sm text-gray-600">لوحة تحكم المدير العام - {{ now()->format('Y-m-d H:i') }}</p>
                </div>
                
                <div class="flex items-center gap-4">
                    <span class="px-4 py-2 bg-gradient-to-r from-purple-500 to-indigo-500 text-white rounded-xl text-sm font-bold">
                        🛡️ Super Admin
                    </span>
                </div>
            </div>
        </header>
        
        <!-- Content -->
        <div class="p-8">
            
            <!-- Stats Grid -->
            <div class="grid md:grid-cols-4 gap-6 mb-8">
                
                <!-- Total Users -->
                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center text-white text-2xl shadow-lg">
                            👥
                        </div>
                        <span class="text-xs font-bold text-gray-500">المستخدمين</span>
                    </div>
                    <p class="text-4xl font-black text-gray-800">{{ $stats['total_users'] }}</p>
                    <p class="text-sm text-gray-600 mt-2">إجمالي المستخدمين</p>
                </div>
                
                <!-- Entities -->
                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center text-white text-2xl shadow-lg">
                            🏛️
                        </div>
                        <span class="text-xs font-bold text-gray-500">الجهات</span>
                    </div>
                    <p class="text-4xl font-black text-gray-800">{{ $stats['total_entities'] }}</p>
                    <p class="text-sm text-gray-600 mt-2">جهة حكومية</p>
                </div>
                
                <!-- Reports -->
                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl flex items-center justify-center text-white text-2xl shadow-lg">
                            📋
                        </div>
                        <span class="text-xs font-bold text-gray-500">البلاغات</span>
                    </div>
                    <p class="text-4xl font-black text-gray-800">{{ $stats['total_reports'] }}</p>
                    <p class="text-sm text-gray-600 mt-2">بلاغ هذا الشهر</p>
                </div>
                
                <!-- System Health -->
                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center text-white text-2xl shadow-lg">
                            💚
                        </div>
                        <span class="text-xs font-bold text-gray-500">صحة النظام</span>
                    </div>
                    <p class="text-4xl font-black text-gray-800">{{ $stats['system_health'] }}%</p>
                    <p class="text-sm text-gray-600 mt-2">أداء ممتاز</p>
                </div>
            </div>
            
            <!-- Quick Actions -->
            <div class="bg-white rounded-2xl p-6 shadow-lg mb-8">
                <h3 class="text-xl font-black text-gray-800 mb-6 flex items-center gap-2">
                    <span class="text-2xl">⚡</span>
                    إجراءات سريعة
                </h3>
                
                <div class="grid md:grid-cols-4 gap-4">
                    <a href="{{ route('admin.users.index') }}" class="p-4 bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl hover:shadow-lg transition-all text-center">
                        <div class="text-3xl mb-2">👥</div>
                        <p class="font-bold text-gray-800">إدارة المستخدمين</p>
                    </a>
                    
                    <a href="{{ route('admin.entities.index') }}" class="p-4 bg-gradient-to-br from-green-50 to-green-100 rounded-xl hover:shadow-lg transition-all text-center">
                        <div class="text-3xl mb-2">🏛️</div>
                        <p class="font-bold text-gray-800">الجهات الحكومية</p>
                    </a>
                    
                    <a href="{{ route('admin.seo.index') }}" class="p-4 bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl hover:shadow-lg transition-all text-center">
                        <div class="text-3xl mb-2">🔍</div>
                        <p class="font-bold text-gray-800">إعدادات SEO</p>
                    </a>
                    
                    <a href="{{ route('map.index') }}" class="p-4 bg-gradient-to-br from-orange-50 to-orange-100 rounded-xl hover:shadow-lg transition-all text-center">
                        <div class="text-3xl mb-2">🗺️</div>
                        <p class="font-bold text-gray-800">الخريطة التفاعلية</p>
                    </a>
                </div>
            </div>
            
            <!-- System Status -->
            <div class="bg-white rounded-2xl p-6 shadow-lg">
                <h3 class="text-xl font-black text-gray-800 mb-6 flex items-center gap-2">
                    <span class="text-2xl">🖥️</span>
                    حالة النظام
                </h3>
                
                <div class="grid md:grid-cols-3 gap-4">
                    <div class="p-4 bg-green-50 rounded-xl border-2 border-green-200">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></span>
                            <span class="font-bold text-green-800">الخادم</span>
                        </div>
                        <p class="text-sm text-green-700">يعمل بشكل طبيعي</p>
                    </div>
                    
                    <div class="p-4 bg-green-50 rounded-xl border-2 border-green-200">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></span>
                            <span class="font-bold text-green-800">قاعدة البيانات</span>
                        </div>
                        <p class="text-sm text-green-700">متصلة</p>
                    </div>
                    
                    <div class="p-4 bg-green-50 rounded-xl border-2 border-green-200">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></span>
                            <span class="font-bold text-green-800">الإيميل</span>
                        </div>
                        <p class="text-sm text-green-700">مُفعّل</p>
                    </div>
                </div>
            </div>
            
        </div>
    </main>
</div>
@endsection
