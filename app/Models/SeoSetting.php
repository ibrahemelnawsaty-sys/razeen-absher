<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class SeoSetting extends Model
{
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
        'sitemap_priority' => 'decimal:1',
    ];

    /**
     * Get cached SEO settings
     */
    public static function getCached(): ?self
    {
        return Cache::remember('seo_settings', 3600, function () {
            return self::first();
        });
    }

    /**
     * Clear cache when settings are updated
     */
    public static function clearCache(): void
    {
        Cache::forget('seo_settings');
    }

    /**
     * Get logo URL
     */
    public function getLogoUrlAttribute(): ?string
    {
        return $this->logo ? Storage::url($this->logo) : null;
    }

    /**
     * Get dark logo URL
     */
    public function getLogoDarkUrlAttribute(): ?string
    {
        return $this->logo_dark ? Storage::url($this->logo_dark) : null;
    }

    /**
     * Get favicon URL
     */
    public function getFaviconUrlAttribute(): ?string
    {
        return $this->favicon ? Storage::url($this->favicon) : null;
    }

    /**
     * Get OG image URL
     */
    public function getOgImageUrlAttribute(): ?string
    {
        return $this->og_image ? Storage::url($this->og_image) : null;
    }

    /**
     * Generate robots meta tag
     */
    public function getRobotsMetaAttribute(): string
    {
        $parts = [];
        $parts[] = $this->indexing_enabled ? 'index' : 'noindex';
        $parts[] = $this->follow_links ? 'follow' : 'nofollow';
        return implode(', ', $parts);
    }

    /**
     * Generate structured data JSON-LD
     */
    public function getStructuredDataJsonAttribute(): string
    {
        $data = [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => $this->business_name ?? $this->site_title,
            'url' => config('app.url'),
            'logo' => $this->logo_url,
            'description' => $this->meta_description,
            'address' => [
                '@type' => 'PostalAddress',
                'addressLocality' => $this->business_city,
                'addressCountry' => $this->business_country,
                'streetAddress' => $this->business_address,
            ],
            'contactPoint' => [
                '@type' => 'ContactPoint',
                'telephone' => $this->business_phone,
                'email' => $this->business_email,
                'contactType' => 'customer service',
            ],
            'sameAs' => array_filter([
                $this->facebook_url,
                $this->twitter_handle ? "https://twitter.com/{$this->twitter_handle}" : null,
                $this->instagram_url,
                $this->linkedin_url,
                $this->youtube_url,
            ]),
        ];

        // Merge with custom structured data if exists
        if ($this->structured_data) {
            $custom = json_decode($this->structured_data, true);
            if (is_array($custom)) {
                $data = array_merge($data, $custom);
            }
        }

        return json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }
}
