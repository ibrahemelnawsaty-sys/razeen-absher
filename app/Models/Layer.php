<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Layer extends Model
{
    protected $fillable = ['name', 'type', 'enabled', 'properties'];

    protected $casts = [
        'properties' => 'array',
    ];
}
