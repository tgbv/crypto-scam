<?php

namespace App\Models\Acc;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
	# set connection
	protected $connection = 'mysql';

	# table
	protected $table = 'acc_user_role';

	# fillable
	protected $fillable = [
		'user_id', 'role_id',
	];

	# casts
	protected $casts = [
		'user_id' => 'integer',
		'role_id' => 'integer',
	];

	# no timestamps
	public $timestamps = false;

	# no primary key
	protected $primaryKey = null;

	# no incrementing
	public $incrementing = false;
}
