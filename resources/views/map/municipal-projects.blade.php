<div v-if="showProjects" 
     class="fixed md:absolute top-0 md:top-24 left-0 md:left-auto right-0 md:right-4 glass-effect rounded-none md:rounded-2xl p-3 md:p-4 shadow-2xl border-0 md:border-2 border-white/30 max-w-full md:max-w-md max-h-screen md:max-h-[60vh] overflow-y-auto projects-panel-mobile" 
     style="z-index: 1100;">
    <div class="flex items-center justify-between mb-3 md:mb-4 sticky top-0 bg-white/95 backdrop-blur-lg pb-2 -mt-3 pt-3 z-10">
        <h4 class="text-sm md:text-base font-black text-gray-900 flex items-center gap-2">
            <span class="text-xl md:text-2xl">🏗️</span>
            <span>المشاريع البلدية</span>
        </h4>
        <button @click="showProjects = false" class="text-xl md:text-2xl h-8 w-8 md:h-9 md:w-9 rounded-lg bg-gray-100 active:bg-gray-200 flex items-center justify-center hover:bg-red-100 hover:text-red-600 transition-all">×</button>
    </div>
    <div class="space-y-2 md:space-y-3">
        <div v-for="project in municipalProjects" :key="project.id" class="p-3 md:p-4 rounded-xl bg-white border-2 border-gray-100 hover:border-blue-300 hover:shadow-lg transition-all cursor-pointer">
            <div class="flex items-start gap-2 md:gap-3 mb-2 md:mb-3">
                <span class="text-xl md:text-2xl shrink-0">@{{ project.icon }}</span>
                <div class="flex-1 min-w-0">
                    <h5 class="text-xs md:text-sm font-black text-gray-900 mb-1 line-clamp-2">@{{ project.name }}</h5>
                    <p class="text-[10px] md:text-xs text-gray-600 mb-2 line-clamp-2">@{{ project.location }}</p>
                    <div class="flex items-center gap-1 md:gap-2 text-[10px] md:text-xs flex-wrap">
                        <span class="px-2 py-0.5 md:py-1 rounded-full whitespace-nowrap" :class="project.statusBadge">@{{ project.status }}</span>
                        <span class="text-gray-600 truncate text-[9px] md:text-xs">@{{ project.contractor }}</span>
                    </div>
                </div>
            </div>
            <!-- Progress Bar -->
            <div class="mb-2">
                <div class="flex justify-between text-[10px] md:text-xs mb-1">
                    <span class="font-semibold text-gray-700">نسبة الإنجاز</span>
                    <span class="font-black text-blue-600">@{{ project.completion }}%</span>
                </div>
                <div class="h-1.5 md:h-2 bg-gray-200 rounded-full overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-blue-500 to-purple-500 rounded-full transition-all duration-500" :style="{ width: project.completion + '%' }"></div>
                </div>
            </div>
            <p class="text-[10px] md:text-xs text-gray-600">⏱️ المدة المتبقية: <span class="font-bold">@{{ project.remaining }}</span></p>
        </div>
    </div>
</div>

<!-- Projects Toggle Button - Compact on Mobile -->
<button @click="showProjects = !showProjects" 
        class="absolute top-16 md:top-4 left-2 md:left-auto right-auto md:right-[28rem] h-10 w-10 md:h-12 md:w-12 rounded-xl md:rounded-2xl glass-effect border-2 border-white/30 flex items-center justify-center shadow-lg active:scale-95 md:hover:scale-110 transition-all" 
        :class="{ 'bg-gradient-to-br from-orange-500 to-orange-600 border-orange-400': showProjects }"
        style="z-index: 1000;">
    <span class="text-xl md:text-2xl">@{{ showProjects ? '✕' : '🏗️' }}</span>
</button>
