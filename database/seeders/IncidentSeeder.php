<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Incident;
use Illuminate\Support\Str;

class IncidentSeeder extends Seeder
{
    public function run()
    {
        $incidents = [
            [
                'uuid' => Str::uuid(),
                'title' => 'حادث مروري',
                'status' => 'active',
                'severity' => 'high',
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [46.6753, 24.7136],
                ],
                'properties' => [
                    'description' => 'حادث مروري على طريق الملك فهد',
                ],
            ],
            [
                'uuid' => Str::uuid(),
                'title' => 'إغلاق طريق',
                'status' => 'closed',
                'severity' => 'medium',
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [46.7000, 24.7500],
                ],
                'properties' => [
                    'description' => 'إغلاق طريق الأمير محمد بن سلمان للصيانة',
                ],
            ],
        ];

        foreach ($incidents as $incident) {
            Incident::create($incident);
        }
    }
}
