<div class="fixed top-14 md:top-20 left-2 md:left-4 right-2 md:right-auto space-y-2 md:space-y-3 notifications-container" style="z-index: 9999 !important; max-width: calc(100vw - 1rem); width: auto;">
    <transition-group name="fade">
        <div 
            v-for="notification in notifications" 
            :key="notification.id"
            class="notification glass-effect rounded-xl md:rounded-2xl p-3 md:p-4 shadow-2xl border-2 border-white/30 max-w-full md:max-w-md"
            :class="notification.class"
        >
            <div class="flex items-start gap-2 md:gap-3">
                <div class="text-2xl md:text-3xl shrink-0">@{{ notification.icon }}</div>
                <div class="flex-1 min-w-0">
                    <h4 class="font-black text-xs md:text-sm mb-0.5 md:mb-1 truncate">@{{ notification.title }}</h4>
                    <p class="text-[10px] md:text-xs opacity-90 line-clamp-2">@{{ notification.message }}</p>
                </div>
                <button @click="removeNotification(notification.id)" class="text-xl md:text-2xl opacity-50 hover:opacity-100 active:opacity-100 transition-opacity shrink-0">×</button>
            </div>
        </div>
    </transition-group>
</div>
