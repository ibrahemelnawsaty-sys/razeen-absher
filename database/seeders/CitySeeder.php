<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City;

class CitySeeder extends Seeder
{
    public function run()
    {
        $cities = [
            [
                'name' => 'الرياض',
                'name_en' => 'Riyadh',
                'center_lat' => 24.7136,
                'center_lng' => 46.6753,
                'population' => 7000000,
                'stats' => [
                    'roads' => 127,
                    'incidents' => 3,
                    'projects' => 47,
                    'avg_wait_time' => 12,
                ],
                'geometry' => [
                    'type' => 'Polygon',
                    'coordinates' => [[
                        [46.5, 24.5], [46.9, 24.5], [46.9, 24.9], [46.5, 24.9], [46.5, 24.5],
                    ]],
                ],
            ],
            [
                'name' => 'جدة',
                'name_en' => 'Jeddah',
                'center_lat' => 21.5433,
                'center_lng' => 39.1728,
                'population' => 4000000,
                'stats' => [
                    'roads' => 98,
                    'incidents' => 5,
                    'projects' => 62,
                    'avg_wait_time' => 15,
                ],
                'geometry' => [
                    'type' => 'Polygon',
                    'coordinates' => [[
                        [39.0, 21.3], [39.3, 21.3], [39.3, 21.7], [39.0, 21.7], [39.0, 21.3],
                    ]],
                ],
            ],
            [
                'name' => 'مكة المكرمة',
                'name_en' => 'Makkah',
                'center_lat' => 21.3891,
                'center_lng' => 39.8579,
                'population' => 2000000,
                'stats' => [
                    'roads' => 75,
                    'incidents' => 2,
                    'projects' => 38,
                    'avg_wait_time' => 18,
                ],
                'geometry' => [
                    'type' => 'Polygon',
                    'coordinates' => [[
                        [39.7, 21.2], [40.0, 21.2], [40.0, 21.5], [39.7, 21.5], [39.7, 21.2],
                    ]],
                ],
            ],
            [
                'name' => 'الدمام',
                'name_en' => 'Dammam',
                'center_lat' => 26.4207,
                'center_lng' => 50.0888,
                'population' => 1500000,
                'stats' => [
                    'roads' => 82,
                    'incidents' => 4,
                    'projects' => 35,
                    'avg_wait_time' => 10,
                ],
                'geometry' => [
                    'type' => 'Polygon',
                    'coordinates' => [[
                        [49.9, 26.2], [50.3, 26.2], [50.3, 26.6], [49.9, 26.6], [49.9, 26.2],
                    ]],
                ],
            ],
            [
                'name' => 'المدينة المنورة',
                'name_en' => 'Madinah',
                'center_lat' => 24.4672,
                'center_lng' => 39.6117,
                'population' => 1500000,
                'stats' => [
                    'roads' => 68,
                    'incidents' => 1,
                    'projects' => 42,
                    'avg_wait_time' => 8,
                ],
                'geometry' => [
                    'type' => 'Polygon',
                    'coordinates' => [[
                        [39.4, 24.3], [39.8, 24.3], [39.8, 24.6], [39.4, 24.6], [39.4, 24.3],
                    ]],
                ],
            ],
            [
                'name' => 'الطائف',
                'name_en' => 'Taif',
                'center_lat' => 21.2703,
                'center_lng' => 40.4175,
                'population' => 1000000,
                'stats' => [
                    'roads' => 54,
                    'incidents' => 2,
                    'projects' => 28,
                    'avg_wait_time' => 14,
                ],
                'geometry' => [
                    'type' => 'Polygon',
                    'coordinates' => [[
                        [40.2, 21.1], [40.6, 21.1], [40.6, 21.4], [40.2, 21.4], [40.2, 21.1],
                    ]],
                ],
            ],
            [
                'name' => 'تبوك',
                'name_en' => 'Tabuk',
                'center_lat' => 28.3838,
                'center_lng' => 36.5676,
                'population' => 900000,
                'stats' => [
                    'roads' => 45,
                    'incidents' => 1,
                    'projects' => 22,
                    'avg_wait_time' => 9,
                ],
                'geometry' => [
                    'type' => 'Polygon',
                    'coordinates' => [[
                        [36.4, 28.2], [36.7, 28.2], [36.7, 28.5], [36.4, 28.5], [36.4, 28.2],
                    ]],
                ],
            ],
            [
                'name' => 'أبها',
                'name_en' => 'Abha',
                'center_lat' => 18.2164,
                'center_lng' => 42.5053,
                'population' => 500000,
                'stats' => [
                    'roads' => 38,
                    'incidents' => 0,
                    'projects' => 18,
                    'avg_wait_time' => 7,
                ],
                'geometry' => [
                    'type' => 'Polygon',
                    'coordinates' => [[
                        [42.3, 18.0], [42.7, 18.0], [42.7, 18.4], [42.3, 18.4], [42.3, 18.0],
                    ]],
                ],
            ],
        ];

        foreach ($cities as $cityData) {
            $stats = $cityData['stats'];
            unset($cityData['stats']);
            
            $city = City::create($cityData);
            
            // حفظ الإحصائيات في جدول منفصل أو كـ JSON
            $city->update(['stats' => json_encode($stats)]);
        }
    }
}
