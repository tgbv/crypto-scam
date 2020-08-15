<?php

namespace App\Models\Acc;

use Illuminate\Database\Eloquent\Model;

class PasswordResets extends Model
{
  # set connection
	protected $connection = 'mysql';

	# no
	const UPDATED_AT = null;

	# table
	protected $table = 'acc_password_resets';

	# fillable
	protected $fillable = [
		'user_id', 'type', 'passphrase',
	];

	# casts
	protected $casts = [
		'user_id' => 'integer',
		'type' => 'integer',
	];

	# no primary key
	protected $primaryKey = 'user_id';

	# no increment
	public $incrementing = false;
}
