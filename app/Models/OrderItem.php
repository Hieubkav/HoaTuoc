<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'version_id',
        'quantity',
        'price',
        'subtotal',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];

    // Relationships
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function version()
    {
        return $this->belongsTo(Version::class)->with('product');
    }

    // Helper methods
    public function updateSubtotal()
    {
        $this->subtotal = $this->quantity * $this->price;
        $this->save();
    }

    // Event listeners
    protected static function boot()
    {
        parent::boot();

        // Auto calculate subtotal before saving
        static::saving(function ($item) {
            if (!$item->price && $item->version) {
                $item->price = $item->version->price;
            }
            $item->subtotal = $item->quantity * $item->price;
        });

        // Update order totals after any changes
        static::saved(function ($item) {
            if ($item->order) {
                $item->order->updateTotals();
            }
        });

        static::deleted(function ($item) {
            if ($item->order) {
                $item->order->updateTotals();
            }
        });
    }
}
