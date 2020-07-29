<?php

namespace App\Models\Cry;

use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;

class Reports extends Model
{
	// use QueryCacheable;

	# cache for 5 minutes by default
	// protected $cacheFor = 300;

	# table
	protected $table = 'cry_reports';

	# fillable
	protected $fillable = [
		'description', 'attachments', 'client_ip',
		'client_agent', 
	];

	# casts
	protected $casts = [
		'attachments' => 'json',
	];

	#
	#	return cryptos from database
	#
	public function getAddresses()
	{
		// Why hasManyThrough requires an intermediary model? :(
		//
		// return $this->hasManyThrough(
		// 	\App\Modules\Cry\AddressesList::class,
		// 	'cry_report_address',
		// 	'report_id',
		// 	'id',
		// 	'id',
		// 	'address_id',
		// );

		return $this->belongsToMany(
			\App\Models\Cry\Reports::class,
			'cry_report_address',
			'report_id',
			'address_id',
			'id',
			'id',
		);
	}
}
