<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'thumbnail',
        'status',
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
     * Get all categories in this section.
     */
    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}