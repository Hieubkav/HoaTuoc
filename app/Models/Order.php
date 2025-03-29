<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'status',
        'total_amount',
        'total_items',
        'customer_id',
        'payment_method',
        'payment_status',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
    ];

    // Define relationships
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Helper methods
    public function updateTotals()
    {
        $items = $this->items;
        
        $this->total_items = $items->sum('quantity');
        $this->total_amount = $items->sum('subtotal');
        
        $this->save();
    }

    // Boot method to set default name
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            if (empty($order->name)) {
                $order->name = '#' . random_int(100000, 999999);
            }
        });
    }

    // Event listeners for order items
    protected static function booted()
    {
        static::created(function ($order) {
            $order->updateTotals();
        });

        static::updated(function ($order) {
            $order->updateTotals();
        });
    }
}
