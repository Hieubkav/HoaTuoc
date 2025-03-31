<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'facebook_link',
        'zalo_link',
        'phone',
        'email',
        'slogan',
        'shipping_fee',
        'logo',
        'brand_name',
        'default_product_image',
        'address',
        'google_map_embed',
        'global_discount_percentage',
    ];

    protected $casts = [
        'shipping_fee' => 'decimal:2',
        'global_discount_percentage' => 'decimal:2',
        'address' => 'string',
    ];
}