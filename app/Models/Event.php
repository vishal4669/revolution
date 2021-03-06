<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Event extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use HasFactory;

    public const IS_ACTIVE_RADIO = [
        '0' => 'No',
        '1' => 'Yes',
    ];

    public const IS_CANCELLED_RADIO = [
        '0' => 'Not Cancelled',
        '1' => 'Cancelled',
    ];

    public const EVENT_TYPE_RADIO = [
        '0' => 'Outdoor Ride',
        '1' => 'Indoor Ride (Trainer)',
        '2' => 'Others',
    ];

    public $table = 'events';

    protected $appends = [
        'event_images',
    ];

    protected $dates = [
        'last_booking_date',
        'event_start_day',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'description',
        'last_booking_date',
        'event_start_day',
        'terms',
        'location',
        'event_type',
        'reporting_time',
        'start_time',
        'end_time',
        'is_active',
        'is_cancelled',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function getEventImagesAttribute()
    {
        $files = $this->getMedia('event_images');
        $files->each(function ($item) {
            $item->url = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview = $item->getUrl('preview');
        });

        return $files;
    }

    public function getLastBookingDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setLastBookingDateAttribute($value)
    {
        $this->attributes['last_booking_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getEventStartDayAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setEventStartDayAttribute($value)
    {
        $this->attributes['event_start_day'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
