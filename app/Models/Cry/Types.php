<?php

namespace App\Models\Cry;

use Illuminate\Database\Eloquent\Model;

class Types extends Model
{
    # connection
    protected $connection = 'local';

    # table
    protected $table = 'cry_types_list';

    # fillable
    protected $fillable = [
    	'name'
    ];

    # no timestamps
    public $timestamps = false;

    #
    #   get addresses
    #
    public function getAddresses()
    {
        return $this->setConnection('mysql')->hasMany(
            \App\Models\Cry\AddressesList::class,
            'type_id',
            'id',
        );
    }
}
