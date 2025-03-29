<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Combo extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'thumbnail',
        'discount_type',
        'discount_value',
        'apply_discount',
        'price',
    ];

    protected $casts = [
        'discount_value' => 'decimal:2',
        'price' => 'decimal:2',
        'apply_discount' => 'boolean',
        'discount_type' => 'string',
    ];

    /**
     * Get all items in the combo.
     */
    public function comboItems()
    {
        return $this->hasMany(ComboItem::class);
    }

    /**
     * Get all products in the combo through combo items.
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'combo_items')
            ->withPivot('quantity');
    }
}