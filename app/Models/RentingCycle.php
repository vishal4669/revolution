<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentingCycle extends Model
{
    use HasFactory;

    public const IS_CANCELLED_RADIO = [
        '0' => 'No',
        '1' => 'Yes',
    ];

    public const BOOKING_TYPE_RADIO = [
        '1' => 'Website',
        '2' => 'Store',
    ];

    public const PAYMENT_OPTION_RADIO = [
        '1' => 'Cash at Store',
        '2' => 'Online Banking',
        '3' => 'Card',
        '4' => 'Wallet',
    ];

    public $table = 'renting_cycles';

    protected $dates = [
        'from_date',
        'to_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'cycle_id',
        'user_id',
        'booking_type',
        'total_hours',
        'from_date',
        'to_date',
        'total_days',
        'price_per_day',
        'total_rent',
        'deposit_received',
        'payment_option',
        'is_cancelled',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function cycle()
    {
        return $this->belongsTo(Cycle::class, 'cycle_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getFromDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setFromDateAttribute($value)
    {
        $this->attributes['from_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getToDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setToDateAttribute($value)
    {
        $this->attributes['to_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d-m-Y H:i:s');
    }
}
