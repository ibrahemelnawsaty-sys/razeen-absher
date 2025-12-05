<!-- User Profile Dropdown -->
<div x-data="{ open: false }" class="relative">
    <!-- Avatar Button -->
    <button @click="open = !open" class="flex items-center gap-3 p-2 rounded-xl hover:bg-gray-100 transition-all">
        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold shadow-lg">
            @if(auth()->user()->avatar)
                <img src="{{ auth()->user()->avatar }}" alt="{{ auth()->user()->name }}" class="w-full h-full rounded-full object-cover">
            @else
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            @endif
        </div>
        <div class="hidden md:block text-right">
            <p class="text-sm font-bold text-gray-800">{{ auth()->user()->name }}</p>
            <p class="text-xs text-gray-500">{{ __('roles.' . auth()->user()->role) }}</p>
        </div>
        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    </button>
    
    <!-- Dropdown Menu -->
    <div x-show="open" 
         @click.away="open = false"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="absolute left-0 mt-2 w-80 bg-white rounded-2xl shadow-2xl border-2 border-gray-100 z-50"
         style="display: none;">
        
        <!-- User Info Header -->
        <div class="p-6 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-t-2xl">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 rounded-full bg-white/20 backdrop-blur-lg flex items-center justify-center text-white font-black text-2xl shadow-xl">
                    @if(auth()->user()->avatar)
                        <img src="{{ auth()->user()->avatar }}" alt="{{ auth()->user()->name }}" class="w-full h-full rounded-full object-cover">
                    @else
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    @endif
                </div>
                <div class="flex-1 text-white">
                    <h3 class="text-lg font-bold">{{ auth()->user()->name }}</h3>
                    <p class="text-sm opacity-90">{{ auth()->user()->email }}</p>
                    <span class="inline-block mt-2 px-3 py-1 bg-white/20 backdrop-blur-lg rounded-full text-xs font-bold">
                        {{ __('roles.' . auth()->user()->role) }}
                    </span>
                </div>
            </div>
        </div>
        
        <!-- User Details -->
        <div class="p-4 space-y-3">
            <div class="flex items-center gap-3 text-sm">
                <span class="text-gray-400">📧</span>
                <span class="text-gray-700">{{ auth()->user()->email }}</span>
            </div>
            
            @if(auth()->user()->phone)
            <div class="flex items-center gap-3 text-sm">
                <span class="text-gray-400">📱</span>
                <span class="text-gray-700">{{ auth()->user()->phone }}</span>
            </div>
            @endif
            
            @if(auth()->user()->organization)
            <div class="flex items-center gap-3 text-sm">
                <span class="text-gray-400">🏢</span>
                <span class="text-gray-700">{{ auth()->user()->organization }}</span>
            </div>
            @endif
            
            <div class="flex items-center gap-3 text-sm">
                <span class="text-gray-400">📅</span>
                <span class="text-gray-700">عضو منذ {{ auth()->user()->created_at->diffForHumans() }}</span>
            </div>
        </div>
        
        <!-- Actions -->
        <div class="p-2 border-t border-gray-100">
            <a href="{{ route('dashboard') }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 rounded-xl transition-colors">
                <span class="mr-2">📊</span> لوحة التحكم
            </a>
            <a href="{{ route('profile.edit') }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 rounded-xl transition-colors">
                <span class="mr-2">⚙️</span> إعدادات الحساب
            </a>
            <a href="{{ route('map.index') }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 rounded-xl transition-colors">
                <span class="mr-2">🗺️</span> الخريطة التفاعلية
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-right px-4 py-3 text-sm text-red-600 hover:bg-red-50 rounded-xl transition-colors">
                    <span class="mr-2">🚪</span> تسجيل الخروج
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Alpine.js CDN -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
