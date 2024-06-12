<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Structure extends Model
{
    use HasFactory, SoftDeletes;

    protected $append = [
        'formated_date'
    ];

    public function getFormatedDateAttribute(){
        return getFormattedDate($this->created_at);
    }

    public function galleryHotels() : HasMany {
        return $this->hasMany(GalleryHotel::class);
    }

    public function rooms() : HasMany {
        return $this->hasMany(Room::class);
    }

    public function reservations() : HasMany {
        return $this->hasMany(Reservation::class);
    }

    public function conditions() : HasMany {
        return $this->hasMany(Condition::class);
    }

    public function equipment() : HasMany {
        return $this->hasMany(Equipment::class);
    }

    public function evaluations() : HasMany {
        return $this->hasMany(Evaluations::class);
    }

    public function testimonies() : HasMany {
        return $this->hasMany(Testimony::class);
    }

    public function faqs() : HasMany {
        return $this->hasMany(FAQ::class);
    }

    public function images() {
        return $this->hasMany(GalleryHotel::class);
    }

}
