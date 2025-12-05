@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8 px-4">
    <div class="container mx-auto">
        
        <div class="mb-8 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-black text-gray-800">👥 إدارة المستخدمين</h1>
                <p class="text-gray-600">جميع مستخدمي النظام</p>
            </div>
            <a href="{{ route('dashboard') }}" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-xl font-bold hover:bg-gray-300">
                ← رجوع
            </a>
        </div>
        
        <!-- Filters -->
        <div class="bg-white rounded-2xl p-6 shadow-lg mb-6">
            <div class="grid md:grid-cols-4 gap-4">
                <input type="text" placeholder="🔍 البحث..." class="px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500">
                <select class="px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500">
                    <option>جميع الأدوار</option>
                    <option>مستخدم</option>
                    <option>جهة حكومية</option>
                    <option>مستثمر</option>
                    <option>أدمن</option>
                </select>
                <button class="px-6 py-3 bg-indigo-500 text-white rounded-xl font-bold hover:bg-indigo-600">
                    بحث
                </button>
            </div>
        </div>
        
        <!-- Users Table -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <table class="w-full">
                <thead class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white">
                    <tr>
                        <th class="px-6 py-4 text-right">#</th>
                        <th class="px-6 py-4 text-right">الاسم</th>
                        <th class="px-6 py-4 text-right">البريد الإلكتروني</th>
                        <th class="px-6 py-4 text-right">الدور</th>
                        <th class="px-6 py-4 text-right">المنظمة</th>
                        <th class="px-6 py-4 text-right">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="border-b border-gray-100 hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $user->id }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <span class="font-bold">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">{{ $user->email }}</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-indigo-100 text-indigo-700 rounded-full text-sm font-bold">
                                {{ __('roles.' . $user->role) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">{{ $user->organization ?? '-' }}</td>
                        <td class="px-6 py-4">
                            <div class="flex gap-2">
                                <button class="px-4 py-2 bg-blue-500 text-white rounded-lg text-sm font-bold hover:bg-blue-600">
                                    ✏️ تعديل
                                </button>
                                <button class="px-4 py-2 bg-red-500 text-white rounded-lg text-sm font-bold hover:bg-red-600">
                                    🗑️ حذف
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            <div class="p-6">
                {{ $users->links() }}
            </div>
        </div>
        
    </div>
</div>
@endsection
