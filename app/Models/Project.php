<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['uuid', 'name', 'type', 'status', 'geometry', 'properties'];

    protected $casts = [
        'geometry' => 'array',
        'properties' => 'array',
    ];
}
