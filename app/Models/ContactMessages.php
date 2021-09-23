<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessages extends Model
{
    use HasFactory;

    public $table='contact_messages';

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'mobile',
        'message',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getNameAttribute(){
        return ucfirst($this->attributes['name']);
    }

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d-m-Y');
    }
}
