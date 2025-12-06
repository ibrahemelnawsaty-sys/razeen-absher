<!-- Sidebar -->
<aside class="w-72 bg-gradient-to-b from-indigo-900 via-purple-900 to-indigo-900 text-white flex-shrink-0 overflow-y-auto">
    
    <!-- Logo -->
    <div class="p-6 border-b border-white/10">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 bg-white/20 backdrop-blur-lg rounded-xl flex items-center justify-center">
                <span class="text-2xl">{{ auth()->user()->role === 'super_admin' ? '👑' : '👨‍💼' }}</span>
            </div>
            <div>
                <h1 class="text-lg font-black">لوحة {{ auth()->user()->role === 'super_admin' ? 'السوبر أدمن' : 'الأدمن' }}</h1>
                <p class="text-xs text-indigo-200">التحكم الكامل</p>
            </div>
        </div>
    </div>
    
    <!-- Navigation -->
    <nav class="p-4 space-y-2">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('dashboard') ? 'bg-white/20 backdrop-blur-lg' : '' }} rounded-xl hover:bg-white/10 transition-all">
            <span class="text-2xl">📊</span>
            <span class="font-bold">الرئيسية</span>
        </a>
        
        <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.users.*') ? 'bg-white/20 backdrop-blur-lg' : '' }} rounded-xl hover:bg-white/10 transition-all">
            <span class="text-2xl">👥</span>
            <span class="font-bold">إدارة المستخدمين</span>
        </a>
        
        <a href="{{ route('admin.entities.index') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.entities.*') ? 'bg-white/20 backdrop-blur-lg' : '' }} rounded-xl hover:bg-white/10 transition-all">
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
        
        <!-- SEO Link -->
        <a href="{{ route('admin.seo.index') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.seo.*') ? 'bg-white/20 backdrop-blur-lg' : '' }} rounded-xl hover:bg-white/10 transition-all">
            <span class="text-2xl">🔍</span>
            <span class="font-bold">إعدادات SEO</span>
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
