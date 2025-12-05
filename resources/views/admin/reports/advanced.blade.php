@extends('layouts.app')

@section('content')
<div class="flex h-screen bg-gray-100">
    
    <!-- Sidebar -->
    @include('admin.partials.sidebar')
    
    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto">
        
        <!-- Header -->
        <header class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-10">
            <div class="px-8 py-4">
                <h2 class="text-2xl font-black text-gray-800">📊 التقارير المتقدمة</h2>
                <p class="text-sm text-gray-600">تحليلات وإحصائيات شاملة للنظام</p>
            </div>
        </header>
        
        <!-- Content -->
        <div class="p-8">
            
            <!-- Date Filter -->
            <div class="bg-white rounded-2xl p-6 shadow-lg mb-6">
                <div class="grid md:grid-cols-5 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">من تاريخ</label>
                        <input type="date" class="w-full px-4 py-2 border-2 border-gray-200 rounded-xl focus:border-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">إلى تاريخ</label>
                        <input type="date" class="w-full px-4 py-2 border-2 border-gray-200 rounded-xl focus:border-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">نوع التقرير</label>
                        <select class="w-full px-4 py-2 border-2 border-gray-200 rounded-xl focus:border-indigo-500">
                            <option>الكل</option>
                            <option>الحوادث</option>
                            <option>الازدحام</option>
                            <option>المشاريع</option>
                        </select>
                    </div>
                    <div class="flex items-end gap-2">
                        <button class="flex-1 px-6 py-2 bg-indigo-500 text-white rounded-xl font-bold hover:bg-indigo-600">
                            بحث
                        </button>
                        <button class="px-6 py-2 bg-green-500 text-white rounded-xl font-bold hover:bg-green-600">
                            📥 تصدير
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Quick Stats -->
            <div class="grid md:grid-cols-4 gap-6 mb-8">
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 text-white shadow-xl">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <p class="text-sm opacity-90 mb-1">إجمالي الحوادث</p>
                            <p class="text-4xl font-black">127</p>
                        </div>
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center text-2xl">
                            ⚠️
                        </div>
                    </div>
                    <div class="flex items-center gap-2 text-sm">
                        <span class="px-2 py-1 bg-white/20 rounded-lg">↑ 12%</span>
                        <span class="opacity-75">من الشهر الماضي</span>
                    </div>
                </div>
                
                <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl p-6 text-white shadow-xl">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <p class="text-sm opacity-90 mb-1">مشاريع مكتملة</p>
                            <p class="text-4xl font-black">42</p>
                        </div>
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center text-2xl">
                            ✅
                        </div>
                    </div>
                    <div class="flex items-center gap-2 text-sm">
                        <span class="px-2 py-1 bg-white/20 rounded-lg">↑ 8%</span>
                        <span class="opacity-75">من الشهر الماضي</span>
                    </div>
                </div>
                
                <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl p-6 text-white shadow-xl">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <p class="text-sm opacity-90 mb-1">متوسط وقت الاستجابة</p>
                            <p class="text-4xl font-black">8.5<span class="text-lg">د</span></p>
                        </div>
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center text-2xl">
                            ⏱️
                        </div>
                    </div>
                    <div class="flex items-center gap-2 text-sm">
                        <span class="px-2 py-1 bg-white/20 rounded-lg">↓ 15%</span>
                        <span class="opacity-75">تحسن ممتاز</span>
                    </div>
                </div>
                
                <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl p-6 text-white shadow-xl">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <p class="text-sm opacity-90 mb-1">رضا المستخدمين</p>
                            <p class="text-4xl font-black">94<span class="text-lg">%</span></p>
                        </div>
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center text-2xl">
                            ⭐
                        </div>
                    </div>
                    <div class="flex items-center gap-2 text-sm">
                        <span class="px-2 py-1 bg-white/20 rounded-lg">↑ 3%</span>
                        <span class="opacity-75">تقييم ممتاز</span>
                    </div>
                </div>
            </div>
            
            <!-- Charts -->
            <div class="grid md:grid-cols-2 gap-6 mb-6">
                
                <!-- Incidents Chart -->
                <div class="bg-white rounded-2xl p-6 shadow-lg">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                            <span class="text-2xl">📈</span>
                            إحصائيات الحوادث
                        </h3>
                        <button onclick="expandChart('incidentsChart')" class="px-4 py-2 bg-indigo-500 text-white rounded-lg text-sm font-bold hover:bg-indigo-600 transition-colors">
                            🔍 تكبير
                        </button>
                    </div>
                    <div style="height: 300px; position: relative;">
                        <canvas id="incidentsChart"></canvas>
                    </div>
                </div>
                
                <!-- Traffic Chart -->
                <div class="bg-white rounded-2xl p-6 shadow-lg">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                            <span class="text-2xl">🚗</span>
                            توزيع الازدحام
                        </h3>
                        <button onclick="expandChart('trafficChart')" class="px-4 py-2 bg-indigo-500 text-white rounded-lg text-sm font-bold hover:bg-indigo-600 transition-colors">
                            🔍 تكبير
                        </button>
                    </div>
                    <div style="height: 300px; position: relative;">
                        <canvas id="trafficChart"></canvas>
                    </div>
                </div>
                
            </div>
            
            <!-- Detailed Tables -->
            <div class="grid md:grid-cols-2 gap-6">
                
                <!-- Top Incidents Areas -->
                <div class="bg-white rounded-2xl p-6 shadow-lg">
                    <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <span class="text-2xl">🔴</span>
                        أكثر المناطق حوادثاً
                    </h3>
                    <div class="space-y-3">
                        @foreach([
                            ['name' => 'طريق الملك فهد', 'count' => 45, 'percentage' => 85],
                            ['name' => 'طريق الملك عبدالله', 'count' => 32, 'percentage' => 65],
                            ['name' => 'شارع العليا', 'count' => 28, 'percentage' => 55],
                            ['name' => 'طريق الملك خالد', 'count' => 22, 'percentage' => 45]
                        ] as $area)
                        <div class="p-4 bg-gray-50 rounded-xl">
                            <div class="flex justify-between items-center mb-2">
                                <span class="font-bold text-gray-800">{{ $area['name'] }}</span>
                                <span class="text-sm font-bold text-red-600">{{ $area['count'] }} حادث</span>
                            </div>
                            <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-red-500 to-orange-500" style="width: {{ $area['percentage'] }}%"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                
                <!-- Peak Hours -->
                <div class="bg-white rounded-2xl p-6 shadow-lg">
                    <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <span class="text-2xl">🕐</span>
                        أوقات الذروة
                    </h3>
                    <div class="space-y-3">
                        @foreach([
                            ['time' => '7:00 - 9:00 صباحاً', 'level' => 'شديد جداً', 'percentage' => 95, 'color' => 'red'],
                            ['time' => '12:00 - 2:00 ظهراً', 'level' => 'متوسط', 'percentage' => 60, 'color' => 'yellow'],
                            ['time' => '4:00 - 7:00 مساءً', 'level' => 'شديد', 'percentage' => 85, 'color' => 'orange'],
                            ['time' => '10:00 - 12:00 ليلاً', 'level' => 'خفيف', 'percentage' => 30, 'color' => 'green']
                        ] as $hour)
                        <div class="p-4 bg-gray-50 rounded-xl">
                            <div class="flex justify-between items-center mb-2">
                                <span class="font-bold text-gray-800">{{ $hour['time'] }}</span>
                                <span class="px-3 py-1 bg-{{ $hour['color'] }}-100 text-{{ $hour['color'] }}-700 rounded-full text-xs font-bold">
                                    {{ $hour['level'] }}
                                </span>
                            </div>
                            <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-{{ $hour['color'] }}-500 to-{{ $hour['color'] }}-600" style="width: {{ $hour['percentage'] }}%"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                
            </div>
            
        </div>
        
    </main>
    
</div>

<!-- Chart Expand Modal -->
<div id="chartModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden" onclick="closeChartModal(event)">
    <div class="flex items-center justify-center min-h-screen p-8">
        <div class="bg-white rounded-2xl shadow-2xl max-w-6xl w-full p-8" onclick="event.stopPropagation()">
            <div class="flex justify-between items-center mb-6">
                <h3 id="modalChartTitle" class="text-2xl font-black text-gray-800"></h3>
                <button onclick="closeChartModal()" class="w-10 h-10 bg-red-500 hover:bg-red-600 text-white rounded-xl font-bold text-xl transition-colors">
                    ✕
                </button>
            </div>
            <div style="height: 500px; position: relative;">
                <canvas id="modalChart"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
let charts = {};
let modalChartInstance = null;

document.addEventListener('DOMContentLoaded', function() {
    
    // Incidents Chart
    const incidentsCtx = document.getElementById('incidentsChart').getContext('2d');
    charts.incidentsChart = new Chart(incidentsCtx, {
        type: 'line',
        data: {
            labels: ['يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو'],
            datasets: [{
                label: 'عدد الحوادث',
                data: [65, 59, 80, 81, 96, 127],
                borderColor: 'rgb(239, 68, 68)',
                backgroundColor: 'rgba(239, 68, 68, 0.1)',
                tension: 0.4,
                fill: true,
                borderWidth: 3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        font: {
                            size: 14,
                            family: 'Cairo'
                        }
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    titleFont: {
                        size: 14,
                        family: 'Cairo'
                    },
                    bodyFont: {
                        size: 12,
                        family: 'Cairo'
                    },
                    padding: 12,
                    cornerRadius: 8
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        font: {
                            family: 'Cairo'
                        }
                    }
                },
                x: {
                    ticks: {
                        font: {
                            family: 'Cairo'
                        }
                    }
                }
            }
        }
    });
    
    // Traffic Chart
    const trafficCtx = document.getElementById('trafficChart').getContext('2d');
    charts.trafficChart = new Chart(trafficCtx, {
        type: 'doughnut',
        data: {
            labels: ['سالك', 'خفيف', 'متوسط', 'شديد'],
            datasets: [{
                data: [25, 30, 30, 15],
                backgroundColor: [
                    'rgb(16, 185, 129)',
                    'rgb(132, 204, 22)',
                    'rgb(245, 158, 11)',
                    'rgb(239, 68, 68)'
                ],
                borderWidth: 3,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        font: {
                            size: 14,
                            family: 'Cairo'
                        },
                        padding: 15
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    titleFont: {
                        size: 14,
                        family: 'Cairo'
                    },
                    bodyFont: {
                        size: 12,
                        family: 'Cairo'
                    },
                    padding: 12,
                    cornerRadius: 8,
                    callbacks: {
                        label: function(context) {
                            const label = context.label || '';
                            const value = context.parsed || 0;
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = ((value / total) * 100).toFixed(1);
                            return `${label}: ${value}% (${percentage}% من الإجمالي)`;
                        }
                    }
                }
            }
        }
    });
    
});

function expandChart(chartId) {
    const modal = document.getElementById('chartModal');
    const modalCanvas = document.getElementById('modalChart');
    const modalTitle = document.getElementById('modalChartTitle');
    const originalChart = charts[chartId];
    
    if (!originalChart) return;
    
    // Set title
    if (chartId === 'incidentsChart') {
        modalTitle.textContent = '📈 إحصائيات الحوادث - عرض مفصل';
    } else if (chartId === 'trafficChart') {
        modalTitle.textContent = '🚗 توزيع الازدحام - عرض مفصل';
    }
    
    // Show modal
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
    
    // Destroy existing modal chart if any
    if (modalChartInstance) {
        modalChartInstance.destroy();
    }
    
    // Create enlarged chart
    const ctx = modalCanvas.getContext('2d');
    modalChartInstance = new Chart(ctx, {
        type: originalChart.config.type,
        data: originalChart.config.data,
        options: {
            ...originalChart.config.options,
            animation: {
                duration: 1000
            }
        }
    });
}

function closeChartModal(event) {
    if (event && event.target.id !== 'chartModal') return;
    
    const modal = document.getElementById('chartModal');
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto';
    
    if (modalChartInstance) {
        modalChartInstance.destroy();
        modalChartInstance = null;
    }
}

// Close modal with ESC key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeChartModal();
    }
});
</script>

<style>
@import url('https://fonts.googleapis.com/css2?family=Cairo:wght@400;700;800&display=swap');

#chartModal {
    animation: fadeIn 0.3s ease-in-out;
}

#chartModal > div {
    animation: slideUp 0.3s ease-in-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

@keyframes slideUp {
    from {
        transform: translateY(50px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

canvas {
    max-height: 100%;
}
</style>
@endsection
