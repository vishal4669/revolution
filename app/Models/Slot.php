<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
	protected $table = 'slots';

	public $appends = [
		'upcoming_slots',
	];

	protected $fillable = [
		'slot_start_time',
		'slot_end_time',
		'slot_start_time_id',
		'slot_end_time_id',
		'is_active',
	];

}
