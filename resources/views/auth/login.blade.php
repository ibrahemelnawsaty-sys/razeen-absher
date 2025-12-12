@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-50 via-blue-50 to-purple-50 py-12 px-4">
    <div class="max-w-md w-full">
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-8 py-6 text-center">
                <h1 class="text-2xl font-bold text-white">تسجيل الدخول</h1>
            </div>
            
            <div class="p-8">
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-red-700 text-sm">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf {{-- ✅ تأكد من وجود هذا السطر --}}
                    
                    <div class="mb-6">
                        <label class="block text-sm font-bold text-gray-700 mb-2">البريد الإلكتروني</label>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus
                               class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all">
                    </div>
                    
                    <div class="mb-6">
                        <label class="block text-sm font-bold text-gray-700 mb-2">كلمة المرور</label>
                        <input type="password" name="password" required
                               class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all">
                    </div>
                    
                    <div class="mb-6 flex items-center justify-between">
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
    </div>
</div>
@endsection
