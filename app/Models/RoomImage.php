<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoomImage extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'image_url',
        'room_id',
    ];

    /**
     * Get the room that owns the image.
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}