<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MarketingMessage
 * 
 * @property int $id
 * @property int $user_id
 * @property int $message
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @package App\Models
 */
class MarketingMessage extends Model
{
	protected $table = 'marketing_messages';

	protected $casts = [
		'user_id' => 'int',
		'message' => 'int'
	];

	protected $fillable = [
		'user_id',
		'message'
	];
}
