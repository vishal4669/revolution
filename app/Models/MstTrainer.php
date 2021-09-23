<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MstTrainer
 * 
 * @property int $id
 * @property string|null $trainer_name
 * @property string|null $trainer_image_name
 * @property string|null $trainer_description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|TrainerRentalBooking[] $trainer_rental_bookings
 *
 * @package App\Models
 */
class MstTrainer extends Model
{
	protected $table = 'mst_trainers';

	protected $fillable = [
		'trainer_name',
		'trainer_image_name',
		'trainer_description'
	];

	public function trainer_rental_bookings()
	{
		return $this->hasMany(TrainerRentalBooking::class);
	}
}
