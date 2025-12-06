<h3 class="text-xl font-black text-gray-800 mb-6 flex items-center gap-2">
    <span class="text-2xl">🛠️</span>
    إعدادات متقدمة
</h3>

<form action="{{ route('admin.seo.update.advanced') }}" method="POST" class="space-y-6">
    @csrf
    @method('PUT')
    
    <!-- Indexing Options -->
    <div class="p-4 bg-gray-50 rounded-xl">
        <h4 class="font-bold text-gray-800 mb-4">🤖 خيارات الفهرسة</h4>
        <div class="grid md:grid-cols-3 gap-4">
            <label class="flex items-center gap-3 p-3 bg-white rounded-lg border cursor-pointer hover:border-indigo-300">
                <input type="checkbox" name="indexing_enabled" value="1" {{ old('indexing_enabled', $seo->indexing_enabled) ? 'checked' : '' }}
                       class="w-5 h-5 text-indigo-600 rounded">
                <div>
                    <span class="font-bold text-gray-800">السماح بالفهرسة</span>
                    <p class="text-xs text-gray-500">index</p>
                </div>
            </label>
            
            <label class="flex items-center gap-3 p-3 bg-white rounded-lg border cursor-pointer hover:border-indigo-300">
                <input type="checkbox" name="follow_links" value="1" {{ old('follow_links', $seo->follow_links) ? 'checked' : '' }}
                       class="w-5 h-5 text-indigo-600 rounded">
                <div>
                    <span class="font-bold text-gray-800">تتبع الروابط</span>
                    <p class="text-xs text-gray-500">follow</p>
                </div>
            </label>
            
            <label class="flex items-center gap-3 p-3 bg-white rounded-lg border cursor-pointer hover:border-indigo-300">
                <input type="checkbox" name="sitemap_enabled" value="1" {{ old('sitemap_enabled', $seo->sitemap_enabled) ? 'checked' : '' }}
                       class="w-5 h-5 text-indigo-600 rounded">
                <div>
                    <span class="font-bold text-gray-800">تفعيل Sitemap</span>
                    <p class="text-xs text-gray-500">sitemap.xml</p>
                </div>
            </label>
        </div>
    </div>
    
    <!-- Sitemap Settings -->
    <div class="grid md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">تكرار التحديث</label>
            <select name="sitemap_frequency" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500">
                @foreach(['always' => 'دائماً', 'hourly' => 'كل ساعة', 'daily' => 'يومياً', 'weekly' => 'أسبوعياً', 'monthly' => 'شهرياً', 'yearly' => 'سنوياً'] as $value => $label)
                    <option value="{{ $value }}" {{ old('sitemap_frequency', $seo->sitemap_frequency) == $value ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
        </div>
        
        <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">الأولوية (0-1)</label>
            <input type="number" name="sitemap_priority" value="{{ old('sitemap_priority', $seo->sitemap_priority ?? 0.8) }}" 
                   step="0.1" min="0" max="1"
                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500">
        </div>
    </div>
    
    <!-- Robots.txt -->
    <div>
        <label class="block text-sm font-bold text-gray-700 mb-2">
            🤖 محتوى robots.txt
            <a href="{{ url('/robots.txt') }}" target="_blank" class="text-indigo-600 text-xs font-normal">(معاينة)</a>
        </label>
        <textarea name="robots_txt" rows="6"
                  class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500 font-mono text-sm"
                  placeholder="User-agent: *&#10;Allow: /&#10;&#10;Sitemap: {{ url('/sitemap.xml') }}">{{ old('robots_txt', $seo->robots_txt) }}</textarea>
    </div>
    
    <!-- Custom Scripts -->
    <div>
        <label class="block text-sm font-bold text-gray-700 mb-2">📜 أكواد في &lt;head&gt;</label>
        <textarea name="custom_head_scripts" rows="4"
                  class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500 font-mono text-sm"
                  placeholder="<!-- Custom CSS, Fonts, Scripts -->">{{ old('custom_head_scripts', $seo->custom_head_scripts) }}</textarea>
    </div>
    
    <div>
        <label class="block text-sm font-bold text-gray-700 mb-2">📜 أكواد قبل &lt;/body&gt;</label>
        <textarea name="custom_body_scripts" rows="4"
                  class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500 font-mono text-sm"
                  placeholder="<!-- Chat widgets, Analytics -->">{{ old('custom_body_scripts', $seo->custom_body_scripts) }}</textarea>
    </div>
    
    <!-- Structured Data -->
    <div>
        <label class="block text-sm font-bold text-gray-700 mb-2">📊 البيانات المنظمة (JSON-LD)</label>
        <textarea name="structured_data" rows="6"
                  class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500 font-mono text-sm"
                  placeholder='{"@type": "WebApplication"}'>{{ old('structured_data', $seo->structured_data) }}</textarea>
    </div>
    
    <button type="submit" class="w-full py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold rounded-xl hover:from-indigo-700 hover:to-purple-700 transition-all shadow-lg">
        💾 حفظ الإعدادات المتقدمة
    </button>
</form>
