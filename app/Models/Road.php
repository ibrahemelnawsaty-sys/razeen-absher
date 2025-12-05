<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Road extends Model
{
    protected $fillable = [
        'uuid', 'name', 'status', 'geometry', 'properties'
    ];

    protected $casts = [
        'geometry' => 'array',
        'properties' => 'array',
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
            'properties' => array_merge(
                $this->properties ?? [],
                [
                    'id' => $this->uuid,
                    'name' => $this->name,
                    'status' => $this->status,
                ]
            ),
        ];
    }

    public function traffic()
    {
        return $this->hasMany(Traffic::class);
    }
}
