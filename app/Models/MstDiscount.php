<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MstDiscount
 * 
 * @property int $id
 * @property bool $discount_type
 * @property float $amount
 * @property int $percentage
 * @property float $maximum_discount
 * @property int $usage_per_user
 * @property Carbon $validation_date
 * @property string $coupon_code
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @package App\Models
 */
class MstDiscount extends Model
{
	protected $table = 'mst_discounts';

	protected $casts = [
		'discount_type' => 'bool',
		'amount' => 'float',
		'percentage' => 'int',
		'maximum_discount' => 'float',
		'usage_per_user' => 'int'
	];

	protected $dates = [
		'validation_date'
	];

	protected $fillable = [
		'discount_type',
		'amount',
		'percentage',
		'maximum_discount',
		'usage_per_user',
		'validation_date',
		'coupon_code'
	];
}
