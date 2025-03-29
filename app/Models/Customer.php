<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'total_spent',
        'total_orders',
    ];

    protected $casts = [
        'total_spent' => 'decimal:2',
        'total_orders' => 'integer',
    ];

    /**
     * Get the cart that belongs to the customer.
     */
    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    /**
     * Get all orders of the customer.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}