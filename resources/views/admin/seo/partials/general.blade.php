<h3 class="text-xl font-black text-gray-800 mb-6 flex items-center gap-2">
    <span class="text-2xl">⚙️</span>
    الإعدادات الأساسية
</h3>

<form action="{{ route('admin.seo.update.general') }}" method="POST" class="space-y-6">
    @csrf
    @method('PUT')
    
    <div class="grid md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">
                عنوان الموقع (Site Title)
                <span class="text-xs text-gray-500 font-normal">(أقصى 70 حرف)</span>
            </label>
            <input type="text" name="site_title" value="{{ old('site_title', $seo->site_title) }}" 
                   maxlength="70"
                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200"
                   placeholder="منصة رزين - الخدمات الذكية">
            <p class="text-xs text-gray-500 mt-1">يظهر في تاب المتصفح ونتائج البحث</p>
        </div>
        
        <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">
                الشعار النصي (Tagline)
            </label>
            <input type="text" name="site_tagline" value="{{ old('site_tagline', $seo->site_tagline) }}" 
                   maxlength="150"
                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500">
        </div>
    </div>
    
    <div>
        <label class="block text-sm font-bold text-gray-700 mb-2">
            وصف الموقع (Meta Description)
            <span class="text-xs text-gray-500 font-normal">(أقصى 160 حرف - مهم جداً)</span>
        </label>
        <textarea name="meta_description" rows="3" maxlength="160"
                  class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500"
                  placeholder="وصف مختصر للموقع...">{{ old('meta_description', $seo->meta_description) }}</textarea>
    </div>
    
    <div>
        <label class="block text-sm font-bold text-gray-700 mb-2">
            الكلمات المفتاحية (Meta Keywords)
        </label>
        <textarea name="meta_keywords" rows="2" maxlength="500"
                  class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500"
                  placeholder="كلمة1, كلمة2, كلمة3">{{ old('meta_keywords', $seo->meta_keywords) }}</textarea>
    </div>
    
    <hr class="my-6">
    
    <h4 class="text-lg font-bold text-gray-800 mb-4">🏢 معلومات النشاط التجاري</h4>
    
    <div class="grid md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">اسم النشاط</label>
            <input type="text" name="business_name" value="{{ old('business_name', $seo->business_name) }}" 
                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500">
        </div>
        
        <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">البريد الإلكتروني</label>
            <input type="email" name="business_email" value="{{ old('business_email', $seo->business_email) }}" 
                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500">
        </div>
        
        <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">رقم الهاتف</label>
            <input type="text" name="business_phone" value="{{ old('business_phone', $seo->business_phone) }}" 
                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500">
        </div>
        
        <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">المدينة</label>
            <input type="text" name="business_city" value="{{ old('business_city', $seo->business_city) }}" 
                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500">
        </div>
    </div>
    
    <div>
        <label class="block text-sm font-bold text-gray-700 mb-2">العنوان الكامل</label>
        <textarea name="business_address" rows="2"
                  class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500">{{ old('business_address', $seo->business_address) }}</textarea>
    </div>
    
    <button type="submit" class="w-full py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold rounded-xl hover:from-indigo-700 hover:to-purple-700 transition-all shadow-lg">
        💾 حفظ الإعدادات الأساسية
    </button>
</form>
