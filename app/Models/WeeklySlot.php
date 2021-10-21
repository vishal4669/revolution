<?php
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class WeeklySlot extends Model
{
    public $timestamps = false;

	public $appends = [
		'slots',
	];
    
	protected $fillable = [
		'day_of_week',
		'slot_id',
		'is_active',
	];

	public function slot()
	{
		return $this->belongsTo(Slot::class);
	}

}
