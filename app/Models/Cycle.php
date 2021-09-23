<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use DGvai\Review\Reviewable;

class Cycle extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;
    use Reviewable;

    public const IS_ACTIVE_RADIO = [
        '0' => 'Inactive',
        '1' => 'Active',
    ];

    public const IS_RENTED_RADIO = [
        '0' => 'Not Rented',
        '1' => 'Rented',
    ];

    public const TYPE_SELECT = [
        '1' => 'Mountain Bike',
        '2' => 'Hybrid Bike',
        '3' => 'Road Bike',
        '4' => 'Regular',
    ];

    public $table = 'cycles';

    protected $appends = [
        'photo',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'cycle_cost',
        'description',
        'type',
        'serial_number',
        'rent_month',
        'rent_hour',
        'is_active',
        'is_rented',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function getPhotoAttribute()
    {
        $files = $this->getMedia('photo');
        $files->each(function ($item) {
            $item->url = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview = $item->getUrl('preview');
        });

        return $files;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d-m-Y');
    }

    public function comments()
    {
        return $this->hasMany(\DGvai\Review\Review::class, 'model_id');
    }

}
