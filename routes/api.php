<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\IncidentController;
use App\Http\Controllers\Admin\IncidentAdminController;
use App\Http\Controllers\Maps\HeatmapController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\LayerController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\CityStatsController;
use App\Http\Controllers\Api\MapDataController;

Route::get('/maps/config', function () {
    return response()->json([
        'app' => config('maps.defaults'),
        'frontend' => config('maps.frontend'),
        'env' => [
            'app_name' => env('APP_NAME'),
            'build_env' => env('VITE_BUILD_ENV', env('APP_ENV')),
        ],
    ]);
});

// Auth routes (public)
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

// Protected logout (requires auth:sanctum)
Route::middleware(['auth:sanctum'])->post('/auth/logout', [AuthController::class, 'logout']);

// Incidents GeoJSON endpoints
Route::get('/incidents', [IncidentController::class, 'index']);
Route::get('/incidents/{uuid}', [IncidentController::class, 'show']);
Route::post('/incidents', [IncidentController::class, 'store']);

// Heatmap endpoint (public) - returns FeatureCollection of recent incidents
Route::get('/heatmap', [HeatmapController::class, 'index']);

// Admin API group (protected by sanctum) — requires authentication & roles later
Route::middleware(['auth:sanctum'])->prefix('admin')->group(function () {
    // CRUD for incidents (admin)
    Route::get('/incidents', [IncidentAdminController::class, 'index']);
    Route::post('/incidents', [IncidentAdminController::class, 'store']);
    Route::get('/incidents/{uuid}', [IncidentAdminController::class, 'show']);
    Route::put('/incidents/{uuid}', [IncidentAdminController::class, 'update']);
    Route::delete('/incidents/{uuid}', [IncidentAdminController::class, 'destroy']);
});

// Layers endpoints
Route::get('/layers/roads', [LayerController::class, 'roads']);
Route::get('/layers/traffic', [LayerController::class, 'traffic']);

// City detection & stats
Route::get('/city/detect', [CityStatsController::class, 'detectCity']);
Route::get('/city/{cityId}/stats', [CityStatsController::class, 'getStats']);

/*
|--------------------------------------------------------------------------
| Map Data API Routes
|--------------------------------------------------------------------------
*/

Route::prefix('map')->group(function () {
    Route::get('/emergency-services', [MapDataController::class, 'getEmergencyServices']);
    Route::get('/municipal-projects', [MapDataController::class, 'getMunicipalProjects']);
    Route::get('/roads', [MapDataController::class, 'getRoads']);
    
    // Search & Statistics
    Route::get('/search', [MapDataController::class, 'search']);
    Route::get('/statistics', [MapDataController::class, 'getStatistics']);
    
    // Real-time updates
    Route::get('/live-updates', [MapDataController::class, 'getLiveUpdates']);
    Route::post('/clear-cache', [MapDataController::class, 'clearCache']);
    
    // Extended data endpoints
    Route::get('/roads-detailed', [MapDataController::class, 'getRoadsDetailed']);
    Route::get('/maintenance', [MapDataController::class, 'getMaintenanceData']);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');