<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class PageSeo extends Model
{
    protected $table = 'page_seo';

    protected $fillable = [
        'page_slug',
        'page_title',
        'meta_description',
        'meta_keywords',
        'og_title',
        'og_description',
        'og_image',
        'canonical_url',
        'no_index',
        'no_follow',
    ];

    protected $casts = [
        'no_index' => 'boolean',
        'no_follow' => 'boolean',
    ];

    /**
     * Get SEO settings for a specific page
     */
    public static function getForPage(string $slug): ?self
    {
        return Cache::remember("page_seo_{$slug}", 3600, function () use ($slug) {
            return self::where('page_slug', $slug)->first();
        });
    }

    /**
     * Clear cache
     */
    public static function clearCache(string $slug = null): void
    {
        if ($slug) {
            Cache::forget("page_seo_{$slug}");
        }
    }

    /**
     * Get robots meta
     */
    public function getRobotsMetaAttribute(): string
    {
        $parts = [];
        $parts[] = $this->no_index ? 'noindex' : 'index';
        $parts[] = $this->no_follow ? 'nofollow' : 'follow';
        return implode(', ', $parts);
    }
}
