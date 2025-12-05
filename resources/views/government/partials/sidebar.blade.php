<aside class="w-72 bg-gradient-to-b from-blue-900 via-indigo-900 to-blue-900 text-white flex-shrink-0 overflow-y-auto">
    
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
        
        <a href="{{ route('government.reports') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('government.reports') ? 'bg-white/20 backdrop-blur-lg' : '' }} rounded-xl hover:bg-white/10 transition-all">
            <span class="text-2xl">📋</span>
            <span class="font-bold">إدارة البلاغات</span>
        </a>
        
        <a href="{{ route('government.centers') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('government.centers') ? 'bg-white/20 backdrop-blur-lg' : '' }} rounded-xl hover:bg-white/10 transition-all">
            <span class="text-2xl">🏢</span>
            <span class="font-bold">المراكز التابعة</span>
        </a>
        
        <a href="{{ route('map.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/10 transition-all">
            <span class="text-2xl">🗺️</span>
            <span class="font-bold">الخريطة التفاعلية</span>
        </a>
        
        <a href="{{ route('government.analytics') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('government.analytics') ? 'bg-white/20 backdrop-blur-lg' : '' }} rounded-xl hover:bg-white/10 transition-all">
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