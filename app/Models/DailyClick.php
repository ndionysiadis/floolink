<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyClick extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'slug_hash',
        'date',
        'clicks',
        'unique_clicks',
    ];

    protected $casts = [
        'date' => 'date',
    ];
}
