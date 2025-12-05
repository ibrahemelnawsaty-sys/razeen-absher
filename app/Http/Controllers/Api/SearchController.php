<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use InvalidArgumentException;
use Throwable;

class SearchController extends Controller
{
    public function search(Request $request): JsonResponse
    {
        try {
            $query = $request->query('q', '');
            $results = $this->performSearch($query);
            return response()->json($results);
        } catch (InvalidArgumentException $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        } catch (Throwable $e) {
            return response()->json(['error' => 'Internal error'], 500);
        }
    }

    protected function performSearch($query)
    {
        $results = collect();

        // Search in incidents
        $incidents = DB::table('incidents')
            ->where('title', 'like', "%{$query}%")
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->title,
                    'type' => 'Incident',
                    'geometry' => json_decode($item->geometry),
                ];
            });

        $results = $results->merge($incidents);

        // Search in projects
        $projects = DB::table('projects')
            ->where('name', 'like', "%{$query}%")
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'type' => 'Project',
                    'geometry' => json_decode($item->geometry),
                ];
            });

        $results = $results->merge($projects);

        return $results->values();
    }
}
