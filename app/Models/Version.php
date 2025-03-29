<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Version extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'name',
        'price',
        'stock',
        'sku',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer',
    ];

    /**
     * Get the product that owns the version.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the cart items for the version.
     */
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}