@extends('layouts.app')

@section('content')
<div class="flex h-screen bg-gray-100">
    
    @include('admin.partials.sidebar')
    
    <main class="flex-1 overflow-y-auto">
        
        <header class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-10">
            <div class="px-8 py-4">
                <h2 class="text-2xl font-black text-gray-800">🔍 إعدادات SEO</h2>
                <p class="text-sm text-gray-600">تحسين ظهور الموقع في محركات البحث</p>
            </div>
        </header>
        
        <div class="p-8">
            
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-green-700">
                    ✅ {{ session('success') }}
                </div>
            @endif
            
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-red-700">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <div x-data="{ activeTab: 'general' }" class="space-y-6">
                
                <!-- Tab Navigation -->
                <div class="bg-white rounded-2xl p-2 shadow-lg flex flex-wrap gap-2">
                    <button @click="activeTab = 'general'" 
                            :class="activeTab === 'general' ? 'bg-indigo-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                            class="px-6 py-3 rounded-xl font-bold transition-all flex items-center gap-2">
                        <span class="text-xl">⚙️</span>
                        <span>الأساسية</span>
                    </button>
                    
                    <button @click="activeTab = 'images'" 
                            :class="activeTab === 'images' ? 'bg-indigo-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                            class="px-6 py-3 rounded-xl font-bold transition-all flex items-center gap-2">
                        <span class="text-xl">🖼️</span>
                        <span>الصور</span>
                    </button>
                    
                    <button @click="activeTab = 'social'" 
                            :class="activeTab === 'social' ? 'bg-indigo-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                            class="px-6 py-3 rounded-xl font-bold transition-all flex items-center gap-2">
                        <span class="text-xl">📱</span>
                        <span>السوشيال</span>
                    </button>
                    
                    <button @click="activeTab = 'google'" 
                            :class="activeTab === 'google' ? 'bg-indigo-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                            class="px-6 py-3 rounded-xl font-bold transition-all flex items-center gap-2">
                        <span class="text-xl">🔗</span>
                        <span>Google</span>
                    </button>
                    
                    <button @click="activeTab = 'advanced'" 
                            :class="activeTab === 'advanced' ? 'bg-indigo-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                            class="px-6 py-3 rounded-xl font-bold transition-all flex items-center gap-2">
                        <span class="text-xl">🛠️</span>
                        <span>متقدم</span>
                    </button>
                </div>
                
                <!-- General Tab -->
                <div x-show="activeTab === 'general'" x-cloak class="bg-white rounded-2xl p-6 shadow-lg">
                    <h3 class="text-xl font-black text-gray-800 mb-6">⚙️ الإعدادات الأساسية</h3>
                    
                    <form action="{{ route('admin.seo.update.general') }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">عنوان الموقع (70 حرف)</label>
                                <input type="text" name="site_title" value="{{ old('site_title', $seo->site_title) }}" maxlength="70"
                                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500" placeholder="رزين - الخدمات الذكية">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">الشعار النصي</label>
                                <input type="text" name="site_tagline" value="{{ old('site_tagline', $seo->site_tagline) }}"
                                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500">
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">وصف الموقع (160 حرف) - مهم جداً!</label>
                            <textarea name="meta_description" rows="3" maxlength="160"
                                      class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500"
                                      placeholder="وصف مختصر يظهر في نتائج البحث">{{ old('meta_description', $seo->meta_description) }}</textarea>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">الكلمات المفتاحية (مفصولة بفواصل)</label>
                            <textarea name="meta_keywords" rows="2"
                                      class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500"
                                      placeholder="خدمات، رزين، السعودية">{{ old('meta_keywords', $seo->meta_keywords) }}</textarea>
                        </div>
                        
                        <hr class="my-6">
                        <h4 class="text-lg font-bold text-gray-800 mb-4">🏢 معلومات النشاط</h4>
                        
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
                            <label class="block text-sm font-bold text-gray-700 mb-2">العنوان</label>
                            <textarea name="business_address" rows="2"
                                      class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500">{{ old('business_address', $seo->business_address) }}</textarea>
                        </div>
                        
                        <button type="submit" class="w-full py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold rounded-xl hover:from-indigo-700 hover:to-purple-700 transition-all">
                            💾 حفظ الإعدادات الأساسية
                        </button>
                    </form>
                </div>
                
                <!-- Images Tab -->
                <div x-show="activeTab === 'images'" x-cloak class="bg-white rounded-2xl p-6 shadow-lg">
                    <h3 class="text-xl font-black text-gray-800 mb-6">🖼️ الصور والشعارات</h3>
                    
                    <form action="{{ route('admin.seo.update.images') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="p-6 bg-gray-50 rounded-xl border-2 border-dashed border-gray-300">
                                <label class="block text-sm font-bold text-gray-700 mb-3">🎨 الشعار</label>
                                @if($seo->logo)
                                    <img src="{{ asset('storage/' . $seo->logo) }}" alt="Logo" class="max-h-16 mb-4">
                                @endif
                                <input type="file" name="logo" accept="image/*" class="w-full">
                            </div>
                            
                            <div class="p-6 bg-gray-800 rounded-xl border-2 border-dashed border-gray-600">
                                <label class="block text-sm font-bold text-white mb-3">🌙 الشعار (داكن)</label>
                                @if($seo->logo_dark)
                                    <img src="{{ asset('storage/' . $seo->logo_dark) }}" alt="Dark Logo" class="max-h-16 mb-4">
                                @endif
                                <input type="file" name="logo_dark" accept="image/*" class="w-full text-white">
                            </div>
                            
                            <div class="p-6 bg-gray-50 rounded-xl border-2 border-dashed border-gray-300">
                                <label class="block text-sm font-bold text-gray-700 mb-3">⭐ Favicon</label>
                                @if($seo->favicon)
                                    <img src="{{ asset('storage/' . $seo->favicon) }}" alt="Favicon" class="w-8 h-8 mb-4">
                                @endif
                                <input type="file" name="favicon" accept=".ico,.png" class="w-full">
                            </div>
                            
                            <div class="p-6 bg-blue-50 rounded-xl border-2 border-dashed border-blue-300">
                                <label class="block text-sm font-bold text-gray-700 mb-3">📸 صورة المشاركة (1200x630)</label>
                                @if($seo->og_image)
                                    <img src="{{ asset('storage/' . $seo->og_image) }}" alt="OG Image" class="max-h-24 mb-4 rounded">
                                @endif
                                <input type="file" name="og_image" accept="image/*" class="w-full">
                            </div>
                        </div>
                        
                        <button type="submit" class="w-full py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold rounded-xl">
                            💾 حفظ الصور
                        </button>
                    </form>
                </div>
                
                <!-- Social Tab -->
                <div x-show="activeTab === 'social'" x-cloak class="bg-white rounded-2xl p-6 shadow-lg">
                    <h3 class="text-xl font-black text-gray-800 mb-6">📱 السوشيال ميديا</h3>
                    
                    <form action="{{ route('admin.seo.update.social') }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">𝕏 Twitter Handle</label>
                                <div class="flex">
                                    <span class="px-4 py-3 bg-gray-100 border-2 border-r-0 border-gray-200 rounded-r-xl">@</span>
                                    <input type="text" name="twitter_handle" value="{{ old('twitter_handle', $seo->twitter_handle) }}"
                                           class="flex-1 px-4 py-3 border-2 border-gray-200 rounded-l-xl focus:border-indigo-500">
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">📘 Facebook</label>
                                <input type="url" name="facebook_url" value="{{ old('facebook_url', $seo->facebook_url) }}"
                                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500" placeholder="https://facebook.com/...">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">📷 Instagram</label>
                                <input type="url" name="instagram_url" value="{{ old('instagram_url', $seo->instagram_url) }}"
                                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">💼 LinkedIn</label>
                                <input type="url" name="linkedin_url" value="{{ old('linkedin_url', $seo->linkedin_url) }}"
                                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500">
                            </div>
                            
                            <div class="md:col-span-2">
                                <label class="block text-sm font-bold text-gray-700 mb-2">▶️ YouTube</label>
                                <input type="url" name="youtube_url" value="{{ old('youtube_url', $seo->youtube_url) }}"
                                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500">
                            </div>
                        </div>
                        
                        <button type="submit" class="w-full py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold rounded-xl">
                            💾 حفظ السوشيال ميديا
                        </button>
                    </form>
                </div>
                
                <!-- Google Tab -->
                <div x-show="activeTab === 'google'" x-cloak class="bg-white rounded-2xl p-6 shadow-lg">
                    <h3 class="text-xl font-black text-gray-800 mb-6">🔗 ربط Google</h3>
                    
                    <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-xl">
                        <h4 class="font-bold text-blue-800 mb-2">📌 خطوات الربط:</h4>
                        <ol class="list-decimal list-inside text-sm text-blue-700 space-y-1">
                            <li>أنشئ حساب على <a href="https://search.google.com/search-console" target="_blank" class="underline">Google Search Console</a></li>
                            <li>أضف موقعك وتحقق من ملكيته</li>
                            <li>أنشئ حساب على <a href="https://analytics.google.com" target="_blank" class="underline">Google Analytics</a></li>
                            <li>أضف المعرفات هنا</li>
                        </ol>
                    </div>
                    
                    <form action="{{ route('admin.seo.update.google') }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">📊 Google Analytics ID</label>
                                <input type="text" name="google_analytics_id" value="{{ old('google_analytics_id', $seo->google_analytics_id) }}"
                                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500" placeholder="G-XXXXXXXXXX">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">🏷️ Google Tag Manager ID</label>
                                <input type="text" name="google_tag_manager_id" value="{{ old('google_tag_manager_id', $seo->google_tag_manager_id) }}"
                                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500" placeholder="GTM-XXXXXXX">
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">✅ كود التحقق من Search Console</label>
                            <input type="text" name="google_site_verification" value="{{ old('google_site_verification', $seo->google_site_verification) }}"
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500" placeholder="google-site-verification=...">
                        </div>
                        
                        <div class="p-4 bg-green-50 border border-green-200 rounded-xl">
                            <p class="text-sm text-green-700">
                                <strong>روابط مهمة:</strong><br>
                                Sitemap: <code class="bg-green-100 px-2 py-1 rounded">{{ url('/sitemap.xml') }}</code><br>
                                Robots: <code class="bg-green-100 px-2 py-1 rounded">{{ url('/robots.txt') }}</code>
                            </p>
                        </div>
                        
                        <button type="submit" class="w-full py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold rounded-xl">
                            💾 حفظ إعدادات Google
                        </button>
                    </form>
                </div>
                
                <!-- Advanced Tab -->
                <div x-show="activeTab === 'advanced'" x-cloak class="bg-white rounded-2xl p-6 shadow-lg">
                    <h3 class="text-xl font-black text-gray-800 mb-6">🛠️ إعدادات متقدمة</h3>
                    
                    <form action="{{ route('admin.seo.update.advanced') }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <div class="p-4 bg-gray-50 rounded-xl">
                            <h4 class="font-bold text-gray-800 mb-4">🤖 خيارات الفهرسة</h4>
                            <div class="grid md:grid-cols-3 gap-4">
                                <label class="flex items-center gap-3 p-3 bg-white rounded-lg border cursor-pointer">
                                    <input type="checkbox" name="indexing_enabled" value="1" {{ old('indexing_enabled', $seo->indexing_enabled ?? true) ? 'checked' : '' }} class="w-5 h-5">
                                    <span class="font-bold text-gray-700">السماح بالفهرسة</span>
                                </label>
                                
                                <label class="flex items-center gap-3 p-3 bg-white rounded-lg border cursor-pointer">
                                    <input type="checkbox" name="follow_links" value="1" {{ old('follow_links', $seo->follow_links ?? true) ? 'checked' : '' }} class="w-5 h-5">
                                    <span class="font-bold text-gray-700">تتبع الروابط</span>
                                </label>
                                
                                <label class="flex items-center gap-3 p-3 bg-white rounded-lg border cursor-pointer">
                                    <input type="checkbox" name="sitemap_enabled" value="1" {{ old('sitemap_enabled', $seo->sitemap_enabled ?? true) ? 'checked' : '' }} class="w-5 h-5">
                                    <span class="font-bold text-gray-700">تفعيل Sitemap</span>
                                </label>
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">🤖 محتوى robots.txt</label>
                            <textarea name="robots_txt" rows="6" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500 font-mono text-sm"
                                      placeholder="User-agent: *&#10;Allow: /">{{ old('robots_txt', $seo->robots_txt) }}</textarea>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">📜 أكواد في &lt;head&gt;</label>
                            <textarea name="custom_head_scripts" rows="4" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500 font-mono text-sm">{{ old('custom_head_scripts', $seo->custom_head_scripts) }}</textarea>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">📜 أكواد قبل &lt;/body&gt;</label>
                            <textarea name="custom_body_scripts" rows="4" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500 font-mono text-sm">{{ old('custom_body_scripts', $seo->custom_body_scripts) }}</textarea>
                        </div>
                        
                        <button type="submit" class="w-full py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold rounded-xl">
                            💾 حفظ الإعدادات المتقدمة
                        </button>
                    </form>
                </div>
                
            </div>
        </div>
    </main>
</div>

<style>[x-cloak] { display: none !important; }</style>
@endsection
