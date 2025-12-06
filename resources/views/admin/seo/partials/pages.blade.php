<!-- Add New Page SEO -->
<div class="bg-white rounded-2xl p-6 shadow-lg">
    <h3 class="text-xl font-black text-gray-800 mb-6 flex items-center gap-2">
        <span class="text-2xl">➕</span>
        إضافة SEO لصفحة
    </h3>
    
    <form action="{{ route('admin.seo.pages.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        
        <div class="grid md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">مسار الصفحة (Slug)</label>
                <input type="text" name="page_slug" required
                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500"
                       placeholder="about, contact, services">
            </div>
            
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">عنوان الصفحة</label>
                <input type="text" name="page_title" maxlength="70"
                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500">
            </div>
            
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Canonical URL</label>
                <input type="url" name="canonical_url"
                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500">
            </div>
        </div>
        
        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Meta Description</label>
                <textarea name="meta_description" rows="2" maxlength="160"
                          class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500"></textarea>
            </div>
            
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Meta Keywords</label>
                <textarea name="meta_keywords" rows="2"
                          class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500"></textarea>
            </div>
        </div>
        
        <div class="flex items-center gap-6">
            <label class="flex items-center gap-2">
                <input type="checkbox" name="no_index" value="1" class="w-5 h-5 text-red-600 rounded">
                <span class="font-bold text-gray-700">noindex</span>
            </label>
            
            <label class="flex items-center gap-2">
                <input type="checkbox" name="no_follow" value="1" class="w-5 h-5 text-red-600 rounded">
                <span class="font-bold text-gray-700">nofollow</span>
            </label>
        </div>
        
        <button type="submit" class="px-6 py-3 bg-green-500 text-white font-bold rounded-xl hover:bg-green-600 transition-all">
            ➕ إضافة
        </button>
    </form>
</div>

<!-- Existing Pages -->
<div class="bg-white rounded-2xl p-6 shadow-lg">
    <h3 class="text-xl font-black text-gray-800 mb-6 flex items-center gap-2">
        <span class="text-2xl">📄</span>
        الصفحات المخصصة
    </h3>
    
    @if($pages->count() > 0)
        <div class="space-y-4">
            @foreach($pages as $page)
                <div class="p-4 bg-gray-50 rounded-xl border-2 border-gray-200 hover:border-indigo-300 transition-all">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-2">
                                <span class="px-3 py-1 bg-indigo-100 text-indigo-700 rounded-full text-sm font-bold">
                                    /{{ $page->page_slug }}
                                </span>
                                @if($page->no_index)
                                    <span class="px-2 py-1 bg-red-100 text-red-700 rounded text-xs font-bold">noindex</span>
                                @endif
                                @if($page->no_follow)
                                    <span class="px-2 py-1 bg-orange-100 text-orange-700 rounded text-xs font-bold">nofollow</span>
                                @endif
                            </div>
                            <p class="font-bold text-gray-800">{{ $page->page_title ?: '(بدون عنوان)' }}</p>
                            <p class="text-sm text-gray-600 mt-1">{{ Str::limit($page->meta_description, 100) ?: '(بدون وصف)' }}</p>
                        </div>
                        
                        <form action="{{ route('admin.seo.pages.destroy', $page->id) }}" method="POST" 
                              onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg text-sm font-bold hover:bg-red-600">
                                🗑️ حذف
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="mt-6">
            {{ $pages->links() }}
        </div>
    @else
        <div class="text-center py-8 text-gray-500">
            <span class="text-4xl">📄</span>
            <p class="mt-2">لا توجد صفحات مخصصة بعد</p>
        </div>
    @endif
</div>
