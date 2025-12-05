<?php

namespace App\Http\Controllers\Maps;

use App\Http\Controllers\Controller;
use App\Models\Incident;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HeatmapController extends Controller
{
    /**
     * Return incidents as FeatureCollection for heatmap layer.
     * Query params:
     *  - hours (int) : lookback window in hours (default 24)
     *  - severity (string) optional filter
     */
    public function index(Request $request): JsonResponse
    {
        $hours = (int) $request->query('hours', 24);
        $since = Carbon::now()->subHours($hours);

        $q = Incident::where('created_at', '>=', $since);

        if ($severity = $request->query('severity')) {
            $q->where('severity', $severity);
        }

        $features = $q->get()->map(fn($i) => $i->toFeature())->values()->all();

        return response()->json([
            'type' => 'FeatureCollection',
            'features' => $features,
            'meta' => [
                'count' => count($features),
                'hours' => $hours,
            ],
        ]);
    }
}
