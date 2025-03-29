<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'type',
        'value',
        'min_order_value',
        'max_discount',
        'starts_at',
        'expires_at',
        'usage_limit',
        'used_count',
        'is_active',
    ];

    protected $casts = [
        'value' => 'decimal:2',
        'min_order_value' => 'decimal:2',
        'max_discount' => 'decimal:2',
        'starts_at' => 'datetime',
        'expires_at' => 'datetime',
        'usage_limit' => 'integer',
        'used_count' => 'integer',
        'is_active' => 'boolean',
    ];

    /**
     * Get the orders that used this coupon.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Check if the coupon is valid now.
     */
    public function isValidNow()
    {
        $now = now();
        return $this->is_active &&
               ($this->starts_at === null || $this->starts_at <= $now) &&
               ($this->expires_at === null || $this->expires_at >= $now) &&
               ($this->usage_limit === null || $this->used_count < $this->usage_limit);
    }
}