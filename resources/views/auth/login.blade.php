@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-50 via-blue-50 to-purple-50 py-12 px-4">
    <div class="max-w-6xl w-full">
        
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-black text-gray-800 mb-3">مرحباً بك في رزين 🏛️</h1>
            <p class="text-gray-600">اختر حسابك للدخول مباشرة (وضع التطوير)</p>
        </div>

        <!-- User Cards Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            
            <!-- Super Admin Card -->
            <form method="POST" action="{{ route('login.quick') }}" class="group">
                @csrf
                <input type="hidden" name="email" value="superadmin@aabsher.tech">
                <button type="submit" class="w-full bg-gradient-to-br from-purple-600 to-indigo-600 rounded-2xl p-8 text-white hover:from-purple-700 hover:to-indigo-700 transition-all hover:-translate-y-2 shadow-xl hover:shadow-2xl">
                    <div class="flex flex-col items-center">
                        <div class="w-24 h-24 bg-white/20 backdrop-blur-lg rounded-full flex items-center justify-center mb-4 text-5xl group-hover:scale-110 transition-transform">
                            👑
                        </div>
                        <h3 class="text-2xl font-black mb-2">سوبر أدمن</h3>
                        <p class="text-purple-200 text-sm mb-4">صلاحيات كاملة</p>
                        <div class="flex flex-wrap gap-2 justify-center">
                            <span class="px-3 py-1 bg-white/20 rounded-full text-xs font-bold">إدارة النظام</span>
                            <span class="px-3 py-1 bg-white/20 rounded-full text-xs font-bold">كل الصلاحيات</span>
                        </div>
                    </div>
                </button>
            </form>

            <!-- Admin Card -->
            <form method="POST" action="{{ route('login.quick') }}" class="group">
                @csrf
                <input type="hidden" name="email" value="admin@aabsher.tech">
                <button type="submit" class="w-full bg-gradient-to-br from-indigo-600 to-blue-600 rounded-2xl p-8 text-white hover:from-indigo-700 hover:to-blue-700 transition-all hover:-translate-y-2 shadow-xl hover:shadow-2xl">
                    <div class="flex flex-col items-center">
                        <div class="w-24 h-24 bg-white/20 backdrop-blur-lg rounded-full flex items-center justify-center mb-4 text-5xl group-hover:scale-110 transition-transform">
                            👨‍💼
                        </div>
                        <h3 class="text-2xl font-black mb-2">مدير النظام</h3>
                        <p class="text-indigo-200 text-sm mb-4">إدارة المستخدمين</p>
                        <div class="flex flex-wrap gap-2 justify-center">
                            <span class="px-3 py-1 bg-white/20 rounded-full text-xs font-bold">المستخدمين</span>
                            <span class="px-3 py-1 bg-white/20 rounded-full text-xs font-bold">التقارير</span>
                        </div>
                    </div>
                </button>
            </form>

            <!-- Government Card -->
            <form method="POST" action="{{ route('login.quick') }}" class="group">
                @csrf
                <input type="hidden" name="email" value="government@aabsher.tech">
                <button type="submit" class="w-full bg-gradient-to-br from-blue-600 to-cyan-600 rounded-2xl p-8 text-white hover:from-blue-700 hover:to-cyan-700 transition-all hover:-translate-y-2 shadow-xl hover:shadow-2xl">
                    <div class="flex flex-col items-center">
                        <div class="w-24 h-24 bg-white/20 backdrop-blur-lg rounded-full flex items-center justify-center mb-4 text-5xl group-hover:scale-110 transition-transform">
                            🏛️
                        </div>
                        <h3 class="text-2xl font-black mb-2">جهة حكومية</h3>
                        <p class="text-blue-200 text-sm mb-4">إدارة الخدمات</p>
                        <div class="flex flex-wrap gap-2 justify-center">
                            <span class="px-3 py-1 bg-white/20 rounded-full text-xs font-bold">البلاغات</span>
                            <span class="px-3 py-1 bg-white/20 rounded-full text-xs font-bold">المراكز</span>
                        </div>
                    </div>
                </button>
            </form>

            <!-- Investor Card -->
            <form method="POST" action="{{ route('login.quick') }}" class="group">
                @csrf
                <input type="hidden" name="email" value="investor@aabsher.tech">
                <button type="submit" class="w-full bg-gradient-to-br from-purple-600 to-pink-600 rounded-2xl p-8 text-white hover:from-purple-700 hover:to-pink-700 transition-all hover:-translate-y-2 shadow-xl hover:shadow-2xl">
                    <div class="flex flex-col items-center">
                        <div class="w-24 h-24 bg-white/20 backdrop-blur-lg rounded-full flex items-center justify-center mb-4 text-5xl group-hover:scale-110 transition-transform">
                            💼
                        </div>
                        <h3 class="text-2xl font-black mb-2">مستثمر</h3>
                        <p class="text-purple-200 text-sm mb-4">تحليل الفرص</p>
                        <div class="flex flex-wrap gap-2 justify-center">
                            <span class="px-3 py-1 bg-white/20 rounded-full text-xs font-bold">التحليلات</span>
                            <span class="px-3 py-1 bg-white/20 rounded-full text-xs font-bold">المخاطر</span>
                        </div>
                    </div>
                </button>
            </form>

            <!-- User Card -->
            <form method="POST" action="{{ route('login.quick') }}" class="group">
                @csrf
                <input type="hidden" name="email" value="user@aabsher.tech">
                <button type="submit" class="w-full bg-gradient-to-br from-green-600 to-emerald-600 rounded-2xl p-8 text-white hover:from-green-700 hover:to-emerald-700 transition-all hover:-translate-y-2 shadow-xl hover:shadow-2xl">
                    <div class="flex flex-col items-center">
                        <div class="w-24 h-24 bg-white/20 backdrop-blur-lg rounded-full flex items-center justify-center mb-4 text-5xl group-hover:scale-110 transition-transform">
                            👤
                        </div>
                        <h3 class="text-2xl font-black mb-2">مستخدم عادي</h3>
                        <p class="text-green-200 text-sm mb-4">الخدمات الأساسية</p>
                        <div class="flex flex-wrap gap-2 justify-center">
                            <span class="px-3 py-1 bg-white/20 rounded-full text-xs font-bold">الخريطة</span>
                            <span class="px-3 py-1 bg-white/20 rounded-full text-xs font-bold">الطوارئ</span>
                        </div>
                    </div>
                </button>
            </form>

            <!-- Custom Login Card -->
            <div class="bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl p-8 flex items-center justify-center hover:shadow-xl transition-all">
                <button type="button" @click="showCustomLogin = true" class="flex flex-col items-center text-gray-600 hover:text-gray-800">
                    <div class="w-24 h-24 bg-white/80 rounded-full flex items-center justify-center mb-4 text-5xl">
                        🔑
                    </div>
                    <h3 class="text-xl font-black mb-2">تسجيل دخول مخصص</h3>
                    <p class="text-sm text-gray-500">استخدم بريدك وكلمة المرور</p>
                </button>
            </div>
        </div>

        <!-- Warning -->
        <div class="bg-yellow-50 border-2 border-yellow-200 rounded-2xl p-6 text-center">
            <div class="flex items-center justify-center gap-3 mb-2">
                <span class="text-3xl">⚠️</span>
                <h4 class="text-xl font-black text-yellow-800">تحذير: وضع التطوير</h4>
            </div>
            <p class="text-yellow-700">
                هذه الصفحة للتطوير فقط. سيتم تعطيل الدخول السريع في بيئة الإنتاج.
            </p>
        </div>

    </div>
</div>

<!-- Custom Login Modal -->
<div x-data="{ showCustomLogin: false }" 
     x-show="showCustomLogin" 
     x-cloak
     @click.away="showCustomLogin = false"
     class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4"
     style="display: none;">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-8" @click.stop>
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-2xl font-black text-gray-800">تسجيل الدخول</h3>
            <button @click="showCustomLogin = false" class="text-gray-400 hover:text-gray-600 text-2xl">✕</button>
        </div>

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-red-700 text-sm">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf
            
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">البريد الإلكتروني</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all">
            </div>
            
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">كلمة المرور</label>
                <input type="password" name="password" required
                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all">
            </div>
            
            <div class="flex items-center justify-between">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="w-4 h-4 text-indigo-600 border-gray-300 rounded">
                    <span class="mr-2 text-sm text-gray-600">تذكرني</span>
                </label>
            </div>
            
            <button type="submit" class="w-full py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold rounded-xl hover:from-indigo-700 hover:to-purple-700 transition-all shadow-lg hover:shadow-xl">
                تسجيل الدخول
            </button>
        </form>
        
        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">ليس لديك حساب؟ 
                <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-800 font-bold">إنشاء حساب جديد</a>
            </p>
        </div>
    </div>
</div>

<!-- Alpine.js -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<style>
[x-cloak] { display: none !important; }
</style>
@endsection
