<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityStatsController extends Controller
{
    /**
     * احصل على المدينة بناءً على الإحداثيات
     */
    public function detectCity(Request $request)
    {
        $lat = $request->query('lat');
        $lng = $request->query('lng');

        if (!$lat || !$lng) {
            return response()->json(['error' => 'Missing coordinates'], 400);
        }

        // ابحث عن أقرب مدينة
        $city = City::selectRaw("
                *,
                (6371 * acos(cos(radians(?)) * cos(radians(center_lat)) * cos(radians(center_lng) - radians(?)) + sin(radians(?)) * sin(radians(center_lat)))) AS distance
            ", [$lat, $lng, $lat])
            ->orderBy('distance')
            ->first();

        if (!$city) {
            return response()->json(['error' => 'City not found'], 404);
        }

        return response()->json([
            'city' => [
                'id' => $city->id,
                'name' => $city->name,
                'name_en' => $city->name_en,
                'center' => [$city->center_lng, $city->center_lat],
            ],
        ]);
    }

    /**
     * احصل على إحصائيات المدينة
     */
    public function getStats(Request $request, $cityId)
    {
        $city = City::findOrFail($cityId);
        $statsData = json_decode($city->stats, true) ?? [];

        // بناء الإحصائيات بتنسيق كامل
        $stats = [
            [
                'title' => 'حالة الطرق',
                'value' => (string)($statsData['roads'] ?? 0),
                'icon' => '🛣️',
                'trend' => '↑ ' . rand(1, 10) . '%',
                'weeklyAvg' => (string)(($statsData['roads'] ?? 0) - rand(5, 15)),
                'peak' => (string)(($statsData['roads'] ?? 0) + rand(10, 20)),
                'lowest' => (string)(max(0, ($statsData['roads'] ?? 0) - rand(10, 20))),
                'chartData' => array_map(fn() => rand(70, 95), range(1, 7)),
            ],
            [
                'title' => 'الحوادث',
                'value' => (string)($statsData['incidents'] ?? 0),
                'icon' => '⚠️',
                'trend' => '↓ ' . rand(1, 3),
                'weeklyAvg' => (string)(($statsData['incidents'] ?? 0) + rand(1, 3)),
                'peak' => (string)(($statsData['incidents'] ?? 0) + rand(3, 7)),
                'lowest' => (string)(max(0, ($statsData['incidents'] ?? 0) - rand(1, 2))),
                'chartData' => array_map(fn() => rand(30, 80), range(1, 7)),
            ],
            [
                'title' => 'المشاريع',
                'value' => (string)($statsData['projects'] ?? 0),
                'icon' => '🏗️',
                'trend' => '↑ ' . rand(5, 15),
                'weeklyAvg' => (string)(($statsData['projects'] ?? 0) - rand(2, 8)),
                'peak' => (string)(($statsData['projects'] ?? 0) + rand(5, 10)),
                'lowest' => (string)(max(0, ($statsData['projects'] ?? 0) - rand(5, 10))),
                'chartData' => array_map(fn() => rand(60, 95), range(1, 7)),
            ],
            [
                'title' => 'وقت الانتظار',
                'value' => round($statsData['avg_wait_time'] ?? 12) . ' دقيقة',
                'icon' => '⏱️',
                'trend' => '↓ ' . rand(2, 8) . ' دقائق',
                'weeklyAvg' => (round($statsData['avg_wait_time'] ?? 12) + rand(2, 5)) . ' دقيقة',
                'peak' => (round($statsData['avg_wait_time'] ?? 12) + rand(5, 10)) . ' دقيقة',
                'lowest' => max(5, round($statsData['avg_wait_time'] ?? 12) - rand(3, 7)) . ' دقيقة',
                'chartData' => array_map(fn() => rand(50, 85), range(1, 7)),
            ],
        ];

        return response()->json([
            'city' => $city->name,
            'stats' => $stats,
        ]);
    }
}
