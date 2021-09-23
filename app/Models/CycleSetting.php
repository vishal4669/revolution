<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CycleSetting extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'cycle_settings';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'cycle_id',
        'rent_per_hour',
        'rent_per_day',
        'rent_per_week',
        'rent_per_fortnight',
        'slot_booking_limit',
        'booking_amount',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function cycle()
    {
        return $this->belongsTo(Cycle::class, 'cycle_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d-m-Y H:i:s');
    }
}
