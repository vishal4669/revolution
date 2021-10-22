<?php
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class WeeklySlot extends Model
{
    public $timestamps = false;
    
	protected $fillable = [
		'day_of_week',
		'slot_id',
		'is_active',
	];

	public function slot()
	{
		return $this->belongsTo(Slot::class, 'slot_id');
	}

	public function daily_slot()
	{
		return $this->belongsTo(Slot::class, 'slot_id')->where('slot_start_time', '>', date('H:i', strtotime(Carbon::now()->addHour())));
	}

}
