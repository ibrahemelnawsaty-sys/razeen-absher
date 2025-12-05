@extends('layouts.app')

@section('content')
<div class="flex h-screen bg-gray-100 overflow-hidden">
    
    <!-- Sidebar -->
    <aside class="w-72 bg-gradient-to-b from-indigo-900 via-purple-900 to-indigo-900 text-white flex-shrink-0 overflow-y-auto">
        
        <!-- Logo -->
        <div class="p-6 border-b border-white/10">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-white/20 backdrop-blur-lg rounded-xl flex items-center justify-center">
                    <span class="text-2xl">👑</span>
                </div>
                <div>
                    <h1 class="text-lg font-black">لوحة السوبر أدمن</h1>
                    <p class="text-xs text-indigo-200">التحكم الكامل</p>
                </div>
            </div>
        </div>
        
        <!-- Navigation -->
        <nav class="p-4 space-y-2">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 bg-white/20 backdrop-blur-lg rounded-xl hover:bg-white/30 transition-all">
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
                <span class="font-bold">الخريطة التفاعلية</span>
            </a>
            
            <a href="{{ route('admin.reports.advanced') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/10 transition-all">
                <span class="text-2xl">📈</span>
                <span class="font-bold">التقارير المتقدمة</span>
            </a>
            
            <div class="pt-4 border-t border-white/10 mt-4">
                <p class="text-xs text-indigo-300 px-4 mb-2 font-bold">الإعدادات</p>
                
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
                <div>
                    <h2 class="text-2xl font-black text-gray-800">مرحباً، {{ auth()->user()->name }} 👋</h2>
                    <p class="text-sm text-gray-600">نظرة عامة على النظام</p>
                </div>
                @include('components.user-profile-dropdown')
            </div>
        </header>
        
        <!-- Content -->
        <div class="p-8">
            
            <!-- Stats Grid -->
            <div class="grid md:grid-cols-4 gap-6 mb-8">
                
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 text-white shadow-xl hover:shadow-2xl transition-all hover:-translate-y-1 cursor-pointer">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 bg-white/20 rounded-xl flex items-center justify-center text-3xl">
                            👥
                        </div>
                        <span class="text-sm font-bold opacity-90">المستخدمين</span>
                    </div>
                    <p class="text-4xl font-black">{{ $stats['total_users'] }}</p>
                    <p class="text-sm opacity-75 mt-2">+12 هذا الأسبوع</p>
                </div>
                
                <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl p-6 text-white shadow-xl hover:shadow-2xl transition-all hover:-translate-y-1 cursor-pointer">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 bg-white/20 rounded-xl flex items-center justify-center text-3xl">
                            🏥
                        </div>
                        <span class="text-sm font-bold opacity-90">الخدمات</span>
                    </div>
                    <p class="text-4xl font-black">{{ $stats['total_services'] }}</p>
                    <p class="text-sm opacity-75 mt-2">جميعها نشطة</p>
                </div>
                
                <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl p-6 text-white shadow-xl hover:shadow-2xl transition-all hover:-translate-y-1 cursor-pointer">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 bg-white/20 rounded-xl flex items-center justify-center text-3xl">
                            🏗️
                        </div>
                        <span class="text-sm font-bold opacity-90">المشاريع</span>
                    </div>
                    <p class="text-4xl font-black">{{ $stats['total_projects'] }}</p>
                    <p class="text-sm opacity-75 mt-2">قيد التنفيذ</p>
                </div>
                
                <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl p-6 text-white shadow-xl hover:shadow-2xl transition-all hover:-translate-y-1 cursor-pointer">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 bg-white/20 rounded-xl flex items-center justify-center text-3xl">
                            ⚠️
                        </div>
                        <span class="text-sm font-bold opacity-90">الحوادث</span>
                    </div>
                    <p class="text-4xl font-black">{{ $stats['total_incidents'] }}</p>
                    <p class="text-sm opacity-75 mt-2">-5 من الأمس</p>
                </div>
                
            </div>
            
            <!-- Charts & Tables -->
            <div class="grid md:grid-cols-2 gap-6 mb-6">
                
                <!-- Recent Activities -->
                <div class="bg-white rounded-2xl p-6 shadow-lg">
                    <h3 class="text-xl font-black text-gray-800 mb-6">📋 آخر النشاطات</h3>
                    <div class="space-y-3">
                        @for($i = 1; $i <= 5; $i++)
                        <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-600">
                                {{ ['👤','✓','⚠️','📊','🔔'][$i-1] }}
                            </div>
                            <div class="flex-1">
                                <p class="font-bold text-gray-800 text-sm">نشاط رقم {{ $i }}</p>
                                <p class="text-xs text-gray-500">منذ {{ $i * 5 }} دقائق</p>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>
                
                <!-- Government Entities -->
                <div class="bg-white rounded-2xl p-6 shadow-lg">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-black text-gray-800">🏛️ الجهات الحكومية</h3>
                        <a href="{{ route('admin.entities.create') }}" class="px-4 py-2 bg-indigo-500 text-white rounded-lg text-sm font-bold hover:bg-indigo-600">
                            + إضافة
                        </a>
                    </div>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between p-4 bg-gradient-to-r from-blue-50 to-cyan-50 rounded-xl">
                            <div class="flex items-center gap-3">
                                <span class="text-2xl">👮</span>
                                <div>
                                    <p class="font-bold text-gray-800">الشرطة</p>
                                    <p class="text-sm text-gray-600">5 مراكز</p>
                                </div>
                            </div>
                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold">نشط</span>
                        </div>
                        
                        <div class="flex items-center justify-between p-4 bg-gradient-to-r from-red-50 to-pink-50 rounded-xl">
                            <div class="flex items-center gap-3">
                                <span class="text-2xl">🚑</span>
                                <div>
                                    <p class="font-bold text-gray-800">الصحة</p>
                                    <p class="text-sm text-gray-600">8 مراكز</p>
                                </div>
                            </div>
                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold">نشط</span>
                        </div>
                        
                        <div class="flex items-center justify-between p-4 bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl">
                            <div class="flex items-center gap-3">
                                <span class="text-2xl">🏗️</span>
                                <div>
                                    <p class="font-bold text-gray-800">البلدية</p>
                                    <p class="text-sm text-gray-600">12 مشروع</p>
                                </div>
                            </div>
                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold">نشط</span>
                        </div>
                    </div>
                </div>
                
            </div>
            
            <!-- System Health -->
            <div class="bg-white rounded-2xl p-6 shadow-lg">
                <h3 class="text-xl font-black text-gray-800 mb-6">💻 صحة النظام</h3>
                <div class="grid md:grid-cols-3 gap-6">
                    <div>
                        <div class="flex justify-between mb-2">
                            <span class="text-sm font-bold text-gray-700">API Status</span>
                            <span class="text-sm font-bold text-green-600">100%</span>
                        </div>
                        <div class="h-3 bg-gray-200 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-green-500 to-green-600 w-full"></div>
                        </div>
                    </div>
                    
                    <div>
                        <div class="flex justify-between mb-2">
                            <span class="text-sm font-bold text-gray-700">Database</span>
                            <span class="text-sm font-bold text-green-600">98%</span>
                        </div>
                        <div class="h-3 bg-gray-200 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-green-500 to-green-600" style="width: 98%"></div>
                        </div>
                    </div>
                    
                    <div>
                        <div class="flex justify-between mb-2">
                            <span class="text-sm font-bold text-gray-700">Server</span>
                            <span class="text-sm font-bold text-yellow-600">75%</span>
                        </div>
                        <div class="h-3 bg-gray-200 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-yellow-500 to-orange-500" style="width: 75%"></div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        
    </main>
    
</div>
@endsection
