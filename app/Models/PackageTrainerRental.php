<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PackageTrainerRental
 * 
 * @property int $id
 * @property int $mst_trainer_id
 * @property int $users_id
 * @property string|null $package_name
 * @property string|null $package_type
 * @property float|null $price_per_day
 * @property int|null $total_number_of_days
 * @property float|null $total_price
 * @property bool|null $is_deposit_amount
 * @property float|null $deposited_amount
 * @property bool|null $is_aadhar_verification_required
 * @property string|null $terms_n_conditions
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class PackageTrainerRental extends Model
{
	protected $table = 'package_trainer_rentals';

	protected $casts = [
		'mst_trainer_id' => 'int',
		'users_id' => 'int',
		'price_per_day' => 'float',
		'total_number_of_days' => 'int',
		'total_price' => 'float',
		'is_aadhar_verification_required' => 'bool'
	];

	protected $fillable = [
		'users_id',
		'mst_trainer_id',
		'package_name',
		'package_type',
		'price_per_day',
		'total_number_of_days',
		'total_price',
		'terms_n_conditions',
		'is_aadhar_verification_required'
	];


	/**
     * Get the trainer associated with the package.
     */
    public function trainer()
    {
        return $this->belongsTo(MstTrainer::class, 'mst_trainer_id');
    }
}
