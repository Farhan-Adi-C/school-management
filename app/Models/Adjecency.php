<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adjecency extends Model
{
    protected $guarded = [];

    protected $casts = [
        'subjects' => 'array'
    ];
}
