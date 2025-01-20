<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;

    protected $casts = [
        'expires_at' => 'datetime',
    ];
    protected $fillable = [
        'slug',
        'original_url',
        'encrypted_url',
        'secret_key',
        'clicks',
        'expires_at',
        'expiration_type'
    ];

    protected $hidden = [
        'encrypted_url',
        'secret_key',
        'created_at',
        'updated_at',
    ];

    public function getFullUrlAttribute(): string
    {
        return url($this->slug);
    }
}
