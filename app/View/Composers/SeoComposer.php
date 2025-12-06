<?php

namespace App\View\Composers;

use App\Models\SeoSetting;
use Illuminate\View\View;

class SeoComposer
{
    protected static $seo = null;
    protected static $loaded = false;

    public function compose(View $view): void
    {
        if (!self::$loaded) {
            try {
                self::$seo = SeoSetting::first();
            } catch (\Exception $e) {
                self::$seo = null;
            }
            self::$loaded = true;
        }

        $view->with('seo', self::$seo);
    }
}
