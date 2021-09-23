<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class self
 * 
 * @property int $id
 * @property int $users_id
 * @property int $mst_trainer_id
 * @property Carbon $booking_date
 * @property string $booking_slot_time
 * @property string $payment_type
 * @property string $transaction_id
 * @property string|null $payment_details
 * @property int $booked_by_user_id
 * @property bool $booking_status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @package App\Models
 */
class TrainerCafeBooking extends Model
{
	protected $table = 'trainer_cafe_bookings';


	Const PENDING=1;
    const BOOKING_CONFIRMED=2;
    const BOOKING_STARTED=3;
    const COMPLETED=4;
    const CANCELLED_BY_USER=5;
    const CANCELLED_BY_ADMIN=6;

	protected $casts = [
		'users_id' => 'int',
		'mst_trainer_id' => 'int',
		'booked_by_user_id' => 'int'
	];

	protected $dates = [
		'booking_date'
	];

    protected $fillable = [
        'users_id',
        'mst_trainer_id',
        'booked_slot_id',
        'booking_date',
        'booking_start_time',
        'booking_end_time',
        'payment_type',
        'transaction_id',
        'payment_details',
        'booked_by_user_id',
        'booking_status',
        'booking_amount',
        'status',
        'is_performance_added',
        'performance',
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

    public function getBookingStatusAttribute()
	{
		$status = '';
	   
	    switch ($this->attributes['booking_status']) {
                case self::PENDING:
                        $status = 'Pending';
                    break;
                
                case self::BOOKING_CONFIRMED:
                        $status = 'Booking Confirmed';
                    break;
                
                case self::BOOKING_STARTED:
                        $status = 'Booking Started';
                    break;
                
                case self::COMPLETED:
                        $status = 'Completed';
                    break;
                
                case self::CANCELLED_BY_USER:
                        $status = 'Cancelled By User';
                    break;

                case self::CANCELLED_BY_ADMIN:
                        $status = 'Cancelled By Admin';
                    break;
                
                default:
                    $status = 'Pending';
                    break;
            }
           
           return $status;
	}
}
