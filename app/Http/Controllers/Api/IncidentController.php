<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Incident;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class IncidentController extends Controller
{
    /**
     * Return all incidents as a GeoJSON FeatureCollection.
     */
    public function index(): JsonResponse
    {
        $features = Incident::orderBy('created_at', 'desc')
            ->get()
            ->map(fn($incident) => $incident->toFeature())
            ->values()
            ->all();

        return response()->json([
            'type' => 'FeatureCollection',
            'features' => $features,
        ]);
    }

    /**
     * Optionally: show single incident as Feature
     */
    public function show($uuid): JsonResponse
    {
        $incident = Incident::where('uuid', $uuid)->firstOrFail();
        return response()->json($incident->toFeature());
    }

    /**
     * Store a new incident (creates model -> Observer will broadcast)
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:191',
            'status' => 'nullable|string|max:50',
            'severity' => 'nullable|string|max:50',
            'geometry' => 'required|array', // expect GeoJSON geometry object
            'geometry.type' => 'required|string',
            'geometry.coordinates' => 'required|array',
            'properties' => 'nullable|array',
        ]);

        $incident = Incident::create([
            'title' => $validated['title'] ?? null,
            'status' => $validated['status'] ?? 'active',
            'severity' => $validated['severity'] ?? null,
            'geometry' => $validated['geometry'],
            'properties' => $validated['properties'] ?? [],
        ]);

        return response()->json($incident->toFeature(), 201);
    }
}
