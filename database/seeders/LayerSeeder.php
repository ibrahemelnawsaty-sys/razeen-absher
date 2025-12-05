<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Layer;

class LayerSeeder extends Seeder
{
    public function run()
    {
        $layers = [
            [
                'name' => 'حالة الطرق',
                'type' => 'line',
                'enabled' => true,
                'properties' => [
                    'color' => '#FF0000',
                ],
            ],
            [
                'name' => 'المراكز الحكومية',
                'type' => 'point',
                'enabled' => true,
                'properties' => [
                    'icon' => 'government',
                ],
            ],
            [
                'name' => 'الخرائط الحرارية',
                'type' => 'heatmap',
                'enabled' => true,
                'properties' => [
                    'intensity' => 0.8,
                ],
            ],
        ];

        foreach ($layers as $layer) {
            Layer::create($layer);
        }
    }
}
