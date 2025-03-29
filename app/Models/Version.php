<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Version extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'thumbnail',
        'price',
        'discount_percentage',
        'is_in_stock',
        'status',   
        'product_id',
        
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

    /**
     * Get all combos that contain this version through combo items.
     */
    public function combos()
    {
        return $this->belongsToMany(Combo::class, 'combo_items')
            ->withPivot('quantity');
    }
}