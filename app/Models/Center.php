<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Center extends Model
{
    protected $fillable = ['uuid', 'name', 'type', 'status', 'geometry', 'properties'];

    protected $casts = [
        'geometry' => 'array',
        'properties' => 'array',
    ];
}
