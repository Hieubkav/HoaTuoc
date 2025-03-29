<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'operating_hours',
        'capacity',
        'is_vip',
        'service_name_1',
        'service_description_1',
        'service_name_2',
        'service_description_2',
        'service_name_3',
        'service_description_3',
        'service_name_4',
        'service_description_4',
        'service_name_5',
        'service_description_5',
        'service_name_6',
        'service_description_6',
    ];

    protected $casts = [
        'is_vip' => 'boolean',
        'capacity' => 'integer',
    ];

    /**
     * Get all tables in the room.
     */
    public function tables()
    {
        return $this->hasMany(Table::class);
    }

    /**
     * Get all images of the room.
     */
    public function roomImages()
    {
        return $this->hasMany(RoomImage::class);
    }
}