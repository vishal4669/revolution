<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Models\MstTrainer;

/**
 * Class PackageTrainerCafe
 * 
 * @property int $id
 * @property int $mst_trainer_id
 * @property string|null $package_name
 * @property string|null $package_type
 * @property Carbon|null $validity
 * @property float|null $price_per_hour
 * @property float|null $total_hours
 * @property float|null $total_price
 * @property float|null $package_tax
 * @property bool|null $is_cycle_included
 * @property bool|null $is_aadhar_verification_required
 * @property string|null $terms_n_conditions
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class PackageTrainerCafe extends Model
{
	protected $table = 'package_trainer_cafes';

	protected $casts = [
		'price_per_hour' => 'float',
		'total_hours' => 'float',
		'total_price' => 'float',
		'package_tax' => 'float',
		'is_cycle_included' => 'bool',
		'is_aadhar_verification_required' => 'bool'
	];

	protected $fillable = [
		'package_name',
		'validity',
		'price_per_hour',
		'total_hours',
		'total_price',
		'package_tax',
		'is_cycle_included',
		'is_aadhar_verification_required',
		'terms_n_conditions'
	];
}
