<transition name="slide-up">
    <div v-if="showEmergencyServices" 
         class="fixed md:absolute top-16 md:top-4 left-4 right-4 md:right-auto md:left-4 md:w-[420px] glass-effect rounded-2xl md:rounded-3xl shadow-2xl max-h-[calc(100vh-5rem)] md:max-h-[calc(100vh-8rem)] overflow-y-auto border-2 border-white/30" 
         style="z-index: 1100 !important;">
        <div class="p-4 md:p-5 mobile-safe-area-top mobile-safe-area-bottom">
            <div class="flex items-center justify-between mb-4 md:mb-5 sticky top-0 bg-white/95 backdrop-blur-lg pb-3 -mt-4 pt-4 z-10">
                <h3 class="text-lg md:text-xl font-black bg-gradient-to-r from-red-600 to-pink-600 bg-clip-text text-transparent flex items-center gap-2">
                    <span class="text-2xl md:text-3xl">🚨</span>
                    الخدمات الطارئة
                </h3>
                <button @click="showEmergencyServices = false" 
                        class="h-9 w-9 md:h-10 md:w-10 rounded-xl bg-gray-100 hover:bg-red-100 hover:text-red-600 active:bg-red-200 flex items-center justify-center transition-all">
                    <span class="text-xl md:text-2xl font-bold">×</span>
                </button>
            </div>
            
            <!-- Services List - Optimized for Mobile & Desktop -->
            <div class="space-y-2 md:space-y-3">
                <div 
                    v-for="service in emergencyServices" 
                    :key="service.id"
                    class="service-card p-3 md:p-5 rounded-xl md:rounded-2xl bg-white border-2 border-gray-100 hover:border-blue-300 active:border-blue-400 cursor-pointer"
                    @click="showServiceDetails(service)"
                >
                    <div class="flex items-start gap-3 md:gap-4 mb-3 md:mb-4">
                        <div class="h-12 w-12 md:h-16 md:w-16 rounded-xl md:rounded-2xl flex items-center justify-center shrink-0 shadow-lg" :class="service.bgClass">
                            <span class="text-2xl md:text-3xl">@{{ service.icon }}</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="text-sm md:text-base font-black text-gray-900 mb-1 truncate">@{{ service.name }}</h4>
                            <p class="text-[10px] md:text-xs text-gray-600 mb-2 line-clamp-2">@{{ service.address }}</p>
                            <div class="flex items-center gap-1 md:gap-2 text-[10px] md:text-xs flex-wrap">
                                <span class="font-black px-2 md:px-3 py-1 rounded-full shadow-sm whitespace-nowrap" :class="service.statusClass">@{{ service.status }}</span>
                                <span class="text-blue-600 font-bold bg-blue-50 px-2 md:px-3 py-1 rounded-full whitespace-nowrap">📍 @{{ service.distance }}</span>
                                <span class="text-purple-600 font-bold bg-purple-50 px-2 md:px-3 py-1 rounded-full whitespace-nowrap">⏱️ @{{ service.eta }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-2 md:gap-3">
                        <a :href="'tel:' + service.phone" 
                           class="flex items-center justify-center gap-1 md:gap-2 px-3 md:px-4 py-2 md:py-3 rounded-lg md:rounded-xl bg-gradient-to-r from-green-500 to-green-600 text-white font-black text-xs md:text-sm shadow-lg active:scale-95 transition-all"
                           @click.stop>
                            <span class="text-base md:text-lg">📞</span>
                            <span class="hidden md:inline">@{{ service.phone }}</span>
                            <span class="md:hidden">اتصال</span>
                        </a>
                        <button @click.stop="navigateToService(service)"
                                class="flex items-center justify-center gap-1 md:gap-2 px-3 md:px-4 py-2 md:py-3 rounded-lg md:rounded-xl bg-gradient-to-r from-blue-500 to-blue-600 text-white font-black text-xs md:text-sm shadow-lg active:scale-95 transition-all">
                            <span class="text-base md:text-lg">🧭</span>
                            <span>اتجاهات</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</transition>
