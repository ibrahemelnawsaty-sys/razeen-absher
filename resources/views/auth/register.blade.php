@extends('layouts.guest')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-blue-900 via-indigo-900 to-purple-900 relative overflow-hidden">
    
    <!-- Animated Background -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-blue-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-purple-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-2000"></div>
        <div class="absolute top-40 left-40 w-80 h-80 bg-indigo-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-4000"></div>
    </div>
    
    <div class="max-w-md w-full space-y-8 relative z-10">
        <!-- Logo & Title -->
        <div class="text-center">
            <div class="flex justify-center mb-6">
                <div class="w-20 h-20 bg-gradient-to-br from-white to-gray-100 rounded-3xl flex items-center justify-center shadow-2xl transform hover:scale-110 transition-all duration-300">
                    <span class="text-4xl">✨</span>
                </div>
            </div>
            <h2 class="text-4xl font-black text-white mb-2">
                إنشاء حساب جديد
            </h2>
            <p class="text-lg text-blue-200">
                انضم إلينا واستمتع بجميع المزايا
            </p>
        </div>

        <!-- Register Form -->
        <div class="mt-8 bg-white/10 backdrop-blur-lg rounded-3xl shadow-2xl border border-white/20 p-8">
            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-bold text-white mb-2">
                        الاسم الكامل
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <span class="text-gray-400 text-xl">👤</span>
                        </div>
                        <input id="name" 
                               type="text" 
                               name="name" 
                               value="{{ old('name') }}" 
                               required 
                               autofocus
                               class="appearance-none block w-full pr-12 pl-4 py-3 border-2 border-white/30 rounded-xl text-white placeholder-gray-300 bg-white/10 backdrop-blur-sm focus:outline-none focus:ring-2 focus:ring-white focus:border-transparent transition-all duration-300 @error('name') border-red-400 @enderror">
                        @error('name')
                            <p class="mt-2 text-sm text-red-300">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

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

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-bold text-white mb-2">
                        تأكيد كلمة المرور
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <span class="text-gray-400 text-xl">🔐</span>
                        </div>
                        <input id="password_confirmation" 
                               type="password" 
                               name="password_confirmation" 
                               required
                               class="appearance-none block w-full pr-12 pl-4 py-3 border-2 border-white/30 rounded-xl text-white placeholder-gray-300 bg-white/10 backdrop-blur-sm focus:outline-none focus:ring-2 focus:ring-white focus:border-transparent transition-all duration-300">
                    </div>
                </div>

                <!-- Terms -->
                <div class="flex items-start">
                    <input id="terms" 
                           type="checkbox" 
                           name="terms"
                           required
                           class="h-4 w-4 mt-1 rounded border-white/30 bg-white/10 text-indigo-600 focus:ring-white">
                    <label for="terms" class="mr-2 block text-sm text-white">
                        أوافق على <a href="#" class="font-bold underline hover:text-blue-200">الشروط والأحكام</a> و <a href="#" class="font-bold underline hover:text-blue-200">سياسة الخصوصية</a>
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full flex justify-center py-4 px-4 border border-transparent rounded-xl text-lg font-bold text-blue-900 bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white transform hover:-translate-y-1 transition-all duration-300 shadow-xl">
                    ✨ إنشاء حساب
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

                <!-- Login Link -->
                <div class="text-center">
                    <p class="text-sm text-white">
                        لديك حساب بالفعل؟
                        <a href="{{ route('login') }}" class="font-bold text-white hover:text-blue-200 underline decoration-2 underline-offset-4 transition-colors">
                            تسجيل الدخول
                        </a>
                    </p>
                </div>
            </form>
        </div>

        <!-- Footer -->
        <p class="text-center text-sm text-blue-200">
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
