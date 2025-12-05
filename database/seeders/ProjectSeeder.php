<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    public function run()
    {
        $projects = [
            [
                'uuid' => Str::uuid(),
                'name' => 'مشروع تطوير طريق الملك عبدالعزيز',
                'type' => 'road',
                'status' => 'in-progress',
                'geometry' => [
                    'type' => 'LineString',
                    'coordinates' => [
                        [46.7000, 24.7500],
                        [46.7100, 24.7600],
                    ],
                ],
                'properties' => [
                    'budget' => '10M SAR',
                    'deadline' => '2024-12-31',
                ],
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'إنشاء حديقة عامة',
                'type' => 'park',
                'status' => 'completed',
                'geometry' => [
                    'type' => 'Polygon',
                    'coordinates' => [
                        [
                            [46.7200, 24.7700],
                            [46.7250, 24.7700],
                            [46.7250, 24.7750],
                            [46.7200, 24.7750],
                            [46.7200, 24.7700],
                        ],
                    ],
                ],
                'properties' => [
                    'area' => '5000 sqm',
                ],
            ],
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }
    }
}
