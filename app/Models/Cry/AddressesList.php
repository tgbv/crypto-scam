<?php

namespace App\Models\Cry;

use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;

class AddressesList extends Model
{
	// use QueryCacheable;

	# cache for 10 minutes by default
	// protected $cacheFor = 600;

	# set connection
	protected $connection = 'mysql';

	# no
	const UPDATED_AT = false;

	# table
	protected $table = 'cry_addresses';

	# fillable
	protected $fillable = [
		'type_id', 'address', 'state'
	];

	# casts
	protected $casts = [
		'type_id' => 'integer',
		'state' => 'boolean',
	];

	#
	#	return reports
	#
	public function getReports()
	{
		return $this->belongsToMany(
			\App\Models\Cry\Reports::class,
			'cry_report_address',
			'address_id',
			'report_id',
			'id',
			'id',
		);
	}

	#
	#	return type of address
	#
	public function getType()
	{
		return $this->setConnection('local')->belongsTo(
			\App\Models\Cry\Types::class,
			'type_id',
			'id',
		);
	}
}
