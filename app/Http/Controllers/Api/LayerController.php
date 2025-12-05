<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Road;
use App\Models\Traffic;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class LayerController extends Controller
{
    public function roads(): JsonResponse
    {
        $geojson = Cache::remember('roads_layer', 300, function () {
            $roads = Road::where('status', '!=', 'closed')->get();
            
            return [
                'type' => 'FeatureCollection',
                'features' => $roads->map(fn($road) => $road->toFeature())->values(),
            ];
        });

        return response()->json($geojson);
    }

    public function traffic(): JsonResponse
    {
        $geojson = Cache::remember('traffic_layer', 60, function () {
            $traffic = Traffic::where('detected_at', '>=', now()->subHours(1))
                ->orderBy('detected_at', 'desc')
                ->get();
            
            return [
                'type' => 'FeatureCollection',
                'features' => $traffic->map(fn($t) => $t->toFeature())->values(),
            ];
        });

        return response()->json($geojson);
    }
}
