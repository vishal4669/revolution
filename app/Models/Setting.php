<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Setting
 * 
 * @property string|null $price_per_day
 * @property string|null $booking_amount
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|TrainerRentalBooking[] $trainer_rental_bookings
 *
 * @package App\Models
 */
class Setting extends Model
{

	protected $table = 'settings';

	protected $fillable = [
		'setting_key',
		'setting_value'
	];

}
