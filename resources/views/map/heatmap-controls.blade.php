<div class="heatmap-control mobile-safe-area-bottom">
    <div class="glass-effect rounded-xl md:rounded-2xl px-2 md:px-6 py-2 md:py-3 shadow-2xl border-2 border-white/30 backdrop-blur-xl">
        <div class="flex items-center gap-2 md:gap-3 overflow-x-auto hide-scrollbar pb-1">
            <!-- Title - Hidden on Small Mobile -->
            <div class="hidden sm:flex items-center gap-2 pr-2 md:pr-3 border-r-2 border-gray-300 shrink-0">
                <span class="text-xl md:text-2xl">🔥</span>
                <span class="text-xs md:text-sm font-black text-gray-900 whitespace-nowrap">الخرائط</span>
            </div>
            
            <!-- Mobile Compact Title -->
            <div class="flex sm:hidden items-center gap-1 pr-2 border-r-2 border-gray-300 shrink-0">
                <span class="text-lg">🔥</span>
            </div>
            
            <!-- Heatmap Buttons - Compact on Mobile -->
            <button 
                v-for="heatmap in heatmapTypes" 
                :key="heatmap.id"
                @click="toggleHeatmap(heatmap.id)"
                class="heatmap-btn flex items-center gap-1 md:gap-2 px-2 md:px-4 py-1.5 md:py-2 rounded-lg md:rounded-xl text-[10px] md:text-xs font-black transition-all shadow-md active:shadow-sm shrink-0"
                :class="activeHeatmap === heatmap.id 
                    ? 'bg-gradient-to-r from-blue-600 to-purple-600 text-white scale-105' 
                    : 'bg-white text-gray-700 active:bg-gray-50'"
            >
                <span class="text-base md:text-lg">@{{ heatmap.icon }}</span>
                <span class="whitespace-nowrap hidden sm:inline">@{{ heatmap.name }}</span>
            </button>
            
            <!-- Clear Button - Icon Only on Mobile -->
            <button 
                v-if="activeHeatmap"
                @click="clearAllHeatmaps"
                class="flex items-center gap-1 md:gap-2 px-2 md:px-4 py-1.5 md:py-2 rounded-lg md:rounded-xl text-[10px] md:text-xs font-black bg-red-100 text-red-700 active:bg-red-200 transition-all shadow-md shrink-0"
            >
                <span class="text-base md:text-lg">🗑️</span>
                <span class="hidden sm:inline whitespace-nowrap">إيقاف</span>
            </button>
        </div>
    </div>
</div>

<style>
.hide-scrollbar::-webkit-scrollbar {
    display: none;
}
.hide-scrollbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
.pb-safe {
    padding-bottom: env(safe-area-inset-bottom, 0);
}
</style>
