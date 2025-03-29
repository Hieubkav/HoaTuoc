<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'parent_id',
        'section_id',
        'status',
        'thumbnail',
    ];

    /**
     * Get the parent category.
     */
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * Get the child categories.
     */
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
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