<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MstEvent
 * 
 * @property int $id
 * @property string $event_name
 * @property string $event_description
 * @property Carbon $event_start_date
 * @property Carbon $event_end_date
 * @property Carbon $last_booking_date
 * @property string|null $terms_n_conditions
 * @property string $location
 * @property string|null $event_type
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @package App\Models
 */
class Slot extends Model
{
	protected $table = 'mst_slots';



	protected $fillable = [
		'slot_start_time',
		'slot_end_time',
		'slot_start_time_id',
		'slot_end_time_id'
	];
}
