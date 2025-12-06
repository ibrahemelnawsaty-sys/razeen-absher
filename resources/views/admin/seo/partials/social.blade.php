<h3 class="text-xl font-black text-gray-800 mb-6 flex items-center gap-2">
    <span class="text-2xl">📱</span>
    روابط السوشيال ميديا
</h3>

<form action="{{ route('admin.seo.update.social') }}" method="POST" class="space-y-6">
    @csrf
    @method('PUT')
    
    <div class="grid md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">𝕏 Twitter/X Handle</label>
            <div class="flex">
                <span class="inline-flex items-center px-4 py-3 bg-gray-100 border-2 border-r-0 border-gray-200 rounded-r-xl text-gray-500">@</span>
                <input type="text" name="twitter_handle" value="{{ old('twitter_handle', $seo->twitter_handle) }}" 
                       class="flex-1 px-4 py-3 border-2 border-gray-200 rounded-l-xl focus:border-indigo-500">
            </div>
        </div>
        
        <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">📘 Facebook URL</label>
            <input type="url" name="facebook_url" value="{{ old('facebook_url', $seo->facebook_url) }}" 
                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500"
                   placeholder="https://facebook.com/...">
        </div>
        
        <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">📷 Instagram URL</label>
            <input type="url" name="instagram_url" value="{{ old('instagram_url', $seo->instagram_url) }}" 
                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500"
                   placeholder="https://instagram.com/...">
        </div>
        
        <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">💼 LinkedIn URL</label>
            <input type="url" name="linkedin_url" value="{{ old('linkedin_url', $seo->linkedin_url) }}" 
                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500"
                   placeholder="https://linkedin.com/company/...">
        </div>
        
        <div class="md:col-span-2">
            <label class="block text-sm font-bold text-gray-700 mb-2">▶️ YouTube URL</label>
            <input type="url" name="youtube_url" value="{{ old('youtube_url', $seo->youtube_url) }}" 
                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500"
                   placeholder="https://youtube.com/@...">
        </div>
    </div>
    
    <button type="submit" class="w-full py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold rounded-xl hover:from-indigo-700 hover:to-purple-700 transition-all shadow-lg">
        💾 حفظ روابط السوشيال ميديا
    </button>
</form>
