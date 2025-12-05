@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8 px-4">
    <div class="container mx-auto max-w-4xl">
        
        <div class="mb-8 flex items-center gap-4">
            <a href="{{ route('dashboard') }}" class="text-indigo-600 hover:text-indigo-800">
                ← رجوع
            </a>
            <div>
                <h1 class="text-3xl font-black text-gray-800">➕ إضافة بلاغ جديد</h1>
                <p class="text-gray-600">قم بإدخال تفاصيل البلاغ</p>
            </div>
        </div>
        
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <form method="POST" action="#" enctype="multipart/form-data">
                @csrf
                
                <div class="grid md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">نوع البلاغ *</label>
                        <select name="type" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500">
                            <option value="accident">🚨 حادث مروري</option>
                            <option value="maintenance">🚧 صيانة طريق</option>
                            <option value="emergency">🚑 حالة طارئة</option>
                            <option value="other">📋 أخرى</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">الأولوية *</label>
                        <select name="priority" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500">
                            <option value="high">🔴 عاجل</option>
                            <option value="medium">🟡 متوسط</option>
                            <option value="low">🟢 عادي</option>
                        </select>
                    </div>
                </div>
                
                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-2">الموقع *</label>
                    <input type="text" name="location" placeholder="مثال: طريق الملك فهد" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500">
                </div>
                
                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-2">الوصف *</label>
                    <textarea name="description" rows="4" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500" placeholder="اكتب تفاصيل البلاغ..."></textarea>
                </div>
                
                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-2">إرفاق صور</label>
                    <input type="file" name="images[]" multiple accept="image/*" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl">
                </div>
                
                <div class="flex gap-4">
                    <button type="submit" class="px-8 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-xl font-bold hover:shadow-xl transition-all">
                        ✓ إرسال البلاغ
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
