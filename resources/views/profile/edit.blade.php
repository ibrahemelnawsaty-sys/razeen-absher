@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-blue-50 to-purple-50 py-8 px-4">
    <div class="container mx-auto max-w-3xl">
        
        <h1 class="text-3xl font-black text-gray-800 mb-8">⚙️ إعدادات الحساب</h1>
        
        @if (session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-green-700">
                ✅ {{ session('success') }}
            </div>
        @endif
        
        <!-- Two Factor Authentication -->
        <div class="bg-white rounded-2xl p-6 shadow-lg mb-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                <span class="text-2xl">🔐</span>
                التحقق من خطوتين
            </h2>
            
            <p class="text-gray-600 mb-4">
                عند تفعيل هذه الميزة، سيتم إرسال رمز تحقق إلى بريدك الإلكتروني في كل مرة تسجل فيها الدخول.
            </p>
            
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                <div class="flex items-center gap-3">
                    @if (auth()->user()->two_factor_enabled)
                        <span class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></span>
                        <span class="font-bold text-green-700">مفعّل</span>
                    @else
                        <span class="w-3 h-3 bg-gray-400 rounded-full"></span>
                        <span class="font-bold text-gray-600">غير مفعّل</span>
                    @endif
                </div>
                
                <form method="POST" action="{{ route('2fa.toggle') }}">
                    @csrf
                    <button 
                        type="submit" 
                        class="px-6 py-2 rounded-xl font-bold transition-all {{ auth()->user()->two_factor_enabled ? 'bg-red-500 hover:bg-red-600 text-white' : 'bg-green-500 hover:bg-green-600 text-white' }}"
                    >
                        {{ auth()->user()->two_factor_enabled ? '🔓 تعطيل' : '🔒 تفعيل' }}
                    </button>
                </form>
            </div>
            
            @if (auth()->user()->two_factor_enabled)
                <div class="mt-4 p-4 bg-green-50 border border-green-200 rounded-xl text-green-700 text-sm">
                    ✅ حسابك محمي بالتحقق من خطوتين. سيتم إرسال رمز إلى <strong>{{ auth()->user()->email }}</strong> عند كل تسجيل دخول.
                </div>
            @endif
        </div>
        
        <!-- Profile Information -->
        <div class="bg-white rounded-2xl p-6 shadow-lg mb-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                <span class="text-2xl">👤</span>
                معلومات الملف الشخصي
            </h2>
            
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PUT')
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">الاسم</label>
                        <input 
                            type="text" 
                            name="name" 
                            value="{{ old('name', auth()->user()->name) }}"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200"
                        >
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">البريد الإلكتروني</label>
                        <input 
                            type="email" 
                            name="email" 
                            value="{{ old('email', auth()->user()->email) }}"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200"
                        >
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <button type="submit" class="w-full py-3 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 transition-all">
                        💾 حفظ التغييرات
                    </button>
                </div>
            </form>
        </div>
        
        <!-- Change Password -->
        <div class="bg-white rounded-2xl p-6 shadow-lg">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                <span class="text-2xl">🔑</span>
                تغيير كلمة المرور
            </h2>
            
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                @method('PUT')
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">كلمة المرور الحالية</label>
                        <input 
                            type="password" 
                            name="current_password"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200"
                        >
                    </div>
                    
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">كلمة المرور الجديدة</label>
                        <input 
                            type="password" 
                            name="password"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200"
                        >
                    </div>
                    
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">تأكيد كلمة المرور</label>
                        <input 
                            type="password" 
                            name="password_confirmation"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200"
                        >
                    </div>
                    
                    <button type="submit" class="w-full py-3 bg-orange-600 text-white font-bold rounded-xl hover:bg-orange-700 transition-all">
                        🔐 تحديث كلمة المرور
                    </button>
                </div>
            </form>
        </div>
        
    </div>
</div>
@endsection
