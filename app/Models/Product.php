<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Cache;

class Product extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];

    protected static function booted(): void
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

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    private function incrementProductCacheVersion(): void {
        Cache::increment(config('constants.products_version_key'));
    }
}
