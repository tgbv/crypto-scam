<?php

namespace App\Models\Acc;

use Illuminate\Database\Eloquent\Model;

class PendingUserConfirmations extends Model
{
	# set connection
	protected $connection = 'mysql';

	# no
	const UPDATED_AT = null;

	# table
	protected $table = 'acc_pending_user_confirmations';

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
	protected $primaryKey = null;

	# no increment
	public $incrementing = false;
}
