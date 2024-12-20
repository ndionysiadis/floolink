<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;
    protected $fillable = [
        'slug',
        'original_url',
        'encrypted_url',
        'secret_key',
        'click_limit',
        'clicks',
        'self_destruct',
        'expires_at',
    ];

    protected $casts = [
        'self_destruct' => 'boolean',
        'expires_at' => 'datetime',
    ];

    protected $hidden = [
        'encrypted_url',
        'secret_key',
        'created_at',
        'updated_at',
    ];
}
