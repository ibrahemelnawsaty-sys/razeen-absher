<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Center;
use Illuminate\Support\Str;

class CenterSeeder extends Seeder
{
    public function run()
    {
        $centers = [
            [
                'uuid' => Str::uuid(),
                'name' => 'مركز الأحوال المدنية - النرجس',
                'type' => 'government',
                'status' => 'open',
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [46.7150, 24.7600],
                ],
                'properties' => [
                    'waiting_time' => '15 minutes',
                ],
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'مركز الشرطة - العليا',
                'type' => 'police',
                'status' => 'open',
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [46.7000, 24.7500],
                ],
                'properties' => [
                    'emergency_contact' => '999',
                ],
            ],
        ];

        foreach ($centers as $center) {
            Center::create($center);
        }
    }
}
