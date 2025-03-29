<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity',
        'cart_id',
        'version_id',
    ];

    protected $casts = [
        'quantity' => 'integer',
    ];

    /**
     * Get the cart that owns the item.
     */
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    /**
     * Get the version of the item.
     */
    public function version()
    {
        return $this->belongsTo(Version::class);
    }

    /**
     * Get the subtotal for this cart item.
     */
    public function getSubtotalAttribute()
    {
        return $this->quantity * $this->version->price;
    }
}