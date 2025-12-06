<!-- User Profile Dropdown -->
<div x-data="{ open: false }" class="relative">
    <!-- Avatar Button -->
    <button @click="open = !open" class="flex items-center gap-3 px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-xl transition-all">
        <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold">
            {{ mb_substr(auth()->user()->name, 0, 1) }}
        </div>
        <div class="text-right hidden md:block">
            <p class="font-bold text-gray-800 text-sm">{{ auth()->user()->name }}</p>
            <p class="text-xs text-gray-500">{{ auth()->user()->getRoleNames()->first() ?? 'مستخدم' }}</p>
        </div>
        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    </button>
    
    <!-- Dropdown Menu -->
    <div x-show="open" 
         @click.away="open = false"
         x-cloak
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="absolute left-0 mt-2 w-56 bg-white rounded-xl shadow-xl border border-gray-200 py-2 z-50"
         style="display: none;">
        
        <!-- User Info Header -->
        <div class="px-4 py-3 border-b border-gray-100">
            <p class="font-bold text-gray-800">{{ auth()->user()->name }}</p>
            <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
        </div>
        
        <!-- Actions -->
        <div class="space-y-2">
            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-gray-50 transition-all">
                <span class="text-xl">⚙️</span>
                <span class="font-bold text-gray-700">إعدادات الحساب</span>
            </a>
            
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 hover:bg-red-50 text-red-600 transition-all text-right">
                    <span class="text-xl">🚪</span>
                    <span class="font-bold">تسجيل الخروج</span>
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Alpine.js CDN -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
