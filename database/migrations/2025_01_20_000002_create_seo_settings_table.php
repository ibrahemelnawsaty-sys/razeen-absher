<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seo_settings', function (Blueprint $table) {
            $table->id();
            
            // Basic SEO
            $table->string('site_title')->nullable();
            $table->string('site_tagline')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            
            // Images
            $table->string('logo')->nullable();
            $table->string('logo_dark')->nullable();
            $table->string('favicon')->nullable();
            $table->string('og_image')->nullable(); // Open Graph Image
            
            // Social Media
            $table->string('twitter_handle')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('youtube_url')->nullable();
            
            // Google Integration
            $table->string('google_analytics_id')->nullable();
            $table->string('google_tag_manager_id')->nullable();
            $table->text('google_site_verification')->nullable();
            $table->text('google_search_console_code')->nullable();
            
            // Advanced SEO
            $table->text('robots_txt')->nullable();
            $table->text('custom_head_scripts')->nullable();
            $table->text('custom_body_scripts')->nullable();
            $table->text('structured_data')->nullable(); // JSON-LD
            
            // Sitemap
            $table->boolean('sitemap_enabled')->default(true);
            $table->string('sitemap_frequency')->default('weekly');
            $table->decimal('sitemap_priority', 2, 1)->default(0.8);
            
            // Indexing
            $table->boolean('indexing_enabled')->default(true);
            $table->boolean('follow_links')->default(true);
            
            // Contact Info (for structured data)
            $table->string('business_name')->nullable();
            $table->string('business_email')->nullable();
            $table->string('business_phone')->nullable();
            $table->text('business_address')->nullable();
            $table->string('business_city')->nullable();
            $table->string('business_country')->default('Saudi Arabia');
            
            $table->timestamps();
        });
        
        // Page-specific SEO
        Schema::create('page_seo', function (Blueprint $table) {
            $table->id();
            $table->string('page_slug')->unique();
            $table->string('page_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->string('og_title')->nullable();
            $table->text('og_description')->nullable();
            $table->string('og_image')->nullable();
            $table->string('canonical_url')->nullable();
            $table->boolean('no_index')->default(false);
            $table->boolean('no_follow')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_seo');
        Schema::dropIfExists('seo_settings');
    }
};
