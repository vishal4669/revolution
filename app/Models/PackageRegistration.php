<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use App\Models\PackageTrainerCafe;

class PackageRegistration extends Model
{

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user_id',
        'payment_mode',
        'description',
        'amount_received',
        'transaction',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d-m-Y H:i:s');
    }

    public function package()
    {
        return $this->belongsTo(PackageTrainerCafe::class, 'package_trainer_cafe_id', 'id');
    }

    public function package_wallet()
    {
        return $this->hasOne(PackageWallet::class, 'package_trainer_cafe_id', 'package_trainer_cafe_id');
    }
}
