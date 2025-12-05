@extends('layouts.app')

@section('content')
<div class="flex h-screen bg-gray-100">
    
    <!-- Sidebar -->
    @include('admin.partials.sidebar')
    
    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto">
        
        <!-- Header -->
        <header class="bg-white shadow-sm border-b border-gray-200">
            <div class="px-8 py-4 flex justify-between items-center">
                <div>
                    <h2 class="text-2xl font-black text-gray-800">🏛️ الجهات الحكومية</h2>
                    <p class="text-sm text-gray-600">إدارة الجهات الحكومية المسجلة</p>
                </div>
                <a href="{{ route('admin.entities.create') }}" class="px-6 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-xl font-bold hover:shadow-xl transition-all">
                    ➕ إضافة جهة جديدة
                </a>
            </div>
        </header>
        
        <!-- Content -->
        <div class="p-8">
            
            @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 border-r-4 border-green-500 rounded-xl">
                <p class="text-green-700 font-bold">✅ {{ session('success') }}</p>
            </div>
            @endif
            
            <!-- Stats -->
            <div class="grid md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-2xl p-6 shadow-lg">
                    <p class="text-sm text-gray-600 mb-2">إجمالي الجهات</p>
                    <p class="text-3xl font-black text-indigo-600">{{ $entities->total() }}</p>
                </div>
            </div>
            
            <!-- Entities Table -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <table class="w-full">
                    <thead class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white">
                        <tr>
                            <th class="px-6 py-4 text-right">#</th>
                            <th class="px-6 py-4 text-right">الجهة</th>
                            <th class="px-6 py-4 text-right">البريد الإلكتروني</th>
                            <th class="px-6 py-4 text-right">الجوال</th>
                            <th class="px-6 py-4 text-right">تاريخ التسجيل</th>
                            <th class="px-6 py-4 text-right">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($entities as $entity)
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $entity->id }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-white font-bold">
                                        {{ strtoupper(substr($entity->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="font-bold">{{ $entity->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $entity->organization }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">{{ $entity->email }}</td>
                            <td class="px-6 py-4">{{ $entity->phone ?? '-' }}</td>
                            <td class="px-6 py-4">{{ $entity->created_at->diffForHumans() }}</td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <button class="px-4 py-2 bg-blue-500 text-white rounded-lg text-sm font-bold hover:bg-blue-600">
                                        ✏️ تعديل
                                    </button>
                                    <form method="POST" action="{{ route('admin.entities.destroy', $entity->id) }}" onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg text-sm font-bold hover:bg-red-600">
                                            🗑️ حذف
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                <div class="text-6xl mb-4">🏛️</div>
                                <p class="text-xl font-bold">لا توجد جهات حكومية مسجلة</p>
                                <a href="{{ route('admin.entities.create') }}" class="mt-4 inline-block px-6 py-3 bg-indigo-500 text-white rounded-xl font-bold hover:bg-indigo-600">
                                    ➕ إضافة جهة جديدة
                                </a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                
                @if($entities->hasPages())
                <div class="p-6 border-t border-gray-100">
                    {{ $entities->links() }}
                </div>
                @endif
            </div>
            
        </div>
        
    </main>
    
</div>
@endsection
