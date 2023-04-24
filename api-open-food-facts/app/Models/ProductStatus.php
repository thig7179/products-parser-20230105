<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStatus extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'product';

    protected $fillable = [
        'imported_t',
        'status',
    ];

    public function stastusImport() {
        return $this->hasMany(ProductStatus::class);
    }

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($product) {
            $product->stastusImport()->delete();
        });
    }
}
