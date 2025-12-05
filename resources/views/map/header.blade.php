<div class="glass-effect border-b border-white/30 shadow-2xl mobile-header mobile-safe-area-top" style="z-index: 40 !important; position: relative;">
    <div class="px-2 md:px-4 py-2 md:py-3 flex items-center justify-between gap-2">
        
        <!-- Logo - Smaller on Mobile -->
        <a href="/" class="h-10 w-10 md:h-12 md:w-12 rounded-xl md:rounded-2xl bg-gradient-to-br from-blue-600 via-blue-500 to-purple-600 flex items-center justify-center shadow-xl hover:shadow-2xl transition-all hover:scale-110 shrink-0">
            <span class="text-sm md:text-lg font-black text-white">أب</span>
        </a>

        <!-- Search Bar - Flexible on Mobile -->
        <div class="flex-1 relative min-w-0">
            <input 
                v-model="searchQuery"
                @focus="showSearchResults = true"
                @input="performSearch"
                @blur="setTimeout(() => showSearchResults = false, 200)"
                type="text" 
                placeholder="🔍 ابحث..."
                class="w-full px-3 md:px-4 py-2 md:py-3 pr-10 md:pr-12 rounded-xl md:rounded-2xl glass-effect border-2 border-white/40 focus:border-blue-500 outline-none text-xs md:text-sm font-semibold shadow-lg transition-all"
            >
            <svg class="absolute right-3 md:right-4 top-1/2 -translate-y-1/2 w-4 h-4 md:w-5 md:h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            
            <!-- Search Results - Full Width on Mobile -->
            <transition name="slide-up">
                <div v-if="showSearchResults && searchResults.length" 
                     class="absolute md:relative top-full mt-2 md:mt-3 left-0 right-0 glass-effect rounded-xl md:rounded-2xl border-2 border-white/30 shadow-2xl max-h-60 md:max-h-80 overflow-y-auto z-50"
                     :class="{'search-results-mobile': window.innerWidth < 768}">
                    <div 
                        v-for="result in searchResults" 
                        :key="result.id"
                        @click="selectDestination(result)"
                        class="p-3 md:p-4 hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 active:bg-blue-100 cursor-pointer border-b border-gray-100 last:border-0 transition-all"
                    >
                        <div class="flex items-center gap-2 md:gap-3">
                            <div class="text-2xl md:text-3xl">@{{ result.icon }}</div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs md:text-sm font-bold text-gray-900 truncate">@{{ result.name }}</p>
                                <p class="text-[10px] md:text-xs text-gray-500 truncate">@{{ result.address }}</p>
                            </div>
                            <div class="text-[10px] md:text-xs font-black text-blue-600 bg-blue-100 px-2 md:px-3 py-1 rounded-full whitespace-nowrap">@{{ result.distance }}</div>
                        </div>
                    </div>
                </div>
            </transition>
        </div>

        <!-- Action Buttons - Compact on Mobile -->
        <div class="flex items-center gap-1 md:gap-2 shrink-0">
            <!-- Map Effects Dropdown -->
            <div class="relative">
                <button @click="showMapEffects = !showMapEffects" 
                        class="h-10 w-10 md:h-12 md:w-12 rounded-xl md:rounded-2xl glass-effect border-2 border-white/30 flex items-center justify-center shadow-lg hover:shadow-xl transition-all active:scale-95 md:hover:scale-110"
                        title="تأثيرات الخريطة">
                    <span class="text-base md:text-xl">🎨</span>
                </button>
                
                <transition name="fade">
                    <div v-if="showMapEffects" 
                         @click.stop
                         class="absolute top-full right-0 mt-2 glass-effect rounded-xl shadow-2xl border-2 border-white/30 overflow-hidden z-50 min-w-[180px]">
                        <div class="p-3">
                            <h4 class="text-xs font-black text-gray-900 mb-2">فلاتر الخريطة</h4>
                            <button 
                                v-for="filter in ['none', 'vintage', 'cinematic', 'vibrant', 'neon', 'warm', 'cool', 'grayscale']"
                                :key="filter"
                                @click="changeMapFilter(filter)"
                                class="w-full px-3 py-2 text-right text-xs font-bold hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 active:bg-blue-100 transition-all rounded-lg mb-1"
                                :class="currentMapFilter === filter ? 'bg-blue-50 text-blue-700' : 'text-gray-700'"
                            >
                                @{{ getFilterName(filter) }}
                            </button>
                            
                            <hr class="my-2 border-gray-200">
                            
                            <h4 class="text-xs font-black text-gray-900 mb-2">تأثيرات إضافية</h4>
                            <button @click="toggleGrid" class="w-full px-3 py-2 text-right text-xs font-bold hover:bg-gray-50 transition-all rounded-lg flex items-center justify-between">
                                <span>الشبكة</span>
                                <span v-if="showGrid">✓</span>
                            </button>
                            <button @click="toggleParticles" class="w-full px-3 py-2 text-right text-xs font-bold hover:bg-gray-50 transition-all rounded-lg flex items-center justify-between">
                                <span>جزيئات</span>
                                <span v-if="showParticles">✓</span>
                            </button>
                        </div>
                    </div>
                </transition>
            </div>
            
            <!-- Map Style Dropdown -->
            <div class="relative">
                <button @click="showMapStyles = !showMapStyles" 
                        class="h-10 w-10 md:h-12 md:w-12 rounded-xl md:rounded-2xl glass-effect border-2 border-white/30 flex items-center justify-center shadow-lg hover:shadow-xl transition-all active:scale-95 md:hover:scale-110"
                        :class="{ 'bg-gradient-to-br from-blue-500 to-purple-600 border-blue-400': showMapStyles }"
                        title="اختر نمط الخريطة">
                    <span class="text-base md:text-xl" :class="showMapStyles ? 'text-white' : ''">
                        @{{ availableMapStyles.find(s => s.id === currentMapProvider)?.icon || '🗺️' }}
                    </span>
                </button>
                
                <!-- Dropdown Menu -->
                <transition name="fade">
                    <div v-if="showMapStyles" 
                         @click.stop
                         class="absolute top-full right-0 mt-2 glass-effect rounded-xl md:rounded-2xl shadow-2xl border-2 border-white/30 overflow-hidden z-50 min-w-[160px]">
                        <button 
                            v-for="style in availableMapStyles"
                            :key="style.id"
                            @click="switchMapProvider(style.id); showMapStyles = false"
                            class="w-full px-3 md:px-4 py-2 md:py-2.5 text-right flex items-center gap-2 hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 active:bg-blue-100 transition-all text-xs md:text-sm font-bold"
                            :class="currentMapProvider === style.id ? 'bg-blue-50 text-blue-700' : 'text-gray-700'"
                        >
                            <span class="text-lg md:text-xl">@{{ style.icon }}</span>
                            <span class="whitespace-nowrap">@{{ style.name }}</span>
                            <span v-if="currentMapProvider === style.id" class="mr-auto text-blue-600">✓</span>
                        </button>
                    </div>
                </transition>
            </div>
            
            <button @click="useGPSLocation" 
                    class="h-10 w-10 md:h-12 md:w-12 rounded-xl md:rounded-2xl glass-effect border-2 border-white/30 flex items-center justify-center shadow-lg hover:shadow-xl transition-all active:scale-95 md:hover:scale-110" 
                    :class="{ 'bg-gradient-to-br from-blue-500 to-blue-600 border-blue-400': usingGPS }">
                <svg class="w-5 h-5 md:w-6 md:h-6" :class="usingGPS ? 'text-white' : 'text-gray-700'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                </svg>
            </button>
            
            <button @click="showEmergencyServices = !showEmergencyServices" 
                    class="h-10 w-10 md:h-12 md:w-12 rounded-xl md:rounded-2xl glass-effect border-2 border-white/30 flex items-center justify-center shadow-lg hover:shadow-xl transition-all active:scale-95 md:hover:scale-110 btn-pulse" 
                    :class="{ 'bg-gradient-to-br from-red-500 to-red-600 border-red-400': showEmergencyServices }">
                <svg class="w-5 h-5 md:w-6 md:h-6" :class="showEmergencyServices ? 'text-white' : 'text-gray-700'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </button>
        </div>
    </div>
    
    <!-- Route Alerts - Scrollable on Mobile -->
    <transition name="fade">
        <div v-if="routeAlerts.length" class="px-2 md:px-4 pb-2 md:pb-3 flex gap-2 overflow-x-auto hide-scrollbar">
            <div 
                v-for="alert in routeAlerts" 
                :key="alert.id"
                class="shrink-0 px-3 md:px-4 py-1.5 md:py-2 rounded-lg md:rounded-xl text-[10px] md:text-xs font-black flex items-center gap-2 alert-badge shadow-lg"
                :class="alert.class"
            >
                <span class="text-base md:text-lg">@{{ alert.icon }}</span>
                <span class="whitespace-nowrap">@{{ alert.message }}</span>
            </div>
        </div>
    </transition>
</div>

<style>
.hide-scrollbar::-webkit-scrollbar {
    display: none;
}
.hide-scrollbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
</style>
