<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MstCycle
 * 
 * @property int $id
 * @property string $cycle_name
 * @property string $cycle_photo
 * @property string $cycle_description
 * @property bool $cycle_type
 * @property string|null $cycle_number
 * @property float $price_per_month
 * @property float $price_per_hour
 * @property int $is_available
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @package App\Models
 */
class MstCycle extends Model
{
	protected $table = 'mst_cycles';

	protected $casts = [
		'cycle_type' => 'bool',
		'price_per_month' => 'float',
		'price_per_hour' => 'float',
		'is_available' => 'int'
	];

	protected $fillable = [
		'cycle_name',
		'cycle_photo',
		'cycle_description',
		'cycle_type',
		'cycle_number',
		'price_per_month',
		'price_per_hour',
		'is_available'
	];
}
