@extends('layouts.guest')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-indigo-900 via-purple-900 to-pink-900 relative overflow-hidden">
    
    <!-- Animated Background -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-purple-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-indigo-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-2000"></div>
        <div class="absolute top-40 left-40 w-80 h-80 bg-pink-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-4000"></div>
    </div>
    
    <div class="max-w-md w-full space-y-8 relative z-10">
        <!-- Logo & Title -->
        <div class="text-center">
            <div class="flex justify-center mb-6">
                <div class="w-20 h-20 bg-gradient-to-br from-white to-gray-100 rounded-3xl flex items-center justify-center shadow-2xl transform hover:scale-110 transition-all duration-300">
                    <span class="text-4xl">🏛️</span>
                </div>
            </div>
            <h2 class="text-4xl font-black text-white mb-2">
                مرحباً بك مجدداً
            </h2>
            <p class="text-lg text-indigo-200">
                سجل دخولك للوصول إلى لوحة التحكم
            </p>
        </div>

        <!-- Login Form -->
        <div class="mt-8 bg-white/10 backdrop-blur-lg rounded-3xl shadow-2xl border border-white/20 p-8">
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-bold text-white mb-2">
                        البريد الإلكتروني
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <span class="text-gray-400 text-xl">📧</span>
                        </div>
                        <input id="email" 
                               type="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               required 
                               autofocus
                               class="appearance-none block w-full pr-12 pl-4 py-3 border-2 border-white/30 rounded-xl text-white placeholder-gray-300 bg-white/10 backdrop-blur-sm focus:outline-none focus:ring-2 focus:ring-white focus:border-transparent transition-all duration-300 @error('email') border-red-400 @enderror">
                        @error('email')
                            <p class="mt-2 text-sm text-red-300">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-bold text-white mb-2">
                        كلمة المرور
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <span class="text-gray-400 text-xl">🔒</span>
                        </div>
                        <input id="password" 
                               type="password" 
                               name="password" 
                               required
                               class="appearance-none block w-full pr-12 pl-4 py-3 border-2 border-white/30 rounded-xl text-white placeholder-gray-300 bg-white/10 backdrop-blur-sm focus:outline-none focus:ring-2 focus:ring-white focus:border-transparent transition-all duration-300 @error('password') border-red-400 @enderror">
                        @error('password')
                            <p class="mt-2 text-sm text-red-300">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember_me" 
                               type="checkbox" 
                               name="remember"
                               class="h-4 w-4 rounded border-white/30 bg-white/10 text-indigo-600 focus:ring-white">
                        <label for="remember_me" class="mr-2 block text-sm text-white">
                            تذكرني
                        </label>
                    </div>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm font-medium text-white hover:text-indigo-200 transition-colors">
                            نسيت كلمة المرور؟
                        </a>
                    @endif
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full flex justify-center py-4 px-4 border border-transparent rounded-xl text-lg font-bold text-indigo-900 bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white transform hover:-translate-y-1 transition-all duration-300 shadow-xl">
                    🚀 تسجيل الدخول
                </button>

                <!-- Divider -->
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-white/30"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-transparent text-white font-bold">أو</span>
                    </div>
                </div>

                <!-- Register Link -->
                <div class="text-center">
                    <p class="text-sm text-white">
                        ليس لديك حساب؟
                        <a href="{{ route('register') }}" class="font-bold text-white hover:text-indigo-200 underline decoration-2 underline-offset-4 transition-colors">
                            إنشاء حساب جديد
                        </a>
                    </p>
                </div>
            </form>
        </div>

        <!-- Footer -->
        <p class="text-center text-sm text-indigo-200">
            © {{ date('Y') }} {{ config('app.name') }}. جميع الحقوق محفوظة.
        </p>
    </div>
</div>

<style>
    @keyframes blob {
        0%, 100% { transform: translate(0px, 0px) scale(1); }
        33% { transform: translate(30px, -50px) scale(1.1); }
        66% { transform: translate(-20px, 20px) scale(0.9); }
    }
    .animate-blob {
        animation: blob 7s infinite;
    }
    .animation-delay-2000 {
        animation-delay: 2s;
    }
    .animation-delay-4000 {
        animation-delay: 4s;
    }
</style>
@endsection
