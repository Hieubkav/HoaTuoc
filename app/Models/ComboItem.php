<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComboItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity',
        'version_id',
        'combo_id',
    ];

    protected $casts = [
        'quantity' => 'integer',
    ];

    /**
     * Get the combo that owns the item.
     */
    public function combo()
    {
        return $this->belongsTo(Combo::class);
    }

    /**
     * Get the version of the combo item.
     */
    public function version()
    {
        return $this->belongsTo(Version::class);
    }
}