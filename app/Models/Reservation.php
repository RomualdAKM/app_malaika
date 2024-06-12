<?php

namespace App\Models;

use App\ReservationStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    use HasFactory;

    public $append = ['status_label'];

    public function getStatusLabelAttribute()
    {
        return ReservationStatusEnum::getLabel($this->status);
    }   
}
