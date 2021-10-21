<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentingTrainer extends Model
{
    use HasFactory;

    public const IS_CANCELLED_RADIO = [
        '0' => 'No',
        '1' => 'Yes',
    ];

    public $appends = [
        'status'
    ];

    public const BOOKING_TYPE_RADIO = [
        '0' => 'Monthly',
        '1' => 'Hourly',
    ];

    public const PAYMENT_OPTION_RADIO = [
        '0' => 'Cash',
        '1' => 'Online',
        '2' => 'Card',
        '3' => 'Wallet',
    ];

    public $table = 'renting_trainers';

    protected $dates = [
        'from_date',
        'to_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'trainer_id',
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

    public function trainer()
    {
        return $this->belongsTo(Trainer::class, 'trainer_id');
    }

    public function getStatusAttribute()
    {
        if($this->attributes['to_date'] >= date('d-m-Y', strtotime(Carbon::now()))){
            return "Active";
        }else{
            return "Expired";
        }
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
