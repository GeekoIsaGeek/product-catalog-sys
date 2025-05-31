<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Product extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];

    const PRODUCTS_CACHE_VERSION_KEY = 'products_version';

    protected static function booted()
    {
        static::created(function () {
           $this->incrementProductCacheVersion();
        });

        static::updated(function () {
            $this->incrementProductCacheVersion();
        });

        static::deleted(function () {
           $this->incrementProductCacheVersion();
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    private function incrementProductCacheVersion() {
        Cache::increment(self::PRODUCTS_CACHE_VERSION_KEY);
    }
}
