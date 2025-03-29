<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Table extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'room_id',
    ];

    /**
     * Get the room that owns the table.
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}