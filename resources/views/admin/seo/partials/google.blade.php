<h3 class="text-xl font-black text-gray-800 mb-6 flex items-center gap-2">
    <span class="text-2xl">🔗</span>
    ربط Google
</h3>

<div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-xl">
    <h4 class="font-bold text-blue-800 mb-2">📌 خطوات ربط موقعك مع Google:</h4>
    <ol class="list-decimal list-inside space-y-1 text-sm text-blue-700">
        <li>أنشئ حساب على <a href="https://search.google.com/search-console" target="_blank" class="underline">Google Search Console</a></li>
        <li>أضف موقعك وتحقق من ملكيته باستخدام كود التحقق</li>
        <li>أنشئ حساب على <a href="https://analytics.google.com" target="_blank" class="underline">Google Analytics</a></li>
        <li>أضف معرف GA و GTM هنا</li>
    </ol>
</div>

<form action="{{ route('admin.seo.update.google') }}" method="POST" class="space-y-6">
    @csrf
    @method('PUT')
    
    <div class="grid md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">📊 Google Analytics ID</label>
            <input type="text" name="google_analytics_id" value="{{ old('google_analytics_id', $seo->google_analytics_id) }}" 
                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500"
                   placeholder="G-XXXXXXXXXX">
            <p class="text-xs text-gray-500 mt-1">للتحليلات وتتبع الزوار</p>
        </div>
        
        <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">🏷️ Google Tag Manager ID</label>
            <input type="text" name="google_tag_manager_id" value="{{ old('google_tag_manager_id', $seo->google_tag_manager_id) }}" 
                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500"
                   placeholder="GTM-XXXXXXX">
        </div>
    </div>
    
    <div>
        <label class="block text-sm font-bold text-gray-700 mb-2">✅ كود التحقق من Search Console</label>
        <input type="text" name="google_site_verification" value="{{ old('google_site_verification', $seo->google_site_verification) }}" 
               class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500"
               placeholder="google-site-verification=XXXXXXXXXXXX">
    </div>
    
    <div>
        <label class="block text-sm font-bold text-gray-700 mb-2">🔍 كود Search Console HTML Tag</label>
        <textarea name="google_search_console_code" rows="3"
                  class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500 font-mono text-sm"
                  placeholder='<meta name="google-site-verification" content="..." />'>{{ old('google_search_console_code', $seo->google_search_console_code) }}</textarea>
    </div>
    
    <div class="p-4 bg-green-50 border border-green-200 rounded-xl">
        <h4 class="font-bold text-green-800 mb-2">✅ بعد الحفظ:</h4>
        <ul class="list-disc list-inside space-y-1 text-sm text-green-700">
            <li>سيتم إضافة كود التتبع تلقائياً في جميع الصفحات</li>
            <li>Sitemap: <code class="bg-green-100 px-2 py-1 rounded">{{ url('/sitemap.xml') }}</code></li>
            <li>Robots: <code class="bg-green-100 px-2 py-1 rounded">{{ url('/robots.txt') }}</code></li>
        </ul>
    </div>
    
    <button type="submit" class="w-full py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold rounded-xl hover:from-indigo-700 hover:to-purple-700 transition-all shadow-lg">
        💾 حفظ إعدادات Google
    </button>
</form>
