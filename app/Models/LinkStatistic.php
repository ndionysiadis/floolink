<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LinkStatistic extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'slug_hash',
        'clicks',
        'unique_clicks',
        'last_clicked_at',
    ];

    protected $casts = [
        'last_clicked_at' => 'datetime',
    ];

    public function dailyClicks()
    {
        return $this->hasMany(DailyClick::class, 'slug_hash', 'slug_hash');
    }

    public function geographicStatistics()
    {
        return $this->hasMany(GeographicStatistic::class, 'slug_hash', 'slug_hash');
    }

    public function deviceStatistics()
    {
        return $this->hasMany(DeviceStatistic::class, 'slug_hash', 'slug_hash');
    }
}
