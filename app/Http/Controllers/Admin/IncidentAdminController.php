<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Incident;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class IncidentAdminController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $q = Incident::query()->orderBy('created_at', 'desc');

        // optional filters
        if ($request->has('status')) {
            $q->where('status', $request->get('status'));
        }
        if ($request->has('severity')) {
            $q->where('severity', $request->get('severity'));
        }

        $items = $q->paginate(25);

        $features = $items->getCollection()->map(fn($i) => $i->toFeature())->all();

        return response()->json([
            'meta' => [
                'total' => $items->total(),
                'per_page' => $items->perPage(),
                'current_page' => $items->currentPage(),
            ],
            'data' => $features,
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:191',
            'status' => 'nullable|string|max:50',
            'severity' => 'nullable|string|max:50',
            'geometry' => 'required|array',
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

    public function show($uuid): JsonResponse
    {
        $incident = Incident::where('uuid', $uuid)->firstOrFail();
        return response()->json($incident->toFeature());
    }

    public function update(Request $request, $uuid): JsonResponse
    {
        $incident = Incident::where('uuid', $uuid)->firstOrFail();

        $validated = $request->validate([
            'title' => 'nullable|string|max:191',
            'status' => 'nullable|string|max:50',
            'severity' => 'nullable|string|max:50',
            'geometry' => 'nullable|array',
            'properties' => 'nullable|array',
        ]);

        $incident->fill([
            'title' => $validated['title'] ?? $incident->title,
            'status' => $validated['status'] ?? $incident->status,
            'severity' => $validated['severity'] ?? $incident->severity,
            'geometry' => $validated['geometry'] ?? $incident->geometry,
            'properties' => $validated['properties'] ?? $incident->properties,
        ])->save();

        return response()->json($incident->toFeature());
    }

    public function destroy($uuid): JsonResponse
    {
        $incident = Incident::where('uuid', $uuid)->firstOrFail();
        $incident->delete();

        return response()->json(['deleted' => true]);
    }
}
