@extends('layouts.app')

@section('content')
<div class="flex h-screen bg-gray-100">
    
    <!-- Sidebar -->
    @include('government.partials.sidebar')
    
    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto">
        
        <!-- Header -->
        <header class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-10">
            <div class="px-8 py-4">
                <h2 class="text-2xl font-black text-gray-800">📈 التقارير التحليلية</h2>
                <p class="text-sm text-gray-600">تقارير وإحصائيات شاملة لدعم اتخاذ القرار</p>
            </div>
        </header>
        
        <!-- Content -->
        <div class="p-8">
            
            <!-- KPIs Overview -->
            <div class="grid md:grid-cols-3 gap-6 mb-8">
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 text-white shadow-xl">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <p class="text-sm opacity-90 mb-2">إجمالي البلاغات</p>
                            <p class="text-4xl font-black">{{ $stats['total_reports'] }}</p>
                        </div>
                        <div class="w-14 h-14 bg-white/20 rounded-xl flex items-center justify-center text-3xl">
                            📋
                        </div>
                    </div>
                    <p class="text-sm opacity-75">+15% من الشهر الماضي</p>
                </div>
                
                <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl p-6 text-white shadow-xl">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <p class="text-sm opacity-90 mb-2">معدل الإنجاز</p>
                            <p class="text-4xl font-black">{{ round(($stats['completed_reports']/$stats['total_reports'])*100) }}%</p>
                        </div>
                        <div class="w-14 h-14 bg-white/20 rounded-xl flex items-center justify-center text-3xl">
                            ✅
                        </div>
                    </div>
                    <p class="text-sm opacity-75">{{ $stats['completed_reports'] }} بلاغ مكتمل</p>
                </div>
                
                <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl p-6 text-white shadow-xl">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <p class="text-sm opacity-90 mb-2">رضا المستفيدين</p>
                            <p class="text-4xl font-black">{{ $stats['satisfaction_rate'] }}%</p>
                        </div>
                        <div class="w-14 h-14 bg-white/20 rounded-xl flex items-center justify-center text-3xl">
                            ⭐
                        </div>
                    </div>
                    <p class="text-sm opacity-75">تقييم ممتاز</p>
                </div>
            </div>
            
            <!-- Charts -->
            <div class="grid md:grid-cols-2 gap-6 mb-6">
                
                <!-- Reports Trend -->
                <div class="bg-white rounded-2xl p-6 shadow-lg">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-black text-gray-800">📊 اتجاه البلاغات</h3>
                        <button onclick="expandChart('reportsTrendChart')" class="px-4 py-2 bg-indigo-500 text-white rounded-lg text-sm font-bold hover:bg-indigo-600">
                            🔍 تكبير
                        </button>
                    </div>
                    <div style="height: 300px; position: relative;">
                        <canvas id="reportsTrendChart"></canvas>
                    </div>
                </div>
                
                <!-- Response Time -->
                <div class="bg-white rounded-2xl p-6 shadow-lg">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-black text-gray-800">⏱️ أوقات الاستجابة</h3>
                        <button onclick="expandChart('responseTimeChart')" class="px-4 py-2 bg-green-500 text-white rounded-lg text-sm font-bold hover:bg-green-600">
                            🔍 تكبير
                        </button>
                    </div>
                    <div style="height: 300px; position: relative;">
                        <canvas id="responseTimeChart"></canvas>
                    </div>
                </div>
                
            </div>
            
            <!-- Detailed Reports -->
            <div class="grid md:grid-cols-2 gap-6">
                
                <!-- By Category -->
                <div class="bg-white rounded-2xl p-6 shadow-lg">
                    <h3 class="text-xl font-black text-gray-800 mb-6">📑 البلاغات حسب الفئة</h3>
                    
                    <div class="space-y-4">
                        @foreach([
                            ['name' => 'حوادث مرورية', 'count' => 45, 'percentage' => 35, 'color' => 'red'],
                            ['name' => 'صيانة طرق', 'count' => 32, 'percentage' => 25, 'color' => 'yellow'],
                            ['name' => 'إنارة', 'count' => 28, 'percentage' => 22, 'color' => 'blue'],
                            ['name' => 'أخرى', 'count' => 22, 'percentage' => 18, 'color' => 'gray']
                        ] as $category)
                        <div>
                            <div class="flex justify-between text-sm mb-2">
                                <span class="font-bold text-gray-700">{{ $category['name'] }}</span>
                                <span class="font-bold text-{{ $category['color'] }}-600">{{ $category['count'] }} ({{ $category['percentage'] }}%)</span>
                            </div>
                            <div class="h-3 bg-gray-200 rounded-full overflow-hidden">
                                <div class="h-full bg-{{ $category['color'] }}-500" style="width: {{ $category['percentage'] }}%"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                
                <!-- Performance Metrics -->
                <div class="bg-white rounded-2xl p-6 shadow-lg">
                    <h3 class="text-xl font-black text-gray-800 mb-6">🎯 مؤشرات الأداء</h3>
                    
                    <div class="space-y-6">
                        <div>
                            <div class="flex justify-between mb-2">
                                <span class="text-sm font-bold text-gray-700">متوسط وقت الاستجابة</span>
                                <span class="text-2xl font-black text-blue-600">{{ $stats['avg_response_time'] }}</span>
                            </div>
                            <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-blue-500 to-blue-600" style="width: 85%"></div>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">الهدف: أقل من 15 دقيقة</p>
                        </div>
                        
                        <div>
                            <div class="flex justify-between mb-2">
                                <span class="text-sm font-bold text-gray-700">الفرق النشطة</span>
                                <span class="text-2xl font-black text-green-600">{{ $stats['active_teams'] }}/10</span>
                            </div>
                            <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-green-500 to-green-600" style="width: 80%"></div>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">نسبة التشغيل: 80%</p>
                        </div>
                        
                        <div>
                            <div class="flex justify-between mb-2">
                                <span class="text-sm font-bold text-gray-700">رضا المستفيدين</span>
                                <span class="text-2xl font-black text-purple-600">{{ $stats['satisfaction_rate'] }}%</span>
                            </div>
                            <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-purple-500 to-purple-600" style="width: {{ $stats['satisfaction_rate'] }}%"></div>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">تقييم ممتاز</p>
                        </div>
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
    // Reports Trend Chart
    const reportsTrendCtx = document.getElementById('reportsTrendChart').getContext('2d');
    charts.reportsTrendChart = new Chart(reportsTrendCtx, {
        type: 'line',
        data: {
            labels: ['يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو'],
            datasets: [{
                label: 'البلاغات المستلمة',
                data: [85, 92, 78, 105, 118, 127],
                borderColor: 'rgb(59, 130, 246)',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
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
    
    // Response Time Chart
    const responseTimeCtx = document.getElementById('responseTimeChart').getContext('2d');
    charts.responseTimeChart = new Chart(responseTimeCtx, {
        type: 'bar',
        data: {
            labels: ['عاجل', 'مهم', 'عادي'],
            datasets: [{
                label: 'متوسط الوقت (دقائق)',
                data: [8, 15, 25],
                backgroundColor: [
                    'rgba(239, 68, 68, 0.8)',
                    'rgba(245, 158, 11, 0.8)',
                    'rgba(59, 130, 246, 0.8)'
                ],
                borderWidth: 2,
                borderColor: [
                    'rgb(239, 68, 68)',
                    'rgb(245, 158, 11)',
                    'rgb(59, 130, 246)'
                ]
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
});

function expandChart(chartId) {
    const modal = document.getElementById('chartModal');
    const modalCanvas = document.getElementById('modalChart');
    const modalTitle = document.getElementById('modalChartTitle');
    const originalChart = charts[chartId];
    
    if (!originalChart) return;
    
    // Set title
    if (chartId === 'reportsTrendChart') {
        modalTitle.textContent = '📊 اتجاه البلاغات - عرض مفصل';
    } else if (chartId === 'responseTimeChart') {
        modalTitle.textContent = '⏱️ أوقات الاستجابة - عرض مفصل';
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
