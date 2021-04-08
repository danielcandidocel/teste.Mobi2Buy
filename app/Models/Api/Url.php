<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;

class Url extends Model
{
    use HasFactory, QueryCacheable;

    protected $cacheFor = 15;

    protected $fillable = [
        'url_complete',
        'shortened',
        'expiration_date'
    ];
}
