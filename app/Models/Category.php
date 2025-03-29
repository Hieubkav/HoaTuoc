<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'thumbnail',
        'status',
        'section_id',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    /**
     * Available status values
     */
    protected static $statuses = [
        'visible' => 'Hiển thị',
        'hidden' => 'Ẩn',
    ];

    /**
     * Get all available statuses.
     */
    public static function getStatuses(): array
    {
        return static::$statuses;
    }

    /**
     * Get the products in the category.
     */
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    /**
     * Get the section that owns the category.
     */
    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}