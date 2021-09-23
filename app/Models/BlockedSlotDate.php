<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TrainerCafeBooking
 * 
 * @property int $id
 * @property int $blocked_by_user_id 
 * @property Carbon $from_date
 * @property Carbon $to_date
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @package App\Models
 */
class BlockedSlotDate extends Model
{
	protected $table = 'blocked_slot_dates';


	protected $dates = [
		'from_date',
		'to_date'
	];

	protected $fillable = [
		'blocked_by_user_id',
		'from_date',
		'to_date'
	];

}
