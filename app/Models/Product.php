<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'thumbnail',
        'price',
        'sale_price'
    ];

    protected $casts = [
        'price' => 'decimal:0',
        'sale_price' => 'decimal:0'
    ];

    /**
     * Get the categories that own the product.
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * Get the versions for the product.
     */
    public function versions()
    {
        return $this->hasMany(Version::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}