<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'name',
        'name_en',
        'geometry',
        'center_lat',
        'center_lng',
        'population',
        'stats', // إضافة stats
    ];

    protected $casts = [
        'geometry' => 'array',
        'stats' => 'array', // تحويل تلقائي لـ JSON
        'center_lat' => 'decimal:7',
        'center_lng' => 'decimal:7',
    ];

    /**
     * احصل على إحصائيات المدينة
     */
    public function getStats()
    {
        $bounds = $this->getBounds();

        return [
            'roads' => \App\Models\Road::whereBetween('center_lat', [$bounds['minLat'], $bounds['maxLat']])
                ->whereBetween('center_lng', [$bounds['minLng'], $bounds['maxLng']])
                ->count(),
            
            'incidents' => \App\Models\Incident::whereBetween('center_lat', [$bounds['minLat'], $bounds['maxLat']])
                ->whereBetween('center_lng', [$bounds['minLng'], $bounds['maxLng']])
                ->where('created_at', '>=', now()->subDay())
                ->count(),
            
            'projects' => \App\Models\Project::whereBetween('center_lat', [$bounds['minLat'], $bounds['maxLat']])
                ->whereBetween('center_lng', [$bounds['minLng'], $bounds['maxLng']])
                ->whereIn('status', ['in-progress', 'pending'])
                ->count(),
            
            'avgWaitTime' => \App\Models\Center::whereBetween('center_lat', [$bounds['minLat'], $bounds['maxLat']])
                ->whereBetween('center_lng', [$bounds['minLng'], $bounds['maxLng']])
                ->avg('wait_time') ?? 12,
        ];
    }

    /**
     * احصل على حدود المدينة (bounding box)
     */
    protected function getBounds()
    {
        // بناءً على نقطة المركز + نصف قطر تقريبي
        $radius = 0.2; // ~20 كم
        
        return [
            'minLat' => $this->center_lat - $radius,
            'maxLat' => $this->center_lat + $radius,
            'minLng' => $this->center_lng - $radius,
            'maxLng' => $this->center_lng + $radius,
        ];
    }

    public function __construct(
        public string $name = '',
        public float $center_lat = 0,
        public float $center_lng = 0
    ) {}
}
