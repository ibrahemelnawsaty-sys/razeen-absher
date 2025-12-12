<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\EntityController;
use App\Http\Controllers\Auth\TwoFactorController;
use App\Http\Controllers\Admin\SeoController;

// Public Routes
Route::get('/', function () {
    return view('welcome');
})->name('landing');

Route::get('/privacy-policy', function () {
    return view('legal.privacy-policy');
})->name('privacy-policy');

Route::get('/terms-conditions', function () {
    return view('legal.terms-conditions');
})->name('terms-conditions');

// Authentication Routes
Auth::routes();

// Quick Login for Development (⚠️ disable in production)
if (config('app.env') !== 'production') {
    Route::post('/login/quick', [App\Http\Controllers\Auth\LoginController::class, 'quickLogin'])->name('login.quick');
}

// Two Factor Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/two-factor', [TwoFactorController::class, 'show'])->name('2fa.show');
    Route::post('/two-factor/verify', [TwoFactorController::class, 'verify'])->name('2fa.verify');
    Route::post('/two-factor/resend', [TwoFactorController::class, 'resend'])->name('2fa.resend');
});

// Toggle 2FA (authenticated users)
Route::middleware('auth')->group(function () {
    Route::post('/two-factor/toggle', [TwoFactorController::class, 'toggle'])->name('2fa.toggle');
});

// Protected Routes - تحتاج تسجيل دخول
Route::middleware(['auth'])->group(function () {
    
    // Dashboard - يوجه حسب الدور
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/home', [DashboardController::class, 'index'])->name('home');
    
    // الخريطة
    Route::get('/map', [MapController::class, 'index'])->name('map.index');
    
    // Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password.update');
    
    // Reports - للجهات الحكومية والمستثمرين
    Route::get('/reports', function () {
        return view('reports.index');
    })->name('reports.index');
    
    // Add Report - للجهات الحكومية
    Route::middleware(['role:government,admin,super_admin'])->group(function () {
        Route::get('/reports/create', function () {
            return view('reports.create');
        })->name('reports.create');
    });
    
    // Area Analysis - للمستثمرين
    Route::middleware(['role:investor,admin,super_admin'])->group(function () {
        Route::get('/analysis/areas', function () {
            return view('analysis.areas');
        })->name('analysis.areas');
        Route::get('/analysis/heatmap', function () {
            return view('analysis.heatmap');
        })->name('analysis.heatmap');
    });
    
    // Centers Management - للجهات الحكومية
    Route::middleware(['role:government,admin,super_admin'])->group(function () {
        Route::get('/centers', function () {
            return view('centers.index');
        })->name('centers.index');
        Route::get('/centers/{id}', function ($id) {
            return view('centers.show', compact('id'));
        })->name('centers.show');
    });
    
    // Government Routes - للجهات الحكومية
    Route::middleware(['role:government,admin,super_admin'])->prefix('government')->name('government.')->group(function () {
        
        // إدارة البلاغات
        Route::get('/reports', function () {
            return view('government.reports-management');
        })->name('reports');
        
        // المراكز التابعة
        Route::get('/centers', function () {
            return view('government.centers-management');
        })->name('centers');
        
        // التقارير التحليلية
        Route::get('/analytics', function () {
            $stats = [
                'total_reports' => 127,
                'pending_reports' => 38,
                'completed_reports' => 89,
                'avg_response_time' => '12 دقيقة',
                'active_teams' => 8,
                'satisfaction_rate' => 94
            ];
            return view('government.analytics', compact('stats'));
        })->name('analytics');
    });
    
    // User Management - للأدمن والسوبر أدمن
    Route::middleware(['role:admin,super_admin'])->prefix('admin')->name('admin.')->group(function () {
        
        // Users
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        
        // Entities
        Route::get('/entities', [EntityController::class, 'index'])->name('entities.index');
        Route::get('/entities/create', [EntityController::class, 'create'])->name('entities.create');
        Route::post('/entities', [EntityController::class, 'store'])->name('entities.store');
        Route::delete('/entities/{id}', [EntityController::class, 'destroy'])->name('entities.destroy');
        
        // Reports
        Route::get('/reports-management', function () {
            return view('admin.reports.index');
        })->name('reports.management');
        
        Route::get('/reports/advanced', function () {
            return view('admin.reports.advanced');
        })->name('reports.advanced');
        
        // SEO Management
        Route::get('/seo', [SeoController::class, 'index'])->name('seo.index');
        Route::put('/seo/general', [SeoController::class, 'updateGeneral'])->name('seo.update.general');
        Route::put('/seo/images', [SeoController::class, 'updateImages'])->name('seo.update.images');
        Route::put('/seo/social', [SeoController::class, 'updateSocial'])->name('seo.update.social');
        Route::put('/seo/google', [SeoController::class, 'updateGoogle'])->name('seo.update.google');
        Route::put('/seo/advanced', [SeoController::class, 'updateAdvanced'])->name('seo.update.advanced');
        Route::post('/seo/pages', [SeoController::class, 'storePage'])->name('seo.pages.store');
        Route::delete('/seo/pages/{id}', [SeoController::class, 'destroyPage'])->name('seo.pages.destroy');
    });
    
    // Super Admin Routes
    Route::middleware(['role:super_admin'])->prefix('super-admin')->group(function () {
        Route::get('/system', function () {
            return view('super-admin.system');
        })->name('super-admin.system');
        
        Route::get('/logs', function () {
            return view('super-admin.logs');
        })->name('super-admin.logs');
    });
    
    // User Routes
    Route::middleware(['role:user,admin,super_admin'])->prefix('user')->name('user.')->group(function () {
        Route::get('/emergency-services', function () {
            return view('user.emergency-services');
        })->name('emergency-services');
        
        Route::get('/government-centers', function () {
            return view('user.government-centers');
        })->name('government-centers');
        
        Route::get('/neighborhood-info', function () {
            return view('user.neighborhood-info');
        })->name('neighborhood-info');
        
        Route::get('/my-properties', function () {
            return view('user.my-properties');
        })->name('my-properties');
        
        Route::get('/road-quality', function () {
            return view('user.road-quality');
        })->name('road-quality');
    });
    
    // Investor Routes - للمستثمرين
    Route::middleware(['role:investor,admin,super_admin'])->prefix('investor')->name('investor.')->group(function () {
        
        // تحليل المناطق
        Route::get('/area-analysis', function () {
            $areas = [
                ['name' => 'حي الياسمين', 'score' => 95, 'services' => 95, 'infrastructure' => 92, 'safety' => 98, 'projects' => 88],
                ['name' => 'حي النرجس', 'score' => 88, 'services' => 88, 'infrastructure' => 85, 'safety' => 90, 'projects' => 82],
                ['name' => 'حي الورود', 'score' => 82, 'services' => 85, 'infrastructure' => 80, 'safety' => 88, 'projects' => 75],
                ['name' => 'حي النخيل', 'score' => 78, 'services' => 80, 'infrastructure' => 75, 'safety' => 85, 'projects' => 70]
            ];
            return view('investor.area-analysis', compact('areas'));
        })->name('area-analysis');
        
        // خريطة المخاطر
        Route::get('/risk-map', function () {
            return view('investor.risk-map');
        })->name('risk-map');
        
        // تقارير الاستثمار
        Route::get('/investment-reports', function () {
            $reports = [
                ['title' => 'تقرير Q1 2024', 'date' => '2024-03-31', 'roi' => '18%'],
                ['title' => 'تقرير Q2 2024', 'date' => '2024-06-30', 'roi' => '22%']
            ];
            return view('investor.investment-reports', compact('reports'));
        })->name('investment-reports');
    });
});

// API-like endpoint (web) لإرجاع إعدادات الخرائط من config/maps.php
Route::get('/maps/config', function () {
    return response()->json([
        'defaults' => config('maps.defaults'),
        'frontend' => config('maps.frontend'),
        'provider' => config('maps.provider'),
    ]);
});

Route::post('/export/excel', [ReportController::class, 'exportExcel'])->name('export.excel');
Route::post('/export/pdf', [ReportController::class, 'exportPdf'])->name('export.pdf');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Public SEO Routes
Route::get('/sitemap.xml', [SeoController::class, 'generateSitemap']);
Route::get('/robots.txt', [SeoController::class, 'robotsTxt']);

// Storage fallback route (for hosts where symlink fails)
Route::get('/storage/{path}', function ($path) {
    $filePath = storage_path('app/public/' . $path);
    
    if (!file_exists($filePath)) {
        abort(404);
    }
    
    return response()->file($filePath);
})->where('path', '.*')->name('storage.serve');

// ⚠️ Route مؤقت لإصلاح الأدوار - احذفه بعد الاستخدام
Route::get('/fix-roles-temp-123', function () {
    $results = [];
    
    // إنشاء الأدوار
    $roles = ['super_admin', 'admin', 'government', 'investor', 'user'];
    foreach ($roles as $roleName) {
        \Spatie\Permission\Models\Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);
        $results[] = "✅ Role created/exists: {$roleName}";
    }
    
    // قائمة المستخدمين وأدوارهم
    $users = [
        'superadmin@aabsher.tech' => 'super_admin',
        'admin@aabsher.tech' => 'admin',
        'government@aabsher.tech' => 'government',
        'investor@aabsher.tech' => 'investor',
        'user@aabsher.tech' => 'user',
    ];
    
    foreach ($users as $email => $role) {
        $user = \App\Models\User::where('email', $email)->first();
        if ($user) {
            $user->syncRoles([$role]);
            $currentRoles = $user->getRoleNames()->implode(', ');
            $results[] = "✅ {$email} => {$currentRoles}";
        } else {
            $results[] = "❌ User not found: {$email}";
        }
    }
    
    // مسح كاش الصلاحيات
    app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    $results[] = "✅ Permission cache cleared";
    
    return '<pre style="direction:ltr; font-family:monospace; padding:20px; background:#1a1a2e; color:#0f0; font-size:14px;">' . implode("\n", $results) . '</pre>';
});

// ⚠️ Route مؤقت لتشغيل Migrations - احذفه بعد الاستخدام
Route::get('/run-migrations-temp-456', function () {
    try {
        \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
        $output = \Illuminate\Support\Facades\Artisan::output();
        return '<pre style="direction:ltr; font-family:monospace; padding:20px; background:#1a1a2e; color:#0f0; font-size:14px;">✅ Migrations executed successfully!<br><br>' . nl2br($output) . '</pre>';
    } catch (\Exception $e) {
        return '<pre style="direction:ltr; font-family:monospace; padding:20px; background:#1a1a2e; color:#f00; font-size:14px;">❌ Error: ' . $e->getMessage() . '</pre>';
    }
});

// Route مؤقت لمسح الكاش
Route::get('/clear-cache-temp-789', function () {
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    \Illuminate\Support\Facades\Artisan::call('config:clear');
    \Illuminate\Support\Facades\Artisan::call('view:clear');
    return '<pre style="padding:20px; background:#1a1a2e; color:#0f0;">✅ Cache cleared!</pre>';
});

// Route للتشخيص - احذفه بعد حل المشكلة
Route::get('/debug-seo', function () {
    $seo = \App\Models\SeoSetting::first();
    
    if (!$seo) {
        return response()->json([
            'status' => 'error',
            'message' => 'No SEO record found',
            'table_exists' => \Schema::hasTable('seo_settings'),
            'count' => \App\Models\SeoSetting::count(),
        ]);
    }
    
    return response()->json([
        'status' => 'success',
        'data' => $seo->toArray(),
    ]);
});

// ⚠️ Route للتشخيص - احذفه بعد حل المشكلة
Route::get('/test-csrf', function () {
    return response()->json([
        'csrf_token' => csrf_token(),
        'session_id' => session()->getId(),
        'session_driver' => config('session.driver'),
        'session_table_exists' => \Schema::hasTable('sessions'),
    ]);
});
