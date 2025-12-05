@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8 px-4">
    <div class="container mx-auto max-w-4xl">
        
        <div class="mb-8 flex items-center gap-4">
            <a href="{{ route('dashboard') }}" class="text-indigo-600 hover:text-indigo-800">
                ← رجوع
            </a>
            <div>
                <h1 class="text-3xl font-black text-gray-800">➕ إضافة جهة حكومية جديدة</h1>
                <p class="text-gray-600">قم بإدخال معلومات الجهة</p>
            </div>
        </div>
        
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <form method="POST" action="{{ route('admin.entities.store') }}">
                @csrf
                
                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-2">اسم الجهة *</label>
                    <input type="text" name="name" required class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500">
                </div>
                
                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-2">البريد الإلكتروني *</label>
                    <input type="email" name="email" required class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500">
                </div>
                
                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-2">نوع الجهة *</label>
                    <select name="organization" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500">
                        <option value="وزارة الشؤون البلدية">وزارة الشؤون البلدية</option>
                        <option value="المرور">المرور</option>
                        <option value="الشرطة">الشرطة</option>
                        <option value="الدفاع المدني">الدفاع المدني</option>
                        <option value="الصحة">وزارة الصحة</option>
                    </select>
                </div>
                
                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-2">رقم الجوال *</label>
                    <input type="text" name="phone" required class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500">
                </div>
                
                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-2">كلمة المرور *</label>
                    <input type="password" name="password" required class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500">
                </div>
                
                <input type="hidden" name="role" value="government">
                
                <div class="flex gap-4">
                    <button type="submit" class="px-8 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-xl font-bold hover:shadow-xl transition-all">
                        ✓ إضافة الجهة
                    </button>
                    <a href="{{ route('dashboard') }}" class="px-8 py-3 bg-gray-200 text-gray-700 rounded-xl font-bold hover:bg-gray-300">
                        إلغاء
                    </a>
                </div>
            </form>
        </div>
        
    </div>
</div>
@endsection
