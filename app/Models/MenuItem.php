<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use SolutionForest\FilamentTree\Concern\ModelTree;

class MenuItem extends Model
{
    use ModelTree;

    const TYPE_LINK = 'link';
    const TYPE_CATEGORY = 'category'; 
    const TYPE_PAGE = 'page';

    protected $fillable = [
        'parent_id',
        'label',
        'type',
        'link',
        'target_id',
        'order',
    ];

    protected $casts = [
        'parent_id' => 'integer',
        'order' => 'integer',
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id')->orderBy('order');
    }

    public function target(): BelongsTo 
    {
        return $this->belongsTo(Post::class, 'target_id')->withDefault();
    }

    // Override ModelTree methods
    public function determineOrderColumnName(): string 
    { 
        return 'order'; 
    }

    public function determineParentColumnName(): string 
    { 
        return 'parent_id'; 
    }

    public function determineTitleColumnName(): string 
    { 
        return 'label'; 
    }

    public static function defaultParentKey()
    {
        return null;
    }

    public static function defaultChildrenKeyName(): string 
    { 
        return 'children'; 
    }
}
