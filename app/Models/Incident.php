<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Incident extends Model
{
    public readonly string $uuid;
    public readonly array $geometry;
    public readonly array $properties;

    protected $fillable = [
        'uuid',
        'title',
        'status',
        'severity',
        'geometry',
        'properties',
    ];

    protected $casts = [
        'geometry' => 'array',
        'properties' => 'array',
    ];

    // set uuid automatically
    protected static function booted()
    {
        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
        });
    }

    /**
     * Convert model to GeoJSON Feature
     *
     * @return array
     */
    public function toFeature(): array
    {
        return [
            'type' => 'Feature',
            'geometry' => $this->geometry ?: null,
            'properties' => array_merge(
                $this->properties ?? [],
                [
                    'id' => $this->uuid ?? $this->getKey(),
                    'title' => $this->title,
                    'status' => $this->status,
                    'severity' => $this->severity,
                    'created_at' => $this->created_at ? $this->created_at->toDateTimeString() : null,
                ]
            ),
        ];
    }
}