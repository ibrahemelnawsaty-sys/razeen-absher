<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeoSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SeoController extends Controller
{
    /**
     * عرض صفحة إعدادات SEO الرئيسية
     */
    public function index()
    {
        $seo = SeoSetting::first() ?? new SeoSetting();
        $pages = collect([]); // PageSeo::orderBy('page_slug')->get();
        
        return view('admin.seo.index', compact('seo', 'pages'));
    }

    /**
     * تحديث الإعدادات الأساسية
     */
    public function updateGeneral(Request $request)
    {
        $validated = $request->validate([
            'site_title' => 'nullable|string|max:70',
            'site_tagline' => 'nullable|string|max:150',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords' => 'nullable|string|max:500',
            'business_name' => 'nullable|string|max:255',
            'business_email' => 'nullable|email|max:255',
            'business_phone' => 'nullable|string|max:50',
            'business_address' => 'nullable|string|max:500',
            'business_city' => 'nullable|string|max:100',
            'business_country' => 'nullable|string|max:100',
        ]);

        $seo = SeoSetting::firstOrCreate([]);
        $seo->update($validated);
        SeoSetting::clearCache(); // ✅ مسح الكاش

        return back()->with('success', 'تم تحديث الإعدادات الأساسية بنجاح');
    }

    /**
     * تحديث الصور والشعارات
     */
    public function updateImages(Request $request)
    {
        $request->validate([
            'logo' => 'nullable|image|mimes:png,jpg,jpeg,svg,webp|max:2048',
            'logo_dark' => 'nullable|image|mimes:png,jpg,jpeg,svg,webp|max:2048',
            'favicon' => 'nullable|mimes:ico,png|max:512',
            'og_image' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
        ]);

        $seo = SeoSetting::firstOrCreate([]);

        foreach (['logo', 'logo_dark', 'favicon', 'og_image'] as $field) {
            if ($request->hasFile($field)) {
                // Delete old file
                if ($seo->$field) {
                    Storage::disk('public')->delete($seo->$field);
                }
                
                $path = $request->file($field)->store('seo', 'public');
                $seo->$field = $path;
            }
        }

        $seo->save();
        SeoSetting::clearCache(); // ✅ مسح الكاش

        return back()->with('success', 'تم تحديث الصور بنجاح');
    }

    /**
     * تحديث روابط السوشيال ميديا
     */
    public function updateSocial(Request $request)
    {
        $validated = $request->validate([
            'twitter_handle' => 'nullable|string|max:100',
            'facebook_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'youtube_url' => 'nullable|url|max:255',
        ]);

        $seo = SeoSetting::firstOrCreate([]);
        $seo->update($validated);
        SeoSetting::clearCache(); // ✅ مسح الكاش

        return back()->with('success', 'تم تحديث روابط السوشيال ميديا بنجاح');
    }

    /**
     * تحديث إعدادات Google
     */
    public function updateGoogle(Request $request)
    {
        $validated = $request->validate([
            'google_analytics_id' => 'nullable|string|max:50',
            'google_tag_manager_id' => 'nullable|string|max:50',
            'google_site_verification' => 'nullable|string|max:255',
            'google_search_console_code' => 'nullable|string|max:1000',
        ]);

        $seo = SeoSetting::firstOrCreate([]);
        $seo->update($validated);
        SeoSetting::clearCache(); // ✅ مسح الكاش

        return back()->with('success', 'تم تحديث إعدادات Google بنجاح');
    }

    /**
     * تحديث الإعدادات المتقدمة
     */
    public function updateAdvanced(Request $request)
    {
        $validated = $request->validate([
            'robots_txt' => 'nullable|string|max:5000',
            'custom_head_scripts' => 'nullable|string|max:10000',
            'custom_body_scripts' => 'nullable|string|max:10000',
            'structured_data' => 'nullable|string|max:10000',
            'sitemap_enabled' => 'boolean',
            'sitemap_frequency' => 'nullable|in:always,hourly,daily,weekly,monthly,yearly,never',
            'sitemap_priority' => 'nullable|numeric|between:0,1',
            'indexing_enabled' => 'boolean',
            'follow_links' => 'boolean',
        ]);
        
        // تحويل checkboxes
        $validated['sitemap_enabled'] = $request->has('sitemap_enabled');
        $validated['indexing_enabled'] = $request->has('indexing_enabled');
        $validated['follow_links'] = $request->has('follow_links');

        $seo = SeoSetting::firstOrCreate([]);
        $seo->update($validated);
        SeoSetting::clearCache(); // ✅ مسح الكاش

        return back()->with('success', 'تم تحديث الإعدادات المتقدمة بنجاح');
    }

    /**
     * توليد sitemap.xml
     */
    public function generateSitemap()
    {
        $seo = SeoSetting::getCached();
        
        $urls = [
            ['loc' => url('/'), 'priority' => '1.0', 'changefreq' => 'daily'],
            ['loc' => url('/login'), 'priority' => '0.5', 'changefreq' => 'monthly'],
            ['loc' => url('/register'), 'priority' => '0.5', 'changefreq' => 'monthly'],
        ];

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        
        foreach ($urls as $url) {
            $xml .= '  <url>' . "\n";
            $xml .= '    <loc>' . htmlspecialchars($url['loc']) . '</loc>' . "\n";
            $xml .= '    <lastmod>' . now()->toW3cString() . '</lastmod>' . "\n";
            $xml .= '    <changefreq>' . $url['changefreq'] . '</changefreq>' . "\n";
            $xml .= '    <priority>' . $url['priority'] . '</priority>' . "\n";
            $xml .= '  </url>' . "\n";
        }
        
        $xml .= '</urlset>';

        return response($xml, 200, [
            'Content-Type' => 'application/xml'
        ]);
    }

    /**
     * توليد robots.txt
     */
    public function robotsTxt()
    {
        $seo = SeoSetting::getCached();
        $content = $seo->robots_txt ?? "User-agent: *\nAllow: /\n\nSitemap: " . url('/sitemap.xml');
        return response($content, 200, ['Content-Type' => 'text/plain']);
    }
    
    /**
     * إدارة SEO للصفحات
     */
    public function pages()
    {
        $pages = PageSeo::orderBy('page_slug')->paginate(20);
        return view('admin.seo.pages', compact('pages'));
    }

    /**
     * إضافة/تعديل SEO لصفحة
     */
    public function storePage(Request $request)
    {
        $validated = $request->validate([
            'page_slug' => 'required|string|max:255',
            'page_title' => 'nullable|string|max:70',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords' => 'nullable|string|max:500',
            'og_title' => 'nullable|string|max:70',
            'og_description' => 'nullable|string|max:200',
            'og_image' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
            'canonical_url' => 'nullable|url|max:500',
            'no_index' => 'boolean',
            'no_follow' => 'boolean',
        ]);

        $validated['page_slug'] = Str::slug($validated['page_slug']);

        $page = PageSeo::updateOrCreate(
            ['page_slug' => $validated['page_slug']],
            $validated
        );

        if ($request->hasFile('og_image')) {
            if ($page->og_image) {
                Storage::delete($page->og_image);
            }
            $page->og_image = $request->file('og_image')->store('seo/pages', 'public');
            $page->save();
        }

        PageSeo::clearCache($validated['page_slug']);

        return back()->with('success', 'تم حفظ إعدادات SEO للصفحة بنجاح');
    }

    /**
     * حذف SEO لصفحة
     */
    public function destroyPage($id)
    {
        $page = PageSeo::findOrFail($id);
        PageSeo::clearCache($page->page_slug);
        
        if ($page->og_image) {
            Storage::delete($page->og_image);
        }
        
        $page->delete();

        return back()->with('success', 'تم حذف إعدادات SEO للصفحة');
    }
}
