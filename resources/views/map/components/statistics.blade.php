<!-- Statistics Dashboard -->
<div v-show="showStatistics" class="fixed top-20 left-4 z-[9999] w-80 glass-effect rounded-2xl shadow-2xl border-2 border-white/30 p-6 animate-slide-in-left">
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-xl font-bold text-gray-800 flex items-center gap-2">
            <span class="text-2xl">📊</span>
            <span>إحصائيات النظام</span>
        </h3>
        <button @click="showStatistics = false" class="text-gray-500 hover:text-gray-700 text-2xl transition-colors">
            ✕
        </button>
    </div>
    
    <!-- Statistics Cards -->
    <div class="space-y-4">
        <!-- Total Services -->
        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-4 border-2 border-blue-200 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1 font-semibold">إجمالي الخدمات</p>
                    <p class="text-3xl font-bold text-blue-600">@{{ statistics.total_services || emergencyServices.length }}</p>
                </div>
                <span class="text-4xl animate-bounce">🏥</span>
            </div>
        </div>
        
        <!-- Total Projects -->
        <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl p-4 border-2 border-green-200 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1 font-semibold">المشاريع البلدية</p>
                    <p class="text-3xl font-bold text-green-600">@{{ statistics.total_projects || municipalProjects.length }}</p>
                </div>
                <span class="text-4xl animate-bounce" style="animation-delay: 0.1s;">🏗️</span>
            </div>
        </div>
        
        <!-- Total Roads -->
        <div class="bg-gradient-to-br from-orange-50 to-amber-50 rounded-xl p-4 border-2 border-orange-200 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1 font-semibold">الطرق المتاحة</p>
                    <p class="text-3xl font-bold text-orange-600">@{{ statistics.total_roads || roadStatus.length }}</p>
                </div>
                <span class="text-4xl animate-bounce" style="animation-delay: 0.2s;">🛣️</span>
            </div>
        </div>
    </div>
    
    <!-- Refresh Button -->
    <button 
        @click="loadStatistics" 
        class="mt-6 w-full py-3 bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-xl font-bold hover:shadow-lg transition-all duration-300 hover:-translate-y-1 hover:from-blue-600 hover:to-indigo-700">
        🔄 تحديث الإحصائيات
    </button>
</div>

<style>
@keyframes slide-in-left {
    from {
        transform: translateX(-100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

.animate-slide-in-left {
    animation: slide-in-left 0.4s ease-out;
}
</style>
