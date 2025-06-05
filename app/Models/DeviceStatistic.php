<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceStatistic extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'slug_hash',
        'device_type',
        'browser',
        'clicks',
    ];
}
