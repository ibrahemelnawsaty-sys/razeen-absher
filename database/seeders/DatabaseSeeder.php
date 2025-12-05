<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // Users & Auth
            AdminUserSeeder::class,
            
            // Geo Data
            IncidentSeeder::class,
            ProjectSeeder::class,
            CenterSeeder::class,
            LayerSeeder::class,
            RoadSeeder::class,
            TrafficSeeder::class,
        ]);
    }
}
