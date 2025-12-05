<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Traffic extends Model
{
    protected $fillable = [
        'uuid', 'road_id', 'congestion', 'severity', 'geometry', 'detected_at'
    ];

    protected $casts = [
        'geometry' => 'array',
        'detected_at' => 'datetime',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
        });
    }

    public function toFeature(): array
    {
        return [
            'type' => 'Feature',
            'geometry' => $this->geometry,
            'properties' => [
                'id' => $this->uuid,
                'congestion' => $this->congestion,
                'severity' => $this->severity,
                'detected_at' => $this->detected_at->toIso8601String(),
            ],
        ];
    }

    public function road()
    {
        return $this->belongsTo(Road::class);
    }
}
