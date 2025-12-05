<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Traffic;
use App\Models\Road;

class TrafficSeeder extends Seeder
{
    public function run()
    {
        $roads = Road::all();

        foreach ($roads as $road) {
            Traffic::create([
                'road_id' => $road->id,
                'congestion' => fake()->randomElement(['low', 'medium', 'high']),
                'severity' => fake()->randomElement(['info', 'warning', 'danger']),
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [46.6753 + (rand(-100, 100) / 10000), 24.7136 + (rand(-100, 100) / 10000)],
                ],
                'detected_at' => now()->subMinutes(rand(0, 60)),
            ]);
        }
    }
}
