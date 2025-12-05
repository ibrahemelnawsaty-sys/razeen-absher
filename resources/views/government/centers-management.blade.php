@extends('layouts.app')

@section('content')
<div class="flex h-screen bg-gray-100">
    
    <!-- Sidebar -->
    @include('government.partials.sidebar')
    
    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto">
        
        <!-- Header -->
        <header class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-10">
            <div class="px-8 py-4 flex justify-between items-center">
                <div>
                    <h2 class="text-2xl font-black text-gray-800">🏢 المراكز التابعة</h2>
                    <p class="text-sm text-gray-600">إدارة ومراقبة جميع المراكز</p>
                </div>
                <button class="px-6 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-xl font-bold hover:shadow-xl transition-all">
                    ➕ إضافة مركز جديد
                </button>
            </div>
        </header>
        
        <!-- Content -->
        <div class="p-8">
            
            <!-- Overview Stats -->
            <div class="grid md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-2xl p-6 shadow-lg">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-14 h-14 bg-green-100 rounded-xl flex items-center justify-center text-3xl">
                            ✅
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">المراكز النشطة</p>
                            <p class="text-3xl font-black text-green-600">8</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-2xl p-6 shadow-lg">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-14 h-14 bg-yellow-100 rounded-xl flex items-center justify-center text-3xl">
                            🟡
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">مزدحمة</p>
                            <p class="text-3xl font-black text-yellow-600">3</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-2xl p-6 shadow-lg">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center text-3xl">
                            👥
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">إجمالي المنتظرين</p>
                            <p class="text-3xl font-black text-blue-600">124</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-2xl p-6 shadow-lg">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-14 h-14 bg-purple-100 rounded-xl flex items-center justify-center text-3xl">
                            ⏱️
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">متوسط الانتظار</p>
                            <p class="text-3xl font-black text-purple-600">18د</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Centers Grid -->
            <div class="grid md:grid-cols-2 gap-6">
                @foreach([
                    ['name' => 'المركز الرئيسي', 'location' => 'طريق الملك فهد', 'queue' => 25, 'wait' => '15 دقيقة', 'status' => 'نشط', 'capacity' => 100, 'staff' => 15, 'rating' => 4.5],
                    ['name' => 'فرع الشمال', 'location' => 'حي النرجس', 'queue' => 45, 'wait' => '35 دقيقة', 'status' => 'مزدحم', 'capacity' => 80, 'staff' => 12, 'rating' => 4.2],
                    ['name' => 'فرع الجنوب', 'location' => 'حي العريجاء', 'queue' => 12, 'wait' => '10 دقائق', 'status' => 'نشط', 'capacity' => 70, 'staff' => 10, 'rating' => 4.7],
                    ['name' => 'فرع الشرق', 'location' => 'حي الملقا', 'queue' => 18, 'wait' => '18 دقيقة', 'status' => 'نشط', 'capacity' => 90, 'staff' => 13, 'rating' => 4.4],
                    ['name' => 'فرع الغرب', 'location' => 'حي الشفا', 'queue' => 8, 'wait' => '8 دقائق', 'status' => 'نشط', 'capacity' => 60, 'staff' => 8, 'rating' => 4.6],
                    ['name' => 'فرع الوسط', 'location' => 'حي العليا', 'queue' => 16, 'wait' => '12 دقيقة', 'status' => 'نشط', 'capacity' => 75, 'staff' => 11, 'rating' => 4.3]
                ] as $center)
                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all">
                    <div class="flex justify-between items-start mb-4">
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 bg-gradient-to-br from-blue-100 to-cyan-100 rounded-xl flex items-center justify-center text-3xl">
                                🏢
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-800">{{ $center['name'] }}</h3>
                                <p class="text-sm text-gray-600">📍 {{ $center['location'] }}</p>
                                <div class="flex items-center gap-1 mt-1">
                                    <span class="text-yellow-500">⭐</span>
                                    <span class="text-sm font-bold text-gray-700">{{ $center['rating'] }}</span>
                                </div>
                            </div>
                        </div>
                        <span class="px-4 py-2 bg-{{ $center['status'] === 'مزدحم' ? 'yellow' : 'green' }}-100 text-{{ $center['status'] === 'مزدحم' ? 'yellow' : 'green' }}-700 rounded-full text-sm font-bold">
                            {{ $center['status'] }}
                        </span>
                    </div>
                    
                    <div class="grid grid-cols-3 gap-3 mb-4">
                        <div class="p-3 bg-blue-50 rounded-xl text-center">
                            <p class="text-xs text-gray-600 mb-1">المنتظرين</p>
                            <p class="text-2xl font-black text-blue-600">{{ $center['queue'] }}</p>
                        </div>
                        <div class="p-3 bg-purple-50 rounded-xl text-center">
                            <p class="text-xs text-gray-600 mb-1">الانتظار</p>
                            <p class="text-lg font-black text-purple-600">{{ $center['wait'] }}</p>
                        </div>
                        <div class="p-3 bg-green-50 rounded-xl text-center">
                            <p class="text-xs text-gray-600 mb-1">الموظفين</p>
                            <p class="text-2xl font-black text-green-600">{{ $center['staff'] }}</p>
                        </div>
                    </div>
                    
                    <!-- Capacity Bar -->
                    <div class="mb-4">
                        <div class="flex justify-between text-xs text-gray-600 mb-2">
                            <span>الاستيعاب</span>
                            <span>{{ $center['queue'] }}/{{ $center['capacity'] }}</span>
                        </div>
                        <div class="h-3 bg-gray-200 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-blue-500 to-blue-600" style="width: {{ ($center['queue']/$center['capacity'])*100 }}%"></div>
                        </div>
                    </div>
                    
                    <div class="flex gap-2">
                        <button class="flex-1 px-4 py-2 bg-indigo-500 text-white rounded-lg font-bold hover:bg-indigo-600 transition-colors">
                            📊 إحصائيات
                        </button>
                        <button class="flex-1 px-4 py-2 bg-green-500 text-white rounded-lg font-bold hover:bg-green-600 transition-colors">
                            ⚙️ إدارة
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
            
        </div>
        
    </main>
    
</div>
@endsection
