<div class="absolute top-2 md:top-4 right-2 md:right-4 glass-effect rounded-xl md:rounded-2xl p-2 md:p-4 shadow-2xl border-2 border-white/30 max-w-[calc(100vw-1rem)] md:max-w-xs road-status-mobile" style="z-index: 1000;">
    <h4 class="text-xs md:text-sm font-black text-gray-900 mb-2 md:mb-3 flex items-center gap-2">
        <span class="text-base md:text-lg">🚦</span>
        <span>حالة الطرق</span>
    </h4>
    <div class="space-y-1 md:space-y-2">
        <div v-for="road in roadStatus" :key="road.id" class="flex items-center justify-between p-1.5 md:p-2 rounded-lg bg-white/50 hover:bg-white/80 transition-all cursor-pointer">
            <div class="flex items-center gap-1 md:gap-2 min-w-0 flex-1">
                <span class="text-sm md:text-lg shrink-0">@{{ road.icon }}</span>
                <span class="text-[10px] md:text-xs font-semibold text-gray-700 truncate">@{{ road.name }}</span>
            </div>
            <span class="text-[9px] md:text-xs font-black px-1.5 md:px-2 py-0.5 md:py-1 rounded-full whitespace-nowrap ml-1" :class="road.statusClass">@{{ road.status }}</span>
        </div>
    </div>
</div>
