<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Models\MstTrainer;
use App\Models\User;

/**
 * Class TrainerRentalBooking
 * 
 * @property int $id
 * @property int $users_id
 * @property int $mst_trainer_id
 * @property float $price_per_day
 * @property date $from_date
 * @property date $to_date
 * @property int $total_number_of_days
 * @property float $total_cost
 * @property bool $is_deposit
 * @property float|null $deposited_amount
 * @property string $payment_type
 * @property string $transaction_id
 * @property string|null $payment_details
 * @property int $booked_by_user_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property MstTrainer $mst_trainer
 *
 * @package App\Models
 */
class TrainerRentalBooking extends Model
{
	protected $table = 'trainer_rental_bookings';

	protected $casts = [
		'users_id' => 'int',
		'mst_trainer_id' => 'int',
		'price_per_day' => 'float',
		'total_number_of_days' => 'int',
		'total_cost' => 'float',
		'booked_by_user_id' => 'int',
		'booked_status' => 'bool'
	];

	protected $dates = [
	'from_date',
	'to_date'
	];

	protected $fillable = [
		'users_id',
		'mst_trainer_id',
		'price_per_day',
		'from_date',
		'to_date',
		'total_number_of_days',
		'total_cost',
		'booking_amount',
		'take_payment',
		'discount',
		'total_paid_amount',
		'payment_status',
		'booking_status',
		'status',
		'payment_type',
		'transaction_id',
		'payment_details',
		'booked_by_user_id',
		'booked_status',
		'remarks'
	];

	public function trainer()
	{
		
		return $this->belongsTo(MstTrainer::class, 'mst_trainer_id');
	}

	/**
     * Get the user associated with the booking.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
