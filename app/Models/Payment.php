<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \DateTimeInterface;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'razorpay_id', 
        'user_id',
        'registration_type',
        'registration_type_id',
        'amount',
        'email',
        'contact',
        'status',
        'description',
        'method',
        'created_at'
    ];

    protected $dates = [
        'created_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d-m-Y H:i:s');
    }
}