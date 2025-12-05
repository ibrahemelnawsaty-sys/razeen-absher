<transition name="slide-up">
    <div v-if="selectedServiceDetails" 
         class="fixed inset-0 md:absolute md:inset-auto md:top-20 md:right-4 md:w-96 md:max-h-[calc(100vh-6rem)] overflow-y-auto glass-effect rounded-none md:rounded-2xl shadow-2xl border-0 md:border-2 border-white/30 service-details-panel" 
         style="z-index: 1050;">
        <div class="p-4 md:p-5 bg-white rounded-none md:rounded-2xl">
            <!-- Header -->
            <div class="flex items-center justify-between mb-4 pb-3 border-b-2 border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="h-12 w-12 rounded-xl flex items-center justify-center shadow-lg" :class="selectedServiceDetails.bgClass">
                        <span class="text-2xl">@{{ selectedServiceDetails.icon }}</span>
                    </div>
                    <div>
                        <h3 class="text-sm font-black text-gray-900 line-clamp-1">@{{ selectedServiceDetails.name }}</h3>
                        <span class="text-xs px-2 py-1 rounded-full" :class="selectedServiceDetails.statusClass">@{{ selectedServiceDetails.status }}</span>
                    </div>
                </div>
                <button @click="closeServiceDetails" class="h-8 w-8 rounded-lg bg-gray-100 hover:bg-red-100 active:bg-red-200 flex items-center justify-center transition-all">
                    <span class="text-lg font-bold text-gray-700 hover:text-red-600">×</span>
                </button>
            </div>

            <!-- Info Grid -->
            <div class="grid grid-cols-2 gap-2 mb-4">
                <div class="p-3 bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl border border-blue-200">
                    <div class="text-xs text-blue-600 mb-1 font-semibold">المسافة</div>
                    <div class="text-base font-black text-blue-900">@{{ selectedServiceDetails.distance }}</div>
                </div>
                <div class="p-3 bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl border border-purple-200">
                    <div class="text-xs text-purple-600 mb-1 font-semibold">وقت الوصول</div>
                    <div class="text-base font-black text-purple-900">@{{ selectedServiceDetails.eta }}</div>
                </div>
            </div>

            <!-- Queue Info -->
            <div v-if="selectedServiceDetails.queueCount" class="mb-4 p-3 rounded-xl border-2" :class="selectedServiceDetails.queueStatus.class">
                <div class="text-xs font-bold mb-2">حالة الازدحام</div>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <div class="text-xs text-gray-600">عدد المنتظرين</div>
                        <div class="text-lg font-black">@{{ selectedServiceDetails.queueCount }}</div>
                    </div>
                    <div>
                        <div class="text-xs text-gray-600">مدة الانتظار</div>
                        <div class="text-lg font-black">@{{ selectedServiceDetails.waitTime }}</div>
                    </div>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="mb-4 p-3 bg-gray-50 rounded-xl">
                <div class="flex items-start gap-2 mb-2">
                    <span class="text-base">📍</span>
                    <p class="text-xs text-gray-700 leading-relaxed">@{{ selectedServiceDetails.address }}</p>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-base">📞</span>
                    <a :href="'tel:' + selectedServiceDetails.phone" class="text-xs font-bold text-blue-600">@{{ selectedServiceDetails.phone }}</a>
                </div>
                <div class="flex items-center gap-2 mt-2">
                    <span class="text-base">🕐</span>
                    <span class="text-xs text-gray-700 font-semibold">@{{ selectedServiceDetails.workingHours }}</span>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="grid grid-cols-2 gap-2">
                <a :href="'tel:' + selectedServiceDetails.phone" 
                   class="flex items-center justify-center gap-2 px-4 py-3 rounded-xl bg-gradient-to-r from-green-500 to-green-600 text-white font-bold text-sm shadow-lg active:scale-95 transition-all"
                   @click.stop>
                    <span class="text-lg">📞</span>
                    <span>اتصال</span>
                </a>
                <button @click="startNavigationTo(selectedServiceDetails)"
                        class="flex items-center justify-center gap-2 px-4 py-3 rounded-xl bg-gradient-to-r from-blue-500 to-blue-600 text-white font-bold text-sm shadow-lg active:scale-95 transition-all">
                    <span class="text-lg">🧭</span>
                    <span>اتجاهات</span>
                </button>
            </div>
        </div>
    </div>
</transition>
