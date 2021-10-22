<?php
namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class PackageWallet extends Model
{
    public $appends = [
        'used_hours'
    ];

    protected $dates = [
        'date',
    ];

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'package_trainer_cafe_id ',
        'wallet_hrs ',
        'expiry',
        'is_active'
    ];

    public function getUsedHoursAttribute()
    {
        if(auth()->check()){
            $slots = SlotBooking::where('user_id', auth()->user()->id)
            ->where('package_trainer_cafe_id', auth()->user()->registered_package->package_trainer_cafe_id)
            ->sum('hrs_used');
            return $slots;
        }
    }

    public function package()
    {
        return $this->belongsTo(PackageTrainerCafe::class, 'package_trainer_cafe_id');
    }
}