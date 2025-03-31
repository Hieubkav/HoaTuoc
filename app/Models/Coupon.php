<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'code',
        'status',
        'thumbnail',
        'value',
        'is_percentage',
        'valid_until',
    ];

    protected $casts = [
        'value' => 'decimal:2',
        'is_percentage' => 'boolean',
        'valid_until' => 'datetime',
        'status' => 'string',
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
        return $this->status === 'active' && 
               ($this->valid_until === null || $this->valid_until >= $now);
    }
}