<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;

class SeoSetting extends Model
{
    protected $table = 'seo_settings';
    
    protected $fillable = [
        'site_title',
        'site_tagline',
        'meta_description',
        'meta_keywords',
        'logo',
        'logo_dark',
        'favicon',
        'og_image',
        'twitter_handle',
        'facebook_url',
        'instagram_url',
        'linkedin_url',
        'youtube_url',
        'google_analytics_id',
        'google_tag_manager_id',
        'google_site_verification',
        'google_search_console_code',
        'robots_txt',
        'custom_head_scripts',
        'custom_body_scripts',
        'structured_data',
        'sitemap_enabled',
        'sitemap_frequency',
        'sitemap_priority',
        'indexing_enabled',
        'follow_links',
        'business_name',
        'business_email',
        'business_phone',
        'business_address',
        'business_city',
        'business_country',
    ];

    protected $casts = [
        'sitemap_enabled' => 'boolean',
        'indexing_enabled' => 'boolean',
        'follow_links' => 'boolean',
    ];

    /**
     * Get cached SEO settings with fallback
     */
    public static function getCached(): ?self
    {
        try {
            if (!Schema::hasTable('seo_settings')) {
                return null;
            }
            
            return Cache::remember('seo_settings', 3600, function () {
                return self::first();
            });
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Clear cache when settings are updated
     */
    public static function clearCache(): void
    {
        Cache::forget('seo_settings');
    }

    /**
     * Boot method to clear cache on save
     */
    protected static function booted()
    {
        static::saved(function ($model) {
            self::clearCache();
        });
        
        static::deleted(function ($model) {
            self::clearCache();
        });
    }

    /**
     * Get robots meta tag
     */
    public function getRobotsMetaAttribute(): string
    {
        $parts = [];
        $parts[] = ($this->indexing_enabled ?? true) ? 'index' : 'noindex';
        $parts[] = ($this->follow_links ?? true) ? 'follow' : 'nofollow';
        return implode(', ', $parts);
    }

    /**
     * Get logo URL
     */
    public function getLogoUrlAttribute(): ?string
    {
        return $this->logo ? asset('storage/' . $this->logo) : null;
    }

    /**
     * Get favicon URL
     */
    public function getFaviconUrlAttribute(): ?string
    {
        return $this->favicon ? asset('storage/' . $this->favicon) : null;
    }

    /**
     * Get OG image URL
     */
    public function getOgImageUrlAttribute(): ?string
    {
        return $this->og_image ? asset('storage/' . $this->og_image) : null;
    }
}
