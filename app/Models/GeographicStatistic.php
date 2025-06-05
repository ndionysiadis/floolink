<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeographicStatistic extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'slug_hash',
        'country',
        'region',
        'clicks',
    ];
}
