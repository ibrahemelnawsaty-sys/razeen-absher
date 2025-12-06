<h3 class="text-xl font-black text-gray-800 mb-6 flex items-center gap-2">
    <span class="text-2xl">🖼️</span>
    الصور والشعارات
</h3>

<form action="{{ route('admin.seo.update.images') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf
    @method('PUT')
    
    <div class="grid md:grid-cols-2 gap-6">
        <!-- Logo -->
        <div class="p-6 bg-gray-50 rounded-xl border-2 border-dashed border-gray-300 hover:border-indigo-400 transition-all">
            <label class="block text-sm font-bold text-gray-700 mb-3">🎨 الشعار (Logo)</label>
            @if($seo->logo)
                <div class="mb-4 p-4 bg-white rounded-lg">
                    <img src="{{ Storage::url($seo->logo) }}" alt="Logo" class="max-h-20 mx-auto">
                </div>
            @endif
            <input type="file" name="logo" accept="image/*" 
                   class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
            <p class="text-xs text-gray-500 mt-2">PNG, JPG, SVG - حد أقصى 2MB</p>
        </div>
        
        <!-- Dark Logo -->
        <div class="p-6 bg-gray-800 rounded-xl border-2 border-dashed border-gray-600 hover:border-indigo-400 transition-all">
            <label class="block text-sm font-bold text-white mb-3">🌙 الشعار (الوضع الداكن)</label>
            @if($seo->logo_dark)
                <div class="mb-4 p-4 bg-gray-900 rounded-lg">
                    <img src="{{ Storage::url($seo->logo_dark) }}" alt="Dark Logo" class="max-h-20 mx-auto">
                </div>
            @endif
            <input type="file" name="logo_dark" accept="image/*" 
                   class="w-full text-sm text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-900 file:text-indigo-200">
        </div>
        
        <!-- Favicon -->
        <div class="p-6 bg-gray-50 rounded-xl border-2 border-dashed border-gray-300 hover:border-indigo-400 transition-all">
            <label class="block text-sm font-bold text-gray-700 mb-3">⭐ الأيقونة (Favicon)</label>
            @if($seo->favicon)
                <div class="mb-4 p-4 bg-white rounded-lg">
                    <img src="{{ Storage::url($seo->favicon) }}" alt="Favicon" class="w-8 h-8 mx-auto">
                </div>
            @endif
            <input type="file" name="favicon" accept=".ico,.png" 
                   class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700">
            <p class="text-xs text-gray-500 mt-2">ICO, PNG - 32x32 أو 64x64</p>
        </div>
        
        <!-- OG Image -->
        <div class="p-6 bg-gradient-to-br from-blue-50 to-purple-50 rounded-xl border-2 border-dashed border-blue-300 hover:border-blue-400 transition-all">
            <label class="block text-sm font-bold text-gray-700 mb-3">📸 صورة المشاركة (OG Image)</label>
            @if($seo->og_image)
                <div class="mb-4 p-4 bg-white rounded-lg">
                    <img src="{{ Storage::url($seo->og_image) }}" alt="OG Image" class="max-h-32 mx-auto rounded">
                </div>
            @endif
            <input type="file" name="og_image" accept="image/*" 
                   class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700">
            <p class="text-xs text-gray-500 mt-2">تظهر عند مشاركة الموقع - 1200x630 مثالي</p>
        </div>
    </div>
    
    <button type="submit" class="w-full py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold rounded-xl hover:from-indigo-700 hover:to-purple-700 transition-all shadow-lg">
        💾 حفظ الصور
    </button>
</form>
