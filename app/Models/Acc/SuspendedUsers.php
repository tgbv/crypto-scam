<?php

namespace App\Models\Acc;

use Illuminate\Database\Eloquent\Model;

class SuspendedUsers extends Model
{
	# set connection
	protected $connection = 'mysql';

	# no
	const UPDATED_AT = null;

	# table
	protected $table = 'acc_suspended_users';

	# fillable
	protected $fillable = [
		'user_id', 'reason',
	];

	# casts
	protected $casts = [
		'user_id' => 'integer',
	];

	# no primary key
	protected $primaryKey = null;

	# no increment
	public $incrementing = false;
}
