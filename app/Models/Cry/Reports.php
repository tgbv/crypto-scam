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
		'description', 'attachments', 'client_fingerprint',
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
		return $this->belongsToMany(
			\App\Models\Cry\AddressesList::class,
			'cry_report_address',
			'report_id',
			'address_id',
			'id',
			'id',
		);
	}

	#
	#	search a report by fingerprint
	#
	public static function getByFingerprint(string $f, array $select = ['created_at'])
	{
		return self::select($select)
							->where('client_fingerprint', $f)
							->first();
	}
}
