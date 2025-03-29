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
        'thumbnail'
    ];

    /**
     * Get the categories for the product.
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

    /**
     * Get the product images.
     */
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}