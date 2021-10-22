<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class SlotBooking extends Model
{

    public $table = 'slot_bookings';

    protected $dates = [
        'date',
    ];

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'package_trainer_cafe_id ',
        'package_trainer_cafe_id ',
        'date',
        'start_time',
        'end_time',
        'booked_via',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function slot()
    {
        return $this->belongsTo(Slot::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d-m-Y H:i:s');
    }

    

}
