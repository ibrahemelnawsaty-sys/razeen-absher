<aside x-show="sidebarOpen" 
       class="w-72 bg-gradient-to-b from-purple-900 via-indigo-900 to-purple-900 text-white flex-shrink-0 overflow-y-auto relative">
    
    <button @click="sidebarOpen = false" 
            class="absolute top-4 left-4 w-8 h-8 bg-white/10 hover:bg-white/20 rounded-lg flex items-center justify-center transition-all z-50">
        <span class="text-white text-xl">✕</span>
    </button>
    
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
    
    <nav class="p-4 space-y-2">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('dashboard') ? 'bg-white/20' : '' }} rounded-xl hover:bg-white/10 transition-all">
            <span class="text-2xl">📊</span>
            <span class="font-bold">لوحة المعلومات</span>
        </a>
        
        <a href="{{ route('investor.area-analysis') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('investor.area-analysis') ? 'bg-white/20' : '' }} rounded-xl hover:bg-white/10 transition-all">
            <span class="text-2xl">🎯</span>
            <span class="font-bold">تحليل المناطق</span>
        </a>
        
        <a href="{{ route('investor.risk-map') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('investor.risk-map') ? 'bg-white/20' : '' }} rounded-xl hover:bg-white/10 transition-all">
            <span class="text-2xl">🗺️</span>
            <span class="font-bold">خريطة المخاطر</span>
        </a>
        
        <a href="{{ route('map.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/10 transition-all">
            <span class="text-2xl">🌍</span>
            <span class="font-bold">الخريطة التفاعلية</span>
        </a>
        
        <a href="{{ route('investor.investment-reports') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('investor.investment-reports') ? 'bg-white/20' : '' }} rounded-xl hover:bg-white/10 transition-all">
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
