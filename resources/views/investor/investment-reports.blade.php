@extends('layouts.app')

@section('content')
<div x-data="{ sidebarOpen: true }" class="flex h-screen bg-gray-100">
    
    <!-- Sidebar -->
    @include('investor.partials.sidebar')
    
    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto">
        
        <header class="bg-white shadow-sm border-b border-gray-200">
            <div class="px-8 py-4 flex justify-between items-center">
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = !sidebarOpen" 
                            x-show="!sidebarOpen"
                            class="w-10 h-10 bg-purple-500 hover:bg-purple-600 rounded-xl flex items-center justify-center transition-all">
                        <span class="text-white text-xl">☰</span>
                    </button>
                    <div>
                        <h2 class="text-2xl font-black text-gray-800">📈 تقارير الاستثمار</h2>
                        <p class="text-sm text-gray-600">جميع التقارير المالية والاستثمارية</p>
                    </div>
                </div>
                <button class="px-6 py-3 bg-purple-500 text-white rounded-xl font-bold hover:bg-purple-600">
                    + تقرير جديد
                </button>
            </div>
        </header>
        
        <div class="p-8">
            
            <div class="grid md:grid-cols-2 gap-6">
                @foreach($reports as $report)
                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-16 h-16 bg-purple-100 rounded-xl flex items-center justify-center text-3xl">
                            📊
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-gray-800">{{ $report['title'] }}</h3>
                            <p class="text-sm text-gray-600">{{ $report['date'] }}</p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div class="p-4 bg-green-50 rounded-xl text-center">
                            <p class="text-sm text-gray-600 mb-1">العائد على الاستثمار</p>
                            <p class="text-2xl font-black text-green-600">{{ $report['roi'] }}</p>
                        </div>
                        <div class="p-4 bg-blue-50 rounded-xl text-center">
                            <p class="text-sm text-gray-600 mb-1">الحالة</p>
                            <p class="text-sm font-bold text-blue-600">مكتمل</p>
                        </div>
                    </div>
                    
                    <button class="w-full px-4 py-3 bg-purple-500 text-white rounded-xl font-bold hover:bg-purple-600">
                        📥 تحميل التقرير
                    </button>
                </div>
                @endforeach
            </div>
            
        </div>
        
    </main>
    
</div>

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endsection
