<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrainerSetting extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const IS_CAFE_TRAINER_RADIO = [
        '1' => 'No',
        '2' => 'Yes',
    ];

    public $table = 'trainer_settings';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'trainer_id',
        'rent_per_hour',
        'rent_per_day',
        'rent_per_week',
        'rent_per_fortnight',
        'slot_booking_limit',
        'booking_amount',
        'is_cafe_trainer',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function trainer()
    {
        return $this->belongsTo(Trainer::class, 'trainer_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d-m-Y H:i:s');
    }
}
