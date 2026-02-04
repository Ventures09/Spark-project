<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'logs';

    // Automatically manage created_at, disable updated_at if not used
    const UPDATED_AT = null;
    public $timestamps = true;

    protected $fillable = [
        'action',
        'module',
        'details',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}


