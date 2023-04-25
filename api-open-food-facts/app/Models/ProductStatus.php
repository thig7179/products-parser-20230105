<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class ProductStatus extends Eloquent
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'product_statuses';

    protected $fillable = [
        'imported_t',
        'status',
    ];

    public function product_statuses() {
        return $this->hasMany(ProductStatus::class);
    }

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($product) {
            $product->product_statuses()->delete();
        });
    }
}
