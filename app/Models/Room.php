<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    public function structure()
    {
        return $this->belongsTo(Structure::class);
    }

    public function equipment()
    {
        return $this->belongsToMany(Equipment::class);
    }

    public function images()
    {
        return $this->HasMany(GalleryRoom::class);
    }

    public function reservations()
    {
        return $this->HasMany(Reservation::class);
    }
}
