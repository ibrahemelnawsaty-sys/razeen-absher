<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Road;

class RoadSeeder extends Seeder
{
    public function run()
    {
        $roads = [
            [
                'name' => 'طريق الملك فهد',
                'status' => 'open',
                'geometry' => [
                    'type' => 'LineString',
                    'coordinates' => [
                        [46.6753, 24.7136],
                        [46.6800, 24.7200],
                        [46.6850, 24.7250],
                    ],
                ],
                'properties' => ['lanes' => 6, 'speed_limit' => 120],
            ],
            [
                'name' => 'طريق الأمير محمد بن سلمان',
                'status' => 'maintenance',
                'geometry' => [
                    'type' => 'LineString',
                    'coordinates' => [
                        [46.7000, 24.7500],
                        [46.7100, 24.7600],
                    ],
                ],
                'properties' => ['lanes' => 4, 'speed_limit' => 100],
            ],
            [
                'name' => 'طريق العروبة',
                'status' => 'open',
                'geometry' => [
                    'type' => 'LineString',
                    'coordinates' => [
                        [46.6600, 24.7000],
                        [46.6650, 24.7050],
                    ],
                ],
                'properties' => ['lanes' => 4, 'speed_limit' => 80],
            ],
        ];

        foreach ($roads as $road) {
            Road::create($road);
        }
    }
}
