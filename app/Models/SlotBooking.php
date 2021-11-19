<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlotBooking extends Model
{
    use HasFactory;

    public const IS_CANCELLED_RADIO = [
        '0' => 'No',
        '1' => 'Yes',
    ];

    public $timestamps = false;

    public const BOOKED_VIA_SELECT = [
        'website' => 'Website',
        'admin'   => 'Cafe (Admin)',
        'others'  => 'Others',
    ];

    public $table = 'slot_bookings';

    protected $dates = [
        'date',
    ];

    protected $fillable = [
        'user_id',
        'package_trainer_cafe_id ',
        'hrs_used',
        'date',
        'start_time',
        'end_time',
        'booked_via',
        'is_cancelled',
        'cancelled_by',
        'remarks',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getDateAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d', $value)->format(config('panel.date_format')) : null;
    }    

    public function slot()
    {
        return $this->belongsTo(Slot::class);
    }

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d');
    }
}
